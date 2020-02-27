<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
    <?php 
    if(empty($title)){
        echo "Hej!";
    }else{
        echo$title;
    }
    ?>
    </title>
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <script src="js/main.js"></script>
</head>

<body>
<h1>Super cool blog for Millhouse</h1>

|

<a href="index.php">Start</a> |
<a href="index.php?page=about">Om Oss</a> |
<a href="views/startsida.php">Logga in</a>


<br />
<br />