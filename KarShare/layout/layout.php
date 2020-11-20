<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<link rel="stylesheet" href="css/w3.css">
<link rel="stylesheet" href="css/w3-theme.css">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>
            Karshare
        </title>
    </head>

    <body>
        <h2>Karshare</h2>
        <?php if($context->getSessionAttribute('user_id')): ?>
	    <?php echo $context->getSessionAttribute('user_id')." est connecte"; ?>
        <?php endif; ?>

        <div id="bandeau">
            <?php if($view==context::ERROR) :?>
      	    <div id="flash_error" class="error w3-panel w3-red">
        	    <p>action echouee</p>
      	    </div>
                <?php elseif($context->error) :?>
                <div id="context->error" class="error w3-panel w3-red">
                    <?php echo " $context->error !!!!!" ?>
                </div>
            <?php elseif ($view==context::SUCCESS): ?>
        <div id="notif" >
      	    <p>action reussie</p>
        </div>
        <?php endif ?>
        </div>


        <div id="page">
	        <?php if ($view==context::SUCCESS){ ?>
            <div id="page_maincontent">
      	        <?php include($template_view); ?>
            </div>
	        <?php } ?>
        </div>


    </body>

</html>
