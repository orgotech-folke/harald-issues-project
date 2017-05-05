<?php 
echo "<form action ='inputs/projektskapare.php' method='post' style='float:left;' class='projectcreator'>
Namn:<input type='text' name='name' value='".$_SESSION['name']."'readonly><br>
Projektnamn:<input type='text' name='projectname'><br>
Kod:<textarea name='code'></textarea><br>
<input type='submit' value='skapa projekt'>    
</form>";
?>