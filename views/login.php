<?php
include('../db/db.php');

$userName = $_POST['user_name'];
$password = md5($_POST['password']);

$getquery = "SELECT Id, username, password FROM Users WHERE username='$userName' AND password='$password'";

$dataFromDB = $dbh->query($getquery);
$row = $dataFromDB->fetch(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<?php

// Ifall vårt svar från DB är tomt = finns ingen användare med den infon. 
if(empty($row)){
    //Skickar tillbaka till signupForm.php med en hårdkodad GET-variabel.
    header("location:startsida.php?err=true");
} else{
    echo "Du kan logga in";

    session_start();

    // Sparar användarnamn och lösen i SESSION-variabeln. Den är TYP som localstorage i JS. 
    $_SESSION['Username'] = $row['Username'];
    $_SESSION['Password'] = $row['Password'];

    header("location:startsida.php");

    

}





?>


</body>

</html>