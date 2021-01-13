



<?php
include('ViewLib/dataBandeauGeneration.php');
?>


<h4 class="w3-center">Voici les voyages pour le trajet entre <?php echo $context->depart ?> et <?php echo $context->arrivee ?> :</h4>
<center>

<table class="w3-table w3-striped w3-cyan w3-centered" style=width:50% >
	<tr>
		<th>Numero du voyage</th>
		<th>Conducteur</th>
		<th>Tarif</th>
		<th>Nombre de place</th>
		<th>Heure de depart</th>
		<th>Contraintes</th>
		<?php
		if (isset($_SESSION["User"])){
			?>		
			<th>Reserver</th>
		<?php 
		} 
	?>
	</tr>
	<?php
		/*
		function cmp($a, $b) {
			if (count($a) == count($b)) {
				return 0;
			}
			return (count($a) < count($b)) ? -1 : 1;
		}
		
		usort($context->voyagesAndCorresp, 'cmp');
		 */
		foreach($context->voyagesAndCorresp as $CorrespList){
			if(count($CorrespList) > 1){
				echo "<tr>";
				if (isset($_SESSION["User"])){
					echo "<th colspan='7' class='w3-dark-grey'><small>Correspondances<small></th>";
				}else{
					echo "<th colspan='6' class='w3-dark-grey'><small>Correspondances<small></th>";
				}
				echo "</tr>";
			}else{
				echo "<tr>";
				if (isset($_SESSION["User"])){
					echo "<th colspan='7' class='w3-dark-grey'><small>Voyage Simple<small></th>";
				}else{
					echo "<th colspan='6' class='w3-dark-grey'><small>Voyage Simple<small></th>";
				}
				echo "</tr>";
			}
			foreach($CorrespList as $corresp){
				echo "<tr>";
				echo "<td>$corresp->id</td>";
				
				echo "<td>  ".$corresp->utilisateur->nom;
				echo " ".$corresp->utilisateur->prenom."</td>";
				echo "<td>$corresp->tarif</td>";
				echo "<td>$corresp->nbplace</td>";
				echo "<td>$corresp->heuredepart</td>";
				echo "<td>$corresp->contraintes</td>";
				if (isset($_SESSION["User"])){
							echo '<td><form  action=""   method="get" style="">
							<input type="hidden" name="action" value="reserverVoyage" >
							<input type="hidden" name="idvoyage" value="'.$corresp->id.'" >
							<input onclick="envoieRequeteReservation('.$corresp->id.')" id="'.$corresp->id.'" type="submit" value="Reserver" class="w3-bar-item w3-button w3-text-blue w3-hover-blue">
							</form></td>';
				}
				echo "</tr>";
			}
		}
	?>

</table>
<br>


<?php
include('ViewLib/chercherVoyage.php');
?>

<?php
include('ViewLib/retourAccueil.php');
?>

</center>
<script type="text/javascript">
	window.onload=actualiseBandeau();
</script>
