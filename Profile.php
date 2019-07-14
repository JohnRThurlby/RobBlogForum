<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<!-- Fetching Existing Data -->
<?php
    $SearchQueryParameter = $_GET["username"];
    global   $ConnectingDB;
    $sql    =  "SELECT aname,aheadline,abio,aimage FROM admins WHERE username=:userName";
    $stmt   =  $ConnectingDB->prepare($sql);
    $stmt   -> bindValue(':userName', $SearchQueryParameter);
    $stmt   -> execute();
    $Result = $stmt->rowcount();
if( $Result==1 ){
  while ( $DataRows   = $stmt->fetch() ) {
    $ExistingName     = $DataRows["aname"];
    $ExistingBio      = $DataRows["abio"];
    $ExistingImage    = $DataRows["aimage"];
    $ExistingHeadline = $DataRows["aheadline"];
  }
}else {
  $_SESSION["ErrorMessage"]="Bad Request !!";
  Redirect_to("Blog.php?page=1");
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
    <script>   
      $('#year').text(new Date().getFullYear());
    </script>   <!-- end script -->

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/Styles.css">
    
    <title>John Thurlby Blog</title>

  </head>  <!-- end head -->
<body>
  <!-- NAVBAR -->
  <div style="height:10px; background:#696f72;"></div>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <a href="#" class="navbar-brand"> JOHNRTHURLBY.INFO</a>
          <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarcollapseCMS">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a href="MyProfile.php" class="nav-link"> <i class="fas fa-user text-success"></i> My Profile</a>
            </li>
            <li class="nav-item">
              <a href="Dashboard.php" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
              <a href="Posts.php" class="nav-link">Posts</a>
            </li>
            <li class="nav-item">
              <a href="Categories.php" class="nav-link">Categories</a>
            </li>
            <li class="nav-item">
              <a href="Admins.php" class="nav-link"><i class="fas fa-tasks"></i> Manage Admins</a>
            </li>
            <li class="nav-item">
              <a href="Comments.php" class="nav-link"><i class="fas fa-comments"></i> Comments</a>
            </li>
            <li class="nav-item">
              <a href="Blog.php?page=1" class="nav-link" target="_blank"><i class="fas fa-blog"></i> Live Blog</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="Logout.php" class="nav-link text-danger">
              <i class="fas fa-user-times"></i> Logout</a></li>
          </ul>
          </div>
        </div>
      </nav>
      <div style="height:10px; background:#deebf0;"></div>
      <!-- NAVBAR END -->
    <!-- HEADER -->
    <header class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
          <h1><i class="fas fa-user text-success mr-2" style="color:#27aae1;"></i><?php echo $ExistingName; ?></h1>
          <h3><?php echo $ExistingHeadline; ?></h3>
          </div>
        </div>
      </div>
    </header>
    <!-- HEADER END -->
    <section class="container py-2 mb-4">
      <div class="row">
        <div class="col-md-3">
          <img src="images/<?php echo $ExistingImage; ?>" class="d-block img-fluid mb-3 rounded-circle" alt="">
        </div>
        <div class="col-md-9" style="min-height:400px;">
          <div class="card">
            <div class="card-body">
              <p class="lead"> <?php echo $ExistingBio; ?> </p>
            </div>

          </div>

        </div>

      </div>

    </section>

    <!-- FOOTER -->
      <!-- NAVBAR -->
      <div style="height:10px; background:#696f72;">
      </div>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <a href="#" class="navbar-brand"> JOHNRTHURLBY.INFO</a>
          <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
            <span class="navbar-toggler-icon"></span>
          </button> <!-- END bUTTON -->
          <div class="collapse navbar-collapse" id="navbarcollapseCMS">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item">
                <a href="Contact.php" class="nav-link"><i class="fas fa-envelope-square"></i> Contact</a>
              </li> <!-- END CONTACT ITEM -->
              <li class="nav-item">
                <a href="Privacy.php" class="nav-link">Privacy</a>
              </li> <!-- END PRIVACY ITEM -->
            </ul> <!-- END UL -->
            <ul class="navbar-nav ml-auto">
            </ul> <!-- UL -->
          </div> <!-- END DIV COLLAPSE -->
        </div> <!-- END CONTAINER -->
      </nav> <!-- END HEADER -->

    <footer class="bg-dark text-white">
      <div class="container">
        <div class="row">
          <div class="col">
            <p class="lead text-center">John R. Thurlby | <span id="year"></span> &copy; ----All right Reserved.</p>
          </div> <!-- END COL -->
        </div> <!-- END ROW -->
      </div> <!-- END CONTAINER -->
    </footer> <!-- END FOOTER -->

    <div style="height:10px; background:#696f72;"></div>
        
  </body>    <!-- END BODY -->
</html> <!-- END HTML -->

