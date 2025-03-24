<?php

  require "db/db.php";
  require "controllers/user_controller.php";
  require "controllers/post_controller.php";
  session_start();
  

  if($_SERVER["REQUEST_METHOD"] === "POST"){

    $controller = new UserController($pdo, $key);

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

    if($_POST["action"] === "login"){
      $username = $_POST["username"];
      $password = $_POST["password"];
      echo $controller->loginUser($username, $password);
      exit;
    }

    if($_POST["action"] === "logout"){  
      session_unset();   
      session_destroy(); 

      echo json_encode(["status" => "success"]);
          
    }

    if($_POST["action"] === "create_post"){

      $post_controller = new PostController($pdo, $key);
      $user_id = $_POST["user_id"];
      $content = $_POST["content"];
      $image = $_FILES["post_image"];
      $user = $_SESSION["user"];
      echo $post_controller->create($content, $image, $user_id);
    }
  }

?>