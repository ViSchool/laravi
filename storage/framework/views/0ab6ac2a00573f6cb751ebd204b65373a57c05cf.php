		
<?php $__env->startSection('page-header'); ?>
<section id="page-header">
   <div class="container p-3">
      <h4>Aufgaben für den Schüler "<?php echo e($student->student_name); ?>"</h4>
   </div>
</section> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
   <div class="accordion" id="accordion_units">
      <?php $__currentLoopData = $tasksByUnit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit_id => $tasks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <?php
             $unit = App\Unit::find($unit_id);
             $task_example = $tasks->first();
             $unit_done_date = $task_example->done_date;
         ?>
         <div class="card">
            <div class="card-header d-flex flex-row row align-items-center" id="headingOne">
               <h2 class="m-0 p-0 col-8">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse_<?php echo e($unit->id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($unit->id); ?>">
                     <?php echo e($unit->unit_title); ?>

                  </button>
               </h2>
               <div class="col-1 text-right">
                  <span class="badge badge-pill badge-danger my-3"><i class="far fa-comment"></i></span>
               </div>
               <small class="text-right col my-3"><?php echo e($unit_done_date->diffForHumans()); ?></small>
            </div>

            <div id="collapse_<?php echo e($unit->id); ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_units">
               <div class="card-body">
                  <div class="table-responsive" >
                     <table class="table table-sm mx-1" >
                        <thead class="table-primary">
                           <th>Einzelne Aufgaben</th>
                           <th>Status</th>
                           <th>Ergebnis</th>
                        </thead>
                        <tbody>
                           <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <tr>
                                 <td data-toggle="collapse" data-target="#collapse_task_news_<?php echo e($task->id); ?>" aria-expanded="true" aria-controls="collapse_task_news_<?php echo e($task->id); ?>" class="clickable btn btn-link text-left"><?php echo e($task->block->title); ?></td>
                              <td class="text-center"><i class="<?php echo e($task->taskStatus->taskStatus_icon); ?>" style="color:<?php echo e($task->taskStatus->taskStatus_icon_color); ?>"></i></td>
                                 <td>haken oder link je nach ergebnis</td>
                              </tr>
                              <tr class="table-borderless">
                                 <td colspan="3">
                                    <div id="collapse_task_news_<?php echo e($task->id); ?>" class="card collapse" aria-labelledby="">
                                       Das ist eine Beispielnachricht {$result->message} mit noch viel längerem Text, so dass wir auch den Zeilenumbruch mal gut sehen können 
                                     </div>
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
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/teacher/student_tasks.blade.php ENDPATH**/ ?>