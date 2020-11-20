Voici les Voyages demandés:

<table class="w3-table w3-striped w3-cyan">
	<tr>
		<th>id</th>
		<th>conducteur</th>
		<th>trajet</th>
		<th>tarif</th>
		<th>nbplace</th>
		<th>heuredepart</th>
		<th>contraintes</th>
	</tr>
	<?php
		foreach($context->voyages as $voyage){
			echo "<tr>";
			echo "<td>$voyage->id</td>";
			
			echo "<td> nom : ".$voyage->utilisateur->nom;
			echo ", prenom : ".$voyage->utilisateur->prenom."</td>";
			
			echo "<td>".$voyage->trajet->depart;
			echo "-".$voyage->trajet->arrivee."</td>";
			echo "<td>$voyage->tarif</td>";
			echo "<td>$voyage->nbplace</td>";
			echo "<td>$voyage->heuredepart</td>";
			echo "<td>$voyage->contraintes</td>";
			echo "</tr>";
		}
	?>
</table>
