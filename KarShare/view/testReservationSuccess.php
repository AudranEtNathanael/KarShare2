Voici les Voyages demandes:

<table class="w3-table w3-striped w3-cyan">
	<tr>
		<th>id</th>
		<th>ville de depart</th>
		<th>tarif</th>
		<th>heure de depart</th>
		<th>nom du voyageur</th>

	</tr>
	<?php
		foreach($context->reservations as $resa){
			echo "<tr>";
			echo "<td>".$resa->id."</td>";
			echo "<td>".$resa->voyage->trajet->depart."</td>";
			echo "<td>".$resa->voyage->tarif."</td>";
			echo "<td>".$resa->voyage->heuredepart."</td>";
			echo "<td>".$resa->voyageur->nom."</td>";
			echo "</tr>";
		}
	?>
</table>

