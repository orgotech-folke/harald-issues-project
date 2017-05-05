<?php
    session_start();
    ###Kollar om allting är som det ska på hemsidan
    if(isset($_SESSION['message']) && $_SESSION['message'] != null){
        echo $_SESSION['message'];
        $_SESSION['message'] = null;
    }
    if (isset($_SESSION['name'])){
        header('Location: kontosida.php');
    }
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
            <h1>Problems</h1>
            <?php 
                    echo "<form method='POST' action='kontosida.php'>
                    Namn:<input type='text' name='name'>
                    Lösenord:<input type='password' name='password'>
                    <input type='submit' class='submit' value='logga in'> 
                    </form>";    
            ?>
            <?php
            $max = mysqli_query($conn, "SELECT MAX(id) as MAX FROM projects");
            $row = mysqli_fetch_object($max);
            $max = $row->MAX;
            for($i = $max; $i > 0; $i--)
            {        
                $result = mysqli_query($conn, "SELECT * FROM issues WHERE id = $i");
                while($row = mysqli_fetch_object($result))
                {
                    $projectname = $row->PROJECTNAME;
                    $problem = $row->PROBLEM;
                    echo "<div class='issue'><table cellspacing = '5'>
                    <tr>
                    <td class='state'><div class='open'></div></td>
                    <td>".$row->NAME."</td>
                    <td>".$row->PROJECTNAME."</td>
                    <td>".$row->PROBLEM."</td>
                    <td><form action='problemsite.php' method='post'><input type='hidden' name='problem' value='".$problem."'><input type='hidden' name='project' value='".$projectname."'><input type='submit'value='Läs mer'></td>
                    </tr></table>";
            ?>
            <?php 
                    $resulta = mysqli_query($conn, "SELECT CODE FROM projects WHERE PROJECTNAME = '".$projectname."'");
                    $htmlcode = "No code found";
                    while($rowa = mysqli_fetch_object($resulta)){
                        $htmlcode = htmlspecialchars($rowa->CODE);
                    };
                    echo "<div class='inlagg'><div class='header'><h1>".$row->PROJECTNAME."</h1><div class='content'><pre>$htmlcode</pre></div></div></div>";
                }
            }
            ?>
        </div>
    </body>
</html>