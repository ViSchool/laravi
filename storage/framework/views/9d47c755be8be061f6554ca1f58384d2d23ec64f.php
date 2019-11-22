<?php $__env->startSection('stylesheets'); ?>
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
<section id="page-header">
<div class="d-flex justify-content-between align-items-center">
	<h2 class="m-4 text-dark"><?php echo e($subject->subject_title); ?></h2>
	<?php if(count($publicTopics) + count($privateTopics) > 200): ?>
	<div class="m-4 px-4 d-block d-md-none">
		<button id="btnSidebarCollapse" class="btn btn-light" type="button">
			<i id="btnFilterIcon" class="fas fa-filter"></i>
		</button>
	</div>
	<?php endif; ?>
</div>
</section>
<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('content'); ?>
<div class="d-flex w-100">
	<?php if(count($publicTopics) + count($privateTopics) > 200): ?>
	<nav id="filter_sidebar">
		<ul class="list-unstyled components ">
         <h4 class="mx-5">Themen filtern</h4>
			
			
			<li>
				<a href="#klassenstufeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Klassenstufe</a>
            <ul class="collapse list-unstyled" id="klassenstufeSubmenu">
					<?php $__currentLoopData = $klassenstufeTags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $klassenstufeTag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li>
							<div class="form-check m-0 p-0">
							<input class="form-check-input" type="checkbox" id="<?php echo e($klassenstufeTag->id); ?>" value="<?php echo e($klassenstufeTag->id); ?>">
  								<label class="form-check-label font-weight-normal ml-4" for="klassenstufe_<?php echo e($klassenstufeTag->id); ?>">
								  <?php echo e($klassenstufeTag->tag_name); ?>

								</label>
							</div>
               	</li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
			</li>
      </ul>
	</nav>
	<?php endif; ?>

	<div class="topics">
		<div class="container">
			<?php if(count($privateTopics) > 0): ?>
				<div class="row mt-5 ml-3">
					<h3>Private Themen</h3>
				</div>
				<div class="d-flex flex-wrap align-content-center justify-content-center">
					<?php $__currentLoopData = $privateTopics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $privateTopic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="card m-4 text-white" style="width:150px" >
							<?php if($privateTopic->updated_at->diffInDays() < 10): ?>
							<span class=" badge-danger notify-badge">Neu</span>
							<?php endif; ?>
							<a href="/topic/<?php echo e($privateTopic->id); ?>">
								<img class="card-img rounded img-thumbnail bg-success" src="/images/topic_back.jpeg" alt="Card image">
							</a>
							<div class="card-img-overlay">
								<a href="/topic/<?php echo e($privateTopic->id); ?>">
									<div class="card-text d-flex align-content-between justify-content-center">
										<h5 class="text-white text-center"><?php echo e($privateTopic->topic_title); ?></h5>
										<p class="content-badge badge-info"><?php echo e($privateTopic->content->count()); ?> Inhalte</p>	
									</div>
								</a>	
							</div>
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
				<hr>
				<div class="row mt-3 ml-3">
					<h3>Öffentliche Themen</h3>
				</div>
			<?php endif; ?>
				
			<div class="d-flex flex-wrap align-content-center justify-content-center">
				<?php $__currentLoopData = $publicTopics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php if($topic->content->count()>0): ?>
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
											
										<p class="content-badge badge-primary"> <?php echo e($topic->content->where('status_id',1)->count()); ?> Inhalte</p>	
									</div>
								</a>	
							</div>
						</div>
					<?php endif; ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
			</div>

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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/frontend/subjects/subject_topics.blade.php ENDPATH**/ ?>