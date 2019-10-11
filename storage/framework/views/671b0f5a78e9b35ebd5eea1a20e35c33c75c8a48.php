<?php $__env->startSection('stylesheets'); ?>
<script src="/js/showInputs.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
    <main role="main" class="col-sm-9 ml-sm-auto col-lg-10 pt-3">
          <h2></h2>
          <hr>

<div class="container">
	<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	<div class="card m-3">
		<div class="card-header bg-warning">
			<h5>Aufgabe für die Unterrichtseinheit "<?php echo e($unit->unit_title); ?>" anlegen</h5>
		</div>
		<div>
			<form class="my-3" method="POST" action="/backend/blocks" enctype="multipart/form-data">
				<?php echo e(csrf_field()); ?>

				
				<div class="form-group">
					<label for="title" class="col-md-6 control-label">Überschrift für die Aufgabe:</label>
					<div class="col-lg-10">
						<input id="title" type="text" class="form-control <?php echo e($errors->has('title') ? 'is-invalid' : ''); ?>" name="title" value="<?php echo e(old('title')); ?>" required autofocus>
						<?php if($errors->has('title')): ?>
							<span class="help-block">
								<strong class="text-danger"><?php echo e($errors->first('title')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>

			
				<div class="form-group">
					<label for="task" class="col-md-6 control-label">Aufgabentext:</label>
					<div class="col-lg-10">
						<textarea class="form-control mb-3 task-summernote" rows="8" id="task" name="task" aria-label="task" aria-describedby="task" autofocus><?php echo e(old('task')); ?></textarea>
						<input type="hidden" name="unit_id" value="<?php echo e($unit->id); ?>">
						<?php if($errors->has('task')): ?>
							<span class="help-block">
								<strong class="text-danger"><?php echo e($errors->first('task')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group">
					<label for="content_id" class="col-md-6 control-label">Digitalen Inhalt aus der Datenbank auswählen:</label>
					<div class="col-lg-10">
					<select id="content_id" name="content_id" class="form-control" autofocus>
						<option value="">Bitte auswählen</option>
						<?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($content->id); ?>"><?php echo e($content->type->content_type); ?>: <?php echo e($content->content_title); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<option value="diftopic">Inhalt aus einem anderen Fach auswählen</option>
					</select>
					</div>
				</div>


				<div class="form-group">
					<div id="choosetopic" class="d-none">
						<label class="col-md-6 control-label" for="topi_id_dif">Inhalte aus anderen Fächern</label>
						<div class="col-lg-10">
						<select id="topic_id_dif" name="topic_id_dif" class="form-control mb-3" autofocus>
							<option value="">Bitte anderes Thema auswählen</option>
							<?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($topic->id); ?>"><?php echo e($topic->topic_title); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</select>
						<select id="content_id_dif" name="content_id_dif" class="form-control" autofocus>
							<option value="">Zuerst Thema auswählen</option>
						</select>
						</div>
					</div>
				</div>
			
				<div class="col-lg-10">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<label class="input-group-text"for="time">Zeit für die Aufgabe:</label>
						</div>
						<input class="form-control" type="text" maxlength="2" id="time" name="time" value="<?php echo e(old('time')); ?>">
						<div class="input-group-append">
							<span class="input-group-text">Minuten</span>
						</div>
						<?php if($errors->has('time')): ?>
							<span class="help-block">
								<strong class="text-danger"><?php echo e($errors->first('time')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group">
					<label for="task" class="col-md-6 control-label">Tipp (optional):</label>
					<div class="col-lg-10">
						<textarea class="form-control mb-3" rows="3" id="tipp" name="tipp" aria-label="tipp" aria-describedby="tipp" autofocus><?php echo e(old('tipp')); ?></textarea>
						<?php if($errors->has('tipp')): ?>
							<span class="help-block">
								<strong class="text-danger"><?php echo e($errors->first('tipp')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>

				<?php if($unit->differentiation_group !== Null): ?>
               <div class="form-group<?php echo e($errors->has('differentiation_id') ? ' has-error' : ''); ?>">
                  <label for="differentiation_id" class="col-10 control-label">Differenzierung von Lernniveaus</label>
                  <label for="differentiation_id" class="col-10 col-form-label mt-0 pt-0">
                     <small class="text-muted">Die Aufgabe kann für unterschiedliche Lernniveaus der Gruppe <span class="font-weight-bold">"<?php echo e($unit->differentiation_group); ?>"</span> differenziert werden. Wähle hier das entsprechende Niveau aus oder wähle "Alle", wenn keine Differenzierung erfolgen soll.</small>
                  </label>
                  <div class="col-10">
                     <select class="form-control" id="differentiation_id" name="differentiation_id">
				            <?php if((old('differentiation_id')) !== null): ?>
                        	<?php 
                              $differentiation_id_old = old('differentiation_id');
                              $differentiation_old = App\Differentiation::where('id', '=' , $differentiation_id_old)->first();
                           ?>
                           <option value="<?php echo e($differentiation_id_old); ?>"><?php echo e($differentiation_old->differentiation_title); ?></option>
				            <?php endif; ?>
		                  <?php if(empty(old('differentiation_id'))): ?>
                           <option value="">Bitte auswählen</option>
                        <?php endif; ?>
                           <?php $__currentLoopData = $differentiations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $differentiation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($differentiation->id); ?>"><?php echo e($differentiation->differentiation_title); ?></option>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <option value="13">Alle</option>
                     </select>
                     <?php if($errors->has('differentiation_id')): ?>
                        <span class="help-block">
                           <strong><?php echo e($errors->first('differentiation_id')); ?></strong>
                        </span>
                     <?php endif; ?>
                  </div>
               </div>
            <?php endif; ?>


				<div class="col-lg-10">
					<button class="btn btn-primary form-control" type="submit">Neue Aufgabe speichern</button>
				</div>
			</form>
		</div>
	</div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
	$(document).ready(function() {
	$('.task-summernote').summernote({
		toolbar: [
		['style', ['bold', 'italic', 'underline', 'clear']],
		['fontsize', ['fontsize']],
		['color', ['color']],
		['para', ['ul', 'ol', 'paragraph']],
		]
	});
	});
</script>

<script>
$(document).ready(function() {
$('#content_id').change(function() {
 if ($(this).val() == 'diftopic') {
     var topic = document.getElementById('choosetopic');
     topic.classList.add('d-block');
     topic.classList.remove('d-none');
  }
});
});
</script>

<script src="<?php echo e(asset('js/ddd_subject_topic.js')); ?>"></script>
<script src="<?php echo e(asset('js/ddd_topic_content.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/create_blocks.blade.php ENDPATH**/ ?>