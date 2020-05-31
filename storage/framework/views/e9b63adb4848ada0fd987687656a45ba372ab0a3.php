<?php $__env->startSection('page-header'); ?>
<section id="page-header">
   <div class="container p-3">
      <h4> Das sind die Aufgaben für <?php echo e($student->student_name); ?>:</h4>      
   </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
   <h3>Diese Lerneinheiten soll <?php echo e($student->student_name); ?> bearbeiten:</h3>
   <?php if(isset($jobsByUnit)): ?>
         <?php $__currentLoopData = $jobsByUnit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit_id => $jobs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
               $unit = App\Unit::find($unit_id);
               $count_news = 0;
               foreach ($jobs as $job) {
                  //Anzahl neuer Nachrichten für diesen Auftrag zählen
                  $tasks_student = $job->tasks;
                  foreach ($tasks_student as $task_student) {
                     $news = count($task_student->results->where('result_viewed',NULL)->where('created_by','student'));
                     $count_news = $count_news + $news;
                  }
               }
            ?>


            <div id="card_unit<?php echo e($unit->id); ?>" class="card mb-3">
               <div class="card-header">
                  <div class="d-flex flex-row row align-items-center" id="headingOne">
                     <div class="m-0 p-0 col-6">
                        <button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapse_<?php echo e($unit->id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($unit->id); ?>"> 
                           <?php echo e($unit->unit_title); ?> <span><i class="fas fa-caret-down"></i></span>
                        </button>
                     </div>
                     <div class="col-3">
                        <div title="Du hast <?php echo e($count_news); ?> neue Nachrichten" class="text-left mt-3" style="min-width: 5rem">
                           <?php if($count_news > 0): ?>
                              <button type="button" data-toggle="collapse" data-target="#collapse_<?php echo e($unit->id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($unit->id); ?>" class="btn btn-primary ml-3" style=""><i class=" far fa-envelope"></i></button>
                              <span class="badge news_notify badge-danger" style="position: relative; top:-15px; left:-12px;"><?php echo e($count_news); ?></span>
                           <?php endif; ?>
                        </div>
                     </div>
                     <div class="col my-3 text-center">
                        <small>Fällig</small><br>
                        <small class=""><?php echo e($job->done_date->diffForHumans()); ?></small>
                     </div>
                  </div>
                  <div class="row mt-3">
                     <div class="col">
                        <div class="d-flex justify-content-start align-items-baseline">
                           <h5 class="">Bearbeitungsstand: </h5>
                           <p> <?php echo e($job->jobStatus->jobStatus_description); ?></p>
                        </div>
                        <?php if($job->jobStatus->jobStatus_progress < 5): ?>
                           <div class="progress bg-secondary">
                              <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="<?php echo e($job->jobStatus->jobStatus_progress); ?>" aria-valuemin="100" aria-valuemax="100" style="width: 100%">
                              </div>
                           </div>
                        <?php else: ?>
                           <div class="progress bg-secondary">
                              <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo e($job->jobStatus->jobStatus_progress); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($job->jobStatus->jobStatus_progress); ?>%; ">
                              </div>
                           </div>
                        <?php endif; ?>
                     </div>
                  </div>
               </div>

               <div id="collapse_<?php echo e($unit->id); ?>" class="collapse 
                  <?php if(session('unit_open') == $unit->id): ?> 
                     show
                  <?php endif; ?>
                  " aria-labelledby="headingOne">
                  <div class="card-body">
                     <div class=" table-borderless table-responsive m-0 p-0" >
                        <table class="table mx-1" >
                           <thead class="">
                              <th>Einzelne Aufgaben</th>
                              <th>Notwendige Rückmeldung</th>
                              <th class="text-center">Ergebnis</th>
                           </thead>
                           <tbody>
                              <?php $__currentLoopData = $job->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <?php
                                    $news_task =  count($task->results->where('result_viewed','==',NULL)->where('created_by','student')->all());  
                                 ?>
                                 <tr>
                                    <td class="d-flex flex-row justify-content-start">
                                       <?php if($news_task > 0): ?>
                                          <a href="/lehrer/auftraege/viewed/<?php echo e($task->id); ?>">
                                             <div title="Du hast <?php echo e($news_task); ?> neue Nachrichten" class="text-left"  id="div_news_<?php echo e($task->id); ?>">
                                                <span data-toggle="collapse" data-target="#collapse_task_news_<?php echo e($task->id); ?>" aria-expanded="true" aria-controls="collapse_task_news_<?php echo e($task->id); ?>" title="Nachrichten zu dieser Aufgabe anschauen" class="align-middle clickable btn btn-link text-left"><?php echo e($task->block->title); ?> <i class="fas fa-caret-down"></i></span>
                                                <span class=" badge news_notify badge-danger" style="position: relative; top:-18px; left:-12px;"><?php echo e($news_task); ?></span>
                                             </div>
                                          </a>
                                       <?php else: ?>
                                          <span data-toggle="collapse" data-target="#collapse_task_news_<?php echo e($task->id); ?>" aria-expanded="true" aria-controls="collapse_task_news_<?php echo e($task->id); ?>" title="Nachrichten zu dieser Aufgabe anschauen" class="align-items-stretch align-middle clickable btn btn-link text-left"><?php echo e($task->block->title); ?><i class="fas fa-caret-down"></i></span> 
                                       <?php endif; ?>
                                    </td>
                                    <td class="align-middle">
                                       <?php if($task->interaction_id > 1): ?>
                                          <small><?php echo e($task->interaction->interaction_name); ?></small>
                                       <?php endif; ?>
                                    </td>
                                    <td class="text-center align-middle">
                                       <?php switch($task->interaction_id):
                                          case (1): ?>
                                             <?php break; ?>
                                          <?php case (2): ?>
                                             <?php if(count($task->results->where('ready_message',1)) == 0): ?>
                                                <?php if($task->done_date < Carbon::now()): ?>
                                                   <span class="text-danger" title="Die Aufgabe wurde noch nicht erledigt."><i class="fa-2x fas fa-times-circle"></i></span>
                                                <?php else: ?>
                                                   <span class="text-warning"><i class="fa-2x fas fa-hourglass-half"></i></span>
                                                <?php endif; ?>
                                             <?php else: ?>
                                                <span class="text-success" title="Der Schüler hat die Bearbeitung bestätigt."><i class="fa-2x fas fa-check-circle"></i></span>
                                             <?php endif; ?>
                                             <?php break; ?>
                                          <?php case (3): ?>
                                             <?php if(count($task->results->where('result_url', '!=', NULL)) == 0): ?>
                                                <?php if($task->done_date < Carbon::now()): ?>
                                                      <span class="text-danger" ><i class="fa-2x fas fa-times-circle"></i></span>
                                                   <?php else: ?>
                                                      <span class="text-warning"><i class="fa-2x fas fa-hourglass-half"></i></span>
                                                   <?php endif; ?>
                                                <?php else: ?>
                                                   <?php
                                                      $result = $task->results->where('result_url', '!=', NULL)->first();   
                                                   ?>
                                                   <a class="text-success" href="<?php echo e($result->result_url); ?>"><small> Zum Ergebnis </small></a>
                                                <?php endif; ?>
                                             <?php break; ?>
                                          <?php default: ?>
                                       <?php endswitch; ?>
                                    </td>
                                 </tr>

                                 
                                 <tr class="">
                                    <td colspan="4" >
                                       <?php if(session('task_news_open') == $task->id): ?>
                                       <div id="collapse_task_news_<?php echo e($task->id); ?>" class="news card bg-primary border-primary collapse show" aria-labelledby="">
                                       <?php else: ?>
                                       <div id="collapse_task_news_<?php echo e($task->id); ?>" class="news card bg-primary border-primary collapse" aria-labelledby="">
                                       <?php endif; ?>
                                          <div class="card-header">
                                             <h5 class="text-white">Deine Nachrichten zur Aufgabe: <?php echo e($task->block->title); ?></h5>
                                          </div>

                                          
                                          <div class="card-body">
                                             <?php switch($task->interaction_id):
                                                case (1): ?>
                                                <?php break; ?>
                                                <?php case (2): ?>
                                                   <?php if(count($task->results->where('ready_message',1)) > 0): ?>
                                                      <div class="d-flex justify-content-start">
                                                         <div class="otherBubble bg-warning w-75 shadow">
                                                            <div class="d-flex justify-content-end">
                                                               <span><i class="fas fa-map-pin"></i></span>
                                                            </div>
                                                            <p class="card-text p-2"><small><?php echo e($student->student_name); ?> hat Dir zurückgemeldet, er hat die Aufgabe erledigt.</small></p>
                                                            <?php if(count($task->results->where('feedback_message',1)) == 0): ?>
                                                            <div class="text-right">
                                                               <form action="/lehrer/auftrag/erledigt/danke" method="post" enctype="multipart/form-data">
                                                                  <?php echo csrf_field(); ?>
                                                                  <input type="hidden" name="task_id" value="<?php echo e($task->id); ?>">
                                                                  <input type="hidden" name="created_by" id="feedback_created_by<?php echo e($task->id); ?>" value="teacher">
                                                                  <input type="hidden" name="feedback_message" id="feedback_message_<?php echo e($task->id); ?>" value="1">
                                                                  <button type="submit" class="btn-sm btn-info">Danke, habe ich gesehen!</button>
                                                               </form>
                                                            </div>
                                                            <?php endif; ?>
                                                         </div>
                                                      </div>
                                                   <?php endif; ?>
                                                <?php break; ?>
                                                <?php case (3): ?>
                                                   <?php if(count($task->results->where('result_url','!=',NULL)) > 0): ?>
                                                      <?php
                                                         $result = $task->results->where('result_url','!=',NULL)->first();
                                                      ?>
                                                      <div class="d-flex justify-content-start">
                                                         <div class="otherBubble bg-warning w-75 shadow">
                                                            <div class="d-flex justify-content-end">
                                                               <span><i class="fas fa-map-pin"></i></span>
                                                            </div>
                                                            <p class="card-text p-2"><small><?php echo e($student->student_name); ?> hat Dir einen Ergebnislink geschickt.</small></p>
                                                         <p class="card-text p-2"> <a title="Ergebnislink: <?php echo e($result->result_url); ?>" target="_blank" class="btn-sm btn-info form-control text-center" href="<?php echo e($result->result_url); ?>">Ergebnis ansehen</a></p>
                                                            <?php if(count($task->results->where('feedback_message',1)) == 0): ?>
                                                            <div class="text-right">
                                                               <form action="/lehrer/auftrag/ergebnislink/feedback" method="post" enctype="multipart/form-data">
                                                                  <?php echo csrf_field(); ?>
                                                                  <input type="hidden" name="task_id" value="<?php echo e($task->id); ?>">
                                                                  <input type="hidden" name="created_by" id="feedback_created_by<?php echo e($task->id); ?>" value="teacher">
                                                                  <input type="hidden" name="feedback_message" id="feedback_message_<?php echo e($task->id); ?>" value="1">
                                                                  <label class="text-left mb-0" for="message"><small> Hier kannst Du <?php echo e($student->student_name); ?> eine Nachricht hinterlassen: </small></label>
                                                                  <textarea class="form-control" name="message" id="feedback_message_<?php echo e($task->id); ?>" rows="5" placeholder="Gib Deinem Schüler hier ein Feedback zu seinem Ergebnis..."></textarea>
                                                                  <button type="submit" class=" btn-sm btn-info mt-2">Feedback senden</button>
                                                               </form>
                                                            </div>
                                                            <?php endif; ?>
                                                         </div>
                                                      </div>
                                                   <?php endif; ?>
                                                <?php break; ?>
                                                <?php default: ?>
                                             <?php endswitch; ?>
                                          </div>
                                          

                                          <div class="card-body overflow-auto" style="max-height:400x;">
                                             <?php $__currentLoopData = $task->results->sortBy('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($result->created_by == 'student'): ?>
                                                   <?php if($result->ready_message !== 1): ?>
                                                   <div class="d-flex flex-column justify-content-start w-75 mb-3 my-1">
                                                      <div class="d-flex text-white justify-content-between mb-0">
                                                         <span class="ml-3"><small><?php echo e($job->student->student_name); ?></small></span>
                                                         <span><small class="mr-3"><?php echo e($result->created_at->diffForHumans()); ?></small></span>
                                                      </div>
                                                      <div class="d-flex justify-content-start ">
                                                         <div class="otherBubble bg-warning shadow mt-0 w-100">
                                                            <p class="card-text p-1"><small><?php echo e($result->message); ?></small></p>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   <?php endif; ?>
                                                <?php else: ?>
                                                   <?php if($result->feedback_message !== 1): ?>
                                                      <div class="row">
                                                         <div class="col-3"></div>
                                                         <div class="d-flex col-9 p-1 justify-content-end flex-column">
                                                            <div class="d-flex text-white justify-content-between mb-0">
                                                               <span class="ml-3"><small>Du</small></span>
                                                               <span><small class="mr-3"><?php echo e($result->created_at->diffForHumans()); ?></small></span>
                                                            </div>
                                                            <div class="d-flex justify-content-end m-0">
                                                               <div class="ownBubble bg-light shadow w-100 m-0">
                                                                  <p class="card-text text-right p-2"><small><?php echo e($result->message); ?></small></p>
                                                               </div>
                                                            </div>
                                                         </div>
                                                      </div>
                                                   <?php endif; ?>
                                                <?php endif; ?>
                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                          </div>
                                          <div class="card-footer">
                                             <form action="/lehrer/auftrag/nachricht" method="post" enctype="multipart/form-data" >
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="created_by" value="teacher">
                                                <input type="hidden" name="task_id" value="<?php echo e($task->id); ?>">
                                                <div class="input-group mb-3">
                                                   <input name="message" id="message_in_box<?php echo e($task->id); ?>" type="text" class="form-control" placeholder="Schreibe eine Nachricht an <?php echo e($student->student_name); ?> hier..." aria-label="message_to_student" aria-describedby="button-addon2">
                                                   <div class="input-group-append">
                                                      <button class="btn btn-link text-warning" type="submit" id="button_send_message_<?php echo e($task->id); ?>"><i class="fa-2x fas fa-arrow-circle-up"></i></button>
                                                   </div>
                                                </div>
                                             </form>
                                          </div>
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
   <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/teacher/teacher_student_jobs.blade.php ENDPATH**/ ?>