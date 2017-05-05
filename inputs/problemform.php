<?php 
echo "<form action ='inputs/problemskapare.php' method='post' style='float:left;' class='projectcreator'>
<input type='hidden' name='name' value='".$_SESSION['name']."'><br>
<input type='hidden' name='projectname' value='".$projectname."'><br>
Problem:<input type='text' name='problem'><br>
Beskrivning:<textarea name='desc'></textarea><br>
<input type='submit' value='skapa problem'>    
</form>".$_SESSION['name']. " " .$projectname;
?>