<?php
echo '<form method="post" action="?action=updatedAffectation&question_id='.$id.'">';
echo '<fieldset>
<legend> Modifier Une affectation :</legend>
<p>La question est : '. ModelQuestion::getQuestionById($id)->getTexte().'</p>
<p>Le role affecté est '.$role.'<input type="hidden" value="'.$role.'" id="role" name="role" ></p>
<p>Si la réponse est '.$vrep.'<input type="hidden" value="'.$vrep.'" id="valeur_rep" name="vrep" ></p>
<p>Valeur d\'affectation <input type="number" value="'.$vaffect.'" id="vaffect" name="vaffect" required> </p><p>
		<input type="submit" value="Valider" />
		</p>
	</fieldset>
</form>';

?>