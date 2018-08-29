<h2>Viewing <span class='muted'>#<?php echo $rented->id; ?></span></h2>

<p>
	<strong>User id:</strong>
	<?php echo $rented->user_id; ?></p>
<p>
	<strong>Film id:</strong>
	<?php echo $rented->film_id; ?></p>

<?php echo Html::anchor('rented/edit/'.$rented->id, 'Edit'); ?> |
<?php echo Html::anchor('rented', 'Back'); ?>