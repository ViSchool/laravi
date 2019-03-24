<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
<section id="page-header">
    <div class="container p-3">
	    <h4>Meine Inhalte</h4>
    </div>
</section> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



<div class="container mt-3">
    <h3>Deine selbst erstellten Inhalte</h3>
    <p>"Inhalte" sind einzelne Videos oder Aufgaben, die Du im Internet findest oder selbst erstellt und bei einem anderen Dienst speicherst. Typische Beispiele sind Youtube- oder Vimeo-Videos, h5p-Aufgaben oder andere Aufgaben auf Webseiten. Um einen Inhalt selbst einzustellen, brauchen wir zunächst nur den Link, mit dem der Inhalte dargestellt wird. Je mehr Informationen Ihr uns dabei gebt, desto besser können wir den Inhalt erkennen und einbinden. Sollte das einmal nicht klappen, keine Sorge: Wir schauen uns alle Inhalte noch einmal an und korrigieren falls nötig. 
    </p>
    <p>Inhalte, die Du erstellst, findest Du zunächst nur in Deinem privaten Bereich. Das heißt nur Du und die von Dir erstellten Klassenaccounts können diesen Inhalt sehen. Möchtest Du, dass der Inhalt auch auf der öffentlichen ViSchool-Seite zu sehen ist, musst Du den Inhalt zur Veröffentlichung von der ViSchool freigeben lassen. Auch vor der Freigabe kannst Du den Inhalt in Deinen Unterrichtseinheiten einsetzen. Unterrichtseinheiten, die einen nicht von der ViSchool freigegebenen Inhalte enthalten, können auch nur in Deinem privaten Bereich angezeigt werden.</p>
</div>
<div class="container">
     <button type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#newContentModal">
