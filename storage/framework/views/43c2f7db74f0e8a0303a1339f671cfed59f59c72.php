<?php $__env->startSection('page-header'); ?>
<section id="page-header">
<div class="container">
	<h2 class="my-4 text-dark"><?php echo e($topic->topic_title); ?></h2>
</div>
</section>
<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('content'); ?>
<section id="privateUnits">
	<div class="container m-4">
		<?php if(count($privateUnits) !== 0): ?> 
		<h4 class="mt-3">Private Lerneinheiten zum Thema "<?php echo e($topic->topic_title); ?>"</h4>
		<div class="row justify-content-start">
			<?php $__currentLoopData = $privateUnits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $privateUnit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="col">
					<div class="card m-3" style="width:200px">	
						<div class="card-header bg-success">
							<a href="/lerneinheit/<?php echo e($privateUnit->id); ?>"><h4 class="text-white card-title"><?php echo e($privateUnit->unit_title); ?></h4></a>
							<p class="card-text">			
								<?php 
									$reviews_privateUnit = App\Review::where('unit_id',$privateUnit->id)->get();
									$average_score_privateUnit = $reviews_privateUnit->avg('overall_score');
								?>
								<?php if($average_score_privateUnit > 0): ?>
									<?php echo $__env->make('components.rating_stars',['average_score' => $average_score_privateUnit], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								<?php endif; ?>
							</p>
						</div>
						<div class="card-body">
							<p>
								<h4>Darum geht's:</h4>
							 	<?php echo e($privateUnit->unit_description); ?>

							</p>
						</div>
						<div class="card-footer">
							<span><i class="<?php echo e($privateUnit->status->status_icon); ?>"></i></span>
      					<p class="text-muted"> <small>Zuletzt aktualisiert: <?php echo e($privateUnit->prettyDate($privateUnit->updated_at)); ?></small> </p>
    					</div>
  					</div>
  				</div>
  			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		 	
		</div>
		<hr>
		<?php endif; ?>
	</div>
</section>

<section id="topic_contents">	
	<div class="container m-4">
		<?php if(count($privateContents) !== 0): ?> 
		<h4 class="mt-3">Private Inhalte zum Thema "<?php echo e($topic->topic_title); ?>"</h4>
		<div class="row justify-content-start">	
			<?php $__currentLoopData = $privateContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $privateContent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col">
				<div class="card m-3" style="width:200px">
					<?php if(isset($privateContent->content_img_thumb)): ?>
						<a href="/content/<?php echo e($privateContent->id); ?>"><img class="card-img-top" src="/images/contents/<?php echo e($privateContent->content_img); ?>" alt="Bild:<?php echo e($publicContent->content_title); ?>"></img></a>
					<?php endif; ?>
					<?php if(empty($privateContent->content_img_thumb)): ?> 
						<?php switch($privateContent->tool_id):
							case (1): ?>
								<a href="/content/<?php echo e($privateContent->id); ?>"><img class="card-img-top" src="https://img.youtube.com/vi/<?php echo e($privateContent->toolspecific_id); ?>/mqdefault.jpg"></img></a>
							<?php break; ?>
							<?php case (7): ?>
								<a href="/content/<?php echo e($privateContent->id); ?>"><img class="card-img-top" src="<?php echo e($privateContent->img_thumb_url); ?>"></img></a>
							<?php break; ?>
							<?php default: ?>
								<?php if(isset($privateContent->portal->portal_img)): ?>
								<a href="/content/<?php echo e($privateContent->id); ?>"><img class="card-img-top" src="/images/portals/<?php echo e($privateContent->portal->portal_img); ?>"></img></a>
								<?php endif; ?>
						<?php endswitch; ?>
					<?php endif; ?>	
					<div class="card-body">
						<a href="/content/<?php echo e($privateContent->id); ?>"><h4 class="card-title"><?php echo e($privateContent->content_title); ?></h4></a>
						<p class="card-text">
							<?php 
								$reviews_privateContent = App\Review::where('content_id',$privateContent->id)->get();
								$average_score_privateContent = $reviews_privateContent->avg('overall_score');
							?>
							<!-- Sternchenbewertung auf Inhalte-Card -->
							<?php if($average_score_privateContent > 0): ?>
								<?php echo $__env->make('components.rating_stars',['average_score' => $average_score_privateContent], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            			<?php endif; ?>
						</p>
					</div>
						
					<div class="card-footer">
      				<small class="text-muted"><i class="<?php echo e($privateContent->type->type_icon); ?> fa-2x"></i> <?php echo e($privateContent->type->content_type); ?></small>
    				</div>
  					
  				</div>
  			</div>
  			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
		</div>
		<?php endif; ?>
	</div>
</section>


<section id="topic_units">
	<div class="container m-4">
		<?php if(count($publicUnits) !== 0): ?> 
		<h4 class="mt-3">Komplette Lerneinheiten zum Thema "<?php echo e($topic->topic_title); ?>"</h4>
		<div class="row justify-content-start">
			<?php $__currentLoopData = $publicUnits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publicUnit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="col">
					<div class="card m-3" style="width:200px">	
						<div class="card-header bg-warning">
							<a href="/lerneinheit/<?php echo e($publicUnit->id); ?>"><h4 class="card-title"><?php echo e($publicUnit->unit_title); ?></h4></a>
							<p class="card-text">
								<?php 
									$reviews_publicUnit = App\Review::where('unit_id',$publicUnit->id)->get();
									$average_score_publicUnit = $reviews_publicUnit->avg('overall_score');
								?>			
								<?php if($average_score_publicUnit > 0): ?>
									<?php echo $__env->make('components.rating_stars',['average_score' => $average_score_publicUnit], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
								<?php endif; ?>
							</p>
						</div>
						<div class="card-body">
							<p>
								<h4>Darum geht's:</h4>
							 	<?php echo e($publicUnit->unit_description); ?>

							</p>
						</div>
						<div class="card-footer">
      					<small class="text-muted">Zuletzt aktualisiert: <?php echo e($publicUnit->updated_at); ?></small>
    					</div>
  					</div>
  				</div>
  			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>		 	
		</div>
		<hr>
		<?php endif; ?>
	</div>
</section>

<section id="topic_contents">	
	<div class="container m-4">
		<h4 class="mt-3">Einzelne Inhalte zum Thema "<?php echo e($topic->topic_title); ?>"</h4>
		<div class="row justify-content-start">	
			<?php $__currentLoopData = $publicContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publicContent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col">
				<div class="card m-3" style="width:200px">
					<?php if(isset($publicContent->content_img_thumb)): ?>
						<a href="/content/<?php echo e($publicContent->id); ?>"><img class="card-img-top" src="/images/contents/<?php echo e($publicContent->content_img); ?>" alt="Bild:<?php echo e($publicContent->content_title); ?>"></img></a>
					<?php endif; ?>
					<?php if(empty($publicContent->content_img_thumb)): ?> 
						<?php switch($publicContent->tool_id):
							case (1): ?>
								<a href="/content/<?php echo e($publicContent->id); ?>"><img class="card-img-top" src="https://img.youtube.com/vi/<?php echo e($publicContent->toolspecific_id); ?>/mqdefault.jpg"></img></a>
							<?php break; ?>
							<?php case (7): ?>
								<a href="/content/<?php echo e($publicContent->id); ?>"><img class="card-img-top" src="<?php echo e($publicContent->img_thumb_url); ?>"></img></a>
							<?php break; ?>
							<?php default: ?>
								<?php if(isset($publicContent->portal->portal_img)): ?>
								<a href="/content/<?php echo e($publicContent->id); ?>"><img class="card-img-top" src="/images/portals/<?php echo e($publicContent->portal->portal_img); ?>"></img></a>
								<?php endif; ?>
						<?php endswitch; ?>
					<?php endif; ?>	
					<div class="card-body">
						<a href="/content/<?php echo e($publicContent->id); ?>"><h4 class="card-title"><?php echo e($publicContent->content_title); ?></h4></a>
						<p class="card-text">
							<?php 
								$reviews_publicContent = App\Review::where('content_id',$publicContent->id)->get();
								$average_score_publicContent = $reviews_publicContent->avg('overall_score');
							?>
							<!-- Sternchenbewertung auf Inhalte-Card -->
							<?php if($average_score_publicContent > 0): ?>
								<?php echo $__env->make('components.rating_stars',['average_score' => $average_score_publicContent], \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            			<?php endif; ?>
						</p>
					</div>
						
					<div class="card-footer">
      				<small class="text-muted"><i class="<?php echo e($publicContent->type->type_icon); ?> fa-2x"></i> <?php echo e($publicContent->type->content_type); ?></small>
    				</div>
  					
  				</div>
  			</div>
  			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
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