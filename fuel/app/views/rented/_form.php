<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('User id', 'user_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('user_id', Input::post('user_id', isset($rented) ? $rented->user_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'User id')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Film id', 'film_id', array('class'=>'control-label')); ?>

				<?php echo Form::input('film_id', Input::post('film_id', isset($rented) ? $rented->film_id : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Film id')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-success')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>