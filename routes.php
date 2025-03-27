<?php

  require "db/db.php";
  require "controllers/user_controller.php";
  require "controllers/post_controller.php";
  session_start();
  

  if($_SERVER["REQUEST_METHOD"] === "POST"){

    $controller = new UserController($pdo, $key);
    $post_controller = new PostController($pdo, $key);

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

      $user_id = $_POST["user_id"];
      $content = $_POST["content"];

      if(!isset($_FILES["post_image"]) || $_FILES["post_image"]["error"][0] == 4){
        $image = null;
      }
      else{
        $image = $_FILES["post_image"];
      }
      
      $user = $_SESSION["user"];
      echo $post_controller->create($content, $image, $user_id);
    }

    if ($_POST["action"] === "read_post"){
      $page = isset($_POST['page']) ? (int)$_POST["page"] : 1;
      $last_id = $_POST["last_id"];
      
      echo $_POST["last_id"] != 0 ? $post_controller->getposts($last_id) : $post_controller->getrecentposts();
      
    }
  }

?>