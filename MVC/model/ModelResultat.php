<?php

	require_once('Model.php');
class ModelResultat{
	private $idUtilisateur;
	private $Champion;
	private $Coach;
	private $Leader;
	private $Mercenaire;
	private $Officier;
	private $Solitaire;
	private $Collaborateur;
	private $Membre;
	private $Troll;

	//getter:
	public function getId(){
		return $this->idUtilisateur;
	}

	public function getResChampion(){
		return $this->Champion;
	}
	public function getResCoach(){
		return $this->Coach;
	}

	public function getResLeader(){
		return $this->Leader;
	}

	public function getResMercenaire(){
		return $this->Mercenaire;
	}

	public function getResOfficier(){
		return $this->Officier;
	}

	public function getResSolitaire(){
		return $this->Solitaire;
	}

	public function getResCollaborateur(){
		return $this->Collaborateur;
	}

	public function getResMembre(){
		return $this->Membre;
	}

	public function getResTroll(){
		return $this->Troll;
	}
	public function setIdUtilisateur($idUtil){
		$this->idUtilisateur=$idUtil;
	}

	public function afficher(){
		// affiche le Resultat pour un utilisateur
		print("Champion :".$this->Champion."% ,Coach :".$this->Coach."% ,Leader :".$this->Leader."% ,Mercenaire :".$this->Mercenaire."% ,Officier :".$this->Officier."% ,Solitaire :".$this->Solitaire."% ,Collaborateur :".$this->Collaborateur."% ,Membre :".$this->Membre."% ,Troll :".$this->Troll."%");
	}

	public static function getAllRes(){
		//renvoie un tableau avec tout les Resultat obtenue
		$rep= Model::$pdo -> query('SELECT * From sond_resultat');
		$rep->setFetchMode(PDO::FETCH_CLASS, 'ModelResultat');
  		$tab_res = $rep->fetchAll(); 
 		 return $tab_res;
	}
	
	public static function roleByID($i){
		//on rentre le id du role et on renvoie le nom du role
		if ($i==1) {
			return "Champion";
		}
		if ($i==2) {
			return "Coach";
		}
		if ($i==3) {
			return "Leader";
		}
		if ($i==4) {
			return "Mercenaire";
		}
		if ($i==5) {
			return "Officier";
		}
		if ($i==6) {
			return "Solitaire";
		}
		if ($i==7) {
			return "Collaborateur";
		}
		if ($i==8) {
			return "Membre";
		}
		if ($i==9)/*non utilisé normalement*/ {
			return "Troll";
		}
	}
	public static function roleByName($i){
		//inverse de roleByID
		if ($i=="Champion") {
		return 1;
		}
		if ($i=="Coach") {
			return 2;
		}
		if ($i=="Leader") {
			return 3;
		}
		if ($i=="Mercenaire") {
			return 4;
		}
		if ($i=="Officier") {
			return 5;
		}
		if ($i=="Solitaire") {
			return 6;
		}
		if ($i=="Collaborateur") {
			return 7;
		}
		if ($i=="Membre") {
			return 8;
		}
		if($i=="Troll")/*non utilisé normalement*/ {
			return 9;	
		}
	}
	public function getRoleMax(){
		//Donne le 1er role le plus haut
		//echo"<br>";
		$sql ="SELECT * from sond_resultat WHERE idUtilisateur=:nom_tag";
		$req_prep = Model::$pdo->prepare($sql);
		//echo"1";
	    $values = array(
	        "nom_tag" =>$this->getId() ,
	    );

	    $req_prep ->execute($values);
	    //echo" 2";
	    $req_prep->setFetchMode(PDO::FETCH_CLASS, 'Resultat');
	    $tab_res = $req_prep->fetchAll();
		//echo" 3 ";
		if (empty($tab_res)){
	    	    return false;
		}
		//echo"4";
		$realrole=1;
		$rolemax='Champion';
		for($i=2;$i<9;$i++){
			$roleactuel=ModelResultat::roleByID($i);
				if($this->$rolemax< $this->$roleactuel){
					$rolemax=$roleactuel;
					$realrole=$i;
				}
			}
		//echo"5";	
		return ModelResultat::roleByID($realrole);
	}
	public function get2RoleMax(){
		//donne le second role le plus haut
		$sql ="SELECT * from sond_resultat WHERE idUtilisateur=:nom_tag";
		$req_prep = Model::$pdo->prepare($sql);

	    $values = array(
	        "nom_tag" =>$this->getId() ,
	    );
	    $req_prep ->execute($values);
	    $req_prep->setFetchMode(PDO::FETCH_CLASS,'Resultat');
	    $tab_res = $req_prep->fetchAll();
		if (empty($tab_res)){
	    	    return false;
		}
		$realrole=1;
		$rolemax='Champion';
		for($i=2;$i<9;$i++){
			$roleactuel=ModelResultat::roleByID($i);
				if($this->$rolemax< $this->$roleactuel){
					$rolemax=$roleactuel;
					$realrole=$i;
				}
			}
		if($rolemax=='Champion'){
			$secondrealrole=2;
			$secondrolemax='Coach';
		}
		else{
			$secondrealrole=1;
			$secondrolemax='Champion';
		}
		for($i=2;$i<9;$i++){
			$roleactuel=ModelResultat::roleByID($i);
				if($this->$secondrolemax< $this->$roleactuel&& $roleactuel!=$rolemax){
					$secondrolemax =$roleactuel;
					$secondrealrole=$i;
				}
			}
		return ModelResultat::roleByID($secondrealrole);
	}
	
