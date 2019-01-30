<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="styleSondage.css" media="all"/>
<title> MMORPG Test </title>
</head>
<body>
<div id=sond>
<?php
$DS=DIRECTORY_SEPARATOR;
require("lib".$DS."File.php");
$pathControllerSondage=array("controller","ControllerSondage.php");
require_once(File::build_path($pathControllerSondage));
ControllerSondage::AfficheSondage();
?>
</div>
</body>
</html>