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

    <style media="screen">
      .heading{
          font-family: Bitter,Georgia,"Times New Roman",Times,serif;
          font-weight: bold;
          color: #005E90;
      }
      .heading:hover{
        color: #0090DB;
      }
    </style>

  </head>  <!-- end head -->

  <body>

    <!-- NAVBAR -->
    <?php require("navbarblog.php");?> 
  
      <!-- START HEADER -->
      <header class="bg-dark text-white py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h3 class="text-center"><i  style="color:#696f72;"></i>Under construction</h3>
            </div> <!-- END CONTAINER -->
          </div> <!-- END COL -->
        </div> <!-- END ROW -->
      </header> <!-- END HEADER -->
      <div style="height:10px; background:#deebf0;"></div>
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

    <script>   
      $('#year').text(new Date().getFullYear());
    </script>   <!-- end script -->

  </body>    <!-- END BODY -->
</html> <!-- END HTML -->
