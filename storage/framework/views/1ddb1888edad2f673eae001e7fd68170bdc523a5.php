<?php $__env->startSection('stylesheets'); ?>
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
<section id="page-header">
<div class="d-flex justify-content-between align-items-center">
	<h2 class="m-4 text-dark">Portalnavigator</h2>
	
</div>
</section>
<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('content'); ?>
<div class="d-flex w-100">
	
			
			
			

	


	
	<div class="portals container my-3">
		
	<p class="mx-4 p-0 mb-0">Lernportale filtern:</p>
	<form action="/portalnavigator/filter" method="post">
		<?php echo csrf_field(); ?>
		<div id="filter_buttons" class="mx-3 d-flex justify-content-start"> 
			<a class="btn btn-secondary  m-2" data-toggle="collapse" href="#filter_subjects" role="button" aria-expanded="false" aria-controls="collapseExample">Fächer</a>	
			<a class="btn btn-secondary  m-2" data-toggle="collapse" href="#filter_types" role="button" aria-expanded="false" aria-controls="collapseExample">Lerninhalte</a>
			<button class="ml-auto btn-sm btn-primary m-2" type="submit">Filter anwenden</button>
		</div>
		
		<div class="collapse" id="filter_subjects">
			<div class="card card-body">
				<div class="btn-group-toggle" data-toggle="buttons">
					<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
						<label class="btn btn-light m-2">
							<input value="<?php echo e($subject->id); ?>" name="subjects[]" type="checkbox"> <?php echo e($subject->subject_title); ?>					
						</label>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div> 
			</div>
		</div>
		<div class="collapse" id="filter_types">
			<div class="card card-body">
				<div class="btn-group-toggle" data-toggle="buttons">
					<?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
						<label class="btn btn-light m-2">
							<input value="<?php echo e($type->id); ?>" name="types[]" type="checkbox"> <?php echo e($type->content_type); ?>

						</label>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div> 
			</div>
		</div>
	</form>

	<hr>

		<div class="container my-5">
			<?php if(count($portals) > 0): ?>
				<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
					<?php $__currentLoopData = $portals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $portal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
						<div class="col mb-4">
							<div class="card">
								<div class=" d-flex justify-content-center bg-white" style="height:120px">
									<img src="/images/portals/<?php echo e($portal->portal_img); ?>" class="img-fluid" style="max-height: 100px" alt="...">
								</div>
								<div class="card-body text-center">
									<a href="<?php echo e($portal->portal_url); ?>" target="_blank"><h5 class="card-title text-brand-blue"><?php echo e($portal->portal_title); ?></h5></a>
									<p class="card-text"><small><?php echo e($portal->portal_description); ?></small></p>
								</div>
								<div class="d-flex justify-content-between card-footer">
									
									<div class="" id="types_part_<?php echo e($portal->id); ?>">
										<?php
											$i = 0; 
										?>
										<?php $__currentLoopData = $portal->types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
												<span class="badge badge-pill badge-warning"><small><?php echo e($type->content_type); ?></small></span>
												<?php if(++$i > 2): ?>
													<button class="btn btn-link" onclick="display_types(<?php echo e($portal->id); ?>)">...</button>
													<?php break; ?>	 
												<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
									<div class="d-none" id="types_all_<?php echo e($portal->id); ?>">
										<?php $__currentLoopData = $portal->types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
												<span class="badge badge-pill badge-warning"><small><?php echo e($type->content_type); ?></small></span>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<button class="btn btn-link m-0" onclick="hide_types(<?php echo e($portal->id); ?>)"><small>Schließen</small>  </button>
									</div>

									
									<div class="" id="subjects_part_<?php echo e($portal->id); ?>">
										<?php
											$i = 0; 
										?>
										<?php $__currentLoopData = $portal->subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
												<span class="badge badge-pill badge-primary"><small><?php echo e($subject->subject_title); ?></small></span>
												<?php if(++$i > 2): ?>
													<button class="btn btn-link" onclick="display_subjects(<?php echo e($portal->id); ?>)">...</button>
													<?php break; ?>	 
												<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
									<div class="d-none" id="subjects_all_<?php echo e($portal->id); ?>">
										<?php $__currentLoopData = $portal->subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
												<span class="badge badge-pill badge-primary"><small><?php echo e($subject->subject_title); ?></small></span>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<button class="btn btn-link m-0" onclick="hide_subjects(<?php echo e($portal->id); ?>)"><small>Schließen</small>  </button>
									</div>

								</div>
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
				</div>	 
			<?php endif; ?>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>
		

<?php $__env->startSection('scripts'); ?>


<script>
	$(document).ready(function () {

		$('#btnSidebarCollapse').on('click', function () {
			$('#filter_sidebar').toggleClass('active');
			$('#btnFilterIcon').toggleClass('fa-filter');
			$('#btnFilterIcon').toggleClass('fa-times');
		});

	});	
</script>

<script src="/js/hide_more_on_portals.js">


<?php $__env->stopSection(); ?>
<?php echo $__env->make('/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/frontend/portals/portals.blade.php ENDPATH**/ ?>