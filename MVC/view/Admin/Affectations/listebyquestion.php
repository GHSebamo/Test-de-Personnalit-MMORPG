<?php
if(ModelEtreaffecter::getAffectationByQuest($idquestion)){
			echo '<table style="width:100%"> <tr><th> Role Affecter </th> <th>Reponse</th><th> Valeur d\'Affectation</th><th>Action </th></tr>';
			foreach (ModelEtreaffecter::getAffectationByQuest($idquestion) as $affectation) {
				//$nomReponse=ModelReponse::getNomReponseByValeur($affectation['valeurrep']);
				echo '<tr><td class=questionAdmin>'.$affectation['roleaaffecter'].'</td><td class=questionAdmin>'.$affectation['valeurrep'].'</td><td class=questionAdmin>'.$affectation['valeuraffectation'].'</td><td class=questionAdmin><a class=questionAdmin href="?action=ModifierAffectation&question_id='.$affectation['idquestion'].'&roleaaffecter='.$affectation['roleaaffecter'].'&valeur_rep='.$affectation['valeurrep'].'&valeur_affectation='.$affectation['valeuraffectation'].'">Modifier</a><a class=questionAdmin href="?action=DeleteAffectation&question_id='.$affectation['idquestion'].'&roleaaffecter='.$affectation['roleaaffecter'].'&valeur_rep='.$affectation['valeurrep'].'" onclick="return confirm(\'Voulez vous vraiment supprimer ?\')"> Supprimer </a> </tr>';
			}
			echo '</table>';
		}
		else {echo 'Pas d\'affectation pour cette question';}
		if ($_GET['action']!="CreerNouvelleAffectation"){
			echo '<br><a class=questionAdmin href="?action=CreerNouvelleAffectation&question_id='.$idquestion.'">Créer une nouvelle affectation</a> ';
		}

?>