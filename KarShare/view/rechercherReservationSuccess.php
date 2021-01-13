  <?php
  if( $context->getSessionAttribute("User")!=null){ 
  }
 
?>
<h2 class="w3-center w3-text-blue">
	Voici les réservations pour <?php
    echo $context->getSessionAttribute("User")->nom;
    ?>
</h2>
<script>

</script>
<?php
include('ViewLib/dataBandeauGeneration.php');
?>
	<div class="w3-row ">
		<div class="w3-quarter">
			<p>	
			</p>
		</div>

		<div class="w3-center w3-panel w3-half w3-center">

	<?php
	if ($context->reservations==null){

		echo '<p>'.$context->info.'</p>';
	}
	else {
		?>
	<table class="w3-table w3-striped w3-cyan w3-centered"  >
		<tr>
			<th>Numero de la réservation</th>
			<th>Conducteur</th>
			<th>Tarif</th>
			<th>Ville de départ</th>
			<th>Ville d'arrivée</th>
			<th>Nombre de place restante</th>
			<th>Heure de depart</th>
			<th>Contraintes</th>
			<th>Annuler la réservation</th>
		</tr>
		<?php
		foreach($context->reservations as $reservation){
			echo "<tr>";
			echo "<td>$reservation->id</td>";

			echo "<td>  ".$reservation->voyage->utilisateur->nom;
			echo " ".$reservation->voyage->utilisateur->prenom."</td>";
			echo "<td>".$reservation->voyage->tarif."</td>";
			echo "<td>".$reservation->voyage->trajet->depart."</td>";
			echo "<td>".$reservation->voyage->trajet->arrivee."</td>";
			echo "<td>".$reservation->voyage->nbplace."</td>";
			echo "<td>".$reservation->voyage->heuredepart."</td>";
			echo "<td>".$reservation->voyage->contraintes."</td>";
			if (isset($_SESSION["User"])){
						echo '<td><form  action=""   method="get" style="">
						<input type="hidden" name="action" value="annulerReservation" >
						<input type="hidden" name="idreservation" value="'.$reservation->id.'" >
						<input onclick="envoieRequeteAnnulationReservation('.$reservation->id.')" id="'.$reservation->id.'" type="submit" value="Annuler" class="w3-bar-item w3-button w3-text-blue w3-hover-blue">
						</form></td>';
			}
			echo "</tr>";
		}
	}
	?>

</table>
<br>
<?php
include('ViewLib/retourAccueil.php');
?>
	</div>

<script type="text/javascript">
window.onload=actualiseBandeau();
</script>
