<?php $__env->startSection('content'); ?>
<div class="container d-flex justify-content-center">
    <div class="col-md-10">
        <div class="card mb-3">
            <div class="card-header bg-white">Bitte melde Dich mit Deinem Lehrer-Account an:</div>
            <div class="card-body">
                <form class="" method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>
                    <div class=" form-row form-group<?php echo e($errors->has('email') ? ' invalid' : ''); ?>">
                        <label for="email" class="col-md-4 col-form-label">E-Mailadresse</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
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

                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Eingeloggt bleiben
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <div class="col-md-8">
                            <button type="submit" class="text-right btn btn-primary">
                                Anmelden
                            </button>
                            <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                Passwort vergessen?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/auth/login.blade.php ENDPATH**/ ?>