<?php

	require_once('Model.php');
class ModelEtreaffecter{
	private $idquestion;
	private $roleaaffecter;
	private $valeurrep;
	private $valeuraffectation;

	public function getId(){
		return $this->idquestion;
	}
	public function getRole(){
		return $this->roleaaffecter;
	}
	public function getValeurRep(){
		return $this->valeurrep;
	}
	public function getValeuraffectation(){
		return $this->valeuraffectation;
	}
	public static function getAffectationByQuest($id){
		$sql ="SELECT * from sond_etreaffecter Where idquestion=:num_tag";
		$req_prep = Model::$pdo->prepare($sql);
		$values =array(
			"num_tag" =>$id,
		);
		$req_prep->execute($values);
	    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Etreaffecter');
	    $tab_affectation = $req_prep->fetchAll();
	    if (empty($tab_affectation)){
	    	return null;
	    }
	    return $tab_affectation;
	}
	public function __construct($idquest=NULL,$role=NULL,$vrep=NULL,$vaffect=NULL){
		if(!is_null($idquest)&&!is_null($role)&&!is_null($vrep)&&!is_null($vaffect)){
			$this->idquestion = $idquest;
			$this->roleaaffecter = $role;
			$this->valeurrep= $vrep;
			$this->valeuraffectation=$vaffect;
		}
	}
	public  function save(){
		try{ 

			$sql= "INSERT INTO sond_etreaffecter(idquestion,roleaaffecter,valeurrep,valeuraffectation)
				VALUES (:quest_id,:role,:vrep,:vaffect)";

				$req_prep=Model::$pdo->prepare($sql);
				$values=array(
					"quest_id"=>$this->getId(),
					"role"=> $this->getRole(),
					"vrep"=> $this->getValeurRep(),
					"vaffect"=>$this->getValeuraffectation()
				);
				$req_prep->execute($values);
		} catch (PDOException $e) {
  			if (Conf::getDebug()) {
        		echo $e->getMessage(); // affiche un message d'erreur
      		} else {
       			echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
      		}
      		die();
    	}
    }
	public static function update($data){
		$sql="UPDATE sond_etreaffecter SET valeuraffectation=:valeur_affectation Where idquestion=:idquestion AND roleaaffecter=:role AND valeurrep=:valeur_rep ";
		$req_prep=Model::$pdo->prepare($sql);
		$req_prep->execute($data);
	}
	public static function DeleteByAll($id,$role,$vrep){
		$sql ="DELETE FROM sond_etreaffecter WHERE idquestion=:question_id AND roleaaffecter=:role AND valeurrep=:vrep";
	    $reqprep=Model::$pdo->prepare($sql);
	    $values=array(
	    	"question_id"=> $id,
	    	"role"=>$role,
	    	"vrep"=>$vrep
	  	);
	    $reqprep->execute($values);	
	}
}