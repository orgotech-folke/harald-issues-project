<?php
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
                    echo "<div class='issue'><table cellspacing = '5'>
                    <tr>
                    <td class='state'><div class='open'></div></td>
                    <td>".$row->NAME."</td>
                    <td>".$row->PROJECTNAME."</td>
                    <td>".$row->PROBLEM."</td>
                    <td><form action='problemsite.php' method='post'><input type='hidden' name='project' value='".$projectname."'><input type='submit'value='Läs mer'></td>
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