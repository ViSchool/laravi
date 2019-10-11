		
<?php $__env->startSection('page-header'); ?>
<section id="page-header">
	<div class="container">
		<span class="align-middle p-3">
			<h3 class="mt-4">Beiträge zum Tag: <?php echo e($tag->tag_name); ?></h3>
		</span>
	</div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
<?php $__currentLoopData = $tag->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(isset($post->post_img)): ?>
<img class="img-fluid my-5" src="/images/posts/<?php echo e($post->post_img); ?>"></img>
<?php endif; ?>
	<?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><small class="badge badge-light my-4"><?php echo e($tag->tag_name); ?></small><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__currentLoopData = $tag->posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<h3 class="text-uppercase"><?php echo e($post->post_title); ?></h3>
<p><?php echo $post->post_body; ?></p>
<hr></hr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/frontend/posts/tags_posts.blade.php ENDPATH**/ ?>