<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php

if(isset($_GET["id"])){

  date_default_timezone_set("America/New_York");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);  
 
  $ChatId = $_GET["id"];
 
  global $ConnectingDB;
  $sql = "DELETE FROM chat WHERE chat_id = $ChatId";
  $stmt = $ConnectingDB->prepare($sql);
  
  $Execute=$stmt->execute();
  if($Execute){
      
    $sql = "DELETE FROM chatmaster WHERE chat_id = $ChatId";
    $stmt = $ConnectingDB->prepare($sql);
  
    $Execute=$stmt->execute();
    if($Execute){
      $_SESSION["SuccessMessage"]="Messages deleted Successfully";
      Redirect_to("Chat.php");
    }
    else {
        $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
        Redirect_to("Chat.php");
    }
  }else {
    $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
    Redirect_to("Chat.php");
}}
?>
