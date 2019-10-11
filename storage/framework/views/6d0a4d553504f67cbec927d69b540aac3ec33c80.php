<?php $__env->startSection('page-header'); ?>
<section id="page-header">
<div class="container">
	<h2 class="my-4 text-dark"><?php echo e($topic->topic_title); ?></h2>
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
						<?php if(isset($unit->content_img_thumb)): ?>
						<a href="/content/<?php echo e($content->id); ?>"><img class="card-img-top" src="/images/contents/<?php echo e($content->content_img); ?>" alt="Bild:<?php echo e($content->content_title); ?>"></img></a>
						<?php endif; ?>
						<?php if(empty($content->content_img_thumb)): ?> 
							<?php switch($content->tool_id):
								case (1): ?>
								<a href="/content/<?php echo e($content->id); ?>"><img class="card-img-top" src="https://img.youtube.com/vi/<?php echo e($content->toolspecific_id); ?>/mqdefault.jpg"></img></a>
								<?php break; ?>
								<?php default: ?>
								<?php if(isset($content->portal->portal_img)): ?>
								<a href="/content/<?php echo e($content->id); ?>"><img class="card-img-top" src="/images/portals/<?php echo e($content->portal->portal_img); ?>"></img></a>
								<?php endif; ?>
							<?php endswitch; ?>
						<?php endif; ?>	
						<div class="card-body">
							<a href="/content/<?php echo e($content->id); ?>"><h4 class="card-title"><?php echo e($content->content_title); ?></h4></a>
							<p class="card-text">			
							<?php $rating = 1.3; ?>  

            <?php $__currentLoopData = range(1,5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="fa-stack" style="width:1em">
                    <i class="far fa-star fa-stack-1x"></i>

                    <?php if($rating >0): ?>
                        <?php if($rating >0.5): ?>
                            <i class="fas fa-star fa-stack-1x"></i>
                        <?php else: ?>
                            <i class="fas fa-star-half fa-stack-1x"></i>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php $rating--; ?>
                </span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</p>
							</div>
						
							
						<div class="card-footer">
      						<small class="text-muted"><i class="<?php echo e($content->type->type_icon); ?> fa-2x"></i> <?php echo e($content->type->content_type); ?></small>
    					</div>
  					
  					</div>
  					</div>
  					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
  			<div class="container row">	
			<ul class="pagination"><?php echo e($contents->links()); ?></ul>
			</div>
			</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
		

	
<?php echo $__env->make('/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/frontend/units/index_units.blade.php ENDPATH**/ ?>