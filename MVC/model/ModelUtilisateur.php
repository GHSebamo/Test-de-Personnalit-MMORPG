<?php

	require_once('Model.php');
class ModelUtilisateur{
	private $idUtilisateur;

	//getter
	public function getIdUtilisateur(){
		return $this->idUtilisateur;
	}
	public function getUtilisateur(){
		$rep=Model::$pdo->query('SELECT * from sond_utilisateurs');
		$rep ->setFetchMode(PDO::FETCH_CLASS,'ModelUtilisateur');
		$tab_util = $rep->fetchAll();
		return $tab_util;
	}
	public function setIdUtilisateur($idUtil){
		$this->idUtilisateur=$idUtil;
	}
	public static function getIdLastUtil(){
		$rep=Model::$pdo->query('SELECT MAX(idUtilisateur) as idlast from sond_utilisateurs');
		$rep->setFetchMode(PDO::FETCH_CLASS,'array');
		$last_Util=$rep->fetch();
		return $last_Util['idlast'];
	}
	public function __construct(){
	}
	public function save(){
		try {
			//echo"LA ON A UN PROB";
			$sql =  Model::$pdo->query("INSERT INTO sond_utilisateurs() 
   			VALUES ()");
      		
      		//echo "		OU CA QU4ILEST";
		} catch (PDOException $e) {
		if (Conf::getDebug()) {
        	echo $e->getMessage(); // affiche un message d'erreur
      	} else {
       		echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      	}
      	die();
    	}
	}
	public static function getNbUtil(){
	$rep=Model::$pdo->query('SELECT Count(*)from sond_utilisateurs');
	$nbUtil= $rep->execute();
	return $nbUtil;
	}
	public static function getAllUtil(){
		$rep= Model::$pdo -> query('SELECT * From sond_utilisateurs');
		$rep->setFetchMode(PDO::FETCH_CLASS, 'ModelUtilisateur');
  		$tab_util = $rep->fetchAll(); 
 		 return $tab_util;
	}
}