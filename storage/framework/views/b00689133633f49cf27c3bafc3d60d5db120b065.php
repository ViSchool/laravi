<?php $__env->startSection('content'); ?>
<div class="container d-flex justify-content-center">
    <div class="col-md-10">
        <div class="card mb-3">
            <div class="card-header bg-white">
                <p>Schüler Login</p> 
                <small>Deine Login-Daten erhälst Du von Deinem Lehrer oder Deiner Lehrerin.</small>
            </div>
            <div class="card-body">
                <form class="" method="POST" action="<?php echo e(route('students.login.submit')); ?>">
                <?php echo csrf_field(); ?>
                    <div class=" form-row form-group<?php echo e($errors->has('email') ? ' invalid' : ''); ?>">
                        <label for="student_name" class="col-md-4 col-form-label">Dein Benutzername</label>
                        <div class="col-md-6">
                            <input id="student_name" type="text" class="form-control" name="student_name" value="<?php echo e(old('student_name')); ?>" required autofocus>
                            <?php if($errors->has('email')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('email')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class=" form-row form-group<?php echo e($errors->has('password') ? ' invalid' : ''); ?>">
                        <label for="password" class="col-md-4 col-form-label">Passwort</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>
                            <?php if($errors->has('password')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>

                    
                    <div class="form-row form-group">
                        <div class="col-md-8">
                            <button type="submit" class="text-right btn btn-primary">
                                Anmelden
                            </button>
                            
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/auth/student-login.blade.php ENDPATH**/ ?>