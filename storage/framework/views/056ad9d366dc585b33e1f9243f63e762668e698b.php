<?php $__env->startSection('main'); ?>
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h4 class="mb-4"> Serie "<?php echo e($serie->serie_title); ?>" bearbeiten</h4>

<div class="container">
	<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	
	<form method="POST" action="<?php echo e(route('series.update',$serie->id)); ?>">
		<?php echo e(csrf_field()); ?> <?php echo e(method_field('PATCH')); ?>

		<div class="form-group">
			<label for="subject_title">Titel der Serie:</label>
			<input type="text" class="form-control" id="serie_title" name="serie_title" value="<?php echo e($serie->serie_title); ?>">
		</div>
		
		<div class="form-group<?php echo e($errors->has('serie_description') ? ' invalid' : ''); ?>">
            <label for="task" class=" col-form-label mb-0 pb-0">Beschreibung der Serie</label>
            <label for="task" class=" col-form-label mt-0 pt-0">
				<small class="text-muted"> Hier kannst Du beschreiben, welche Inhalte in der Serie enthalten sind.</small>
			</label>
			<div class="border">
				<textarea id="serie_description" rows="3" class="form-control" name="serie_description" ><?php echo e($serie->serie_description); ?></textarea>
         	<?php if($errors->has('serie_description')): ?>
            <span class="help-block">
               <strong><?php echo e($errors->first('serie_description')); ?></strong>
            </span>
				<?php endif; ?>
			</div>
		</div>
		
		<div class="form-group<?php echo e($errors->has('status') ? ' invalid' : ''); ?>">
         <label for="status" class=" col-form-label mb-0 pb-0">Status der Serie</label>
			<select class="custom-select" name="status_id" id="status_id">
				<option value="<?php echo e($serie->status_id); ?>"><?php echo e($serie->status->status_name); ?></option>
				<?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($status->id); ?>"><?php echo e($status->status_name); ?></option> 
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-secondary">Änderungen speichern</button>
		</div>
	
	</form>
	<hr></hr>
		<div class="form-group">
			<form method="POST" action="<?php echo e(route('series.destroy',[$serie->id])); ?>">
				<?php echo e(csrf_field()); ?> <?php echo e(method_field('DELETE')); ?>

					<button class="btn btn-warning" type="submit"> Serie komplett löschen</button>
			</form>
		</div>
</div>

<hr></hr>
<div class = "container">
<h4>Lerneinheiten zur Serie <?php echo e($serie->serie_title); ?></h4>
		<table class="table">
			<thead>
				<tr>
					<th>Name der Lerneinheiten</th>
					<th>Anzahl der Aufgaben in der Einheit</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $serie->units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><a href="/backend/units/<?php echo e($unit->id); ?>"><?php echo e($unit->unit_title); ?></a></td>
					<?php $blocksCount = $unit->blocks->count(); ?>	
					<td><?php echo e($blocksCount); ?></td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>	
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/show_series.blade.php ENDPATH**/ ?>