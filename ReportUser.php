<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

<?php
if(isset($_POST["Submit"])){
    
  if(isset($_GET["id"])){


  date_default_timezone_set("America/New_York");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

  $ReportedId = $_GET["id"];
  $ReportedName = $_GET["name"];
  $Reason     = $_POST["ReportReason"];
  $UserId     = $_SESSION["UserId"];


  if(empty($Reason)){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("ReportUser.php");
  } else {
    // Query to insert topic in DB When everything is fine
    global $ConnectingDB;
    $sql = "INSERT INTO reportuser(user_id,reported_user,reason_report,date_reported)";
    $sql .= "VALUES(:reportingUser,:reportedUser,:reportReason,:reportDate)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':reportingUser',$UserId);
    $stmt->bindValue(':reportedUser',$ReportedId);
    $stmt->bindValue(':reportReason',$Reason);
    $stmt->bindValue(':reportDate',$DateTime);

    $Execute=$stmt->execute();

    if($Execute){
    $_SESSION["SuccessMessage"] = $ReportedName ." reported";
    Redirect_to("Chat.php");
    }else {
    $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
    Redirect_to("ReportUser.php");
    }
  }}
} //Ending of Submit Button If-Condition
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/Styles.css">
    
    <title>John Thurlby Forum</title>

  </head>  <!-- end head -->
<body>
  <!-- NAVBAR -->
  <?php require("navbarforum.php"); ?>


    <!-- HEADER -->
    <header class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <h1 class="text-center"><i class="fas fa-edit" style="color:#27aae1;"></i> Report</h1>
          </div>
        </div>
      </div>
    </header>
    <!-- HEADER END -->

     <!-- Main Area -->
    <section class="container py-2 mb-4">
   
    <div class="row">
        <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
        <?php
        echo ErrorMessage();
        echo SuccessMessage();
        ?>
        <form class="" action="ReportUser.php" method="post">
          <div class="card bg-secondary text-light mb-3">
            <div class="card-header">
                <h1 class="text-center">Report User</h1>
            </div>
            <div class="card-body bg-dark">
              <div class="form-group">
                <label for="title"> <span class="FieldInfo"> Report reason: </span></label>
                <input class="form-control" type="text" name="ReportReason" id="title" placeholder="Report Reason" value="">
              </div>
              <div class="row">
                <div class="col-lg-6 offset-lg-3 mb-2">
                    <button type="submit" name="Submit" class="btn btn-success btn-block">
                    <i class="fas fa-check"></i> Report User
                    </button>
                </div>
              </div>
            </div>
          </div>  
        </form>
    </section>

    <!-- End Main Area -->
      <!-- FOOTER -->
    <?php require("footerblog.php"); ?>

    <script>   
      $('#year').text(new Date().getFullYear());
    </script>   <!-- end script -->    
  </body>    <!-- END BODY -->
</html> <!-- END HTML -->