	public static function CalculeMax($Role){
		//Calcule le res Max pour un Role donner
		$sql ="SELECT Max(valeuraffectation) AS valeuraffectmax from sond_etreaffecter WHERE roleaaffecter=:nom_tag GROUP BY (idquestion)";
		$req_prep=Model::$pdo->prepare($sql);
		$values = array("nom_tag"=>$Role);
		$req_prep->execute($values);
		$req_prep->setFetchMode(PDO::FETCH_CLASS,'array');
		$tab_max=$req_prep->fetchAll();
		$valeurmax =0;
		foreach ($tab_max as $vmaxrole) {
			$valeurmax +=$vmaxrole['valeuraffectmax'];
		}	
		return $valeurmax;
	}
	public function CalculeVraiResultat(){
		//calcule le resultat en pourcentage pour chaque role
		//echo " la valeur c'est ca".$this->Champion;
		$this->Champion=round(100* $this->Champion/ModelResultat::CalculeMax('Champion'),2);
		$this->Coach=round(100*$this->Coach/ModelResultat::CalculeMax('Coach'),2);
		$this->Leader=round(100*$this->Leader/ModelResultat::CalculeMax('Leader'),2);
		$this->Mercenaire=round(100*$this->Mercenaire/ModelResultat::CalculeMax('Mercenaire'),2);
		$this->Officier=round(100*$this->Officier/ModelResultat::CalculeMax('Officier'),2);
		$this->Solitaire=round(100*$this->Solitaire/ModelResultat::CalculeMax('Solitaire'),2);
		$this->Collaborateur=round(100*$this->Collaborateur/ModelResultat::CalculeMax('Collaborateur'),2);
		$this->Membre=round(100*$this->Membre/ModelResultat::CalculeMax('Membre'),2);
		$this->Troll=round(100*$this->Troll/ModelResultat::CalculeMax('Troll'),2);
	}
	public function ResultatFinal(){
		$tab_allquestion=ModelQuestion::getAllQuestion();
		foreach ($tab_allquestion as $idq) {
			$this->AresUlt($idq->getIdQuestion(),$_POST['idquestion'.$idq->getIdQuestion()]);
		}
		//echo "la on pars sur du".$this->Champion;
		$this->CalculeVraiResultat();
		}
	public function __construct($id=NULL,$champ=NULL,$coa=NULL,$lead=NULL,$merc=NULL,$offi=NULL,$sol=NULL,$col=NULL,$mem=NULL,$tro=NULL){
		if(!is_null($id)&&!is_null($champ)&&!is_null($coa)&&!is_null($lead)&&!is_null($merc)&&!is_null($offi)&&!is_null($sol)&&!is_null($col)&&!is_null($mem)&&!is_null($tro)){
			$this->idUtilisateur=$id;
			$this->Champion=$champ;
			$this->Coach=$coa;
			$this->Leader=$lead;
			$this->Mercenaire=$merc;
			$this->Officier=$offi;
			$this->Solitaire=$sol;
			$this->Collaborateur=$col;
			$this->Membre=$mem;
			$this->Troll=$tro;
		}
	}
	public function save(){

		try {
			$sql="INSERT INTO sond_resultat(idUtilisateur,Champion,Coach,Leader,Mercenaire,Officier,Solitaire,Collaborateur,Membre,Troll)
			VALUES(:num_Util,:res_Champion,:res_Coach,:res_Leader,:res_Mercenaire,:res_Officier,:res_Solitaire,:res_Collaborateur,:res_Membre,:res_Troll)";
			$reqprep=Model::$pdo->prepare($sql);
			$values=array(
				"num_Util" => $this->getId(),
				"res_Champion" => $this->getResChampion(),
				"res_Coach" => $this->getResCoach(),
				"res_Leader" => $this->getResLeader(),
				"res_Mercenaire" => $this->getResMercenaire(),
				"res_Officier" => $this->getResOfficier(),
				"res_Solitaire" => $this->getResSolitaire(),
				"res_Collaborateur" => $this->getResCollaborateur(),
				"res_Membre" => $this->getResMembre(),
				"res_Troll" => $this->getResTroll()
			);
			$reqprep->execute($values);
		}	catch (PDOException $e) {
			if (Conf::getDebug()) {
		        echo $e->getMessage(); // affiche un message d'erreur
		    } else {
		    	echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
		    }
		die();
	}
	}

