<?php $__env->startSection('main'); ?>
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
	<div class="container">
		<h2>Lerneinheiten administrieren</h2>
		<a class="btn btn-primary"href="/backend/units">Alle anzeigen</a>
	</div>

	<div class="container">
		<div class="my-4">
			<p>Lerneinheiten für das Fach 
				<a class="btn-sm btn-primary" href="/backend/units/subjectfilter/<?php echo e($currentSubject->id); ?>"><?php echo e($currentSubject->subject_title); ?>

				</a>
			</p>	
		<hr></hr>
			<p>Andere Themen: </p>
			<?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<a class="btn btn-info m-1" href="<?php echo e(route('backend.units.filtertopics',['topic' => $topic->id , 'subject' => $currentSubject->id])); ?>"><?php echo e($topic->topic_title); ?></a>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
		<table class="table table-hover table-sm">
			<thead>
				<tr>
					<th>Titel der Lerneinheit</th>
					<th>Thema</th>
					<th>Fach</th>
					<th>dazugehörige Serie</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><a href="<?php echo e(route ('backend.units.show',[$unit->id])); ?>"><?php echo e($unit->unit_title); ?></a></td>	
					<td><?php echo e($unit->topic->topic_title); ?></td>
					<td><?php echo e($unit->subject->subject_title); ?></td>
					<td>
						<?php if($unit->serie_id !== NULL): ?>
						<?php echo e($unit->serie->serie_title); ?>

						<?php endif; ?>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
		<ul class="pagination"><?php echo e($units->links()); ?></ul>
		<hr></hr>
	<a class="btn btn-primary" href="/backend/units/create">Neue Lerneinheit erstellen</a>
	
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views//backend/index_units_topicfilter.blade.php ENDPATH**/ ?>