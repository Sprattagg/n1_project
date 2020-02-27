<?php

// PHP settings
$host = "localhost";
$user = "root";
$pass = "";
$db = "database";


// Try = Försöka göra något (MAKE CONNECTION)
try {
    $dsn = "mysql:host=$host;dbname=$db;";
    $dbh = new PDO($dsn, $user, $pass);

// Catch = Vad ska vi göra när det blir fel?
// ON ERROR
} catch (PDOException $e) {
    // Hämtar felmeddelande från PDO
    echo "Error!" . $e->getMessage() . "<br>";
    die;
}
