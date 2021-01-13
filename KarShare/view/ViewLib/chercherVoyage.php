<form action="envoieRequete()"  method="get" style="width:50%">
	<div class="w3-row w3-center">
		<input  onClick="envoieRequete()" value="Chercher des voyages" class="w3-col l4 w3-button w3-theme-d3">
		<input type="text" name="depart" id="depart" value="Paris" class="w3-col l4 w3-input w3-border">
		<input type="text" name="arrivee" id="arrivee" value="Lyon" class="w3-col l4 w3-input w3-border">
		<input class="w3-check  w3-theme" name="correspondances" value="true" id="correspondances" type="checkbox" >
			<label>Autoriser les correspondances</label>
	</div>
</form>
