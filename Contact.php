<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>

<?php
// Initialize variables to null.
$NameError="";
$Name_good = false;
$EmailError="";
$Email_good = false;
$WebsiteError="";
$Website_good = false;
$EmailConclusion = "";

//On Submitting form, below function will execute
//Submit Scope starts from here
if(isset($_POST['Submit'])){
	
 if(empty($_POST["Name"])){
$NameError="Name is Required";
 }
 else{
$Name=Test_User_Input($_POST["Name"]);
// check Name only contains letters and whitespace
if(!preg_match("/^[A-Za-z\. ]*$/",$Name)){
$NameError="Only Letters and white sapace are allowed";
}
  else {$Name_good = true;}
 }
  if(empty($_POST["Email"])){
$EmailError="Email is Required";
 }
 else{
$Email=Test_User_Input($_POST["Email"]);
// check if e-mail address syntax is valid or not
if(!preg_match("/[a-zA-Z0-9._-]{3,}@[a-zA-Z0-9._-]{3,}[.]{1}[a-zA-Z0-9._-]{2,}/",$Email))
{
$EmailError="Invalid Email Format";
}
else {$Email_good = true;}
}
  
  if(empty($_POST["Website"])){
$WebsiteError="Website is Required";
 }
 else{
$Website=Test_User_Input($_POST["Website"]);
 // check Website address syntax is valid or not

if(!preg_match("/(https:|http:|ftp:)\/\/+[a-zA-Z0-9.\-_\/?\$=&\#\~`!]+\.[a-zA-Z0-9.\-_\/?\$=&\#\~`!]*/",$Website)){
$WebsiteError="Invalid Webside Address Format";	
}
else {$Website_good = true;}
}
$Comment=Test_User_Input($_POST["Comment"]);

if($Name_good && $Email_good && $Website_good)

{
/*echo "<h2>Your Submit Information</h2> <br>";
echo "Name:".ucwords ($_POST["Name"])."<br>";
echo "Email: {$_POST["Email"]}<br>";
echo "Website: {$_POST["Website"]}<br>";
echo "Comments: {$_POST["Comment"]}<br>";*/
$emailTo="johnrthurlby@gmail.com";
 $subject="Contact Form";
 $body=" A person name : ".$_POST["Name"]." With the Email : ".$_POST["Email"].
 " have website of: ".$_POST["Website"].
 " Added Comment :: ".$_POST["Comment"];
 $Sender="From:{$_POST["Email"]}";
     if (mail($emailTo, $subject, $body, $Sender)) {
          $EmailConclusion = "Mail sent successfully!";
          $FormatdateTime = ReformDateTime();
          $Source = 2;
          // Query to insert new email in DB When everything is fine
            $ConnectingDB;
            $sql = "INSERT INTO emails(email,sender,website,comment,email_source,datetime)";
            $sql .= "VALUES(:emailSender,:senderName,:webSite,:comment,:source,:dateTime)";
            $stmt = $ConnectingDB->prepare($sql);
            $stmt->bindValue(':emailSender',$Email);
            $stmt->bindValue(':senderName',$Name);
            $stmt->bindValue(':webSite',$Website);
            $stmt->bindValue(':comment',$Comment);
            $stmt->bindValue(':source',$Source);
            $stmt->bindValue(':dateTime',$FormatdateTime);
            $Execute=$stmt->execute();
            if($Execute){
              $_SESSION["SuccessMessage"] = "added Successfully";
              //Redirect_to("Contact.php");
            }else {
              $_SESSION["ErrorMessage"]= "Something went wrong. Try Again !";
             // Redirect_to("Contact.php");
            }
            
          } else {
            $EmailConclusion = "Mail not sent!";
          }
}else{
	$EmailConclusion = "Please Complete & Correct your Form & Try Again";
}
}//Submit Scope  Ends here
//Function to get and throw data to each of the field final varriable like Name / Gender etc.
function Test_User_Input($Data){
	return $Data;
}

//php code ends here
?>

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
		<style type="text/css">
		input[type="text"],input[type="email"],textarea{
			border:  1px solid dashed;
			background-color: rgb(221,216,212);
			width: 600px;
			padding: .5em;
			font-size: 1.0em;
		}
		.Error{
			color: red;
		}
		</style>

  </head>  <!-- end head -->
<body>
  <!-- NAVBAR -->
  <?php require("navbar.php"); ?>

<!-- HEADER -->
<header class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-11">
          <h1 class="text-center"><i class="fas fa-envelope-square" style="color:#27aae1;"></i> Contact Us</h1>
          </div>
        </div>
      </div>
    </header>
    <!-- HEADER END -->

    <section class="container py-2 mb-4">
  <div class="row">
    <div class="offset-lg-2 col-lg-10" style="min-height:400px;">
   
      
      <form  action="Contact.php" method="post"> 

<fieldset>
Name:<br>
<input class="input" type="text" Name="Name" value="">
<span class="Error">*<?php echo $NameError;  ?></span><br>	 
E-mail:<br>
<input class="input" type="text" Name="Email" value="">
<span class="Error">*<?php echo $EmailError; ?></span><br>
Website:<br>
<input class="input" type="text" Name="Website" value="">
<span class="Error">*<?php echo $WebsiteError; ?></span><br>
Comment:<br>
<textarea Name="Comment" rows="5" cols="25"></textarea>
<br>
<br>
<input type="Submit" Name="Submit" value="Submit Your Information">
   <br>
   <span class="Error"><?php echo $EmailConclusion; ?></span><br>

   </fieldset>
</form>
<legend>* Required Fields.</legend>	
	

      
    </div>
  </div>

</section>



      <!-- FOOTER -->
      <?php require("footerblog.php"); ?>

    </footer> <!-- END FOOTER -->
    <script>   
      $('#year').text(new Date().getFullYear());
    </script>   <!-- end script -->
        
  </body>    <!-- END BODY -->
</html> <!-- END HTML -->
