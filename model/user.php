<?php

  require "../db/db.php";

  class User {

    private $pdo;
    private $key;



    public function __construct($pdo, $key){

      $this->pdo = $pdo;
      $this->key = $key;

    }

    public function register($name, $birthdate, $email, $username, $password){
      $pdo = $this->pdo;
      $key = $this->key;
      $hashed = password_hash($password, PASSWORD_DEFAULT);

      insert_query($pdo, "users", 
                          "name, birthdate, email, username, password",
                        "AES_ENCRYPT(:name, :key), AES_ENCRYPT(:birthdate, :key), AES_ENCRYPT(:email, :key), :username, :password",
                        [":name" => $name,
                                        ":birthdate" => $birthdate,
                                        ":email" => $email,
                                        ":username" => $username,
                                        ":password" => $password,
                                        ":key" => $key]);
      
    }

  }


?>