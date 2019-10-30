<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
<section id="page-header">
    <div class="container p-3">
	    <h4>Meine Lerneinheiten</h4>
    </div>
</section> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



<div class="container mt-3">
    <h3>Deine selbst erstellten Lerneinheiten</h3>
    <p>"Lerneinheiten" sind fertige Unterrichtsblöcke, die Schüler selbständig benutzen und bearbeiten können. Du kannst sie im Unterricht einsetzen, aber auch als Hausaufgabe oder für das selbständige Lernen. Wenn Du verschiedene Lerneinheiten zusammenfassen willst, kannst Du sie einer Serie zuordnen. Dann können Schüler nacheinander die einzelnen Unterrichtseinheiten bearbeiten. 
    </p>
    <p>Lerneinheiten, die Du erstellst, findest Du zunächst nur in Deinem privaten Bereich. Das heißt nur Du und die von Dir erstellten Klassenaccounts können diesen Inhalt sehen. Möchtest Du, dass der Inhalt auch auf der öffentlichen ViSchool-Seite zu sehen ist, musst Du die Lerneinheit zur Veröffentlichung von der ViSchool freigeben lassen. Auch vor der Freigabe kannst Du die Unterrichtseinheit in Deinem Unterricht einsetzen. Unterrichtseinheiten, die einen nicht von der ViSchool freigegebenen Inhalte enthalten, können auch nur in Deinem privaten Bereich angezeigt werden.</p>
</div>
<div class="container">
    <a class="btn btn-primary form-control" href="/lehrer/unterrichtseinheiten/erstellen">Eine neue Lerneinheit erstellen</a>
</div>

<!--Anzeige der Inhalte-->


