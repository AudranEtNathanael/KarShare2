Voici l'utilisateur demandé:

<table class="w3-table w3-striped w3-cyan">
	<tr>
		<th>id</th>
		<th>identifiant</th>
		<th>pass</th>
		<th>nom</th>
		<th>prenom</th>
		<th>avatar</th>
	</tr>
	<tr>
		<td><?php echo $context->user->id ?></td>
		<td><?php echo $context->user->identifiant ?></td>
		<td><?php echo $context->user->pass ?></td>
		<td><?php echo $context->user->nom ?></td>
		<td><?php echo $context->user->prenom ?></td>
		<td><?php echo $context->user->avatar ?></td>
	</tr>
</table>
