<?php $__env->startSection('stylesheets'); ?>
<script src="/js/showInputs.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
	<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
		<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>		
		<div class="card m-3">
			<div class="card-header bg-warning">
				<h5>Aufgabe "<?php echo e($block->title); ?>" bearbeiten</h5>
			</div>	 
			<form class="my-3" method="POST" action="<?php echo e(route('backend.blocks.update',[$block->id])); ?>" enctype="multipart/form-data">
				<?php echo e(csrf_field()); ?> <?php echo e(method_field('PATCH')); ?>

				
				<input type="hidden" name="unit_id" value="<?php echo e($block->unit_id); ?>">

				<div class="form-group">
					<label for="title" class="col-md-6 col-form-label">Überschrift für die Aufgabe:</label>
					<div class="col-lg-10">
						<input id="title" type="text" class="form-control <?php echo e($errors->has('title') ? 'is-invalid' : ''); ?>" name="title" value="<?php echo e($block->title); ?>" required autofocus>
						<?php if($errors->has('title')): ?>
							<span class="help-block">
								<strong class="text-danger"><?php echo e($errors->first('title')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group">
					<label for="task" class="col-md-6 col-form-label">Aufgabentext:</label>
					<div class="col-lg-10">
					<textarea class="form-control mb-3 task-summernote" rows="8" id="task" name="task" aria-label="task" aria-describedby="task" autofocus><?php echo $block->task; ?></textarea>
						<?php if($errors->has('task')): ?>
							<span class="help-block">
								<strong class="text-danger"><?php echo e($errors->first('task')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>

				<div class="form-group">
					<label for="content_id" class="col-md-6 col-form-label">Digitalen Inhalt aus der Datenbank auswählen:</label>
					<div class="col-lg-10">
					<select id="content_id" name="content_id" class="form-control" autofocus>
						<?php if(isset($content->id)): ?>
							<option value="<?php echo e($content->id); ?>"><?php echo e($content->content_title); ?></option>
						<?php else: ?> 
							<option value="">Bitte auswählen</option>
						<?php endif; ?>
						<?php $__currentLoopData = $allContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allContent): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($allContent->id); ?>"><?php echo e($allContent->type->content_type); ?>: <?php echo e($allContent->content_title); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<option value="diftopic">Inhalt aus einem anderen Fach auswählen</option>
					</select>
					</div>
				</div>

				<div class="form-group">
					<div id="choosetopic" class="d-none">
						<label class="col-md-6 col-form-label" for="topi_id_dif">Inhalte aus anderen Fächern</label>
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
						<input class="form-control" type="text" maxlength="2" id="time" name="time" value="<?php echo e($block->time); ?>">
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
					<label for="task" class="col-md-6 col-form-label">Tipp (optional):</label>
					<div class="col-lg-10">
					<textarea class="form-control mb-3" rows="3" id="tipp" name="tipp" aria-label="tipp" aria-describedby="tipp" autofocus><?php echo $block->tips; ?></textarea>
						<?php if($errors->has('tipp')): ?>
							<span class="help-block">
								<strong class="text-danger"><?php echo e($errors->first('tipp')); ?></strong>
							</span>
						<?php endif; ?>
					</div>
				</div>

            <div class="form-group<?php echo e($errors->has('differentiation_id') ? ' invalid' : ''); ?>">
               <label for="differentiation_id" class="col-lg-10 col-form-label">Differenzierung von Lernniveaus</label>
               <label for="differentiation_id" class="col-lg-10 col-form-label mt-0 pt-0">
                  <small class="text-muted">Die Aufgabe kann für unterschiedliche Lernniveaus der Gruppe <span class="font-weight-bold">"<?php echo e($unit->differentiation_group); ?>"</span> differenziert werden. Wähle hier das entsprechende Niveau aus oder wähle "Alle", wenn keine Differenzierung erfolgen soll.</small>
					</label>
					<div class="col-lg-10 input-group">
						<div class="input-group-prepend">
    						<label class="input-group-text" for="differentiation_id">Lernniveau:</label>
  						</div>
						<select class="custom-select" id="differentiation_id" name="differentiation_id">
							<?php if($differentiation->id !== 13): ?>
								<option value="<?php echo e($differentiation->id); ?>"><?php echo e($differentiation->differentiation_title); ?></option>
								<option value="13">Keine Differenzierung für diese Aufgabe</option>
							<?php else: ?> 
								<option value="<?php echo e($differentiation->id); ?>"><?php echo e($differentiation->differentiation_title); ?></option>
								<?php $__currentLoopData = $otherDifferentiations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $otherDifferentiation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option value="<?php echo e($otherDifferentiation->id); ?>"><?php echo e($otherDifferentiation->differentiation_title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							<?php endif; ?>
						</select>
					</div>
				</div>
				
				<div class="col-lg-10">
					<button class="btn btn-primary form-control" type="submit">Änderungen in dieser Aufgabe speichern</button>
				</div>
			</form>	
		</div>
		<hr>

<div>
	<h4>Vorschau für diese Aufgabe</h4>
	
	
	<?php
		$numberOfBlocks= $unit->blocks->unique('order');
		$ordernumber = 0;
		foreach ($numberOfBlocks as $currentBlock) {
			if	($currentBlock->order !== $block->order) {
				$ordernumber++;
			} else {
				$ordernumber++;
			break;
			}
		}
	?>
	
	<div class="card my-1" style="border-color:#03c4eb">
		<!-- CardHeader -->
		<div class="card-header text-white" role="tab" style="background-image: url('/images/banner.jpg')">
			<div class="row mb-4">
				<div class="col-lg-10">
					Aufgabe <?php echo e($ordernumber); ?> von <?php echo e(count($numberOfBlocks)); ?>

				</div>
					</div>
					<div class="row mb-2">
						<div class="col-9">	
							<p id="title_<?php echo e($block->id); ?>" class="pt-4 pb-1 m-0"><?php echo e($block->title); ?>:</p>
						</div>
						<div class="col-3">
							<i class="pt-4 far fa-clock"></i>
							<span id="time_<?php echo e($block->id); ?>"> <?php echo e($block->time); ?></span> Minuten
						</div>
					</div>
				</div>
					
				<!-- CardBody -->					
				<div class="card-body">
						<div class="row">
							<div class="col-10 d-flex align-items-start flex-column mb-3">
								<div class="mb-auto">
									<?php if(isset ($block->task)): ?>
										<?php echo str_limit($block->task,100, ' (...)');; ?>

									<?php endif; ?>
								</div>
							</div>
							<div class="col-12 d-flex align-items-start flex-column mb-3">
								<div class="mb-auto">
									<?php if(isset($block->content_id)): ?>
										<?php $content = App\Content::findOrFail($block->content_id);?>
										<?php if(isset($content->content_img_thumb)): ?>
											<a href="/content/<?php echo e($content->id); ?>" target="_blank"><img src="/images/contents/<?php echo e($content->content_img); ?>" alt="Bild:<?php echo e($content->content_title); ?>"></img></a>
										<?php endif; ?> 
										<?php if(empty($content->content_img_thumb)): ?> 
											<?php switch($content->tool_id):
												case (1): ?>
													<a href="/content/<?php echo e($content->id); ?>" target="_blank"><img class="img-fluid p-4" src="https://img.youtube.com/vi/<?php echo e($content->toolspecific_id); ?>/mqdefault.jpg"></img></a>
												<?php break; ?>
												<?php case (7): ?>
													<a href="/content/<?php echo e($content->id); ?>" target="_blank"><img class="img-fluid p-2" src="<?php echo e($content->img_thumb_url); ?>"></img></a>
												<?php break; ?>
												<?php default: ?>
													<?php if(isset($content->portal->portal_img)): ?>
														<a href="/content/<?php echo e($content->id); ?>" target="_blank"><img src="/images/portals/<?php echo e($content->portal->portal_img); ?>"></img></a>
													<?php endif; ?>
													<?php if(empty($content->portal->portal_img)): ?>
														<a href="/content/<?php echo e($content->id); ?>"><p><i class="<?php echo e($content->type->type_icon); ?> fa-3x"> </i></p><p> <?php echo e($content->type->content_type); ?> "<?php echo e($content->content_title); ?>" öffnen </p></a>
													<?php endif; ?>
												<?php break; ?>
											<?php endswitch; ?>
										<?php endif; ?>		
									<?php endif; ?>
									<?php if(empty($block->content_id)): ?>
										<?php if(empty($block->task)): ?>
											<div class="container">
												<p>Hier fehlt ein Inhalt oder eine Aufgabe!</p>
											</div>
										<?php endif; ?>
									<?php endif; ?>
								</div>
							</div>
							<div class="col">
								<div class="mt-auto">
									<button type="button" class="btn mr-5 p-0" data-toggle="popover" title="Noch Fragen?" data-content="Tip_Text"><i class="fas fa-question-circle" style="color:orange"></i></button>
								</div>
							</div>
						</div>
					</div>	
			</div>
</div>

	
	<div class="pt-5 form-group">
		<form method="POST" action="<?php echo e(route('backend.blocks.destroy',[$block->id])); ?>">
			<?php echo e(csrf_field()); ?> <?php echo e(method_field('DELETE')); ?>

			<button class=" form-control btn btn-warning" type="submit"> Aufgabe komplett löschen</button>
		</form>
	</div>
</div>

<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/show_blocks.blade.php ENDPATH**/ ?>