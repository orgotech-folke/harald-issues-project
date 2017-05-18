<?php
session_start();

if(!(isset($_SESSION['name'])) || !(isset($_SESSION['password'])))
{
    $_SESSION['message'] = "Skriv in allt tack";
    $_SESSION['name'] = null;
    $_SESSION['password'] = null;
    header("Location: index.php");
}
if(isset($_SESSION['project']) || isset($_SESSION['problem']) || isset($_SESSION['formnr']) || isset($_SESSION['getproblem'])|| isset($_SESSION['problemproject']) ||isset($_SESSION['tempproject']))
{
    $_SESSION['project'] = null;
    $_SESSION['problem'] = null;
    $_SESSION['formnr'] = null;
    $_SESSION['getproblem'] = null;
    $_SESSION['problemproject'] = null;
    $_SESSION['tempproject'] = null;
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectsissues";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$account = mysqli_query($conn, "SELECT ID FROM accounts WHERE NAME ='".$_SESSION['name']."' AND PASSWORD ='".$_SESSION['password']."'");
$row = mysqli_fetch_object($account);
if($row === null)
{
    $_SESSION['message'] = "Användarnamnet existerar inte";
    $_SESSION['name'] = null;
    $_SESSION['password'] = null;
    header("Location: index.php");
}
if(isset($_POST['name']) && isset($_POST['password']))
{
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['password'] = $_POST['password'];
}
?>
<html>
    <head>
        <title><?php echo $_SESSION['name'];?></title>
        <link href="styles/css.css" rel="stylesheet">
    </head>
    <body>
        <h2><a href='utloggning.php'>Logga ut</a></h2>
        <div class="wrapper">
            <div class="header">
                <h1>Orgotech</h1>
                <h2>Tillgängliga projekt</h2>
            </div>
            <?php
            include 'inputs/projektform.php';
            $max = mysqli_query($conn, "SELECT MAX(id) as MAX FROM projects");
            $row = mysqli_fetch_object($max);
            $max = $row->MAX;
            $counter = 0;
            echo "<table cellspacing = '0'>";
            for($i = $max; $i > 0; $i--)
            {
                $result = mysqli_query($conn, "SELECT * FROM projects WHERE id = $i");
                while($row = mysqli_fetch_object($result))
                {   
                    $counter++;
                    $projectname = $row->PROJECTNAME;
                    echo "<tr>
                    <td>".$row->PROJECTNAME."</td>
                    <td>".$row->NAME."</td>                
                    <td>
                    <form action='projektsida.php' method='get'>
                    <input type='hidden' name='formnummer' value='$counter'>
                    <input type='hidden' name='project".$counter."' value='".$projectname."'>
                    <input type='submit' class='submit' value='Läs mer'></form>
                    </td></tr>";
                }
            }
            echo "</table>";
            ?>
        </div>
    </body>
</html>