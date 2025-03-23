<?php

  require "controllers/user_controller.php";
  require "model/user.php";
  session_start();

  $name = $_POST["name"];
  $email = $_POST["email"];
  $birthdate = $_POST["birthdate"];
  $birthdate = date("Y-m-d",strtotime(str_replace("/","-", $birthdate)));
  $username = $_POST["username"];
  $password = $_POST["password"];
  $confirmpass = $_POST["confirmpassword"];

  $controller = new UserController($pdo, $key);


  if($_SERVER["REQUEST_METHOD"] === "POST"){

    if($_POST["action"] === "register"){

    }
  }

?>