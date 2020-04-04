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
		
	<p class="mx-4 p-0 mb-0">Deine Filter:</p>
		
	<div id="filtered" class=" d-flex container"> 
		<?php if($filter_subjects == 1): ?>
			<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php
					$remove = $subject->id;
					$othersubjects = $subjects->filter(function($value,$key) use($remove) {
						return $value['id'] != $remove;
					});
				?>
				<form action="/portalnavigator/filter" method="post">
					<?php echo csrf_field(); ?>
					<?php $__currentLoopData = $othersubjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $othersubject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					 	<input type="hidden" name="subjects[]" value="<?php echo e($othersubject->id); ?>">
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php if($filter_types == 1): ?>
					<?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					 	<input type="hidden" name="types[]" value="<?php echo e($type->id); ?>">
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
					<button type="submit" class="btn-sm btn-outline-primary mr-2">
  						<span aria-hidden="true">&times; <?php echo e($subject->subject_title); ?></span>
					</button>
				</form>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>
		<?php if($filter_types == 1): ?>
			<?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php
					$remove = $type->id;
					$othertypes = $types->filter(function($value,$key) use($remove) {
						return $value['id'] != $remove;
					});
				?>
				<form action="/portalnavigator/filter" method="post">
					<?php echo csrf_field(); ?>
					<?php $__currentLoopData = $othertypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $othertype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					 	<input type="hidden" name="types[]" value="<?php echo e($othertype->id); ?>">
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php if($filter_subjects == 1): ?>
						<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					 		<input type="hidden" name="subjects[]" value="<?php echo e($subject->id); ?>">
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
					<button type="submit" class="btn-sm btn-outline-warning mr-2">
  						<span aria-hidden="true">&times; <?php echo e($type->content_type); ?></span>
					</button>
				</form>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>
		<?php if($filter_prices == 1): ?>
			<?php $__currentLoopData = $prices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $price): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php
					$otherprices = $prices;
					if (($key = array_search($price, $otherprices)) !== false) {
    					unset($otherprices[$key]);
					}
				?>
				<form action="/portalnavigator/filter" method="post">
					<?php echo csrf_field(); ?>
					<?php $__currentLoopData = $otherprices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $otherprice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					 	<input type="hidden" name="prices[]" value="<?php echo e($otherprice); ?>">
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php if($filter_types == 1): ?>
						<?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					 		<input type="hidden" name="types[]" value="<?php echo e($type->id); ?>">
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
					<?php if($filter_subjects == 1): ?>
						<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					 		<input type="hidden" name="subjects[]" value="<?php echo e($subject->id); ?>">
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
					<button type="submit" class="btn-sm btn-outline-secondary mr-2">
  						<span aria-hidden="true">&times; <?php echo e($price); ?></span>
					</button>
				</form>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		<?php endif; ?>
		<a href="/portalnavigator" class="ml-auto btn-sm btn-primary mx-2">Alles zurücksetzen</a>
	</div>
			

	

	<hr>

		<div class="container my-5">
			<?php if(count($portals) > 0): ?>
				<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
					<?php $__currentLoopData = $portals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $portal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
						<div class="col mb-4">
							<div class="card h-100">
								<div class="card-header p-0 m-0">
									<p class=" text-center card-text"><small><?php echo e($portal->price_model); ?></small></p>
								</div>
								<div class=" d-flex justify-content-center bg-white" style="height:120px">
									<img src="/images/portals/<?php echo e($portal->portal_img); ?>" class="img-fluid mt-2" style="max-height: 100px" alt="...">
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
													<button class="btn btn-link m-0 p-0 text-warning" onclick="display_types(<?php echo e($portal->id); ?>)">...</button>
													<?php break; ?>	 
												<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
									<div class="d-none" id="types_all_<?php echo e($portal->id); ?>">
										<?php $__currentLoopData = $portal->types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
												<span class="badge badge-pill badge-warning"><small><?php echo e($type->content_type); ?></small></span>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<button class="btn btn-link m-0 p-0" onclick="hide_types(<?php echo e($portal->id); ?>)"><small>Schließen</small>  </button>
									</div>

									
									<div class="" id="subjects_part_<?php echo e($portal->id); ?>">
										<?php
											$i = 0; 
										?>
										<?php $__currentLoopData = $portal->subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
												<span class="badge badge-pill badge-primary"><small><?php echo e($subject->subject_title); ?></small></span>
												<?php if(++$i > 2): ?>
													<button class="btn btn-link m-0 p-0" onclick="display_subjects(<?php echo e($portal->id); ?>)">...</button>
													<?php break; ?>	 
												<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</div>
									<div class="d-none" id="subjects_all_<?php echo e($portal->id); ?>">
										<?php $__currentLoopData = $portal->subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
												<span class="badge badge-pill badge-primary"><small><?php echo e($subject->subject_title); ?></small></span>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<button class="btn btn-link m-0 p-0" onclick="hide_subjects(<?php echo e($portal->id); ?>)"><small>Schließen</small>  </button>
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
<?php echo $__env->make('/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/frontend/portals/portals_filtered.blade.php ENDPATH**/ ?>