<?php
  require "../model/post.php";
  require "../db/db.php";

  $post_id = $_GET["id"];
  $postModel = new Post($pdo, $key);
  $result = $postModel->getpost($post_id);
  $post = $result["post"];

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../assets/home.css">
  <link rel="stylesheet" href="../assets/post.css">

</head>
<body>
  <?php
    require "../view_template/header.php";
  ?>
  <main>
    <?php
      echo "<div class='post-newsfeed post-container'>";
      echo  "<div class='container-info-user'>";
      echo    "<a href='user_profile.php?id={$post['user_id']}'>";
      echo      "<img class='contact-img' alt='post profile' src='../{$post['profile_image']}'>";
      echo      "<h1>{$post['fname']} {$post['lname']}</h1>";
      echo    "</a>";
      echo    "<p>{$post['created_at']}</p>";
      echo  "</div>";
      echo  "<div class='container-info-post'>";
      echo    "<div class='post-content-container'>";
      echo    "<p>{$post['content']}</p>";
      echo    "</div>";
    
      if ($post["directory"]){
    
        
        echo "<div class='container-image-post'>";
          if(strpos($post['directory'], ',') === false){
            echo "<img class='post-image' src='../{$post['directory']}' alt='post image'>";
          }
          else{
       
            $post["directory"] = explode(',', $post["directory"]);
            foreach($post['directory'] as $image){
              echo "<img class='post-image' src='../{$image}' alt='post image'>";
            }
          }
          
        echo "</div>";
      }
              
      echo "</div>";
      echo "</div>";
    ?>
  </main>
</body>
<script>
  document.addEventListener("DOMContentLoaded", () => {

    const logoutForm = document.querySelector(".logout-form");
    async function logout(e) {
      e.preventDefault();
      const formdata = new FormData(logoutForm);

      const response = await fetch("../routes.php", {
        method: "POST",
        body: formdata,
      });

      const data = await response.json();

      if (data.status === "success") {
        window.location.replace("../views/login/login.php");
      }
    }

    
    logoutForm.addEventListener("submit", logout);
  })

  
</script>
</html>