<?php

	require_once('Model.php');
class ModelCategorie{
	private $idcategorie;
	private $textecategorie;

	//getter
	public function getIdCategorie(){
		return $this->idcategorie;
	}
	public function getTexte(){
		return $this->textecategorie;
	}
	public static function getAllCategorie(){
		$rep=Model::$pdo->query('SELECT * from sond_categories');
		$rep ->setFetchMode(PDO::FETCH_CLASS,'ModelCategorie');
		$tab_cat = $rep->fetchAll();
		return $tab_cat;
	}
	public static function getCategorieById($idcat){
		$sql="SELECT * from sond_categories WHERE idcategorie=:num_cat";
		$req_prep = Model::$pdo->prepare($sql);
		$values=array(
			'num_cat'=>$idcat,);
		$req_prep->execute($values);
		$req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCategorie');
	    $textitext = $req_prep->fetchAll();
		return $textitext[0];
	}
	public static function getTexteByCat($idcat){
		$sql="SELECT * from sond_categories WHERE idcategorie=:num_cat";
		$req_prep = Model::$pdo->prepare($sql);
		$values=array(
			'num_cat'=>$idcat,);
		$req_prep->execute($values);
		$req_prep->setFetchMode(PDO::FETCH_CLASS, 'ModelCategorie');
	    $textitext = $req_prep->fetchAll();
		return $textitext[0]->textecategorie;
	}
	public function __construct($id =NULL,$texte =NULL){
    	if(!is_null($id) && !is_null($texte)){
      		$this->idcategorie = $id;
    	  	$this->textecategorie = $texte;
    	}
	}
	public static function getIdMax(){
		$rep =Model::$pdo->query('SELECT MAX(idcategorie) as idcatmax FROM sond_categories ');
		$rep->setFetchMode(PDO::FETCH_CLASS,'array');
		$tab_cat=$rep->fetch();
		return $tab_cat['idcatmax'];
	//	$rep=Model::$pdo->query('SELECT MAX(idcategorie) from Categories ');
	//	$last_Util = $rep->execute();
	//	return $last_Util;
	//	$wtf=Model::$pdo->query("SELECT MAX(idcategorie)AS please from Categories");
	//	$wtf->setFetchMode(PDO::FETCH_CLASS,'array');
	//	$allez=$wtf->fetchAll();
		//echo $wtf['idcategorie'];
	//	$rep=Model::$pdo->query('SELECT * from Categories Where idcategorie=(SELECT MAX(idcategorie) from Categories)');
	//	$tab_cat = $rep->fetchAll();
	//	echo $tab_cat['idcategorie'];
	//	return $tab_cat['idcategorie'];
	//$sql=Model::$pdo->query('SELECT idcategorie from Categories Where idcategorie=:numcat');
	//		$req_prep = Model::$pdo->prepare($sql);
	//		$values=array(
	//			'numcat'=>3,);
	//		$textitext=$reqprep->execute(values);
	//		echo $textitext;
	}
	public  function save(){
		try{
			$sql= "INSERT INTO sond_categories(idcategorie,textecategorie)
				VALUES (:categorie_id,:categorie_texte)";
				$req_prep=Model::$pdo->prepare($sql);
				$values=array(
					"categorie_id"=> $this->getIdCategorie(),
					"categorie_texte"=> $this->getTexte()
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
		$sql="UPDATE sond_categories SET textecategorie=:categorie_texte Where idcategorie=:categorie_id ";
		$req_prep=Model::$pdo->prepare($sql);
		$req_prep->execute($data);
	}
	public static function DeleteById($id){
		$sql ="DELETE FROM sond_categories WHERE idcategorie=:categorie_id";
	    $reqprep=Model::$pdo->prepare($sql);
	    $values=array(
	      "categorie_id"=> $id);
	    $reqprep->execute($values);	
	}
	public static function getNextCat($id) {
		$sql = "SELECT idcategorie FROM sond_categories WHERE idcategorie>:categorie_id";
		$req_prep = Model::$pdo->prepare($sql);
		$values = array("categorie_id" => $id);
		$req_prep->execute($values);
		$req_prep->setFetchMode(PDO::FETCH_CLASS,'array');
	    $nexts = $req_prep->fetchAll();
	    if (empty($nexts)) {
	    	return array(0);
	    }
		return $nexts[0];
	}

	public static function getPrecedentCat($id){
		$sql = 'SELECT idcategorie FROM sond_categories WHERE idcategorie<:categorie_id ';
		$req_prep=Model::$pdo->prepare($sql);
		$values=array(
			"categorie_id"=>$id,
			);
		$req_prep->execute($values);
		$req_prep->setFetchMode(PDO::FETCH_CLASS,'array');
		$tab_cat=$req_prep->fetchAll();
		return end($tab_cat);
	}
}