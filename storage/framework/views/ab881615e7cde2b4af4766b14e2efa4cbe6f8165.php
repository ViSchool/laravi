<?php $__env->startSection('main'); ?>
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
	<h2>Testfrage ändern für:</h2>
	<h4> <?php echo e($question->content->type->content_type); ?>: "<?php echo e($question->content->content_title); ?>"</h4>
          <hr></hr>

<div class="container">	
	<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<form method="POST" action="/backend/questions/<?php echo e($question->id); ?>" enctype="multipart/form-data">
	<?php echo e(csrf_field()); ?> <?php echo e(method_field('PATCH')); ?>

	<div class="form-group">
		<label for="question">Testfrage:</label>
		<textarea class="form-control mb-3" id="question" name="question"><?php echo e($question->question); ?></textarea>
	</div>
	<hr></hr>
	<input type="hidden" value="<?php echo e($question->content->id); ?>" name="content_id" id="content_id"/>
		
	<!-- Antwort 1 -->
	<div class="input-group input-group">
		<div class="input-group-prepend">
			<span class="input-group-text">Antwort 1 eingeben:</span>
		</div>
		<input type="text" class="form-control" name="answer1" id="answer1" value="<?php echo e($question->answer1); ?>">
	</div>
	<div class="form-group">
		<div class="input-group mb-5">
			<div class="input-group-prepend">
				<label class="input-group-text" for="answer1">Antwort 1 ist: </label>
			</div>
			<select class="custom-select" id="solution1" name="solution1">
				<option value="<?php echo e($question->solution1); ?>" selected>
					<?php if($question->solution1 == 1): ?>
						Richtig
					<?php else: ?> 
						Falsch
					<?php endif; ?>
				</option>
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
		<input type="text" class="form-control" name="answer2" id="answer2" value="<?php echo e($question->answer2); ?>"/>
	</div>
	<div class="form-group">
		<div class="input-group mb-5">
			<div class="input-group-prepend">
				<label class="input-group-text" for="answer2">Antwort 2 ist: </label>
			</div>
			<select class="custom-select" id="solution2" name="solution2">
				<option value="<?php echo e($question->solution2); ?>" selected>
					<?php if($question->solution2 == 1): ?>
						Richtig
					<?php else: ?> 
						Falsch
					<?php endif; ?>
				</option>
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
		<input type="text" class="form-control" name="answer3" id="answer3" value="<?php echo e($question->answer3); ?>"/>
	</div>
	<div class="form-group">
		<div class="input-group mb-5">
			<div class="input-group-prepend">
				<label class="input-group-text" for="answer3">Antwort 3 ist: </label>
			</div>
			<select class="custom-select" id="solution3" name="solution3">
				<?php if(empty($question->solution3)): ?>
				<option selected value="">Bitte auswählen... </option>
				<?php endif; ?>
				<?php if(isset($question->solution3)): ?>
				<option value="<?php echo e($question->solution3); ?>" selected>
					<?php if($question->solution3 == 1): ?>
						Richtig
					<?php else: ?>
						Falsch
					<?php endif; ?>
				</option>
				<?php endif; ?>
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
		<input type="text" class="form-control" name="answer4" id="answer4" value="<?php echo e($question->answer4); ?>"/>
	</div>
	<div class="form-group">
		<div class="input-group mb-5">
			<div class="input-group-prepend">
				<label class="input-group-text" for="answer4">Antwort 4 ist: </label>
			</div>
			<select class="custom-select" id="solution4" name="solution4">
				<?php if(empty($question->solution4)): ?>
				<option selected value="">Bitte auswählen... </option>
				<?php endif; ?>
				<?php if(isset($question->solution4)): ?>
				<option value="<?php echo e($question->solution4); ?>" selected>
					<?php if($question->solution4 == 1): ?>
						Richtig
					<?php else: ?>
						Falsch
					<?php endif; ?>
				</option>
				<?php endif; ?>
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
		<input type="text" class="form-control" name="answer5" id="answer5" value="<?php echo e($question->answer5); ?>"/>
	</div>
	<div class="form-group">
		<div class="input-group mb-5">
			<div class="input-group-prepend">
				<label class="input-group-text" for="answer5">Antwort 5 ist: </label>
			</div>
			<select class="custom-select" id="solution5" name="solution5">
				<?php if(empty($question->solution5)): ?>
				<option selected value="">Bitte auswählen... </option>
				<?php endif; ?>
				<?php if(isset($question->solution5)): ?>
				<option value="<?php echo e($question->solution5); ?>" selected>
					<?php if($question->solution5 == 1): ?>
						Richtig
					<?php else: ?>
						Falsch
					<?php endif; ?>
				</option>
				<?php endif; ?>
				
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
<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/show_questions.blade.php ENDPATH**/ ?>