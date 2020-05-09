<?php $__env->startSection('stylesheets'); ?>
   <link rel="stylesheet" href="/css/datepicker.css">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
<section id="page-header">
    <div class="container p-3">
	    <h4>Gewünschte Rückmeldungen festlegen </h4>
    </div>
</section> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid my-4">
        <?php if(Session::has('success')): ?>
            <div class="alert alert-success my-3">
        	    <?php echo e(Session::get('success')); ?>

            </div>
        <?php endif; ?>
        <div class="card">
            <form action="/lehrer/auftrag/aufgaben/erstellen" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?> 
                

                
                
                <input type="hidden" name="job_id" value=<?php echo e($job->id); ?>>
                <div id="interactions" class="form-group col-10 mx-auto">
                    <label class="col-form-label">Welche Art von Rückmeldung sollen Dir Deine Schüler zu folgender Lerneinheit geben? </label>
                    <h5 class="col-10 mt-3">"<?php echo e($job->unit->unit_title); ?>"</h5>
                    <?php $__currentLoopData = $blocks->sortBy('order'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="form-group col-10">
                            <div class="d-flex flex-row justify-content-start align-items-center">
                                <?php if(count($blocks->where('order',$block->order)) > 1): ?> 
                                    <label for="block_interaction_id" class="col-form-label"><small>Aufgabe: "<?php echo e($block->title); ?>" <br> (Differenzierung: <?php echo e($block->differentiation->differentiation_title); ?>)</small></label>
                                <?php else: ?>
                                    <label for="block_interaction_id" class="col-form-label"><small>Aufgabe: "<?php echo e($block->title); ?>"</small></label>
                                <?php endif; ?>
                                <a href="#" data-toggle="modal" data-target="#info_modal">
                                    <span class="ml-3 mt-1"><i class="fas fa-info-circle" style="color: orange"></i></span>
                                </a>
                            </div>

                            <select name="block_interaction_ids[]" id="block_interaction_ids" class="form-control">
                                <?php $__currentLoopData = $interactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($block->id); ?>|<?php echo e($interaction->id); ?>"><?php echo e($interaction->interaction_name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>

                            
                            <div class="modal fade" id="info_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><?php echo e($block->title); ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Aufgabe:</p>
                                            <p class="ml-4"><small><?php echo $block->task; ?></small></p>
                                            <hr>
                                            <p>Inhalt:</p>
                                            <?php if($block->content_id !== NULL): ?> 
                                                <p class="ml-4"><a target="_blank" href="/content/<?php echo e($block->content->id); ?>"><small><?php echo e($block->content->content_title); ?></small></a></p>
                                            <?php else: ?>
                                                <p class="ml-4"><small>Diese Aufgabe enthält keinen digitalen Inhalt.</small></p>
                                            <?php endif; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="col-10 mx-auto form-group<?php echo e($errors->has('assignment') ? ' invalid' : ''); ?>">
                    <label for="assignment" class="col-form-label">Du kannst den Auftrag Deinen Schülern sofort anzeigen oder in Deiner Auftragsübersicht später aktivieren. Wähle aus:</label>
                    <div class="  d-flex flex-column justify-content-between px-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="assignment" id="inlineRadio1" value="sofort" checked>
                            <label class="form-check-label" for="inlineRadio1"><small>Sofort</small> </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="assignment" id="inlineRadio2" value="spaeter">
                            <label class="form-check-label" for="inlineRadio2"><small>Später</small> </label>
                        </div>
                    </div>
                    <?php if($errors->has('assignment')): ?>
                        <span class="help-block">
                            <strong><?php echo e($errors->first('assignment')); ?></strong>
                        </span>
                    <?php endif; ?>
                </div>

                <div class="card-footer d-flex justify-content-end">
                    <div class="col-10 mx-auto form-group">
                        <button type="submit" class="btn-sm btn-primary form-control">Auftrag speichern</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/teacher/teacher_tasksCreate.blade.php ENDPATH**/ ?>