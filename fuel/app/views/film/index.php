<h2>Listing <span class='muted'>Films</span></h2>
<br>
<a href="rented/progress"><button class="btn btn-primary">Voir mon panier</button></a>
<?php echo render('film/_formtri'); ?>
<br>

<?php if ($films): ?>
<div class="row">

<?php foreach ($films as $item): ?>	
<div class="col col-md-4">
<div class="card" >
  <img class="card-img-top" src="<?php echo $item->poster; ?>" alt="Card image cap">
  <div class="card-body">
	<h5 class="card-title"><?php echo $item->title; ?></h5>
	<button class="btn btn-light float-right" type="button" data-toggle="collapse" data-target="#collapseExample<?php echo $item->id;?>" aria-expanded="false" aria-controls="collapseExample">
    <i class="fas fa-chevron-circle-down"></i>
  </button>
  <div class="collapse" id="collapseExample<?php echo $item->id;?>">
		<ul class="list-group list-group-flush">
			<li class="list-group-item">Year: <?php echo $item->year; ?></li>
			<li class="list-group-item">Director: <?php echo $item->director; ?></li>
			<li class="list-group-item">Actors: <?php echo $item->actors; ?></li>
			<li class="list-group-item">Run Time: <?php echo $item->runtime; ?></li>
			<li class="list-group-item">Plot: <?php echo $item->plot; ?></li>
			<li class="list-group-item">Rented: <?php echo $item->rented; ?></li>
  		</ul>
		
		<?php echo Html::anchor('film/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>


		<?php if($_SESSION['role']=='admin'){
		echo Html::anchor('film/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-default btn-sm')); ?>
		<?php echo Html::anchor('film/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-sm btn-danger', 'onclick' => "return confirm('Are you sure?')")); }?>	
		</div>
  </div>
</div>
</div>
<?php endforeach; ?>	
</div>
</div>
<?php else: ?>
<p>No Films.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('film/newfilm', 'Add new Film', array('class' => 'btn btn-success')); ?>

</p>
