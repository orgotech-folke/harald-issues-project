<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "projectsissues";

    $conn = mysqli_connect($servername,$username,$password,$dbname);

    if($conn->connect_error)
    {
        die("Connection failed: " . $conn->connect_error);
    }
    if(isset($_POST['comment']))
    {
        $date = date("l jS F Y h:i:s");
        $name = mysql_real_escape_string($_POST['name']);
        $comment = mysql_real_escape_string($_POST['comment']);
        mysqli_query($conn, "INSERT INTO comments (NAME, TEXT, DATETIME) VALUES ('$name','$comment','$date')");
        mysql_close($conn);
        header("Location: Post.php");
    }
    else
    {
        $_SESSION['message'] = "Skriv in allt tack!";
    }
?>