<?php echo 
'<div class="row decision">
			<label class=box> Pas d\'accord </label>
			<label class="box boxVeryNo">
				<input type="radio" name="valeurrep" autocomplete="off" value="Pas du tout d\'accord" required>
				<span class="veryNO checkmark"></span>
			</label> 
			<label class="box boxNo">
				<input type="radio" name="valeurrep"  value="Pas d\'accord">
				<span class="NO checkmark"></span>
			</label>
			<label class="box boxLittleNo">
				<input type="radio" name="valeurrep"  value="Plutôt pas d\'accord">
				<span class="littleNO checkmark"></span>
			</label>
			<label class="box boxNeutral">
					<input type="radio" name="valeurrep"  value="Neutre">
					<span class="NEUTRAL checkmark"></span>
			</label>
			<label class="box boxLittleYes">
					<input type="radio" name="valeurrep"  value="Plûtot d\'accord">
					<span class="littleYES checkmark"></span>
			</label>
			<label class="box boxYes">
					<input type="radio" name="valeurrep"  value="D\'accord">
					<span class="YES checkmark"></span>
			</label>
			<label class="box boxVeryYes">
					<input type="radio" name="valeurrep"  value="Tout à fait d\'accord">
					<span class="veryYES checkmark"></span>
			</label>
			<label class=box> D\'accord </label>
</div>';
?>