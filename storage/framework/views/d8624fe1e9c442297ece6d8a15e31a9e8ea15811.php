<?php $__env->startSection('stylesheets'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<?php $__env->stopSection(); ?>


<div class="col-3 p-0 m-0 border d-sm-none d-none d-md-block" id="toolbox">
	<div class="container-fluid">
		<h3 class="mt-2 text-center text-white">Toolbox-Werkzeuge</h3>
		
		<ul class="nav nav-tabs nav-justified" style="font-size:1.125rem;">
    		<li class="nav-item">
				<a class="nav-link active px-0 mx-0" id="nav-lerneinheit-tab" data-toggle="tab" href="#nav-lerneinheit" role="tab" aria-controls="nav-lerneinheit" aria-selected="true">Lerneinheit</a>
			</li>
			<li class="nav-item">
				<a class="nav-link px-0 mx-0" id="nav-aufgabe-tab" data-toggle="tab" href="#nav-aufgabe" role="tab" aria-controls="nav-aufgabe" aria-selected="false">Aufgaben</a>
			</li>
			<li class="nav-item">
				<a class="nav-link px-0 mx-0" id="nav-inhalt-tab" data-toggle="tab" href="#nav-inhalt" role="tab" aria-controls="nav-inhalt" aria-selected="false">Inhalte</a>
			</li>
		</ul>
			
		<div class="tab-content" id="nav-tabContent">
			<!-- Tab Lerneinheit -->
			<div class="tab-pane fade show active" id="nav-lerneinheit" role="tabpanel" aria-labelledby="nav-lerneinheit-tab">	
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
					
			<!-- Tab Aufgaben -->
			<div class="tab-pane fade d-flex " id="nav-aufgabe" role="tabpanel" aria-labelledby="nav-aufgabe-tab">
				<div class="m-3  flex-row justify-content-start">
				</div>
				<?php if(isset($unit->id)): ?>
				<form method="POST" action="<?php echo e(route('blocks.store')); ?>" enctype="multipart/form-data">
				<?php echo e(csrf_field()); ?>

					<div class="form-group mt-3">
						<label style="color:white; font-size:1.25rem;" for="subject_id">Titel der Aufgabe:</label>
						<?php if(isset($block->id)): ?>
						<input type="text" class="form-control" id="title" name="title" aria-label="title" aria-describedby="title" value="<?php echo e($block->title); ?>"/>
						<?php else: ?>
						<input type="text" class="form-control" id="title" name="title" aria-label="title" aria-describedby="title"/>	
						<?php endif; ?>
											
						<label for="task" style="color:white; font-size:1.25rem;">Aufgabentext:</label>
						<textarea class="form-control mb-3" rows="8" id="summernote" name="task" aria-label="task" aria-describedby="task">
						<?php if(isset($block->id)): ?> 
						<?php echo e($block->task); ?>

						<?php endif; ?>
						</textarea>
						
						<div class="form-inline form-group my-2">
							<label style="color:white; font-size:1.25rem;" class="mx-1" for="differentiation">Anzahl unterschiedlicher Lernniveaus:</label>
							<select class="form-control" id="differnetiation" name="differentiation">
								<option>1</option>
								<option>2</option>
								<option>3</option>
							</select>
						</div>
						<?php if(isset($unit->id)): ?> 
						<input name="unit_id" type="number" hidden value="<?php echo e($unit->id); ?>">
						<?php endif; ?>	
	  					<button class="badge border-primary bg-primary p-2 my-3" type="submit">Aufgabe speichern</button>
					</div>
				</form>
				<?php endif; ?>
			</div>
		
			<!-- Tab Inhalte -->
			<div class="tab-pane fade" id="nav-inhalt" role="tabpanel" aria-labelledby="nav-inhalt-tab">
			</div>
		</div>
	</div>
</div> <!-- close col for toolbox -->

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/ddd_subject_topic.js')); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
	$(document).ready(function() {
        $('#summernote').summernote({
  toolbar: [
    // [groupName, [list of button]]
  ]});
});
</script>
<?php $__env->stopSection(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/components/toolbox_tools.blade.php ENDPATH**/ ?>