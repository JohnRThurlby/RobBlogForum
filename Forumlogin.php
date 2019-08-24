<!-- PHP Includes -->
<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

<?php
// If global session is set, send to topics 
if(isset($_SESSION["UserId"])){
  Redirect_to("Topics.php");
}  // END ISSET SESSION

// If global post is submit, check login 

if (isset($_POST["Submit"])) 
  {

  $UserName = $_POST["Username"];
  $PassWord = $_POST["Password"];

  if (empty($UserName)||empty($PassWord)) {
    $_SESSION["ErrorMessage"]= "All fields must be filled out";
    Redirect_to("Forumlogin.php");
  }    // END IF EITHER EMPTY 
  else 
    {
    // see if user is in DB by calling function
    $Found_Account=ForumLogin_Attempt($UserName,$PassWord);

    if ($Found_Account) 
      {
      $_SESSION["UserId"]=$Found_Account["user_id"];
      $_SESSION["UserName"]=$Found_Account["username"];
      if (isset($_SESSION["TrackingURL"])) {
        Redirect_to($_SESSION["TrackingURL"]);
      } // END FOUND ACCOUNT
      else
        {
        Redirect_to("Topics.php");
        }  // END ELSE
      }  // END ACCOUNT FOUND
    else 
      {
      $_SESSION["ErrorMessage"]="Incorrect Username/Password";
      Redirect_to("Forumlogin.php");
      } // END ELSE
    } // END ELSE
  } // END SUBMIT
?>  <!-- END PHP -->

<!DOCTYPE html>
<html lang="en">
  <!-- Meta -->
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <script>   
      $('#year').text(new Date().getFullYear());
    </script>   <!-- end script -->

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/Styles.css">
    
    <title>John Thurlby Forum</title>

  </head>  <!-- END HEAD -->

  <body>
    <!-- NAVBAR -->
    <div style="height:10px; background:#696f72;"></div>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <a href="#" class="navbar-brand"> JOHNRTHURLBY.INFO</a>
        </div>
      </nav>
      <div style="height:10px; background:#deebf0;"></div>
    <!-- NAVBAR END -->

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
              <h4>Forum Login</h4>
            </div> <!-- END CARD HEADER -->

            <div class="card-body bg-dark">
              <form class="" action="Forumlogin.php" method="post">
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
                <input type="submit" name="Submit" class="btn btn-info btn-block" value="Login">
              </form> <!-- END FORM -->
            </div> <!-- END CARD BODY -->
          </div> <!-- END CARD -->
        </div> <!-- END OFFSET COL -->
      </div> <!-- END ROW -->
    </section> <!-- END MAIN CONTAINER -->

    <!-- FOOTER -->

      <!-- NAVBAR -->

      <div style="height:10px; background:#696f72;">
      </div>

      <footer class="bg-dark text-white">
      <div class="container">
        <div class="row">
          <div class="col">
            <p class="lead text-center">John R. Thurlby | &copy; <span id="year"></span> ----All right Reserved.</p>
          </div> <!-- END COL -->
        </div> <!-- END ROW -->
      </div> <!-- END CONTAINER -->
    </footer> <!-- END FOOTER -->

    <div style="height:10px; background:#696f72;"></div>
    <script>   
      $('#year').text(new Date().getFullYear());
    </script>   <!-- end script -->

  </body>    <!-- END BODY -->
</html> <!-- END HTML -->
