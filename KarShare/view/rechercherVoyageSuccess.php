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

<button id="envoisrequete" onClick="envoieRequete()">test</button>
Voici les Voyages demandés:

<table class="w3-table w3-striped w3-cyan">
	<tr>
		<th>id</th>
        echo "<th>$context->voyages[1]->id</th>"; <!--<th>conducteur</th>>
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
