<?php $__env->startSection('stylesheets'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
<section id="page-header">
    <div class="container p-3">
        <h4>Aufgabe zur Unterrichtseinheit "<?php echo e($block->unit->unit_title); ?>" bearbeiten</h4>
    </div>
</section> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container mt-3">
<form method="POST" action="/lehrer/unterrichtseinheiten/aufgabe/bearbeiten/<?php echo e($block->id); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
        <input type="hidden" name="block_id" value="<?php echo e($block->id); ?>">
        <input type="hidden" value="<?php echo e($teacher->id); ?>" name="user_id">
        <input 
            type="hidden" 
            name="teacherOrStudent" 
            <?php if($teacher->teacher_id == $teacher->id): ?>
                value="teacher" 
            <?php else: ?> 
                value="student"
            <?php endif; ?>    
        >
        <div class="card mb-3">
            <div class="card-header text-center">
                <h3 class="text-brand-blue m-3">Aufgabe bearbeiten</h3> 
            </div>
            <div class="card-body">
                
                <div class="form-group<?php echo e($errors->has('block_title') ? ' has-error' : ''); ?>">
                    <label for="block_title" class="col-10 control-label">Überschrift für die Aufgabe</label>
                    <div class="col-10">
                        <input id="block_title" type="text" class="form-control" name="block_title" value="<?php echo e($block->title); ?>" required>
                        <?php if($errors->has('block_title')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('block_title')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group<?php echo e($errors->has('task') ? ' has-error' : ''); ?>">
                    <label for="task" class="col-10 col-form-label mb-0 pb-0">Aufgabentext</label>
                    <label for="task" class="col-10 col-form-label mt-0 pt-0">
                        <small class="text-muted"> Schreibe hier möglichst präzise, was der Schüler tun soll, z.B.: <span class="text-muted font-italic">Schau Dir das folgende Video an.</span> </small>
                    </label>
                    <div class="col-10">
                        <textarea id="task" class="form-control" name="task"><?php echo e($block->task); ?></textarea>
                        <?php if($errors->has('task')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('task')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group<?php echo e($errors->has('content_id') ? ' has-error' : ''); ?>">
                    <label for="content_id_button" class="col-10 col-form-label mb-0 pb-0">Digitalen Inhalt hinzufügen (optional)</label>
                    <label for="content_id_button" class="col-10 col-form-label mt-0 pt-0">
                        <small class="text-muted"> Wenn Du der Aufgabe einen digitalen Inhalt hinzufügen willst, such Dir über den Button einen Inhalt aus.</small>
                    </label>
                    <div class="col-10 d-flex justify-content-start">
                        <textarea readonly style="font-size: 80%;" class="col-7 mr-3" id="content_title" name="content_title" placeholder="Du hast noch keinen Inhalt ausgesucht"></textarea>
                        <input type="hidden" id="content_id" name="content_id">
                        <button  id="content_id_button" type="button" class=" btn-sm btn-primary form-control" data-toggle="modal" data-target="#chooseContentModal">
                            Inhalt aussuchen
                        </button>
                    </div>
                </div>

                <div id="chosenContent" class="form-group">
                </div>

                <div class="modal fade" id="chooseContentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalScrollableTitle">Inhalt aussuchen</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <small>Hier werden die alle Inhalte zu dem von Dir gewählten Thema angezeigt, wenn Du einen Inhalt eines anderen Themas einfügen willst, wähle hier ein anderes Fach und oder Thema aus.</small>


                                <div class="row">
                                <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 
                                    <div class="col">
                                        <?php echo $__env->make('teacher.teacher_components.choose_content_card', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                                <button data-toggle="modal" data-target="#chooseContentModal" id="chooseContentModalSave" type="button" class="btn btn-primary">Speichern</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group<?php echo e($errors->has('time') ? ' has-error' : ''); ?>">
                    <label for="time" class="col-10 control-label">Zeit für die Aufgabe</label>
                    <div class="col-10">
                        <input id="time" type="number" class="form-control" name="time" value="<?php echo e($block->time); ?>" required>
                        <?php if($errors->has('time')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('time')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group<?php echo e($errors->has('tipp') ? ' has-error' : ''); ?>">
                    <label for="task" class="col-10 col-form-label mb-0 pb-0">Tipp (optional)</label>
                    <label for="task" class="col-10 col-form-label mt-0 pt-0">
                        <small class="text-muted"> Hier kannst Du den Schülern noch einen Tipp für Ihre Aufgabe mitgeben.</small>
                    </label>
                    <div class="col-10">
                        <textarea id="tipp" class="form-control" name="tipp"><?php echo e($block->tips); ?></textarea>
                        <?php if($errors->has('tipp')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('tipp')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if($block->unit->differentiation_group != NULL): ?>
                <div class="form-group<?php echo e($errors->has('differentiation_id') ? ' has-error' : ''); ?>">
                    <label for="differentiation_id" class="col-10 control-label">Differenzierung von Lernniveaus</label>
                    <label for="differentiation_id" class="col-10 col-form-label mt-0 pt-0">
                        <small class="text-muted">Die Aufgabe kann für unterschiedliche Lernniveaus der Gruppe <span class="font-weight-bold">"<?php echo e($block->unit->differentiation_group); ?>"</span> differenziert werden. Wähle hier das entsprechende Niveau aus oder wähle "Alle", wenn keine Differenzierung erfolgen soll.</small>
                    </label>
                    <div class="col-10">
                        <select class="form-control" id="differentiation_id" name="differentiation_id">
				            <?php if($block->differentiation_id !== null): ?>
                                <?php 
                                    $differentiation_id_old = $block->differentiation_id;
                                    $differentiation_old = App\Differentiation::where('id', '=' , $differentiation_id_old)->first();
                                ?>
                                <option value="<?php echo e($differentiation_id_old); ?>"><?php echo e($differentiation_old->differentiation_title); ?></option>
				            <?php endif; ?>
		                    <?php if(empty($block->differentiation_id)): ?>
                                <option value=""></option>
                            <?php endif; ?>
                            <?php $__currentLoopData = $differentiations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $differentiation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($differentiation->id); ?>"><?php echo e($differentiation->differentiation_title); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                            
                        <?php if($errors->has('differentiation_id')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('differentiation_id')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>  
                <?php endif; ?>              
            </div>            
                
            <div class="card-footer d-flex justify-content-between">
                <a href="/lehrer/unterrichtseinheiten" class="btn btn-outline-danger">Abbrechen</a>
                <button type="submit" class="btn btn-primary">Änderungen speichern</button> 
            </div>
        </div>
</form>       
</div>    



<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script src="<?php echo e(asset('js/ddd_subject_topic.js')); ?>"></script>
<script>
    $('#chooseContentModal').ready(function() {
        $('#chooseContentModalSave').click(function(){
            var radios = $('input[name=chooseContent]');
            for (var i=0, length = radios.length; i< length; i++)
            {
                if (radios[i].checked) 
                {
                    var contentIdBack = radios[i].value;
                    break;
                }
            }
            if(contentIdBack) {
                $.ajax({
                url: '/chosencontent/get/'+contentIdBack,
                type:"GET",
                dataType:"json",
                success:function(data) {
                        $('#content_title').val(data);
                        },
                });
            };
        });
    });
</script>

<script src="<?php echo e(asset('js/add_alternative_div.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>