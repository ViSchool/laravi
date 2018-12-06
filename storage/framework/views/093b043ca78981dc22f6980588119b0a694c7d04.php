<?php $__env->startSection('stylesheets'); ?>
<script src="/js/showInputs.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h2>Neue Aufgabe für die Unterrichtseinheit <a href="/backend/units/<?php echo e($unit->id); ?>">"<?php echo e($unit->unit_title); ?>"</a> anlegen</h2>
          <h5>Schritt 1 von 4 - Überschrift für die Aufgabe</h5>
          <hr></hr>

<div class="container">
	<?php echo $__env->make('layouts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<form method="POST" action="/backend/blocks" enctype="multipart/form-data">
	<?php echo e(csrf_field()); ?>

	<div class="input-group mb-3">
		<div class="input-group-prepend">
			<label class="input-group-text">Überschrift für die Aufgabe:</label>
		</div>
		<input class="form-control" type="text" id="titleInput" name="title"/>
		<input type="hidden" name="unit_id" value="<?php echo e($unit->id); ?>">
	</div>
	<div class="input-group mb-3">
		<div class="input-group-prepend">
	<label class="input-group-text"for="time">Zeit für die Aufgabe:</label>
		</div>
		<input class="form-control" type="text" maxlength="2" id="time" name="time"></input>
		<div class="input-group-append">
			<span class="input-group-text">Minuten</span>
		</div>
		<small class="text-muted">Bitte hier zunächst eine ungefähre Zeit festlegen. Nach der Auswahl der Inhalte wird die Zeit automatisch überprüft.</small>
	</div>
	<div class="input-group mb-3">
		<div class="input-group-prepend">
			<label class="input-group-text" for="differentiation">Bestimmte Schülergruppe:</label>
		</div>
		<select class="form-control" id="diffenrentiation" name="differentiation">
			<option value="">Bitte wählen</option>
			<?php $__currentLoopData = $differentiations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $differentiation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($differentiation->id); ?>"><?php echo e($differentiation->differentiation_title); ?></option>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</select>
	</div>
	<div class="input-group mb-3">
		<div class="input-group-prepend">
			<label class="input-group-text" for="alternative">Alternative zu dieser Aufgabe:</label>
		</div>
		<select class="form-control" id="alternative" name="alternative">
			<option value="keine">Bitte wählen</option>
			<option value="keine">(noch) keine</option>
			<?php $__currentLoopData = $unit->blocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($block->id); ?>"><?php echo e($block->title); ?> (<?php echo e($block->differentiation->differentiation_title); ?>)</option>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</select>
	</div>
	<hr></hr>
	<button class="btn btn-primary form-control" type="submit">Weiter zu Schritt 2:  Inhalte für diese Aufgabe festlegen</button>
</form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
	$(document).ready(function() {
	$('.task-summernote').summernote({
		toolbar: [],
	});
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout_backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>