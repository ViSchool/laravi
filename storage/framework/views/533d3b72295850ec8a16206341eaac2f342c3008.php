<?php $__env->startSection('page-header'); ?>
<!-- delete where not necessary -->
<section id="page-header">
	<div class="container-fluid ml-4 p-4">
		<h4>Lerneinheit: <?php echo e($unit->unit_title); ?></h4>
	</div>
</section>
<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('content'); ?>
<section id="vischool-unit">
	<div class="container my-5">
		<?php if(\Session::has('success')): ?>
    		<div class="alert alert-success">
            <p><?php echo \Session::get('success'); ?></p>
    		</div>
		<?php endif; ?>

		<?php if(auth()->guard('student')->check()): ?>
			 <?php if($student->has('tasks')->where('unit_id',$unit->id)): ?>
				<div class="my-3 alert-info d-flex justify-content-between align-items-center">
				<span class="mx-3">Zu dieser Lerneinheit hast Du Aufträge erhalten: </span>
				<?php
        			session()->flash('unit_open',$unit->id);
				?>
				<a class="btn btn-primary my-3 mx-5" href="/schueler/auftraege"> Zu den Aufträgen </a>
				</div>
			 <?php endif; ?>
		<?php endif; ?>
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
							<p>Für diese Lerneinheit brauchst Du insgesamt: 
							<?php
							$uniqueBlocks = $unit->blocks->unique('order');
							$unit_duration = $uniqueBlocks->sum('time') + 2;
							?>
							<?php echo e($unit_duration); ?> Minuten</p>
						</div>
					</div>
				</div>
			</div>
			<?php if($unit->differentiation_group != NULL): ?>
			<div class="card my-1">
				<div class="card-body">
					<div class="row d-flex justify-content-center">
						<div class=" col-10 col-md-8">
							<p class="text-left">Diese Lerneinheit enthält unterschiedliche Aufgaben für verschiedene Lernniveaus. Wähle Dir hier Dein Lernniveau aus, damit Du nur Deine Aufgaben siehst. Wenn Du nicht sicher bist, welches Lernniveau Du auswählen sollst, frage bitte Deinen Lehrer</p>
						</div>
					</div>
					<div class="row ">
						<div class="col-10 d-flex justify-content-around align-items-center">
						<p class="mt-1 font-weight-bold">Ausgewähltes Lernniveau: </p> 
							<div class="dropdown">
							<button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e($startDifferentiation->differentiation_title); ?></button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<?php $__currentLoopData = $differentiations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $differentiation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<a class="dropdown-item" href="<?php echo e(route('units.filterdiffs' , ['unit' => $unit->id , 'diff' => $differentiation->id])); ?>"><?php echo e($differentiation->differentiation_title); ?></a>
									<option value="<?php echo e($differentiation->id); ?>"></option>
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
				<div class="card-header text-white" role="tab" style="background-image: url('/images/tafel_schwarz_banner.jpg')">
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
								<a id="blockCollapse_<?php echo e($block->id); ?>" class="collapsed" data-toggle="collapse" href="#collapse<?php echo e($block->id); ?>" role="button" aria-expanded="false" aria-controls="collapseTwo" style="color:#ffff00;">
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
										<?php 
											$content = App\Content::findOrFail($block->content_id);
										?>
										<a onclick="storeBlock(<?php echo e($block->id); ?>)" href="/content/<?php echo e($content->id); ?>" target="_self">
											<div class="card border border-primary w-75">
												<?php if(isset($content->content_img)): ?>
													<img class="card-img p-2" src="/images/contents/<?php echo e($content->content_img); ?>" alt="Bild:<?php echo e($content->content_title); ?>" style="max-height: 100%; width:auto;">
													<div class="card-img-overlay d-flex justify-content-center align-items-center">
														<span class="fa-stack fa-3x card-text">
															<i class="fas fa-square fa-inverse fa-stack-2x"></i>
															<i class="far fa-play-circle  fa-stack-1x"></i>
														</span>
													</div>
												<?php endif; ?> 
												<?php if(empty($content->content_img)): ?> 
													<?php switch($content->tool_id):
														case (1): ?>
															<img class="p-4 card-img" src="https://img.youtube.com/vi/<?php echo e($content->toolspecific_id); ?>/mqdefault.jpg">
															<div class="card-img-overlay d-flex justify-content-center align-items-center">
																<span class="fa-stack fa-3x card-text">
																	<i class="fas fa-square fa-inverse fa-stack-2x"></i>
																	<i class="far fa-play-circle  fa-stack-1x"></i>
																</span>
															</div>
														<?php break; ?>
														<?php case (6): ?>
															<img class="p-2 card-img" src="/images/topic_back.jpeg">
															<div class="card-img-overlay d-flex justify-content-center align-items-center">
																<p class="text-white"><?php echo e($content->content_title); ?></p>
																<p>
																	<span class="fa-stack fa-3x card-text">
																		<i class="fas fa-square fa-inverse fa-stack-2x"></i>
																		<i class="far fa-play-circle  fa-stack-1x"></i>
																	</span>
															</p>
														</div>
													<?php break; ?>
													<?php case (7): ?>
														<img class="p-2 card-img" src="<?php echo e($content->img_thumb_url); ?>">
														<div class="card-img-overlay d-flex justify-content-center align-items-center">
															<span class="fa-stack fa-3x card-text">
																<i class="fas fa-square fa-inverse fa-stack-2x"></i>
																<i class="far fa-play-circle  fa-stack-1x"></i>
															</span>
														</div>
													<?php break; ?>
													<?php default: ?>
														<?php if(isset($content->portal->portal_img)): ?>
															<img src="/images/portals/<?php echo e($content->portal->portal_img); ?>" class="card-img p-2">
															<div class="card-img-overlay d-flex justify-content-center align-items-center">
																<span class="fa-stack fa-3x card-text">
																	<i class="fas fa-square fa-inverse fa-stack-2x"></i>
																	<i class="far fa-play-circle  fa-stack-1x"></i>
																</span>
															</div>
														<?php endif; ?>
														<?php if(empty($content->portal->portal_img)): ?>
															<img class="p-2 card-img" src="/images/topic_back.jpeg">
															<div class="card-img-overlay d-flex justify-content-center align-items-center">
																<p class="text-white"><?php echo e($content->content_title); ?></p>
																<p>
																	<span class="fa-stack fa-3x card-text">
																		<i class="fas fa-square fa-inverse fa-stack-2x"></i>
																		<i class="far fa-play-circle  fa-stack-1x"></i>
																	</span>
																</p>
															</div>
														<?php endif; ?>
													<?php break; ?>
												<?php endswitch; ?>
											<?php endif; ?>
										</div>
										</a>		
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
				</div> <!-- close accordion collapse div -->
			</div> <!-- close card div -->
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			
			<!-- LAST BLOCK Review -->
			<div class="card my-1" style="border-color:#03c4eb">
				<!-- CardHeader Review Unit -->
				<div class="card-header text-white" role="tab" style="background-image: url('/images/tafel_schwarz_banner.jpg')">
					<div class="row mb-2">
						<div class="col-8">
							<small>Letzte Aufgabe</small>
						</div>
						<div class="col-3 text-right">
							<i class=" far fa-clock fa-sm"></i>
							<span id="time_review">2</span> Minuten
						</div>
					</div>
					<hr class="m-1"></hr>
					<div class="row my-5">
						<div class="col-9">	
							<h4 id="title_review" class="pt-2 m-0">Bitte bewerte wie Dir diese Lerneinheit gefallen hat.</h4>
						</div>
						<div class="col-2">
							<div class="d-flex align-items-end flex-row-reverse flex-column">
								<a class="collapsed" data-toggle="collapse" href="#collapsereview" role="button" aria-expanded="false"aria-controls="collapseTwo" style="color:#ffff00;">
								<i class="fa fa-2x fas fa-plus-circle"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
					
				<!-- CardBody -->
				<div id="collapsereview" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
					<div class="card-body">
						<div class="row">
							<div class="col d-flex align-items-end flex-column">
							</div>
						</div>
						<div class="row">
							<div class="col-10 d-flex align-items-start flex-column">
								<div class="mb-auto">
									<div class="container">
										<h3>Bewerten</h3>
										<form action="/reviews" method="POST" enctype="multipart/form-data">
											<?php echo csrf_field(); ?>
											<!-- AHA Review -->
											<div class="row">
												<div class="col-md row-sm">
													<div class="mb-1 d-flex flex-row align-items-center justify-content-start">
														<img class="img-fluid ml-0 mr-1" src="/images/logo_aha.jpg" alt="AHA!" width="60">
														<div class="pt-2">
															<div class="rating">
																<input id="star1_aha" type="radio" name="aha_score" value="5">
																<label for="star1_aha"></label>
																<input id="star2_aha" type="radio" name="aha_score" value="4">
																<label for="star2_aha"></label>
																<input id="star3_aha" type="radio" name="aha_score" value="3">
																<label for="star3_aha"></label>
																<input id="star4_aha" type="radio" name="aha_score" value="2">
																<label for="star4_aha"></label>
																<input id="star5_aha" type="radio" name="aha_score" value="1">
																<label for="star5_aha"></label>
															</div>
														</div>
													</div>
												</div>	
												
												<!-- COOL Review -->	
												
												<div class="col-md row-sm">
													<div class="mb-1 d-flex flex-row align-items-center justify-content-start">
														<img class="img-fluid ml-0 mr-1" src="/images/logo_cool.jpg" alt="COOL!" width="60"></img>
														<div class="pt-2">
															<div class="rating">
																<input id="star1_cool" type="radio" name="cool_score" value="5">
																<label for="star1_cool"></label>
																<input id="star2_cool" type="radio" name="cool_score" value="4">
																<label for="star2_cool"></label>
																<input id="star3_cool" type="radio" name="cool_score" value="3">
																<label for="star3_cool"></label>
																<input id="star4_cool" type="radio" name="cool_score" value="2">
																<label for="star4_cool"></label>
																<input id="star5_cool" type="radio" name="cool_score" value="1">
																<label for="star5_cool"></label>
															</div>
														</div>
													</div>
												</div>
													
												<!-- WIRKT Review -->	
												
												<div class="col-md row-sm">
													<div class="mb-1 d-flex flex-row align-items-center justify-content-start">
														<img class="img-fluid ml-0 mr-1" src="/images/logo_wirkt.jpg" alt="WIRKT!" width="60"></img>
														<div class="pt-2">
															<div class="rating">
																<input id="star1_wirkt" type="radio" name="wirkt_score" value="5">
																<label for="star1_wirkt"></label>
																<input id="star2_wirkt" type="radio" name="wirkt_score" value="4">
																<label for="star2_wirkt"></label>
																<input id="star3_wirkt" type="radio" name="wirkt_score" value="3">
																<label for="star3_wirkt"></label>
																<input id="star4_wirkt" type="radio" name="wirkt_score" value="2">
																<label for="star4_wirkt"></label>
																<input id="star5_wirkt" type="radio" name="wirkt_score" value="1">
																<label for="star5_wirkt"></label>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row mt-3">
												<div class="col-10">
												<textarea class="form-control" name="review_comment" id="review_comment" rows="3" placeholder="Was hat Dir gefallen oder nicht? Wofür hast Du gelernt?"></textarea>	
												<input type="hidden" name="review_unit_id" value="<?php echo e($unit->id); ?>"/>
												<input type="hidden" name="review_content_id" value="0"/>

												</div>
											</div>	
											<div class="row">
												<div class="">
													<button class="mt-3" type="submit">Bewerten</button>
												</div>
											</div>
										</form>
									</div>

								</div>
							</div>
							<div class="col d-flex flex-row-reverse align-self-start">
								<div class="mt-auto">
									<a tabindex="0" class="btn" role="button" data-toggle="popover" data-html="true" title="Lerntipp" data-content="Die Bewertung hilft uns den Unterricht zu verbessern." data-placement="auto"><i class="fas fa-question-circle fa-lg" style="color:#03c4eb"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- close accordion collapse div -->
			</div>
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
  })
})
</script>

<script>
//wenn man den Link von einem Inhalt drückt
function storeBlock($id) {
//soll die BlockID in einer Sessionvariable gespeichert werden
	sessionStorage.setItem('block',$id);
}
</script>
<script>
$(document).ready(function() {
	if (sessionStorage.getItem('block') != null) {
		var id = sessionStorage.getItem('block');
		var expandedBlock = document.getElementById('collapse' + id);
		expandedBlock.classList.add("show");
		sessionStorage.clear();
	}
}); 
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('/layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/frontend/units/show_units.blade.php ENDPATH**/ ?>