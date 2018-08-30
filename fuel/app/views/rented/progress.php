<?php if (isset($panier)): ?>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Title</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($panier as $item): ?>		
				<tr>
					<td><?php echo $item->title; ?></td>
				</tr>
				<?php endforeach; ?>	</tbody>
			</table>
			
			<?php else: ?>
				<p>Panier vide.</p>
				<?php endif; ?><p>
					<a href="film"><button class="btn btn-success">Retour aux films</button></a>
					<?php if(isset($panier)){ ?><a href="create"><button class="btn btn-success">Valider mon panier</button></a> <a href="clear"><button class="btn btn-success">Vider le panier</button></a><?php } ?>