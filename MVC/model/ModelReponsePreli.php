<?php

	require_once('Model.php');
class ModelReponsePreli{
	private $idUtilisateur;
	private $genre;
	private $Date_Naissance;
	private $Pays;
	private $Situation_Maritale;
	private $Enfant_a_charges;	
	private $Niveau_Etudes;
	private $Situation_professionnelle;
	private $Temps_Situation;
	private $Responsable;
	private $Responsable_nombre;
	private $NomJeu;
	private $DatedebJeu;
	private $Temps_Jeu;
	private $Aspect_Pref;
	private $Aspect_Detes;
	private $Guilde;
	private $Nb_Membre;
	private $Grade;
	private $Sexe_opposé;
	private $Rencontre;
	private $Relation;

	public function __construct($id=NULL,$genre=NULL,$datenais=NULL,$pays=NULL,$Sitmar=NULL,$Enf=NULL,$NivEtu=NULL,$Sitpro=NULL,$TmpSit=NULL,$Resp=NULL,$nbResp=NULL,$nomjeu=NULL,$Datejeu=NULL,$tmpjeu=NULL,$asppref=NULL,$aspdet=NULL,$guil=NULL,$nbmemb=NULL,$grad=NULL,$sexeopp=NULL,$renc=NULL,$rel=NULL){
	$this->idUtilisateur=$id;
	$this->genre=$genre;
	$this->Date_Naissance=$datenais;
	$this->Pays=$pays;
	$this->Situation_Maritale=$Sitmar;
	$this->Enfant_a_charges=$Enf;	
	$this->Niveau_Etudes=$NivEtu;
	$this->Situation_professionnelle=$Sitpro;
	$this->Temps_Situation=$TmpSit;
	$this->Responsable=$Resp;
	$this->Responsable_nombre=$nbResp;
	$this->NomJeu=$nomjeu;
	$this->DatedebJeu=$Datejeu;
	$this->Temps_Jeu=$tmpjeu;
	$this->Aspect_Pref=$asppref;
	$this->Aspect_Detes=$aspdet;
	$this->Guilde=$guil;
	$this->Nb_Membre=$nbmemb;
	$this->Grade=$grad;
	$this->Sexe_opposé=$Sitpro;
	$this->Rencontre=$renc;
	$this->Relation=$rel;
	}
	public function getId(){
		return $this->idUtilisateur;
	}
	public function save(){
		$sql="INSERT INTO sond_reponse_preli(idUtilisateur, genre, Date_Naissance, Pays, Situation_Maritale, Enfant_a_charges, Niveau_Etudes, Situation_professionnelle, Temps_Situation, Responsable, Responsable_nombre, NomJeu, DatedebJeu, Temps_Jeu, Aspect_Pref, Aspect_Detes, Guilde, Nb_Membre, Grade, Sexe_opposE, Rencontre, Relation) VALUES (:id,:genre,:datenaiss,:pays,:sitmar,:enf,:niv,:sitpr,:tmpsit,:resp,:nbresp,:nomj,:datej,:tmpj,:asppref,:aspdet,:guilde,:nbmemb,:grad,:sexeopp, :renc,:rel)";
		$req_prep=Model::$pdo->prepare($sql);
		$values=array(
			"id" => $this->idUtilisateur,
			"genre" => $this->genre,
			"datenaiss" => $this->Date_Naissance,
			"pays" => $this->Pays,
			"sitmar" => $this->Situation_Maritale,
			"enf" => $this->Enfant_a_charges,
			"niv" => $this->Niveau_Etudes,
			"sitpr" => $this->Situation_professionnelle,
			"tmpsit" => $this->Temps_Situation,
			"resp" =>$this->Responsable,
			"nbresp" => $this->Responsable_nombre,
			"nomj" => $this->NomJeu,
			"datej" => $this->DatedebJeu,
			"tmpj" => $this->Temps_Jeu,
			"asppref" => $this->Aspect_Pref,
			"aspdet" => $this->Aspect_Detes,
			"guilde" => $this->Guilde,
			"nbmemb" => $this->Nb_Membre,
			"grad" => $this->Grade,
			"sexeopp" => $this->Sexe_opposé,
			"renc" => $this->Rencontre,
			"rel" => $this->Relation,
		);
		$req_prep->execute($values);
	}
	public static function getAllRepPreli(){

	}
		public static function getReponseByUt($util){
	    $sql = "SELECT * from sond_reponse_preli WHERE idUtilisateur=:nom_tag";
	    $req_prep = Model::$pdo->prepare($sql);
	    $values = array(
	        "nom_tag" => $util,
	    );
	    $req_prep->execute($values);
	    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'array');
	    $tab_reponse = $req_prep->fetchAll();
	    if (empty($tab_reponse))
        	return false;
    	return $tab_reponse;
	}
}
?>
