<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
<section id="page-header">
    <div class="container p-3">
        <h4>Eine neue Unterrichtseinheit erstellen</h4>
    </div>
</section> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container mt-3">
    <form method="POST" action="/lehrer/unterrichtseinheiten" enctype="multipart/form-data">
    <?php echo csrf_field(); ?> 
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
                <h3 class="text-brand-blue m-3">Schritt 1: Lerneinheit anlegen</h3> 
            </div>
            <div class="card-body">
                
                <div class="form-group<?php echo e($errors->has('unit_title') ? ' has-error' : ''); ?>">
                    <label for="unit_title" class="col-10 control-label">Titel der Lerneinheit</label>
                    <div class="col-10">
                        <input id="unit_title" type="text" class="form-control" name="unit_title" value="<?php echo e(old('unit_title')); ?>" required>
                        <?php if($errors->has('unit_title')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('unit_title')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group<?php echo e($errors->has('unit_description') ? ' has-error' : ''); ?>">
                    <label for="unit_description" class="col-10 col-form-label mb-0 pb-0">Kurzbeschreibung der Lerneinheit</label>
                    <label for="unit_description" class="col-10 col-form-label mt-0 pt-0">
                        <small class="text-muted"> Beschreibe hier kurz was die Schüler mit der Einheit lernen sollen.</small>
                    </label>
                    <div class="col-10">
                        <textarea id="unit_description" class="form-control" name="unit_description"><?php echo e(old('unit_description')); ?></textarea>
                        <?php if($errors->has('unit_description')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('unit_description')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="form-group<?php echo e($errors->has('subject_id') ? ' has-error' : ''); ?>">
                    <label for="topic_id" class="col-10 control-label">Die Unterrichtseinheit gehört zu folgendem Fach</label>
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
                    <label for="topic_id" class="col-10 control-label">Die Unterrichtseinheit gehört zu folgendem Thema</label>
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
                
                <?php if($teacher->differentiation_on == 1): ?>    
                <div class="form-group<?php echo e($errors->has('differentiation_group') ? ' has-error' : ''); ?>">
                    <label for="differentiation_id" class="col-10 control-label">Differenzierung von Lernniveaus</label>
                    <label for="differentiation_id" class="col-10 col-form-label mt-0 pt-0">
                        <small class="text-muted">Wenn die Aufgabe nur von bestimmten Schülern bearbeitet werden soll, dann wähle hier die Gruppe von Lernniveaus aus, die Du für diese Unterrichtseinheit benutzen möchtest. Ansonsten wähle "Keine Differenzierung".</small>
                    </label>
                    <div class="col-10">
                        <select class="form-control" name="differentiation_group" id="differentiation_group">
                            <option value="">Keine Differenzierung</option>
                            <?php if(isset($differentiation_groups)): ?>
                                <?php $__currentLoopData = $differentiation_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $differentiation_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($differentiation_group); ?>"><?php echo e($differentiation_group); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <option value="Standard">Standard</option>
                            
                        </select>
                    </div>
                </div>
                 <?php endif; ?>

            </div>

            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Unterrichtseinheit anlegen</button> 
            </div>
        </div>
    </form>       
</div>    

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script src="<?php echo e(asset('js/ddd_subject_topic.js')); ?>"></script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/teacher/teacher_unitsCreate.blade.php ENDPATH**/ ?>