<?php

	require_once('Model.php');
class ModelRole{
	private $nomRole;
	private $description;

	//getter
	public function getNom(){
		return $this->nomRole;
	}
	public function getDescription(){
		return $this->description;
	}
	public function afficher(){
		print($this->getTexte());
	}
	public static function getAllRole(){
		$rep=Model::$pdo->query('SELECT * from sond_roles');
		$rep ->setFetchMode(PDO::FETCH_CLASS,'ModelRole');
		$tab_role = $rep->fetchAll();
		return $tab_role;
	}
	public static function getDescriptionByRole($role){
		$sql='SELECT * from sond_roles WHERE nomRole=:nom_role';
		$req_prep=Model::$pdo->prepare($sql);
		$values=array(
			"nom_role"=>$role,
		);
		$req_prep->execute($values);
		$req_prep ->setFetchMode(PDO::FETCH_CLASS,'ModelRole');
		$tab_role = $req_prep->fetchAll();
		return $tab_role[0]->getDescription();
	}
}
?>