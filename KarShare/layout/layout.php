<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/w3-theme.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body, h1,h2,h3,h4,h5,h6 {font-family: "Montserrat", sans-serif}
.w3-row-padding img {margin-bottom: 12px}
.bgimg {
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  background-image: url('/w3images/profile_girl.jpg');
  min-height: 100%;
}
</style>
  <head>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   
    <title>
     Karshare
    </title>
   
  </head>
  <?php
  if( !isset($_SESSION)){
  	session_start(); 
  }
 
?>
  <header>
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
</script>

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


function envoieRequeteController(req){
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
	xhr.open("GET", req, true);
	xhr.send(null);
	actualiseBandeau();
	
}

function envoieRequete(){
	envoieRequeteController("singleView.php?action=rechercherVoyage&depart="+document.getElementById("depart").value+"&arrivee="+document.getElementById("arrivee").value);
}

function envoieRequeteConnexion(){
	envoieRequeteController( "monApplication.php?action=connexion&identifiantc="+document.getElementById("identifiantc").value+"&mdpc="+document.getElementById("mdpc").value);
}

function envoieRequeteInscription(){
	envoieRequeteController( "monApplication.php?action=inscription&identifianti="+document.getElementById("identifianti").value+"&mdpi="+document.getElementById("mdpi").value+"&nom="+document.getElementById("nom").value+"&prenom="+document.getElementById("prenom").value);
	
}

function envoieRequeteDeconnexion(){
	envoieRequeteController( "monApplication.php?action=deconnexion");
	
}

function envoieRequeteReservation(idv){
	envoieRequeteController( "singleView.php?action=reserverVoyage&idvoyage="+idv+"");
	
}

function envoieRequeteConnexion(){
	envoieRequeteController( "monApplication.php?action=suppression&identifiants="+document.getElementById("identifiants").value+"&mdps="+document.getElementById("mdps").value);
}

</script>
  	
<!-- Header -->
<div class="w3-center">
    <h1 class="w3-jumbo w3-text-blue"><b>KarShare</b></h1>
    <p class="w3-text-dark-grey">Bienvenue sur KarShare, site de covoiturage.</p>
