<?php
session_start();
###Kollar om allting är som det ska på hemsidan
if(isset($_SESSION['message']) && $_SESSION['message'] != null){
    echo "<h2>".$_SESSION['message']."</h2>";
    $_SESSION['message'] = null;
}
if (isset($_SESSION['name']) && isset($_SESSION['password'])){
    header('Location: kontosida.php');
}
?>
<html>
    <head>
        <meta charset="utf-8">
        <link href="styles/css.css" rel="stylesheet">
        <title>Orgotech</title>
    </head>
    <body>
        <div class="wrapper">
            <div class="header">
                <h1>Orgotech</h1>
                <?php 
                echo "<form method='POST' action='kontosida.php'>
                Namn:<input type='text' name='name'>
                Lösenord:<input type='password' name='password'>
                <input type='submit' class='submit' value='logga in'> 
                </form>";    
                ?>
            </div>
        </div>
    </body>
</html>