<h2>Viewing <span class='muted'>#<?php echo $film->id; ?></span></h2>

	
<p>
	<strong>Title:</strong>
	<?php echo $film->title; ?></p>
	
<p>
	<strong>Year:</strong>
	<?php echo $film->year; ?></p>
<p>
	<strong>Director:</strong>
	<?php echo $film->director; ?></p>
<p>
	<strong>Actors:</strong>
	<?php echo $film->actors; ?></p>
<p>
	<strong>Runtime:</strong>
	<?php echo $film->runtime; ?></p>
<p>
	<strong>Plot:</strong>
	<?php echo $film->plot; ?></p>
<p>
	<strong>Rented:</strong>
	<?php echo $film->rented; ?></p>
<p>
	<strong>Poster:</strong>
	<?php echo $film->poster; ?></p>

	

<?php echo Html::anchor('film/edit/'.$film->id, 'Edit'); ?> |
<?php echo Html::anchor('film', 'Back'); ?> 
<?php if($film->rented==0){ ?> |
<?php echo Html::anchor('film/loan/'.$film->id,'Ajouter au panier'); ?><?php } ?>