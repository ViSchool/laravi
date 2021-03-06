<?php $__env->startSection('page-header'); ?>
<section id="page-header">
<div class="d-flex justify-content-between align-items-center">
	<h2 class="m-4 text-dark">Lerneinheiten aus der Serie "<?php echo e($serie->serie_title); ?>"</h2>
</div>
</section>
<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('content'); ?>
<section id="serie_units">
	<div class="container my-4">
				<div class="row justify-content-start">
					<?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="col">
					<div class="card m-3" style="width:200px">	
						<div class="card-body">
							<a href="/lerneinheit/<?php echo e($unit->id); ?>"><h4 class="card-title"><?php echo e($unit->unit_title); ?></h4></a>
							<p class="card-text">			
							<?php echo $__env->make('components.rating_stars',['$average_score' => $average_score], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
							</p>
							<hr></hr>
							<p><h4>Darum geht's:</h4>
							 <?php echo e($unit->unit_description); ?>

							</p>
						</div>
						<div class="card-footer flex-column align-items-center justify-content-center">
							<small class="text-muted">Aktualisiert: <?php echo e($unit->updated_at->diffForHumans()); ?></small>
							<?php if(Auth::check()): ?>
								<a class="btn btn-primary w-100" href="/lehrer/<?php echo e(Auth::user()->id); ?>/copy/<?php echo e($unit->id); ?>" title="Lerneinheit in meinen Account kopieren"><i class="far fa-copy"></i><small> Lerneinheit kopieren </small> </a>
							<?php endif; ?>
						</div>
  					
  					</div>
  					</div>
  					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
  			 
			</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
		

	
<?php echo $__env->make('/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/frontend/units/units_serie.blade.php ENDPATH**/ ?>