	/*applique le résultat de la question n
	public function Ares($idquestion,$vres){
		$name='AresQ'+$idquestion;
		$this->$name($vres);
	}
	*/
	public function AresUlt($idquest,$vres){
		//aller chercher la tab etre affecter avec Valeur maxe role a affecter et positif
		$sql='SELECT * from sond_etreaffecter Where idquestion=:num_quest AND valeurrep=:num_res'; 
		$req_prep = Model::$pdo->prepare($sql);
	    $values = array(
	        "num_quest" => $idquest,
	        "num_res"=> $vres
	    );
	    $req_prep->execute($values);
	    $req_prep->setFetchMode(PDO::FETCH_CLASS,'ModelEtreaffecter');
	    $tab_affect=$req_prep->fetchAll();
	    if (empty($tab_affect)){
        	return false;
        }
		foreach ($tab_affect as $row) {
				$rolename=$row->getRole();
				$this->$rolename +=$row->getValeurAffectation();
			}
			/*
			fonctionnement avec l'ancien
			$triste=$row['roleaaffecter'];
			$lavaleur=$row['valeurmax'];
			if($row['positif']){
				if($vres==1){
					$this->$triste+=$lavaleur/3;
				}
				if($vres==2){
					$this->$triste+=2*$lavaleur/3;
				}
				if($vres==3){
					$this->$triste+=$lavaleur;
				}
			}
			else{
				if($vres==-1){
					$this->$triste+=$lavaleur/3;
				}
				if($vres==-2){
					$this->$triste+=2*$lavaleur/3;
				}
				if($vres==-3){
					$this->$triste+=$lavaleur;
				}
			}
			*/
	}
	public static function getResMoy(){
		// renvoie un tableau avec la moyenne des Resultat
		/*$tab_moyres;
		$count=0;
		foreach (ModelResultat::getAllRes() as $row) {
			$tab_moyres[1] -> $tab_moyres[1] + $Champion;
			$tab_moyres[2] -> $tab_moyres[2] + $Coach;
			$tab_moyres[3] -> $tab_moyres[3] + $Leader;
			$tab_moyres[4] -> $tab_moyres[4] + $Mercenaire;
			$tab_moyres[5] -> $tab_moyres[5] + $Officier;
			$tab_moyres[6] -> $tab_moyres[6] + $Solitaire;
			$tab_moyres[7] -> $tab_moyres[7] + $Collaborateur;
			$tab_moyres[8] -> $tab_moyres[8] + $Membre;
			$tab_moyres[9] -> $tab_moyres[9] + $Troll;
			$count++;
		}
		for($i=1; $i<10;$i++ ){
				$tab_moyres[i] -> $tab_moyres[i]/$count;
			} 
		return $tab_moyres;
	}
	*/
	//function si on veut un res sous la forme ModelResultat
	$count=0;
		$resmoy= new Modelresultat('',0,0,0,0,0,0,0,0,0);
		foreach (ModelResultat::getAllRes() as $row) {
			$resmoy->Champion+= $row->getResChampion();
			$resmoy->Coach+= $row->getResCoach();
			$resmoy->Leader += $row->getResLeader();
			$resmoy->Mercenaire+= $row->getResMercenaire();
			$resmoy->Officier+=$row->getResOfficier();
			$resmoy->Solitaire+=$row->getResSolitaire();
			$resmoy->Collaborateur+=$row->getResCollaborateur();
			$resmoy->Membre+=$row->getResMembre();
			$resmoy->Troll+=$row->getResTroll();
			$count++;
		}
		if ($count){
			$resmoy->Champion=$resmoy->Champion/$count;
			$resmoy->Coach=$resmoy->Coach/$count;
			$resmoy->Leader=$resmoy->Leader/$count;
			$resmoy->Mercenaire=$resmoy->Mercenaire/$count;
			$resmoy->Officier=$resmoy->Officier/$count;
			$resmoy->Solitaire=$resmoy->Solitaire/$count;
			$resmoy->Collaborateur=$resmoy->Collaborateur/$count;
			$resmoy->Membre=$resmoy->Membre/$count;
			$resmoy->Troll=$resmoy->Troll/$count;
		}
		else{
			$resmoy=false;
		}
		return $resmoy;
	}
	public static function getNbUtilrolemax(){
		$tab=array(
			"nbutil"=>0,
			"Coach"=>0,
			"Champion"=>0,
			"Leader"=>0,
			"Mercenaire"=>0,
			"Officier"=>0,
			"Solitaire"=>0,
			"Collaborateur"=>0,
			"Membre"=>0,
			"Troll"=>0,
		);
		foreach (ModelResultat::getAllRes() as $res) {
			$tab["nbutil"]++;
			$tab[$res->GetRolemax()]++;
		}
		return $tab;
	}
		public static function getNbUtil2rolemax(){
		$tab=array(
			"nbutil"=>0,
			"Coach"=>0,
			"Champion"=>0,
			"Leader"=>0,
			"Mercenaire"=>0,
			"Officier"=>0,
			"Solitaire"=>0,
			"Collaborateur"=>0,
			"Membre"=>0,
			"Troll"=>0,
		);
		foreach (ModelResultat::getAllRes() as $res) {
			$tab["nbutil"]++;
			$tab[$res->Get2Rolemax()]++;
		}
		return $tab;
	}
	public static function Mediumres(){
		$sql="SELECT * from mediumuser";
		$rep=Model::$pdo->query($sql);
		$rep->setFetchMode(PDO::FETCH_CLASS,'array');
		$tab_med=$rep->fetch();
		return $tab_med;
	}
}
?>	