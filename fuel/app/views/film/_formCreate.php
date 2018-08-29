<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Title', 'title', array('class'=>'control-label')); ?>

				<?php echo Form::input('title', Input::post('title', isset($film) ? $film->title : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Title')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Year', 'year', array('class'=>'control-label')); ?>

				<?php echo Form::input('year', Input::post('year', isset($film) ? $film->year : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Year')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Director', 'director', array('class'=>'control-label')); ?>

				<?php echo Form::input('director', Input::post('director', isset($film) ? $film->director : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Director')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Actors', 'actors', array('class'=>'control-label')); ?>

				<?php echo Form::input('actors', Input::post('actors', isset($film) ? $film->actors : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Actors')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Runtime', 'runtime', array('class'=>'control-label')); ?>

				<?php echo Form::input('runtime', Input::post('runtime', isset($film) ? $film->runtime : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Runtime')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Plot', 'plot', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('plot', Input::post('plot', isset($film) ? $film->plot : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Plot')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Rented', 'rented', array('class'=>'control-label')); ?>

				<?php echo Form::input('rented', Input::post('rented', isset($film) ? $film->rented : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Rented')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Poster', 'poster', array('class'=>'control-label')); ?>

				<?php echo Form::input('poster', Input::post('poster', isset($film) ? $film->poster : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Poster')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>