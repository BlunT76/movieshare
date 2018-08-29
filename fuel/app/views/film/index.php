<h2>Listing <span class='muted'>Films</span></h2>
<br>
<?php echo render('film/_formtri'); ?>
<br>
<?php if ($films): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Title</th>
			<th>Year</th>
			<th>Director</th>
			<th>Actors</th>
			<th>Runtime</th>
			<th>Plot</th>
			<th>Rented</th>
			<th>Poster</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($films as $item): ?>		<tr>

			<td><?php echo $item->title; ?></td>
			<td><?php echo $item->year; ?></td>
			<td><?php echo $item->director; ?></td>
			<td><?php echo $item->actors; ?></td>
			<td><?php echo $item->runtime; ?></td>
			<td><?php echo $item->plot; ?></td>
			<td><?php echo $item->rented; ?></td>
			<td><?php echo $item->poster; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('film/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('film/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>						<?php echo Html::anchor('film/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Films.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('film/newfilm', 'Add new Film', array('class' => 'btn btn-success')); ?>

</p>
