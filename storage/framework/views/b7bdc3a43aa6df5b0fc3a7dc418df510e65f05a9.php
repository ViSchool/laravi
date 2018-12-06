<?php $__env->startSection('page-header'); ?>
<section id="page-header">
<div class="container">
	<h2 class="my-4 text-dark">Lerneinheiten zum Thema <?php echo e($topic->topic_title); ?></h2>
</div>
</section>
<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('content'); ?>
<section id="topic_units">
	<div class="container my-4">
				<div class="row justify-content-start">
					<?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="col">
					<div class="card m-3" style="width:200px">	
						<div class="card-body">
							<a href="/lerneinheit/<?php echo e($unit->id); ?>"><h4 class="card-title"><?php echo e($unit->unit_title); ?></h4></a>
							<p class="card-text">			
							<?php echo $__env->make('components.rating_stars',['$average_score' => $average_score], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							</p>
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
		

	
<?php echo $__env->make('/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>