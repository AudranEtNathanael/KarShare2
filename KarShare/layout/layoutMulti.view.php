
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/w3-theme.css">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>
Ton appli !
</title>

</head>

<header>
<?php if($context->error): ?>
<div id="flash_error" class="error w3-panel w3-red">
<?php echo " $context->error !!!!!" ?>
</div>
<?php else: ?>
<div class="w3-panel w3-blue"> <?php if (isset($_GET['action'])) : echo "L'action ".$_GET['action']." a bien été effectuée"; endif ?> </div>
<?php endif; ?>
</header>

<body>
<h2>Super c'est ton appli ! </h2>
<?php if($context->getSessionAttribute('user_id')): ?>
<?php echo $context->getSessionAttribute('user_id')." est connecte"; ?>
<?php endif; ?>

<div id="page">
<div id="page_maincontent">
<?php
    foreach $multiView as $aView {
        include($aView);
    }
?>
</div>
</div>


</body>

</html>
