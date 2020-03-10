<?php
include ("../db/db.php");
 
    if(isset($_POST['commentSubmit'])){
         $name = $_POST['name'];
         $date = $_POST['date'];
         $message = $_POST['message'];
         $postID = $_POST['id'];
    
         $sql = "INSERT INTO comments (name, date_posted, message, postId) VALUES ('$name', '$date', '$message', '$postID')";
         $result = $dbh->query($sql);
         header("location:../index.php");
    }