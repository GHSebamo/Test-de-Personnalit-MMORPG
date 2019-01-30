<?php
	$action=$_GET['action'];
	if ($action=='ModifierQuestion')
		$quest_id=htmlspecialchars($quest->getIdQuestion());
	else 
		$quest_id=ModelQuestion::getIdMax()+1;
	$cat_id=htmlspecialchars($quest->getIdCategorie());
	$quest_texte=htmlspecialchars($quest->getTexte());
	
echo '<form method="post" action="?action=';
	if ($action=='ModifierQuestion')
		echo 'updatedQuestion';
	else 
		echo 'createdQuestion';
	echo '">
	<fieldset class=fieldCreate>';
		if ($action=='ModifierQuestion')
			echo '<legend> Modifier Une Question :</legend>';
		else
			echo '<legend> Créer Une Question :</legend>';
		echo '
		<p> L\'id de la question : '.$quest_id .'
		<input type="hidden" value="'.$quest_id.'" id="id_question" name="idquestion" >
		</p>
		<p> Sa catégorie :';
		require File::build_path(array('view','Admin','Categories','selectcat.php'));
		
		echo '</p>
		<p>
			<label for="texte_question"> Son texte : </label>
			<input type="text" value="'.$quest_texte.'" name="texte" id="texte_question" required />
		</p>
		<p>
		<input type="submit" value="Valider" />
		</p>
	</fieldset>
</form>';
?>