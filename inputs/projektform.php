<?php 
echo "<form action ='inputs/projektskapare.php' method='post' class='projectcreator'><input type='hidden' name='name' value='".$_SESSION['name']."'>
<h3>Projektnamn:</h3><input type='text' name='projectname'><br><br>
<h3>Kod:</h3><textarea name='code'></textarea><br><br><br>
<input type='submit' class='submit' value='skapa projekt'>    
</form>";
?>