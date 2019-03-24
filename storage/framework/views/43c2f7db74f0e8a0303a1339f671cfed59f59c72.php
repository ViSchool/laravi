<?php $__env->startSection('page-header'); ?>
<section id="page-header">
<div class="container">
	<h2 class="my-4 text-dark"><?php echo e($topic->topic_title); ?></h2>
</div>
</section>
<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('content'); ?>
<section id="topic_units">
</section>

<section id="topic_contents">
	<div class="container my-4">
		<?php if(count($topic->unit) !== 0): ?> 
		<h4>Komplette Lerneinheiten zum Thema "<?php echo e($topic->topic_title); ?>"</h4>
		<div class="row justify-content-start">
			<?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="col">
					<div class="card m-3" style="width:200px">	
						<div class="card-header bg-warning">
							<a href="/lerneinheit/<?php echo e($unit->id); ?>"><h4 class="card-title"><?php echo e($unit->unit_title); ?></h4></a>
							<p class="card-text">			
								<?php echo $__env->make('components.rating_stars',['$average_score' => $average_score], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
							</p>
						</div>
						<div class="card-body">
							<p>
								<h4>Darum geht's:</h4>
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
		<?php endif; ?>
		<hr>

		<h4>Einzelne Inhalte zum Thema "<?php echo e($topic->topic_title); ?>"</h4>
		<div class="row justify-content-start">	
			<?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col">
				<div class="card m-3" style="width:200px">
					<?php if(isset($content->content_img_thumb)): ?>
						<a href="/content/<?php echo e($content->id); ?>"><img class="card-img-top" src="/images/contents/<?php echo e($content->content_img); ?>" alt="Bild:<?php echo e($content->content_title); ?>"></img></a>
					<?php endif; ?>
					<?php if(empty($content->content_img_thumb)): ?> 
						<?php switch($content->tool_id):
							case (1): ?>
								<a href="/content/<?php echo e($content->id); ?>"><img class="card-img-top" src="https://img.youtube.com/vi/<?php echo e($content->toolspecific_id); ?>/mqdefault.jpg"></img></a>
							<?php break; ?>
							<?php case (7): ?>
								<a href="/content/<?php echo e($content->id); ?>"><img class="card-img-top" src="<?php echo e($content->img_thumb_url); ?>"></img></a>
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
						<?php 
							$reviews = App\Review::where('content_id',$content->id)->get();
							$average_score = $reviews->avg('overall_score');
						?>
					<!-- Sternchenbewertung auf Inhalte-Card -->
					<?php if($average_score > 0): ?>
						<?php echo $__env->make('components.rating_stars',['$average_score' => $average_score], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            	<?php endif; ?>
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

<?php $__env->startSection('scripts'); ?>
<script>$(function () {
  $('[data-toggle="tooltip"]').tooltip({
  	trigger: 'hover focus'
  })
});
</script>
<?php $__env->stopSection(); ?>		

	
<?php echo $__env->make('/layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>