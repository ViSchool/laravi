<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-5">
                <div class="card-header"><?php echo e(__('Vielen Dank!')); ?></div>

                <div class="card-body">
                    Vielen Dank, Deine Emailadresse wurde verifiziert. Du kannst Dich jetzt die Lehrerfunktione von ViSchool nutzen. 
                </div>
                <div class="card-footer text-center">
                    <a  class="btn btn-primary" href="/">Zur Startseite</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/teacher/teacher_verified.blade.php ENDPATH**/ ?>