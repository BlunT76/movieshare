<?php echo Form::open(array("class"=>"form-horizontal")); ?>
<fieldset>
    
        
    
    <div class="form-row align-items-center">
    
        <?php echo Form::label('Sort by','', array('class' => 'ml-2')); ?>
        <?php echo Form::select('sort', 'none', array(
            'id' => 'None',
            'title' => 'Name',
            'year' => 'Release date',
            'runtime' => 'Runtime'
            ), array('class' => 'col-md-2 form-control form-control-sm ml-2')); ?>
        
    
    <!-- <div class="form-group"> -->
        <!-- <label class='control-label'>&nbsp;</label> -->
        <?php echo Form::submit('submit', 'Sort', array('class' => 'btn btn-sm btn-success ml-2')); ?>
    </div>
    <?php echo Form::label('Available', 'rented' , array('class' => '')); ?>
        <?php echo Form::checkbox('rented','1', array('class' => 'ml-2')); ?>

</fieldset>



<?php echo Form::close(); ?>