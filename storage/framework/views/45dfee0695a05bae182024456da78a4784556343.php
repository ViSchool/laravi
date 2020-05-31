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

    <?php if(isset($jobsByStudentgroup)): ?>
        <?php $__currentLoopData = $jobsByStudentgroup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $studentgroup_id  => $jobsByUnits): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($studentgroup_id !== ""): ?>
                <?php
                    $studentgroup = App\Studentgroup::findOrFail($studentgroup_id);
                ?>


                <h3 class="mt-3 text-brand-blue">Aufträge an Klasse: "<?php echo e($studentgroup->studentgroup_name); ?>"</h3>

                <div class="accordion" id="accordion_<?php echo e($studentgroup->id); ?>">
                    <?php $__currentLoopData = $jobsByUnits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit_id => $jobs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $unit = App\Unit::findOrFail($unit_id);
                            $count_started = count($jobs->where('jobStatus_id','>',3));
                            $count_finished = count($jobs->where('jobStatus_id','>',10));
                            $countNewsPerUnit = 0;
                            //News für die gesamte Einheit zählen

                            foreach ($jobs as $job) {
                                $news = 0;
                                $tasks_student = $job->tasks;
                                foreach ($tasks_student as $task_student) {
                                    $news = count($task_student->results->where('result_viewed',NULL)->where('created_by','student'));
                                    $countNewsPerUnit = $countNewsPerUnit + $news;
                                }
                            }
                        ?>
                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <div class="d-flex flex-row">
                                    <h2 class="mb-0 col-6">
                                        <button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapse_<?php echo e($unit->id); ?>_<?php echo e($studentgroup->id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($unit->id); ?>_<?php echo e($studentgroup->id); ?>">
                                            <?php echo e($unit->unit_title); ?>

                                        </button>
                                    </h2>
                                    <div class="col-2 m-0 p-0">
                                        <?php if($countNewsPerUnit > 0): ?>
                                            <?php
                                                session()->flash('unit_open',$job->unit_id);
                                            ?>
                                            <button class="btn btn-link m-0 p-0" type="button" data-toggle="collapse" data-target="#collapse_<?php echo e($unit->id); ?>_<?php echo e($studentgroup->id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($unit->id); ?>_<?php echo e($studentgroup->id); ?>">
                                                <span class=""><i class="fa-2x far fa-envelope"></i></span>
                                                <small><span class="badge news_notify badge-danger" style="position: relative; top:-18px; left:-10px;"><?php echo e($countNewsPerUnit); ?></span></small>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-4">
                                    <?php if(count($jobs->where('jobStatus_id',2)) > 0): ?>
                                        <form action="/lehrer/auftrag/zuteilen" method="post" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                            <input type="hidden" name="firstjob_id" value="<?php echo e($jobs->first()->id); ?>">
                                            <input type="hidden" name="studentgroup" value="1">
                                            <button title="Jetzt die Aufträge für die Klasse <?php echo e($studentgroup->studentgroup_name); ?> zuweisen und mit dem Lernen beginnen lassen" class="btn-sm" type="submit"><i class="fas fa-user-check"></i> Aufträge jetzt zuteilen</button>
                                        </form>
                                    <?php elseif(count($jobs->where('jobStatus_id', '>',3)) > 0): ?>
                                        <?php if($count_started > $count_finished): ?>
                                            <small class="text-right"><?php echo e($count_started); ?>/<?php echo e(count($jobs)); ?> Schülern haben angefangen</small>
                                        <?php else: ?>
                                            <small class="text-right"><?php echo e($count_finished); ?>/<?php echo e(count($jobs)); ?> Schülern sind fertig</small>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div id="collapse_<?php echo e($unit->id); ?>_<?php echo e($studentgroup->id); ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_<?php echo e($studentgroup->id); ?>">
                                <div class="card-body p-2">
                                    <div class="table table-sm">
                                        <table class="table-responsive-md table-striped my-2 w-100">
                                            <thead class="table-primary">
                                                <th>Schüler</th>
                                                <th class="text-center">zu erledigen bis</th>
                                                <th class="text-center">Neue Nachrichten</th>
                                                <th class="text-center">Stand der Bearbeitung</th>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                        //Anzahl neuer Nachrichten für diesen Schüler zählen
                                                        $count_news = 0;
                                                        $tasks_student = $job->tasks;
                                                        foreach ($tasks_student as $task_student) {
                                                            $news = count($task_student->results->where('result_viewed',NULL)->where('created_by','student'));
                                                            $count_news = $count_news + $news;
                                                        }
                                                    ?>
                                                    <tr>
                                                        <td><a href="/lehrer/auftraege/schueler/<?php echo e($job->student_id); ?>#card_unit<?php echo e($job->unit_id); ?>"><?php echo e($job->student->student_name); ?></a></td>
                                                        <td class="text-center"><?php echo e($job->done_date->formatLocalized('%d. %B %Y')); ?></td>
                                                        <td class="text-center">
                                                            <?php if($count_news > 0): ?>
                                                            <?php
                                                                session()->flash('unit_open',$job->unit_id);
                                                            ?>
                                                                <a href="/lehrer/auftraege/schueler/<?php echo e($job->student_id); ?>#card_unit<?php echo e($job->unit_id); ?>"> 
                                                                    <span class="ml-3"><i class="fa-2x far fa-envelope"></i></span>
                                                                    <small><span class="badge news_notify badge-danger" style="position: relative; top:-20px; left:-12px;"><?php echo e($count_news); ?></span></small>
                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php if($job->jobStatus_id < 3): ?>
                                                                <small>Noch nicht zugeteilt</small>
                                                            <?php else: ?> 
                                                                <small><?php echo e($job->jobStatus->jobStatus_name); ?></small>
                                                            <?php endif; ?>
                                                        </td>
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
                    <?php $__currentLoopData = $jobsByUnits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit_id => $jobs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $unit = App\Unit::findOrFail($unit_id);
                            //News für die gesamte Einheit zählen
                            $countNewsPerUnit = 0;
                            foreach ($jobs as $job) {
                                $news = 0;
                                $tasks_student = $job->tasks;
                                foreach ($tasks_student as $task_student) {
                                    $news = count($task_student->results->where('result_viewed',NULL)->where('created_by','student'));
                                    $countNewsPerUnit = $countNewsPerUnit + $news;
                                }
                            }





                        ?>
                        <div class="card">
                            <div class="card-header" id="headingOne">
                               <div class="d-flex flex-row">
                                    <h2 class="mb-0 col-6">
                                        <button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapse_<?php echo e($unit->id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($unit->id); ?>">
                                            <?php echo e($unit->unit_title); ?>

                                        </button>
                                    </h2>
                                    <div class="col-2 m-0 p-0">
                                        <?php if($countNewsPerUnit > 0): ?>
                                            <?php
                                                session()->flash('unit_open',$job->unit_id);
                                            ?>
                                            <button class="btn btn-link m-0 p-0" type="button" data-toggle="collapse" data-target="#collapse_<?php echo e($unit->id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($unit->id); ?>">
                                                <span class=""><i class="fa-2x far fa-envelope"></i></span>
                                                <small><span class="badge news_notify badge-danger" style="position: relative; top:-18px; left:-10px;"><?php echo e($countNewsPerUnit); ?></span></small>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-4">
                                    </div>
                                </div>
                            </div>

                            <div id="collapse_<?php echo e($unit->id); ?>" class="collapse " aria-labelledby="headingOne" data-parent="#accordion_singleStudent">
                                <div class="card-body p-2">
                                    <div class="table table-sm">
                                        <table class="table-responsive-md table-striped my-2 w-100">
                                            <thead class="table-primary">
                                                <th>Schüler</th>
                                                <th class="text-center">zu erledigen bis</th>
                                                <th class="text-center">Neue Nachrichten</th>
                                                <th class="text-center">Stand der Bearbeitung</th>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                    //Anzahl neuer Nachrichten für diesen Schüler zählen
                                                    $count_news = 0;
                                                    $tasks_student = $job->tasks;
                                                    foreach ($tasks_student as $task_student) {
                                                        $news = count($task_student->results->where('result_viewed',NULL)->where('created_by','student'));
                                                        $count_news = $count_news + $news;
                                                    }
                                                ?>
                                                    <tr>
                                                        <td><a href="/lehrer/auftraege/schueler/<?php echo e($job->student_id); ?>#card_unit<?php echo e($job->unit_id); ?>"><?php echo e($job->student->student_name); ?></a></td>
                                                        <td class="text-center"><?php echo e($job->done_date->formatLocalized('%d. %B %Y')); ?></td>
                                                        <td class="text-center">
                                                            <?php if($count_news > 0): ?>
                                                            <?php
                                                                session()->flash('unit_open',$job->unit_id);
                                                            ?>
                                                                <a href="/lehrer/auftraege/schueler/<?php echo e($job->student_id); ?>#card_unit<?php echo e($job->unit_id); ?>"> 
                                                                    <span class="ml-3"><i class="fa-2x far fa-envelope"></i></span>
                                                                    <small><span class="badge news_notify badge-danger" style="position: relative; top:-20px; left:-12px;"><?php echo e($count_news); ?></span></small>
                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php if($job->jobStatus_id < 3): ?>
                                                                <form action="/lehrer/auftrag/zuteilen" method="post" enctype="multipart/form-data">
                                                                    <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                                                    <input type="hidden" name="firstjob_id" value="<?php echo e($job->id); ?>">
                                                                    <input type="hidden" name="studentgroup" value="0">
                                                                    <button title="Jetzt die Aufträge für  <?php echo e($job->student->student_name); ?> zuweisen und mit dem Lernen beginnen lassen" class="btn-sm" type="submit"><i class="fas fa-user-check"></i> Auftrag jetzt zuteilen</button>
                                                                </form>
                                                            <?php else: ?> 
                                                                <small><?php echo e($job->jobStatus->jobStatus_name); ?></small>
                                                            <?php endif; ?>
                                                        </td>
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
                
                <div class="modal fade" id="deleteModal_<?php echo e($job->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <?php echo $__env->make('components.deleteCheck',['typeDelete'=>'job','id'=>$job->id, 'title'=>$job->unit->unit_title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/teacher/teacher_jobs.blade.php ENDPATH**/ ?>