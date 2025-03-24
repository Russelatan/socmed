<?php
  session_start();

  if(!isset($_SESSION["user"])){
    header("location: login/login.php");
    exit;
  }

  echo $_SESSION["user"]["id"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <header>
    <section class="header-searchbar"></section>
    <section class="header-nav"></section>
    <section class="header-user-menu"></section>
  </header>
  <main>
    <section class="main-menu">
      <form action="" class="logout-form">
        <input type="hidden" name="action" value="logout">
        <input type="submit" value="Log Out">
      </form>
    </section>
    <section class="main-newsfeed">
      <div class="main-newsfeed-create">
        <form class="post-form" action="" enctype="multipart/form-data">
          <input type="hidden" name="action" value="create_post">
          <input type="hidden" name="user_id" value=<?php echo $_SESSION["user"]["id"]?>>
          <input type="text" name="content" placeholder="Post something. . ." value="">
          <input type="file" name="post_image[]" multiple value="">
          <input type="submit" value="Submit Post">
        </form>
        <div class="main-newsfeed">

        </div>
      </div>
    </section>
    <section class="main-contacts"></section>
  </main>
</body>
<script src="../javascript/post/post.js"></script>
<script src="../javascript/login_signup/login_signup.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</html>