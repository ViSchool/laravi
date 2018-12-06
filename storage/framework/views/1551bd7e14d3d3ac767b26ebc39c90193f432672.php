		
<?php $__env->startSection('page-header'); ?>
<section id="page-header">
<div class="container p-3">
	<h4>Einzelne Lerninhalte</h4>
</div>
</section>
<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('content'); ?>

<div class="container">
	<?php echo $breadcrumbs->render(); ?>

</div>
<div id="embedded-content" class="container">	
	<div class="row">
		<div class="col">
			<h3><?php echo e($content->content_title); ?></h3>
			<?php $rating = 1.6; ?>  

            <?php $__currentLoopData = range(1,5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="fa-stack" style="width:1em">
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
			
			<hr></hr>
			<?php switch($content->tool_id): 
				case (1): ?>
					<div class="embed-responsive embed-responsive-<?php echo e($aspect_ratio); ?>">
						<iframe class="embed-responsive-item"
src="http://youtube.com/embed/<?php echo e($content->toolspecific_id); ?>" allowfullscreen></iframe>
					</div>
				<?php break; ?>
				<?php case (4): ?>
					<div style="overflow:auto;-webkit-overflow-scrolling:touch">
						<div class="container">
							<a href="<?php echo e($content->content_link); ?>"><small class="text-muted">Quelle: <?php echo e($content->content_link); ?></small></a>
						</div>
						<iframe src="<?php echo e($content->content_link); ?>" style="width:600px height:800px" allowfullscreen>Der Browser zeigt leider das Dokument nicht richtig an. Hier ist der Inhalt zum Anschauen in einem neuen Fenster: <a href="<?php echo e($content->content_link); ?>"><?php echo e($content->content_title); ?></a></iframe>
					</div>
				<?php break; ?>
				<?php case (5): ?> 
				<div class="d-flex justify-content-end">
				<a href="<?php echo e($content->content_link); ?>"> Als PDF öffnen <i class="far fa-file-pdf fa-2x" style="color:red"></i> </a>			
				</div>

				    <object id="obj" data="<?php echo e($content->content_link); ?>" >object</object>	
				<?php break; ?>
				<?php case (6): ?> 
					<div style="overflow:auto;-webkit-overflow-scrolling:touch">
						<p><iframe src="https://h5p.org/h5p/embed/<?php echo e($content->toolspecific_id); ?>" frameborder="0" allowfullscreen="allowfullscreen" style="width:70% "></iframe><script src="https://h5p.org/sites/all/modules/h5p/library/js/h5p-resizer.js" charset="UTF-8"></script></p>
					</div>
					
					<object id="obj" data="://h5p.org/h5p/embed/<?php echo e($content->toolspecific_id); ?>" >object</object>	
				<?php break; ?>
			<?php endswitch; ?>
		</div>	
	</div>
</div>

<hr></hr>
<div class="container">
 	<div class="row justify-content-start">
 		<div class="col">
 			<h3>Bewerten</h3>
 		</div>
 	</div>
 	<div class="row justify-content-between">	
 		<div class="col">
			
		</div>
 		<div class="col-2">
 			
 				<a class="btn btn-outline-danger btn-sm" href="#"> 
 					<i class="far fa-exclamation-triangle fa-1x"></i> Fehler melden
 				</a>
 			<small class="text-danger"></small>
 		</div>
 	</div>
</div> 
 	
 	
 	 	 <hr></hr>

<div class="container">
	<div class="row">
		<div class="col-4 pt-5">
			<p>Verwandte Artikel:</p>
		</div>
		<div class="col">
			<img class="img-fluid"src="https://img.youtube.com/vi/RmsDBKXDgC4/default.jpg"></img>
		</div>
 		<div class="col">
			<img class="img-fluid"src="https://img.youtube.com/vi/RmsDBKXDgC4/default.jpg"></img>
			</div>
			<div class="col">
			<img class="img-fluid"src="https://img.youtube.com/vi/RmsDBKXDgC4/default.jpg"></img>
			</div>
		</div>  
	</div>
</div>


<hr></hr>
<div class="container">
<h3>Vorhandene Bewertungen</h3>
</div>


<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>