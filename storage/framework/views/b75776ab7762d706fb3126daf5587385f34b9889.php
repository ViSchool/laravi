<?php $__env->startSection('page-header'); ?>
<section id="page-header">
   <div class="container p-3">
      <h4>Das sind Deine Aufgaben, <?php echo e($student->student_name); ?>:</h4>
   </div>
</section> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
   <?php if(isset($jobsByTeacher)): ?>
      <?php $__currentLoopData = $jobsByTeacher; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher_id  => $jobs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <?php
            $teacher = App\User::findOrFail($teacher_id);
         ?>
         <h3 class="mt-3 text-brand-blue">Aufträge von: <?php echo e($teacher->teacher_name); ?> <?php echo e($teacher->teacher_surname); ?></h3>                       
         <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
               $progress = round(count($job->tasks->where('student_check',1))/count($job->tasks)*100);
               $count_news = 0;
               foreach($job->tasks as $task) {
                  $news = count($task->results->where('result_viewed',NULL)->where('created_by','teacher'));
                  $count_news = $count_news + $news;
               }
            ?>
            <div id="card_<?php echo e($job->unit_id); ?>" class="card mb-3">
               <div class="card-header">
                  <div class="d-flex flex-row align-items-top my-3">
                     <div class="m-0 p-0 col-5">
                        <button class="btn btn-link text-left m-0" type="button" data-toggle="collapse" data-target="#collapse_<?php echo e($job->unit_id); ?>_<?php echo e($teacher_id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($job->unit_id); ?>_<?php echo e($teacher_id); ?>">
                           <?php echo e($job->unit->unit_title); ?> <span><i class="fas fa-caret-down"></i></span>
                        </button>
                     </div>
                     <div class="col-4">
                        <?php if($job->jobStatus->id == 3): ?>
                           <form action="/schueler/lerneinheit_starten" method="POST" enctype="multipart/form-data">
                              <?php echo method_field('PATCH'); ?>
                              <?php echo csrf_field(); ?>
                              <input type="hidden" name="job_id" value="<?php echo e($job->id); ?>">
                              <div class="d-flex flex-column">
                                 <button class="btn-sm btn-primary" type="submit" title="Klicke hier um mit der Lerneinheit zu starten">Starten </button>
                              </div>
                           </form>
                        <?php else: ?>
                           <?php if($job->jobStatus->id > 3): ?>
                              <?php if($job->jobStatus->id < 11): ?>
                                 <div class="d-flex flex-column">
                                    <a class="m-1 btn-sm btn-warning text-center" href="/unit/<?php echo e($job->unit_id); ?>"> Zur Lerneinheit </a>
                                    <form class="m-1" action="/schueler/auftraege/abgeben" method="post">
                                       <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                       <input type="hidden" name="student_id" value="<?php echo e($student->id); ?>">
                                       <input type="hidden" name="job_id" value="<?php echo e($job->id); ?>">
                                       <?php if($progress < 100): ?>
                                          <button title="Kreuze alle Aufgaben als fertig an, um die Aufgabe abzugeben." class="w-100 btn-sm btn-secondary text-center" disabled type="submit"> Abgeben </button>
                                       <?php else: ?>
                                          <button class="w-100 btn-sm btn-success text-center" type="submit"> Abgeben </button>
                                       <?php endif; ?>
                                    </form>
                                 </div>
                              <?php else: ?> 
                                 <div class="d-flex flex-column">
                                    <form class="m-1" action="/schueler/auftraege/zurueckholen" method="post">
                                       <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                       <input type="hidden" name="student_id" value="<?php echo e($student->id); ?>">
                                       <input type="hidden" name="job_id" value="<?php echo e($job->id); ?>">
                                       <button class="w-100 btn-sm btn-info text-center" type="submit"> Zu schnell abgegeben, nochmal zurückholen! </button>
                                    </form>
                                 </div>
                              <?php endif; ?>
                           <?php endif; ?>
                           <div title="Du hast <?php echo e($count_news); ?> neue Nachrichten" class="text-left mt-3" style="min-width: 5rem">
                              <?php if($count_news > 0): ?>
                                 <button type="button" data-toggle="collapse" data-target="#collapse_<?php echo e($job->unit_id); ?>_<?php echo e($teacher_id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($job->unit_id); ?>_<?php echo e($teacher_id); ?>" class="btn btn-primary ml-3" style=""><i class=" far fa-envelope"></i></button>
                                 <span class="badge news_notify badge-danger" style="position: relative; top:-15px; left:-12px;"><?php echo e($count_news); ?></span>
                              <?php endif; ?>
                           </div>
                        <?php endif; ?>
                     </div>
                     <div class="col text-center">
                        <small>Fällig</small><br>
                        <small class=""><?php echo e($job->done_date->diffForHumans()); ?></small>
                     </div>
                  </div>
                  <?php if($job->jobStatus->id > 3): ?>
                     <div class="row" id="headingTwo">
                        <div class="col">
                           <small>So viel hast Du schon geschafft:</small>
                           <?php if($progress < 5): ?>
                              <div class="progress bg-secondary">
                                 <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="<?php echo e($progress); ?>" aria-valuemin="100" aria-valuemax="100" style="width: 100%"><?php echo e($progress); ?>%</div>
                              </div>
                           <?php else: ?>
                              <div class="progress bg-secondary">
                                 <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="<?php echo e($progress); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($progress); ?>%"><?php echo e($progress); ?>%</div>
                              </div>
                           <?php endif; ?>
                        </div>
                     </div>
                  <?php endif; ?>
               </div>

               <div id="collapse_<?php echo e($job->unit_id); ?>_<?php echo e($teacher_id); ?>" class="collapse 
                  <?php if(session('unit_open') == $job->unit_id): ?> show
                  <?php elseif($job->jobStatus_id > 3): ?> show
                  <?php endif; ?>
                  " aria-labelledby="headingOne">

                  <div class="card-body">
                     <div class=" table-borderless table-responsive m-0 p-0" >
                        <table class="table mx-1" >
                           <thead class="">
                              <th>Einzelne Aufgaben</th>
                              <th class="text-center">Aufgabe fertig?</th>
                           </thead>
                           <tbody>
                              <?php $__currentLoopData = $job->tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <?php
                                 $news_task =  count($task->results->where('result_viewed','==',NULL)->where('created_by','teacher')->all());
                                 ?>
                                 <tr>
                                    <td class="d-flex flex-row justify-content-start align-items-end">
                                       <?php if($news_task > 0): ?>
                                          <a href="/schueler/auftraege/viewed/<?php echo e($task->id); ?>">
                                             <div title="Du hast <?php echo e($news_task); ?> neue Nachrichten" class="text-left" style="min-width: 5rem" id="div_news_<?php echo e($task->id); ?>">
                                                <span data-toggle="collapse" data-target="#collapse_task_news_<?php echo e($task->id); ?>" aria-expanded="true" aria-controls="collapse_task_news_<?php echo e($task->id); ?>" title="Nachrichten zu dieser Aufgabe anschauen" class="align-bottom clickable btn btn-link text-left"><?php echo e($task->block->title); ?> <i class="fas fa-caret-down"></i></span>
                                                <span class="badge news_notify badge-danger" style="position: relative; top:-18px; left:-12px;"><?php echo e($news_task); ?></span>
                                             </div>
                                          </a>
                                       <?php else: ?>
                                          <span data-toggle="collapse" data-target="#collapse_task_news_<?php echo e($task->id); ?>" aria-expanded="true" aria-controls="collapse_task_news_<?php echo e($task->id); ?>" title="Nachrichten zu dieser Aufgabe anschauen" class="align-bottom clickable btn btn-link text-left"><?php echo e($task->block->title); ?> <i class="fas fa-caret-down"></i></span> 
                                       <?php endif; ?>
                                    </td>
                                    <td class=" align-middle text-center">
                                       <form action="/schueler/auftrag/student_check" method="post" enctype="multipart/form-data">
                                          <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                          <input type="hidden" name="task_id" value="<?php echo e($task->id); ?>">
                                          <?php if($task->student_check == 1): ?>
                                             <input type="checkbox" name="result_for_student_check" value="1" id="result_for_student_check_<?php echo e($task->id); ?>" checked onChange="this.form.submit()">
                                             <input type="hidden" name="result_for_student_check" value="0">  
                                          <?php else: ?> 
                                             <?php switch($task->interaction_id):
                                                case (1): ?>
                                                   <input type="checkbox" name="result_for_student_check" value="1" id="result_for_student_check_<?php echo e($task->id); ?>"  onChange="this.form.submit()"> 
                                                <?php break; ?>
                                                <?php case (2): ?>
                                                   <?php if(count($task->results->where('ready_message',1)) > 0): ?> 
                                                      <input type="checkbox" name="result_for_student_check" value="1" id="result_for_student_check_<?php echo e($task->id); ?>"  onChange="this.form.submit()"> 
                                                   <?php else: ?>
                                                      <input type="checkbox" name="result_for_student_check" value="1" id="result_for_student_check_<?php echo e($task->id); ?>" disabled onChange="this.form.submit()">
                                                      <span class="text-danger" title="Du musst noch eine Rückmeldung geben."><i class="fas fa-exclamation-triangle"></i></span>
                                                   <?php endif; ?>
                                                <?php break; ?>
                                                <?php case (3): ?>
                                                   <?php if(count($task->results->where('result_url','!==',NULL)) > 0): ?> 
                                                      <input type="checkbox" name="result_for_student_check" value="1" id="result_for_student_check_<?php echo e($task->id); ?>"  onChange="this.form.submit()"> 
                                                   <?php else: ?>
                                                      <input type="checkbox" name="result_for_student_check" value="1" id="result_for_student_check_<?php echo e($task->id); ?>" disabled onChange="this.form.submit()">
                                                      <span class="text-danger" title="Du musst noch eine Rückmeldung geben."><i class="fas fa-exclamation-triangle"></i></span>
                                                   <?php endif; ?>
                                                <?php break; ?>
                                                <?php default: ?>
                                             <?php endswitch; ?>
                                          <?php endif; ?>
                                       </form>
                                    </td>
                                 </tr>

                                 
                                 <tr class="">
                                    <td colspan="4" >
                                       <div id="collapse_task_news_<?php echo e($task->id); ?>" class="news card bg-primary border-primary collapse 
                                          <?php if(session('task_news_open') == $task->id): ?> show <?php endif; ?>
                                       " aria-labelledby="">
                                          <div class="card-header">
                                             <h5 class="text-white">Deine Nachrichten zur Aufgabe: <?php echo e($task->block->title); ?></h5>
                                          </div>

                                            
                                          <div class="card-body">
                                             <div class="d-flex justify-content-start">
                                                <div class="otherBubble bg-warning w-75 shadow">
                                                   <div class="d-flex justify-content-end">
                                                      <span><i class="fas fa-map-pin"></i></span> 
                                                   </div>
                                                   <?php switch($task->interaction_id):
                                                      case (1): ?>
                                                         <p class="card-text p-2"><small>Eine Rückmeldung zu dieser Aufgabe ist nicht nötig. Wenn Du Fragen hast, schreibe aber gerne eine Nachricht. </small></p>
                                                      <?php break; ?>
                                                      <?php case (2): ?>
                                                         <p class="card-text p-2"><small>Melde bitte hier zurück, wenn Du Deine Aufgabe erledigt hast:</small></p>
                                                         <?php if(count($task->results->where('ready_message',1)) > 0): ?>
                                                            <div class="d-flex justify-content-between">
                                                               <?php if(count($task->results->where('feedback_message')) < 0): ?>
                                                                  <a href="/schueler/auftrag/erledigt/zuruecknehmen/<?php echo e($task->id); ?>"><small> Meldung zurücknehmen </small></a>
                                                               <?php else: ?> 
                                                                  <small>Deine Rückmeldung wurde bestätigt.</small>
                                                               <?php endif; ?>
                                                               <span class="text-success"> <i class="fa-2x far fa-check-square"></i></span>
                                                            </div>
                                                         <?php else: ?>
                                                            <div class="text-right">
                                                               <form action="/schueler/auftrag/erledigt" method="post" enctype="multipart/form-data">
                                                                  <?php echo csrf_field(); ?>
                                                                  <input type="hidden" name="task_id" value="<?php echo e($task->id); ?>">
                                                                  <input type="hidden" name="created_by" id="created_by" value="student">
                                                                  <input type="hidden" name="ready_message" id="ready_message_<?php echo e($task->id); ?>" value="1">
                                                                  <button type="submit" class="btn-sm btn-info">Ich habe die Aufgabe erledigt.</button>
                                                               </form>
                                                            </div>
                                                         <?php endif; ?>
                                                      <?php break; ?>
                                                      <?php case (3): ?>
                                                         <p class="card-text p-2"><small>Dein Lehrer möchte zu dieser Aufgabe einen Link zu Deiner Lösung von Dir haben:</small></p>
                                                         <?php if(count($task->results->where('result_url','!==',NULL)) > 0): ?> 
                                                            <div class="d-flex justify-content-between">
                                                               <?php if(count($task->results->where('feedback_message',1)) == 0): ?>
                                                                  <a href="/schueler/auftrag/ergebnis/zuruecknehmen/<?php echo e($task->id); ?>"><small> Meldung zurücknehmen </small></a>
                                                               <?php else: ?>
                                                                  <?php
                                                                     $feedback = $task->results->where('feedback_message',1)->first();
                                                                  ?>
                                                                  <small> Das ist die Korrektur zur Deiner Lösung:  </small>
                                                               <?php endif; ?>
                                                               <span class="text-success"> <i class="fa-2x far fa-check-square"></i></span>
                                                            </div>
                                                            <?php if(isset($feedback)): ?>
                                                               <div class="d-flex justify-content-start bg-white rounded">
                                                                  <small class="p-2"><?php echo $feedback->message; ?>}</small>
                                                               </div>
                                                            <?php endif; ?>
                                                         <?php else: ?>
                                                            <div class="d-flex justify-content-end">
                                                               <button type="button" class="btn-sm btn-success" data-toggle="modal" data-target="#resultModal_<?php echo e($task->id); ?>">Ergebnis zur Aufgabe senden</button>
                                                            </div>
                                                         <?php endif; ?>
                                                      <?php break; ?>
                                                      <?php default: ?>
                                                   <?php endswitch; ?>
                                                </div>
                                             </div>
                                          </div>
                                          

                                          <div class="card-body overflow-auto" style="max-height:300x;">
                                             <?php $__currentLoopData = $task->results->sortBy('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($result->created_by == 'teacher'): ?>
                                                   <?php if($result->feedback_message !== 1): ?>
                                                      <div class="d-flex flex-column justify-content-start w-75 mb-3 my-1">
                                                      <div class="d-flex text-white justify-content-between mb-0">
                                                         <span class="ml-3"><small><?php echo e($job->teacher->teacher_name); ?> <?php echo e($job->teacher->teacher_surname); ?></small></span>
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
                                                   <?php if($result->ready_message !== 1): ?>
                                                      <div class="row mb-3 my-1">
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
                                             <form action="/schueler/auftrag/nachricht" method="post" enctype="multipart/form-data" >
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="created_by" value="student">
                                                <input type="hidden" name="task_id" value="<?php echo e($task->id); ?>">
                                                <div class="input-group mb-3">
                                                   <input name="message" id="message_in_box<?php echo e($task->id); ?>" type="text" class="form-control" placeholder="Schreibe eine Nachricht an <?php echo e($teacher->teacher_name); ?> <?php echo e($teacher->teacher_surname); ?> hier..." aria-label="message_to_student" aria-describedby="button-addon2">
                                                   <div class="input-group-append">
                                                      <button class="btn btn-link text-warning" type="submit" id="button_send_message_<?php echo e($task->id); ?>"><i class="fa-2x fas fa-arrow-circle-up"></i></button>
                                                   </div>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                                 


                                 
                                 <div class="modal fade" id="resultModal_<?php echo e($task->id); ?>" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="resultModalLabel">Schicke Dein Ergebnis zur Aufgabe "<?php echo e($task->block->title); ?>"</h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                             </button>
                                          </div>
                                          <form action="/schueler/auftrag/ergebnis" method="post" enctype="multipart/form-data">
                                             <?php echo csrf_field(); ?>
                                             <div class="modal-body form-group">
                                                <input type="hidden" name="task_id" value="<?php echo e($task->id); ?>">
                                                <input type="hidden" name="created_by" id="created_by" value="student">
                                                <label class="col-form-label" for="result_url">Kopiere den Link zu Deinem Ergebnis hierhin: </label>
                                                <input class="form-control mb-5" type="url" name="result_url" id="result_url_<?php echo e($task->id); ?>" required placeholder="https://....">
                                                <textarea class="form-control" name="message" id="message_<?php echo e($task->id); ?>" rows="5" placeholder="Hier kannst Du noch eine zusätzliche Nachricht zu Deinem Ergebnis für <?php echo e($teacher->teacher_name); ?> <?php echo e($teacher->teacher_surname); ?> hinterlassen..." ></textarea>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                                                <button type="submit" class="btn btn-primary">Nachricht senden</button>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div> 
                                 
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/student/student_jobs.blade.php ENDPATH**/ ?>