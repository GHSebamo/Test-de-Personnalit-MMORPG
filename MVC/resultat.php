<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="styleSondage.css" media="all"/>
<title> MMORPG Résultat </title>
</head>
<body>
<div id=res>
<?php
$DS=DIRECTORY_SEPARATOR;
require("lib".$DS."File.php");
$pathControllerSondage=array("controller","ControllerSondage.php");
require_once(File::build_path($pathControllerSondage));
ControllerSondage::AfficheResultatSondage();
?>
</div>
</body>
</html>