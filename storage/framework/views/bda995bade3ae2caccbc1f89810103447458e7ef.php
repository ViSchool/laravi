<?php $__env->startSection('stylesheets'); ?>
<script src="/js/showInputs.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h2>Neue Aufgabe für die Unterrichtseinheit <a href="/backend/units/<?php echo e($unit->id); ?>">"<?php echo e($unit->unit_title); ?>"</a> anlegen</h2>
          <hr></hr>

<div class="container">
	<?php echo $__env->make('layouts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<form method="POST" action="/backend/units/<?php echo e($unit->id); ?>" enctype="multipart/form-data">
	<?php echo e(csrf_field()); ?>

	<div class="input-group mb-3">
		<div class="input-group-prepend">
			<label class="input-group-text">Überschrift für die Aufgabe</label>
		</div>
		<input class="form-control" type="text" id="titleInput" name="title"/>
	</div>
	
	<div class="form-group">
		<label class="mb-0">Aufgabentext:</label>
		<textarea class="form-control mb-3 task-summernote" rows="8" id="task" name="task" aria-label="task" aria-describedby="task"></textarea>
		<input type="hidden" name="unit_id" value="<?php echo e($unit->id); ?>">
	</div>
	
	<div class="input-group mb-3">
		<div class="input-group-prepend">
	<label class="input-group-text"for="time">Zeit für die Aufgabe</label>
		</div>
		<input class="form-control" type="text" maxlength="2" id="time" name="time"></input>
		<div class="input-group-append">
			<span class="input-group-text">Minuten</span>
		</div>
	</div>
	<hr></hr>
	
	<h6 class="mb-1">Inhalte für diese Aufgabe festlegen</h6>
	<p class="mb-4"><small>Es können maximal drei verschiedene Lernniveaus (z.B. leicht, mittel, schwer) gewählt werden. Sofern keine Differenzierung der Inhalte für diese Aufgabe benötigt wird, reicht es den Inhalt für das erste Lernniveau festzulegen. 
	Sollte eine Differenzierung erfolgen, müssen auch die Namen für diese Differnezierung festgelegt werden. Der Standard ist mit den Begriffen "Einsteiger","Fortgeschritten" und "Superheld" festgelegt und wird gewählt, wenn keine eigenen Namen eingetragen werden.</small></p>
	
		<label class="mb-3">Erstes Lernniveau festlegen</label>
		<div class="form-group mb-3">
			<label class="mb-0">Name für das erste Lernniveau</label>
			<input type="text" placeholder="Einsteiger" id="differenzierung1" name="differenzierung1"/>
			<label class="mb-0">Inhalt aussuchen</label>
			<select class="form-control">
				<?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option id="content1_id" name="content1_id" value="<?php echo e($content->id); ?>"><?php echo e($content->type->content_type); ?>: <?php echo e($content->content_title); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>
	
	<div class="form-group mb-3">
		<label class="mb-0">Inhalt für zweites Lernniveau aussuchen</label>
		<select class="form-control">
			<?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<option id="content2_id" name="content2_id" value="<?php echo e($content->id); ?>"><?php echo e($content->type->content_type); ?>: <?php echo e($content->content_title); ?></option>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</select>
	</div>
	
	<div class="form-group mb-3">
		<label class="mb-0">Inhalt für drittes Lernniveau aussuchen</label>
		<select class="form-control">
			<option>keinen weiteren Inhalt hinzufügen</option>
			<?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<option id="content3_id" name="content3_id" value="<?php echo e($content->id); ?>"><?php echo e($content->type->content_type); ?>: <?php echo e($content->content_title); ?></option>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</select>
	</div>
	
	<button class="btn btn-primary form-control" type="submit">Neue Aufgabe speichern</button>
</form>
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
      $('.specialcontent-summernote').summernote({
        height: 130,
        toolbar: [
		['style', ['bold', 'italic', 'underline', 'clear']],
		['fontsize', ['fontsize']],
		['color', ['color']],
		['para', ['ul', 'ol', 'paragraph']],
		],
      });
</script>

<script src="<?php echo e(asset('js/ddd_subject_topic.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.vischool_backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>