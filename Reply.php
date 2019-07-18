<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

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
          <h1 class="text-center"><i class="fas fa-edit" style="color:#27aae1;"></i> Questions</h1>
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
            <th>Heading</th>
            <th>Details</th>
            <th>Date Added</th>
            <th>Number of Views</th>
          </tr>
        </thead>
      <?php
      $ConnectingDB;
      if(isset($_GET["id"])){
        $SearchQueryParameter = $_GET["id"];
        $sql = "SELECT subtopic_name FROM subtopic  WHERE subtopic_id = $SearchQueryParameter LIMIT 1";
        $stmt   =  $ConnectingDB->prepare($sql);
        $stmt   -> execute();
        $Result = $stmt->rowcount();
        if( $Result==1 ){
          while ( $DataRows = $stmt->fetch() ) {
            $SubTopicName = $DataRows["subtopic_name"];
          } ?>
          <h3 class="text-center"><?php echo $SubTopicName; ?></h3>
        <?php }else {
          $_SESSION["ErrorMessage"]="Bad Request !!";
          Redirect_to("Questions.php?page=1");
        }
        $sql = "SELECT * FROM question  WHERE subtopic_id = $SearchQueryParameter";
      }
      else { 
        $sql = "SELECT * FROM question";
      }
      $Execute = $ConnectingDB->query($sql);
      while ($DataRows = $Execute->fetch()) {
        $Heading   = $DataRows["heading"];
        $QuestionDetail = $DataRows["question_detail"];
        $QuestTime = $DataRows["datetime"];
        $Views    = $DataRows["views"];
      ?>
      <tbody>
        <tr>
          <td><?php echo htmlentities($Heading); ?></td>
          <td><?php echo htmlentities($QuestionDetail); ?></td>
          <td><?php echo htmlentities($QuestTime); ?></td>
          <td><?php echo htmlentities($Views); ?></td>

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
      <form class="" action="Questions.php" method="post">
        <div class="card bg-secondary text-light mb-3">
          <div class="card-header">
            <h1 class="text-center">Add New Sub Topic</h1>
          </div>
          <div class="card-body bg-dark">
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> SubTopic Name: </span></label>
               <input class="form-control" type="text" name="SubTopicName" id="title" placeholder="Sub Topic Name" value="">
            </div>
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> SubTopic Description: </span></label>
               <input class="form-control" type="text" name="SubTopicDesc" id="title" placeholder="Sub Topic Description" value="">
            </div>
            <div class="row">
              
              <div class="col-lg-6 offset-lg-3 mb-2">
                <button type="submit" name="Submit" class="btn btn-success btn-block">
                  <i class="fas fa-check"></i> Add Question
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
