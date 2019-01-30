<?php
if($cat_id){
	echo '<p> La Catégorie d\'id '.$cat_id.' a bien été supprimée.';
}
else echo "la catégorie 0 ne peut pas être supprimée";
require File::build_path(array('view','Admin','Categories','listecategorie.php'));
?>