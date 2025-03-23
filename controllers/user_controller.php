<?php

require "../db/db.php";
require "../model/user.php";

class UserController {

  private $user_model;
  private $pdo;


  public function __construct($pdo, $key){
    $this->pdo = $pdo;
    $this->user_model = new User($this->pdo, $key);
  }

  public function registerUser($name, $birthdate, $email, $username, $password, $confirmpass){
    

    // if (empty($name) || empty($birthdate) || empty($email) || empty($username) || empty($password) || empty($confirmpass)){

    // }

    $check_user_exist = select_query($this->pdo, 
                                "username", 
                                "users", 
                                "where username = :username OR email = AES_ENCRYPT(:email, 'secret')", 
                                [":username" => $username,
                                                  ":email" => $email]);

    if (!$password === $confirmpass){
      return json_encode(["status" => "error",
                                  "message" => "Password and Confirm password doesn't match!"]);
    }

    $this->user_model->register($name, $birthdate, $email, $username, $password);
  }
}




?>