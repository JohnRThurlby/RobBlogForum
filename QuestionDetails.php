<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<!-- Fetching Existing Data -->
<?php
    $SearchQueryParameter = $_GET["id"];
    global   $ConnectingDB;
    $sql    =  "SELECT * FROM question WHERE question_id = $SearchQueryParameter";
    $stmt   =  $ConnectingDB->prepare($sql);
    $stmt   -> execute();
    $Result = $stmt->rowcount();
if( $Result==1 ){
  while ( $DataRows   = $stmt->fetch() ) {
    $QuestId          = $DataRows["question_id"];
    $QuestHead        = $DataRows["heading"];
    $QuestDetail      = $DataRows["question_detail"];
    $QuestDateTime    = $DataRows["datetime"];
    $QuestUserId      = $DataRows["user_id"];
    $QuestSubTopicId  = $DataRows["subtopic_id"];
    $QuestViews       = $DataRows["views"];

  }
}else {
  $_SESSION["ErrorMessage"]="Bad Request !!";
  Redirect_to("Questions.php");
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
    <?php require("navbarforum.php"); ?>
  <!-- NAVBAR END -->
    
  <!-- HEADER -->
  <header class="bg-dark text-white py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1 class="text-center"><i class="fas fa-edit" style="color:#27aae1;"></i> Question Details</h1>
        </div>
      </div>
    </div>
  </header>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card bg-light text-dark mb-3">
              <div class="card-header">
                <h1 class="text-center"><?php echo $QuestHead; ?></h1>
              </div>
              <div >
                <div class="row">
                  <div class="col-lg-6 offset-lg-3 mb-2">
                    <h5 class="text-center"><?php echo $QuestDetail; ?></h5><br>
                    <h5>Date Added: <?php echo $QuestDateTime; ?></h5><br>
                    <h5 class="text-left">Number of Views: <?php echo $QuestViews; ?></h5><br>
                    <h5 class="text-left">Added By:        <?php echo $QuestUserId; ?></h5><br>
                    <h5 class="text-left">SubTopic:        <?php echo $QuestSubTopicId; ?></h5>
                  </div>
                </div>
              </div>
            </div>
              
          </div>
        
        </div>
      </div>

    <!-- FOOTER -->
    <?php require("footerblog.php"); ?>
        
  </body>    <!-- END BODY -->
</html> <!-- END HTML -->
