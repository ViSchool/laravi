<?php $__env->startSection('page-header'); ?>
<section id="page-header">
<div class="container">
	<h2 class="my-4 text-dark">Du hast gesucht nach: "<?php echo e($query); ?>"</h2>
</div>
</section>
<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('content'); ?>
<?php if($topicsCount == 0): ?>
	<div class="container pt-5">Es gibt keine Themen zu Deinem Suchbegriff.</div>
<?php endif; ?>
<?php if($topicsCount > 0): ?>
<section id="search_result_topics">
	<div class="container pt-3">
		<p> Wir haben <a href="/suche/topics/<?php echo e($query); ?>"><?php echo e($topicsCount); ?> Themen</a> gefunden:</p>
		
		<div class="topics">
			<div class="d-flex flex-wrap align-content-center justify-content-center">
				<?php $__currentLoopData = $topics3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

		<?php if($topicsCount > 3): ?>
			<div class="col">
				<a class="btn-primary" href="http://">Zeige alle Themen</a>
			</div>
		<?php endif; ?>
	</div>
</section>	
<?php endif; ?>

<section id="search_result_contents">
	<?php if($contentsCount == 0): ?>
		<div class="container pt-3">Es gibt keine Inhalte zu Deinem Suchbegriff.</div>
	<?php endif; ?>
	<?php if($contentsCount > 0): ?>
	<div class="container my-4">
		<p> Wir haben <a href="/suche/contents/<?php echo e($query); ?>"><?php echo e($contentsCount); ?> Inhalte</a> gefunden:</p>
		<div class="row justify-content-start">
			<?php $__currentLoopData = $contents3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
								<?php $rating = $average_score ?>  
								<?php $__currentLoopData = range(1,5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<span class="fa-stack" style="width:1em" data-toggle="tooltip" data-placement="top" title="Durchschnittliche Bewertung">
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
							<?php endif; ?>
						</p>
					</div>
					<div class="card-footer">
      					<small class="text-muted"><i class="<?php echo e($content->type->type_icon); ?> fa-2x"></i> <?php echo e($content->type->content_type); ?></small>
    				</div>
  				</div>
  			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
		</div>
	</div>
	<?php endif; ?>
</section>



<section id="search_results_units">
<?php if($unitsCount == 0): ?>
	<div class="container py-3">Es gibt keine Unterrichtseinheiten zu Deinem Suchbegriff.</div>
<?php endif; ?>
<?php if($unitsCount > 0): ?>
	<div class="container my-4">
		<p> Wir haben <a href="/suche/units/<?php echo e($query); ?>"><?php echo e($unitsCount); ?> Unterrichtseinheiten</a> gefunden:</p>
		<div class="row justify-content-start">
			<?php $__currentLoopData = $units3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="col">
					<div class="card m-3" style="width:200px">	
						<div class="card-body">
							<a href="/lerneinheit/<?php echo e($unit->id); ?>"><h4 class="card-title"><?php echo e($unit->unit_title); ?></h4></a>
							<hr></hr>
							<p><h4>Darum geht's:</h4>
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
	</div>
<?php endif; ?>
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

	
<?php echo $__env->make('/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/frontend/search/search_results.blade.php ENDPATH**/ ?>