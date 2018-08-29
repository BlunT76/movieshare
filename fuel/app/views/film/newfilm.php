<h2>New <span class='muted'>Film</span></h2>
<br>

<?php 
echo render('film/_formCreate'); ?>
<?php if(isset($data) && empty(!$data['title'])){
    ?>
	<div class="row panel panel-default">
	<div class="col-md-6">
 <p>
	<strong>Title:</strong>
	<?php echo $data['title']; ?></p>
<p>
	<strong>Year:</strong>
	<?php echo $data['year']; ?></p>
<p>
	<strong>Director:</strong>
	<?php echo $data['director']; ?></p>
<p>
	<strong>Actors:</strong>
	<?php echo $data['actors']; ?></p>
<p>
	<strong>Runtime:</strong>
	<?php echo $data['runtime']; ?></p>
<p>
	<strong>Plot:</strong>
	<?php echo $data['plot']; ?></p>
</div>
<div class="col-md-6">

	<img src="<?php echo $data['poster']; ?>">
	</div>
	</div>
<?php } else { ?>
	<div>
	<p>
	<?php echo 'No result found'; ?></p>
	<p>
	</div>
<?php } ?>
<p><?php echo Html::anchor('film', 'Back'); ?></p>