<?php $__env->startSection('page-header'); ?>
<section id="page-header">
   <div class="container p-3">
      <h4>Das sind Deine Aufgaben, <?php echo e($student->student_name); ?>:</h4>
   </div>
</section> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container my-5">
   <div class="accordion" id="accordion_units">
      <?php if(isset($tasksByTeacher)): ?>
         <?php $__currentLoopData = $tasksByTeacher; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher_id  => $tasksByUnits): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
               $teacher = App\User::findOrFail($teacher_id);
            ?>


            <h3 class="mt-3 text-brand-blue">Aufträge von: <?php echo e($teacher->teacher_name); ?> <?php echo e($teacher->teacher_surname); ?></h3>           
            <div class="accordion" id="accordion_units">
               <?php $__currentLoopData = $tasksByUnits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit_id => $tasks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                     $unit = App\Unit::find($unit_id);
                     $task_example = $tasks->first();
                     $unit_done_date = $task_example->done_date;
                     $progress = round(count($tasks->where('student_check',1)->all())/count($tasks)*100);
                     $count_news = 0;
                     foreach($unit->tasks as $task) {
                        $news = count($task->results->where('result_viewed',NULL)->where('created_by','teacher'));
                        $count_news = $count_news + $news;
                     }
                  ?>
                  <div class="card mb-3">
                     <div class="card-header">
                        <div class="d-flex flex-row row align-items-center" id="headingOne">
                           <div class="m-0 p-0 col-6">
                              <button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapse_<?php echo e($unit->id); ?>_<?php echo e($teacher_id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($unit->id); ?>_<?php echo e($teacher_id); ?>">
                                 <?php echo e($unit->unit_title); ?> <span><i class="fas fa-caret-down"></i></span>
                              </button>
                           </div>
                           <div class="col-3">
                              <?php if($task_example->taskStatus_id < 3): ?>
                                 <form action="/schueler/lerneinheit_starten" method="POST" enctype="multipart/form-data">
                                    <?php echo method_field('PATCH'); ?>
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="unit_id" value="<?php echo e($unit->id); ?>">
                                    <?php $__currentLoopData = $unit->tasks->where('student_id',$student->id); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <input type="hidden" name="student_id" value="<?php echo e($student->id); ?>">
                                       <input type="hidden" name="tasks[]" value="<?php echo e($task->id); ?>">
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <button class="btn-sm btn-primary" type="submit" title="Klicke hier um mit der Lerneinheit zu starten">Starten </button>
                                 </form>
                              <?php else: ?>
                              <?php if($task_example->taskStatus_id > 2): ?>
                                 <a class="btn-sm btn-warning" href="/unit/<?php echo e($unit->id); ?>"> Zur Lerneinheit </a>
                              <?php endif; ?>
                              <div title="Du hast <?php echo e($count_news); ?> neue Nachrichten" class="text-left mt-3" style="min-width: 5rem">
                                 <?php if($count_news > 0): ?>
                                    <button type="button" data-toggle="collapse" data-target="#collapse_<?php echo e($unit->id); ?>_<?php echo e($teacher_id); ?>" aria-expanded="false" aria-controls="collapse_<?php echo e($unit->id); ?>_<?php echo e($teacher_id); ?>" class="btn btn-primary ml-3" style=""><i class=" far fa-envelope"></i></button>
                                    <span class="badge news_notify badge-danger" style="position: relative; top:-15px; left:-12px;"><?php echo e($count_news); ?></span>
                                 <?php endif; ?>
                              </div>
                              <?php endif; ?> 
                           </div>
                           <div class="col my-3 text-center">
                              <small>Fällig</small><br>
                              <small class=""><?php echo e($unit_done_date->diffForHumans()); ?></small>
                           </div>
                        </div>
                        <?php if($task_example->taskStatus_id > 2): ?>
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

                     <?php if(session('unit_open') == $unit->id): ?> 
                         <div id="collapse_<?php echo e($unit->id); ?>_<?php echo e($teacher_id); ?>" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion_units">
                     <?php else: ?>
                        <div id="collapse_<?php echo e($unit->id); ?>_<?php echo e($teacher_id); ?>" class="collapse" aria-labelledby="headingOne" data-parent="#accordion_units">
                     <?php endif; ?>
                        <div class="card-body">
                           <div class=" table-borderless table-responsive m-0 p-0" >
                              <table class="table mx-1" >
                                 <thead class="">
                                    <th>Einzelne Aufgaben</th>
                                    <th class="text-center">Aufgabe fertig?</th>
                                 </thead>
                                 <tbody>
                                    <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                             <?php if(session('task_news_open') == $task->id): ?>
                                             <div id="collapse_task_news_<?php echo e($task->id); ?>" class="news card bg-primary border-primary collapse show" aria-labelledby="">
                                             <?php else: ?> 
                                             <div id="collapse_task_news_<?php echo e($task->id); ?>" class="news card bg-primary border-primary collapse" aria-labelledby="">
                                             <?php endif; ?>
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
                                                               <p class="card-text p-2"><small>Dein Lehrer möchte zu Dieser Aufgabe einen Link zu Deiner Lösung von Dir haben:</small></p>
                                                               <?php if(count($task->results->where('result_url','!==',NULL)) > 0): ?> 
                                                                  <div class="d-flex justify-content-between">
                                                                     <?php if(count($task->results->where('feedback_message')) < 0): ?>                                                                        
                                                                        <a href="/schueler/auftrag/ergebnis/zuruecknehmen/<?php echo e($task->id); ?>"><small> Meldung zurücknehmen </small></a>
                                                                     <?php else: ?> 
                                                                        <?php
                                                                           $feedback = $task->results->where('feedback_message',1)->first(); 
                                                                        ?>
                                                                        <small> Das ist die Korrektur zur Deiner Lösung:  </small>
                                                                        <small> <?php echo e($feedback->message); ?>  </small>
                                                                     <?php endif; ?>
                                                                     <span class="text-success"> <i class="fa-2x far fa-check-square"></i></span>
                                                                  </div>
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
                                                         <div class="d-flex text-white justify-content-end mr-3">
                                                            <span><small class=""><?php echo e($result->created_at->diffForHumans()); ?></small></span>
                                                         </div>
                                                         <div class="d-flex justify-content-start">
                                                            <div class="otherBubble bg-warning w-75 shadow">
                                                               <p class="card-text p-2"><small><?php echo e($result->message); ?></small></p>
                                                            </div>
                                                         </div>
                                                         <?php endif; ?>
                                                      <?php else: ?>
                                                         <?php if($result->ready_message !== 1): ?>
                                                            <div class="d-flex text-white justify-content-end mr-3">
                                                               <span><small class=""><?php echo e($result->created_at->diffForHumans()); ?></small></span>
                                                            </div>
                                                            <div class="d-flex justify-content-end">
                                                               <div class="ownBubble bg-light w-75 shadow">
                                                                  <p class="card-text p-2"><small><?php echo e($result->message); ?></small></p>
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
                                                         <input name="message" id="message_in_box<?php echo e($task->id); ?>" type="text" class="form-control" placeholder="Schreibe eine Nachricht an <?php echo e($student->student_name); ?> hier..." aria-label="message_to_student" aria-describedby="button-addon2">
                                                         <div class="input-group-append">
                                                            <button class="btn btn-link text-warning" type="submit" id="button_send_message_<?php echo e($task->id); ?>"><i class="fa-2x fas fa-arrow-circle-up"></i></button>
                                                         </div>
                                                      </div>
                                                ^  </form>
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
                                                   <form action="/schueler/auftrag/ergebnis" method="post" enctype="multipart/form-data" >
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
            </div>
         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
   </div>
</div>        
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/student/student_tasks.blade.php ENDPATH**/ ?>