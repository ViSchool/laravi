<?php $__env->startSection('main'); ?>
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h1>Fächer administrieren</h1>

<div class="container">
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Fach</th>
					<th>Icon</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($subject->id); ?></td>
					<td><a href="/backend/subjects/<?php echo e($subject->id); ?>"><?php echo e($subject->subject_title); ?></a></td>	
					<td><i class="fa <?php echo e($subject->subject_icon); ?>"></i></td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
		<?php echo e($subjects->links()); ?>

		<hr></hr>
	<a class="btn btn-primary"href="/backend/subjects/create">Neues Fach eintragen</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>