<?php $__env->startSection('page-header'); ?>
<!-- delete where not necessary -->
<section id="page-header">
	<div class="container-fluid ml-4 p-4">
		<h4>Unterrichtseinheit: <?php echo e($unit->unit_title); ?></h4>
	</div>
</section>
<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('content'); ?>
<section id="vischool-unit">
	<div class="container my-5">
		<div id="accordion" role="tablist">
			<!-- Startblock -->
			<div class="card">
				<div class="card-header text-white" role="tab" id="start_block" style="background-color:#03c4eb">
					<div class="row">
						<div class="col">
							<h3 class="pt-2 font-weight-bold" style="color:#ff3333;">Das wirst Du heute machen:</h3>
							<p><?php echo e($unit->unit_description); ?></p>
						</div>
					</div>
					<?php if(isset($unit->unit_img)): ?>
					<div class="row mb-3">
						<div class="col-3">
						</div>
						<div class="col-6">
							<img class="img-fluid img-thumbnail" src="/images/units/<?php echo e($unit->unit_img); ?>"></img>
						</div>
						<div class="col-3">
						</div>
					</div>
					<?php endif; ?>
					<div class="row">
						<div class="col text-right">
							<p>Für diese Einheit brauchst Du insgesamt: 
							<?php 
							$unit_duration = $unit->blocks->sum('time');
							?>
							<?php echo e($unit_duration); ?> Minuten</p>
						</div>
					</div>
				</div>
			</div>
			<?php if($differentiationExists == 1): ?>
			<div class="card my-1">
				<div class="card-body">
					<div class="row">
						<div class="col-8">
							<p>Diese Unterrichtseinheit enthält unterschiedliche Aufgaben für verschiedene Lernniveaus. Wähle Dir hier Dein Lernniveau aus, damit Du nur Deine Aufgaben siehst. Wenn Du nicht sicher bist, welches Lernniveau Du auswählen sollst, frage bitte Deinen Lehrer</p>
						</div>
						<div class="col-2">
							<div class="dropdown">
								<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bitte wählen</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<?php $__currentLoopData = $differentiations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $differentiation_id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<?php
									$listDiff = App\Differentiation::findOrFail($differentiation_id);
									?>
									<a class="dropdown-item" href="<?php echo e(route('units.filterdiffs' , ['unit' => $unit->id , 'diff' => $listDiff->id])); ?>"><?php echo e($listDiff->differentiation_title); ?></a>
									<option value="<?php echo e($listDiff->id); ?>"></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php endif; ?>
			
			<?php 
				$firstblock_order = $unit->blocks->min('order');
				$ordernumber = 0;
			?>
			
			<!-- Aufgaben -->			
			<?php $__currentLoopData = $blocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<div class="card my-1" style="border-color:#03c4eb">
				<!-- CardHeader -->
				<div class="card-header text-white" role="tab" style="background-image: url('/images/banner.jpg')">
					<div class="row mb-2">
						<?php $ordernumber ++; ?>
						<div class="col-8">
							<small>Aufgabe <?php echo e($ordernumber); ?> von <?php echo e($unit->blocks->unique('order')->count()); ?></small>
						</div>
						<div class="col-3 text-right">
							<i class=" far fa-clock fa-sm"></i>
							<span id="time_<?php echo e($block->id); ?>"> <?php echo e($block->time); ?></span> Minuten
						</div>
					</div>
					<hr class="m-1"></hr>
					<div class="row my-5">
						<div class="col-9">	
							<h4 id="title_<?php echo e($block->id); ?>" class="pt-2 m-0"> <?php echo e($block->title); ?></h4>
						</div>
						<div class="col-2">
							<div class="d-flex align-items-end flex-row-reverse flex-column">
								<a class="collapsed" data-toggle="collapse" href="#collapse<?php echo e($block->id); ?>" role="button" aria-expanded="false"aria-controls="collapseTwo" style="color:#ffff00;">
								<i class="fa fa-2x fas fa-plus-circle"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
					
				<!-- CardBody -->
				<div id="collapse<?php echo e($block->id); ?>" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
					<div class="card-body">
						<div class="row">
							<div class="col d-flex align-items-end flex-column">
							</div>
						</div>
						<div class="row">
							<div class="col-8 d-flex align-items-start flex-column">
								<div class="mb-auto">
									<?php if(isset ($block->task)): ?>
										<?php echo $block->task; ?>

									<?php endif; ?>

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
														<a href="/content/<?php echo e($content->id); ?>"><i class="<?php echo e($content->type->type_icon); ?> fa-3x"> </i> <?php echo e($content->type->content_type); ?> öffnen</a>
													<?php endif; ?>
												<?php break; ?>
											<?php endswitch; ?>
										<?php endif; ?>		
									<?php endif; ?>
									<?php if(empty($block->content_id)): ?>
										<?php if(empty($block->task)): ?>
											<div class="container">
												<p>Hier fehlt ein Inhalt!</p>
											</div>
										<?php endif; ?>
									<?php endif; ?>
								</div>
							</div>
							<div class="col d-flex flex-row-reverse align-self-start">
								<div class="mt-auto">
									<?php if($block->tips !== null): ?>
									<a tabindex="0" class="btn" role="button" data-toggle="popover" data-html="true" title="Lerntipp" data-content=" <?php echo e($block->tips); ?>" data-placement="auto"><i class="fas fa-question-circle fa-lg" style="color:#03c4eb"></i></a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
					
					<!-- Differenzierung2 -->
				
			</div> <!-- close accordion collapse div -->
		</div> <!-- close card div -->
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
</div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
      $(function () {
  $('.tipp_popover').popover({
    container: 'body',
    html: 'true',
    content: '<?php echo $block->tips; ?>',
  })
})
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('/layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>