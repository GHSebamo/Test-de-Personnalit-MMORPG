<button class=backa type="button" onclick="back()"> Précédent </button>
<input class=forwa type="submit">
</div>
</form>

<script>
function back() {
	document.getElementById(<?php echo $now; ?>).style.display="none";
	document.getElementById(<?php echo $precedent; ?>).style.display="inline";
}
</script>