	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<?php 
			$contents = App\Content::where('topic_id', '=', $topic_id)->get();
			?>
			<section id="topic_contents">
				<div class="container-fluid my-4">
					Hier geht es um die Block-ID: <?php echo e($block->id); ?>

					<div class="row justify-content-start">
						<?php if(empty($contents)): ?>
						<div>
							Bislang wurden noch keine Inhalte zu diesem Thema angelegt. Sag der ViSchool Bescheid und wir kümmern uns drum, versprochen!
							Button mit Mail an Vischool!
							
						</div>
						<?php endif; ?>
						<?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="col">
								<div class="card m-3" style="width:200px">
									<?php if(isset($content->content_img_thumb)): ?>
										<a href="/content/<?php echo e($content->id); ?>"><img class="card-img-top" src="/images/contents/<?php echo e($content->content_img); ?>" alt="Bild:<?php echo e($content->content_title); ?>"></img></a>
									<?php endif; ?>
									<?php if(empty($content->content_img_thumb)): ?> 
										<?php switch($content->tool_id):
											case (1): ?>
												<a href="/content/<?php echo e($content->id); ?>"><img class="card-img-top" src="https://img.youtube.com/vi/<?php echo e($content->toolspecific_id); ?>/mqdefault.jpg"></img></a>
											<?php break; ?>
											<?php default: ?>
											<?php if(isset($content->portal->portal_img)): ?>
												<a href="/content/<?php echo e($content->id); ?>"><img class="card-img-top" src="/images/portals/<?php echo e($content->portal->portal_img); ?>"></img></a>
											<?php endif; ?>
										<?php endswitch; ?>
									<?php endif; ?>	
									<div class="card-body">
										<a href="/content/<?php echo e($content->id); ?>"><h4 class="card-title"><?php echo e($content->content_title); ?></h4></a>
										<p class="card-text">			
											<?php $rating = 1.3; ?>  

            										<?php $__currentLoopData = range(1,5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                										<span class="fa-stack" style="width:1em"><i class="far fa-star fa-stack-1x"></i>
													<?php if($rating >0): ?>
														<?php if($rating >0.5): ?>
															<i class="fas fa-star fa-stack-1x"></i>
														<?php else: ?>
															<i class="fas fa-star-half fa-stack-1x"></i>
                        								<?php endif; ?>
													<?php endif; ?>
													<?php $rating--; ?> 
													</span>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</p>
									</div>
								
									<form method="POST" action="<?php echo e(route('blocks.update',[$block->id])); ?>" enctype="multipart/form-data" id="selectContent_<?php echo e($block->id); ?>">
									<?php echo e(csrf_field()); ?> <?php echo e(method_field('PATCH')); ?>

	     								<div class="card-footer d-flex justify-content-between">
      										<small class="text-muted"><i class="<?php echo e($content->type->type_icon); ?> fa-2x"></i> <?php echo e($content->type->content_type); ?></small>
      										<input type="hidden" value="<?php echo e($content->id); ?>" name="content_id"/>
											<input type="hidden" value="<?php echo e($contentnumber); ?>" name="contentnumber"/>
											<input type="hidden" value="<?php echo e($block->task); ?>" name="task"/>
											<input type="hidden" value="<?php echo e($block->title); ?>" name="title"/>
											<input type="hidden" value="<?php echo e($block->unit_id); ?>" name="unit_id"/>
											<button class="badge badge-pill bg-primary" type="submit" form="selectContent_<?php echo e($block->id); ?>" value="Submit">Submit</button>	
										</div>
									</form>
  								</div>
  							</div>
  						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
  					</div>
				</div>
				<div class="modal-footer">
					
				</div>
			</section>
		</div>
	</div>	
