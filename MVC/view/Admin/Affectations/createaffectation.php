<?php
echo '<form method="post" action="?action=createdAffectation&question_id='.$idquestion.'">';
echo '<fieldset class=fieldCreate>
<legend> Créer Une affectation :</legend>
<p>La question est : '. ModelQuestion::getQuestionById($idquestion)->getTexte().'</p>
<p>Le role  à affecté : ';
require File::build_path(array('view','Admin','Roles','selectrole.php'));
echo '</p>
<p>Si la réponse est :';
require File::build_path(array('view','Admin','Affectations','rowdecision.php'));
echo'</p>
<p>Valeur d\'affectation <input type="number" min ="0" id="vaffect" name="vaffect"  </p><p>
		<input type="submit" value="Valider" />
		</p>
	</fieldset>
</form>';

?>