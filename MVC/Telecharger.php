<?php
$DS=DIRECTORY_SEPARATOR;
require("lib".$DS."File.php");
require_once(File::build_path(array('controller','ControllerAdmin.php')));
ControllerAdmin::TelechargerRep();
?>