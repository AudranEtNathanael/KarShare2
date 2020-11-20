
<center>
<script>
var xhr;
function envoieRequete(){
	if(window.ActiveXObject){
		try{
			xhr=new ActiveXObject("Microsoft.XMLHTTP");
		}// autre version ie < 5.0
		catch(e){
			xhr=new ActiveXObject("MSXML2.XMLHTTP");}
	}else if(window.XMLHttpRequest){
		xhr=new XMLHttpRequest();
	}
	xhr.onreadystatechange=recupereReponse;
	xhr.open("GET", "monApplication.php?action=rechercherVoyage", true);
	xhr.send(null);
}
</script>

	<form action="monApplication.php" target="_blank" method="get" style="width:50%">
		<div class="w3-row w3-center">
			<input type="hidden" name="action" value="rechercherVoyage" >
			<input  type="submit" value="Rechercher des voyages" class="w3-col l4 w3-button w3-theme-d3">
			<input type="text" name="depart" value="Montpellier" class="w3-col l4 w3-input w3-border">
			<input type="text" name="arrivee" value="Bordeaux" class="w3-col l4 w3-input w3-border">
		</div>
	</form>

</center>