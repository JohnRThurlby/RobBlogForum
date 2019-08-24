<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php
if(isset($_GET["id"])){
  $SearchQueryParameter = $_GET["id"];
  $QuestionId = $_GET["questid"];
  global $ConnectingDB;
  $sql = "UPDATE answer SET numberlike=(@cur_value := numberlike) + 1 WHERE answer_id='$SearchQueryParameter'";
  $Execute = $ConnectingDB->query($sql);
  if ($Execute) {
    $_SESSION["SuccessMessage"]="Like Successful! ";
    Redirect_to("QuestionDetails.php?id=$QuestionId");
    // 
  }else {
    $_SESSION["ErrorMessage"]="Something Went Wrong. Try Again !";
    Redirect_to("QuestionDetails.php?id=$QuestionId");
  }
}
?>
