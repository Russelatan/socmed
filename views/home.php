<?php
  session_start();

  if(!isset($_SESSION['user'])){
    header("location: login/login.php");
    // echo $_SESSION['user'];
    exit;
  }

  // echo $_SESSION["user"]["id"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/home.css?v=1.0.3">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <title>Document</title>
</head>
<body>
  
  <?php
    require "../view_template/header.php";
  ?>
  <main>
      <aside class="aside-home main-content">
        <!-- <div class="container-contact">
          <img src="../assets/profile_pics/default.webp" alt="profile-img" class="contact-img">
          <h1>Iquen Marba</h1>
          <p>Active now</p>
        </div>
        <div class="container-contact">
          <img src="../assets/profile_pics/default.webp" alt="profile-img" class="contact-img">
          <h1>Iquen Marba</h1>
          <p>Active now</p>
        </div> -->
        <a href="" class="aside-navs">Home</a>
        <a href="" class="aside-navs">Message</a>
        <a href="" class="aside-navs">notifications</a>
        <a href="" class="aside-navs">Settings</a>
        <a href="" class="aside-navs">Report</a>
        <a href="" class="aside-navs">Display</a>
        <a href="" class="aside-navs">Report</a>

      </aside>
      <section class="main-newsfeed main-content">
          <form class="post-form" action="" enctype="multipart/form-data">
            <input type="hidden" name="action" value="create_post">
            <input type="hidden" name="user_id" value=<?php echo $_SESSION["user"]["id"]?>>
            <input type="text" name="content" placeholder="Post something. . ." value="" class="input post">
            <!-- <input type="file" name="post_image[]" multiple value=""> -->
            <label for="file-upload" class="file-label">
              <i class="fa fa-image"></i>
            </label>
            <input type="file" id="file-upload" name="post_image[]" multiple class="file-input">
            <input type="submit" value="Submit Post" class="header-btn submit-post">

          </form>

          <form action="" class="main-read-post">
            <input type="hidden" name="action" value="read_post">
          </form>

        <div class="main-posts-container">
          
        </div>


        <!-- <div class="post-newsfeed">
          <div class="container-info-user">
            <img src="../assets/profile_pics/default.webp" alt="postprofile" class="contact-img">
            <h1>Iquen marba</h1>
            <p>Tuesday 1:48am</p>
          </div>
          <div class="container-info-post">
            <p class="caption-post">
              Lorem ipsum, dolor sit amet consectetur adipisicing elit. Repellat iure optio nulla quod nostrum veniam soluta tempore, sed eveniet labore perspiciatis ex quas et, nobis sit quasi! Totam, commodi officiis?
            </p>
            <div class="container-image-post">
              <img src="../assets/profile_pics/default.webp" alt="postimage" class="post-image">
            </div>
          </div>
        </div> -->

        
      </section>
      <aside class="contact-section main-content">
      <div class="container-contact">
          <img src="../assets/profile_pics/default.webp" alt="profile-img" class="contact-img">
          <h1>Iquen Marba</h1>
          <p>Active now</p>
        </div>
        <div class="container-contact">
          <img src="../assets/profile_pics/default.webp" alt="profile-img" class="contact-img">
          <h1>Iquen Marba</h1>
          <p>Active now</p>
        </div>
        <div class="container-contact">
          <img src="../assets/profile_pics/default.webp" alt="profile-img" class="contact-img">
          <h1>Iquen Marba</h1>
          <p>Active now</p>
        </div>
        <div class="container-contact">
          <img src="../assets/profile_pics/default.webp" alt="profile-img" class="contact-img">
          <h1>Iquen Marba</h1>
          <p>Active now</p>
        </div>
        <div class="container-contact">
          <img src="../assets/profile_pics/default.webp" alt="profile-img" class="contact-img">
          <h1>Iquen Marba</h1>
          <p>Active now</p>
        </div>
      </aside>
  </main>
</body>
<script src="../javascript/post/post.js"></script>
<script src="../javascript/login_signup/login_signup.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</html>