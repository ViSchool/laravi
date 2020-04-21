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
   <?php if(isset($tasksByUnit)): ?>
         <?php $__currentLoopData = $tasksByUnit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit_id => $tasks): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
               $unit = App\Unit::find($unit_id);
               $task_example = $tasks->first();
               $unit_done_date = $task_example->done_date;
               $count_news = 0;
               foreach($unit->tasks as $task) {
                  $news = count($task->results->where('result_viewed',NULL)->where('created_by','student'));                        
                  $count_news = $count_news + $news;
                  }
               //Status der Bearbeitung für Progressbar definieren
               if(count($tasks) == count($tasks->where('taskStatus_id',8))) {
                  $progress = 100;
                  $progress_text = 'Die Lerneinheit ist archiviert';
               }
               if (count($tasks) == count($tasks->where('taskStatus_id',2))) {
                  $progress = 10;
                  $progress_text = $student->student_name . ' hat die Lerneinheit noch nicht begonnen.';
               }
               if (count($tasks) == count($tasks->where('taskStatus_id',3))) {
                  $progress = 20;
                  $progress_text = $student->student_name . ' hat die Lerneinheit begonnen.';
               };
               if (count($tasks->where('taskStatus_id',4)) > 0) {
                  $progress = 40;
                  $progress_text = 'Es gibt noch eine unbeantwortete Nachricht von' . $student->student_name;
               };
               if (count($tasks->where('taskStatus_id',4)) > 0) {
                  $progress = 40;
                  $progress_text = 'Es gibt noch eine unbeantwortete Nachricht von' . $student->student_name;
               }
               if (count($tasks->where('taskStatus_id',5)) > 0) {
                  $progress = 60;
                  $progress_text =  $student->student_name .' bearbeitet die Lerneinheit gerade.';
               }
               if (count($tasks->where('taskStatus_id',6)) > 0) {
                  $progress = 60;
                  $progress_text =  $student->student_name .' bearbeitet die Lerneinheit gerade, du musst noch Rückmeldungen zu Ergebnissen geben.';
               }
               if ((isset($progress) == false)) {
                  $progress = 10;
                  $progress_text = 'Der Status ist unbekannt.';
               }
            ?>

            <div class="card mb-3">
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
                        <small class=""><?php echo e($unit_done_date->diffForHumans()); ?></small>
                     </div>
                  </div>
                  <div class="row  mt-3">
                     <div class="col">
                        <div class="d-flex justify-content-start align-items-baseline">
                           <h5 class="">Bearbeitungsstand:   </h5>
                           <p>  <?php echo e($progress_text); ?></p>
                        </div>
                        <?php if($progress < 5): ?>
                           <div class="progress bg-secondary">
                              <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="<?php echo e($progress); ?>" aria-valuemin="100" aria-valuemax="100" style="width: 100%">
                              </div>
                           </div>
                        <?php else: ?>
                           <div class="progress bg-secondary">
                              <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="<?php echo e($progress); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo e($progress); ?>%">
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
                              <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <?php
                                    $news_task =  count($task->results->where('result_viewed','==',NULL)->where('created_by','student')->all());  
                                 ?>
                                 <tr>
                                    <td class="d-flex flex-row justify-content-start align-items-end">
                                       <?php if($news_task > 0): ?>
                                          <a href="/lehrer/auftraege/viewed/<?php echo e($task->id); ?>">
                                             <div title="Du hast <?php echo e($news_task); ?> neue Nachrichten" class="text-left"  id="div_news_<?php echo e($task->id); ?>">
                                                <span data-toggle="collapse" data-target="#collapse_task_news_<?php echo e($task->id); ?>" aria-expanded="true" aria-controls="collapse_task_news_<?php echo e($task->id); ?>" title="Nachrichten zu dieser Aufgabe anschauen" class="align-bottom clickable btn btn-link text-left"><?php echo e($task->block->title); ?> <i class="fas fa-caret-down"></i></span>
                                                <span class="badge news_notify badge-danger" style="position: relative; top:-18px; left:-12px;"><?php echo e($news_task); ?></span>
                                             </div>
                                          </a>
                                       <?php else: ?>
                                          <span data-toggle="collapse" data-target="#collapse_task_news_<?php echo e($task->id); ?>" aria-expanded="true" aria-controls="collapse_task_news_<?php echo e($task->id); ?>" title="Nachrichten zu dieser Aufgabe anschauen" class="align-bottom clickable btn btn-link text-left"><?php echo e($task->block->title); ?> <i class="fas fa-caret-down"></i></span> 
                                       <?php endif; ?>
                                    </td>
                                    <td>
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
                                                   <span class="text-danger" ><i class="fa-2x fas fa-times-circle"></i></span>
                                                <?php else: ?>
                                                   <span class="text-warning"><i class="fa-2x fas fa-hourglass-half"></i></span>
                                                <?php endif; ?>
                                             <?php else: ?>
                                                <span class="text-success" title="Der Schüler hat die Bearbeitung bestätigt."><i class="fa-2x fas fa-check-circle"></i></span>
                                             <?php endif; ?>
                                             <?php break; ?>
                                          <?php case (3): ?>
                                             <?php if(count($task->results->where('result_message',1)) == 0): ?>
                                                <?php if($task->done_date < Carbon::now()): ?>
                                                      <span class="text-danger" ><i class="fa-2x fas fa-times-circle"></i></span>
                                                   <?php else: ?>
                                                      <span class="text-warning"><i class="fa-2x fas fa-hourglass-half"></i></span>
                                                   <?php endif; ?>
                                                <?php else: ?>
                                                   <?php
                                                      $result = $task->results->where('result_message',1)->first();   
                                                   ?>
                                                   <a class="btn-sm btn-success" href="<?php echo e($result->result_url); ?>">Zum Ergebnis</a>
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
                                                   <?php if(count($task->results->where('result_url',1)) > 0): ?>
                                                      <div class="d-flex justify-content-start">
                                                         <div class="otherBubble bg-warning w-75 shadow">
                                                            <div class="d-flex justify-content-end">
                                                               <span><i class="fas fa-map-pin"></i></span>
                                                            </div>
                                                            <p class="card-text p-2"><small><?php echo e($student->student_name); ?> hat Dir einen Ergebnislink geschickt.</small></p>
                                                            <?php if(count($task->results->where('feedback_message',1)) == 0): ?>
                                                            <div class="text-right">
                                                               <form action="/lehrer/auftrag/ergebnislink/feedback" method="post" enctype="multipart/form-data">
                                                                  <?php echo csrf_field(); ?>
                                                                  <input type="hidden" name="task_id" value="<?php echo e($task->id); ?>">
                                                                  <input type="hidden" name="created_by" id="feedback_created_by<?php echo e($task->id); ?>" value="teacher">
                                                                  <input type="hidden" name="feedback_flag" id="feedback_flag_<?php echo e($task->id); ?>" value="1">
                                                                  <textarea class="form-control" name="message" id="feedback_message_<?php echo e($task->id); ?>" rows="5"></textarea>
                                                                  <button type="submit" class="btn-sm btn-info">Danke, habe ich gesehen!</button>
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
                                          

                                          <div class="card-body overflow-auto" style="max-height:300x;">
                                             <?php $__currentLoopData = $task->results->sortBy('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($result->created_by == 'student'): ?>
                                                   <?php if($result->ready_message !== 1): ?>
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
                                                   <?php if($result->feedback_message !== 1): ?>
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
                                                <input type="hidden" name="created_by" id="created_by_<?php echo e($task->id); ?>" value="student">
                                                <label class="col-form-label" for="result_url">Kopiere den Link zu Deinem Ergebnis hierhin: </label>
                                                <input class="form-control mb-5" type="url" name="result_url" id="result_url_<?php echo e($task->id); ?>" required placeholder="https://....">
                                                <textarea class="form-control" name="message" id="message_<?php echo e($task->id); ?>" rows="5" placeholder="Hier kannst Du noch eine zusätzliche Nachricht zu Deinem Ergebnis für  hinterlassen..." ></textarea>
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
   <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/teacher/teacher_student_tasks.blade.php ENDPATH**/ ?>