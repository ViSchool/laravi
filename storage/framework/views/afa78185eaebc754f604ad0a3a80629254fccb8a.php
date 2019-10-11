<?php $__env->startSection('main'); ?>
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h2>Neues Lernportal anlegen</h2>
          <hr></hr>

<div class="container">	
<form method="POST" action="/backend/portals" enctype="multipart/form-data">
<?php echo e(csrf_field()); ?>

	<div class="form-group">
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Titel des Portals:</label>
			</div>
			<input type="text" class="form-control" id="portal_title" name="portal_title" value=<?php echo e(old('portal_title')); ?>>
		</div>
		
		<div class="form-group">
			<label for="portal_description">Beschreibung des Portals:</label>
			<textarea class="form-control" name="portal_description" id="portal_description"><?php echo e(old('portal_description')); ?></textarea>
		</div>
			
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="portal_url">Link zum Portal:</label>
			</div>
			<input type="url" class="form-control" id="portal_url" name="portal_url" placeholder="URL des Portals hierhin kopieren"><?php echo e(old('portal_url')); ?></input>
		</div>
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="price_model">Kosten</label>
			</div>
			<select name="price_model" id="price_model" class="form-control custom-select">
				<option><?php echo e(old('price_model')); ?></option>
				<option>kostenlos</option>
				<option>kostenlos für nicht-kommerzielle Nutzung</option>
				<option>beschränkte kostenlose Nutzung</option>
				<option>werbefinanziert</option>
				<option>Preis pro Benutzer</option>
				<option>Schullizenz</option>
				<option>Klassenlizenz</option>
			</select>
		</div>
			
		<div class="input-group mb-3">
			<div class="input-group-prepend">
			<label class="input-group-text" for="content_types">Angebotene Lerninhalte:</label>
			</div>
			<select class="form-control custom-select" id="content_types" name="content_types[]" multiple="multiple">
				<option value=""></option>
				<?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($type->id); ?>"><?php echo e($type->content_type); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>
	
		<div class="input-group mb-3">
			<div class="input-group-prepend">
			<label class="input-group-text" for="content_types">Angebotene Fächer:</label>
			</div>
			<select class="form-control custom-select" id="subjects" name="subjects[]" multiple="multiple">
				<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($subject->id); ?>"><?php echo e($subject->subject_title); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
		</div>
	
	
	
		<div class="custom-file form-group form-control my-5">
			<label class="custom-file-label" for="portal_img"><i class="far fa-image"></i> Portalbild hochladen</label>
			<input class="custom-file-input" type="file" id="portal_img" name="portal_img">
		</div>
		
		<div class="form-group">
			<button type="submit" class="form-control btn btn-primary">Lernportal speichern</button> 
		</div>
	</form>
</div>

<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<!-- Select2 initialisieren -->
<script>
$(document).ready(function() {
    $("#content_types").select2();
    $("#subjects").select2();
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/create_portals.blade.php ENDPATH**/ ?>