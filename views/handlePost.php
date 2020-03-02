<?php

/* session_start() behövs ev för query på rad 51 ska funka

session_start();
$_SESSION['userId'] = 1;
$_SESSION['commentId'] = 2;
*/

include("../db/db.php");

// Ta bort och redigera inlägg och skicka tillbaka användaren

// = om den är satt och lika med delete körs det som står i blocket
if (isset($_GET['action']) && $_GET['action'] == "delete") {

$query = "DELETE FROM posts WHERE id=". $_GET['id'];
$return = $dbh->exec($query);

header ("location:../index.php");

}

/* FIXA EDIT!
else if (isset($_GET['action']) && $_GET['action'] == "edit") {

$query = "UPDATE posts SET name='$name', message='$message' WHERE id=". $_GET['id'];
$return = $dbh->exec($query);

} */

else {

// Felmeddelande för gästbok och tvinga användare att skriva något i fälten
$name    = (!empty($_POST['name']) ? $_POST['name'] : "");
$message = (!empty($_POST['message']) ? $_POST['message'] : "");

$errors = false;
$errorMessages = "";

if (empty ($name)) {
    $errorMessages .= "Du måste skriva ett namn <br />";
    $errors = true;
}

if (empty ($message)) {
    $errorMessages .= "Du måste skriva ett meddelande <br />";
    $errors = true;
}

if ($errors == true) {
    echo $errorMessages;
    echo '<a href="index.php">Gå tillbaka</a>';
    die;
}

// Mata in data i databasens tabeller
// lägg in '$1', '$2'); i query om det behövs för session_start()
$query = "INSERT INTO posts (name, message) VALUES('$name', '$message');";
$return = $dbh->exec($query);

if (!$return) {
    print_r($dbh->errorInfo());
} else {
    header("location:../index.php");
}

}

?>