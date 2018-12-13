<?php $__env->startSection('page-header'); ?>
<section id="page-header">
<div class="container">
	<h2 class="my-4 text-dark"><?php echo e($subject->subject_title); ?></h2>
</div>
</section>
<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('content'); ?>
<section id="subject-topics">
	<div class="container">
		<div class="row">
			<?php $__currentLoopData = $subject->topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="col">
					<div class="item">
					<div class="card m-4 text-white" style="width:150px" >
  						<?php if($topic->updated_at->diffInDays() < 10): ?>
  						<span class=" badge-danger notify-badge">Neu</span>
  						<?php endif; ?>
  						<a href="/topic/<?php echo e($topic->id); ?>">
  							<img class="card-img rounded img-thumbnail" src="/images/topic_back.jpeg" alt="Card image">
  						</a>
  						<div class="card-img-overlay">
    						<div class="card-text">
    						<span class="align-middle  text-center">
    						<a href="/topic/<?php echo e($topic->id); ?>">
    						<h5 class="text-white mt-5"><?php echo e($topic->topic_title); ?></h5>
    						</a>
    						</span>
    						<a href="/topic/<?php echo e($topic->id); ?>">
    							<span class="ml-5 p-2 content-badge badge-info"><?php echo e($topic->content()->count()); ?> Inhalte</span>
    						</a>
    						</div>
  						</div>
					</div>
					</div>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>
		

	
<?php echo $__env->make('/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>