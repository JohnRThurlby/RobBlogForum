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
          <h1 class="text-center"><i class="fas fa-edit" style="color:#27aae1;"></i> Chat</h1>
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
            <th>User Name</th>
            <th>Number of Messages</th>
            <th>Last Chat Time</th>
            <th>Chat</th>
            <th>Delete Chat</th>
            <th>Block</th>
            <th>Report</th>
          </tr>
        </thead>
      <?php
      $ConnectingDB;
      $sql = "SELECT * FROM chatmaster WHERE user_id_from = 5 ORDER BY user_id_to ASC";
      $stmt   =  $ConnectingDB->prepare($sql);
      $stmt   -> execute();
      $Result = $stmt->rowcount();
      $Execute = $ConnectingDB->query($sql); 
      while ($DataRows = $Execute->fetch()) {
        $UserMsgTo = $DataRows["user_id_to"];
        $NumMsgs   = $DataRows["chatmessages"];
        $ChatId    = $DataRows["chat_id"];

      ?>
      <?php 
        $Found_Name = GetForumUserName($UserMsgTo); 
        if ($Found_Name) {
            $UserChatTo = $Found_Name["username"];
        }
        else {
            $UserChatTo = "Not available";
        }  // END ELSE
      ?> 
      <tbody>
        <tr>
          <td><?php echo htmlentities($UserChatTo); ?></td>
          <td><?php echo htmlentities($NumMsgs); ?></td>
          <td><?php echo htmlentities(0); ?></td>
          <td style="min-width:100px;"> <a class="btn btn-primary"href="ChatMessages.php?id=<?php echo $UserMsgTo; ?>" target="_blank">Chat</a> </td>
          <td style="min-width:100px;"> <a class="btn btn-primary"href="Deletemessages.php?id=<?php echo $ChatId; ?>">Delete Chat</a> </td>
          <td style="min-width:100px;"> <a class="btn btn-primary"href="Blockuser.php?id=<?php echo $UserMsgTo; ?>">Block</a> </td>
          <td style="min-width:100px;"> <a class="btn btn-primary"href="ReportUser.php?id=<?php echo $UserMsgTo; ?>">Report</a> </td>
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
</section>

    <!-- End Main Area -->
      <!-- FOOTER -->
    <?php require("footerblog.php"); ?>

    <script>   
      $('#year').text(new Date().getFullYear());
    </script>   <!-- end script -->    
  </body>    <!-- END BODY -->
</html> <!-- END HTML -->
