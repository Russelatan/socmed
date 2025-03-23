<?php
  require "../../db/db.php";
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../../assets/signup.css">
  <link rel="stylesheet" href="../../assets/styles.css">

</head>
<body>
  <form action="" class="signup-form">
    <input type="hidden" name="action" value="register">
    <div class="container" id="Names">
      <input type="text" name="fname" id="fname" class="name input" required placeholder="First name" autocomplete="name">
      <input type="text" name="lname" id="lname" class="name input" required placeholder="Surname" autocomplete="name">
    </div>
    <div class="container">
      <input type="text" name="email" class="email input" required placeholder="Email" autocomplete="email">
    </div>
    <div class="container">
      <input type="date" name="birthdate" class="birthdate input" required placeholder="Birthdate" autocomplete="bday">
    </div>

    <div class="container">
      <input type="text" name="username" class="username input" required placeholder="Username" autocomplete="username">
    </div>
    <div class="container">
      <input type="password" name="password" class="password input" required placeholder="Password">
    </div>
    <div class="container">
      <input type="password" name="confirmpassword" class="password input" required placeholder="Confirm password">
    </div>
    <div class="container">
      <input type="submit" value="Create Account" class="submitinput">
    </div>

  </form>
  <script src="../../javascript/login_signup/login_signup.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>
  
</html>