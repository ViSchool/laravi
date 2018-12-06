<?php $__env->startSection('main'); ?>
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h2>Lernportal bearbeiten</h2>
          <hr></hr>

<div class="container">	
	<form method="POST" action="<?php echo e(route('portals.update',[$portal->id])); ?>"  enctype="multipart/form-data">
		<?php echo e(csrf_field()); ?> <?php echo e(method_field('PATCH')); ?>

		<div class="form-group">
			<div class="input-group mb-3">
				<div class="input-group-prepend">
					<span class="input-group-text">Titel des Portals:</label>
				</div>
				<input type="text" class="form-control" id="portal_title" name="portal_title" value="<?php echo e($portal->portal_title); ?>">
		</div>
		
		<div class="form-group">
			<label for="portal_description">Beschreibung des Portals:</label>
			<textarea class="form-control" name="portal_description" id="portal_description"><?php echo e($portal->portal_description); ?></textarea>
		</div>
			
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="portal_url">Link zum Portal:</label>
			</div>
			<input type="url" class="form-control" id="portal_url" name="portal_url" value="<?php echo e($portal->portal_url); ?>"></input>
		</div>
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="price_model">Kosten</label>
			</div>
			<select name="price_model" id="price_model" class="form-control custom-select">
				<option value="<?php echo e($portal->pricemodel); ?>"><?php echo e($portal->portal_pricemodel); ?></option>
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
	<?php if(isset($portal->portal_img)): ?>
	<div class="form-group">
		<p>Aktuelles Bild für das Lernportal:<p>
		<img class="img-fluid" src="/images/portals/<?php echo e($portal->portal_img); ?>"></img>
	</div>
	<?php endif; ?>
	
		<div class="form-group form-control my-5">
			<label for="portal_img"><i class="far fa-image"></i> Portalbild ändern</label>
			<input type="file" id="portal_img" name="portal_img">
		</div>
		
		<div class="form-group">
			<button type="submit" class="form-control btn btn-primary">Änderungen speichern</button> 
		</div>
	</form>
</div>

<div class="form-group mt-5">
		<form method="POST" action="<?php echo e(route('backend.portals.destroy',$portal->id)); ?>">
			<?php echo e(csrf_field()); ?> <?php echo e(method_field('DELETE')); ?>

			<button class=" form-control btn btn-warning" type="submit"> Lernportal komplett löschen</button>
		</form>
	</div>

<?php echo $__env->make('layouts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<!-- Select2 initialisieren -->
<script>
$(document).ready(function() {
    $("#content_types").select2();
    $("#content_types").select2().val(<?php echo json_encode($portal->types()->allRelatedIds()); ?>).trigger('change');
    $("#subjects").select2();
    $("#subjects").select2().val(<?php echo json_encode($portal->subjects()->allRelatedIds()); ?>).trigger('change');
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.vischool_backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>