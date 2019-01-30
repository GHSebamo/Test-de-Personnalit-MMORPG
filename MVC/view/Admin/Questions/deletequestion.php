<?php
echo '<p> La Question d\'id '.$quest_id.' a bien ete supprimé.';
require File::build_path(array('view','Admin','Questions','listequestion.php'));
?>