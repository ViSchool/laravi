<?php $__env->startSection('main'); ?>
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h1>Themen administrieren</h1>

<div class="container">
	<a href="/backend/topics/create" class="btn btn-primary mb-3">Neues Thema eintragen</a>
	<hr></hr>
	<p><h4>Eingetragene Themen</h4></p>
		<table class="table">
			<thead>
				<tr>
					<th class="text-muted">ID</th>
					<th>Name des Themas</th>
					<th>Fächer</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td class="text-muted"><?php echo e($topic->id); ?></td>
					<td><a href="/backend/topics/<?php echo e($topic->id); ?>"><?php echo e($topic->topic_title); ?></a></td>	
					<td><?php $__currentLoopData = $topic->subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<p><?php echo e($subject->subject_title); ?></p>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</td>								
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>. 
		<ul class="pagination"><?php echo e($topics->links('vendor.pagination.bootstrap-4')); ?></ul>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>