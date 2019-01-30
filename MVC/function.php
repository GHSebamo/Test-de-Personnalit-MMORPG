<?php
	public static function AfficheQset($idCatQset){
		echo '<div id=cat'.$idCatQset.' style="display:none">';//Cela permet que de base la catégorie ne sois pas afficher
		if(ModelQuestion::getQuestionbyCat($idCatQset)){ //On entre que si La catégorie possède au moins une question
			foreach(ModelQuestion::getQuestionbyCat($idCatQset) as $questioncat){ //On fait une boucle pour chaque question de la catégorie
				echo '<div class=question'.$questioncat->getIdQuestion().'>'.'<p> '.$questioncat->getTexte().' : </p>'; // On affiche un diviseur et le texte de la question
				require(File::build_path(array('view','rowdecision.php')));//On appelle la vue qui permet de prendre les choix
				echo '</div>';//fermeture du diviseur de la question
			}
		}//sort du if
		//par la suite le but est de déterminer si la catégorie 0 possède des questions, si c'est le cas c'est elle qui appelle la vu de la transition finale permettant d'envoyer le formulaire sinon on regarde si Notre catégorie est la catégorie max, si elle l'est c 'est elle qui appellera La vue de la transition finale 
		// Au niveau des transsition justement, il est possible que au cours des manipulation des catégorie on arrive a un stade ou nous aurions Les categorie d'id 1 2 3 et 5 mais pas la catégorie 4 car elle a été supprimer. Il falait donc que les transition cache la catégorie actuelle et affiche la catégorie suivante ou precedente (selon le choix), sans pouvoir faire un simple -1 ou +1 nous avons donc fait 2 fonctions qui vont cherché la prochaine ou la précédente directement dans la base de donnée sachant que si la précedente est la catégorie 0, Qui je le rappelle ne contient pas les questions Utilisateurs mais les questions de la catégorie autre question, On n'affiche pas Cette catégorie mais le question set Utilisateur.  
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
		}
		echo '</div>';
	}
?>	