<script type="text/javascript">

var xhr;

function recupereReponse(){
	if((xhr.readyState==4) && (xhr.status==200)){
		//alert("recupere Reponse");
		var data=xhr.responseText;
		info=data.split(','); //reponse sous la forme d'éléments inclus // dans une
		//traiteInfo(info); //chaine de caractères et séparés par une virgule
		//alert(info);
		//document.getElementById("view1").innerHTML.replace(info);
		$(document).ready(function(){
						  $("#view1").html(info);
						  //$("").html()
		});
	}
}


function envoieRequete(){
	//alert("envois Requete");
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
	xhr.open("GET", "singleView.php?action=rechercherVoyage&depart="+document.getElementById("depart").value+"&arrivee="+document.getElementById("arrivee").value, true);
	xhr.send(null);
	actualiseBandeau();
	
}
</script>



<?php
include('ViewLib/dataBandeauGeneration.php');
?>


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


<?php
include('ViewLib/chercherVoyage.php');
?>

<?php
include('ViewLib/retourAcceuil.php');
?>

</center>
<script type="text/javascript">
	window.onload=actualiseBandeau();
</script>
