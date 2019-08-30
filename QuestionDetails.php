<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php
if(isset($_POST["Submit"])){
  $ReplyDesc = $_POST["ReplyDetails"];
  $OrigQuestionId = $_POST["OrigQuestId"];
  date_default_timezone_set("America/New_York");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

  if(empty($ReplyDesc)){
    $_SESSION["ErrorMessage"]= "Reply must be filled out";
    Redirect_to("QuestionDetails.php?id=".$OrigQuestionId);
  }elseif (strlen($ReplyDesc) < 5) {
    $_SESSION["ErrorMessage"]= "Reply should be greater than 4 characters";
    Redirect_to("QuestionDetails.php?id=".$OrigQuestionId);
  }elseif (strlen($ReplyDesc) > 2000) {
    $_SESSION["ErrorMessage"]= "Reply should be less than than 2000 characters";
    Redirect_to("QuestionDetails.php?id=".$OrigQuestionId);
  }else{
    global $ConnectingDB;
    $sql = "INSERT INTO answer(replied,question_id,answer_detail,dateadded,user_id,numberlike)";
    $sql .= "VALUES(:reply,:questId,:ansDetail,:dateTimeAdded,:userAdd,:liked)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt -> bindValue(':reply',0);
    $stmt -> bindValue(':questId',$OrigQuestionId);
    $stmt -> bindValue(':ansDetail',$ReplyDesc);
    $stmt -> bindValue(':dateTimeAdded',$DateTime);
    $stmt -> bindValue(':userAdd',5);
    $stmt -> bindValue(':liked',0);

    $Execute=$stmt->execute();

    if($Execute){
      $_SESSION["SuccessMessage"]="Reply added Successfully";
      Redirect_to("QuestionDetails.php?id=".$OrigQuestionId);
    }else {
      $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
      Redirect_to("QuestionDetails.php?id=".$OrigQuestionId);
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
    <script>   
      $('#year').text(new Date().getFullYear());
    </script>   <!-- end script -->

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="Css/Styles.css">
    
    <title>John Thurlby Forum</title>

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
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card bg-light text-dark mb-3">
              <div >
                <div class="row">
                  <div class="col-lg-6 offset-lg-3 mb-2">
                  <?php
                    if (isset($_GET["id"])){

                      $SearchQueryParameter = $_GET["id"];
                      $OrigQuestion = $SearchQueryParameter;

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
                          $QuestDateTime    = $DataRows["dateadded"];
                          $QuestUser        = $DataRows["user_id"];
                          $QuestSubTopicId  = $DataRows["subtopic_id"];
                          $QuestViews       = $DataRows["views"] + 1;
                        }
                      }else {
                        $_SESSION["ErrorMessage"]="Bad Request !!";
                        Redirect_to("QuestionDetails.php?id=".$SearchQueryParameter);
                      }
                    }
                    ?>
                    <div class="card-header">
                      <h1 class="text-center"><?php echo $QuestHead; ?></h1>
                    </div>
                    <h5 class="text-center"><?php echo $QuestDetail; ?></h5><br>
                    <?php UpdateQuestionViews($OrigQuestion) ?>
                    <table class="table table-striped table-hover">
                      <thead class="thead-dark">
                        <tr>
                          <th>Date Added</th>
                          <th>Added by</th>
                          <th>Subtopic</th>
                          <th>Number of Views</th>
                        </tr>
                      </thead>
                      
                      <?php 
                        $Found_Name = GetForumUserName($QuestUser); 
                        if ($Found_Name) {
                          $QuestUserName = $Found_Name["username"];
                        }
                        else {
                          $QuestUserName = "Not available";
                        }  // END ELSE

                        $Found_SubName = GetSubTopicName($QuestSubTopicId); 
                        if ($Found_SubName) {
                          $QuestSubTopicName = $Found_SubName["subtopic_name"];
                        }
                        else {
                          $QuestSubTopicName = "Not available";
                        }  // END ELSE
                      ?> 
                      <tbody>
                        <tr>
                          <td><?php echo htmlentities($QuestDateTime); ?></td>
                          <td><?php echo htmlentities($QuestUserName); ?></td> 
                          <td><?php echo htmlentities($QuestSubTopicName); ?></td>
                          <td><?php echo htmlentities($QuestViews++); ?></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Area -->
    <section class="container py-2 mb-4">

      <table class="table table-striped table-hover">
        <thead class="thead-dark">
          <tr>
            <th>Reply</th>
            <th>Added by</th>
            <th>Date Added</th>
            <th>No. of Likes</th>
            <th>Like?</th>
          </tr>
        </thead>
        <?php
          if(isset($_GET["id"])){
            $SearchQueryParameter = $_GET["id"];
            global   $ConnectingDB;
            $QuestionId = $SearchQueryParameter;
            $sql    =  "SELECT * FROM answer WHERE question_id = $SearchQueryParameter ORDER BY dateadded ASC";
            $stmt   =  $ConnectingDB->prepare($sql);
            $stmt   -> execute();
            $Result = $stmt->rowcount();
            $Execute = $ConnectingDB->query($sql); 
            while ( $DataRows   = $stmt->fetch() ) {
              $AnswerId         = $DataRows["answer_id"];
              $Replied          = $DataRows["replied"];
              $QuestionId       = $DataRows["question_id"];
              $ReplyDetail      = $DataRows["answer_detail"];
              $ReplyDateTime    = $DataRows["dateadded"];
              $ReplyUserId      = $DataRows["user_id"];
              $Found_Name = GetForumUserName($ReplyUserId); 
              if ($Found_Name) {
                $ReplyUserName = $Found_Name["username"];
              }
              else {
                $ReplyUserName = "Not available";
              }  // END ELSE
              $ReplyLike        = $DataRows["numberlike"];
            ?>
            <tbody>
              <tr>
                <td><?php echo htmlentities($ReplyDetail); ?></td>
                <td><?php echo htmlentities($ReplyUserName); ?></td>
                <td><?php echo htmlentities($ReplyDateTime); ?></td>
                <td><?php echo htmlentities($ReplyLike); ?></td>
                <td style="min-width:100px;"> <a class="btn btn-primary"href="UpdateReplyLike.php?id=<?php echo $AnswerId; ?>&questid=<?php echo $QuestionId;?>" target="_blank">Like?</a> </td>
              </tr>
            </tbody>
          <?php }} ?>
      </table>
      <div class="row">
      <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
      <?php
      echo ErrorMessage();
      echo SuccessMessage();
      ?>
      <form class="" action="QuestionDetails.php" method="post">
        <div class="card bg-secondary text-light mb-3">
          <div class="card-header">
            <h1 class="text-center">Add a Reply</h1>
          </div>
          <div class="card-body bg-dark">
            <input type="hidden" id="OrigQuestId" name="OrigQuestId" value="<?php echo $OrigQuestion; ?>">
            <div class="form-group">
              <label for="title"> <span class="FieldInfo"> Reply: </span></label>
              <input class="form-control" type="text" name="ReplyDetails" id="title" placeholder="Reply" value="">
            </div>
            <div class="row">
              
              <div class="col-lg-6 offset-lg-3 mb-2">
                <button type="submit" name="Submit" class="btn btn-success btn-block">
                  <i class="fas fa-check"></i> Add Reply
                </button>
              </div>
            </div>
          </div>
        </div>
      </form>

    </section>
    <!-- FOOTER -->
    <?php require("footerblog.php"); ?>
  </body>    <!-- END BODY -->
</html> <!-- END HTML -->
