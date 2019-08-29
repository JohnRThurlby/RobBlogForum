<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php

  if (isset($_POST["Submit"]))
  {
    $UserNme    = $_POST['Username'];
    $PassWrd    = $_POST['Password'];
    $RePass     = $_POST['RePassword'];
    $UserEmail  = $_POST['Email'];

    date_default_timezone_set("America/New_York");
    $CurrentTime=time();
    $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

    if(empty($UserNme)||empty($PassWrd)||empty($RePass)){
      $_SESSION["ErrorMessage"] = "All fields must be filled out correctly";
      Redirect_to("Forumregister.php");
    } elseif (strlen($PassWrd)<8) {
        $_SESSION["ErrorMessage"] = "Password should be greater than 7 characters";
        Redirect_to("Forumregister.php");
    } elseif (CheckForumUserExists($UserNme)) {
      $_SESSION["ErrorMessage"] = "Username Exists. Try Another One! ";
      Redirect_to("Forumregister.php");
    } else {  
      global $ConnectingDB;
      $sql = "INSERT INTO user(username,password,user_acc_active,e_mail,date_added,last_login)";
      $sql .= "VALUES(:userName,:passWord,:accntActive,:emailUser,:dateAdd,:lastIn)";
      $stmt = $ConnectingDB->prepare($sql);
      $stmt->bindValue(':userName',$UserNme);
      $stmt->bindValue(':passWord',$PassWrd);
      $stmt->bindValue(':accntActive',1);
      $stmt->bindValue(':emailUser',$UserEmail);
      $stmt->bindValue(':dateAdd',$DateTime);
      $stmt->bindValue(':lastIn',$DateTime);

      $Execute=$stmt->execute();
      if($Execute){
        $_SESSION["SuccessMessage"]="Username " .$UserNme." registered successfully";
        Redirect_to("Topics.php");
      }else {
        $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
        Redirect_to("Forumregister.php");
      }
    }}
    
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
  
    <!-- HEADER -->
    <header class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
        </div>
      </div>
    </header>
    <!-- HEADER END -->

        <!-- START HEADER -->
        <header class="bg-dark text-white py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h1 class="text-center"><i  style="color:#696f72;"></i>Nerdy Techie Forum</h1>
          </div> <!-- END CONTAINER -->
        </div> <!-- END COL -->
      </div> <!-- END ROW -->
    </header> <!-- END HEADER -->

    <!-- Main Area -->
    <section class="container py-2 mb-4">
      <div class="row">
      <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
      <?php
      echo ErrorMessage();
      echo SuccessMessage();
      ?>
      <form class="" action="Forumregister.php" method="post">
        <div class="card bg-secondary text-light mb-3">
          <div class="card-header">
            <h1 class="text-center">Register for the Forum</h1>
          </div>
          <div class="card-body bg-dark">
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> User Name: </span></label>
              <input class="form-control" type="text" name="Username" id="title" placeholder="User Name" value="">
            </div>
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> Password: </span></label>
              <input class="form-control" type="password" name="Password" id="title" placeholder="Password" value="">
            </div>
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> Re-enter Password: </span></label>
              <input class="form-control" type="password" name="RePassword" id="title" placeholder="Verify Password" value="">
            </div>
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> Email: </span></label>
              <input class="form-control" type="text" name="Email" id="title" placeholder="Email" value="">
            </div>
            <div class="row">
              <div class="col-lg-6 offset-lg-3 mb-2">
                <input type="submit" name="Submit" class="btn btn-info btn-block" value="Register">

              </div>
            </div>
          </div>
        </div>
      </form>

    </section>
    <!-- Main Area End -->
  </body>    <!-- END BODY -->
</html> <!-- END HTML -->