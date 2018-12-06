<!-- Section for subjects -->
	<section id="vischool-subjects">
		<div class="row">
			<div class="col-lg col-lg-offset text-center m-5">
				<h2>Fächer</h2>
			</div>
		</div>
		<div class="container">
		<div class="row">
			<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="col text-center m-5">
				<div class="fa-3x">
					<span class="fa-stack m-2">
						<a href="/subjects/<?php echo e($subject->id); ?>">
						<i class="fas fa-circle fa-stack-2x" style="color:#03c4eb;"></i>
						<i class="fa <?php echo e($subject->subject_icon); ?> fa-stack-1x fa-inverse"></i></a>
					</span>
				</div>
				<h4><a href="/subjects/<?php echo e($subject->id); ?>"><?php echo e($subject->subject_title); ?></a></h4>
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
	</section>		


