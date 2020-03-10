<?php
    $title = "Millhouse";
    include("db/db.php");
    include("classes/posts.php");
    include("header.php");
    include("views/comments.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Millhouse</title>
</head>
<body>


<div class="startsida">

        <?php

        session_start(); // Måste börja skriva session_start() när man ska använda SESSION-variablar.

        // Ifall fel lösen/användarnamn skrivs in
        if (isset($_GET['err']) && $_GET['err'] == true) {
            echo "<h1>VAFAN HÅLLER DU PÅ MED????? DU HAR SKRIVIT FEL!</h1>";
        }

echo $_SESSION['Username'];
        // Ifall användaren lyckats logga in.
        if (isset($_SESSION['Username'])) {
            echo "<blink><h1 class='welcome'>Välkommen " . $_SESSION['Username'] . "</h1></blink>";
            echo '<a href="views/logout.php">Logga ut</a>';
        } else {
            // Visar loginformuläret.
            include('views/loginForm.php');
            echo '<a href="views/signupForm.php"><h4>Registrera användare</h4></a>';
            //ok
        
        }
        ?>

    </div>

<?php 

$page = (isset($_GET['page'])) ? $_GET['page'] : "";

if($page == "about"){
  include("about.php");
} elseif ($page == "login"){
  include("login.php");
} else{
  echo "<p>Hej och välkommen hit!</p>";
}

?>

<form method="GET" action="index.php">
<input type="search" name="search_query">
<input type="submit" value="Sök">
</form>
<br />
<hr />

<!-- EDIT -->



<!-- SÖK -->
<?php
    if (isset($_GET['search_query'])) {
        $searchQuery = $_GET['search_query'];

        // Starta ordning:
        $order = "desc";
        if(isset($_GET['order']) && $_GET['order'] == "ascending") {
            $order = "asc";
        }

        // Ändrar vi från '%$searchQuery% till '%:searchQuery% så kan vi binda :searchQuery till en variabel senare
        $query = "SELECT id, name, message, date_posted FROM posts WHERE name LIKE '%$searchQuery%' OR message LIKE '%$searchQuery%' ORDER BY date_posted $order";
        
        $sth = $dbh->prepare($query);
        $queryParam = '%' . $searchQuery . '%';
        $sth->bindParam(':searchQuery', $searchQuery);

        $return = $sth->execute();

        // $rows = $dbh->query($query);

        if (!$return) {
            print_r($dbh->errorInfo());
            die;
        }

        echo "<h2>Sökresultat</h2> Vi hittade ". $sth->rowCount() ." inlägg på sökordet $searchQuery<hr />";
        echo 
        '<a href="index.php">Hem</a><br>
        Sortering: <a href="index.php?search_query=' . $searchQuery . '&order=ascending">Stigande</a> | <a href="index.php?search_query=' . $searchQuery . '&order=descending">Fallande</a><br /><hr />';

        while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {

            echo "<b>Name:</b>". $row["name"]."<br>";
            echo "<b>Message:</b>". $row["message"]."<br>";
            echo "<b>Date posted:</b>". $row["date_posted"]."<br>";
            echo "<a href='views/handlePost.php?action=delete&id=". $row['id'] . "'>Delete</a>";
            echo "<hr />";
        }
?>

<?php

    } else {
?>

Sortering:
<a href="index.php?order=ascending">Stigande</a> |
<a href="index.php?order=descending">Fallande</a>
<br />
<hr />

<?php

// Ersätter kod för sortering

$Posts = new GBPost($dbh);

// argument för sortering i vår query
if(isset($_GET['order']) && $_GET['order'] == "ascending") {
    $Posts->order = "asc";
}

$Posts->fetchAll();

// Loop som hämtar alla rader i Posts
foreach( $Posts->getPosts() as $post ) {
    echo "<b>Name:</b>". $post["name"]."<br>";
    echo "<b>Message:</b>". $post["message"]."<br>";
    echo "<b>Date posted:</b>". $post["date_posted"]."<br>";
    echo "<a href='views/handlePost.php?action=delete&id=". $post['id'] ."'>Delete</a>";
    echo "<br />";
    echo "<a href='views/handlePost.php?action=edit&id=" . $post['id'] . "'>Edit</a>";
    echo "<hr />";
    echo "<form method='POST' action='views/handleComments.php'>
    <input type='hidden' name='id' value='".$post['id']."'>
    <input type='hidden' name='name' value='".$_SESSION['Username']."'>
    <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
    <textarea name='message'></textarea><br>
    <button type='submit' name='commentSubmit'>Comment</button>
    </form>";
    getComments($dbh, $post['id']);
}

?>

<form method="POST" action="views/handlePost.php">

    Namn: <br />
    <input type="text" name="name" required><br />
    <br />
    Meddelande: <br />
    <textarea name="message" id="textarea" cols="60" rows="10" required></textarea><br />
    <input type="submit" value="Skicka">

</form>
    
<?php
    }
?>

<?php 
include("footer.php");
?>

</body>
</html>