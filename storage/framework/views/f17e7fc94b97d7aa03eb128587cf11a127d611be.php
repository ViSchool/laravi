<?php $__env->startSection('main'); ?>
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h1>Schulen administrieren</h1>

<div class="container">
	<table class="table">
		<thead>
			<tr>
				<th>Schule</th>
				<th>Stadt</th>
				<th>Schultyp</th>
				<th>ViSchool Schul-URL</th>
			</tr>
		</thead>
		<tbody>
			<?php $__currentLoopData = $schools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $school): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><a href="/backend/schools/<?php echo e($school->id); ?>"><?php echo e($school->school_name); ?></a></td>
					<td><?php echo e($school->school_city); ?></td>	
					<td><?php echo e($school->school_type); ?></td>
					<td><?php echo e($school->school_vischoolUrl); ?></td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
	<?php echo e($schools->links()); ?>

	<hr>
	<a class="btn btn-primary"href="/backend/schools/create">Neue Schule eintragen</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>