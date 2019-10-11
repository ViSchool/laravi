		
<?php $__env->startSection('page-header'); ?>

	<section id="page-header">
	<div class="container-fluid ml-4 p-4">
		<h4>Unterrichtseinheiten erstellen</h4>
		
	</div>
	</section>
<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('content'); ?>
<div class="row m-0 p-0">
	<div class="col-11 col-md-8 m-3">
		<div class="alert alert-warning d-md-none d-lg-none">
			<p class="lead">Die Toolbox zum Erstellen eigener Unterrichtseinheiten ist für die Benutzung mit Tablets oder größeren Bildschirmen konzipiert. Die Toolbox funktioniert deshalb nicht auf dem Smartphone.</p>
			<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
	<?php if(isset($unit->id)): ?>
				<form method="POST" action="<?php echo e(route('unit.edit',[$unit->id])); ?>" enctype="multipart/form-data">
				<?php echo e(csrf_field()); ?> <?php echo e(method_field('PATCH')); ?>

				<?php else: ?>
				<form method="POST" action="<?php echo e(route('unit.store')); ?>" enctype="multipart/form-data">
				<?php echo e(csrf_field()); ?> 
				<?php endif; ?>
					<div class="form-group mt-3">
						<label style="color:white; font-size:1.25rem;" for="subject_id">Fach auswählen:</label>
						<select class="form-control form-control-lg" id="subject_id" name="subject_id">
							<?php if(isset($unit->id)): ?>
							<option value="<?php echo e($unit->subject_id); ?>"><?php echo e($unit->subject->subject_title); ?></option>
							<?php else: ?>
							<option value=""></option>
							<?php endif; ?>
							<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
							<option value="<?php echo e($subject->id); ?>"><?php echo e($subject->subject_title); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
						
						<label style="color:white; font-size:1.25rem;" for="topic_id">Thema auswählen:</label>
						<select class="form-control form-control-lg" id="topic_id" name="topic_id">
							<?php if(isset($unit->id)): ?>
							<option value="<?php echo e($unit->topic_id); ?>"><?php echo e($unit->topic->topic_title); ?></option>
							<?php else: ?>
							<option>Zuerst Fach auswählen</option>
							<?php endif; ?>
						</select>
						<div class="col-md-2">
							<span id="loader" style="visibility: hidden;">
								<i class="far fa-spinner fa-spin"></i>
							</span>
						</div>

						<label style="color:white; font-size:1.25rem;" for="unit_title">Titel der Unterichtseinheit:</label>
						<?php if(isset($unit->id)): ?>
						<input type="text" class="form-control" id="unit_title" name="unit_title" aria-label="unit_title" aria-describedby="title" value="<?php echo e($unit->unit_title); ?>"/>
						<?php else: ?>
						<input type="text" class="form-control" id="unit_title" name="unit_title" aria-label="unit_title" aria-describedby="title"/>	
						<?php endif; ?>
						<label style="color:white; font-size:1.25rem;" for="unit_description">Lernziel/Beschreibung der Unterichtseinheit:</label>
						<textarea class="form-control" id="unit_description" name="unit_description" aria-label="unit_description" aria-describedby="unit_description"><?php if(isset($unit->id)): ?><?php echo e($unit->unit_description); ?><?php endif; ?></textarea>
						<button class="badge border-primary bg-primary p-2 my-3" type="submit">Lerneinheit speichern</button>
					
					</div>
				</form>
			</div>

	</div>
</div>	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/add_block.js')); ?>"></script>
<script src="<?php echo e(asset('js/ddd_subject_topic.js')); ?>"></script>
		
<?php $__env->stopSection(); ?>	
<?php echo $__env->make('layout_teacher', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/oldstuff/toolbox_create_alt.blade.php ENDPATH**/ ?>