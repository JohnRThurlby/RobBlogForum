<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php

if (isset($_POST['submit']))
{
  $UserName    = $_POST['Username'];
  $PassWord    = $_POST['Password'];
  $RePassWord  = $_POST['RePassword'];
  $Email       = $_POST['Email'];

  date_default_timezone_set("America/New_York");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

  if(empty($UserName)||empty($PassWord)||empty($RePassWord)){
    $_SESSION["ErrorMessage"] = "All fields must be filled out correctly";
    Redirect_to("Forumregister.php");
  } elseif (strlen($PassWord)<8) {
    $_SESSION["ErrorMessage"] = "Password should be greater than 7 characters";
    Redirect_to("Forumregister.php");
  } elseif ($PassWord !== $RePassWord) {
    $_SESSION["ErrorMessage"] = "Password and Confirm Password should match";
    Redirect_to("Forumregister.php");
  } elseif (CheckForumUserNameExistsOrNot($UserName)) {
    $_SESSION["ErrorMessage"] = "Username Exists. Try Another One! ";
    Redirect_to("Forumregister.php");
  } else {  
    $PassEncrypt = sha1($PassWord);
    global $ConnectingDB;
    $sql = "INSERT INTO users(username,password,email,date)";
    $sql .= "VALUES(:userName,:passWord,:emailUser,:dateTime)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':userName',$UserName);
    $stmt->bindValue(':passWord',$PassEncrypt);
    $stmt->bindValue(':emailUser',$Email);
    $stmt->bindValue(':dateTime',$DateTime);
    $Execute=$stmt->execute();
    if($Execute){
      $_SESSION["SuccessMessage"]="Username " .$UserName." registered successfully";
      Redirect_to("Topics.php");
    }else {
      $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
      Redirect_to("Forumregister.php");
    }}
  }
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
            <h1 class="text-center"><i  style="color:#696f72;"></i>Nerdy Techie Forum in PHP</h1>
          </div> <!-- END CONTAINER -->
        </div> <!-- END COL -->
      </div> <!-- END ROW -->
    </header> <!-- END HEADER -->

    <!-- START MAIN CONTAINER -->
    <section class="container py-2 mb-4">
      <div class="row">
        <div class="offset-sm-3 col-sm-6" style="min-height:500px;">
          <br><br><br>
          
          <?php
          echo ErrorMessage();
          echo SuccessMessage();
          ?> <!-- END PHP SCOPE -->

          <div class="card bg-secondary text-light">

            <div class="card-header">
              <h4>Register for Forum</h4>
            </div> <!-- END CARD HEADER -->

            <div class="card-body bg-dark">
              <form class="" action="Forumregister.php" method="POST">
                <div class="form-group">
                  <label for="username"><span class="FieldInfo">Username:</span></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-white bg-info"> <i class="fas fa-user"></i> </span>
                    </div> <!-- END INPUT GROUP PREPEND -->
                    <input type="text" class="form-control" name="Username" id="username" value="">
                  </div> <!-- END INPUT GROUP -->
                </div> <!-- END FORM GROUP -->
                <div class="form-group">
                  <label for="password"><span class="FieldInfo">Password:</span></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-white bg-info"> <i class="fas fa-lock"></i> </span>
                    </div> <!-- END INPUT GROUP PREPEND -->
                    <input type="password" class="form-control" name="Password" id="password" value="">
                  </div> <!-- END INPUT GROUP -->
                </div> <!-- END FORM GROUP -->
                <div class="form-group">
                  <label for="password"><span class="FieldInfo">Confirm Password:</span></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-white bg-info"> <i class="fas fa-lock"></i> </span>
                    </div> <!-- END INPUT GROUP PREPEND -->
                    <input type="password" class="form-control" name="RePassword" id="re_password" value="">
                  </div> <!-- END INPUT GROUP -->
                </div> <!-- END FORM GROUP -->
                <label for="email"><span class="FieldInfo">Email:</span></label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-white bg-info"> <i class="fas fa-user"></i> </span>
                    </div> <!-- END INPUT GROUP PREPEND -->
                    <input type="text" class="form-control" name="Email" id="Email" value="">
                  </div> <!-- END INPUT GROUP -->
                  <button type="submit" name="submit" class="btn btn-success btn-block">
                  <i class="fas fa-check"></i> Register
                </button>
              </form> <!-- END FORM -->
            </div> <!-- END CARD BODY -->
          </div> <!-- END CARD -->
        </div> <!-- END OFFSET COL -->
      </div> <!-- END ROW -->
    </section> <!-- END MAIN CONTAINER -->
    <!-- Main Area End -->

    

  </body>    <!-- END BODY -->
</html> <!-- END HTML -->