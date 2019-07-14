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
      <!-- START HEADER -->
      <header class="bg-dark text-white py-5">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
            Who we are
Our website address is: johnrthurlby.info/wordpress.

What personal data we collect and why we collect it
Comments
When visitors leave comments on the site we collect the data shown in the comments form, and also the visitor’s IP address and browser user agent string to help spam detection.

An anonymized string created from your email address (also called a hash) may be provided to the Gravatar service to see if you are using it. The Gravatar service privacy policy is available here: https://automattic.com/privacy/. After approval of your comment, your profile picture is visible to the public in the context of your comment.

Media
If you upload images to the website, you should avoid uploading images with embedded location data (EXIF GPS) included. Visitors to the website can download and extract any location data from images on the website.

Contact forms
Cookies
If you leave a comment on our site you may opt-in to saving your name, email address and website in cookies. These are for your convenience so that you do not have to fill in your details again when you leave another comment. These cookies will last for one year.

If you visit our login page, we will set a temporary cookie to determine if your browser accepts cookies. This cookie contains no personal data and is discarded when you close your browser.

When you log in, we will also set up several cookies to save your login information and your screen display choices. Login cookies last for two days, and screen options cookies last for a year. If you select “Remember Me”, your login will persist for two weeks. If you log out of your account, the login cookies will be removed.

If you edit or publish an article, an additional cookie will be saved in your browser. This cookie includes no personal data and simply indicates the post ID of the article you just edited. It expires after 1 day.

Embedded content from other websites
Articles on this site may include embedded content (e.g. videos, images, articles, etc.). Embedded content from other websites behaves in the exact same way as if the visitor has visited the other website.

These websites may collect data about you, use cookies, embed additional third-party tracking, and monitor your interaction with that embedded content, including tracking your interaction with the embedded content if you have an account and are logged in to that website.

Analytics
Who we share your data with
How long we retain your data
If you leave a comment, the comment and its metadata are retained indefinitely. This is so we can recognize and approve any follow-up comments automatically instead of holding them in a moderation queue.

For users that register on our website (if any), we also store the personal information they provide in their user profile. All users can see, edit, or delete their personal information at any time (except they cannot change their username). Website administrators can also see and edit that information.

What rights you have over your data
If you have an account on this site, or have left comments, you can request to receive an exported file of the personal data we hold about you, including any data you have provided to us. You can also request that we erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative, legal, or security purposes.

Where we send your data
Visitor comments may be checked through an automated spam detection service.

Your contact information
Additional information
How we protect your data
What data breach procedures we have in place
What third parties we receive data from
What automated decision making and/or profiling we do with user data
Industry regulatory disclosure requirements
              <h1 class="text-center"><i  style="color:#696f72;"></i>My First Blog Page in PHP</h1>
            </div> <!-- END CONTAINER -->
          </div> <!-- END COL -->
        </div> <!-- END ROW -->
      </header> <!-- END HEADER -->
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
