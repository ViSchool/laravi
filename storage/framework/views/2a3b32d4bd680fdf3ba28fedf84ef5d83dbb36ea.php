<?php $__env->startSection('main'); ?>
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h2>Testfragen administrieren für: </h2>
          <h4> <?php echo e($content->type->content_type); ?>: "<?php echo e($content->content_title); ?>"</h4> 

<div class="container">
	<p>Hier sind alle Testfragen hinterlegt, die zu einem Inhalt angezeigt werden können</p>
	<?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<div class="row mb-3">
		<div class="card mb-3">
			<div class="card-header d-flex justify-content-between">
				<div class="mr-3">
					<?php echo e($question->question); ?>

				</div>
				<a href="/backend/questions/show/<?php echo e($question->id); ?>"><i class="fas fa-pencil-alt"></i></a>
			</div> 
			<ul class="list-group list-group-flush">
				<li class="list-group-item">
					<div class="d-flex justify-content-between">
						<?php if(isset($question->answer1)): ?>
							<div class="mr-2"><?php echo e($question->answer1); ?></div>
							<?php if($question->solution1 === 1): ?>
								<i class="fas fa-check" style="color: green;"></i>
							<?php else: ?>
								<i class="fas fa-times" style="color: red;"></i>
							<?php endif; ?>
						<?php endif; ?>
						<?php if(empty($question->answer1)): ?>
							<div class="text-muted">Antwort 1 ist leer</div>
						<?php endif; ?>
					</div>	
				</li>
				<li class="list-group-item">
					<div class="d-flex justify-content-between">
						<?php if(isset($question->answer2)): ?>
							<div class="mr-2"><?php echo e($question->answer2); ?></div>
							<?php if($question->solution2 === 1): ?>
								<i class="fas fa-check" style="color: green;"></i>
							<?php else: ?>
								<i class="fas fa-times" style="color: red;"></i>
							<?php endif; ?>
						<?php endif; ?>
						<?php if(empty($question->answer2)): ?>
							<div class="text-muted">Antwort 2 ist leer</div>
						<?php endif; ?>	
					</div>
				</li>
				<li class="list-group-item">
					<div class="d-flex justify-content-between">
						<?php if(isset($question->answer3)): ?>
							<div class="mr-2"><?php echo e($question->answer3); ?></div>
							<?php if($question->solution3 === 1): ?>
								<i class="fas fa-check" style="color: green;"></i>
							<?php else: ?>
								<i class="fas fa-times" style="color: red;"></i>
							<?php endif; ?>
						<?php endif; ?>
						<?php if(empty($question->answer3)): ?>
							<div class="text-muted">Antwort 3 ist leer</div>
						<?php endif; ?>
					</div>	
				</li>
				<li class="list-group-item">
					<div class="d-flex justify-content-between">
						<?php if(isset($question->answer4)): ?>
						<div class="mr-2"><?php echo e($question->answer4); ?></div>
						<?php if($question->solution4 === 1): ?>
							<i class="fas fa-check" style="color: green;"></i>
						<?php else: ?>
							<i class="fas fa-times" style="color: red;"></i>
						<?php endif; ?>
						<?php endif; ?>
						<?php if(empty($question->answer4)): ?>
							<div class="text-muted">Antwort 4 ist leer</div>
						<?php endif; ?>
					</div>
				</li>
				<li class="list-group-item">
					<div class="d-flex justify-content-between">
						<?php if(isset($question->answer5)): ?>
							<div class="mr-2"><?php echo e($question->answer5); ?></div>
							<?php if($question->solution5 === 1): ?>
								<i class="fas fa-check" style="color: green;"></i>
							<?php else: ?>
								<i class="fas fa-times" style="color: red;"></i>
						<?php endif; ?>
						<?php endif; ?>
						<?php if(empty($question->answer5)): ?>
							<div class="text-muted">Antwort 5 ist leer</div>
						<?php endif; ?>
					</div>
				</li>
			</ul>
			<div class="card-footer d-flex justify-content-between align-items-center">
				<form method="POST" action="<?php echo e(route('questions.destroy',[$question->id])); ?>">
					<?php echo e(csrf_field()); ?> <?php echo e(method_field('DELETE')); ?>

					<span>Diese Testfrage löschen:</span>
					<button type="submit">Löschen</button>
				</form>
			</div>
		</div>
		</div>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<hr></hr>
		<a class="btn btn-primary mb-5" href="/backend/questions/create/<?php echo e($content->id); ?>">Neue Testfrage hinzufügen </a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>