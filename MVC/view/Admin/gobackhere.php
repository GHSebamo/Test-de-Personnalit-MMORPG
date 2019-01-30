<?php 
if (!isset($_SESSION['isadmin'])){
		echo '<p><a href="index.php"> Retourner au sondage</a></p><br>';
}
else{
	if(isset($_GET['action'])||isset($_POST['action'])){
		$action=(isset($_GET['action'])?$_GET['action']:$_POST['action']);
	}
	if(isset($action)&&$action=='deconnection'){
		echo '<p><a class=BoutonUtile href="index.php"> Retourner au sondage</a></p><br>';
	}
	else{
		echo '<p><a class=BoutonUtile href="routeurAdmin.php"> Retourner au départ</a></p><br>';
	} 
}
