<?php $__env->startSection('stylesheets'); ?>
<script src="/js/showInputs.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h2>Aufgabe für die Lerneinheit <a href="/backend/units/<?php echo e($unit->id); ?>">"<?php echo e($unit->unit_title); ?>"</a> anlegen</h2>
          <h5>Schritt 2 von 4 - Digitale Inhalte.   und Aufgaben</h5>

<div class="container">
	<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="row pt-3">
		<div class="col-9 pt-1">
			<h5><?php echo e($block->title); ?></h5>
		</div>
		<div class="col-3">
			<p> <i class="far fa-clock"></i> <?php echo e($block->time); ?> Min</p>
		</div>
	</div>


	<form method="POST" action="/backend/blocks/<?php echo e($block->id); ?>/contents" enctype="multipart/form-data">
		<?php echo e(csrf_field()); ?> <?php echo e(method_field('PATCH')); ?>

		<hr></hr>
	
		<div class="my-3">
			<h6 class="m-0 p-0">Hier kannst Du die Inhalte für die Aufgabe festlegen:</h6>
			<small>Du kannst einen Aufgabentext, einen digitalen Inhalt oder beides auswählen.</small>
		</div>
		<div id="content" class="form-group mb-3">
			<div id="task" class="form-group mb-3">
			<label>Aufgabentext</label> <small>(optional, aber empfohlen)</small>
			<textarea id="textarea_task" name="task" class="task-summernote"><?php echo $block->task; ?></textarea>
			</div>
			
		<label>Digitalen Inhalt aus der Datenbank auswählen:</label>
		<select id="content_id" name="content_id" class="form-control">
			<?php if(isset($block->content_id)): ?>
			<?php $content = App\Content::find($block->content_id) ?>
			<option value="<?php echo e($content->id); ?>"><?php echo e($content->type->content_type); ?>: <?php echo e($content->content_title); ?></option>
			<?php endif; ?>
			<?php if(empty($block->content_id)): ?>
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
		<button class="btn btn-primary my-5" type="submit">Weiter zu Schritt 3</button>
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
$('#specialcontent1').on('shown.bs.collapse', function () {
  $('#content1').collapse('hide');
})
$('#content1').on('shown.bs.collapse', function () {
	$('#specialcontent1').collapse('hide');
})
$('#specialcontent2').on('shown.bs.collapse', function () {
  $('#content2').collapse('hide');
})
$('#content2').on('shown.bs.collapse', function () {
	$('#specialcontent2').collapse('hide');
})
$('#specialcontent3').on('shown.bs.collapse', function () {
  $('#content3').collapse('hide');
})
$('#content3').on('shown.bs.collapse', function () {
	$('#specialcontent3').collapse('hide');
})
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
<script src="<?php echo e(asset('js/ddd_topic_content.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/create_blocks_step2.blade.php ENDPATH**/ ?>