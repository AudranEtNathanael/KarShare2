
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



<script type="text/javascript">
	window.onload=actualiseBandeau();
</script>