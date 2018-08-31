<h2>Listing <span class='muted'>Films</span></h2>
<br>
<div class="border border-dark rounded p-3 col-5 shadow-sm">
	<?php echo render('film/_formtri'); ?>
</div>
<?php if(isset($rented) && count($rented)>=1) :?>
<div class="row">

	<div class="border border-dark rounded p-3 col-5 offset-1 shadow-sm">
		<h5>Rented movies :</h5>
		<form method="POST" action="rented/delete">
			<ul>
				<?php foreach ($rented as $v) :?>
				<li>
					<?php echo $v->title."  " ;?><input type="checkbox" name="checkbox[]" value="<?php echo $v->id;?>">
				</li>
				<?php endforeach;  ?>
			</ul>
			<button type="submit" class="btn btn-danger btn-sm">Send movies back</button>
		</form>
	</div>
	<?php endif; ?>
</div>
<br>
<?php if($_SESSION['role']=='admin'){?>
<p>
	<?php echo Html::anchor('film/newfilm', 'Search new Film on OMDB', array('class' => 'btn btn-success btn-sm')); ?>
</p>
<?php } ?>

<?php if ($films): ?>
<div class="row">

	<?php foreach ($films as $item): ?>
	<div class="col col-md-4">
		<div class="card mb-5">
			<img class="card-img-top" src="<?php echo $item->poster; ?>" alt="Card image cap">
			<div class="card-body">
				<h5 class="titre card-title text-center">
					<?php echo $item->title; ?>
				</h5>
				<button class="btn btn-light float-right" type="button" data-toggle="collapse" data-target="#collapseExample<?php echo $item->id;?>"
				    aria-expanded="false" aria-controls="collapseExample">
					<i class="fas fa-chevron-circle-down"></i>
				</button>
				<div class="collapse" id="collapseExample<?php echo $item->id;?>">
					<ul class="list-group list-group-flush">
						<li class="list-group-item">Year:
							<?php echo $item->year; ?>
						</li>
						<li class="list-group-item">Director:
							<?php echo $item->director; ?>
						</li>
						<li class="list-group-item">Actors:
							<?php echo $item->actors; ?>
						</li>
						<li class="list-group-item">Run Time:
							<?php echo $item->runtime; ?>
						</li>
						<li class="list-group-item">Plot:
							<?php echo $item->plot; ?>
						</li>
						<li class="list-group-item">Rented:
							<?php echo $item->rented; ?>
						</li>
					</ul>

					<?php echo Html::anchor('film/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-default btn-sm')); ?>
					<?php if($item->rented==0){ echo Html::anchor('film/loan/'.$item->id,'Ajouter au panier'); }?>

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

<?php endif; ?>