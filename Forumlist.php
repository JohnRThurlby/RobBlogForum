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
    
    <title>Forum Lists</title>

    <style media="screen">
  .heading{
      font-family: Bitter,Georgia,"Times New Roman",Times,serif;
      font-weight: bold;
       color: #005E90;
  }
  .heading:hover{
    color: #0090DB;
  }
  </style>

  </head>  <!-- end head -->

<body>
      <!-- NAVBAR -->
      <?php require("navbarblog.php");?> 

    <!-- HEADER -->
    <div class="container">
      <div class="row mt-4">

        <!-- Main Area Start-->
        <div class="col-sm-8 ">
          <h2>Nerdy Techie Forum in PHP</h2>
          <?php
           echo ErrorMessage();
           echo SuccessMessage();
           ?>
          <?php
          $ConnectingDB;
          // SQL query when Searh button is active
          if(isset($_GET["SearchButton"])){
            $Search = $_GET["Search"];
            $sql = "SELECT * FROM posts
            WHERE datetime LIKE :search
            OR title LIKE :search
            OR category LIKE :search
            OR post LIKE :search";
            $stmt = $ConnectingDB->prepare($sql);
            $stmt->bindValue(':search','%'.$Search.'%');
            $stmt->execute();
          }// Query When Pagination is Active i.e Blog.php?page=1
          elseif (isset($_GET["page"])) {
            $Page = $_GET["page"];
            if($Page==0||$Page<1){
            $ShowPostFrom=0;
          }else{
            $ShowPostFrom=($Page*5)-5;
          }
            $sql ="SELECT * FROM posts ORDER BY id desc LIMIT $ShowPostFrom,5";
            $stmt=$ConnectingDB->query($sql);
          }
          // Query When Category is active in URL Tab
          elseif (isset($_GET["category"])) {
            $Category = $_GET["category"];
            $sql = "SELECT * FROM posts WHERE category='$Category' ORDER BY id desc";
            $stmt=$ConnectingDB->query($sql);
          }

          // The default SQL query
          else{
            $sql  = "SELECT * FROM posts ORDER BY id desc LIMIT 0,3";
            $stmt =$ConnectingDB->query($sql);
          }
          while ($DataRows = $stmt->fetch()) {
            $PostId          = $DataRows["id"];
            $DateTime        = $DataRows["datetime"];
            $PostTitle       = $DataRows["title"];
            $Category        = $DataRows["category"];
            $Admin           = $DataRows["author"];
            $Image           = $DataRows["image"];
            $PostDescription = $DataRows["post"];
          ?>
          <div class="card">
            <img src="Uploads/<?php echo htmlentities($Image); ?>" style="max-height:450px;" class="img-fluid card-img-top" />
            <div class="card-body">
              <h4 class="card-title"><?php echo htmlentities($PostTitle); ?></h4>
              <small class="text-muted">Category: <span class="text-dark"> <a href="Blog.php?category=<?php echo htmlentities($Category); ?>"> <?php echo htmlentities($Category); ?> </a></span> & Written by <span class="text-dark"> <a href="Profile.php?username=<?php echo htmlentities($Admin); ?>"> <?php echo htmlentities($Admin); ?></a></span> On <span class="text-dark"><?php echo htmlentities($DateTime); ?></span></small>
              <span style="float:right;" class="badge badge-dark text-light">Comments:
                 <?php echo ApproveCommentsAccordingtoPost($PostId);?>
              </span>
              <hr>
              <p class="card-text">
                <?php if (strlen($PostDescription)>150) { $PostDescription = substr($PostDescription,0,150)."...";} echo htmlentities($PostDescription); ?></p>
              <a href="FullPost.php?id=<?php echo $PostId; ?>" style="float:right;">
                <span class="btn btn-info">Read More &rang;&rang; </span>
              </a>
            </div>
          </div>
          <br>
          <?php   } ?>
          <!-- Pagination -->
          <nav>
            <ul class="pagination pagination-lg">
              <!-- Creating Backward Button -->
              <?php if( isset($Page) ) {
                if ( $Page>1 ) {?>
             <li class="page-item">
                 <a href="Blog.php?page=<?php  echo $Page-1; ?>" class="page-link">&laquo;</a>
               </li>
             <?php } }?>
            <?php
            global $ConnectingDB;
            $sql           = "SELECT COUNT(*) FROM posts";
            $stmt          = $ConnectingDB->query($sql);
            $RowPagination = $stmt->fetch();
            $TotalPosts    = array_shift($RowPagination);
            // echo $TotalPosts."<br>";
            $PostPagination=$TotalPosts/5;
            $PostPagination=ceil($PostPagination);
            // echo $PostPagination;
            for ($i=1; $i <=$PostPagination ; $i++) {
              if( isset($Page) ){
                if ($i == $Page) {  ?>
              <li class="page-item active">
                <a href="Blog.php?page=<?php  echo $i; ?>" class="page-link"><?php  echo $i; ?></a>
              </li>
              <?php
            }else {
              ?>  <li class="page-item">
                  <a href="Blog.php?page=<?php  echo $i; ?>" class="page-link"><?php  echo $i; ?></a>
                </li>
            <?php  }
          } } ?>
          <!-- Creating Forward Button -->
          <?php if ( isset($Page) && !empty($Page) ) {
            if ($Page+1 <= $PostPagination) {?>
         <li class="page-item">
             <a href="Blog.php?page=<?php  echo $Page+1; ?>" class="page-link">&raquo;</a>
           </li>
         <?php } }?>
            </ul>
          </nav>
        </div>
        <!-- Main Area End-->

        <!-- Side Area Start -->
        <div class="col-sm-4">
          <div class="card mt-4">
            <div class="card-body">
              <img src="images/startblog.PNG" class="d-block img-fluid mb-3" alt="">
              <div class="text-center">
              What is a blog?
