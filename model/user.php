<?php

  class User {

    private $pdo;
    private $key;
    public function __construct($pdo, $key){

      $this->pdo = $pdo;
      $this->key = $key;

    }

    public function register($fname, $lname, $birthdate, $email, $username, $password){
      $pdo = $this->pdo;
      $key = $this->key;
      $hashed = password_hash($password, PASSWORD_DEFAULT); 

      insert_query($pdo, "users", 
                          "profile_image, fname, lname, birthdate, email, username, password",
                        "AES_ENCRYPT(:profile_image, :key), AES_ENCRYPT(:fname, :key), AES_ENCRYPT(:lname, :key), AES_ENCRYPT(:birthdate, :key), AES_ENCRYPT(:email, :key), :username, :password",
                        [":profile_image" => "assets/default.webp",
                                        ":fname" => $fname,
                                        ":lname" => $lname,
                                        ":birthdate" => $birthdate,
                                        ":email" => $email,
                                        ":username" => $username,
                                        ":password" => $hashed,
                                        ":key" => $key]);

      return json_encode(["status" => "success",
                                 "message" => "Account created successfully"]);
      
    }

    public function getUser($username, $password){
      $pdo = $this->pdo;
      $key = $this->key;
      $check_user_exist = select_query($pdo, 
                                "id, AES_DECRYPT(profile_image, :key), AES_DECRYPT(fname, :key), AES_DECRYPT(lname, :key), AES_DECRYPT(email, :key), password", 
                                "users", 
                                "where username = :username OR email = AES_ENCRYPT(:email, 'secret')", 
                                [":username" => $username,
                                                  ":email" => $username,
                                                  ":key" => $key]);

      if (!$check_user_exist){
        return json_encode(["status" => "error",
                                    "message" => "Invalid Username or Password!"]);
      }

      if ($check_user_exist && !password_verify($password, $check_user_exist["password"])){
        $_SESSION["user"] = $check_user_exist;
        return json_encode(["status" => "error",
                                    "message" => "Invalid Username or Password!"]);
      }
      $user = $check_user_exist;
      
      $_SESSION["user"] = $user;
      
      return json_encode(["status" => "success"]);
    }

  }


?>