<?php $__env->startSection('main'); ?>
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <div><h2>Unterrichtseinheiten administrieren
          <a href="/backend/units/create"><i class="far fa-plus-square"></i></a></h2></div>
          

<div class="container">
	<div class="my-4">
	<p>Inhalte nach Fächern filtern:</p>
	<?php $__currentLoopData = $subjects->sortBy('subject_title'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<a class="btn btn-info m-1" href="/backend/units/subjectfilter/<?php echo e($subject->id); ?>"><?php echo e($subject->subject_title); ?></a>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
		<table class="table table-hover table-sm">
			<thead>
				<tr>
					<th>Titel der Unterrichtseinheit</th>
					<th>Thema</th>
					<th>Fach</th>
					<th>dazugehörige Serie</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
				<td><a href="/backend/units/<?php echo e($unit->id); ?>"><?php echo e($unit->unit_title); ?></a></td>	
					<td><?php echo e($unit->topic->topic_title); ?></td>
					<td><?php echo e($unit->subject->subject_title); ?></td>
					<td>
						<?php if($unit->serie_id !== NULL): ?>
							<?php echo e($unit->serie->serie_title); ?>

						<?php endif; ?>
					</td>
				<td class="text-center"><i id="unit_status" class="<?php echo e($unit->status->status_icon); ?>" data-toggle="tooltip" title="<?php echo e($unit->status->status_name); ?>"></i></td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
		<ul class="pagination"><?php echo e($units->links()); ?></ul>
		<hr>
	<a class="btn btn-primary" href="/backend/units/create">Neue Unterrichtseinheit erstellen</a>
	
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
	$(function () {
  		$('[data-toggle="tooltip"]').tooltip()
	})
</script>	 

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/index_units.blade.php ENDPATH**/ ?>