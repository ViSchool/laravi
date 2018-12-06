		
<?php $__env->startSection('page-header'); ?>
	<?php echo $__env->make('teacher.teacher_components.loggedInTeacher', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
	<h2 class=" mt-5 text-brand-blue">Fächer</h2>
	</div>
	<div class="row">
	<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<div class="col">
			<div class="item">
				<div class="card m-4 text-white" style="width:100px" >
  					<a href="#">
  						<img class="card-img rounded img-thumbnail" src="/images/topic_back.jpeg" alt="Card image">
  					</a>
  					<div class="card-img-overlay">
    					<div class="card-text">
    						<span class="align-middle text-center">
    							<a href="">
    								<h5 class="text-white mt-5"><?php echo e($subject->subject_title); ?></h5>
    							</a>
    						</span>
    					</div>
  					</div>
				</div>
			</div>
		</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
	
<hr></hr>

</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout_teacher', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>