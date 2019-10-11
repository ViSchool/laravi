<?php $__env->startSection('main'); ?>
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h1>Blogbeiträge - Übersicht</h1>

<div class="container">
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Titel</th>
					<th>Autor</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($post->id); ?></td>
					<td><a href="/backend/blog/<?php echo e($post->id); ?>"><?php echo e($post->post_title); ?></a></td>	
					<td><?php echo e($post->admin->name); ?></i></td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
		<?php echo e($posts->links()); ?>

		
		<hr></hr>
	<a class="btn btn-primary my-3"href="/backend/blog/create">Neuen Beitrag schreiben</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/index_posts.blade.php ENDPATH**/ ?>