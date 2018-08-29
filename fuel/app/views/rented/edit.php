<h2>Editing <span class='muted'>Rented</span></h2>
<br>

<?php echo render('rented/_form'); ?>
<p>
	<?php echo Html::anchor('rented/view/'.$rented->id, 'View'); ?> |
	<?php echo Html::anchor('rented', 'Back'); ?></p>
