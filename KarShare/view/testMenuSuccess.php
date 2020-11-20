<center>

	<div class="w3-panel w3-cyan">Test</div>

<a href="monApplication.php?action=helloWorld"  class="w3-button w3-theme-d1 link" style="width:50%;margin-bottom:17px">helloWorld</a>

	<a href="monApplication.php?action=index"  class="w3-button w3-theme-d3 link" style="width:50%;margin-bottom:17px">index</a>

	<a href="monApplication.php?action=nimporteQuoi"  class="w3-button w3-theme-d1 link" style="width:50%;margin-bottom:17px">errorAction</a>

	<form action="monApplication.php" target="_blank" method="get">
		<div class="w3-row w3-center" style="width:50%">
			<input type="hidden" name="action" value="superTest">
			<input type="submit" value="superTest" class="w3-col l4 w3-button w3-theme-d3">
			<input type="text" name="param1" value="param1" class="w3-col l4 w3-input w3-border">
			<input type="text" name="param2" value="param2" class="w3-col l4 w3-input w3-border">
		</div>
	</form>

	<form action="monApplication.php" target="_blank" method="get" style="width:50%">
		<div class="w3-row w3-center">
			<input type="hidden" name="action" value="testUserIdPass">
			<input type="submit" value="testUserIdPass" class="w3-col l4 w3-button w3-theme-d1">
			<input type="text" name="login" value="User1" class="w3-col l4 w3-input w3-border">
			<input type="text" name="pass" value="monMotdePasse" class="w3-col l4 w3-input w3-border">
		</div>
	</form>

	<form action="monApplication.php" target="_blank" method="get" style="width:50%">
		<div class="w3-row w3-center">
			<input type="hidden" name="action" value="testUserId">
			<input type="submit" value="testUserId" class="w3-col l6 w3-button w3-theme-d3">
			<input type="text" name="id" value="7407" class="w3-col l6 w3-input w3-border">
		</div>
	</form>

	<form action="monApplication.php" target="_blank" method="get" style="width:50%">
		<div class="w3-row w3-center">
			<input type="hidden" name="action" value="testTrajet">
			<input type="submit" value="testTrajet" class="w3-col l4 w3-button w3-theme-d1">
			<input type="text" name="depart" value="Paris" class="w3-col l4 w3-input w3-border">
			<input type="text" name="arrivee" value="Lyon" class="w3-col l4 w3-input w3-border">
		</div>
	</form>

	<form action="monApplication.php" target="_blank" method="get" style="width:50%">
		<div class="w3-row w3-center">
			<input type="hidden" name="action" value="testVoyage">
			<input type="submit" value="testVoyage" class="w3-col l6 w3-button w3-theme-d3">
			<input type="text" name="trajet" value="383" class="w3-col l6 w3-input w3-border">
		</div>
	</form>

	<form action="monApplication.php" target="_blank" method="get" style="width:50%">
		<div class="w3-row w3-center">
			<input type="hidden" name="action" value="testReservation">
			<input type="submit" value="testReservation" class="w3-col l6 w3-button w3-theme-d1">
			<input type="text" name="voyage" value="678" class="w3-col l6 w3-input w3-border">
		</div>
	</form>

</center>
