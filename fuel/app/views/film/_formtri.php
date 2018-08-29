<?php echo Form::open(array("class"=>"form-horizontal")); ?>
<fieldset>
    <div class="form-group">
        
    </div>
    <div class="form-group">
        <?php echo Form::label('Sort by'); ?>
        <?php echo Form::select('sort', 'none', array(
            'id' => 'None',
            'title' => 'Name',
            'year' => 'Release date',
            'runtime' => 'Runtime'
            )); ?>
        <?php echo Form::label('Rented', 'gender'); ?>
        <?php echo Form::checkbox('gender', 'rented'); ?>
    <!-- </div> -->
    <!-- <div class="form-group"> -->
        <label class='control-label'>&nbsp;</label>
        <?php echo Form::submit('submit', 'Sort', array('class' => 'btn btn-primary')); ?>
    </div>

</fieldset>



<?php echo Form::close(); ?>