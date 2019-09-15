<?php $__env->startSection('stylesheets'); ?>
	<link href="/css/rotating-card.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
<section id="page-header">
<div class="container">
	<h2 class="my-4 text-dark"><?php echo e($topic->topic_title); ?></h2>
</div>
</section>
<?php $__env->stopSection(); ?>


		
<?php $__env->startSection('content'); ?>
<?php if(\Session::has('success')): ?>
   <div class="alert alert-success">
      <p><?php echo \Session::get('success'); ?></p>
   </div>
<?php endif; ?>


<section id="privateUnits">
	<div class="container m-4">
		<?php if(count($privateUnits) !== 0 || count($privateSeries)!== 0): ?>
		<h4 class="mt-3">Private Lerneinheiten zum Thema "<?php echo e($topic->topic_title); ?>"</h4>
		<div class="row justify-content-start">

			<?php $__currentLoopData = $privateSeries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $privateSerie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<?php
				 $privateSerieUnits = App\Unit::where('serie_id',$privateSerie->id)->get();
			?>
				<div class="col">
					<div class="card-container-flip manual-flip">
						<div class="card-flip">
							<div class="front-flip">
								<div class="cover-flip">
									<img src="/images/topic_back.jpeg"/>
								</div>
								<div class="user-flip">
									<?php $__currentLoopData = $privateSerieUnits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $privateSerieUnit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($privateSerieUnit->unit_img_thumb !== NULL): ?>
											<img class="img-circle" src="/images/units/<?php echo e($privateSerieUnit->unit_img_thumb); ?>"/> 
											<?php break; ?>
										<?php endif; ?> 
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
									<img class="img-circle" src="/images/logo_cool.jpg"/>
								</div>
								<div class="content-flip">
									 <div class="main-flip">
										 <h3 class="name-flip"><?php echo e($privateSerie->serie_title); ?></h3>
										 <p class="small text-center">Status: <?php echo e($privateSerie->status->status_name); ?> </p>
									</div>
									<div class="footer-flip">
										<p class="small"><?php echo e($privateSerie->units_count); ?> Unterrichtseinheiten</p>
										<button class="btn btn-simple" onclick="rotateCard(this)">
                                    <i class="fa fa-mail-forward"></i> Mehr erfahren
                              </button>
                     		</div>								
								</div>															
							</div> <!--end front panel -->
							<div class="back-flip">
								<div class="header-flip">
									<h5 class="mb-1">Beschreibung:</h5>
                         	<p class="small"><?php echo e($privateSerie->serie_description); ?></p>
								<div class="content-flip">
                     		<div class="main-flip">
                         		<h5 class="">Diese Lerneinheiten gehören zur Serie:</h5>
										<?php $__currentLoopData = $privateSerieUnits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $privateSerieUnit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<a class="small" href="/lerneinheit/<?php echo e($privateSerieUnit->id); ?>"><?php echo e($privateSerieUnit->unit_title); ?></a>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
									</div>
									<div class="footer-flip">
										<button class="btn btn-simple" rel="tooltip" title="umdrehen" onclick="rotateCard(this)">
                                <i class="fa fa-reply"></i> Zurück
                            	</button>
                 				</div>	 
                     	</div>
                 		</div>
						</div>
					</div>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


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
							<small class="text-muted">Zuletzt aktualisiert: <?php echo e($publicUnit->updated_at->diffForHumans()); ?></small>
						</div>
						<?php if(Auth::check()): ?>
						<div class="card-footer">
						<a href="/lehrer/<?php echo e(Auth::user()->id); ?>/copy/<?php echo e($publicUnit->id); ?>" title="Lerneinheit in meinen Account kopieren"><i class="far fa-copy"></i></a>
						</div>
						<?php endif; ?>
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

<script type="text/javascript">
    $().ready(function(){
        $('[rel="tooltip"]').tooltip();

        $('a.scroll-down').click(function(e){
            e.preventDefault();
            scroll_target = $(this).data('href');
             $('html, body').animate({
                 scrollTop: $(scroll_target).offset().top - 60
             }, 1000);
        });

    });

    function rotateCard(btn){
        var $card = $(btn).closest('.card-container-flip');
        console.log($card);
        if($card.hasClass('hover')){
            $card.removeClass('hover');
        } else {
            $card.addClass('hover');
        }
    }


</script>
<?php $__env->stopSection(); ?>		

	
<?php echo $__env->make('/layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>