Einen neuen Inhalt erstellen</button>






    <!-- Modal -->
    <div class="modal fade" id="newContentModal" tabindex="-1" role="dialog" aria-labelledby="newContentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="/lehrer/inhalte" enctype="multipart/form-data">
                <?php echo csrf_field(); ?> 
                                
                    <div class="modal-header">
                        <h5 class="modal-title" id="newContentModalLabel">Einen neuen Inhalt erstellen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">    
                        
                        <input type="hidden" value="<?php echo e($teacher->id); ?>" name="user_id">
                        
                        <input type="hidden" 
                            <?php if($teacher->teacher_id == $teacher->id): ?>
                                value="teacher" 
                            <?php else: ?> 
                                value="student"
                            <?php endif; ?>
                        name="teacherOrStudent">


                        <div class="form-group<?php echo e($errors->has('content_title') ? ' has-error' : ''); ?>">
                            <label for="content_title" class="col-10 control-label">Name des Inhalts</label>
                             <div class="col-10">
                             <input id="content_title" type="text" class="form-control" name="content_title" value="<?php echo e(old('content_title')); ?>" required>
                                <?php if($errors->has('content_title')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('content_title')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('tool_id') ? ' has-error' : ''); ?>">
                            <label for="content_provider" class="col-10 control-label">Der Inhalt stammt von folgendem Anbieter:</label>
                            <div class="col-10">
                                <select class="form-control" id="tool_id" name="tool_id">
				                    <?php if((old('tool_id')) !== null): ?>
                                        <?php 
                                            $tool_id_old = old('tool_id');
                                            $tool_old = App\Tool::where('id', '=' , $tool_id_old)->first();
                                        ?>
                                        <option value="<?php echo e($tool_id_old); ?>"><?php echo e($tool_old->tool_title); ?></option>
				                    <?php endif; ?>
				                    <?php if(empty(old('tool_id'))): ?>
					                    <option value=""></option>
				                    <?php endif; ?>
				                    <?php $__currentLoopData = $tools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
					                    <option value="<?php echo e($tool->id); ?>"><?php echo e($tool->tool_title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <option value="">Anderer Anbieter</option>
                                </select>
                            </div>    
                        </div>

                        <div class="form-group<?php echo e($errors->has('content_link') ? ' has-error' : ''); ?>">
                            <label for="content_link" class="col-10 control-label">Link zum Inhalt</label>
                            <br>
                            <small id="examplelink" class="text-muted col-10">Beispiellink</small>
                             <div class="col-11">
                                <input id="content_link" type="text" class="form-control" name="content_link" value="<?php echo e(old('content_link')); ?>" placeholder="" required>
                                <?php if($errors->has('content_link')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('content_link')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="form-group<?php echo e($errors->has('subject_id') ? ' has-error' : ''); ?>">
                            <label for="topic_id" class="col-10 control-label">Der Inhalt gehört zu folgendem Fach</label>
                             <div class="col-10">
                               <select class="form-control" id="subject_id" name="subject_id">
				                    <?php if((old('subject_id')) !== null): ?>
                                        <?php 
                                            $subject_id_old = old('subject_id');
                                            $subject_old = App\Subject::where('id', '=' , $subject_id_old)->first();
                                        ?>
                                        <option value="<?php echo e($subject_id_old); ?>"><?php echo e($subject_old->subject_title); ?></option>
				                    <?php endif; ?>
				                    <?php if(empty(old('subject_id'))): ?>
					                    <option value=""></option>
				                    <?php endif; ?>
				                    <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
					                    <option value="<?php echo e($subject->id); ?>"><?php echo e($subject->subject_title); ?></option>
				                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                             </select>
            <?php if($errors->has('topic_id')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('topic_id')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('topic_id') ? ' has-error' : ''); ?>">
                            <label for="topic_id" class="col-10 control-label">Der Inhalt gehört zu folgendem Thema</label>
                             <div class="col-10">
                                <select class="form-control" id="topic_id" name="topic_id">
                                    <?php if((old('topic_id')) !== null): ?>
                                        <?php 
                                            $topic_id_old = old('topic_id');
                                            $topic_old = App\Topic::where('id', '=' , $topic_id_old)->first();
                                        ?>
                                        <option value="<?php echo e($topic_id_old); ?>"><?php echo e($topic_old->topic_title); ?></option>
                                    <?php endif; ?>
                                    <?php if(empty(old('topic_id'))): ?>
                                        <option>Zuerst Fach auswählen</option>
                                    <?php endif; ?>
                                </select>
			                    <div class="col-md-2">
				                    <span id="loader" style="visibility: hidden;">
					                    <i class="far fa-spinner fa-spin"></i>
				                    </span>
			                    </div>
                                <?php if($errors->has('topic_id')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('topic_id')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>         
                    </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                        <button type="submit" class="btn btn-primary">Inhalt speichern</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Anzeige der Inhalte-->


<div class="container my-4">
    <hr> 
    <h3>Diese Inhalte hast Du bereits erstellt:</h3>
    <?php $__currentLoopData = $contentsBySubject; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject_id => $contents): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php $subject = App\Subject::findOrFail($subject_id);?>
        <h3 class="mt-3 text-brand-blue"><?php echo e($subject->subject_title); ?></h3>
        <div class="row justify-content-start">
            
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
							<?php case (7): ?>
								<a href="/content/<?php echo e($content->id); ?>"><img class="card-img-top" src="<?php echo e($content->img_thumb_url); ?>"></img></a>
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
                            <?php 
                            $reviews = App\Review::where('content_id',$content->id)->get();
                            $average_score = $reviews->avg('overall_score');
                            ?>
                            <!-- Sternchenbewertung auf Inhalte-Card -->
                            <?php if($average_score > 0): ?>
                                <?php $rating = $average_score ?>  
                                <?php $__currentLoopData = range(1,5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="fa-stack" style="width:1em" data-toggle="tooltip" data-placement="top" title="Durchschnittliche Bewertung">
                                        <i class="far fa-star fa-stack-1x"></i>

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
                            <?php endif; ?>
                        </p>
                    </div>
  					
                    <div class="card-footer d-flex justify-content-between">
                        <small class="text-muted">
                            <i class="<?php echo e($content->type->type_icon); ?> "></i>
                            <?php echo e($content->type->content_type); ?>

                        </small>
                          
                    </div>
                    <div class="card-footer 
                    <?php if($content->status_id == 5): ?>
                        bg-warning 
                    <?php elseif($content->status_id == 4): ?>
                        bg-info text-white
                    <?php elseif($content->status_id == 3): ?>
                        bg-warning 
                    <?php elseif($content->status_id == 2): ?>
                        bg-info text-white
                    <?php elseif($content->status_id == 1): ?>
                        bg-success text-white
                    <?php endif; ?>                        
                    d-flex justify-content-between">
                        <small>
                            <i class="<?php echo e($content->status->status_icon); ?>"></i>
                            <?php echo e($content->status->status_name); ?>

                        </small> 
                        <?php if($content->status_id == 5): ?>
                            <a title="Inhalt bestätigen und auf der privaten Seite veröffentlichen" href="/lehrer/newContentPrivate/<?php echo e($content->id); ?>"><i class="fas fa-thumbs-up"></i></a>
                        <?php elseif($content->status_id == 3): ?>
                            <small><a title="An ViSchool zur Veröffentlichung schicken" href="/lehrer/newContentViSchool/<?php echo e($content->id); ?>" ><i class="fas fa-upload"></i></a></small>
                        <?php endif; ?>
                    </div>	
                </div>
            </div>  
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div> 
        <hr>   
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
	
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
    <?php if(count($errors) > 0): ?>
        $('#newTopicModal').modal('show');
    <?php endif; ?>
</script>  

<script src="<?php echo e(asset('js/ddd_subject_topic.js')); ?>"></script>

<script src="/js/dynamic_content_link.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>