<button class=backa type="button" onclick="reverse<?php echo $idCatQset; ?>()"> Précédent </button>
<button class=forwa type="button" onclick="forward<?php echo $idCatQset; ?>()"> Suivant </button>

<script>
function forward<?php echo $idCatQset; ?>() {
	document.getElementById(<?php echo $now; ?>).style.display="none";
	document.getElementById(<?php echo $suivant; ?>).style.display="inline";
}
function reverse<?php echo $idCatQset; ?>() {
	document.getElementById(<?php echo $now; ?>).style.display="none";
	document.getElementById(<?php echo $precedent; ?>).style.display="inline";
}
</script>