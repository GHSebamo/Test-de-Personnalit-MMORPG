<?php
echo '<form method="post" action="routeurAdmin.php">
		<div id=adminCon>
		<fieldset id=adm>
			<legend class=fieldLeg> Administrateur login </legend>
			<p>
				<label for="num_password">LE MOT DE PASSE </label>
				<input type="password" name="motdepasse" id="num_password" required />
			</p>
			<p>
				<input type="hidden" name="action" value="connection">
				<input type="submit" value="Valider mdp Admin">
			</p>
		</fieldset>
		</div>
	</form>

';
?>