<div class="container mt-3 mb-5">
    <hr> 
    <h3>Diese Lerneinheiten hast Du bereits erstellt:</h3>
    <?php $__currentLoopData = $unitsBySubject; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject_id => $units): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $subject = App\Subject::findOrFail($subject_id);?>
        <h3 class="mt-3 text-brand-blue"><?php echo e($subject->subject_title); ?></h3>           
        <div class="table">
            <table class="table-responsive-lg table-striped my-5 w-100">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Titel der Lerneinheit</th>
                        <th scope="col">Thema</th>
                        <th scope="col">gehört zur Serie</th>
                        <th class="text-center" scope="col">Anzahl <br> der <br> Aufgaben</th>
                        <th class="text-center" scope="col">Aktionen</th>
                        <th scope="col">Status</th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="p-5">   
                        <td ><?php echo e($unit->unit_title); ?></td>
                        <td><?php echo e($unit->topic->topic_title); ?></td>
                        <td>
                            <div class="dropdown">
                                <?php if($unit->serie_id > 0): ?>
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownSerieButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e($unit->serie->serie_title); ?></button>
                                <?php else: ?>
                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownSerieButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Serie auswählen</button>
                                <?php endif; ?>
                                <div class="dropdown-menu mb-3" aria-labelledby="dropdownSerieButton" id="serie">
                                    <?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a class="dropdown-item" title="<?php echo e($serie->serie_description); ?>" href="/lehrer/unterrichtseinheiten/<?php echo e($unit->id); ?>/serie/<?php echo e($serie->id); ?>"><?php echo e($serie->serie_title); ?></a> 
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <a class="dropdown-item"  href="/lehrer/unterrichtseinheiten/<?php echo e($unit->id); ?>/keineSerie">Gehört zu keiner Serie</a> 
                                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#serieModal_<?php echo e($unit->id); ?>">Neue Serie erstellen</button>     
                                </div>
                            </div>
                        </td>
                        <td class="text-center"><?php echo e($unit->blocks->count()); ?></td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aktion auswählen</button>
                                <div class="dropdown-menu mb-3" aria-labelledby="dropdownMenuButton" id="actions">
                                     <?php switch($unit->status_id):
                                        case (1): ?>
                                        <?php break; ?>
                                        <?php case (2): ?>
                                        <?php break; ?>
                                        <?php case (3): ?>
                                             <a class="dropdown-item" title="An Vischool zur Veröffentlichung senden" href="/lehrer/newUnitViSchool/<?php echo e($unit->id); ?>"><i class="fas fa-upload"></i> Veröffentlichung bei ViSchool </a> 
                                        <?php break; ?> 
                                        <?php default: ?>
                                            <a class="dropdown-item" title="Auf meiner privaten Lehrerseite veröffentlichen" href="/lehrer/newUnitPrivate/<?php echo e($unit->id); ?>"><i class="fas fa-user-check"></i> Auf meiner privaten Seite veröffentlichen</a>
                                    <?php endswitch; ?>

                                    <?php if($unit->status_id == 5): ?>
                                        <a class="dropdown-item" title="Lerneinheit bearbeiten" href="/lehrer/unterrichtseinheiten/bearbeiten/<?php echo e($unit->id); ?>"><i class="far fa-edit"></i> Lerneinheit bearbeiten</a>
                                    <?php endif; ?>
                                    <button class="disabled dropdown-item" type="button" title="Eine Vorschau der Lerneinheit einblenden" data-toggle="modal" data-target="#previewModal"><i class="fas fa-glasses"></i> Vorschau</button>
                                    <?php if($unit->status_id > 2): ?>
                                    <a class="dropdown-item" title="Aufgabe hinzufügen" href="/lehrer/unterrichtseinheiten/<?php echo e($unit->id); ?>/aufgabe"><i class="far fa-plus-square"></i> Aufgabe hinzufügen</a>
                                    <a class="dropdown-item" title="Aufgabe hinzufügen" href="/lehrer/unterrichtseinheiten/<?php echo e($unit->id); ?>/aufgaben"><i class="far fa-edit"></i> Aufgabe(n) bearbeiten</a>
                                    <button class="dropdown-item mb-3" type="button" title="Lerneinheit löschen" data-toggle="modal" data-target="#deleteModal_<?php echo e($unit->id); ?>"><i class="fas fa-trash"></i> Lerneinheit komplett löschen</button>
                                        
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td><?php echo e($unit->status->status_name); ?></td>
                    </tr>
                    
                    
                    <div class="modal fade" id="deleteModal_<?php echo e($unit->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <?php echo $__env->make('components.deleteCheck',['typeDelete'=>'unit','id'=>$unit->id, 'title'=>$unit->unit_title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    

                    
                    <div class="modal fade" id="serieModal_<?php echo e($unit->id); ?>" tabindex="-1" role="dialog" aria-labelledby="serieModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="serieModalLabel">Serie erstellen</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form method="POST" action="unterrichtseinheiten/serie/erstellen">
                                    <?php echo csrf_field(); ?>
                                    <div class="modal-body">
                                        <input type="hidden" id="unit_id" name="unit_id" value="<?php echo e($unit->id); ?>">
                                        <div class="form-group<?php echo e($errors->has('serie_title') ? ' invalid' : ''); ?>">
                                            <label for="serie_title" class="col-md-4 col-form-label">Name der Serie</label>
                                            <div class="col-10">
                                                <input id="serie_title" type="text" class="form-control" name="serie_title" value="<?php echo e(old('serie_title')); ?>" required>
                                                <?php if($errors->has('serie_title')): ?>
                                                    <span class="help-block">
                                                        <strong><?php echo e($errors->first('serie_title')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group <?php echo e($errors->has('serie_description') ? 'invalid' : ''); ?>">
                                            <label for="serie_description" class="col-md-4 col-form-label">Kurze Beschreibung zum Inhalt der Serie</label>
                                            <div class="col-10">
                                                <textarea id="serie_description" class="form-control" name="serie_description"><?php echo e(old('serie_description')); ?></textarea>
                                                <?php if($errors->has('serie_description')): ?>
                                                    <span class="help-block">
                                                        <strong><?php echo e($errors->first('serie_description')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>     
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                                        <button type="sumbmit" class="btn btn-primary">Serie speichern</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    


                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                </tbody>     
            </table>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>  

<script src="<?php echo e(asset('js/ddd_subject_topic.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/teacher/teacher_units.blade.php ENDPATH**/ ?>