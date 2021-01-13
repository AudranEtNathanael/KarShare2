  <?php
  if( $context->getSessionAttribute("User")!=null){ 
  }
 
?>
<h2 class="w3-center w3-text-blue">
	<?php
    echo $context->error;
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

		<div class="w3-center w3-panel w3-half w3-center">

<br>
<?php
include('ViewLib/retourAccueil.php');
?>
	</div>
