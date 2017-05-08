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
        $name = mysql_real_escape_string($_POST['name']);
        $comment = mysql_real_escape_string($_POST['comment']);
        $issue = mysql_real_escape_string($_POST['issue']);
        mysqli_query($conn, "INSERT INTO comments (ISSUE, NAME, COMMENT) VALUES ('".$issue."','".$name."','".$comment."')");
        mysqli_close($conn);
        header("Location: problemsite.php");
    }
    else
    {
        $_SESSION['message'] = "Skriv in allt tack!";
    }
?>