<script language="JavaScript">
	function affiche_TMPs() {
if (document.sondage.Situation_professionnelle.selectedIndex == 2||document.sondage.Situation_professionnelle.selectedIndex == 3)
document.getElementById('Tmppartouplein').style.display = 'block';
else
document.getElementById('Tmppartouplein').style.display = 'none';
 }
 	function affiche_Resp() {
if (document.sondage.Responsable.selectedIndex == 2)
document.getElementById('Yresp').style.display = 'block';
else
document.getElementById('Yresp').style.display = 'none';
 }
 	function affiche_Guilde() {
if (document.sondage.Guilde.selectedIndex == 2)
document.getElementById('inguilde').style.display = 'block';
else
document.getElementById('inguilde').style.display = 'none';
 }
</script>
<form method="post" action="resultat.php" name="sondage">
    <div id="qSetUtil">
	<fieldset class=fieldUtil>
		<legend class=fieldLeg>Critères socio-démographiques</legend>
		<p>
			<label for="genre"> Genre :</label>
			<input type="radio" name="genre" id="genre" value="homme" required checked> Homme
			<input type="radio" name="genre" value="femme" > Femme
            <input type="radio" name="genre" value="autre" > Autre
		</p>
		<p>
			<label for ="datenaissance"> Date de naissance :</label>
			<input type="date" name="DateNaissance" id="datenaissance"  value="2019-01-01">
		</p>
		<p>
			<label for="Pays">Pays :</label>
			<select id="Pays" name="Pays" required>
                <option value="" style="display:none">Pas choisis </option>
    			<option value="France" selected>France </option>
    			<option value="Belgique">Belgique</option>
    			<option value="Canada">Canada</option>
    			<option value="Suisse">Suisse</option>
    			<option value="autre"> Autre </option>
 			</select> 
			  Autre : <input id="AutrePays" type="text" name="autrePays" placeholder="Autre">
		</p>
		<p>
			<label for="SitMar"> Situation maritale :</label>
			<input type="radio" id="SitMar" name="Situation_Maritale" value="Marié" required checked> Marié
			<input type="radio" name="Situation_Maritale" value="Célibataire"> Célibataire
		</p>
		<p>
			<label for="Enfant"> Nombre d'enfants à charge :</label>
			<input type="Number" id="Enfant" name="Enfant_a_charges" required min="0" value="0">
		</p>
		<p>
			<label for="Etude">Niveau d'étude :</label>
            <select id="Etude" name="Etude" required>
                <option value="" style="display:none">Pas choisis </option>
    			<option value="College" selected> Collège </option>
    			<option value="Lycee"> Lycée </option>
    			<option value="Bac"> Bac </option>
    			<option value="Cap ou Bep"> Cap ou Bep </option>
    			<option value="Bac +3"> Bac + 3 </option>
    			<option value="Bac +5"> Bac + 5 </option>
    			<option  value="Bac +8"> Bac + 8 </option>
    			<option value="autre"> Autre </option> 
            </select>
            Autres études :<input type="text" id="autreEtude" name="autreEtude"  placeholder="Autre">
		</p>
		<p>
			<label for="SitPro">Situation professionnelle :</label><br>
			<select id="SitPro" name="Situation_professionnelle" OnChange="affiche_TMPs();" required>
                <option value="" style="display:none">Pas choisis </option>
				<option value="Etudiant" selected> Je suis étudiant à plein temps </option>
    			<option value="Plein_Temps"> Je travaille à plein temps </option>
    			<option value="Temps_partiel"> Je travaille ou suis étudiant(e) à temps partiel </option>
    			<option value="foyer"> Je suis père ou mère au foyer </option>
    			<option value="chomage"> Je suis au chômage </option>
    			<option value="retraite"> Je suis retraité </option>
                <option value="autre"> Autre </option>
 			</select>
			Autres situation :<input type="text" id="autreSitPro" name="autreSituation_professionnelle"  placeholder="Autre">
		</p>
		<p id="Tmppartouplein" style="display:none">
			<label for="tempstravail"> Intitulé temps plein ou partiel :</label>
			<input type="text" id="tempstravail" name="Temps_Situation" value="">
		</p>
		<p>
			<label for="Resp">Êtes-vous responsable d'une équipe, d'un service ou d'une structure dans votre profession ? </label>
			<select id="Resp" name="Responsable" OnChange="affiche_Resp();">
                <option value="" style="display:none">Pas choisis </option>
				<option value="non" selected>Non</option>
    			<option value="oui">Oui </option>
    		</select>
    	</p>
    	<div id="Yresp" style="display:none">
			<p>
    			<label for="nbResp">En tant que responsable, combien de personnes dirigez-vous dans votre profession ?</label>
    			<input type="number" id="nbResp" name="nombreResp" value="0" min="0">
    		</p>
   		</div>
    </fieldset>
    <fieldset class=fieldUtil>
    	<legend class=fieldLeg>Critères de style de jeux</legend>

    	<p> 
    		<label for="Namejeu"> Quel est le nom de  votre MMORPG le plus joué ? (il vous faudra répondre au sondage en pensant à ce jeu)</label>
    		<select id="Namejeu" name="NomJeu" required>
                <option value="" style="display:none">Pas choisis </option>
                <option value="autre">Autre</option>
    			<option value="World Of Warcraft" selected>World Of Warcraft</option>
    			<option value="Final Fantasy XIV">Final Fantasy XIV</option>
    			<option value="Dofus">Dofus</option>
    			<option value="Guild Wars 2">Guild Wars 2</option>
    			<option value="AION">AION</option>
 			</select>
              Autre : <input id="AutreNomJeu" type="text" name="autreNomJeu" placeholder="Autre">
 		</p>
 		<p>
 			<label for="Datedebjeu">Depuis quand jouez-vous à ce jeu ? </label>
 			<select id="Datedebjeu" name="DatedebJeu"  required>
                <option value="" style="display:none">Pas choisis </option>
    			<option value="2018" selected> 2018 </option>
    			<option value="2017"> 2017 </option>
    			<option value="2016"> 2016 </option>
    			<option value="2015"> 2015 </option>
    			<option value="2014"> 2014 </option>
    			<option value="2013"> 2013 </option>
    			<option value="2012"> 2012 </option>
    			<option value="2011"> 2011 </option>
    			<option value="2010"> 2010 </option>
    			<option value="2009"> 2009 </option>
    			<option value="2008"> 2008 </option>
    			<option value="2007"> 2007 </option>
    			<option value="2006"> 2006 </option>
    			<option value="2005"> 2005 </option>
    			<option value="2004"> 2004 </option>
    			<option value="2003"> 2003 </option>
    			<option value="2002"> 2002 </option>
    			<option value="2001"> 2001 </option>
    			<option value="2000"> 2000 </option>
    			<option value="1999"> 1999 </option>
    			<option value="1998"> 1998 </option>
    			<option value="1997"> 1997 </option>
    			<option value="1996"> 1996 </option>
    			<option value="1995"> 1995 </option>
    			<option value="1994"> 1994 </option>
    			<option value="1993"> 1993 </option>
    			<option value="1992"> 1992 </option>
    			<option value="1991"> 1991 </option>
 			</select>
		</p>
		<p>
			<label for="tmpjeu">Combien de temps passez-vous sur les jeux vidéo chaque semaine ? </label>
			<select id="tmpjeu" name="Temps_Jeu" required>
                <option value="" style="display:none">Pas choisis </option>
    			<option value="Moins de 10h" selected>Moins de 10h</option>
    			<option value="11h-20h">De 11h à 20h</option>
    			<option value="21h-30h">De 21h à 30h</option>
    			<option value="31h-40h">De 31h à 40h</option>
    			<option value="41h-50h">De 41h à 50h</option>
    			<option value="Plus de 50h">Plus de 50h</option>
    			<option value="arreter">J'ai arreté de jouer aux jeux vidéos</option>
 			</select>
 		</p>
 		<p> 
 			<label for="Aspectpref">Quel aspect de ce MMORPG préférez-vous ? </label>
 		     <select id="Aspectpref" name="Aspect_Pref" required>
                <option value="" style="display:none">Pas choisis </option>
                <option value="autre">Autre</option>
                <option value="Contact social" selected>Contact social</option>
                <option value="Jouer seul">Jouer seul</option>
                <option value="Appartenir à une guilde">Appartenir a une guilde</option>
                <option value="Le jeu de rôle (RP)">Le jeu de rôle (RP)</option>
                <option value="Le joueur contre joueur (PvP ou JcJ)">Le joueur contre joueur (PvP ou JcJ)</option>
                <option value="Les combats/tuer des mobs">Les combats/tuer des mobs</option>
            </select>
              Autre : <input id="autreAspect_Pref" type="text" name="autreAspect_Pref" placeholder="Autre">
    	</p>
    	<p>
    		<label for="Aspectdetes">Quel aspect de ce MMORPG n'appréciez vous pas ? </label>
             <select id="Aspectdetes" name="Aspect_Detes" required>
                <option value="" style="display:none">Pas choisis </option>
                <option value="autre">Autre</option>
                <option value="Contact social" selected>Évolution difficile pour les joueurs occasionnels</option>
                <option value="Jouer seul">Difficile de jouer seul</option>
                <option value="Appartenir a une guilde">Pénalité lors des morts</option>
                <option value="Trop de &quotcamping&quot">Trop de "camping"</option>
                <option value="Aider collaborer avec des débutants">Aider collaborer avec des débutants</option>
            </select>
              Autre : <input id="autreAspect_Detes" type="text" name="autreAspect_Detes" placeholder="Autre">
    	</p>
    	<p>
			<label for="guilde">Faites-vous partie d'une guilde ?</label>
			<select id="guilde" name="Guilde" OnChange="affiche_Guilde();"  required>
                <option value="" style="display:none">Pas choisis </option>
    			<option value="non" selected>Non</option>
    			<option value="oui">Oui </option>
    		</select>
    	</p>
	    	<div id="inguilde" style="display:none">
	    	<p>
	    		<label for="nbmemb" >De combien de membres se compose votre guilde ?</label>
	    		<input type="number" id="nbmemb" name="Nb_Membre" value="0">
	    	</p>
	    	<p>
				<label for="grade">Quel grade occupez-vous dans votre guilde :</label>
				<select id="grade" name="Grade" required>
                    <option value="" style="display:none"> Pas choisis </option>
	    			<option value="Chef"> Chef (direction de la guilde/clan/faction) </option>
	    			<option value="Officier"> Officier (ou responsable d'une fonction dans la guilde/clan/faction)</option>
	    			<option value="Membre" selected> Membre</option>
	    		</select>
	    	</p>
	    </div>
    	<p>
			<label for="sexeopp">Avez-vous déjà joué un personnage du sexe opposé dans un MMORPG ?</label>
			<select id="sexeopp" name="Sexe_oppose" required>
                <option value="" style="display:none">Pas choisis </option>
                <option value="oui">Oui </option>
    			<option value="non" selected="">Non</option>
    		</select>
    	</p>
    	<p>
			<label for="Renc">Avez-vous déjà rencontré physiquement des joueurs que vous avez connus dans ce MMORPG (rencontre IRL) ?</label>
			<select id="Renc" name="Rencontre" required>
                <option value="" style="display:none">Pas choisis </option>
    			<option value="oui">Oui </option>
    			<option value="non" selected="">Non</option>
    		</select>
    	</p>
    	<p>
			<label for="Rel">Avez-vous déjà eu une relation amoureuse avec quelqu'un que vous avez rencontré dans ce MMORPG ?</label>
			<select id="Rel" name="Relation" required>
                <option value="" style="display:none">Pas choisis </option>
    			<option value="oui">Oui </option>
    			<option value="non" selected="">Non</option>
    		</select>
    	</p>
	</fieldset>