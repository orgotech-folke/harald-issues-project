<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "projectsissues";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
?>
<html>
    <body>
        <h1>Comments</h1>
        <?php
            $result = mysqli_query($conn, "SELECT * FROM comments");
                while($row = mysqli_fetch_object($result))
                {
        ?>
        <div class="comment">
            <?php echo  "<b> By: " . $row->NAME . " </b> " . $row->DATETIME;?>
            <p>
                <?php echo $row->TEXT; ?>
            </p><br>
        </div>
        <?php
            }
        ?>
        <h1>Leave a comment:</h1>
        <form action="insertcomment.php" method="post">
            Name:<input type="text" name="name"><br><br>
            Comment:<textarea name="comment"></textarea><br><br>
            <input type="submit"/>
        </form>
    </body>    
</html>
