<?php
  require "model/post.php";
  class PostController {

    private $post_model;
    private $pdo;

    public function __construct($pdo, $key){
      $this->pdo = $pdo;
      $this->post_model = new Post($pdo, $key);
    }

    public function create($content, $image, $user_id){
      
      return $this->post_model->create($content, $image, $user_id);

    }
  }


?>