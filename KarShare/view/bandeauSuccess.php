
<!-- Bandeau (error,warning,info) -->
	<div class="w3-row">
		<div class="w3-quarter">
			<p>	
			</p>
		</div>
		<div class="w3-half  w3-center w3-panel ">
		  <?php if($context->error): ?>
	      	<div id="bandeau_error" class=" error  w3-red">
	        	<?php echo " $context->error !" ?>
	      	</div>
	      <?php elseif($context->warning): ?>
	      	<div id="bandeau_warning" class="  w3-yellow ">
	        	<?php echo " $context->warning "  ?>
	      	</div>
	      <?php elseif($context->info): ?>
	      	<div id="bandeau_info" class="  w3-theme">
	        	<?php echo " $context->info "  ?>
	      	</div>

	            <?php endif; ?>
	    </div>
	</div>
<!-- Fin Bandeau -->