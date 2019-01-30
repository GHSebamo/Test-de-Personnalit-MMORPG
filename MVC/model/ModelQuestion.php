<?php

	require_once('Model.php');
class ModelQuestion{
	private $idquestion;
	private $idcategorie;
	private $textequestion;

	//getter
	public function getIdQuestion(){
		return $this->idquestion;
	}
	public function getIdCategorie(){
		return $this->idcategorie;
	}
	public function getTexte(){
		return $this->textequestion;
	}
	public function afficher(){
		print($this->getTexte());
	}
	public static function getAllquestion(){
		$rep=Model::$pdo->query('SELECT * from sond_questions');
		$rep ->setFetchMode(PDO::FETCH_CLASS,'ModelQuestion');
		$tab_question = $rep->fetchAll();
		return $tab_question;
	}
	public static function getQuestionByCat($categorie){
	    $sql = "SELECT * from sond_questions WHERE idcategorie=:nom_tag";
	    $req_prep = Model::$pdo->prepare($sql);
	    $values = array(
	        "nom_tag" => $categorie,
	    );
	    $req_prep->execute($values);
	    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelQuestion');
	    $tab_question = $req_prep->fetchAll();
	    if (empty($tab_question))
        	return false;
    	return $tab_question;
	}	
	public function __construct($idquest=NULL,$idcat=NULL,$txt=NULL){
		if(!is_null($idquest)&&!is_null($idcat)&&!is_null($txt)){
			$this->idquestion = $idquest;
			$this->idcategorie = $idcat;
			$this->textequestion= $txt;
		}
	}
	public static function getQuestionById($id){
		//echo $id;
	    $sql = "SELECT * from sond_questions WHERE idquestion=:num_tag";
	    $req_prep = Model::$pdo->prepare($sql);
	    $values = array(
	        "num_tag" => $id,
	    );
	    $req_prep->execute($values);
	    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelQuestion');
	    $tab_question = $req_prep->fetchAll();
	    if (empty($tab_question)){
        	return false;
	    }
    return $tab_question[0];
	}

	public  function save(){
		try{ 

			$sql= "INSERT INTO sond_questions(idquestion,idcategorie,textequestion)
				VALUES (:question_id,:categorie_id,:question_texte)";

				$req_prep=Model::$pdo->prepare($sql);
				$values=array(
					"question_id"=>$this->getIdQuestion(),
					"categorie_id"=> $this->getIdCategorie(),
					"question_texte"=> $this->getTexte()
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
 		$sql = "UPDATE sond_questions SET idcategorie=:idcategorie,textequestion=:texte Where idquestion=:idquestion";
		$reqprep=Model::$pdo->prepare($sql);
		$reqprep->execute($data);
	}
	
	
	public static function getQuestionByRole($role){
		$sql= "SELECT * from sond_questions where idquestion In (SELECT idquestion from sond_etreaffecter where roleaaffecter=:nom_role)"; 
		$req_prep=Model::$pdo->prepare($sql);
		$values = array(
			"nom_role"=> $role,
		);
		$req_prep->execute($values);
		$req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelQuestion');
	    $tab_question = $req_prep->fetchAll();
	    if (empty($tab_question)){
        	return false;
	    }
	    return $tab_question;

	}

	public static function getIdMax(){
		$rep =Model::$pdo->query('SELECT MAX(idquestion) as idquestmax FROM sond_questions ');
		$rep->setFetchMode(PDO::FETCH_CLASS,'array');
		$tab_quest=$rep->fetch();
		return $tab_quest['idquestmax'];
	}
		public static function DeleteById($id){
		$sql ="DELETE FROM sond_questions WHERE idquestion=:question_id";
	    $reqprep=Model::$pdo->prepare($sql);
	    $values=array(
	      "question_id"=> $id);
	    $reqprep->execute($values);	
	}
}
?>