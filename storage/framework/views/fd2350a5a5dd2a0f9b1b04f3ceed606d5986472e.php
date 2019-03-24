<?php $__env->startSection('main'); ?>
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
	<h1>Schuldaten von "<?php echo e($school->school_name); ?>" bearbeiten</h1>
		  
<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="container">	
	<form method="POST" action="<?php echo e(route('schools.update',[$school->id])); ?>" enctype="multipart/form-data">
	<?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
	<div class="form-group">
		<label for="school_name">Name der Schule:</label>
	<input type="text" class="form-control mb-3" id="school_name" name="school_name" value="<?php echo e($school->school_name); ?>">

		<label for="school_vischoolUrl">ViSchool-URL der Schule: (vischool.de/Schule)</label>
		<input type="text" class="form-control mb-3" id="school_vischoolUrl" name="school_vischoolUrl" value="<?php echo e($school->school_vischoolUrl); ?>">
			
		<label for="school_type">Schulart auswählen:</label>
		<select class="form-control  mb-3" id="school_type"" name="school_type">
		<option value="<?php echo e($school->school_type); ?>">Bitte wählen</option>
		<option>Gymnasium</option>
		<option>Realschule</option>
		<option>Hauptschule</option>
		<option>Berufsschule/Berufskolleg</option>
		<option>Gesamtschule</option>
		</select>

		<label for="school_street">Adresse der Schule:</label>
		<input type="text" class="form-control  mb-3" id="school_street" name="school_street" value="<?php echo e($school->school_street); ?>">

		<label for="school_zip_code">PLZ der Schule:</label>
		<input type="number" class="form-control mb-3" id="school_zip_code" name="school_zip_code" value="<?php echo e($school->school_zip_code); ?>">

		<label for="school_city">Stadt:</label>
		<input type="text" class="form-control mb-3" id="school_city" name="school_city" value="<?php echo e($school->school_city); ?>">

		<label for="school_email">Emailadresse der Schule:</label>
		<input type="email" class="form-control mb-3" id="school_email" name="school_email" value="<?php echo e($school->school_email); ?>">

		<label for="school_contact">Ansprechpartner der Schule:</label>
		<input type="text" class="form-control mb-3" id="school_contact" name="school_contact" value="<?php echo e($school->school_contact); ?>">

		<label for="school_phone">Telefonnummer des Ansprechpartners:</label>
		<input type="tel" class="form-control mb-3" id="school_phone" name="school_phone" value="<?php echo e($school->school_phone); ?>">

		<label for="school_accountStatus">Status des Schulaccounts:</label>
		<select class="form-control mb-3" id="school_accountStatus"" name="school_accountStatus">
		<option value="open">geöffnet (Schul-URL ist live)</option>
		<option value="closed">geschlossen (nicht über Schul-URL erreichbar)</option>
		<option value="archived">archiviert (nicht über Schul-URL erreichbar)</option>
		</select>

		<label for="school_comments">Anmerkungen zur Schule:</label>
		<textarea class="form-control mb-3" name="school_comments" id="school_comments" rows="10"><?php echo e($school->school_comments); ?></textarea>

		<div class="form-group mt-3">
			<button type="submit" class="btn btn-primary">Geänderte Schuldaten speichern</button>
		</div>
	</form>
	<hr></hr>

	<div class=" container form-group">
		<form method="POST" action="<?php echo e(route('schools.destroy',[$school->id])); ?>">
			<?php echo e(csrf_field()); ?> <?php echo e(method_field('DELETE')); ?>

			<button class=" form-control btn btn-warning" type="submit"> Schule komplett löschen</button>
		</form>
</div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>