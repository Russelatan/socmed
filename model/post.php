<?php

  class Post {

    private $pdo;
    private $key;

    public function __construct($pdo, $key){
      $this->pdo = $pdo;
      $this->key = $key;
    }

    public function uploadimage($image, $post_id){

        

        foreach($image["name"] as $index => $attribute){
          // $file = $_FILES["profile_image"];
          $target_dir = "assets/post_images/";
          $tmpname = $image["tmp_name"][$index];
          $target_file = $target_dir . time() . "_" . basename($attribute);
          $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

          // Check if the file is an image
          $check = getimagesize($tmpname);
          if ($check === false) {
            return json_encode(["status" => "error",
                                      "message" => "File is not an image."]);
          }

          // Allow only JPG, JPEG, PNG formats
          $allowed_types = ["jpg", "jpeg", "png"];
          if (!in_array($imageFileType, $allowed_types)) {
              return json_encode(["status" => "error",
                                        "message" => "Only JPG, JPEG, and PNG files are allowed."]);
          }

          // Move the uploaded file to the "uploads" folder
          if (!move_uploaded_file($tmpname, $target_file)) {
              return json_encode(["status" => "error",
                                        "message" => "Error uploading file."]);
          }

          insert_query($this->pdo, "post_images", 
                                      "post_id, directory",   
                           ":post_id, AES_ENCRYPT(:directory, :key)",
                                 [":post_id" => $post_id,
                                                ":directory" => $target_file,
                                                ":key" => $this->key]);
        }
    }

    public function create($content, $image, $user_id){
      
      $post_id = insert_query($this->pdo, "post", 
                                             "user_id, content", 
                                  ":user_id, AES_ENCRYPT(:content, :key)", 
                                        [":user_id" => $user_id,
                                                       ":content" => $content,
                                                       ":key" => $this->key]);
      
      

      if (is_null($image)){
        return json_encode(["status" => "success",
                                   "message" => "Post uploaded successfully!"]);
      }

      $this->uploadimage($image, $post_id);

      return json_encode(["status" => "success",
                                 "message" => "Post uploaded successfully!"]);
      
    }
  }



?>