



<div hidden id="data_bandeau">
	<?php
	$band="true";
  	$color="w3-red";
  	$txtband="";
	if($context->error){
  		$band="false";
	  	$color="w3-red";
	  	$txtband=$context->error;		
	}
	elseif($context->warning){
  		$band="false";
	  	$color="w3-yellow";
	  	$txtband=$context->warning;
	}
	elseif($context->info){
  		$band="false";
	  	$color="w3-theme";
	  	$txtband=$context->info;	
	}
	echo '<div id="affichagebandeau">'. $band.'</div>';
	echo '<div id="colorbandeau">'. $color.'</div>';
	echo '<div id="txtbandeau">'. $txtband.'</div>';
	?>
</div >


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

<script type="text/javascript">
function actualiseBandeau(){
	    // get the contents of the link that was clicked
    var newText = "nouveau";

    // replace the contents of the div with the link text
    $( "#bandeau" ).text( $("#txtbandeau").text() );
    $( "#bandeau" ).removeClass("w3-theme");
    $( "#bandeau" ).removeClass("w3-yellow");
    $( "#bandeau" ).removeClass("w3-red");
    $( "#bandeau" ).addClass($("#colorbandeau").text());
    if ($("#affichagebandeau").text()=="false"){
		$( "#bandeau" ).attr("hidden",false);
    }
    //$( "#bandeau" ).attr("hidden",$("#affichagebandeau").text());
    
}

window.onload=actualiseBandeau();
</script>

<script>

var xhr;

function recupereReponse(){
	if((xhr.readyState==4) && (xhr.status==200)){
		alert("recupere Reponse");
		var data=xhr.responseText;
		info=data.split(','); //reponse sous la forme d'éléments inclus // dans une
		//traiteInfo(info); //chaine de caractères et séparés par une virgule
		alert(info);
		//document.getElementById("view1").innerHTML.replace(info);
		$(document).ready(function(){
						  $("#view1").html(info);
						  $("").html()
		});
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
	xhr.open("GET", "singleView.php?action=rechercherVoyage&depart=Paris&arrivee=Lyon", true);
	xhr.send(null);
	actualiseBandeau();
	
}
</script>