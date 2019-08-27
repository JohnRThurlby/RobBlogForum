<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php

if(isset($_GET["id"])){

  date_default_timezone_set("America/New_York");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);  
 
  $UserId = $_SESSION["UserId"];
  $BlockedUserId = $_GET["id"];
  $BlockedUserName = $_GET["name"];

 
  global $ConnectingDB;
  $sql = "INSERT INTO blockchat(user_id,blocked_user,dateblocked)";
  $sql .= "VALUES(:userBlocking,:userBlocked,:blockDateTime)";
  $stmt = $ConnectingDB->prepare($sql);
  $stmt->bindValue(':userBlocking',$UserId);
  $stmt->bindValue(':userBlocked',$BlockedUserId);
  $stmt->bindValue(':blockDateTime',$DateTime);
  
  $Execute=$stmt->execute();
  if($Execute){
    $_SESSION["SuccessMessage"]="User: " .$BlockedUserName." blocked Successfully";
    Redirect_to("Chat.php");
  }else {
    $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
    Redirect_to("Chat.php");
}}
?>
