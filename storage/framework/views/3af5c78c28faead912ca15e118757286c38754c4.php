<?php $__env->startSection('main'); ?>

    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h1>Fächer administrieren</h1>

<div class="container">	
	<form method="POST" action="/backend/subjects">
		<?php echo e(csrf_field()); ?>

		<div class="form-group">
			<label for="subject_title">Fachname:</label>
			<input type="text" class="form-control" id="subject_title" name="subject_title">
		</div>
		<div class="form-group">
			<label for="subject_icon">Icon:</label>
			<select class="form-control mb-4" id="subject_icon" name="subject_icon">
				<option>Bitte Icon auswählen</option>
				<?php $__currentLoopData = $icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($icon->icon_title); ?>"><?php echo e($icon->icon_title); ?>: &#x<?php echo e($icon->icon_number); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
			<label>Übersichtsseite für Icons:</label>
			<a href="https://fontawesome.com/icons?d=gallery&m=free" target="_blank">Font Awesome Gallery</a>
		</div>
		
		
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Fach eintragen</button>
		</div>
	<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/create_subjects.blade.php ENDPATH**/ ?>