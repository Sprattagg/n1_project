<?php



function getComments($dbh, $post){
     $sql = "SELECT * FROM comments WHERE postId = $post";
     $result = $dbh->query($sql);
     while($row = $result->fetch()){
          echo "<div class='comment-box'><p>";
          echo $row['name']."<br>";
          echo $row['date_posted']."<br>";
          echo nl2br($row['message']);
          echo "</p></div>";
     }
     
     
}