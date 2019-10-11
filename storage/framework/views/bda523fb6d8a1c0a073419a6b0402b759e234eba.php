<?php $__env->startSection('stylesheets'); ?>
<script src="/js/showInputs.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('page-header'); ?>

	<section id="page-header">
	<div class="container-fluid ml-4 p-4">
		<h4>Unterrichtseinheiten erstellen</h4>
		
	</div>
	
	</section>
<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('content'); ?>
<div class="container mt-5">
	<div class="alert alert-warning d-md-none d-lg-none">
			<p class="lead">Die Toolbox zum Erstellen eigener Unterrichtseinheiten ist für die Benutzung mit Tablets oder größeren Bildschirmen konzipiert. Die Toolbox funktioniert deshalb nicht auf dem Smartphone.</p>
		</div>
			
		<h4 style="color:#03c4eb;" class="text-uppercase">Titel der Lerneinheit: <?php echo e($unit->unit_title); ?></h4>	
			
		<!-- Tabs für Schüler-/Lehrersicht -->
		<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
			<li class="nav-item">
				<a class="nav-link active" id="schueler-tab" data-toggle="tab" href="#schueler" role="tab" aria-controls="schueler" aria-selected="true">Schülersicht</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" id="lehrer-tab" data-toggle="tab" href="#lehrer" role="tab" aria-controls="lehrer" aria-selected="false">Lehrersicht</a>	
			</li>
		</ul>
		
		<div class="tab-content" id="myTabContent">
			
		<!-- Tabinhalt Schüler -->
			 <div class="tab-pane fade show active" id="schueler" role="tabpanel" aria-labelledby="schueler-tab">
				<div id="accordion" role="tablist">
					<div class="card">
						<!-- CardHeader1 -->
						<div class="card-header text-white" role="tab" id="start_block" style="background-color:#03c4eb">
							<div class="row">
								<div class="col">
									<h3 class="pt-2 font-weight-bold" style="color:#ff3333;">Das wirst Du heute machen:</h3>
									<p><?php echo e($unit->unit_description); ?></p>
								</div>
							</div>
						</div>
					</div>
						
					<?php $__currentLoopData = $unit->blocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<!-- Block1 -->		
					
					<form method="POST" action="<?php echo e(route('blocks.update',[$block->id])); ?>" enctype="multipart/form-data" id="blockheader_<?php echo e($block->id); ?>">
					<?php echo e(csrf_field()); ?> <?php echo e(method_field('PATCH')); ?>

			
					<div class="card my-1" style="border-color:#03c4eb">
						<!-- CardHeader1 -->
						<div class="card-header text-white" role="tab" style="background-image: url('/images/banner.jpg')">
							<div class="row">
								<div class="col-8">	
									<h4 id="title_<?php echo e($block->id); ?>" class="pt-4 pb-1 m-0"><?php echo e($block->title); ?>:</h4>
									<input class="d-none" type="text" id="titleInput_<?php echo e($block->id); ?>" name="title" value="<?php echo e($block->title); ?>"/>
								</div>
								<div class="col d-sm-none d-none d-md-block">
									<div class="ml-auto d-flex justify-content-end">
										<button type="button" class="btn btn-link p-0 m-2 text-white" data-toggle="modal" data-target="#deleteblock_<?php echo e($block->id); ?>"><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
										<span class="btn btn-link p-0 m-2 text-white" onclick="showInputs(<?php echo e($block->id); ?>)"><i class="fas fa-edit fa-fw" aria-hidden="true"></i></span>
										<button form="blockheader_<?php echo e($block->id); ?>" type="submit" class="btn btn-link p-0 m-2 text-white"><i class="far fa-save fa-fw" aria-hidden="true"></i></button>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-6">
									<p id="task_<?php echo e($block->id); ?>"><?php echo $block->task; ?></p>
									<div id="taskInput_<?php echo e($block->id); ?>" class="d-none">
										<textarea class="form-control mb-3 task-summernote" rows="8"  name="task" aria-label="task" aria-describedby="task"><?php if(isset($block->id)): ?><?php echo $block->task; ?><?php endif; ?></textarea>
										 <input type="hidden" name="unit_id" value="<?php echo e($unit->id); ?>">
									</div>
								</div>
								<div class="col">
										<i class="far fa-clock"><input class="d-none" type="text" size="2" maxlength="2" id="timeInput_<?php echo e($block->id); ?>" name="time" value="<?php echo e($block->time); ?>"></i><span id="time_<?php echo e($block->id); ?>"> <?php echo e($block->time); ?></span> Minuten
								</div>
								<div class="col">
									<a class="collapsed" data-toggle="collapse" href="#collapse<?php echo e($block->id); ?>" role="button" aria-expanded="false" aria-controls="collapseTwo"><i class="mx-5 far fa-caret-down fa-2x" style="color:#ffff00;"></i></a>
								</div>
							</div>
						</div>
					</form>
					
					<!-- Modal Delete Block -->
					<?php $__env->startComponent('teacher.teacher_components.delete_block', ['id' => $block->id]); ?>
					<?php echo $__env->renderComponent(); ?>
					
						<!-- CardBody -->
						<div id="collapse<?php echo e($block->id); ?>" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
							
							<!-- Differenzierung1 -->
