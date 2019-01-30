<!DOCTYPE html>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="styleSondage.css" media="all"/>
<title> M. Chollet </title>
</head>
<body>
<div id=menuAdmin>
<?php
$DS=DIRECTORY_SEPARATOR;
require("lib".$DS."File.php");
require_once(File::build_path(array('lib','Security.php')));
$pathControllerAdmin=array('controller','ControllerAdmin.php');
require_once(File::build_path($pathControllerAdmin));
session_start();
if(isset($_GET['action'])){
	$action=$_GET['action'];
	//echo $action;// permet de savoir l'action
}
if (isset($_POST['action'])){
	$action=$_POST['action'];
	//echo $action;// permet de savoir l'action
}
if (isset($action)&& !($action=='TelechargerRep')||!isset($action)){
	require File::build_path(array('view','Admin','gobackhere.php'));
}
if(!(isset($action))||$action=='connection'){
	if (isset($_SESSION['isadmin'])){
		ControllerAdmin::AfficheOptionAdmin();
		require File::build_path(array('view','Admin','deconnecter.php'));
	}
	else {
		if(ControllerAdmin::rightlogin()){
			ControllerAdmin::AfficheOptionAdmin();
			require File::build_path(array('view','Admin','deconnecter.php'));
		}
	}
}
else if (isset($_SESSION['isadmin'])){
		ControllerAdmin::$action();
		require File::build_path(array('view','Admin','deconnecter.php'));
	}
else{
		header('Location:index.php');
}
?>
</div>
</body>
</html>