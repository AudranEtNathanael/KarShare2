
<?php
include('ViewLib/dataBandeauGeneration.php');
?>
<h2 class="w3-center w3-text-blue">
	Erreur réservation : <?php
/*
    if (isset($_SESSION["User"])){
    	$p=$_SESSION["User"];
    	echo $p->nom;
    }
    else{
    	echo "Connexion";
    }*/
    echo "$context->error";
    echo"<br>";
     echo "$context->getSessionAttribute('User')->nom";
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
<!-- Bandeau (error,warning,info) -->
		<div class="w3-center w3-panel w3-half w3-center">
			<form action="monApplication.php" target="_blank" method="get" style="">
				<div class="w3-row w3-center" style="">
					<input type="hidden" name="action" value="rechercherVoyage" >
					<input  type="submit" value="Rechercher des voyages" class="w3-col l4 w3-button w3-theme-d3">
					<input type="text" name="depart" value="Montpellier" class="w3-col  l4 w3-input w3-border">
					<input type="text" name="arrivee" value="Bordeaux" class="w3-col l4 w3-input  w3-border">
					<input class="w3-check  w3-theme" type="checkbox" >
					<label>Autoriser les correspondances</label>
				</div>
			</form>
			<?php
include('ViewLib/retourAccueil.php');
?>
	</div>
<!-- Fin Bandeau -->