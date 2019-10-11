<?php $__env->startSection('main'); ?>
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h1> Benutzerrechte - Übersicht</h1>
<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="container">
	<div class="row mb-3">
		<a class="btn btn-primary" data-toggle="collapse" href="#createPermission">Neue Aufgabe anlegen</a>
		<div class="collapse" id="createPermission">
			<form method="POST" action="/backend/permissions">
				<?php echo e(csrf_field()); ?>

			<div class="card card-body">
				<div class="form-group">
					<label for="name">Name der Aufgabe:</label>
					<input type="text" class="form-control" id="name" name="name">
				</div>
		
				<div class="form-group">
					<label for="role">Aufgabe für folgende Benutzer erlauben (Mehrfachauswahl möglich):</label>
					<select class="form-control select2-multi" name="roles[]" id="roles" multiple="multiple">
						<option value="">Keine</option>
						<?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Neue Aufgabe speichern</button>
				</div>
			</div>
			</form>
		</div>
	</div>
		
	<form method="POST" action="<?php echo e(route('permissions.update')); ?>">
	<?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
		<table class="table table-hover">
		<thead>
			<tr>
				<th>Aufgaben</th>
				<?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<th><?php echo e($role->name); ?></th>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tr>
		</thead>
		<tbody>
			<?php $__currentLoopData = $permissions->sortBy('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($permission->name); ?></td>
					<?php $__currentLoopData = $roles->sortBy('id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<td class="align-middle text-center">			
							<input class="form-check-input" type="checkbox" name="permission-<?php echo e($permission->id); ?>-<?php echo e($role->id); ?>" id="permission-<?php echo e($permission->id); ?>-<?php echo e($role->id); ?>" <?php if($role->hasPermissionTo($permission->name)): ?> checked <?php endif; ?>>
						</td>	
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
	<hr>
	<div class="d-flex form-group justify-content-end">
		<button type="submit" class="btn btn-primary">Änderungen speichern</button>
	</div>
	</form>
	
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
	$(document).ready(function() {
    $('.select2-multi').select2();
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/permissions.blade.php ENDPATH**/ ?>