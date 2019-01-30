<?php	

	if($utilmoyen){
		echo'<h3>Moyennement les utilisateur ont ce résultat:</h3>
				<table style="width:100%"> <tr><th>Champion</th><th>Coach</th><th>Collaborateur</th><th>Leader</th><th>Membre</th><th>Mercenaire</th><th>Officier</th><th>Solitaire</th><th>Troll</th></tr>
		';
		echo '<tr><th>'.round($utilmoyen->getResChampion(),3).'</th><th>'.round($utilmoyen->getResCoach(),3).'</th><th>'.round($utilmoyen->getResCollaborateur(),3).'</th><th>'.round($utilmoyen->getResLeader(),3).'</th><th>'.round($utilmoyen->getResMembre(),3).'</th><th>'.round($utilmoyen->getResMercenaire(),3).'</th><th>'.round($utilmoyen->getResOfficier(),3).'</th><th>'.round($utilmoyen->getResSolitaire(),3).'</th><th>'.round($utilmoyen->getResTroll(),3).'</th></tr></table>'.'<br><h3> Nombre d\'utilisateurs Total et par Role:</h3><table style="width:100%"><tr><th></th><th>Champion</th><th>Coach</th><th>Collaborateur</th><th>Leader</th><th>Membre</th><th>Mercenaire</th><th>Officier</th><th>Solitaire</th><th> Total</th></tr>'.'<tr><td class=roles>Role principal</td><th>'.$tabUtilrolemax['Champion'].'</th><th>'.$tabUtilrolemax['Coach'].'</th><th>'.$tabUtilrolemax['Collaborateur'].'</th><th>'.$tabUtilrolemax['Leader'].'</th><th>'.$tabUtilrolemax['Membre'].'</th><th>'.$tabUtilrolemax['Mercenaire'].'</th><th>'.$tabUtilrolemax['Officier'].'</th><th>'.$tabUtilrolemax['Solitaire'].'</th><th>'.$tabUtilrolemax['nbutil'].'</th></tr>'.'<tr><td class=roles>Role secondaire</td><th>'.$tabUtil2rolemax['Champion'].'</th><th>'.$tabUtil2rolemax['Coach'].'</th><th>'.$tabUtil2rolemax['Collaborateur'].'</th><th>'.$tabUtil2rolemax['Leader'].'</th><th>'.$tabUtil2rolemax['Membre'].'</th><th>'.$tabUtil2rolemax['Mercenaire'].'</th><th>'.$tabUtil2rolemax['Officier'].'</th><th>'.$tabUtil2rolemax['Solitaire'].'</th><th>'.$tabUtil2rolemax['nbutil'].'</th></tr></table>';
}
else {
	echo "Pour l'instant il n'y a aucun résultat.";
}
?>