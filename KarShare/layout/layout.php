<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/w3-theme.css">
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
  	
<!-- Header -->
<div class="w3-center">
    <h1 class="w3-jumbo w3-text-blue"><b>KarShare </b></h1>
    <p class="w3-text-dark-grey">Bienvenue sur KarShare, site de covoiturage.</p>
</div>

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
	      		<?php
	        ?>

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
