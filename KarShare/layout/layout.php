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
	  <?php if($context->error): ?>
      	<div id="flash_error" class="error w3-panel w3-red">
        	<?php echo " $context->error !!!!!" ?>
      	</div>
            <?php endif; ?>
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
