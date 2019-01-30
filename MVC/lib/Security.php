<?php
class Security{

	private static $seed = 'GZ86SIOHOOshoqsiy6';
	public static function chiffrer($texte) {
			$texte2=Security::getSeed().$texte;
	  $texte_chiffre = hash('sha256', $texte);
	  return $texte_chiffre;
	}	
	static public function getSeed() {
   		return self::$seed; 
	}
}
?>