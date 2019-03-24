<?php $__env->startSection('main'); ?>
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h1>Lehreraccount von <?php echo e($teacher->teacher_name); ?> <?php echo e($teacher->teacher_surname); ?> Übersicht</h1>

<div class="container">
	<h3>Zugeordnete Schüleraccounts</h3>
	<table class="table">
		<thead>
			<tr>
				<th>Benutzername des Schülers</th>
				<th>Schule</th>
			</tr>
		</thead>
		<tbody>
			<?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($student->user_name); ?></td>	
					<td><?php echo e($student->school); ?></td>							
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table> 
</div>
<hr>
<div class="container">
	<h3>Zugeordnete Klassenaccounts</h3>
	<table class="table">
		<thead>
			<tr>
				<th>Benutzername für die Klasse</th>
				<th>Schule</th>
			</tr>
		</thead>
		<tbody>
			<?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($class->user_name); ?></td>	
					<td><?php echo e($class->school); ?></td>							
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table> 
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>