<?php
// Initialize variables to null.
$NameError="";
$Name_good = false;
$EmailError="";
$Email_good = false;
$WebsiteError="";
$Website_good = false;

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
if($Name_good && $Email_good && $Website_good)

{
echo "<h2>Your Submit Information</h2> <br>";
echo "Name:".ucwords ($_POST["Name"])."<br>";
echo "Email: {$_POST["Email"]}<br>";
echo "Website: {$_POST["Website"]}<br>";
echo "Comments: {$_POST["Comment"]}<br>";
$emailTo="johnrthurlby@gmail.com";
 $subject="Contact Form";
 $body=" A person name : ".$_POST["Name"]." With the Email : ".$_POST["Email"].
 " have website of: ".$_POST["Website"].
 " Added Comment :: ".$_POST["Comment"];
 $Sender="From:{$_POST["Email"]}";
     if (mail($emailTo, $subject, $body, $Sender)) {
                echo "Mail sent successfully!";
                    } else {
                                echo "Mail not sent!";
                    }
}else{
	echo '<span class="Error">* Please Complete & Correct your Form & Try Again *</span>';
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
    <script>   
      $('#year').text(new Date().getFullYear());
    </script>   <!-- end script -->

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
  <div style="height:10px; background:#696f72;"></div>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <a href="#" class="navbar-brand"> JOHNRTHURLBY.INFO</a>
          <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarcollapseCMS">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a href="MyProfile.php" class="nav-link"> <i class="fas fa-user text-success"></i> My Profile</a>
            </li>
            <li class="nav-item">
              <a href="Dashboard.php" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item">
              <a href="Posts.php" class="nav-link">Posts</a>
            </li>
            <li class="nav-item">
              <a href="Categories.php" class="nav-link">Categories</a>
            </li>
            <li class="nav-item">
              <a href="Admins.php" class="nav-link"><i class="fas fa-tasks"></i> Manage Admins</a>
            </li>
            <li class="nav-item">
              <a href="Comments.php" class="nav-link"><i class="fas fa-comments"></i> Comments</a>
            </li>
            <li class="nav-item">
              <a href="Blog.php?page=1" class="nav-link" target="_blank"><i class="fas fa-blog"></i> Live Blog</a>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a href="Logout.php" class="nav-link text-danger">
              <i class="fas fa-user-times"></i> Logout</a></li>
          </ul>
          </div>
        </div>
      </nav>
      <div style="height:10px; background:#deebf0;"></div>
      <!-- NAVBAR END -->
<?php ?>
<h2>Contact Us</h2>

<form  action="Contact.php" method="post"> 
<legend>* Please Fill Out the following Fields.</legend>			
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
   </fieldset>
</form>

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
                <a href="Contact.php" class="nav-link"><i class="fas fa-envelope-square"></i> Contact</a>
              </li> <!-- END CONTACT ITEM -->
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
        
  </body>    <!-- END BODY -->
</html> <!-- END HTML -->
