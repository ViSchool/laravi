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

<section id="topics">
	<div class="container my-4">
		<h3>Lerninhalte für die Suche:<?php echo e($query); ?></h3>
		
		<div class="topics">
			<div class="d-flex flex-wrap align-content-center justify-content-center">
				<?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="card m-4 text-white" style="width:150px" >
						<?php if($topic->updated_at->diffInDays() < 10): ?>
							<span class="badge-danger notify-badge">Neu</span>
						<?php endif; ?>
						<a href="/topic/<?php echo e($topic->id); ?>">
							<img class="card-img rounded img-thumbnail" src="/images/topic_back.jpeg" alt="Card image">
						</a>
						<div class="card-img-overlay">
							<a href="/topic/<?php echo e($topic->id); ?>">
								<div class="card-text d-flex align-content-between justify-content-center">
									<h5 class="text-white text-center"><?php echo e($topic->topic_title); ?></h5>
									<p class="content-badge badge-primary"> <?php echo e($topic->content()->count()); ?> Inhalte</p>	
								</div>
							</a>	
						</div>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
			</div>
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

	
<?php echo $__env->make('/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/frontend/search/search_results_topics.blade.php ENDPATH**/ ?>