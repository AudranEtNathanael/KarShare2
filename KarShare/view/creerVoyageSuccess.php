<div class="w3-row">

	<div class="w3-twothird w3-center w3-panel">
		<span onclick="document.getElementById('id04').style.display='none'" class="w3-button w3-display-topright">&times;</span>
		<h3 class="w3-text-blue">Création d'un voyage</h3>

		<div class="w3-row">
			<div class="  w3-center w3-panel ">
			  <?php
				$band="hidden";
				$color="w3-red";
				$txtband="";

				if ($context->infoLinkedToView) {
					$band="";
					$color="w3-theme";
					$txtband=$context->infoLinkedToView;
				}
					?>
					<div id="bandeauLinkedToView" <?php echo $band ?> class="<?php echo "$color" ?>">
						<?php echo " $txtband !" ?>
					</div>

			</div>
		</div>

		<?php
		if($context->createdVoyage){
			echo '<table class="w3-table w3-striped w3-theme-d2" NNNstyle=width:50% >';
				echo "<tr>";
					echo "<th>Trajet</th>";
					echo "<th>Conducteur</th>";
					echo "<th>Tarif</th>";
					echo "<th>Place</th>";
					echo "<th>Heure</th>";
					echo "<th>Contraintes</th>";
				echo "</tr>";
				echo "<tr  class='w3-text-grey'>";
					echo "<td>".$context->createdVoyage->trajet->depart."/".$context->createdVoyage->trajet->arrivee."</td>";
					echo "<td>  ".$context->createdVoyage->utilisateur->nom." ".$context->createdVoyage->utilisateur->prenom."</td>";
					echo "<td>".$context->createdVoyage->tarif."</td>";
					echo "<td>".$context->createdVoyage->nbplace."</td>";
					echo "<td>".$context->createdVoyage->heuredepart."</td>";
					echo "<td>".$context->createdVoyage->contraintes."</td>";
					echo "</tr>";
			echo '</table><br>';
			echo "<h4 class='w3-text-blue'>Nouveau Voyage</h4>";
		}
		?>


		<form action="envoieRequeteCreationVoyage()"  target="_blank" method="get">
			<input type="hidden" name="action" value="creerVoyage" >

			<label for="villedep">Ville de depart :</label><br>
			<input type="text" name="villedep" id="villedep" value="Montpellier" class="w3-input w3-border"><br>
			<label for="villefin">Ville d'arrivée :</label><br>
			<input type="text" name="villefin" id="villefin" value="Bordeaux" class="w3-input w3-border"><br>
			<label for="tarif">Tarif :</label><br>
			<input type="number" name="tarif" id="tarif" value="10" class="  w3-input w3-border"><br>
			<label for="place">Nombre de place :</label><br>
			<input type="number" name="place" id="place" value="3" class="  w3-input w3-border"><br>
			<label for="heure">Heure de départ :</label><br>
			<input type="number" name="heure" id="heure" value="10" class="  w3-input w3-border"><br>
			<label for="contraintes">Contraintes :</label><br>
			<input type="text" name="contraintes" id="contraintes" value="Aucune" class="  w3-input w3-border"><br>
			<input  onClick="envoieRequeteCreationVoyage()" value="Créer" class="  w3-button w3-theme-d3">
		</form>
	</div>
	<div class="w3-third w3-center">
		<div>
			<br>
			<button onclick="document.getElementById('id03').style.display='block';document.getElementById('id04').style.display='none'" class="w3-bar-item w3-button w3-text-blue w3-hover-blue"><i class="fa fa-user"></i> Profile</button>
		</div>
		<br>
		Voulez vous déconnecter?
		<form  action=""   method="get" style="">
			<input type="hidden" name="action" value="deconnexion" >
			<input onclick="envoieRequeteDeconnexion()" type="submit" value="Deconnexion" class="w3-bar-item w3-button w3-text-blue w3-hover-blue">
		</form>
	</div>
</div>
