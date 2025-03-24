<?php

  require "db.php";


  if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $birthdate = $_POST["birthdate"];
    $birthdate = date("Y-m-d",strtotime(str_replace("/","-", $birthdate)));
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmpass = $_POST["confirmpassword"];

    if (!$check_user_exist){
      if ($password === $confirmpass){
        try {
          insert_query($pdo, "users", "name, 
                                                          birthdate, 
                                                          email, 
                                                          username, 
                                                          password", 
                                                          
                                      "AES_ENCRYPT(:name, 'secret'), 
                                                            AES_ENCRYPT(:birthdate, 'secret'), 
                                                            AES_ENCRYPT(:email, 'secret'), 
                                                            :username, 
                                                            :password", 

                                          [":name" => $name,
                                                          ":birthdate" => $birthdate,
                                                          ":email" => $email,
                                                          ":username" => $username,
                                                          ":password" => password_hash($password, PASSWORD_DEFAULT)]);
                                                          
          echo json_encode(["status" => "success",
                                   "message" => "Account Created Successfully!"]);
          exit;
        }
        catch(Exception $e){
          echo json_encode(["status" => "error",
                                   "message" => $e]);
          exit;
        }
      }
      else{
        try{
          echo json_encode(["status" => "error", "message" => "Password and Confirm password does not match."]);
          exit;
        }
        catch(Exception $e){
          echo json_encode(["status" => "error", "message" => $e]);
          exit;
        }
      }
    }
    else{
        try{
          echo json_encode(["status" => "error", "message" => "Username or Email already used."]);
          exit;
        }
        catch(Exception $e){
          echo json_encode(["status" => "error", "message" => $e]);
          exit;
        }
    }
  }


?>