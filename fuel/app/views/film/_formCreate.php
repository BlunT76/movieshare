<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Title', 'title', array('class'=>'control-label')); ?>

				<?php echo Form::input('search', Input::post('search'), array('class' => 'col-md-4 form-control', 'placeholder'=>'Search')); ?>

		</div>
		
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Search', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>



<?php echo Form::close(); ?>

