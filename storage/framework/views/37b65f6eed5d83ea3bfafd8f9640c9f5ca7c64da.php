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
        <div class="table">
            <table class="table-responsive-sm table-striped my-5 w-100">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Name des Inhalts</th>
                        <th scope="col">Thema</th>
                        <th scope="col">Tool/Hoster</th>
                        <th scope="col">Status</th>
                        <th scope="col">Löschen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                        <td><button class="btn btn-link m-0 p-0 text-left" data-toggle="modal" data-target="#editContentModal"><?php echo e($content->content_title); ?></button></td>
                            <td><small> <?php echo e($content->topic->topic_title); ?></small></td>
                            <td><small> <?php echo e($content->tool->tool_title); ?></small></td>
                            <td><small> <?php echo e($content->status->status_name); ?></small></td>
                            <td>
                                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#deleteModal_<?php echo e($content->id); ?>"><i class="far fa-trash-alt"></i></button>
                                <div class="modal fade" id="deleteModal_<?php echo e($content->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <?php echo $__env->make('components.deleteCheck',['typeDelete'=>'content','id'=>$content->id,'title'=>$content->content_title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            
                        </tr>
                        
                        <?php $__env->startComponent('teacher.teacher_components.editContentModal',['content'=>$content, 'teacher'=>$teacher, 'tools'=>$tools, 'subjects'=>$subjects]); ?>   
                        <?php echo $__env->renderComponent(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

        </div>
        

					
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