<!-- ..................................................................................... -->
							<div class="card-body">
								<div class="row">
									<div class="col d-flex align-items-start flex-column">
										<div class="mb-auto">
											<?php if(isset ($block->content_id1)): ?>
												<?php $content1 = App\Content::find($block->content_id1); ?>
												<?php if(isset($content1->content_img_thumb)): ?>
													<a href="/content/<?php echo e($content1->id); ?>" target="_blank"><img src="/images/contents/<?php echo e($content1->content_img); ?>" alt="Bild:<?php echo e($content1->content_title); ?>"></img></a>
												<?php endif; ?>
												<?php if(empty($content1->content_img_thumb)): ?> 
													<?php switch($content1->tool_id):
														case (1): ?>
														<a href="/content/<?php echo e($content1->id); ?>" target="_blank"><img class="img-fluid p-4" src="https://img.youtube.com/vi/<?php echo e($content1->toolspecific_id); ?>/mqdefault.jpg"></img></a>
														<?php break; ?>
														<?php default: ?>
														<?php if(isset($content1->portal->portal_img)): ?>
															<a href="/content/<?php echo e($content1->id); ?>" target="_blank"><img src="/images/portals/<?php echo e($content1->portal->portal_img); ?>"></img></a>
														<?php endif; ?>
													<?php endswitch; ?>
												<?php endif; ?>		
											<?php elseif(isset ($block->specialcontent1)): ?>
												<div class="container">
													<?php echo $block->specialcontent1; ?>

												</div>
											<?php else: ?>
											<span class="rounded bg-light border border-info" style="display:inline-block;width:267px;height:150px;overflow:auto">
												<div class="container-fluid">
													<div class="row mt-4">
														<div class="col-3">
															<button type="button" class="btn btn-link text-info" data-toggle="modal" data-target="#choosecontent1_<?php echo e($block->id); ?>">
																<i class="fas fa-external-link-alt fa-2x"></i>
															</button>
														</div>
														<div class="col m-4">
															<p class="text-info">Inhalt aussuchen</p>
														</div>
													</div>
													<div class="row">
														<div class="col-3">
															<button class="btn btn-link text-info" data-toggle="modal" data-target="#specialcontent1_<?php echo e($block->id); ?>">
																<i class="fas fa-file-alt fa-2x"></i>
															</button>
														</div>
														<div class="col mt-1 my-4">
															<a href="#specialcontent1_<?php echo e($block->id); ?>" data-toggle="modal" data-target="#specialcontent1_<?php echo e($block->id); ?>"><p class="text-info">Aufgabentext eingeben</p></a>
														</div>
													</div>
												</div>
											</span>
											<?php endif; ?>
										</div>
									</div>
									<div class="col d-flex align-items-end flex-column">
										<?php if($block->differentiation > 1): ?><span class="badge badge-pill bg-info">block1_differenzierung_name1</span>
										<?php else: ?> 
										<?php endif; ?>
										<div class="mt-auto">
											<button type="button" class="btn mr-5 p-0" data-toggle="popover" title="Noch Fragen?" data-content="Tip_Text"><i class="fas fa-question-circle" style="color:orange"></i>												
											</button>
										</div>
									</div>
								</div>
							</div>
								
							<!-- Differenzierung2 -->
