<?php echo 
'<div class="rowDecision">
		<div class="question" id="idquestion'.$questioncat->getIdQuestion().'">

			<label class=box> Pas d\'accord </label>
			<label class="box boxVeryNo">
				<input type="radio" name="idquestion'.$questioncat->getIdQuestion().'" value="Pas du tout d\'accord" required>
				<span class="veryNO checkmark"></span>
			</label> 
			<label class="box boxNo">
				<input type="radio" name="idquestion'.$questioncat->getIdQuestion().'" value="Pas d\'accord">
				<span class="NO checkmark"></span>
			</label>
			<label class="box boxLittleNo">
				<input type="radio" name="idquestion'.$questioncat->getIdQuestion().'" value="Plutôt pas d\'accord">
				<span class="littleNO checkmark"></span>
			</label>
			<label class="box boxNeutral">
					<input type="radio" name="idquestion'.$questioncat->getIdQuestion().'" value="Neutre" checked>
					<span class="NEUTRAL checkmark"></span>
			</label>
			<label class="box boxLittleYes">
					<input type="radio" name="idquestion'.$questioncat->getIdQuestion().'" value="Plûtot d\'accord">
					<span class="littleYES checkmark"></span>
			</label>
			<label class="box boxYes">
					<input type="radio" name="idquestion'.$questioncat->getIdQuestion().'" value="D\'accord">
					<span class="YES checkmark"></span>
			</label>
			<label class="box boxVeryYes">
					<input type="radio" name="idquestion'.$questioncat->getIdQuestion().'" value="Tout à fait d\'accord">
					<span class="veryYES checkmark"></span>
			</label>
			<label class=box> D\'accord </label>
		</div>
</div>';
?>