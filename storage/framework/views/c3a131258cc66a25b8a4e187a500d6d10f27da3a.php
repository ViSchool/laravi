<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
<section id="page-header">
    <div class="container p-3">
	    <h4>Meine individuellen Lernniveaus</h4>
    </div>
</section> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="container mt-3">
    <p>Lernniveaus bieten die Möglichkeit innerhalb einer Lerneinheit einzelne Aufgaben zu differenzieren. Damit kannst Du eine Binnendifferenzierung für Deine Schüler realisieren. Die Namen für die einzelnen Lernniveaus sind jeweils in Gruppen angelegt und Du kannst für Deine Lernniveaus genau die Namen benutzen, die Ihr an Eurer Schule dafür vereinbart habt.</p>
    
    <a href="/lehrer/<?php echo e($teacher->id); ?>/"></a>

    <div class="card-deck">
        <?php $__currentLoopData = $differentiation_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $differentiation_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card mt-5 mb-5" style="width: 200px">
            <div class="card-header">
                <h4 class="text-brand-blue">Gruppe: <?php echo e($differentiation_group); ?></h4> 
            </div>
            <div class="card-body">         
                <?php
                    $differentiations = App\Differentiation::where('differentiation_group',$differentiation_group)->get();  
                ?>
                <p>Zu dieser Gruppe gehören folgende Lernniveaus:</p>
                <ul>
                    <?php $__currentLoopData = $differentiations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $differentiation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($differentiation->differentiation_title); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <form action="/lehrer/<?php echo e($teacher->id); ?>/lernniveaus/löschen/<?php echo e($differentiation_group); ?>" method="POST" enctype="multipart/form-data"> 
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>   
                        <button class="btn-sm" type="submit"><i class="fas fa-trash-alt"></i></button> 
                    </form>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="mb-5">
    <a class="btn-sm btn-primary" data-toggle="collapse" href="#newGroup" role="button" aria-expanded="false" aria-controls="newGroup">Eine neue Gruppe von Lernniveaus anlegen</a>
    </div>

    <div class="collapse multi-collapse" id="newGroup">
        <div class="card mt-5 mb-5" style="width: 300px">
        <form method="POST" action="/lehrer/<?php echo e($teacher->id); ?>/lernniveaus/erstellen" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                    <div class="card-header">
                    <input type="hidden" id="teacher_id" name="teacher_id" value="<?php echo e($teacher->id); ?>">
                        <div class="form-group<?php echo e($errors->has('differentiation_group') ? ' invalid' : ''); ?>">
                            <label for="differentiation_group" class=" col-12 col-form-label text-brand-blue">Name der neuen Gruppe:</label>
                            <div class="col-12">
                                <input id="differentiation_group" type="text" class="form-control" name="differentiation_group" required>
                                <?php if($errors->has('differentiation_group')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('differentiation_group')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>     
                    </div>
                    <div class="card-body">         
                        <div class="form-group<?php echo e($errors->has('differentiations') ? ' invalid' : ''); ?>">
                            <label for="differentiations" class="col-12 col-form-label"> <small>Zu dieser Gruppe gehören folgende Lernniveaus:</small></label>
                                <ul class="list-group list-group-flush ">
                                    <li class="list-group-item border-0 p-2"><input id="differentiation_1" type="text" class="form-control" name="differentiation_1" placeholder="Erstes Lernniveau eintragen" required></li>
                                    <li class="list-group-item border-0 p-2"><input id="differentiation_2" type="text" class="form-control" name="differentiation_2" placeholder="Zweites Lernniveau eintragen" required></li>
                                    <li class="list-group-item border-0 p-2"><input id="differentiation_3" type="text" class="form-control" name="differentiation_3" placeholder="Drittes Lernniveau (optional)"></li>
                                    <li class="list-group-item border-0 p-2"><input id="differentiation_4" type="text" class="form-control" name="differentiation_4" placeholder="Viertes Lernniveau (optional)"></li>
                                    <li class="list-group-item border-0 p-2"><input id="differentiation_5" type="text" class="form-control" name="differentiation_5" placeholder="Fünftes Lernniveau (optional)"></li>
                                </ul>
                                <?php if($errors->has('differentiations')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('differentiation_group')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            <div class="col-12 mb-3 mt-3 d-flex justify-content-end">
                                <button class="btn-sm btn-primary shadow" type="submit"> Lernniveaus speichern</button>
                            </div>
                        </div> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>    


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/teacher/teacher_differentiations.blade.php ENDPATH**/ ?>