<!-- .............................................................................. -->
							<?php if($block->differentiation > 1): ?>
							<hr></hr>
							<div class="card-body">
								<div class="row">
									<div class="col d-flex align-items-start flex-column">
										<div class="mb-auto">
											<?php if(isset ($block->content_id2)): ?>
												<?php $content2 = App\Content::find($block->content_id2); ?>
												<?php if(isset($content2->content_img_thumb)): ?>
													<a href="/content/<?php echo e($content2->id); ?>" target="_blank"><img src="/images/contents/<?php echo e($content2->content_img); ?>" alt="Bild:<?php echo e($content2->content_title); ?>"></img></a>
												<?php endif; ?>
												<?php if(empty($content2->content_img_thumb)): ?> 
													<?php switch($content2->tool_id):
														case (1): ?>
														<a href="/content/<?php echo e($content2->id); ?>" target="_blank"><img class="img-fluid p-4" src="https://img.youtube.com/vi/<?php echo e($content2->toolspecific_id); ?>/mqdefault.jpg"></img></a>
														<?php break; ?>
														<?php default: ?>
														<?php if(isset($content2->portal->portal_img)): ?>
															<a href="/content/<?php echo e($content2->id); ?>" target="_blank"><img src="/images/portals/<?php echo e($content2->portal->portal_img); ?>"></img></a>
														<?php endif; ?>
													<?php endswitch; ?>
												<?php endif; ?>		
											<?php elseif(isset ($block->specialcontent2)): ?>
												<div class="container">
													<?php echo $block->specialcontent2; ?>

												</div>
											<?php else: ?>
											<span class="rounded bg-light border border-info" style="display:inline-block;width:267px;height:150px;overflow:auto">
												<div class="container-fluid">
													<div class="row mt-4">
														<div class="col-3">
															<button type="button" class="btn btn-link text-info" data-toggle="modal" data-target="#choosecontent2_<?php echo e($block->id); ?>">
																<i class="fas fa-external-link-alt fa-2x"></i>
															</button>
														</div>
														<div class="col m-4">
															<p class="text-info">Inhalt aussuchen</p>
														</div>
													</div>
													<div class="row">
														<div class="col-3">
															<button class="btn btn-link text-info" data-toggle="modal" data-target="#specialcontent2_<?php echo e($block->id); ?>">
																<i class="fas fa-file-alt fa-2x"></i>
															</button>
														</div>
														<div class="col mt-1 my-4">
															<a href="#specialcontent2_<?php echo e($block->id); ?>" data-toggle="modal" data-target="#specialcontent2_<?php echo e($block->id); ?>"><p class="text-info">Aufgabentext eingeben</p></a>
														</div>
													</div>
												</div>
											</span>
											<?php endif; ?>
										</div>
									</div>
									<div class="col d-flex align-items-end flex-column">
										<span class="badge badge-pill bg-info">block1_differenzierung_name2</span>
										<div class="mt-auto">
											<button type="button" class="btn mr-5 p-0" data-toggle="popover" title="Noch Fragen?" data-content="Tip_Text"><i class="fas fa-question-circle" style="color:orange"></i>												
											</button>
										</div>
									</div>
								</div>
							</div>
							<?php endif; ?>
					


							<!-- Differenzierung3 -->
