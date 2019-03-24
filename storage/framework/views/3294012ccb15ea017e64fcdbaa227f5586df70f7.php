<?php $__env->startSection('main'); ?>
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h1>Neues Thema anlegen</h1>

<div class="container">	
<form method="POST" action="/backend/topics" enctype="multipart/form-data">
<?php echo e(csrf_field()); ?>

	<div class="form-group">
		<label for="topic_title">Name des Themas:</label>
		<input type="text" class="form-control" id="topic_title" name="topic_title">
			
		<label for="subject_id">Fach/Fächer auswählen:</label>
		<select class="form-control" id="subjects"" name="subjects[]" multiple="multiple">
		<option></option>
		<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
			<option value="<?php echo e($subject->id); ?>"><?php echo e($subject->subject_title); ?></option>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</select>
		<div class="form-group mt-3">
			<button type="submit" class="btn btn-primary">Thema eintragen</button>
		</div>
</form>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
$(document).ready(function() {
    $("#subjects").select2();
});
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>