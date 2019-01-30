<?php

	require_once('Model.php');
class ModelReponse{
	private $idUtilisateur;
	private $idquestion;
	private $valeur;

	//getter
	public function getIdQuestion(){
		return $this->idquestion;
	}
	public function getIdUtilisateur(){
		return $this->idUtilisateur;
	}
	public function getValeur(){
		return $this->valeur;
	}
	public function afficher(){
		print($this->getValeur());
	}
	public function getAllReponse(){
		$rep=Model::$pdo->query('SELECT * from sond_reponses');
		$rep ->setFetchMode(PDO::FETCH_CLASS,'ModelReponse');
		$tab_reponse = $rep->fetchAll();
		return $tab_reponse;
	}
	public static function getReponseByUt($util){
	    $sql = "SELECT idquestion,valeur from sond_reponses WHERE idUtilisateur=:nom_tag";
	    $req_prep = Model::$pdo->prepare($sql);
	    $values = array(
	        "nom_tag" => $util,
	    );
	    $req_prep->execute($values);
	    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'array');
	    $tab_reponse = $req_prep->fetchAll();
	    if (empty($tab_reponse)){
        	return false;
	    }
   		 return $tab_reponse;
	}
	/* Plus utile, cela a changer
	public static function getNomReponseByValeur($valeur){
		switch ($valeur) {
			case -3:
				return 'Pas du tout d\'accord';
				break;
			case -2:
				return 'Pas d\'accord';
				break;
			case -1:
				return 'Plutôt pas d\'accord';
				break;
			case 0:
				return 'Neutre';
				break;
			case 1:
				return 'Un peu d\'accord';
				break;
			case 2:
				return 'Plutôt d\'accord';
				break;
			case 3:
				return 'Total accord';
				break;
			default:
				return 'Neutre';
				break;
		}
	}
	*/
}