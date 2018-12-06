<?php $__env->startSection('main'); ?>
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h2>Neue Unterrichtseinheit anlegen</h2>
          <hr></hr>

<div class="container">
	<?php echo $__env->make('layouts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<form method="POST" action="/backend/units" enctype="multipart/form-data">
<?php echo e(csrf_field()); ?>

	<div class="form-group">	
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Titel der Unterrichtseinheit:</label>
			</div>
			<input type="text" class="form-control" id="unit_title" name="unit_title">
		</div>
		<div class="form-group mb-0">
			<label>Kurzbeschreibung der Unterrichtseinheit:</label>
		</div>
			<textarea class="form-control" id="unit_description" name="unit_description" aria-label="unit_description" aria-describedby="unit_description"></textarea>
		</div>

			
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Fach auswählen:</label>
			</div>
			<select class="form-control custom-select" id="subject_id" name="subject_id">
			<option value=""></option>
			<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
			<option value="<?php echo e($subject->id); ?>"><?php echo e($subject->subject_title); ?></option>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>
		
		<div class="input-group">
			<div class="input-group-prepend">
				<label class="input-group-text" for="topic_id">Thema auswählen:</label>
			</div>
			<select class="form-control custom-select" id="topic_id" name="topic_id">
				<option>Zuerst Fach auswählen</option>
			</select>
			<div class="col-md-2">
				<span id="loader" style="visibility: hidden;">
					<i class="far fa-spinner fa-spin"></i>
				</span>
			</div>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="topic_id">Unterrichtseinheit gehört zur Serie:</label>
			</div>
			<select class="form-control custom-select" id="serie_id" name="serie_id">
				<option value="">Gehört zu keiner Serie</option>
				<?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value=<?php echo e($serie->id); ?>><?php echo e($serie->serie_title); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>
		<hr></hr>		
		<div class=" form-group form-control my-5">
			<label for="unit_img"><i class="far fa-image"></i> Bild für den Inhalt hochladen</label>
			<input type="file" id="unit_img" name="unit_img">
		</div>
		
		<div class="form-group">
			<button type="submit" class="form-control btn btn-primary">Unterrichtseinheit anlegen</button> 
		</div>
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

<script src="<?php echo e(asset('js/ddd_subject_topic.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout_backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>