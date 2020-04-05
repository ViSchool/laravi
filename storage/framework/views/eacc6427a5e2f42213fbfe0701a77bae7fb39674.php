<?php $__env->startSection('page-header'); ?>
<section id="page-header">
    <div class="container p-3">
    <h4>Wir helfen Dir</h4>
    </div>
</section> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section id="vischool_support">    
    <div class="container-fluid my-4">
         <?php if(Session::has('success')): ?>
            <div class="alert alert-success my-3">
        	    <?php echo e(Session::get('success')); ?>

            </div>
        <?php endif; ?>
        <p class="w-75 mx-auto">Hier geht es zu unseren <a href="/faq">FAQ</a> . Vielleicht findest Du ja auch hier Hilfe. </p>

        <form action="/support" method="post" enctype="multipart/form-data">
             <?php echo csrf_field(); ?> 
             <?php echo view('honeypot::honeypotFormFields'); ?>
            <div class="card m-5 mx-auto w-75" >
                <div class="card-header">   
                    <h4 class="m-0 p-0 card-title text-brand-blue justify-content-center d-flex align-items-center">Wie können wir Dir helfen ? </h4>
                </div>
                <div class="card-body">
                    <div class="col-10 mx-auto form-group<?php echo e($errors->has('lehrername') ? ' invalid' : ''); ?>">
                        <label for="lehrername" class="col-form-label">Dein Name:</label>
                        <input id="lehrername" type="text" class="form-control" name="lehrername" value="<?php echo e(old('lehrername')); ?>" autofocus>
                        <?php if($errors->has('lehrername')): ?>                        
                            <span class="help-block">
                                <strong><?php echo e($errors->first('lehrername')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                     
                    <div class=" col-10 mx-auto form-group<?php echo e($errors->has('fach') ? ' invalid' : ''); ?>">
                        <label for="fach" class="col-form-label">Dein Fach:</label>
                        <input id="fach" type="text" class="form-control" name="fach" value="<?php echo e(old('fach')); ?>" >
                        <?php if($errors->has('fach')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('fach')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                     
                    <div class="col-10 mx-auto form-group<?php echo e($errors->has('thema') ? ' invalid' : ''); ?>">
                        <label for="thema" class="col-form-label">Dein Unterrichtsthema:</label>
                        <input id="thema" type="text" class="form-control" name="thema" value="<?php echo e(old('thema')); ?>" >
                        <?php if($errors->has('thema')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('thema')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                     
                    <div class="col-10 mx-auto form-group<?php echo e($errors->has('email') ? ' invalid' : ''); ?>">
                        <label for="email" class="col-form-label">Emailadresse unter der wir Dich erreichen:</label>
                        <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>
                        <?php if($errors->has('email')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('email')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="col-10 mx-auto form-group<?php echo e($errors->has('phone') ? ' invalid' : ''); ?>">
                        <label for="phone" class="col-form-label">Falls Du möchtest, dass wir Dich anrufen, hinterlasse uns hier Deine Telefonnummer:</label>
                        <input type="tel" id="phone" name="phone"  placeholder="Format: 0171-1234567" class="form-control" value="<?php echo e(old('phone')); ?>">
                        <?php if($errors->has('email')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('email')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="col-10 mx-auto form-group<?php echo e($errors->has('email') ? ' invalid' : ''); ?>">
                        <label for="message" class="col-form-label">Deine Nachricht:</label>
                        <textarea id="message" rows="10" class="form-control" name="message" placeholder="Liebes ViSchool-Team,  ich interessiere mich für Lerneinheiten in Mathe für die 6. Klasse zum Thema ..... "><?php echo e(old('message')); ?></textarea>
                        <?php if($errors->has('message')): ?>
                            <span class="help-block">
                                <strong><?php echo e($errors->first('message')); ?></strong>
                            </span>
                        <?php endif; ?>
                    </div>
                    <small>Wir erheben Deine Daten aus diesem Kontaktformular lediglich, um Dich zu unserem Supportangebot zu kontaktieren.  Näheres hierzu kannst Du unserer <a href="/datenschutz#kontakt">Datenschutzerklärung</a>  entnehmen. </small>  
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn-sm btn-primary">Nachricht senden</button>
                </div>    
            </form>           
   </div>
</div>
  


            </form>
        </div>
    </div>  
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/frontend/support/support.blade.php ENDPATH**/ ?>