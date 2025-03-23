<?php

  require "db/db.php";
  require "controllers/user_controller.php";
  session_start();

  

  $controller = new UserController($pdo, $key);

  if($_SERVER["REQUEST_METHOD"] === "POST"){

    if($_POST["action"] === "register"){

      $fname = $_POST["fname"];
      $lname = $_POST["lname"];
      $email = $_POST["email"];
      $birthdate = $_POST["birthdate"];
      $birthdate = date("Y-m-d",strtotime(str_replace("/","-", $birthdate)));
      $username = $_POST["username"];
      $password = $_POST["password"];
      $confirmpass = $_POST["confirmpassword"];
      
      echo $controller->registerUser($fname, $lname, $birthdate, $email, $username, $password, $confirmpass);
        
    }
  }

?>