<?php
	$action=$_GET['action'];
	if ($action=='ModifierCategorie')
		$cat_id=htmlspecialchars($cate->getIdCategorie());
	else 
		$cat_id=ModelCategorie::getIdMax()+1;
	$cat_texte=htmlspecialchars($cate->getTexte());
	
echo '<form method="post" action="?action=';
	if ($action=='ModifierCategorie')
		echo 'updatedCategorie';
	else 
		echo 'createdCategorie';
	echo '">
	<fieldset class=fieldCreate>';
		if ($action=='ModifierCategorie')
			echo '<legend> Modifier Une Catégorie :</legend>';
		else
			echo '<legend> Créer Une Catégorie :</legend>';
		echo '<p> L\'id de la catégorie : '.$cat_id .'
		<input type="hidden" value="'.$cat_id.'" id="id_categorie" name="id" ';
		if ($action=='ModifierCategorie'){
			echo 'readonly';
		}
		else {
			echo 'required';
		}
		echo '>
		</p>
		<p>
			<label for="texte_categorie"> Son texte : </label>
			<input type="text" value="'.$cat_texte.'" name="texte" id="texte_categorie" required />
		</p>
		<p>
		<input type="submit" value="Valider" />
		</p>
	</fieldset>
</form>';
?>