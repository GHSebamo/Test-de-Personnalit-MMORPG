<?php
require_once(File::build_path(array('model','ModelResultat.php')));
require_once(File::build_path(array('model','ModelCategorie.php')));
require_once(File::build_path(array('model','ModelUtilisateur.php')));
require_once(File::build_path(array('model','ModelQuestion.php')));
require_once(File::build_path(array('model','ModelReponse.php')));
require_once(File::build_path(array('controller','ControllerAdmin.php')));

require_once(File::build_path(array('model','ModelReponsePreli.php')));
class ControllerSondage {
	public static function AfficheQset($idCatQset){
		// appelle la vue correspondante au set de question

		//require(File::build_path(array('view','questionset','Qset'.$idCatQset.'php')));
		echo '<div class=questions id=cat'.$idCatQset.' style="display:none">';
		echo '<h3 class=catQuePre> Voici les questions pour la catégorie '.ModelCategorie::getTexteByCat($idCatQset).' </h3>';
		if(ModelQuestion::getQuestionbyCat($idCatQset)){
			foreach(ModelQuestion::getQuestionbyCat($idCatQset) as $questioncat){
				echo '<div class=question'.$questioncat->getIdQuestion().'>'.'<p> '.$questioncat->getTexte().' : </p>';
				require(File::build_path(array('view','rowdecision.php')));
				//option du require une vue qui utilise une variable global, option a reflechir
				//ou juste une vue pour display les boutons
				echo '</div>';
			}
		}
		else {
			echo "<p> Il n'y a pas encore de questions pour cette catégorie. <p>";
		}
		//echo $idCatQset;
		//echo (ModelCategorie::getIdMax());
		if(!ModelQuestion::getQuestionbyCat(0) && ModelCategorie::getIdMax() == $idCatQset){
			if (ModelCategorie::getPrecedentCat($idCatQset)[0] == 0) {
				$precedent = '\'qSetUtil\'';
			}
			else {
				$idpre = ModelCategorie::getPrecedentCat($idCatQset);
				$precedent = '\'cat'.$idpre[0].'\'';
			}
			$now = '\'cat'.$idCatQset.'\'';
			require File::build_path(array('view','transition','TransFinale.php'));
		}
		else if ($idCatQset == 0) {
			if (ModelCategorie::getIdMax() == 0) {
				$precedent = '\'qSetUtil\'';
			}
			else {
				$idpre = ModelCategorie::getIdMax();
				$precedent = '\'cat'.$idpre[0].'\'';
			}
			$now = '\'cat'.$idCatQset.'\'';
			require File::build_path(array('view','transition','TransFinale.php'));
		}
		// si max alors $pathtransition =fintransition ?
		else {
			if (ModelCategorie::getPrecedentCat($idCatQset)[0] == 0) {
				$precedent = '\'qSetUtil\'';
			}
			else {
				$idpre = ModelCategorie::getPrecedentCat($idCatQset);
				$precedent = '\'cat'.$idpre[0].'\'';
			}
			$now = '\'cat'.$idCatQset.'\'';
			$idsuiv = ModelCategorie::getNextCat($idCatQset);
			$suivant = '\'cat'.$idsuiv[0].'\'';
			require File::build_path(array('view','transition','Trans.php'));
			echo '</div>';
		}
		//besoins de seb pour appliquer modification pour que ce soit viable
		//et il faut verifier que Affiche sondage marche avec ca et que tout est necessaire
	}
	public static function AfficheQsetUtil(){
		require(File::build_path(array('view','questionset','QSetUtil.php')));
		$idsuiv = ModelCategorie::getNextCat(0);
		if ($idsuiv){
			$suivant = '\'cat'.$idsuiv[0].'\'';
		}
		else {$suivant='\'cat0\'';}
		require(File::build_path(array('view','transition','TransInitiale.php')));
	}
	public static function AfficheSondage(){
		//appelle le formulaire de remplissage du sondage
		if (!ModelQuestion::getQuestionbyCat(0)&& ModelCategorie::getIdMax() == 0){
    		echo "<h2>Le sondage ne possède encore aucune question et ne peut donc pas être fait.</h2></form>";
    	}
    	else {
		ControllerSondage::AfficheQsetUtil();
		foreach (ModelCategorie::getAllcategorie() as $cat) {
			if($cat->getIdCategorie()){
				ControllerSondage::AfficheQset($cat->getIdCategorie());
			}
		}
		if(ModelQuestion::getQuestionbyCat(0)){
			ControllerSondage::AfficheQset(0);
		}
		}

		require File::build_path(array('view','connect.php')); 

	}
	public static function AfficheResultatSondage(){
		//est appelle quand le sondage est remplie et calcule et affiche les resultats du sondage
		$Util = new ModelUtilisateur('');
		$ResSond= new ModelResultat('',0,0,0,0,0,0,0,0,0);
		$Util->save(); //sauvegarde Util dans la bas de données
		$id_lastUtil='0';
		$id_lastUtil= ModelUtilisateur::getIdLastUtil();//recupere l'id du dernier util creer
		// echo"<br>".$id_lastUtil."<br>"; phase test du lastUil
		$ResSond->setIdUtilisateur($id_lastUtil);//enregistre cette id dans le resultat
		$ResSond->ResultatFinal();	//calcule le resultat
		$ResSond->save();//sauvegarde le resultat dans la base de donnee
		ControllerSondage::StoreRepPreli($ResSond->getId());
		ControllerSondage::StoreReponse($ResSond->getId());//sauvegarde les reponses de l'utilisateur dans la base
		//ControllerSondage::Arepondu();//met a jour la base de donnee pas obligatoire grace au trigger
		ControllerSondage::ComposePagResult($ResSond);// Creer la page Result(avec l'affichage du resultat)
	}
//	public static function Arepondu(){
		//affecte toute la base de donnée
//	}
	public static function ComposePagResult($resultat){
		//Compose l'affichage de la page utilisateur(apres les calculs)
		ControllerSondage::AfficheRolePrinc($resultat);
		ControllerSondage::AfficheRoleSecond($resultat);
		echo "<h2 class=resTit>Voici le résultat pout tous vos roles :</h2>";
		echo $resultat->afficher(); 
		//ControllerSondage::setUpCookieguys($resultat);
		ControllerSondage::tracerToile($resultat);
		require(File::build_path(array('view','partager.php')));
	}
	public static function AfficheRolePrinc($res){
		//affichage du Role principale
		echo "<h2 class=resTit> Votre Role Principal est </h2>";
		require(File::build_path(array('view','Role',$res->getRoleMax().'.php')));
	}
	public static function AfficheRoleSecond($res){
		//affichage du Role secondaire
		echo"<h2 class=resTit> Votre Role Secondaire est </h2> ";
		require(File::build_path(array('view','Role',$res->get2RoleMax().'.php')));
	}
	public static function StoreRepPreli($idUtil){
		if (htmlspecialchars($_POST['Pays']) =="autre"){
		$pays=htmlspecialchars($_POST['autrePays']);
		}else{
			$pays=htmlspecialchars($_POST['Pays']);
		}
		if (htmlspecialchars($_POST['Etude']) =="autre"){
			$etude=htmlspecialchars($_POST['autreEtude']);
		}else{
			$etude=htmlspecialchars($_POST['Etude']);
		}
		if (htmlspecialchars($_POST['Situation_professionnelle']) =="autre"){
			$sitpro=htmlspecialchars($_POST['autreSituation_professionnelle']);
		}else{
			$sitpro=htmlspecialchars($_POST['Situation_professionnelle']);
		}
		if (htmlspecialchars($_POST['NomJeu'])== "autre"){
 			$nomjeu=htmlspecialchars($_POST['autreNomJeu']);
		}else{
			$nomjeu=htmlspecialchars($_POST['NomJeu']);
		}
		if (htmlspecialchars($_POST['Aspect_Pref'])== "autre"){
 			$aspectpref=htmlspecialchars($_POST['autreAspect_Pref']);
		}else{
			$aspectpref=htmlspecialchars($_POST['Aspect_Pref']);
		}
		if (htmlspecialchars($_POST['Aspect_Detes'])== "autre"){
 			$aspectdetes=htmlspecialchars($_POST['autreAspect_Detes']);
		}else{
			$aspectdetes=htmlspecialchars($_POST['Aspect_Detes']);
		}
		$Resppreli=New ModelReponsePreli($idUtil,$_POST['genre'],$_POST['DateNaissance'],$pays,$_POST['Situation_Maritale'],$_POST['Enfant_a_charges'],$etude,$sitpro,$_POST['Temps_Situation'],$_POST['Responsable'],$_POST['nombreResp'],$nomjeu,$_POST['DatedebJeu'],$_POST['Temps_Jeu'],$aspectpref,$aspectdetes,$_POST['Guilde'],$_POST['Nb_Membre'],$_POST['Grade'],$_POST['Sexe_oppose'],$_POST['Rencontre'],$_POST['Relation']);
		$Resppreli->save();
	}
	public static function StoreReponse($idUtil){
		foreach (ModelQuestion::getAllQuestion() as $question_toute) {
			$questionpath='idquestion'.$question_toute->getIdQuestion();
			try {
				$sql = "INSERT INTO sond_reponses(idUtilisateur,idquestion,valeur)
					VALUES (:util,:quest,:val_rep)";
				$reqprep=Model::$pdo ->prepare($sql);
				//echo "		ICI 		".$idUtil;
				$values=array(
			  		"util"=> $idUtil,
			  		"quest"=> $question_toute->getIdQuestion(),
			  		"val_rep"=>$_POST[$questionpath],
			  	);
				$reqprep-> execute($values);	
				//echo "			LA 		";
			} catch (PDOException $e) {
  				if (Conf::getDebug()) {
     				echo $e->getMessage(); // affiche un message d'erreur
     			} else {
     				echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
    			}
   				die();
			}
		}
	}
	public static function tracerToile($resultat){
		$res_moy= ModelResultat::getResMoy();
		require File::build_path(array('view','Toile.php'));
	}
}