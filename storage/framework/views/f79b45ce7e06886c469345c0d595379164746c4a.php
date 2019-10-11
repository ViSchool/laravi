		
		<?php $__env->startSection('page-header'); ?>

	

		<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('content'); ?>
<h2>Registrieren</h2>
	<form method="POST" action="<?php echo e(route ('register.store')); ?>">
		<?php echo e(csrf_field()); ?>

		<div class="form-group">
			<label for="name">Name:</label>
			<input type="text" class="form-control" id="name" name="name" required>
		</div>
		<div class="form-group">
			<label for="email">Email:</label>
			 <input type="text" class="form-control" id="email" name="email" required>
		</div>
		<div class="form-group">
			<label for="password">Passwort:</label>
			 <input type="password" class="form-control" id="password" name="password" required>
		</div>
		<div class="form-group">
			<label for="password_confirmation">Passwort bestätigen:</label>
			 <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Registrieren</button>
		</div>
	<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</form>

		<?php $__env->stopSection(); ?>
		

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/sessions/create.blade.php ENDPATH**/ ?>