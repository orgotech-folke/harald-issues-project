<?php
session_start();

if(!(isset($_SESSION['name'])) || !(isset($_SESSION['password'])))
{
        header("Location: index.php");
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectsissues";
$conn = mysqli_connect($servername, $username, $password, $dbname);
###Kollar vilket inlägg som användaren tryckte på läs mer
if(isset($_GET['formnr']))
{
    $_SESSION['formnr'] = $_GET['formnr'];
}
$formnr = $_SESSION['formnr'];
$max = mysqli_query($conn, "SELECT MAX(id) as MAX FROM projects");
$row = mysqli_fetch_object($max);
$max = $row->MAX;
for($i = $max; $i > 0; $i--)
{
    $tempproblem = "problem".$i;
    if($i == $formnr)
    {
        $_SESSION['problem'] = $tempproblem;                        
    }
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <link href="styles/css.css" rel="stylesheet">
        <title>harald-issues-projekt</title>
    </head>
    <body>
        <h2><a href='projektsida.php'>Tillbaka</a></h2>
        <div class="wrapper">
                <div class="header">
                    <h1>Orgotech</h1>
                    <h2><?php if(isset($_GET[$_SESSION['tempproject']])){echo $_GET[$_SESSION['tempproject']]; $_SESSION['getproject'] =$_GET[$_SESSION['tempproject']];}else{echo $_SESSION['getproject'];}?></h2>
                </div>
            <?php     
            ###Skriver ut problemet och koden
            if(isset($_GET[$_SESSION['problem']])){
                $_SESSION['getproblem'] = $_GET[$_SESSION['problem']];
            }
            $getproblem = $_SESSION['getproblem'];
            $projectname = $_SESSION['getproject'];
            $probdesc = mysqli_query($conn, "SELECT DESCRIBTION,NAME,FIXED FROM issues WHERE PROJECTNAME = '".$projectname."' AND PROBLEM ='".$getproblem."'");
            $probrow = mysqli_fetch_object($probdesc);
            if($probrow->NAME == $_SESSION['name'] && $probrow->FIXED == 0){
                echo "<h2><a href='inputs/issuecloser.php'>Stäng problem</a></h2>";
            }
            $resulta = mysqli_query($conn, "SELECT CODE FROM projects WHERE PROJECTNAME = '".$projectname."'");
            $htmlcode = "No code found";
            while($rowa = mysqli_fetch_object($resulta)){
                $htmlcode = htmlspecialchars($rowa->CODE);
            };
            echo "<h2>".$getproblem."</h2><p>".$probrow->DESCRIBTION."</p><div class='content'><pre>$htmlcode</pre></div><div class='commentfield'>     <h2>Kommentarer</h2>";
            ###Skriver ut alla kommentarer som finns för det problemet
            $result = mysqli_query($conn, "SELECT NAME, COMMENT, HELPFUL FROM comments WHERE ISSUE = '".$getproblem."'");
            while($row = mysqli_fetch_object($result))
            {
                if($row === null)
                {
                    echo "Inga kommentarer har kommit upp än";         
                }
                else
                {
                    echo "<div class='comment'><h3>Av: ".$row->NAME."</h3><br> <pre>".$row->COMMENT."</pre></div>"; 
                }
            }
            echo "<h2 class='commenttitle'>Kommentera på problemet</h2><form action='insertcomment.php' method='post'><input type='hidden' name='name' value='".$_SESSION['name']."'><input type='hidden' name='issue' value='".$getproblem."'><input type='hidden' value='".$_SESSION['getproject']."'name='project'>Kommentar:<textarea name='comment'></textarea><br><br><input class='submit' type='submit'/></form></div>";
            ?>
        </div>
    </body>
</html>