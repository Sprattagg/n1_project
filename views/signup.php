<?php
include('includes/myDB.php');

$username = $_POST['user_name'];
$password = md5($_POST['password']); // md5() krypterar med md5-kryptering. Bra för lösen etc.


// SQL-Queries
$query = "INSERT INTO users(username, password) VALUES ('$username', '$password');";
$getquery = "SELECT Id, username, password FROM Users WHERE username='$username' AND password='$password' OR username='$username';";

 


// Ställer fråga till DB + sätter resultatet i $result
$dataFromDB = $dbh->query($getquery);
$result = $dataFromDB->fetchAll();



//Kolla ifall användaren redan finns i databasen:

// Får vi 0 rader tillbaka från vår DB så betyder det att användaren ej finns.
if(!count($result) == 0){
    // Skickar tillbaka till signupForm.php med en hårdkodad GET-variabel.
    header("location:signupForm.php?error=true");
    
} else{
    // Matar in i DB om användaren ej finns.
    $insertToDB = $dbh->query($query);

    if(!$insertToDB){
        // Ifall det av någon anledning inte går att lägga till i DB:
        echo "någonting blev galet!";
    } else {
        // Skicka vidare till startsida.
        header("location:index.php");
    }
}