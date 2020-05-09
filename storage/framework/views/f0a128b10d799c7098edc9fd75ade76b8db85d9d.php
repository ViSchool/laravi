<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
<section id="page-header">
    <div class="container p-3">
	    <h4>Meine Aufträge</h4>
    </div>
</section> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="container mt-3">
      <h3>Von Dir erstellte Aufträge</h3>
      <p>"Aufträge" sind öffentliche oder private Lerneinheiten, die Du einzelnen Schülern oder ganzen Klassen zur Erledigung zuweisen kannst. Wenn Du einen Auftrag erstellst, dann bekommt jeder Schüler einen entsprechenden Eintrag auf seiner Auftragsliste und kann Dir danach seine Ergebnisse freigeben.  </p>
      <p>Aufträge, die Du erstellst, können nur die Schüler sehen, denen Du Aufträge erteilt hast. </p>
   </div>
   <div class="container">
      <a class="btn btn-primary form-control" href="/lehrer/auftrag/erstellen">Einen neuen Auftrag erstellen</a>
   </div>

   <div class="container mt-3 mb-5">
    <hr> 
    <h3>Diese Aufträge hast Du bereits erstellt:</h3>

    <?php if(isset($tasksByStudentgroup)): ?>
        <?php $__currentLoopData = $tasksByStudentgroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $studentgroup_id  => $tasksByUnits): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($studentgroup_id !== ""): ?>
                <?php
                    $studentgroup = App\Studentgroup::findOrFail($studentgroup_id);
                ?>


                <h3 class="mt-3 text-brand-blue">Aufträge an Klasse: "<?php echo e($studentgroup->studentgroup_name); ?>"</h3>           

                <div class="accordion" id="accordion_<?php echo e($studentgroup->id); ?>">
                    <?php $__currentLoopData = $tasksByUnits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit_id => $tasks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $unit = App\Unit::findOrFail($unit_id);
                        ?>
                        <div class="card">
                            <div class="card-header" id="headingOne">
                            <h2 class="mb-0"><button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse_<?php echo e($unit->id); ?>_<?php echo e($studentgroup->id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($unit->id); ?>_<?php echo e($studentgroup->id); ?>">
                                    <?php echo e($unit->unit_title); ?>

                                </button></h2>
                            </div>

                            <div id="collapse_<?php echo e($unit->id); ?>_<?php echo e($studentgroup->id); ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_<?php echo e($studentgroup->id); ?>">
                                <div class="card-body p-2">
                                    <div class="table table-sm">
                                        <table class="table-responsive-md table-striped my-2 w-100">
                                            <thead class="table-primary">
                                                <th>Schüler</th>
                                                <th>zu erledigen bis</th>
                                                <th>Nachrichten</th>
                                                <th>Stand der Bearbeitung</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $tasks_unique = $tasks->unique('student_id');
                                                ?>
                                                <?php $__currentLoopData = $tasks_unique; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        //Anzahl neuer Nachrichten für diesen Schüler zählen
                                                        $count_news = 0;
                                                        $tasks_student = App\Task::where('student_id',$task->student->id)->where('unit_id',$task->unit->id)->get();
                                                        foreach ($tasks_student as $task_student) {
                                                            $news = count($task_student->results->where('result_viewed',NULL)->where('created_by','student'));
                                                            $count_news = $count_news + $news;
                                                        }
                                                    ?>
                                                    <tr>
                                                        <td><a href="/lehrer/auftraege/schueler/<?php echo e($task->student->id); ?>"><?php echo e($task->student->student_name); ?></a></td>
                                                        <td><?php echo e($task->done_date->formatLocalized('%d. %B %Y')); ?></td>
                                                        <?php if($count_news > 0): ?>
                                                            <?php
                                                                session()->flash('task_news_open', $task->id);
                                                                session()->flash('unit_open',$task->unit->id);
                                                            ?>
                                                            <td><a href="/lehrer/auftraege/schueler/<?php echo e($task->student->id); ?>"> <small> <?php echo e($count_news); ?> Neue Nachrichten </small></a></td>
                                                        <?php else: ?>
                                                            <td><small> <?php echo e($count_news); ?> </small></td>
                                                        <?php endif; ?>
                                                        <td></td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>            
            <?php else: ?> 

                <h3 class="mt-5 text-brand-blue">Aufträge an einzelne Schüler</h3>           
                <div class="accordion" id="accordion_singleStudent">
                    <?php $__currentLoopData = $tasksByUnits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit_id => $tasks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $unit = App\Unit::findOrFail($unit_id);
                        ?>
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h2 class="mb-0"><button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse_<?php echo e($unit->id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($unit->id); ?>">
                                    <?php echo e($unit->unit_title); ?>

                                </button></h2>
                            </div>

                            <div id="collapse_<?php echo e($unit->id); ?>" class="collapse " aria-labelledby="headingOne" data-parent="#accordion_singleStudent">
                                <div class="card-body p-2">
                                    <div class="table table-sm">
                                        <table class="table-responsive-md table-striped my-2 w-100">
                                            <thead class="table-primary">
                                                <th>Schüler</th>
                                                <th>zu erledigen bis</th>
                                                <th>Nachrichten</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $tasks_unique = $tasks->unique('student_id');
                                                ?>
                                                <?php $__currentLoopData = $tasks_unique; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><a href="/lehrer/auftraege/schueler/<?php echo e($task->student->id); ?>"><?php echo e($task->student->student_name); ?></a></td>
                                                        <td><?php echo e($task->done_date); ?></td>
                                                        <td>$task->student->results->count()</td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                
                <div class="modal fade" id="deleteModal_<?php echo e($task->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <?php echo $__env->make('components.deleteCheck',['typeDelete'=>'task','id'=>$task->id, 'title'=>$task->block->unit->unit_title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/teacher/teacher_tasks.blade.php ENDPATH**/ ?>