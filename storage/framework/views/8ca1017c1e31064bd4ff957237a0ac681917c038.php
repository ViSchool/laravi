<?php $__env->startSection('stylesheets'); ?>
<!-- Select2 -->
<link href="/css/select2.css" rel="stylesheet">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
<section id="page-header">
    <div class="container p-3">
	    <h4>Meine Klassenaccounts</h4>
    </div>
</section> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="container mt-3">
    <h3>Klassenaccounts</h3>
    <p>Mit einem "Klassenaccounts" kannst Du Deine privat veröffentlichten Inhalte auch Deiner Klasse zugänglich machen. Der Vorteil: Du brauchst nicht auf die Freigabe von ViSchool warten, sondern kannst sofort loslegen mit Deinen Themen, Inhalten und Lerneinheiten. Für einen Klassenaccount brauchst Du nur einen Nutzernamen und ein Passwort anlegen. Dieses gibst Du Deinen Schülern. Sobald Du den Zugang wieder sperren willst, lösche den Zugang einfach wieder hier. 
    </p>
</div>
<div class="container">
    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th scope="col">Benutzername</th>
                <th scope="col">Zugang beschränken auf</th>
                <th scope="col">löschen</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
             <tr>   
                <td><?php echo e($class->student_name); ?></td>
                <td>
                </td>
                <td>
                    <form action="/lehrer/klassenaccount/loeschen/<?php echo e($class->id); ?>" method="post">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button class="btn text-brand-red" type="submit"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
            <tr>
                <td colspan="5"> 
                    <button type="button" class="btn-sm btn-primary" data-toggle="modal" data-target="#newGroupModal">
                        Einen neuen Klassenaccount erstellen
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="newGroupModal"  role="dialog" aria-labelledby="newGroupModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="/lehrer/klassenaccount/erstellen" enctype="multipart/form-data">
                <?php echo csrf_field(); ?> 
                                
                    <div class="modal-header">
                        <h5 class="modal-title" id="newGroupModalLabel">Einen neuen Klassenaccount erstellen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">    
                        <input type="hidden" value="<?php echo e($teacher->id); ?>" name="user_id">
                        <input type="hidden" value="1" name="class_account">
                        <div class="form-group<?php echo e($errors->has('student_name') ? ' invalid' : ''); ?>">
                            <label for="student_name" class="col-md-4 col-form-label">Benutzername für den Klassenaccount</label>
                             <div class="col-10">
                             <input id="student_name" type="text" class="form-control" name="student_name" value="<?php echo e(old('student_name')); ?>" required>
                                <?php if($errors->has('student_name')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('student_name')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' invalid' : ''); ?>">
                            <label for="password" class="col-md-4 col-form-label">Passwort für den Klassenaccount</label>
                             <div class="col-10">
                             <input id="password" type="text" class="form-control" name="password" required>
                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        

                    </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                        <button type="submit" class="btn btn-primary">Klassenaccount speichern</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>




<?php $__env->startSection('scripts'); ?>

<script type="text/javascript">
    <?php if(count($errors) > 0): ?>
        $('#newGroupModal').modal('show');
    <?php endif; ?>
</script> 

<script>
$(document).ready(function() {
    $('.select2-multi').select2({
        dropdownParent: $('#newGroupModal'),
        tags: true
    });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/teacher/teacher_classaccount.blade.php ENDPATH**/ ?>