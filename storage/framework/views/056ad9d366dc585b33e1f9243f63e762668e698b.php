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
		<div class="form-group">
			<label for="serie_description">Kurzbeschreibung/Ziel der Unterrichtsserie:</label>
			<textarea class="form-control" id="serie_description" name="serie_description" aria-label="serie_description" aria-describedby="serie_description"><?php echo e($serie->serie_description); ?></textarea>
		</div>
		
		<div class="form-group">
			<label for="public">Sichtbarkeit der Serie:</label>
			<select class="form-control" id="public" name="public">
				<?php if($serie->public == 0): ?>
				<option value="0">nur Backend</option>
				<option value="1">Frontend und Backend</option>
				<?php else: ?>
				<option value="1">Frontend und Backend</option>
				<option value="0">nur Backend</option>
				<?php endif; ?>
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
<h4>lerneinheiten zur Serie <?php echo e($serie->serie_title); ?></h4>
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