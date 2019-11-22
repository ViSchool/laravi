<?php $__env->startSection('stylesheets'); ?>
<script src="/js/showInputs.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h2>Aufgabe für die Lerneinheit <a href="/backend/units/<?php echo e($unit->id); ?>">"<?php echo e($unit->unit_title); ?>"</a> anlegen</h2>
          <h5>Schritt 4 von 4 - Zusätzliche Inhalte/Tips</h5>

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


	<form method="POST" action="/backend/blocks/<?php echo e($block->id); ?>/tipp" enctype="multipart/form-data">
		<?php echo e(csrf_field()); ?> <?php echo e(method_field('PATCH')); ?>

		<hr></hr>
	
		<div class="my-3">
			<p class="m-0 p-0">Wenn Du den Schülern zusätzliche Materialien oder Tipps mitgeben möchtest, kannst Du dass hier tun. </p>
		</div>
		<div class="d-flex flex-row-reverse mb-3">
	<a class="btn btn-sm btn-primary" href="/backend/units/<?php echo e($unit->id); ?>">Weiter ohne Tipps</a>
		</div>
			<div id="tipp" class="form-group mb-3">
				<label>Text für den Tipp</label> <small>(optional)</small>
				<textarea id="textarea_tipp" name="tipp" class="task-summernote"></textarea>
			</div>
		</div>
		<div class="d-flex flex-row-reverse">
		<button class="btn btn-primary my-5" type="submit">Tipp speichern und zurück zur Lerneinheit</button>
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
		['para', ['ul', 'ol', 'paragraph']],
		['link', ['linkDialogShow','unlink']],
		],
      });
</script>
<script src="<?php echo e(asset('js/ddd_topic_content.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/create_blocks_step4.blade.php ENDPATH**/ ?>