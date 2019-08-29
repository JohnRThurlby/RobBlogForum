<?php require_once("Includes/DB.php"); ?>

<?php
function Redirect_to($New_Location){
  header("Location:".$New_Location);
  exit;
}

function CheckUserNameExistsOrNot($UserName){
  global $ConnectingDB;
  $sql    = "SELECT * FROM admins WHERE username=:userName";
  $stmt   = $ConnectingDB->prepare($sql);
  $stmt->bindValue(':userName',$UserName);
  $stmt->execute();
  $Result = $stmt->rowcount();
  if ($Result==1) {
    return true;
  }else {
    return false;
  }
}

function CheckForumUserExists($UserNme){
  global $ConnectingDB;
  $sql  = "SELECT * FROM user WHERE username=:userName";
  $stmt = $ConnectingDB->prepare($sql);
  $stmt->bindValue(':userName',$UserNme);
  $stmt->execute();
  $Result = $stmt->rowcount();
  if ($Result==1) {
    return true;
  }else {
    return false;
  }
}

function GetForumUserName($QuestUserId){
  global $ConnectingDB;
  $sql    = "SELECT * FROM user WHERE user_id=:userId LIMIT 1";
  $stmt   = $ConnectingDB->prepare($sql);
  $stmt->bindValue(':userId',$QuestUserId);
  $stmt->execute();
  $Result = $stmt->rowcount();
  if ($Result==1) {
    return $Found_Name=$stmt->fetch();
  }else {
    return null;
  }
}
function GetSubTopicName($SubId){
  global $ConnectingDB;
  $sql    = "SELECT * FROM subtopic WHERE subtopic_id=:subId LIMIT 1";
  $stmt   = $ConnectingDB->prepare($sql);
  $stmt->bindValue(':subId',$SubId);
  $stmt->execute();
  $Result = $stmt->rowcount();
  if ($Result==1) {
    return $Found_SubName=$stmt->fetch();
  }else {
    return null;
  }
}

function Login_Attempt($UserName,$Password){
  global $ConnectingDB;
  $sql = "SELECT * FROM admins WHERE username=:userName AND passwrd=:passWord LIMIT 1";
  $stmt = $ConnectingDB->prepare($sql);
  $stmt->bindValue(':userName',$UserName);
  $stmt->bindValue(':passWord',$Password);
  $stmt->execute();
  $Result = $stmt->rowcount();
  if ($Result==1) {
    return $Found_Account=$stmt->fetch();
  }else {
    return null;
  }
}

function ForumLogin_Attempt($UserName,$PassWord){
  $PassEncrypt = sha1($PassWord);
  global $ConnectingDB;
  $sql = "SELECT * FROM user WHERE username='$UserName' AND password='$PassWord'";
  $stmt = $ConnectingDB->prepare($sql);
  $stmt->execute();
  $Result = $stmt->rowcount();
  if ($Result==1) {
    return $Found_Account=$stmt->fetch();
  }else {
    return null;
  }
}

function Confirm_Login(){
if (isset($_SESSION["UserId"])) {
  return true;
}  else {
  $_SESSION["ErrorMessage"]="Login Required !";
  Redirect_to("Login.php");
}
}

function Confirm_Forumlogin(){
  if (isset($_SESSION["UserId"])) {
    return true;
  }  else {
    $_SESSION["ErrorMessage"]="Login Required !";
    Redirect_to("Forumlogin.php");
  }
  }

function TotalPosts(){
  global $ConnectingDB;
  $sql = "SELECT COUNT(*) FROM posts";
  $stmt = $ConnectingDB->query($sql);
  $TotalRows= $stmt->fetch();
  $TotalPosts=array_shift($TotalRows);
  echo $TotalPosts;
}

function TotalCategories(){
  global $ConnectingDB;
  $sql = "SELECT COUNT(*) FROM category";
  $stmt = $ConnectingDB->query($sql);
  $TotalRows= $stmt->fetch();
  $TotalCategories=array_shift($TotalRows);
  echo $TotalCategories;
}

function TotalAdmins(){

  global $ConnectingDB;
  $sql = "SELECT COUNT(*) FROM admins";
  $stmt = $ConnectingDB->query($sql);
  $TotalRows= $stmt->fetch();
  $TotalAdmins=array_shift($TotalRows);
  echo $TotalAdmins;

}

function TotalComments(){
  global $ConnectingDB;
  $sql = "SELECT COUNT(*) FROM comments";
  $stmt = $ConnectingDB->query($sql);
  $TotalRows= $stmt->fetch();
  $TotalComments=array_shift($TotalRows);
  echo $TotalComments;
}

function TotalQuestions($SubTopicId){
  global $ConnectingDB;
  $sql = "SELECT COUNT(*) FROM question WHERE subtopic_id = $SubTopicId";
  $stmt = $ConnectingDB->query($sql);
  $TotalRows= $stmt->fetch();
  $TotalQuest=array_shift($TotalRows);
  return $TotalQuest;
}

function ApproveCommentsAccordingtoPost($PostId){
  global $ConnectingDB;
  $sqlApprove = "SELECT COUNT(*) FROM comments WHERE post_id='$PostId' AND status='ON'";
  $stmtApprove =$ConnectingDB->query($sqlApprove);
  $RowsTotal = $stmtApprove->fetch();
  $Total = array_shift($RowsTotal);
  return $Total;
}

function DisApproveCommentsAccordingtoPost($PostId){
  global $ConnectingDB;
  $sqlDisApprove = "SELECT COUNT(*) FROM comments WHERE post_id='$PostId' AND status='OFF'";
  $stmtDisApprove =$ConnectingDB->query($sqlDisApprove);
  $RowsTotal = $stmtDisApprove->fetch();
  $Total = array_shift($RowsTotal);
  return $Total;
}

function ReformDateTime(){
  date_default_timezone_set("America/New_York");
  $CurrentTime=time();
  $FormatdateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
  return $FormatdateTime;
}
 ?>
