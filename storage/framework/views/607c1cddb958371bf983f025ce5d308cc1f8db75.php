<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-5">
                <div class="card-header"><?php echo e(__('Bitte bestätige Deine Emailadresse')); ?></div>

                <div class="card-body">
                    <?php if(session('resent')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo e(__('Wir haben Dir eine neue Email mit einem Bestätigungslink geschickt.')); ?>

                        </div>
                    <?php endif; ?>

                    <?php echo e(__('Bevor es weitergeht, würden wir Dich bitten, Deine Emailadresse zu bestätigen.')); ?>

                    <?php echo e(__('Solltest Du die Email nicht erhalten haben, prüfen bitte Deinen Spam-Ordner oder ')); ?>, <a href="<?php echo e(route('verification.resend')); ?>"><?php echo e(__('klick hier um die Email erneut zu senden.')); ?></a>.
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>