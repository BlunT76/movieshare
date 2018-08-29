<h2>New <span class='muted'>Film</span></h2>
<br>


<?php if(isset($data) && empty(!$data['title'])){
    ?>
	<div class="row panel panel-default">
    <div class="col-md-4">

	<img src="<?php echo $data['poster']; ?>">
	</div>
	<div class="col-md-8">
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

	</div>
<?php } else { ?>
	<div>
	<p>
	<?php echo 'No result found'; ?></p>
	<p>
	</div>
<?php } ?>
<?php 
echo Form::open(array('action' => '/resultfilm',"class"=>"form-horizontal")); ?>

<fieldset>
    <div class="form-group">
        <?php echo Form::label('Title', 'title', array('class'=>'control-label')); ?>

            <?php echo Form::input('title', $data['title'], array('class' => 'col-md-4 form-control', 'placeholder'=>'Search')); ?>

    </div>	

    </div>
    <div class="form-group">
        <?php echo Form::label('Year', 'year', array('class'=>'control-label')); ?>

            <?php echo Form::input('year', $data['year'], array('class' => 'col-md-4 form-control', 'placeholder'=>'Year')); ?>

    </div>
    <div class="form-group">
        <?php echo Form::label('Director', 'director', array('class'=>'control-label')); ?>

            <?php echo Form::input('director', $data['director'], array('class' => 'col-md-4 form-control', 'placeholder'=>'Director')); ?>

    </div>
    <div class="form-group">
        <?php echo Form::label('Actors', 'actors', array('class'=>'control-label')); ?>

            <?php echo Form::input('actors', $data['actors'], array('class' => 'col-md-4 form-control', 'placeholder'=>'Actors')); ?>

    </div>
    <div class="form-group">
        <?php echo Form::label('Runtime', 'runtime', array('class'=>'control-label')); ?>

            <?php echo Form::input('runtime', $data['runtime'], array('class' => 'col-md-4 form-control', 'placeholder'=>'Runtime')); ?>

    </div>
    <div class="form-group">
        <?php echo Form::label('Plot', 'plot', array('class'=>'control-label')); ?>

            <?php echo Form::textarea('plot', $data['plot'], array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Plot')); ?>

    </div>
    <div class="form-group">
        <?php echo Form::label('Rented', 'rented', array('class'=>'control-label')); ?>

            <?php echo Form::input('rented', 0, array('class' => 'col-md-4 form-control', 'placeholder'=>'Rented')); ?>

    </div>
    <div class="form-group">
        <?php echo Form::label('Poster', 'poster', array('class'=>'control-label')); ?>

            <?php echo Form::input('poster', $data['poster'], array('class' => 'col-md-4 form-control', 'placeholder'=>'Poster')); ?>

    </div>
    <div class="form-group">
        <label class='control-label'>&nbsp;</label>
        <?php echo Form::submit('submit', 'Add to DataBase', array('class' => 'btn btn-primary')); ?>		</div>
</fieldset>
<?php echo Form::close(); ?>
<p><?php echo Html::anchor('film', 'Back'); ?></p>