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
                          "fname, lname, birthdate, email, username, password",
                        "AES_ENCRYPT(:fname, :key), AES_ENCRYPT(:lname, :key), AES_ENCRYPT(:birthdate, :key), AES_ENCRYPT(:email, :key), :username, :password",
                        [":fname" => $fname,
                                        ":lname" => $lname,
                                        ":birthdate" => $birthdate,
                                        ":email" => $email,
                                        ":username" => $username,
                                        ":password" => $hashed,
                                        ":key" => $key]);

      return json_encode(["status" => "success",
                                "message" => "Account created successfully"]);
      
    }

  }


?>