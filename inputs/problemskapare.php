<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectsissues";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if(isset($_POST['name']) && isset($_POST['projectname']) && isset($_POST['problem']) && isset($_POST['desc']))
{
    $checker = mysqli_query($conn);
    if (!mysqli_query($conn,"INSERT INTO `issues`(`NAME`, `PROJECTNAME`, `PROBLEM`, `DESCRIBTION`) VALUES ('".$_POST['name']."','".$_POST['projectname']."','".$_POST['problem']."','".$_POST['desc']."')"))
    {
        echo("Error description: " . mysqli_error($conn));
    }else{
        header("Location: ../problemsite.php");
    }
}
else
{
    echo "Skriv in allt tack!";
}
?>