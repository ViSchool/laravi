<?php $__env->startSection('main'); ?>
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
	<h2>Neue Testfrage anlegen für:</h2>
	<h4> <?php echo e($content->type->content_type); ?>: "<?php echo e($content->content_title); ?>"</h4>
          <hr></hr>

<div class="container">	
	<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<form method="POST" action="/backend/questions" enctype="multipart/form-data">
	<?php echo e(csrf_field()); ?>

	<div class="form-group">
		<label for="question">Testfrage:</label>
		<textarea class="form-control mb-3" id="question" name="question"><?php echo e(old('question')); ?></textarea>
	</div>
	<hr></hr>
	<input type="hidden" value="<?php echo e($content->id); ?>" name="content_id" id="content_id"/>
		
	<!-- Antwort 1 -->
	<div class="input-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text">Antwort 1 eingeben:</span>
		</div>
		<input type="text" class="form-control" name="answer1" id="answer1" value="<?php echo e(old('answer1')); ?>">
	</div>
	<div class="form-group">
		<div class="input-group mb-5">
			<div class="input-group-prepend">
				<label class="input-group-text" for="answer1">Antwort 1 ist: </label>
			</div>
			<select class="custom-select" id="solution1" name="solution1">
				<option value="" selected>Bitte auswählen...</option>
				<option value="1">Richtig</option>
				<option value="0">Falsch</option>
			</select>
		</div>
	</div>

	<!-- Antwort 2 -->
	<div class="input-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text">Antwort 2 eingeben:</span>
		</div>
		<input type="text" class="form-control" name="answer2" id="answer2" value="<?php echo e(old('answer2')); ?>"/>
	</div>
	<div class="form-group">
		<div class="input-group mb-5">
			<div class="input-group-prepend">
				<label class="input-group-text" for="answer2">Antwort 2 ist: </label>
			</div>
			<select class="custom-select" id="solution2" name="solution2">
				<option value="" selected>Bitte auswählen...</option>
				<option value="1">Richtig</option>
				<option value="0">Falsch</option>
			</select>
		</div>
	</div>

	<!-- Antwort 3 -->
	<div class="input-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text">Antwort 3 eingeben:</span>
		</div>
		<input type="text" class="form-control" name="answer3" id="answer3" value="<?php echo e(old('answer3')); ?>"/>
	</div>
	<div class="form-group">
		<div class="input-group mb-5">
			<div class="input-group-prepend">
				<label class="input-group-text" for="answer3">Antwort 3 ist: </label>
			</div>
			<select class="custom-select" id="solution3" name="solution3">
				<option value="" selected>Bitte auswählen...</option>
				<option value="1">Richtig</option>
				<option value="0">Falsch</option>
			</select>
		</div>
	</div>
	
	<!-- Antwort 4 -->
	<div class="input-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text">Antwort 4 eingeben:</span>
		</div>
		<input type="text" class="form-control" name="answer4" id="answer4" value="<?php echo e(old('answer4')); ?>"/>
	</div>
	<div class="form-group">
		<div class="input-group mb-5">
			<div class="input-group-prepend">
				<label class="input-group-text" for="answer4">Antwort 4 ist: </label>
			</div>
			<select class="custom-select" id="solution4" name="solution4">
				<option value="" selected>Bitte auswählen...</option>
				<option value="1">Richtig</option>
				<option value="0">Falsch</option>
			</select>
		</div>
	</div>
		
	<!-- Antwort 5 -->
	<div class="input-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text">Antwort 5 eingeben:</span>
		</div>
		<input type="text" class="form-control" name="answer5" id="answer5" value="<?php echo e(old('answer5')); ?>"/>
	</div>
	<div class="form-group">
		<div class="input-group mb-5">
			<div class="input-group-prepend">
				<label class="input-group-text" for="answer5">Antwort 5 ist: </label>
			</div>
			<select class="custom-select" id="solution5" name="solution5">
				<option value="" selected>Bitte auswählen...</option>
				<option value="1">Richtig</option>
				<option value="0">Falsch</option>
			</select>
		</div>
	</div>

	
		<div class="form-group">
			<button type="submit" class="form-control btn btn-primary">Testfrage speichern</button> 
		</div>
	</form>	
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/create_questions.blade.php ENDPATH**/ ?>