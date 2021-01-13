
<center>
<script>

</script>
<?php
include('ViewLib/dataBandeauGeneration.php');
?>
<p class="w3-text-red">
	<?php

	if ($context->error!=null){
		echo $context->error;
	}

	?>
</p>

<?php
include('ViewLib/chercherVoyage.php');
?>


