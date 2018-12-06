<?php $__env->startSection('main'); ?>
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h1>Lernportale administrieren</h1>

<div class="container">
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
		<table class="table">
			<thead>
				<tr>
					<th>Titel des Portals</th>
					<th>Bild zum Portal</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $portals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $portal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><a href="/backend/portals/<?php echo e($portal->id); ?>"><?php echo e($portal->portal_title); ?></a></td>	
					
					<td><?php if(isset($portal->portal_img_thumb)): ?>
					<img class="image-fluid" src="/images/portals/<?php echo e($portal->portal_img_thumb); ?>"></image>
					<?php endif; ?>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
		<ul class="pagination"><?php echo e($portals->links('vendor.pagination.bootstrap-4')); ?></ul>
		<hr></hr>
	<a class="btn btn-primary" href="/backend/portals/create">Neues Portal eintragen</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.vischool_backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>