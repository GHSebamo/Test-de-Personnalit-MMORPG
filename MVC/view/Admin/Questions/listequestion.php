 <?php
 		echo '<div id="allquestion"> ';
 		if ($tab_question){
      		foreach ($tab_question as $question){
            	echo '<div class=allQuestion> <p> La question d\'id '
                	. $question->getIdQuestion() .' dont le texte est : '.$question->getTexte().'. Appartient à la catégorie : '.ModelCategorie::getTexteByCat($question->getIdCategorie()).' <a href="?action=AfficheQuestion&question_id='.$question->getIdQuestion().'">Voir la question </a> </p></div>';
        	}
        }
        echo '</div>';
        echo '<a class=BoutonUtile href="?action=CreerNouvelleQuestion"><br> Creer Une nouvelle question</a> ';
        ?>