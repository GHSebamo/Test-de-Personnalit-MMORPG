 <?php
 		echo '<div id="liste"> ';
 		if($tab_cate){
	        foreach ($tab_cate as $categorie){
	            echo '<div class=role> <p>La catégorie d\'id '
	                . $categorie->getIdCategorie() .'. Qui regroupe les questions sous le thème suivant : '.$categorie->getTexte().'  <a href="?action=AfficherCategorie&categorie='.$categorie->getIdCategorie().'">Voir la catégorie </a> </p></div>';
	        }
	    }else echo "Il n'a pas encore de catégorie.";
        echo '</div>';
        echo '<a href="?action=CreerNouvelleCategorie"><br> Créer une nouvelle Catégorie</a> ';
?>