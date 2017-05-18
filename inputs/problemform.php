<?php 
echo "<h2 style='text-align:right;'>Skapa problem</h2><form action ='inputs/problemskapare.php' method='post' class='projectcreator'>
<input type='hidden' name='name' value='".$_SESSION['name']."'>
<input type='hidden' name='projectname' value='".$projectname."'>
<h3>Problemnamn:</h3><input type='text' name='problem'><br><br>
<h3>Beskrivning:</h3><textarea name='desc'></textarea><br><br><br>
<input type='submit' class='submit' value='skapa problem'>    
</form>";
?>