<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div>
        <marquee behavior="alternate" direction="left" scrollamount="1" onbounce>
            <img src="sexappeal.jpg" width="200" height="200">
        </marquee>
    </div>


    <div>

        <?php

        session_start(); // Måste börja skriva session_start() när man ska använda SESSION-variablar.

        // Ifall fel lösen/användarnamn skrivs in
        if (isset($_GET['err']) && $_GET['err'] == true) {
            echo "<h1>VAFAN HÅLLER DU PÅ MED????? DU HAR SKRIVIT FEL!</h1>";
        }


        // Ifall användaren lyckats logga in.
        if (isset($_SESSION['Username'])) {
            echo "<blink><h1 class='welcome'>Välkommen " . $_SESSION['Username'] . "</h1></blink>";
            echo '<a href="logout.php">Logga ut</a>';
        } else {
            // Visar loginformuläret.
            include('loginForm.php');
            echo '<a href="signupForm.php"><h4>Registrera användare</h4></a>';
            //ok
        
        }
        ?>

    </div>

</body>

</html>