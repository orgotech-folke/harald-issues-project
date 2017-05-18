<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectsissues";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$result = mysqli_query($conn,"UPDATE `issues` SET `FIXED`= 1 WHERE PROBLEM = '".$_SESSION['getproblem']."'");

header('Location: ../problemsida.php')

?>