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
<!-- Header -->
<div class="w3-center">
    <h1 class="w3-jumbo w3-text-blue"><b>KarShare </b></h1>
    <p class="w3-text-dark-grey">Bienvennue sur KarShare, site de covoiturage.</p>
</div>

<!-- Bandeau (error,warning,info) -->
	<div class="w3-row">
		<div class="w3-quarter">
			<p>	
			</p>
		</div>
		<div class="w3-half  w3-center w3-panel ">
		  <?php 
		  	$band=False;
		  	$color="w3-red";
		  	$txtband="";
		  	if($context->error){
		  		$band=True;
			  	$color="w3-red";
			  	$txtband=$context->error;
		 	} 
			elseif($context->warning){
		  		$band=True;
			  	$color="w3-yellow";
			  	$txtband=$context->warning;
			}
			elseif ($context->info) {
		  		$band=True;
			  	$color="w3-theme";
			  	$txtband=$context->info;				
			}
			if ($band==True){
				?>
				<div id="bandeau" class="<?php echo "$color" ?>">
	        		<?php echo " $txtband !" ?>
	      		</div>
	      		<?php
	      	}
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
      	<?php include($template_view); ?>
      </div>
    </div>
      

  </body>

</html>
