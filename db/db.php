<?php 

  $host = "localhost";
  $username = "root";
  $password = "";
  $key = "secret";

  $charset = "utf8mb4";

  
  $pdo = new PDO("mysql:host=$host", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  $createdb = "create database if not exists socmed";
  $createtableuser = "create table if not exists users (id int not null primary key auto_increment, 
                                                    profile_image varbinary(255),
                                                    fname varbinary(255),
                                                    lname varbinary(255),  
                                                    birthdate varbinary(255), 
                                                    email varbinary(255), 
                                                    username varchar(50), 
                                                    password varchar(255), 
                                                    created_at datetime DEFAULT CURRENT_TIMESTAMP, 
                                                    updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";

  $createtablepost = "create table if not exists post (post_id int not null auto_increment primary key, 
                                                       user_id int, 
                                                       content varbinary(255),
                                                       created_at datetime default current_timestamp,
                                                       updated_at datetime default current_timestamp on update current_timestamp)";

  $createtablepost_images = "create table if not exists post_images (id int not null auto_increment primary key,
                                                              post_id int,  
                                                              directory varbinary(255),
                                                              created_at datetime default current_timestamp,
                                                              updated_at datetime default current_timestamp on update current_timestamp)";
  $pdo->exec($createdb);
  $pdo->exec("use socmed");
  $pdo->exec($createtableuser);
  $pdo->exec($createtablepost);
  $pdo->exec($createtablepost_images);


  function select_query($pdo, $parameter, $table, $condition, $condition_input){
    $query = "select $parameter from $table $condition";
    $stmt = $pdo->prepare($query);
    $stmt->execute($condition_input);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }

  

  function insert_query($pdo, $table, $columns, $values_placeholder, $values_input){
    $query = "insert into $table ($columns) values ($values_placeholder)";
    $stmt = $pdo->prepare($query);
    $stmt->execute($values_input);
    return $pdo->lastInsertId();
  }


  // $create_admin = select_query($pdo, "username", "users", 'where username = :username', [":username" => "admin"] );
  // $password = password_hash("admin", PASSWORD_DEFAULT);
  
  // if (!$create_admin){
  //   insert_query($pdo, 
  //                 "users", 
  //                 "fname, lname, birthdate, email, username, password", 
  //                 "AES_ENCRYPT(:fname, 'secret'), 
  //                                     AES_ENCRYPT(:lname, 'secret'), 
  //                                     AES_ENCRYPT(:birthdate, 'secret'), 
  //                                     AES_ENCRYPT(:email, 'secret'), 
  //                                     :username, 
  //                                     :password",
  //                 [":fname" => 'admin',
  //                               ":lname" => 'admin',
  //                               ":birthdate" => "2025-12-12",
  //                               ":email" => "admin@gmail.com",
  //                               ":username" => "admin",
  //                               ":password" => $password]);
                                                                                                            
  // }

  

?>