<!-- ......................................................................................... -->
							<?php if($block->differentiation > 2): ?>
							<hr></hr>

							<div class="card-body">
								<div class="row">
									<div class="col d-flex align-items-start flex-column">
										<div class="mt-auto">
											<?php if(isset ($block->content_id3)): ?>
												<?php $content3 = App\Content::find($block->content_id3); ?>
												<?php if(isset($content3->content_img_thumb)): ?>
													<a href="/content/<?php echo e($content3->id); ?>" target="_blank"><img src="/images/contents/<?php echo e($content3->content_img); ?>" alt="Bild:<?php echo e($content3->content_title); ?>"></img></a>
												<?php endif; ?>
												<?php if(empty($content3->content_img_thumb)): ?> 
													<?php switch($content3->tool_id):
														case (1): ?>
														<a href="/content/<?php echo e($content3->id); ?>" target="_blank"><img class="img-fluid p-4" src="https://img.youtube.com/vi/<?php echo e($content2->toolspecific_id); ?>/mqdefault.jpg"></img></a>
														<?php break; ?>
														<?php default: ?>
														<?php if(isset($content3->portal->portal_img)): ?>
															<a href="/content/<?php echo e($content3->id); ?>" target="_blank"><img src="/images/portals/<?php echo e($content3->portal->portal_img); ?>"></img></a>
														<?php endif; ?>
													<?php endswitch; ?>
												<?php endif; ?>		
											<?php elseif(isset ($block->specialcontent3)): ?>
												<div class="container">
													<?php echo $block->specialcontent3; ?>

												</div>
											<?php else: ?>
											<span class="rounded bg-light border border-info" style="display:inline-block;width:267px;height:150px;overflow:auto">
												<div class="container-fluid">
													<div class="row mt-4">
														<div class="col-3">
															<button type="button" class="btn btn-link text-info" data-toggle="modal" data-target="#choosecontent3_<?php echo e($block->id); ?>">
																<i class="fas fa-external-link-alt fa-2x"></i>
															</button>
														</div>
														<div class="col m-4">
															<p class="text-info">Inhalt aussuchen</p>
														</div>
													</div>
													<div class="row">
														<div class="col-3">
															<button class="btn btn-link text-info" data-toggle="modal" data-target="#specialcontent3_<?php echo e($block->id); ?>">
																<i class="fas fa-file-alt fa-2x"></i>
															</button>
														</div>
														<div class="col mt-1 my-4">
															<a href="#specialcontent2_<?php echo e($block->id); ?>" data-toggle="modal" data-target="#specialcontent3_<?php echo e($block->id); ?>"><p class="text-info">Aufgabentext eingeben</p></a>
														</div>
													</div>
												</div>
											</span>
											<?php endif; ?>
										</div>
									</div>
									<div class="col d-flex align-items-end flex-column">
										<span class="badge badge-pill bg-info">block1_differenzierung_name3</span>
										<div class="mt-auto">
											<button type="button" class="btn mr-5 p-0" data-toggle="popover" title="Noch Fragen?" data-content="Tip_Text"><i class="fas fa-question-circle" style="color:orange"></i>												
											</button>
										</div>
									</div>
								</div>
							</div>
							<?php endif; ?>
						</div> <!-- close accordion collapse div -->
					</div> <!-- close card div -->
					
					<!-- Modal choose_content -->
					<div class="modal fade" id="choosecontent1_<?php echo e($block->id); ?>" tabindex="-1" role="dialog" aria-labelledby="choose_content" aria-hidden="true">
					<?php $__env->startComponent('teacher.teacher_components.choose_content', ['topic_id'=>$unit->topic_id , 'block'=>$block , 'contentnumber'=>'1']); ?>
					<?php echo $__env->renderComponent(); ?>
					</div>
					
					<div class="modal fade" id="choosecontent2_<?php echo e($block->id); ?>" tabindex="-1" role="dialog" aria-labelledby="choose_content" aria-hidden="true">
					<?php $__env->startComponent('teacher.teacher_components.choose_content', ['topic_id'=>$unit->topic_id , 'block'=>$block , 'contentnumber'=>'2']); ?>
					<?php echo $__env->renderComponent(); ?>
					</div>
					
					<div class="modal fade" id="choosecontent3_<?php echo e($block->id); ?>" tabindex="-1" role="dialog" aria-labelledby="choose_content" aria-hidden="true">
					<?php $__env->startComponent('teacher.teacher_components.choose_content', ['topic_id'=>$unit->topic_id , 'block'=>$block , 'contentnumber'=>'3']); ?>
					<?php echo $__env->renderComponent(); ?>
					</div>
					
					<!-- Modal specialcontent -->
					<div class="modal fade" id="specialcontent1_<?php echo e($block->id); ?>" tabindex="-1" role="dialog" aria-labelledby="specialcontent" aria-hidden="true">
					<?php $__env->startComponent('teacher.teacher_components.specialcontent', ['block'=>$block , 'contentnumber'=>'1']); ?>
					<?php echo $__env->renderComponent(); ?>
					</div>
					
					<div class="modal fade" id="specialcontent2_<?php echo e($block->id); ?>" tabindex="-1" role="dialog" aria-labelledby="specialcontent" aria-hidden="true">
					<?php $__env->startComponent('teacher.teacher_components.specialcontent', ['block'=>$block , 'contentnumber'=>'2']); ?>
					<?php echo $__env->renderComponent(); ?>
					</div>
					
					<div class="modal fade" id="specialcontent3_<?php echo e($block->id); ?>" tabindex="-1" role="dialog" aria-labelledby="specialcontent" aria-hidden="true">
					<?php $__env->startComponent('teacher.teacher_components.specialcontent', ['block'=>$block , 'contentnumber'=>'3']); ?>
					<?php echo $__env->renderComponent(); ?>
					</div>
					
					
					
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					
					<hr></hr>
					<div class="alert mt-5 mb-0 p-4 text-white font-weight-bold border border-white" style="background-color:#03c4eb; font-size:18px;">Hier kannst Du eine weitere Aufgabe hinzufügen: </div>
					
					<!-- new block -->
					<?php $__env->startComponent('teacher.teacher_components.new_block', ['id' => $unit->id]); ?>
					<?php echo $__env->renderComponent(); ?>
						
										
				</div> <!-- close accordion -->
			</div> <!-- close tab content schueler -->		
						
			<div class="tab-pane fade" id="lehrer" role="tabpanel" aria-labelledby="lehrer-tab">		
				<div class="text-white alert pt-2" style="background-color:#03c4eb">
					<p class="lead">Folgende Materialien/Geräte werden benötigt:</p>Smartphone, Beamer, Bildschirm, Internetzugang 16Mbit/s
				</div>
						
				<table class="table">
					<thead class="thead-light">
						<tr>
							<th>...</th>
							<th>Blockname / Verwendete Inhalte</th>
							<th>Dauer</th>
							<th>Unterrichtszeit</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td><p class="lead"><?php echo e($unit->start_text); ?></p></td>
							<td><?php echo e($unit->start_time); ?> Min</td>
							<td class="text-right"><time><?php echo e($passed_time); ?></time></td>
						</tr>
						<?php $__currentLoopData = $unit->blocks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>	
							<td><?php echo e($block->order); ?></td>
							<td>
								<p class="lead" ><?php echo e($block->title); ?></p>
								<?php if($block->differentiation = 1): ?>
								<p><a href="#"></a></p>
								<?php else: ?>
								<p><?php echo e($block->differentiation_name1); ?>:<a href="#">Titel Video2</a></p>
								<p>Mittel:<a href="#">Titel Video2</a></p>
								<p>Schwer:<a href="#">Titel Video3</a></p>
								<?php endif; ?>
							</td>
							<td>10 Min</td>
							<td class="text-right">0:15</td>
						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<tr>	
							<td>5</td>
							<td><p class="lead" >Orga/Verabschiedung/Hardware wegräumen</p></td>
							<td>5 Min</td>
							<td class="text-right">0:42</td>
						</tr>
					</tbody>
				</table>
			</div> <!-- close tab for Lehrersicht -->
		</div> <!-- close content for tabs -->
	</div> <!-- close col with Schüler/Lehrersicht -->
	<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</div> <!-- close container for page -->
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
      $('.task-summernote').summernote({
        height:100,
        toolbar: [
  		],
  		placeholder: 'Beschreibe hier kurz was der Schüler für die nächste Aufgabe tun muss (z.B. "Schau Dir das Video an." oder "Löse die folgenden Aufgaben:")'
      });
</script>
<script>
      $('.specialcontent-summernote').summernote({
        height: 130,
        toolbar: [
		['style', ['bold', 'italic', 'underline', 'clear']],
		['fontsize', ['fontsize']],
		['color', ['color']],
		['para', ['ul', 'ol', 'paragraph']],
		],
      });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout_teacher', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/oldstuff/toolbox_edit.blade.php ENDPATH**/ ?>