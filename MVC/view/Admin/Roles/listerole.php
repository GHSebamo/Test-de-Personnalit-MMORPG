<?php
 		echo '<div id="liste"> ';
        foreach ($tab_role as $role){
            echo '<div class=role> <p>'
                . $role->getNom() .' : '.$role->getDescription().'<a href="?action=AfficherRole&role='.$role->getNom().'">Voir le Role </a> </p></div>';
        }
        echo '</div>';