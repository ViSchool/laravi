<?php $__env->startSection('stylesheets'); ?>
   <link rel="stylesheet" href="/css/cover.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="container-fluid" style="background-image:url(/images/banner.jpg);">
   <?php if(\Session::has('message')): ?>
    	<div class="mt-3 alert alert-success">
         <p><?php echo \Session::get('message'); ?></p>
    	</div>
	<?php endif; ?>
   <div class="row">
      <div class="col"></div>
      <div class="col-8 col-sm-6">
         <h3 class="text-brand-blue m-5 text-center">Schön, dass Du Dich für die ViSchool anmelden willst.  </h3>
         <h4 class="text-white m-5 text-center">Wir schalten die Anmeldung für Lehrer bald für alle frei.</h4> 
         <h4 class="text-white m-5 text-center">Aber vielleicht können wir Dich schon vorher unterstützen. <br> Hinterlass uns hier Deine Anfrage und wir melden uns bei Dir:</h4>   
      </div>
      <div class="col"></div>
      </div>
   <div class="card m-5 mx-auto" style="width:400px">
      <form method="POST" action="<?php echo e(route('inquiries.store')); ?>" enctype="multipart/form-data">
         <?php echo csrf_field(); ?> 
         <div class="card-header">   
            <h4 class="card-title text-brand-blue text-center">Deine Anfrage</h4>
         </div>
         <div class="card-body">
            <div class="form-group<?php echo e($errors->has('lehrername') ? ' has-error' : ''); ?>">
               <label for="lehrername" class="col-10 control-label">Dein Name:</label>
               <div class="col-10">
                  <input id="lehrername" type="text" class="form-control" name="lehrername" value="<?php echo e(old('lehrername')); ?>">
                  <?php if($errors->has('lehrername')): ?>                        
                     <span class="help-block">
                        <strong><?php echo e($errors->first('lehrername')); ?></strong>
                     </span>
                  <?php endif; ?>
               </div>
            </div>
                     
            <div class="form-group<?php echo e($errors->has('fach') ? ' has-error' : ''); ?>">
               <label for="fach" class="col-10 control-label">Dein Fach:</label>
               <div class="col-10">
                  <input id="fach" type="text" class="form-control" name="fach" value="<?php echo e(old('fach')); ?>" >
                  <?php if($errors->has('fach')): ?>
                     <span class="help-block">
                        <strong><?php echo e($errors->first('fach')); ?></strong>
                     </span>
                  <?php endif; ?>
               </div>
            </div>
                     
            <div class="form-group<?php echo e($errors->has('thema') ? ' has-error' : ''); ?>">
               <label for="thema" class="col-10 control-label">Dein Unterrichtsthema:</label>
               <div class="col-10">
                  <input id="thema" type="text" class="form-control" name="thema" value="<?php echo e(old('thema')); ?>" >
                  <?php if($errors->has('thema')): ?>
                     <span class="help-block">
                        <strong><?php echo e($errors->first('thema')); ?></strong>
                     </span>
                  <?php endif; ?>
               </div>
            </div>
                     
            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
               <label for="email" class="col-10 control-label">Emailadresse unter der wir Dich erreichen:</label>
               <div class="col-10">
                  <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>
                  <?php if($errors->has('email')): ?>
                     <span class="help-block">
                        <strong><?php echo e($errors->first('email')); ?></strong>
                     </span>
                  <?php endif; ?>
               </div>
            </div>
            <small>Wir erheben Deine Daten aus diesem Kontaktformular lediglich, um Dich zu unserem Beratungsangebot per Email zu kontaktieren.  Näheres hierzu kannst Du unserer <a href="/datenschutz#kontakt">Datenschutzerklärung</a>  entnehmen. </small>  
         </div>
         <div class="card-footer d-flex justify-content-end">
            <button type="submit" class="btn-sm btn-primary">Anfrage senden</button>
         </div>
      </form>           
   </div>
</div>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>