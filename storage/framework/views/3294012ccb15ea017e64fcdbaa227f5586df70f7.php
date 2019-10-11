<?php $__env->startSection('main'); ?>
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h1>Neues Thema anlegen</h1>

<div class="container">	
	<form method="POST" action="/backend/topics" enctype="multipart/form-data">
		<?php echo csrf_field(); ?>
		
		<input type="hidden" name="admin_id" value="<?php echo e($admin->id); ?>">
		<div class="form-group">
			<label for="topic_title">Name des Themas:</label>
			<input type="text" class="form-control" id="topic_title" name="topic_title">
		</div>
		
		<div class="form-group">
		<label>Fach/Fächer auswählen:</label>
			<div class="card">
				<div style="column-count: 3">
					<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
						<div class="form-check mx-2">
							<input type="checkbox" class="form-check-input" id="<?php echo e($subject->id); ?>" value="<?php echo e($subject->id); ?>" name="subjects[]">
							<label class="form-check-label" for=""><?php echo e($subject->subject_title); ?></label>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</div>

		<small class="form-text text-muted">Neue Tags mit einem "@" beginnen</small>
		<div class="input-group my-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Tags:</span>
			</div>	
			<select class="custom-select select2-multi" name="tags[]" id="tags" multiple="multiple">
				<option value=""></option>
				<?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($tag->id); ?>"><?php echo e($tag->tag_name); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>
			
		<div class="form-group mt-3">
			<button type="submit" class="btn btn-primary">Thema eintragen</button>
		</div>
	</form>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<!-- Select2 initialisieren -->
<script>
$(document).ready(function() {
    $(".select2-multi").select2({
    	tags: true,
    	createTag: function (params) {
    		// Don't offset to create a tag if there is no @ symbol
			if (params.term.indexOf('@') === -1) {
      		// Return null to disable tag creation
      		return null;
    		}
    		return {
      		id: params.term,
      		text: params.term
    		}
  		}
    });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/create_topics.blade.php ENDPATH**/ ?>