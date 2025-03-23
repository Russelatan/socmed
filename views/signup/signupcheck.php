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

  // $file = $_FILES["profile_image"];
  // $target_dir = "assets/profile_pics/";
      
  // $target_file = $target_dir . time() . "_" . basename($file["name"]);
  // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

  // // Check if the file is an image
  // $check = getimagesize($file["tmp_name"]);
  // if ($check === false) {
  //   return json_encode(["status" => "error",
  //                              "message" => "File is not an image."]);
  // }

  // // Allow only JPG, JPEG, PNG formats
  // $allowed_types = ["jpg", "jpeg", "png"];
  // if (!in_array($imageFileType, $allowed_types)) {
  //     return json_encode(["status" => "error",
  //                               "message" => "Only JPG, JPEG, and PNG files are allowed."]);
  // }

  // // Move the uploaded file to the "uploads" folder
  // if (!move_uploaded_file($file["tmp_name"], $target_file)) {
  //     return json_encode(["status" => "error",
  //                               "message" => "Error uploading file."]);
  // }
?>