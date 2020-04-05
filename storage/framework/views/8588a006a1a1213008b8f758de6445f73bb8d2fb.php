		
<?php $__env->startSection('page-header'); ?>
<section id="page-header1">
	<div class="p-3 bg-light">
		<div class="container">
			<h3 class="mt-4 text-dark text-uppercase">ViSchool Blog</h3>
		</div>
	</div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if(isset($post->post_img)): ?>
<img class="img-fluid my-5" src="/images/posts/<?php echo e($post->post_img); ?>"></img>
<?php endif; ?>
	<?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><a href="<?php echo e(route('blog.index',[$post->id])); ?>"><small class="badge badge-light my-4"><?php echo e($tag->tag_name); ?></small></a><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<h3 class="text-uppercase"><?php echo e($post->post_title); ?></h3>
<p class="post_body"><?php echo $post->post_body; ?></p>
<hr></hr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/frontend/posts/index_posts.blade.php ENDPATH**/ ?>