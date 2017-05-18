<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectsissues";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if(isset($_POST['name']) && isset($_POST['projectname']) && isset($_POST['code']))
{
    $_POST['code'] = str_replace("'"," ",$_POST['code']);
    $_POST['name'] = mysqli_real_escape_string($conn, $_POST['name']);
    if (!mysqli_query($conn,"INSERT INTO `projects`(`PROJECTNAME`, `NAME`, `CODE`) VALUES ('".$_POST['projectname']."','".$_POST['name']."','".$_POST['code']."')"))
    {
        echo("Error description: " . mysqli_error($conn));
    }else{
        header("Location: ../kontosida.php");
    }
}
else
{
    echo "Skriv in allt tack!";
}
?>