</div>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar" id="myNavbar">
     
    <?php
    if (isset($_SESSION["User"])){
    	?>
    	<button  onclick="document.getElementById('id03').style.display='block'" class="w3-bar-item w3-button w3-text-blue w3-hover-blue"><i class="fa fa-user"></i>
    	<?php
    	$p=$_SESSION["User"];
    	echo $p->nom;
    ?>
	</button>
  </div>
</div>
<div id="id03" class="w3-modal">
  <div class="w3-modal-content">
  		<div class="w3-row">
				<form action=""    method="get" style="" ><!-- Bandeau (error,warning,info) -->
					<div class="w3-twothird w3-center w3-panel">
						      <span onclick="document.getElementById('id03').style.display='none'"
		      					class="w3-button w3-display-topright">&times;</span>
		      					<h3 class="w3-text-blue">Profil</h3>	
					</div>
				</form>
				<div class="w3-third w3-center">
						<br>
						Voulez vous déconnecter?
						<form  action=""   method="get" style="">
						<input type="hidden" name="action" value="deconnexion" >
						<input onclick="envoieRequeteDeconnexion()" type="submit" value="Deconnexion" class="w3-bar-item w3-button w3-text-blue w3-hover-blue">
					</form><?php
					/*<br>
						Voulez vous supprimer le compte?
						<form  action=""   method="get" style="">
						<input type="hidden" name="action" value="supprimer" >
						<input onclick="envoieRequeteSuppression()" type="submit" value="Supprimer" class="w3-bar-item w3-button w3-text-blue w3-hover-blue">
					</form>*/
					?>
				</div>
		</div>
	</div>
</div>

    <?php
	}
    else{
    	?>
    	<button  onclick="document.getElementById('id01').style.display='block'" class="w3-bar-item w3-button w3-text-blue w3-hover-blue"><i class="fa fa-user"></i>
    	<?php
    	echo "Connexion";
    
    ?></button>
  </div>
</div>
<div id="id01" class="w3-modal">
  <div class="w3-modal-content">
  		<div class="w3-row">
				<form action=""    method="get" style="" ><!-- Bandeau (error,warning,info) -->
					<div class="w3-twothird w3-center w3-panel">
						      <span onclick="document.getElementById('id01').style.display='none'"
		      					class="w3-button w3-display-topright">&times;</span>
		      					<h3 class="w3-text-blue">Connexion</h3>
		      			<input type="hidden" name="action" value="connexion" >
		      			<label for="identifiantc">Identifiant :</label><br>
		      			<input type="text" name="identifiantc" id="identifiantc" value="Nom" class="  w3-input w3-border"><br>
		      			<label for="mdpc">Mot de passe :</label><br>
						<input type="password" name="mdpc" id="mdpc" value="" class="  w3-input w3-border"><br>
						<input  onClick="envoieRequeteConnexion()" type="submit" value="Connexion" class="  w3-button w3-theme-d3">
						
					</div>
				</form>
				<div class="w3-third w3-center">
					<p>	
						<br>
						Pas encore inscrit?<br>
						<button onclick="document.getElementById('id02').style.display='block';document.getElementById('id01').style.display='none'" class="w3-bar-item w3-button w3-text-blue w3-hover-blue"><i class="fa fa-user"></i> Inscrivez-vous</button>
					</p>
				</div>
		</div>
	</div>
</div>

<div id="id02" class="w3-modal">
  <div class="w3-modal-content">
  		<div class="w3-row">
				<form action=""   method="get" style="" ><!-- Bandeau (error,warning,info) -->
					<div class="w3-twothird w3-center w3-panel">
						      <span onclick="document.getElementById('id02').style.display='none' "
		      					class="w3-button w3-display-topright">&times;</span>
		      			<h3 class="w3-text-blue">Inscription</h3>
		      			<input type="hidden" name="action" value="inscription" >
		      			<label for="identifianti">Identifiant :</label><br>
		      			<input type="text" name="identifianti" id="identifianti" value="Nom" class="  w3-input w3-border"><br>
		      			<label for="mdpi">Mot de passe :</label><br>
						<input type="password" name="mdpi" id="mdpi" value="" class="  w3-input w3-border"><br>
						<label for="nom">Nom :</label><br>
						<input type="txt" name="nom" id="nom" value="" class="  w3-input w3-border"><br>
						<label for="prenom">Prénom :</label><br>
						<input type="txt" name="prenom" id="prenom" value="" class="  w3-input w3-border"><br>
						<label for="avatar">Avatar :</label><br>
						<input type="txt" name="avatar" id="avatar" value="" class="  w3-input w3-border"><br>
						<input  onClick="envoieRequeteInscription()" type="submit" value="Inscription" class="  w3-button w3-theme-d3">
						
					</div>
				</form>
				<div class="w3-third w3-center">
					<p>	<br>
						Déja inscrit?<br>
						<button onclick="document.getElementById('id01').style.display='block';document.getElementById('id02').style.display='none'" class="w3-bar-item w3-button w3-text-blue w3-hover-blue"><i class="fa fa-user"></i> Connectez-vous</button>
					</p>
				</div>
		</div>
	</div>
</div>
<?php
}
?>
<!-- Bandeau (error,warning,info) -->
	<div class="w3-row">
		<div class="w3-quarter">
			<p>	
			</p>
		</div>
		<div class="w3-half  w3-center w3-panel ">
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
			elseif ($context->info) {
		  		$band="false";
			  	$color="w3-theme";
			  	$txtband=$context->info;				
			}
				?>
				<div id="bandeau" hidden="<?php echo $band ?>"> class="<?php echo "$color" ?>">
	        		<?php echo " $txtband !" ?>
	      		</div>

	    </div>
	</div>
<!-- Fin Bandeau -->

  </header>

  <body>
 <br>
    <?php if($context->getSessionAttribute('user_id')): ?>
	<?php echo $context->getSessionAttribute('user_id')." est connecte"; ?>
     <?php endif; ?>

    <div id="page">
      <div id="page_maincontent">
			<div id="view1">
      			<?php include($template_view); ?>
			</div>
      </div>
    </div>
      

  </body>

<!-- Navbar (sticky bottom) -->
<div class="w3-theme w3-bottom w3-hide-small">
<div class="w3-bar w3-white w3-center w3-padding w3-opacity-min w3-hover-opacity-off">
<p>Audran Bert - Nathanaël Lefèvre</p>
</div>
</div>



</html>
