<?php $__env->startSection('main'); ?>
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h1>Tools administrieren</h1>

<div class="container">
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
		<table class="table">
			<thead>
				<tr>
					<th>Titel des Tools</th>
					<th>Bild zum Tool</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $tools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><a href="/backend/tools/<?php echo e($tool->id); ?>"><?php echo e($tool->tool_title); ?></a></td>	
					
					<td><?php if(isset($tool->tool_img_thumb)): ?>
					<img class="image-fluid" src="/images/tools/<?php echo e($tool->tool_img_thumb); ?>"></image>
					<?php endif; ?>
					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
		<ul class="pagination"><?php echo e($tools->links()); ?></ul>
		<hr></hr>
	<a class="btn btn-primary" href="/backend/tools/create">Neues Tool eintragen</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/index_tools.blade.php ENDPATH**/ ?>