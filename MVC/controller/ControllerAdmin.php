<?php
require_once(File::build_path(array('model','ModelResultat.php')));
require_once(File::build_path(array('model','ModelCategorie.php')));
require_once(File::build_path(array('model','ModelUtilisateur.php')));
require_once(File::build_path(array('model','ModelQuestion.php')));
require_once(File::build_path(array('model','ModelReponse.php')));
require_once(File::build_path(array('model','ModelEtreaffecter.php')));
require_once(File::build_path(array('model','ModelRole.php')));
require_once(File::build_path(array('model','ModelAdmin.php')));

require_once(File::build_path(array('model','ModelReponsePreli.php')));
class ControllerAdmin{
	public static function connect(){
		require Lib::build_path(array('view','Admin','connect.php'));
	}
	public static function rightlogin(){
		$mdp=$_POST['motdepasse'];
		if(!ModelAdmin::verifmdp($mdp)){
			echo "Mot de passe incorrect";
			require File::build_path(array('view','Admin','error.php'));
			return 0;
		}
		else{
			$_SESSION['isadmin']= 1;
			return 1;
		}
	} 
	/*public static function Inserermdp(){
		ModelAdmin::insert('soleil');
	}*/
	public static function AfficheOptionAdmin(){
//affiche toute les options que peut faire l'administrateur
		echo '<div id="Listeoption"><form class=Admin method="get">';
		echo '<label class=Admin><input type="radio" name="action" value="AfficheAllQuestion">Afficher toutes les Questions </label><br>';
		echo '<label class=Admin><input type="radio" name="action" value="AfficheAllRole">Afficher tous les Rôles </label><br>';
		echo '<label class=Admin><input type="radio" name="action" value="AfficheAllCategorie">Afficher toutes les Catégories </label><br>';
		echo '<label class=Admin><input type="radio" name="action" value="NbUtil">Afficher le nombre d\'Utilisateurs total et leurs Rôles</label><br> ';
		echo '<label class=Admin><input type="radio" name="action" value="CreerNouvelleCategorie">Créer une nouvelle Catégorie</label><br> ';
		echo '<label class=Admin><input type="radio" name="action" value="CreerNouvelleQuestion">Créer une nouvelle Question</label><br> ';
		echo '<label class=Admin><input type="radio" name="action" value="goToTelecharger">Télécharger les réponses des Utilisateurs</label><br>';
		//echo '<a href="?action=Inserermdp" >fe</a>';


		echo '<input type="submit"></form> </div>';
	}
	public static function CreerNouvelleAffectation(){
		$idquestion=$_GET['question_id'];
		$affect=new ModelEtreaffecter();
		require File::build_path(array('view','Admin','Affectations','listebyquestion.php'));
		require File::build_path(array('view','Admin','Affectations','createaffectation.php'));
	}
	public static function createdAffectation(){
		$affect = new ModelEtreaffecter($_GET['question_id'],$_POST['role'],$_POST['valeurrep'],$_POST['vaffect']);
		$affect->save();		
        require File::build_path(array('view','Admin','Affectations','createdaffectation.php'));
	}
	public static function ModifierAffectation(){
		$id=$_GET['question_id'];
		$role=$_GET['roleaaffecter'];
		$vrep=$_GET['valeur_rep'];
		$vaffect=$_GET['valeur_affectation'];
		require File::build_path(array('view','Admin','Affectations','updateAffectation.php'));
	}
	public static function UpdatedAffectation(){
        $data=array(
            'idquestion' => $_GET['question_id'],
            'role'=>$_POST['role'],
            'valeur_rep' => $_POST['vrep'],
        	'valeur_affectation' => $_POST['vaffect']);
        ModelEtreaffecter::update($data);
        require File::build_path(array('view','Admin','Affectations','updatedaffectation.php'));
    }
    	public static function DeleteAffectation(){	
		ModelEtreaffecter::DeleteByAll($_GET['question_id'],$_GET['roleaaffecter'],$_GET['valeur_rep']);		require File::build_path(array('view','Admin','Affectations','deleteaffectation.php'));	
	}	
	public static function CreerNouvelleQuestion(){
// permet de creer une nouvelle question
		//avec un formulaire
		$quest=new ModelQuestion();
		require File::build_path(array('view','Admin','Questions','updatequestion.php'));
	}
	public static function createdQuestion(){
		$quest = new ModelQuestion($_POST['idquestion'],$_POST['idcategorie'],$_POST['texte']);
		$quest->save();
		ControllerAdmin::AfficheAllQuestion();
	}
	public static function ModifierQuestion(){
		$quest= ModelQuestion::getQuestionbyId($_GET['question_id']);
		require File::build_path(array('view','Admin','Questions','updatequestion.php'));
	}
	public static function UpdatedQuestion(){ 	
        $data=array(
            'idquestion' => $_POST['idquestion'],
            'idcategorie' => $_POST['idcategorie'],
            'texte' => $_POST['texte']);
        ModelQuestion::update($data);
        $tab_question=ModelQuestion::getAllQuestion();
        require File::build_path(array('view','Admin','Questions','updatedquestion.php'));
    }
	public static function DeleteQuestion(){
		ModelQuestion::DeleteById($_GET['question_id']);
		$quest_id=$_GET['question_id'];
		$tab_question=ModelQuestion::getAllQuestion();
		require File::build_path(array('view','Admin','Questions','deletequestion.php'));	
	}	
	public static function CreerNouvelleCategorie(){
//permet de creer une question a une categorie
		//avec un formulaire
		$cate = new ModelCategorie();
		require File::build_path(array('view','Admin','Categories','updatecategorie.php'));
	}
	public static function createdCategorie(){
		$cate = new ModelCategorie($_POST['id'],$_POST['texte']);
		$cate->save();
		ControllerAdmin::AfficheAllCategorie();
	}
	public static function ModifierCategorie(){
		$cate= ModelCategorie::getCategoriebyId($_GET['categorie_id']);
		require File::build_path(array('view','Admin','Categories','updatecategorie.php'));
	}
	public static function UpdatedCategorie(){
		$data=array(
			'categorie_id'=> $_POST['id'],
			'categorie_texte' => $_POST['texte']);
		ModelCategorie::update($data);
		$tab_cate=ModelCategorie::getAllCategorie();
		require File::build_path(array('view','Admin','Categories','updatedcategorie.php'));
	}
	public static function DeleteCategorie(){
		$cat_id=$_GET['categorie_id'];
		if($cat_id){
			ModelCategorie::DeleteById($cat_id);
		}
		$tab_cate=ModelCategorie::getAllCategorie();
		require File::build_path(array('view','Admin','Categories','deletecategorie.php'));	
	}
	public static function AfficheAllQuestion(){
// affiche la liste de toute les question
		//chaque question cliquable qui mene vers la question en particulier
		$tab_question= ModelQuestion::getAllQuestion();
		require File::build_path(array('view','Admin','Questions','listequestion.php'));
	}	
	public static function AfficheQuestion(){
// affiche une question particuliere avec aussi toute les affectations
		//avec des possibilite de modification sur la question et chaque affectation(voir delete)
		$idquestion = $_GET['question_id'];
		// la versions propre qui ne marche pas je sais pas pourquoi
		$quest=ModelQuestion::getQuestionById($idquestion);
		echo '<div class=displayQuestion> <p> La question '.$idquestion.' dont la catégorie est '.ModelCategorie::getTextebyCat($quest->getIdCategorie()).' et le texte est : '.$quest->getTexte().'<a class=questionAdmin href="?action=ModifierQuestion&question_id='.$idquestion.'"><br> Cliquer ici pour la modifier</a><br><a class=questionAdmin href="?action=DeleteQuestion&question_id='.$idquestion.'" onclick="return confirm(\'Voulez vous vraiment supprimer ?\')"> Ou ici pour la supprimer </a> </p>
 ';
		require File::build_path(array('view','Admin','Affectations','listebyquestion.php'));
		
		// affiche aussi toute les afectations de la question
		/*$quest=ModelQuestion::getQuestionById($idquestion);
		echo '<div> <p> La question '.$idquestion.' dont la categorie est '.ModelCategorie::getTextebyCat($quest[1]).' et le texte est '.$quest[2].'.<a href="?action=ModifierQuestion&question_id='.$idquestion.'"><br> Cliquer ici pour la modifier</a>.<br><a href="?action=DeleteQuestion&question_id='.$idquestion.'> Ou ici pour la supprimer </a> </div>' ;
		*/
	}
    public static function AfficheAllCategorie(){
    	$tab_cate= ModelCategorie::getAllCategorie();
    	require File::build_path(array('view','Admin','Categories','listecategorie.php'));
    	
    }
    public static function AfficherCategorie(){
    	$idcategorie=$_GET['categorie'];
    	echo '<p> La catégorie d\'id '.$idcategorie.' dont le thème est : '.ModelCategorie::getTextebyCat($idcategorie).'<a href="?action=ModifierCategorie&categorie_id='.$idcategorie.'"><br> Cliquer ici pour la modifier</a>.<br><a href="?action=DeleteCategorie&categorie_id='.$idcategorie.'" onclick="return confirm(\'Voulez vous vraiment supprimer ? (toutes les questions seront transferés à la catégorie Autre Questions)\')"> Ou ici pour la supprimer </a> </p>
    		<div id="questionbycate"> <h2>Les questions de la catégorie '.ModelCategorie::getTextebyCat($idcategorie).' :</h2>';
    		$tab_question=ModelQuestion::getQuestionbyCat($idcategorie);
    		if (empty($tab_question)){
				echo '<p> Aucune question n\'appartient à cette catégorie.</p>';
			}
    		require File::build_path(array('view','Admin','Questions','listequestion.php'));
    }
    public static function AfficherQuestionParcategorie($cate){
	//affiche toute les question qui affecte un role
	echo'<div id="questionbycate"> <h2>Les questions de la catégorie '.$role.' :</h2>';
	$tab_question=ModelQuestion::getQuestionByRole($role);
	require File::build_path(array('view','Admin','Questions','listequestion.php'));
	}
    public static function AfficheAllRole(){
		$tab_role= ModelRole::getAllRole();
		require File::build_path(array('view','Admin','Roles','listerole.php'));
    }
    public static function AfficherRole(){
    	$nomRole=$_GET['role'];
    	echo '<p> Le rôle séléctionné est '.$nomRole.', Sa description est '.ModelRole::getDescriptionByRole($nomRole).'</p>';
    	ControllerAdmin::AfficherQuestionParRole($nomRole);
    }
	public static function AfficherQuestionParRole($role){
	//affiche toute les question qui affecte un role
	echo'<div id="questionbyrole"> <h2>Les questions affectant le Rôle '.$role.' : </h2>';
	$tab_question=ModelQuestion::getQuestionByRole($role);
	if (empty($tab_question)){
		echo '<p> Aucune question n\'affecte ce rôle</p>';
	}
	require File::build_path(array('view','Admin','Questions','listequestion.php'));
	}
	public static function NbUtil(){
		$utilmoyen=ModelResultat::getresMoy();
		$tabUtilrolemax=ModelResultat::getNbUtilrolemax();
		$tabUtil2rolemax=ModelResultat::getNbUtil2rolemax();
		require(File::build_path(array('view','Admin','Utilisateurs','NbUtil.php')));
	}
	public static function deconnection(){
		session_unset();
		echo" Vous êtes bien déconnecté";
	}
	public static function array2csv(array &$array){
	   if (count($array) == 0) {
	     return null;
	   }
	   ob_start();
	   $df = fopen("php://output", 'w');
	   fputcsv($df, array_keys(reset($array)));
	   foreach ($array as $row) {
	      fputcsv($df, $row);
	   }
	   fclose($df);
	   return ob_get_clean();
}
	public static function download_send_headers($filename) {
	    // disable caching
	    $now = gmdate("D, d M Y H:i:s");
	    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
	    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
	    header("Last-Modified: {$now} GMT");

	    // force download  
	    header("Content-Type: application/force-download");
	    header("Content-Type: application/octet-stream");
	    header("Content-Type: application/download");

	    // disposition / encoding on response body
	    header("Content-Disposition: attachment;filename={$filename}");
	    header("Content-Transfer-Encoding: binary");
	}
	public static function allrep(){
		$tab_allrep= array();
		foreach (ModelUtilisateur::getAllUtil() as $util) {
			$tab1=ModelReponsePreli::getReponseByUt($util->getIdUtilisateur());
			$tab2=ModelReponse::getReponseByUt($util->getIdUtilisateur());
			// version propre mais buguer
/*			$tabutil=array(
				"idUtilisateur" =>$tab1[0][0],
				"genre"=>$tab1[0][1],
				"Date_Naissance"=>$tab1[0][2],
				"Pays"=>$tab1[0][3],
				"Situation_Maritale"=>$tab1[0][4],
				"Enfant_a_charges"=>$tab1[0][5],
				"Niveau_Etudes"=>$tab1[0][6],
				"Situation_professionnelle"=>$tab1[0][7],
				"Temps_Situation"=>$tab1[0][8],
				"Responsable"=>$tab1[0][9],
				"Responsable_nombre"=>$tab1[0][10],
				"NomJeu"=>$tab1[0][11],
				"DatedebJeu"=>$tab1[0][12],
				"Temps_Jeu"=>$tab1[0][13],
				"Aspect_Pref"=>$tab1[0][14],
				"Aspect_Detes"=>$tab1[0][15],
				"Guilde"=>$tab1[0][16],
				"Nb_Membre"=>$tab1[0][17],
				"Grade"=>$tab1[0][18],
				"Sexe_oppose"=>$tab1[0][19],
				"Rencontre"=>$tab1[0][20],
				"Relation"=>$tab1[0][21],
			);
			if ($tab2){
				for($i=0; $i<sizeof($tab2);$i++) {
				$string='question_'.$tab2[$i][0];
				$tabutil[$string]= $tab2[$i][1];
				}
			}
			array_push($tab_allrep,$tabutil);
*/			// version TRES sale mais non buguer
			$string = '';
			
			if ($tab2){
				$string='question_'.$tab2[0][0];
			}
			if($tab1){
				$tabutil=array(
					"idUtilisateur" =>"",
					"genre"=>$tab1[0][0],
					"Date_Naissance"=>$tab1[0][1],
					"Pays"=>$tab1[0][2],
					"Situation_Maritale"=>$tab1[0][3],
					"Enfant_a_charges"=>$tab1[0][4],
					"Niveau_Etudes"=>$tab1[0][5],
					"Situation_professionnelle"=>$tab1[0][6],
					"Temps_Situation"=>$tab1[0][7],
					"Responsable"=>$tab1[0][8],
					"Responsable_nombre"=>$tab1[0][9],
					"NomJeu"=>$tab1[0][10],
					"DatedebJeu"=>$tab1[0][11],
					"Temps_Jeu"=>$tab1[0][12],
					"Aspect_Pref"=>$tab1[0][13],
					"Aspect_Detes"=>$tab1[0][14],
					"Guilde"=>$tab1[0][15],
					"Nb_Membre"=>$tab1[0][16],
					"Grade"=>$tab1[0][17],
					"Sexe_oppose"=>$tab1[0][18],
					"Rencontre"=>$tab1[0][19],
					"Relation"=>$tab1[0][20],
					$string=>$tab1[0][21],
				);
			}
			if ($tab2){
				for($i=0; $i<sizeof($tab2);$i++) {
					if ($i+1==sizeof($tab2)){
						$string='';
					}else {
						$string='question_'.$tab2[$i+1][0];
					}
					$tabutil[$string]= $tab2[$i][1];
				}
			}
			array_push($tab_allrep,$tabutil);
		/*
			foreach (ModelReponsePreli::getReponseByUt($util->getIdUtilisateur()) as $key) {	
				foreach ($key as $value) {
					echo $value;
				}
				array_push($tab_allrep,$key);
				echo "<br>";
			}*/
//			foreach (ModelReponse::getReponseByUt($util->getIdUtilisateur()) as $key) {
//				array_push($tab_allrep,$key);
//			}
		}
		return $tab_allrep;
	}
	public static function TelechargerRep(){
	$tab= self::allrep();
	self::download_send_headers("sond_reponse" . date("Y-m-d") . ".csv");
	echo self::array2csv($tab);
	die();
	} 

	public static function goToTelecharger() {
		header("Location:Telecharger.php");
	}
}