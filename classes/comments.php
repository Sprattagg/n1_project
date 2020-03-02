GET:
<pre>
<?php
    print_r($_GET);
?>
</pre>
<hr />
POST:
<pre>
<?php
    print_r($_POST);
?>
</pre>
<hr />
SESSION:
<pre>
<?php
    session_start();
    print_r($_SESSION);
?>
</pre>



<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "database";

    // MAKE CONNECTION
    try {
        $dsn = "mysql:host=$host;dbname=$db;";
        $dbh = new PDO($dsn, $user, $pass);

    } catch(PDOException $e) {
        // ON ERROR
        echo "Error! ". $e->getMessage() ."<br />";
        die;
    }

    $min_sql_query = "INSERT INTO comments (id, userId, message) VALUES('{$_GET['post_id']}','{$_SESSION['userID']}','{$_POST['comment_to_save']}');";
    $result = $dbh->exec($min_sql_query);

    if($result) {
        echo "Kommentaren är kommenterad!";
    } else {
        echo "Något blev fel!";
    }

    ?>