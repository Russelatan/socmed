<?php
  session_start();

  if(!isset($_SESSION['user'])){
    header("location: login/login.php");
    echo $_SESSION['user'];
    exit;
  }

<<<<<<< HEAD
  // echo $_SESSION["user"]["id"];

=======
>>>>>>> b1e8b40929fda2a922142d934e70fd0709050684
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/home.css">
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
<<<<<<< HEAD
          <input type="file" name="post_image[]" multiple>
          <input type="submit" value="Submit Post" class="submit-postbtn">
=======
          <input type="file" name="post_image[]" multiple value="">
          <input type="submit" value="Submit Post">
>>>>>>> b1e8b40929fda2a922142d934e70fd0709050684
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