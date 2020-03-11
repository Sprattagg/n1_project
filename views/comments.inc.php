<?php

function deleteComments($dbh){
     if(isset($_POST['commentDelete'])){
     $cid = $_POST['cid'];
 
     $sql = "DELETE FROM comments WHERE id=$cid";
     $result = $dbh->query($sql);
     }
 }


function getComments($dbh, $post){
     deleteComments($dbh);
     $sql = "SELECT * FROM comments WHERE postId = $post";
     $result = $dbh->query($sql);
     while($row = $result->fetch()){
          echo "<div class='comment-box'><p>";
          echo $row['name']."<br>";
          echo $row['date_posted']."<br>";
          echo nl2br($row['message']);
          echo "</p></div>";
          echo 
          "<form class='delete-form' method='POST'>
          <input type='hidden' name='cid' value='".$row['id']."'>
          <button type='submit' name ='commentDelete' >Delete</button>
          </form>";
     }
}