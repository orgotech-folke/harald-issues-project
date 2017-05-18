<?php
session_start();

if(!(isset($_SESSION['name'])) || !(isset($_SESSION['password'])))
{
    header("Location: index.php");
}
if(isset($_SESSION['formnr']) || isset($_SESSION['getproblem']))
{
    $_SESSION['formnr'] = null;
    $_SESSION['getproblem'] = null;
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectsissues";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if(!(isset($_SESSION['project'])))
{
    ###Kollar vilket projekt som användaren tryckte på läs mer
    if(isset($_GET['formnummer']))
    {
        $_SESSION['formnummer'] = $_GET['formnummer'];
    }
       $formnr = $_SESSION['formnummer'];
       $max = mysqli_query($conn, "SELECT MAX(id) as MAX FROM projects");
       $row = mysqli_fetch_object($max);
       $max = $row->MAX;
       for($i = $max; $i > 0; $i--)
       {
           $tempproject = "project".$i;
           if($i == $formnr)
           {
               $_SESSION['project'] = $_GET[$tempproject]; 
               $_SESSION['tempproject'] = $tempproject;
           }
       }
}
$projectname = $_SESSION['project'];
?>
<html>
    <head>
        <title><?php echo $_SESSION['name'];?></title>
        <link href="styles/css.css" rel="stylesheet">
    </head>
    <body>
        <h2><a href='kontosida.php'>Tillbaka</a></h2>
        <div class="wrapper">
            <div class="header">
                <h1>Orgotech</h1>
                <h2>Problem till <?php echo $_SESSION['project'];?></h2>
            </div>
            <?php  
            ###Skriver ut koden
            $resulta = mysqli_query($conn, "SELECT CODE,NAME FROM projects WHERE PROJECTNAME = '".$projectname."'");
            $htmlcode = "No code found";
            $rowa = mysqli_fetch_object($resulta);
            $htmlcode = htmlspecialchars($rowa->CODE);
            echo "<div class='content'><textarea id='code' style='resize: none;' id='inp' readonly>$htmlcode</textarea></div><button class='submit' onclick='toggleEditable()'><h4 id='submitbutton'>Redigera</h4></button><div id='rslt'></div>";
            if($rowa->NAME == $_SESSION['name']){
                include 'inputs/problemform.php';
            }
            ?>
            <?php
            $counter = 0;
            echo "<table cellspacing = '0'>";
                $result = mysqli_query($conn, "SELECT * FROM issues WHERE PROJECTNAME ='".$_SESSION['project']."'");
                while($row = mysqli_fetch_object($result))
                {   
                    $counter++;
                    $problem = $row->PROBLEM;
                    $projectname = $row->PROJECTNAME;
                    echo "<tr>
                    <td class='state'>";if($row->FIXED == 0){echo "<div class='open'>";}else if($row->FIXED == 1){echo "<div class='closed'>";}echo "</div></td>
                    <td>".$row->NAME."</td>
                    <td>".$row->PROJECTNAME."</td>
                    <td>".$row->PROBLEM."</td>
                    <td>
                    <form action='problemsite.php' method='get'>
                    <input type='hidden' name='formnr' value='$counter'>
                    <input type='hidden' name='problem".$counter."' value='".$problem."'>
                    <input type='hidden' name='".$_SESSION['tempproject']."' value='".$projectname."'>
                    <input type='submit' class='submit' value='Läs mer'></form>
                    </td></tr>";
                }
            echo "</table>";
            ?>
        </div>
    </body>
    <script src="scripts/edit.js"></script>
</html>