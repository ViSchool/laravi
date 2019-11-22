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
    <p>Inhalte, die Du erstellst, findest Du zunächst nur in Deinem privaten Bereich. Das heißt nur Du und die von Dir erstellten Klassen- und Schüleraccounts können diesen Inhalt sehen. Möchtest Du, dass der Inhalt auch auf der öffentlichen ViSchool-Seite zu sehen ist, musst Du den Inhalt zur Veröffentlichung von der ViSchool freigeben lassen. Auch vor der Freigabe kannst Du den Inhalt in Deinen Lerneinheiten einsetzen. Lerneinheiten, die einen nicht von der ViSchool freigegebenen Inhalte enthalten, können auch nur in Deinem privaten Bereich angezeigt werden.</p>
</div>
<div class="container">
     <button type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#newContentModal">
Einen neuen Inhalt erstellen</button>

    <!-- Modal -->
  <?php $__env->startComponent('teacher.teacher_components.newContentModal',['teacher'=>$teacher, 'tools'=>$tools, 'subjects'=>$subjects]); ?>   
  <?php echo $__env->renderComponent(); ?>

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
    if (count($errors) > 0) {
        $('#newContentModal').modal('show');
    }
</script>  

<script src="<?php echo e(asset('js/ddd_subject_topic.js')); ?>"></script>

<script src="/js/dynamic_content_link.js"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/teacher/teacher_contents.blade.php ENDPATH**/ ?>