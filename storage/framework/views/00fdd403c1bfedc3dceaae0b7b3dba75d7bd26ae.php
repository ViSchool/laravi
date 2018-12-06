<section id="vischool-blog">
<div class="container my-5">
	<div class="row">
		<div class="col text-center">
			<h2>ViSchool-Blog</h2>
			<p>Neuigkeiten und Wissenswertes</p>
		</div>
	</div>
		
		<div class="card-columns mt-5">
			<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="card">
		<!-- noch prüfen: wenn es ein bild gibt dann diese Zeile einfügen -->
					<?php if(isset($post->post_img)): ?>
					<a href="/blog/<?php echo e($post->id); ?>"><img class="card-img-top" src="/images/posts/<?php echo e($post->post_img); ?>" alt="Card image cap"></a>
					<?php endif; ?>
					<div class="card-body">
						<a href="/blog/<?php echo e($post->id); ?>"><h5 class="card-title"><?php echo e($post->post_title); ?></h5></a>
						<p class="card-text"><small class="text-muted"><?php echo e($post->updated_at->diffForHumans()); ?></small></p>
						<p class="card-text"><?php $__currentLoopData = $post->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><a href="<?php echo e(route('blog.tag',[$tag->id])); ?>"><small class="badge badge-light"><?php echo e($tag->tag_name); ?></small></a><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></p>
					</div>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
</div>
</section>
