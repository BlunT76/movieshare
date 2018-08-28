<h2>Editing <span class='muted'>Film</span></h2>
<br>

<?php echo render('film/_form'); ?>
<p>
	<?php echo Html::anchor('film/view/'.$film->id, 'View'); ?> |
	<?php echo Html::anchor('film', 'Back'); ?></p>
