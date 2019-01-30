<?php
	echo '<p> La catégorie à bien était modifié </p> 
	<p> Voici la nouvelle liste des catégories: </p>';
	require File::build_path(array('view','Admin','Categories','listecategorie.php'));
?>
