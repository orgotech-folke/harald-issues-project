<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectsissues";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if(isset($_POST['name']) && isset($_POST['projectname']) && isset($_POST['code'])){
    $inserter = mysqli_query($conn, "INSERT INTO projects('projectname','name','code') VALUES (".$_POST['projectname'].",".$_POST['name'].",".$_POST['code'].")");
}
?>
<html>
    <body>
        <div class="wrapper">
        <form action ="projektskapare.php" method="post" style="float:left;" class="projectcreator">
            Namn:<input type="text" name="name" value="<?php echo $_SESSION['name']?>"readonly><br>
            Projektnamn:<input type="text" name="projectname"><br>
            Kod:<textarea name="code"></textarea><br>
            <input type="submit" value="skapa projekt">    
        </form>
        </div>
    </body>
</html>