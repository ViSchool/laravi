<?php $__env->startSection('stylesheets'); ?>
   <link rel="stylesheet" href="/css/datepicker.css">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
<section id="page-header">
    <div class="container p-3">
	    <h4>Einen neuen Auftrag erstellen</h4>
    </div>
</section> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <section id="vischool_job">
            <div class="container-fluid my-4">
                <?php if(Session::has('success')): ?>
                    <div class="alert alert-success my-3">
        	            <?php echo e(Session::get('success')); ?>

                    </div>
                <?php endif; ?>
            </div>
            <form action="/lehrer/auftrag/erstellen" method="post" enctype="multipart/form-data">
                <?php echo csrf_field(); ?> 
                <?php echo view('honeypot::honeypotFormFields'); ?>
                

                <div class="card m-5 mx-auto w-75" >
                    <div class="card-header">   
                        <h4 class="m-0 p-0 card-title text-brand-blue justify-content-center d-flex align-items-center">Neuer Auftrag </h4>
                    </div>
                    <div class="card-body">
                        <div class="col-10 mx-auto form-group<?php echo e($errors->has('subject') ? ' invalid' : ''); ?>">
                            <label for="subject_id" class="col-form-label">Welche Lerneinheit möchtest Du Deinen Schülern als Auftrag geben? </label>
                            <label for="subject_id" class="col-form-label">Wähle bitte zunächst das Fach aus:</label>
                            <select class="form-control text-secondary" id="subject_id" name="subject_id">
                                <?php if((old('subject_id')) !== null): ?>
                                    <?php 
                                        $subject_id_old = old('subject_id');
                                        $subject_old = App\Subject::where('id', '=' , $subject_id_old)->first();
                                    ?>
                                    <option value="<?php echo e($subject_id_old); ?>"><?php echo e($subject_old->subject_title); ?></option>
                                <?php endif; ?>
                                <?php if(empty(old('subject_id'))): ?>
                                    <option value="">Bitte hier Fach auswählen</option>
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

                        <div class="col-10 mx-auto form-group<?php echo e($errors->has('unit') ? ' invalid' : ''); ?>">
                            <label for="unit_id" class="col-form-label">Welche Lerneinheit möchtest Du Deinen Schülern als Auftrag geben? </label>
                            <select class="form-control text-secondary" id="unit_id" name="unit_id">
                                <?php if((old('unit_id')) !== null): ?>
                                    <?php 
                                        $unit_id_old = old('unit_id');
                                        $unit_old = App\Unit::where('id', '=' , $unit_id_old)->first();
                                    ?>
                                    <option value="<?php echo e($unit_old->id); ?>"><?php echo e($unit_old->unit_title); ?>></option>                          
                                <?php endif; ?>

                                <?php if(empty(old('unit_id'))): ?>
                                    <option value="">Zuerst Fach auswählen</option>
                                <?php endif; ?>
                                    </select>
                            <?php if($errors->has('unit_id')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('unit_id')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div id="btn_step2" class="d-none col-10 mx-auto form-group">
                            <input name="interaction_btn" type="submit" class="btn-sm btn-light form-control border border-secondary" value="Gewünschte Rückmeldungen festlegen">
                        </div>

                        <?php if(session('unit')): ?>
                            <div id="interactions" class="form-group col-8 mx-auto">
                                <label class="col-form-label">Welche Art von Rückmeldung sollen Deine Schüler Dir geben?</label>
                                <?php $__currentLoopData = $selectedUnit->blocks->sortby('order'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group">
                                        <?php if($block->order !== $block_order_last): ?>
                                        <div class="d-flex flex-row justify-content-start align-items-center">
                                            <label for="block_interaction_id" class="col-form-label"><small>Aufgabe: "<?php echo e($block->title); ?>"</small></label>
                                            <a href="#" data-toggle="modal" data-target="#info_modal">
                                                <span class="ml-3 mt-1"><i class="fas fa-info-circle" style="color: orange"></i></span>
                                            </a>
                                        </div>

                                           <select name="block_interaction_ids[]" id="block_interaction_ids" class="form-control">
                                            <?php $__currentLoopData = $interactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $interaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                           <option value="<?php echo e($block->id); ?>|<?php echo e($interaction->id); ?>|<?php echo e($block->order); ?>"><?php echo e($interaction->interaction_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select> 
                                        <?php else: ?>
                                            <input type="hidden" name="block_interaction_copies[]" id="block_interaction_same" value="<?php echo e($block->id); ?>|<?php echo e($block->order); ?>">
                                        <?php endif; ?>

                                        <?php
                                            $block_order_last = $block->order;
                                        ?>

                                        
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
                                                        <p class="ml-4"><small><?php echo e($block->content->content_title); ?></small></p>
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
                        <?php endif; ?>

                        <div class="col-10 mx-auto form-group<?php echo e($errors->has('student') ? ' invalid' : ''); ?>">
                            <label for="student" class="col-form-label">Welche Klasse oder welcher Schüler soll die Lerneinheit bearbeiten?</label>
                            <select class="form-control text-secondary" id="student_id" name="student_id" placeholder="Klasse oder Schüler auswählen">
                                <?php if((old('student_id')) !== null): ?>
                                    <?php 
                                        $student_id_old = old('student_id');
                                        $student_old = App\Student::where('id', '=' , $student_id_old)->first();
                                    ?>
                                    <option value="<?php echo e($student_old->id); ?>"><?php echo e($student_old->student_name); ?></option>                            
                                <?php else: ?>
                                    <option value="">Bitte Schüler auswählen</option>
                                <?php endif; ?>
                                <optgroup label="Klassen">
                                    <?php $__currentLoopData = $studentgroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $studentgroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($studentgroup->id); ?>_studentgroup"><?php echo e($studentgroup->studentgroup_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </optgroup>
                                <optgroup label="Schüler">
                                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($student->id); ?>_student"><?php echo e($student->student_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </optgroup>
                            </select>
                            <?php if($errors->has('student_id')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('student_id')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>

                        <div class="col-10 mx-auto form-group<?php echo e($errors->has('done_date') ? ' invalid' : ''); ?>">
                            <label for="student" class="col-form-label">Bis wann sollen die Klasse oder der Schüler die Aufgabe erledigt haben? 
                            <div class="input-append date mt-3" id="datepicker"  data-date-format="dd.mm.yyyy">
                            <input class="form-control text-secondary" size="12" type="text" id="done_date" name="done_date" placeholder="Bitte Datum auswählen">
                                <span class="add-on"></span>
                            </div>
                            <?php if($errors->has('done_date')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('done_date')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>

                        
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <div class="col-10 mx-auto form-group">
                            <button type="submit" class="btn-sm btn-primary form-control">Auftrag speichern</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script src="<?php echo e(asset('js/select_subject_unit.js')); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap-datepicker.js')); ?>"> </script>
<script type="text/javascript" src="/js/bootstrap-datepicker.de.js" charset="UTF-8"></script>





<script>
    $(document).ready(function() {
        $('#done_date').click(function() {
            $('#datepicker').datepicker('show');
        });
    });
</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/teacher/teacher_jobCreate.blade.php ENDPATH**/ ?>