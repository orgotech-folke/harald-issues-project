<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectsissues";
$conn = mysqli_connect($servername, $username, $password, $dbname);
?>
<html>
    <head>
        <meta charset="utf-8">
        <link href="styles/css.css" rel="stylesheet">
        <title>harald-issues-projekt</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="inlagg">
                <div class="header">
                    <?php
                    ###Kollar vilket inlägg som användaren tryckte på läs mer
                    $max = mysqli_query($conn, "SELECT MAX(id) as MAX FROM projects");
                    $row = mysqli_fetch_object($max);
                    $max = $row->MAX;
                    for($i = $max; $i > 0; $i--)
                    {
                        $tempproblem = "problem".$i;
                        $tempproject = "project".$i;
                        if(isset($_POST[$tempproject]) && isset($_POST[$tempproblem]))
                        {
                            $project = $tempproject;
                            $problem = $tempproblem;
                        }
                    }
                    ?>
                </div>
                <?php     
                ###Skriver ut problemet och kommentarer under
                $result = mysqli_query($conn, "SELECT * FROM issues WHERE PROBLEM = '".$_POST[$problem]."'");
                $row = mysqli_fetch_object($result);
                $projectname = $row->PROJECTNAME;
                echo "<div class='issue'><table cellspacing = '5'>
                <tr>
                <td class='state'>";
                if($row->FIXED){echo "<div class='closed'></div>";}else{echo "<div class='open'></div>";}
                echo "</td>
                <td>".$row->NAME."</td>
                <td>".$row->PROJECTNAME."</td>
                <td>".$row->PROBLEM."</td>
                </tr></table>"; 
                $resulta = mysqli_query($conn, "SELECT CODE FROM projects WHERE PROJECTNAME = '".$projectname."'");
                $htmlcode = "No code found";
                while($rowa = mysqli_fetch_object($resulta)){
                    $htmlcode = htmlspecialchars($rowa->CODE);
                };
                echo "<div class='inlagg'><div class='header'><h1>".$row->PROJECTNAME."</h1><div class='content'><pre>$htmlcode</pre></div></div></div>";
                ?>
                            <?php include 'inputs/problemform.php';?>
            </div>
        </div>
    </body>
</html>