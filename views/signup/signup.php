<?php
  require "../../db/db.php";
  session_start();

  
  // $result =  select_query($pdo, "AES_DECRYPT(email, 'secret') as email, AES_DECRYPT(name, 'secret') as name", "users", "where username = :username or email = AES_ENCRYPT(:email, 'secret')", [":username" => 'admin1',
  //                                                                                                                                                                                                                                           ":email" => "admin1@gmail.com"]);
  // if(!$result){
  //   echo "not found";
  // }
  // else{
  //   echo "<div> $result[name] </div>";
  //   echo "<div> $result[email] </div>";
  // }
  

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="" class="signup-form">
    <input type="text" name="name" class="name" required placeholder="Name" autocomplete="name">
    <input type="date" name="birthdate" class="birthdate" required placeholder="Birthdate" autocomplete="bday">
    <input type="text" name="email" class="email" required placeholder="Email" autocomplete="email">
    <input type="text" name="username" class="username" required placeholder="Username" autocomplete="username">
    <input type="password" name="password" class="password" required placeholder="Password">
    <input type="password" name="confirmpassword" class="password" required placeholder="Confirm password">
    <input type="hidden" name="action" value="register">
    <input type="submit" value="Create Account">
  </form>
  <script src="../../javascript/login_signup/login_signup.js"></script>
</body>
  
</html>