<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
<section id="page-header">
    <div class="container p-3">
	    <h4>Meine Themen</h4>
    </div>
</section> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



<div class="container mt-3">
    <h3>Deine selbst erstellten Themen</h3>
    <p>"Themen" sind die Überschriften unter denen bestimmte Inhalte und Unterrichtseinheiten zusammengefasst werden. Beispiele findest Du auf der ViSchool Seite. Wenn Dir Themen auf unserer Seite fehlen, zu denen Du gerne Inhalte anlegen möchstest, dann kannst Du sie hier erstellen und siehst auch die Übersicht der Themen, die Du bereits erstellt hast.
    </p>
    <p>Themen, die Du erstellst, findest Du zunächst nur in Deinem privaten Bereich. Das heißt alle nur Du und die von Dir erstellten Klassenaccounts können dieses Thema sehen. Möchtest Du, dass das Thema auch auf der öffentlichen ViSchool-Seite zu sehen ist, musst Du das Thema zur Veröffentlichung von der ViSchool freigeben lassen.</p>
</div>
<div class="container">
    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th scope="col">Thema</th>
                <th colspan="2" scope="col">bearbeiten</th>
                <th scope="col">Status</th>
                <th scope="col">löschen</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <tr>   
                <td><?php echo e($topic->topic_title); ?></td>
                <td>
                    <?php switch($topic->status_id):
                        case (1): ?>
                            <i class="text-muted fas fa-lock-open"></i>
                        <?php break; ?>
                        <?php case (2): ?>
                            <i class="text-muted fas fa-hourglass-half"></i>
                        <?php break; ?>
                        <?php case (3): ?>
                             <a href="/lehrer/newTopicViSchool/<?php echo e($topic->id); ?>">
                            <i class="fas fa-upload"></i></a> 
                        <?php break; ?> 
                        <?php default: ?>
                            <a href="/lehrer/newTopicPrivate/<?php echo e($topic->id); ?>"><i class="fas fa-user-check"></i></a>
                    <?php endswitch; ?>
                </td>
                <td>
                    <?php switch($topic->status_id):
                        case (1): ?>
                        <?php break; ?>
                        <?php case (2): ?>
                        <?php break; ?>
                        <?php case (3): ?>
                            An ViSchool zur Freigabe senden
                        <?php break; ?> 
                        <?php default: ?>
                            Privat veröffentlichen (Lehrerfreigabe)
                    <?php endswitch; ?>
                </td>
                <td><?php echo e($topic->status->status_name); ?></td>
                <td>
                    <?php if($topic->status_id != 1): ?>
                <a href="/lehrer/newTopicDelete/<?php echo e($topic->id); ?>"><i class="fas fa-trash"></i></a>
                    <?php else: ?>
                        Thema ist bereits veröffentlicht, löschen ist nicht mehr möglich
                    <?php endif; ?>
                </td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
            <tr>
                <td colspan="5"> <button type="button" class="btn-sm btn-primary" data-toggle="modal" data-target="#newTopicModal">
Ein neues Thema erstellen</button></td>
            </tr>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="newTopicModal" tabindex="-1" role="dialog" aria-labelledby="newTopicModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="/lehrer/themen" enctype="multipart/form-data">
                <?php echo csrf_field(); ?> 
                                
                    <div class="modal-header">
                        <h5 class="modal-title" id="neTopicModalLabel">Ein neues Thema erstellen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">    
                        <input type="hidden" value="<?php echo e($teacher->id); ?>" name="user_id">
                        <div class="form-group<?php echo e($errors->has('topic_title') ? ' has-error' : ''); ?>">
                            <label for="topic_title" class="col-md-4 control-label">Name des Themas</label>
                             <div class="col-10">
                             <input id="topic_title" type="text" class="form-control" name="topic_title" value="<?php echo e(old('topic_title')); ?>" required>
                                <?php if($errors->has('topic_title')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('topic_title')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group<?php echo e($errors->has('subject_id') ? ' has-error' : ''); ?>">
                            <label for="subject_id" class="col-md-4 control-label">Das Thema gehört zum Fach</label>
                             <div class="col-10">
                                <select id="subject_id" class="form-control" name="subject_id" required>
                                <?php if(old('subject_id') != NULL): ?>   
                                <option value="<?php echo e(old('subject_id')); ?>">
                                    <?php $old_subject = App\Subject::findOrFail(old('subject_id'));
                                    ?>
                                    <?php echo e($old_subject->subject_title); ?>

                                </option>
                                <?php endif; ?>
                                <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($subject->id); ?>"><?php echo e($subject->subject_title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('subject_id')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('subject_id')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>         
                    </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                        <button type="submit" class="btn btn-primary">Thema speichern</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
    <?php if(count($errors) > 0): ?>
        $('#newTopicModal').modal('show');
    <?php endif; ?>
</script>  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>