<?php $__env->startSection('stylesheets'); ?>
<script src="/js/showInputs.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <div class="container">
          <h4>Lerneinheit:<a href="/backend/units/<?php echo e($unit->id); ?>"> <?php echo e($unit->unit_title); ?></a></h4>
          <h5>Aufgabe: <?php echo e($block->title); ?></h5>
          </div>
          <hr></hr>

<div class="container">
<?php echo $__env->make('layouts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<form method="POST" action="<?php echo e(route('backend.blocks.update',[$block->id])); ?>" enctype="multipart/form-data">
		<?php echo e(csrf_field()); ?> <?php echo e(method_field('PATCH')); ?>

		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text">Überschrift für die Aufgabe:</label>
			</div>
			<input value="<?php echo e($block->title); ?>" type="text" class="form-control" id="title" name="title">
		</div>
		<!-- <div class="form-group mb-3">
			<label class="mb-0">Aufgabentext:</label>
			<textarea class="form-control task-summernote" id="task" name="task" aria-label="task" aria-describedby="task"></textarea>
		</div> -->
		<input type="hidden" name="unit_id" value="<?php echo e($unit->id); ?>">
				
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="time">Zeit für die Aufgabe:</label>
			</div>
			<input value="<?php echo e($block->time); ?>" type="text" class="form-control" size="2" maxlength="2" id="time" name="time"></input>
			<div class="input-group-append">
				<span class="input-group-text">Minuten</span>
			</div>
		</div>
		<div class="input-group mb-3">
		<div class="input-group-prepend">
			<label class="input-group-text" for="differentiation">Bestimmte Schülergruppe:</label>
		</div>
		<select class="form-control" id="differentiation" name="differentiation">
			<option value="<?php echo e($block->differentiation->id); ?>"><?php echo e($block->differentiation->differentiation_title); ?></option>
			<?php $__currentLoopData = $differentiations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $differentiation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($differentiation->id); ?>"><?php echo e($differentiation->differentiation_title); ?></option>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		</select>
	</div>
	<div class="input-group mb-3">
		<div class="input-group-prepend">
			<label class="input-group-text" for="alternative">Alternative zu dieser Aufgabe:</label>
		</div>
		<select class="form-control" id="alternative" name="alternative">
			<?php if($block->alternative != NULL): ?>
			<option value="<?php echo e($blockAlternative->id); ?>"><?php echo e($blockAlternative->title); ?> (<?php echo e($blockAlternative->differentiation->differentiation_title); ?>)</option>
			<?php else: ?> 
			<option value="keine">Bitte auswählen</option>
			<?php endif; ?>
			<option value="keine">(noch) keine</option>
			<?php $__currentLoopData = $unit->blocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($block->id); ?>"><?php echo e($block->title); ?> (<?php echo e($block->differentiation->differentiation_title); ?>)</option>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</select>
	</div>
		
		<button class="btn btn-primary form-control" type="submit">Änderungen in dieser Aufgabe speichern</button>
</form>	
<hr></hr>

<div>
	<h4>Vorschau für diese Aufgabe</h4>
	<?php 
		$firstblock_order = $unit->blocks->min('order');
		$ordernumber = 0;
	?>
	
	<div class="card my-1" style="border-color:#03c4eb">
				<!-- CardHeader -->
				<div class="card-header text-white" role="tab" style="background-image: url('/images/banner.jpg')">
					<div class="row mb-4">
						<?php $ordernumber ++; ?>
						<div class="col-10">
							Aufgabe <?php echo e($ordernumber); ?> von <?php echo e($unit->blocks->count()); ?>

						</div>
					</div>
					<div class="row mb-2">
						<div class="col-9">	
							<h5 id="title_<?php echo e($block->id); ?>" style="font-family: Cabin Sketch" class="pt-4 pb-1 m-0"><?php echo e($block->title); ?>:</h5>
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
					


				<div class="card-footer text-right">
					<a href="/backend/blocks/create2/<?php echo e($block->id); ?>" class="card-link">Aufgabentext oder Digitalen Inhalt bearbeiten</a>
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

<?php echo $__env->make('layouts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
	$(document).ready(function() {
	var markupStr = '<?php echo $block->task; ?>';
	$('.task-summernote').summernote({
        height: 130,
        toolbar: [],
        focus: true
      });
	
	$('.task-summernote').summernote('code', markupStr);
	});
	
</script>
<script>
      $('.task-summernote').summernote({
        height: 130,
        toolbar: [],
        focus: true
      });
</script>

<script src="<?php echo e(asset('js/ddd_subject_topic.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout_backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>