A blog is a type of website with posts (articles or entries) displayed in reverse chronological order. That is, the most recent posts are at the top.

Why start a blog?
There are many reasons to start a blog. Here are a few popular ones:

Make money while working from home. Many bloggers make money. It’s hard work, but it’s got low risk, low overhead and low barrier to entry.
Build a writing (or speaking) platform. It’s no secret book publishers rarely work with authors who don’t have an online presence. The reason is simple: it’s a lot easier to sell books to people who already know you. A blog is one of the easiest and most effective places to do it.
Get more exposure for your existing business or organization. A blog gives anyone, from individuals to large companies, the ability to reach a large number of people at very little cost.
Just write. If you want to write, share your story, encourage others and build a community, a blog is a great place to do that.
Simply put, a blog is an online home you own and control. Use it to develop the brand or reputation you desire, establish yourself as an authority in your field, connect with customers or find other like-minded people.
              </div>
            </div>
          </div>
          <br>
          <div class="card">
            <div class="card-header bg-dark text-light">
              <h2 class="lead">Sign Up !</h2>
            </div>
            <div class="card-body">
              <button type="button" class="btn btn-success btn-block text-center text-white mb-4" name="button"><a href="Forumregister.php" class="page-link"></a>Join the Forum</button>
              <button type="button" class="btn btn-danger btn-block text-center text-white mb-4" name="button">Login</button>
              <div class="input-group mb-3">
                <input type="text" class="form-control" name="" placeholder="Enter your email"value="">
                <div class="input-group-append">
                  <button type="button" class="btn btn-primary btn-sm text-center text-white" name="button">Subscribe Now</button>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="card">
            <div class="card-header bg-primary text-light">
              <h2 class="lead">Categories</h2>
              </div>
              <div class="card-body">
                <?php
                global $ConnectingDB;
                $sql = "SELECT * FROM category ORDER BY id desc";
                $stmt = $ConnectingDB->query($sql);
                while ($DataRows = $stmt->fetch()) {
                  $CategoryId = $DataRows["id"];
                  $CategoryName=$DataRows["title"];
                 ?>
                <a href="Blog.php?category=<?php echo $CategoryName; ?>"> <span class="heading"> <?php echo $CategoryName; ?></span> </a><br>
               <?php } ?>
            </div>
          </div>
          <br>
          <div class="card">
            <div class="card-header bg-info text-white">
              <h2 class="lead"> Recent Posts</h2>
            </div>
            <div class="card-body">
              <?php
              global $ConnectingDB;
              $sql= "SELECT * FROM posts ORDER BY id desc LIMIT 0,5";
              $stmt= $ConnectingDB->query($sql);
              while ($DataRows=$stmt->fetch()) {
                $Id     = $DataRows['id'];
                $Title  = $DataRows['title'];
                $DateTime = $DataRows['datetime'];
                $Image = $DataRows['image'];
              ?>
              <div class="media">
                <img src="Uploads/<?php echo htmlentities($Image); ?>" class="d-block img-fluid align-self-start"  width="90" height="94" alt="">
                <div class="media-body ml-2">
                <a style="text-decoration:none;"href="FullPost.php?id=<?php echo htmlentities($Id) ; ?>" target="_blank">  <h6 class="lead"><?php echo htmlentities($Title); ?></h6> </a>
                  <p class="small"><?php echo htmlentities($DateTime); ?></p>
                </div>
              </div>
              <hr>
              <?php } ?>
            </div>
          </div>

        </div>
        <!-- Side Area End -->


      </div>

    </div>

    <!-- HEADER END -->
<br>

    <!-- FOOTER -->
    <?php require("footerblog.php");?> 

  </body>    <!-- END BODY -->
</html> <!-- END HTML -->

