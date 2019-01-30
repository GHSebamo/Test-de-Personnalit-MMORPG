<?php 
class ModelAdmin{
	private $motdepasse;
	public function getMDP(){
		return $this->motdepasse;
	}
	public static function getAllmdp(){
		$rep=Model::$pdo->query('SELECT * from sond_admin');
		$rep ->setFetchMode(PDO::FETCH_CLASS,'ModelAdmin');
		$tab_admin = $rep->fetchAll();
		return $tab_admin[0];
	}
	public static function verifmdp($texte){
		$tab=ModelAdmin::getAllmdp();
		foreach ($tab as $mdp) {
			if(Security::chiffrer($texte)==$mdp){
				return 1;
			}
		}
		return;
	}
	public static function insert($mdp){
		$mdp2=Security::chiffrer($mdp);
		$sql= "INSERT INTO sond_admin(MDP)
				VALUES (:mdp)";

				$req_prep=Model::$pdo->prepare($sql);
				$values=array(
					"mdp"=>$mdp2
				);
				$req_prep->execute($values);
	}
}
?>