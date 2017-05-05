<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectsissues";

if(!(isset($_SESSION['name'])) && !(isset($_SESSION['password']))){
    if(!(isset($_POST['name'])) && !(isset($_POST['password']))){
        $_SESSION['message'] = "Skriv in allt tack";
        header("Location: index.php");
    }
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['password'] = $_POST['password'];
}

$conn = mysqli_connect($servername, $username, $password, $dbname);
$account = mysqli_query($conn, "SELECT ID FROM accounts WHERE NAME ='".$_SESSION['name']."' AND PASSWORD ='".$_SESSION['password']."'");
$row = mysqli_fetch_object($account);
if($row->ID < 1){
    $_SESSION['message'] = "Användarnamnet existerar inte".$row->ID;
    header("Location: index.php");
}
?>
<html>
    <head>
        <title><?php echo $_SESSION['name'];?></title>
        <link href="styles/css.css" rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <h1><?php echo "Välkommen ". $_SESSION['name'] . "<a href='utloggning.php'>Logga ut</a>";?></h1>
            <h1>Dina projekt</h1>
            <?php include 'inputs/projektform.php';?>
            <?php
            $max = mysqli_query($conn, "SELECT MAX(id) as MAX FROM projects");
            $row = mysqli_fetch_object($max);
            $max = $row->MAX;
            $counter = -1;
            for($i = $max; $i > 0; $i--)
            {
                $counter++;
                $result = mysqli_query($conn, "SELECT * FROM issues WHERE id = $i");
                while($row = mysqli_fetch_object($result))
                {
                    $problem = $row->PROBLEM;
                    $projectname = $row->PROJECTNAME;
                    $resulta = mysqli_query($conn, "SELECT CODE FROM projects WHERE PROJECTNAME = '".$projectname."'");
                    $rowa = mysqli_fetch_object($resulta);
                    $htmlcode = htmlspecialchars($rowa->CODE);
                    echo "<div class='issue'><table cellspacing = '5'>
                    <tr>
                    <td class='state'><div class='open'></div></td>
                    <td>".$row->NAME."</td>
                    <td>".$row->PROJECTNAME."</td>
                    <td>".$row->PROBLEM."</td>
                    <td>
                    <form action='problemsite.php' method='post'>
                    <input type='hidden' name='problem".$counter."' value='".$problem."'>
                    <input type='hidden' name='project".$counter."' value='".$projectname."'>
                    <input type='submit'value='Läs mer'>
                    </td></tr></table></div>
                    <div class='inlagg'>
                    <div class='header'><h1>".$projectname."</h1><div class='content'><pre>$htmlcode</pre>
                    </div></div></div>";
                    $resultb = mysqli_query($conn, "SELECT * FROM comments WHERE ISSUE = '".$row->PROBLEM."'");
                    while($rowb = mysqli_fetch_object($resultb))
                    {
                        echo "<div class='comment'>
                        <h1>Kommentarer</h1>
                        <b>Av:".$rowb->NAME."</b><br><br>
                        <p>$rowb->COMMENT</p><br></div>";
                    }
                }
            }
            ?>
        </div>
    </body>
</html>