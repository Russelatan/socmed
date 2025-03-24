<?php
  session_start();

  if(!isset($_SESSION['user'])){
    header("location: login/login.php");
    echo $_SESSION['user'];
    exit;
  }

  // echo $_SESSION["user"]["id"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/home.css?v=1.0.1">
  <title>Document</title>
</head>
<body>
  <header>
    <section class="header-searchbar">
      <form action="">
        <input type="text">
        <input type="submit" value="Search">
      </form>
    </section>
    <section class="header-nav">

    </section>
    <section class="header-main-menu">
      <form action="" class="logout-form">
        <input type="hidden" name="action" value="logout">
        <input type="submit" value="Log Out">
      </form>
    </section>
  </header>
  <main>
      <aside class="aside-home main-content">
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
      <section class="main-newsfeed-create main-content">
        <form class="post-form" action="" enctype="multipart/form-data">
          <input type="hidden" name="action" value="create_post">
          <input type="hidden" name="user_id" value=<?php echo $_SESSION["user"]["id"]?>>
          <input type="text" name="content" placeholder="Post something. . ." value="">
          <input type="file" name="post_image[]" multiple value="">
          <input type="submit" value="Submit Post">
        </form>
        <div class="post-newsfeed">
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
              <img src="../assets/post_images/profile.jpg" alt="postimage" class="postimage">
            </div>
          </div>
        </div>



                <div class="post-newsfeed">
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
              <img src="../assets/post_images/profile.jpg" alt="postimage" class="postimage">
            </div>
          </div>
        </div>
      </section>
      <aside class="contact-section main-content">
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