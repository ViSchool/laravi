<?php $__env->startSection('main'); ?>
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h1>Lehreraccounts Übersicht</h1>

<div class="container">
	<table class="table">
		<thead>
			<tr>
				<th class="text-muted">Email</th>
				<th>Name des Lehrers</th>
				<th>Schule</th>
				<th>Premiumaccount?</th>
			</tr>
		</thead>
		<tbody>
			<?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td class="text-muted"><?php echo e($teacher->email); ?></td>
					<td><a href="/backend/teacher/<?php echo e($teacher->id); ?>"><?php echo e($teacher->teacher_name); ?> <?php echo e($teacher->teacher_surname); ?></a></td>	
					<td><?php echo e($teacher->school); ?></td>
					<td>
						<?php if($teacher->hasRole('Lehrer (premium)')): ?>
							<i class="fas fa-euro-sign"></i><i class="fas fa-euro-sign"></i> ja
						<?php else: ?>
							<i class="fab fa-creative-commons-nc-eu"></i> nein
						<?php endif; ?>
					</td>								
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table> 
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/index_teacher.blade.php ENDPATH**/ ?>