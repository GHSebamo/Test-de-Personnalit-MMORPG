<?php
	echo '<p> La question à bien était modifié </p> 
	<p> Voici la nouvelle liste des questions: </p>';
	require File::build_path(array('view','Admin','Questions','listequestion.php'));
?>
