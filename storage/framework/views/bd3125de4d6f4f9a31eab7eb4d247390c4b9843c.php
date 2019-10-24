<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
<section id="page-header">
    <div class="container p-3">
	    <h4>Mein Lehrerkonto</h4>
    </div>
</section> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php
 $teacher_id = $teacher->id;   
?>
<div class="container mt-3">
     <?php if(\Session::has('message')): ?>
        <div class="alert alert-warning">
            <p><?php echo \Session::get('message'); ?></p>
    	</div>
	<?php endif; ?>
    <div class="card mt-5 mb-5">
        <div class="card-header text-center">
            <h3 class="text-brand-blue m-3">Hallo <?php echo e($teacher->teacher_name); ?>! </h3> 
        </div>
        <div class="card-body">
            <h4 class="card-title mb-5">Mit folgenden Daten bist Du selbst bei der ViSchool registriert:</h4>
            <div class="row d-flex align-items-center mb-3">
                <label for="email" class="col-4">Name</label>
                <input id="email" type="email" class="col-6" name="email" value="<?php echo e($teacher->teacher_name); ?> <?php echo e($teacher->teacher_surname); ?>" readonly>
            </div> 
            <div class="row d-flex align-items-center mb-3">
                <label for="email" class="col-4">E-Mail Adresse</label>
                <input id="email" type="email" class="col-6" name="email" value="<?php echo e($teacher->email); ?>" readonly>
            </div>
            <div class="row d-flex align-items-center mb-3">
                <label for="email" class="col-4">ViSchool-Schulaccount</label>
                <input id="email" type="email" class="col-6" name="email" value="
                    <?php if(isset($teacher->school_id)): ?> 
                        <?php echo e($teacher->school->school_name); ?>

                    <?php else: ?> Kein Schulaccount zugeordnet
                    <?php endif; ?>
                    " readonly>
            </div> 
            <div class="row d-flex align-items-center mb-3">
                <label class="col-4">Passwort ändern? </label>
                <!-- Button trigger modal -->
                <button type="button" class="btn-sm btn-primary" data-toggle="modal" data-target="#passwordModal">Passwort ändern</button>
               

                <!-- Modal -->
                <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="POST" action="/lehrer/<?php echo e($teacher_id); ?>/passwortaendern" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>     
                                <div class="modal-header">
                                    <h5 class="modal-title" id="passwordModalLabel">Passwort ändern</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">    
                                    <div class="form-group<?php echo e($errors->has('oldpassword') ? ' has-error' : ''); ?>">
                                        <label for="oldpassword" class="col-md-4 control-label">Altes Passwort</label>
                                        <div class="col-md-12">
                                            <input id="oldpassword" type="password" class="form-control" name="oldpassword" required>
                                            <?php if($errors->has('oldpassword')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('oldpassword')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>                                         
                                    <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                        <label for="password" class="col-md-4 control-label">Neues Passwort</label>
                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control" name="password" required>
                                            <?php if($errors->has('password')): ?>
                                                <span class="help-block">
                                                    <strong><?php echo e($errors->first('password')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm" class="col-md-4 control-label">Neues Passwort bestätigen</label>
                                        <div class="col-md-12">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                                    <button type="submit" class="btn btn-primary">Neues Passwort speichern</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <h3 class="mt-3 mb-5">Einstellungen</h3>
            <div class="form-group">
                <div class="row d-flex align-items-center">
                    <label class="col-7">Individuelle Lernniveaus nutzen</label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox"  
                        <?php if($teacher->differentiation_on == 1): ?>
                            checked="checked"
                        <?php endif; ?>
                        class="custom-control-input" id="differentiationSwitch" name="differentiation_on">
                        <label class="custom-control-label" for="differentiationSwitch"></label>
                    </div>
                </div>
                <div id="editDiff" 
                    <?php if($teacher->differentiation_on == 1): ?> 
                        class="d-block" 
                    <?php else: ?>
                        class="d-none"
                    <?php endif; ?>>
                    <div  class="row d-flex align-items-center">
                        <small class="col-7 mb-3"> <a href="/lehrer/<?php echo e($teacher->id); ?>/lernniveaus/übersicht">Individuelle Lernniveaus bearbeiten</a></small>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row d-flex align-items-center mb-3">
                    <label class="col-7">Newsletter abbonieren? </label>
                    <div class="custom-control custom-switch">
                        <input type="checkbox"  class="custom-control-input" id="customSwitch2" name="newsletter">
                        <label class="custom-control-label" for="customSwitch2"></label>
                    </div>
                </div>
            </div>            
            <hr>
            <h3 class="mt-3 mb-5">Statistik</h3>
            <div class="row d-flex align-items-center mb-3">
                <label for="units" class="col-7">alle Unterrichtseinheiten:</label>
                <input id="units" type="number" class="col-2 text-center"  value="<?php echo e($teacher->units->count()); ?>" readonly>
            </div>
            <div class="row d-flex align-items-center mb-3">
                <p class="col-7">davon private Unterrichtseinheiten:</p>
                <input id="units" type="number" class="col-2 text-center"  value="<?php echo e($teacher->units->where('status_id', 3)->count()); ?>" readonly>
            </div>
            <div class="row d-flex align-items-center mb-3">
                <label for="contents" class="col-7">Inhalte:</label>
                <input id="contents" type="number" class="col-2 text-center"  value="<?php echo e($teacher->contents->count()); ?>" readonly>
            </div>
            <div class="row d-flex align-items-center mb-5">
                <label for="contents" class="col-7">Themen:</label>
                <input id="contents" type="number" class="col-2 text-center"  value="<?php echo e($teacher->topics->count()); ?>" readonly>
            </div>
            <div class="row d-flex align-items-center mt-5 mb-3">
                <label for="contents" class="col-7">Schüleraccounts:</label>
                <input id="contents" type="number" class="col-2 text-center"  value="<?php echo e($studentsCount); ?>" readonly>
            </div>
            <div class="row d-flex align-items-center mb-3">
                <label for="contents" class="col-7">Klassenaccounts:</label>
                <input id="contents" type="number" class="col-2 text-center"  value="<?php echo e($classCount); ?>" readonly>
            </div>

        </div>
        <div class="card-footer text-muted pt-5">
           Registriert: <?php echo e(\Carbon\Carbon::parse($teacher->created_at)->diffForHumans()); ?>

        </div>
    </div>
</div>    


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $('document').ready(function () {
   $('#differentiationSwitch').change(function () {
      var diffOn = $('#differentiationSwitch').prop('checked');
      console.log(diffOn);
      var teacherId = <?php echo json_encode($teacher->id); ?>;
      console.log(teacherId);
      if (diffOn == true) {
         $('#editDiff').removeClass('d-none');
         $('#editDiff').addClass('d-block');
         var saveData = $.ajax({
                url: '/lehrer/profile/diffOn/'+teacherId,
                type: "GET",
                complete:function(jqXHR, textStatus) {console.log("completed:"+ textStatus)}
        });
      }
      else {
         $('#editDiff').removeClass('d-block');
         $('#editDiff').addClass('d-none');
         var saveData = $.ajax({
                url: '/lehrer/profile/diffOff/'+teacherId,
                type:"GET",
                complete:function(jqXHR, textStatus) {console.log("completed:"+ textStatus)}
        });
      }
   });
});

</script>    

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/teacher/teacher_profile.blade.php ENDPATH**/ ?>