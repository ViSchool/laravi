<?php $__env->startSection('stylesheets'); ?>
<script src="/js/showInputs.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h2>Aufgabe für die Lerneinheit <a href="/backend/units/<?php echo e($unit->id); ?>">"<?php echo e($unit->unit_title); ?>"</a> anlegen</h2>
          <h5>Schritt 3 von 4 - Unterschiedliche Lernniveaus</h5>

<div class="container">
	<?php echo $__env->make('layouts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<div class="row pt-3">
		<div class="col-9 pt-1">
			<h5><?php echo e($block->title); ?></h5>
		</div>
		<div class="col-3">
			<p> <i class="far fa-clock"></i> <?php echo e($block->time); ?> Min</p>
		</div>
	</div>


	<form method="POST" action="/backend/blocks/<?php echo e($block->id); ?>/differentiation" enctype="multipart/form-data">
		<?php echo e(csrf_field()); ?> <?php echo e(method_field('PATCH')); ?>

		<hr></hr>
	
		<div class="my-3">
			<p class="m-0 p-0">In manchen Fällen, ist es erforderlich, die gleiche Aufgabe für verschieden lernstarke Schüler anzulegen. Hier kannst Du bis zu drei verschiedene Lernniveaus für die Aufgabe anlegen. </p>
		</div>
		
		<a class="btn btn-sm btn-primary" data-toggle="collapse" href="#collapse_content2" role="button" aria-expanded="false" aria-controls="collapseExample">Weiteres Lernniveau hinzufügen</a>
		
		<a class="btn btn-sm btn-primary" href="/backend/blocks/create4/<?php echo e($block->id); ?>">Weiter ohne Differenzierung</a>
		<div class="collapse" id="collapse_content2">
		<hr></hr>
	
			<div class="my-3">
				<h6 class="m-0 p-0">Hier kannst Du die Inhalte und Aufgabentexte für das zweite Lernniveau festlegen:</h6>
				<small>Wie bei dem Standardlernniveau kannst Du einen Aufgabentext, einen digitalen Inhalt oder beides auswählen.</small>
			</div>
			<div id="content2" class="form-group mb-3">
				<div id="task2" class="form-group mb-3">
					<label>Aufgabentext</label>
					<textarea id="textarea_task2" name="task2" class="task-summernote"><?php echo $block->task2; ?></textarea>
				</div>
			
				<label>Digitalen Inhalt aus der Datenbank auswählen</label>
				<select id="contentid2" name="content_id2" class="form-control">
				<?php if(isset($block->content_id2)): ?>
					<?php $content2 = App\Content::find($block->content_id2) ?>
					<option value="<?php echo e($content2->id); ?>"><?php echo e($content2->type->content_type); ?>: <?php echo e($content2->content_title); ?></option>
				<?php endif; ?>
				<?php if(empty($block->content_id2)): ?>
					<option value="">Bitte auswählen</option>
				<?php endif; ?>
				<?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($content->id); ?>"><?php echo e($content->type->content_type); ?>: <?php echo e($content->content_title); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<option value="diftopic">Inhalt aus einem anderen Fach auswählen</option>
				</select>
			</div>
			<div id="choosetopic" class="d-none">
				<select id="topic_id_dif" name="topic_id_dif" class="form-control mb-3 mt-5">
					<option value="">Bitte anderes Thema auswählen</option>
					<?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($topic->id); ?>"><?php echo e($topic->topic_title); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
				<select id="content_id_dif" name="content_id_dif" class="form-control">
					<option >Zuerst Thema auswählen</option>
				</select>
			</div>
			<div class="d-flex flex-row-reverse">
			<button class="btn btn-sm btn-primary my-5" type="submit">Speichern und weiter zu Schritt 4</button>
			</div>
		</div>
		
			
		</div>
	</form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
      $('.task-summernote').summernote({
        height: 130,
        toolbar: [
		['style', ['bold', 'italic', 'underline', 'clear']],
		['fontsize', ['fontsize']],
		['color', ['color']],
		['para', ['ul', 'ol', 'paragraph']]
		['link'],
		],
      });
</script>
<script>
$(document).ready(function() {
$('#contentid2').change(function() {
 if ($(this).val() == 'diftopic') {
     var topic = document.getElementById('choosetopic');
     topic.classList.add('d-block');
     topic.classList.remove('d-none');
  }
});
});
</script>
<script src="<?php echo e(asset('js/ddd_topic_content.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout_backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>