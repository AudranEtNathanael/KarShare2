



<?php
include('ViewLib/dataBandeauGeneration.php');
?>


<h4 class="w3-center">Voici les voyages pour le trajet entre <?php echo $context->voyages[0]->trajet->depart ?> et <?php echo $context->voyages[0]->trajet->arrivee ?> :</h4>
<center>
<table class="w3-table w3-striped w3-cyan w3-centered" style=width:50% >
	<tr>
		<th>Numero du voyage</th>
		<th>Conducteur</th>
		<th>Tarif</th>
		<th>Nombre de place</th>
		<th>Heure de depart</th>
		<th>Contraintes</th>
	</tr>
	<?php
		foreach($context->voyages as $voyage){
			echo "<tr>";
			echo "<td>$voyage->id</td>";
			
			echo "<td>  ".$voyage->utilisateur->nom;
			echo " ".$voyage->utilisateur->prenom."</td>";
						echo "<td>$voyage->tarif</td>";
			echo "<td>$voyage->nbplace</td>";
			echo "<td>$voyage->heuredepart</td>";
			echo "<td>$voyage->contraintes</td>";
			echo "</tr>";
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
