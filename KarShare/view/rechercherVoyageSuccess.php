<script>

var xhr;

function recupereReponse(){
	if((xhr.readyState==4) && (xhr.status==200)){
		alert("recupere Reponse");
		var data=xhr.responseText;
		info=data.split(','); //reponse sous la forme d'éléments inclus // dans une
		//traiteInfo(info); //chaine de caractères et séparés par une virgule
		alert(info);
	}
}


function envoieRequete(){
	alert("envois Requete");
	if(window.ActiveXObject){
		try{
			xhr=new ActiveXObject("Microsoft.XMLHTTP");
		}// autre version ie < 5.0
		catch(e){
			xhr=new ActiveXObject("MSXML2.XMLHTTP");
		}
	}else if(window.XMLHttpRequest){
		xhr=new XMLHttpRequest();
	}
	xhr.onreadystatechange=recupereReponse;
	xhr.open("GET", "monApplication.php?action=rechercherVoyage&depart=Montpellier&arrivee=Bordeaux", true);
	xhr.send(null);
	
}



</script>


<h4 class="w3-center">Voici les voyages pour le trajet entre <?php echo $context->voyages[0]->trajet->depart ?> et <?php echo $context->voyages[0]->trajet->arrivee ?>:</h4>
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
<form action="monApplication.php" target="_blank" method="get" >
	<div class=" w3-center">
		<input type="hidden" name="action" value="index" >
		<input  type="submit" value="Retour a l acceuil" class="w3-button w3-theme-d1">
	</div>
</form>

</center>
