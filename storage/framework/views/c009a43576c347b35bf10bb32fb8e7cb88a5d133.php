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
		<table class="table">
			<thead>
				<tr>
					<th>Titel des Unterrichtseinheit</th>
					<th>Thema</th>
					<th>Fach</th>
					<th>dazugehörige Serie</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><a href="<?php echo e(route ('backend.units.show',[$unit->id])); ?>"><?php echo e($unit->unit_title); ?></a></td>	
					<td><?php echo e($unit->topic->topic_title); ?></td>
					<td><?php echo e($unit->subject->subject_title); ?></td>
					<td><?php $__currentLoopData = $unit->series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if(isset($serie->id)): ?>
						<?php echo e($serie->serie_title); ?>

						<?php endif; ?>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
		<ul class="pagination"><?php echo e($units->links('vendor.pagination.bootstrap-4')); ?></ul>
		<hr></hr>
	<a class="btn btn-primary" href="/backend/units/create">Neue Unterrichtseinheit erstellen</a>
	
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>