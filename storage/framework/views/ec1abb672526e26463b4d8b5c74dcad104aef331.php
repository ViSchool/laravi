<?php $__env->startSection('page-header'); ?>
<section id="page-header">
<div class="container">
	<h2 class="my-4 text-dark">Suchergebnis</h2>
</div>
</section>
<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('content'); ?>
<section id="topic_units">
</section>

<section id="topic_contents">
	<div class="container my-4">
	<h3>Lerninhalte für die Suche:<?php echo e($query); ?></h3>
		<div class="row justify-content-start">
			<?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="col">
					<div class="card m-3" style="width:200px">	
						<div class="card-body">
							<a href="/lerneinheit/<?php echo e($unit->id); ?>"><h4 class="card-title"><?php echo e($unit->unit_title); ?></h4></a>
							<hr></hr>
							<p><h4>Darum geht's:</h4>
							 <?php echo e($unit->unit_description); ?>

							</p>
						</div>
						<div class="card-footer">
      						<small class="text-muted">Zuletzt aktualisiert: <?php echo e($unit->updated_at); ?></small>
    					</div>
  					</div>
  				</div>
  			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		
			</div>
	</div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>$(function () {
  $('[data-toggle="tooltip"]').tooltip({
  	trigger: 'hover focus'
  })
});
</script>
<?php $__env->stopSection(); ?>		

	
<?php echo $__env->make('/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/frontend/search/search_results_units.blade.php ENDPATH**/ ?>