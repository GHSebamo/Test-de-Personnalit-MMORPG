<select id="role" name="role">
<?php
	foreach(ModelRole::getAllRole()as $role){
		echo '<option value="'.$role->getNom().'"';
		if($_GET['action']=='ModifierAffectation'&&$role==$affect->getRole()){
			echo 'selected="selected"';
		}

		echo '>'.$role->getNom().'</option>';
	}
?>
</select>