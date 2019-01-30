<select id="id_categorie" name="idcategorie">
<?php
	foreach(ModelCategorie::getAllCategorie()as $cat){
		echo '<option value="'.$cat->getIdCategorie().'"';
		if($_GET['action']=='ModifierQuestion'&&$cat_id==$cat->getIdCategorie()){
			echo 'selected="selected"';
		}

		echo '>'.$cat->getTexte().'</option>';
	}
?>
</select>