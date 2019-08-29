<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php
$_SESSION["TrackingURL"]=$_SERVER["PHP_SELF"];
 Confirm_Login(); ?>
<?php
if(isset($_POST["Submit"])){
  $Topic = $_POST["TopicTitle"];
  $Type  = $_POST["TopicType"];
  $Admin = $_SESSION["UserName"];

  if(empty($Topic) || empty($Type) ){
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("Topics.php");
  }elseif (strlen($Topic)<3) {
    $_SESSION["ErrorMessage"]= "Topic title should be greater than 2 characters";
    Redirect_to("Topics.php");
  }elseif (strlen($Topic)>49) {
    $_SESSION["ErrorMessage"]= "Topic title should be less than than 50 characters";
    Redirect_to("Topics.php");
  }else{
    // Query to insert topic in DB When everything is fine
    $ConnectingDB;
    $sql = "INSERT INTO topic(topic_name,topic_type)";
    $sql .= "VALUES(:topicName,:topicType)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':topicName',$Topic);
    $stmt->bindValue(':topicType',$Type);
    $Execute=$stmt->execute();

    if($Execute){
      $_SESSION["SuccessMessage"]="Topic : " .$Topic." added Successfully";
      Redirect_to("Topics.php");
    }else {
      $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
      Redirect_to("Topics.php");
    }
  }
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
    
    <title>John Thurlby Blog</title>

  </head>  <!-- end head -->
<body>
  <!-- NAVBAR -->
  <?php require("navbarforum.php"); ?>


    <!-- HEADER -->
    <header class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <h1 class="text-center"><i class="fas fa-edit" style="color:#27aae1;"></i> Topics</h1>
          </div>
        </div>
      </div>
    </header>
    <!-- HEADER END -->

     <!-- Main Area -->
     <section class="container py-2 mb-4">

      <table class="table table-striped table-hover">
        <thead class="thead-dark">
          <tr>
            <th>No. </th>
            <th>Topic Name</th>
            <th>Topic Type</th>
            <th>Action</th>
          </tr>
        </thead>
      <?php
      $ConnectingDB;
      $sql = "SELECT * FROM topic ORDER BY topic_id asc";
      $Execute =$ConnectingDB->query($sql);
      while ($DataRows=$Execute->fetch()) {
        $TopicId = $DataRows["topic_id"];
        $TopicName = $DataRows["topic_name"];
        $TopicType = $DataRows["topic_type"];
      ?>
      <tbody>
        <tr>
          <td><?php echo htmlentities($TopicId); ?></td>
          <td><?php echo htmlentities($TopicName); ?></td>
          <td><?php echo htmlentities($TopicType); ?></td>
          <td> <a href="DeleteTopic.php?id=<?php echo $TopicId;?>" class="btn btn-danger">Delete</a>  </td>

      </tbody>
      <?php } ?>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
      <?php
       echo ErrorMessage();
       echo SuccessMessage();
       ?>
      <form class="" action="Topics.php" method="post">
        <div class="card bg-secondary text-light mb-3">
          <div class="card-header">
            <h1 class="text-center">Add New Topic</h1>
          </div>
          <div class="card-body bg-dark">
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> Topic Title: </span></label>
               <input class="form-control" type="text" name="TopicTitle" id="title" placeholder="Topic Title" value="">
            </div>
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> Topic Type: </span></label>
               <input class="form-control" type="text" name="TopicType" id="title" placeholder="Topic Type" value="">
            </div>
            <div class="row">
              
              <div class="col-lg-6 offset-lg-3 mb-2">
                <button type="submit" name="Submit" class="btn btn-success btn-block">
                  <i class="fas fa-check"></i> Add Topic
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
