<button class=forwa type="button" onclick="displayQsetUtil()"> Commencer </button>
</div>

<script>
function displayQsetUtil() {
	document.getElementById("qSetUtil").style.display="none";
	document.getElementById(<?php echo $suivant; ?>).style.display="inline";
}
</script>