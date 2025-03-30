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

    public function getposts($last_id){
      $limit = 3;

      $posts = select_query($this->pdo, "p.post_id, 
                                                         p.user_id, 
                                                         aes_decrypt(u.profile_image, 'secret') as profile_image, 
                                                         aes_decrypt(u.fname, 'secret') as fname, 
                                                         aes_decrypt(u.lname, 'secret') as lname, 
                                                         aes_decrypt(p.content, 'secret') as content , 
                                                         group_concat(aes_decrypt(pi.directory, 'secret')) as directory, 
                                                         p.created_at", 
                                                 "post p left join users as u on p.user_id = u.id 
                                                         left join post_images as pi on p.post_id = pi.post_id", 
                                             "WHERE p.post_id < :LAST_ID 
                                                         group by p.post_id 
                                                         order by p.created_at desc
                                                         LIMIT $limit", 
                                       [":LAST_ID" => $last_id], 
                                              true);

      if(!$posts){
        return json_encode(["status" => "error", 
                                  "message" => "no posts found"]);
      }

      $last_id = end($posts)["post_id"];

      return json_encode(["status" => "success", 
                                 "posts" => $posts,
                                 "last_id" => $last_id]);

    }

    public function getrecentposts(){
      $limit = 3;

      $posts = select_query($this->pdo, "p.post_id, 
                                                         p.user_id, 
                                                         aes_decrypt(u.profile_image, 'secret') as profile_image, 
                                                         aes_decrypt(u.fname, 'secret') as fname, 
                                                         aes_decrypt(u.lname, 'secret') as lname, 
                                                         aes_decrypt(p.content, 'secret') as content , 
                                                         group_concat(aes_decrypt(pi.directory, 'secret')) as directory, 
                                                         p.created_at", 
                                                 "post p left join users as u on p.user_id = u.id 
                                                         left join post_images as pi on p.post_id = pi.post_id 
                                                         group by p.post_id 
                                                         order by p.created_at desc", 
                                             "LIMIT $limit", 
                                       [], 
                                              true);

      if(!$posts){
        return json_encode(["status" => "error", 
                                 "message" => "no posts found"]);
      }

      $last_id = end($posts)["post_id"];

      return json_encode(["status" => "success", 
                                 "posts" => $posts,
                                 "last_id" => $last_id]);

    }

    public function getpost($post_id){

      $post = select_query($this->pdo, "p.post_id, 
                                                        p.user_id, 
                                                        aes_decrypt(u.profile_image, 'secret') as profile_image,
                                                        AES_DECRYPT(u.fname, 'secret') as fname, 
                                                        AES_DECRYPT(u.lname, 'secret') as lname, 
                                                        AES_DECRYPT(p.content, 'secret') as content, 
                                                        group_concat(AES_DECRYPT(pi.directory, 'secret')) as directory, 
                                                        p.created_at",
                                                "post p left join users as u on p.user_id = u.id
                                                        left join post_images as pi on p.post_id = pi.post_id",
                                            "WHERE p.post_id = :post_id 
                                                        group by p.post_id",
                                      [":post_id" => $post_id],
                                             false);

      if (!$post){
        return ["status" => "error",
                "message" => "Content not Available"];
      }

      return ["status" => "success",
              "message" => "post retrieved",
              "post" => $post];
      
    }


  }



?>