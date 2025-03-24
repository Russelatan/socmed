<?php
require "model/user.php";

class UserController {

  private $user_model;
  private $pdo;
  public function __construct($pdo, $key){
    $this->pdo = $pdo;
    $this->user_model = new User($this->pdo, $key);
  }

  public function registerUser($fname, $lname, $birthdate, $email, $username, $password, $confirmpass){
    
    $check_user_exist = select_query($this->pdo, 
                                "username", 
                                "users", 
                                "where username = :username OR email = AES_ENCRYPT(:email, 'secret')", 
                                [":username" => $username,
                                                  ":email" => $email]);

    if ($check_user_exist){
      return json_encode(["status" => "error",
                                  "message" => "Username or Email already been used!"]);
    }                                         

    if (!($password === $confirmpass)){
      return json_encode(["status" => "error",
                                  "message" => "Password and Confirm password doesn't match!"]);
    }

    return $this->user_model->register($fname, $lname, $birthdate, $email, $username, $password);
  }


  public function loginUser($username, $password){

    return $this->user_model->getUser($username, $password);
  }
}




?>