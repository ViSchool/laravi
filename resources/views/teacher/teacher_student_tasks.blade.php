@extends('layout')

@section ('page-header')
<section id="page-header">
   <div class="container p-3">
      <h4> Das sind die Aufgaben für {{$student->student_name}}:</h4>      
   </div>
</section>
@endsection

@section ('content')
<div class="container my-5">
   <h3>Diese Lerneinheiten soll {{$student->student_name}} bearbeiten:</h3>
   @isset($tasksByUnit)
         @foreach ($tasksByUnit as $unit_id => $tasks)
            @php
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
            @endphp

            <div class="card mb-3">
               <div class="card-header">
                  <div class="d-flex flex-row row align-items-center" id="headingOne">
                     <div class="m-0 p-0 col-6">
                        <button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapse_{{$unit->id}}" aria-expanded="false" aria-controls="collapse_{{$unit->id}}"> 
                           {{$unit->unit_title}} <span><i class="fas fa-caret-down"></i></span>
                        </button>
                     </div>
                     <div class="col-3">
                        <div title="Du hast {{$count_news}} neue Nachrichten" class="text-left mt-3" style="min-width: 5rem">
                           @if($count_news > 0)
                              <button type="button" data-toggle="collapse" data-target="#collapse_{{$unit->id}}" aria-expanded="false" aria-controls="collapse_{{$unit->id}}" class="btn btn-primary ml-3" style=""><i class=" far fa-envelope"></i></button>
                              <span class="badge news_notify badge-danger" style="position: relative; top:-15px; left:-12px;">{{$count_news}}</span>
                           @endif
                        </div>
                     </div>
                     <div class="col my-3 text-center">
                        <small>Fällig</small><br>
                        <small class="">{{$unit_done_date->diffForHumans()}}</small>
                     </div>
                  </div>
                  <div class="row  mt-3">
                     <div class="col">
                        <div class="d-flex justify-content-start align-items-baseline">
                           <h5 class="">Bearbeitungsstand:   </h5>
                           <p>  {{$progress_text}}</p>
                        </div>
                        @if($progress < 5)
                           <div class="progress bg-secondary">
                              <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="{{$progress}}" aria-valuemin="100" aria-valuemax="100" style="width: 100%">
                              </div>
                           </div>
                        @else
                           <div class="progress bg-secondary">
                              <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$progress}}%">
                              </div>
                           </div>
                        @endif
                     </div>
                  </div>
               </div>

               <div id="collapse_{{$unit->id}}" class="collapse 
                  @if (session('unit_open') == $unit->id) 
                     show
                  @endif
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
                              @foreach ($tasks as $task)
                                 @php
                                    $news_task =  count($task->results->where('result_viewed','==',NULL)->where('created_by','student')->all());  
                                 @endphp
                                 <tr>
                                    <td class="d-flex flex-row justify-content-start align-items-end">
                                       @if ($news_task > 0)
                                          <a href="/lehrer/auftraege/viewed/{{$task->id}}">
                                             <div title="Du hast {{$news_task}} neue Nachrichten" class="text-left"  id="div_news_{{$task->id}}">
                                                <span data-toggle="collapse" data-target="#collapse_task_news_{{$task->id}}" aria-expanded="true" aria-controls="collapse_task_news_{{$task->id}}" title="Nachrichten zu dieser Aufgabe anschauen" class="align-bottom clickable btn btn-link text-left">{{$task->block->title}} <i class="fas fa-caret-down"></i></span>
                                                <span class="badge news_notify badge-danger" style="position: relative; top:-18px; left:-12px;">{{$news_task}}</span>
                                             </div>
                                          </a>
                                       @else
                                          <span data-toggle="collapse" data-target="#collapse_task_news_{{$task->id}}" aria-expanded="true" aria-controls="collapse_task_news_{{$task->id}}" title="Nachrichten zu dieser Aufgabe anschauen" class="align-bottom clickable btn btn-link text-left">{{$task->block->title}} <i class="fas fa-caret-down"></i></span> 
                                       @endif
                                    </td>
                                    <td>
                                       @if ($task->interaction_id > 1)
                                          <small>{{$task->interaction->interaction_name}}</small>
                                       @endif
                                    </td>
                                    <td class="text-center align-middle">
                                       @switch($task->interaction_id)
                                          @case(1)
                                             @break
                                          @case(2)
                                             @if (count($task->results->where('ready_message',1)) == 0)
                                                @if($task->done_date < Carbon::now())
                                                   <span class="text-danger" ><i class="fa-2x fas fa-times-circle"></i></span>
                                                @else
                                                   <span class="text-warning"><i class="fa-2x fas fa-hourglass-half"></i></span>
                                                @endif
                                             @else
                                                <span class="text-success" title="Der Schüler hat die Bearbeitung bestätigt."><i class="fa-2x fas fa-check-circle"></i></span>
                                             @endif
                                             @break
                                          @case(3)
                                             @if (count($task->results->where('result_message',1)) == 0)
                                                @if($task->done_date < Carbon::now())
                                                      <span class="text-danger" ><i class="fa-2x fas fa-times-circle"></i></span>
                                                   @else
                                                      <span class="text-warning"><i class="fa-2x fas fa-hourglass-half"></i></span>
                                                   @endif
                                                @else
                                                   @php
                                                      $result = $task->results->where('result_message',1)->first();   
                                                   @endphp
                                                   <a class="btn-sm btn-success" href="{{$result->result_url}}">Zum Ergebnis</a>
                                                @endif
                                             @break
                                          @default
                                       @endswitch
                                    </td>
                                 </tr>

                                 {{-- Teil für Nachrichten--}}
                                 <tr class="">
                                    <td colspan="4" >
                                       @if (session('task_news_open') == $task->id)
                                       <div id="collapse_task_news_{{$task->id}}" class="news card bg-primary border-primary collapse show" aria-labelledby="">
                                       @else
                                       <div id="collapse_task_news_{{$task->id}}" class="news card bg-primary border-primary collapse" aria-labelledby="">
                                       @endif
                                          <div class="card-header">
                                             <h5 class="text-white">Deine Nachrichten zur Aufgabe: {{$task->block->title}}</h5>
                                          </div>

                                          {{-- Aufträge des Lehrers als fest gepinnte Nachrichten--}}
                                          <div class="card-body">
                                             @switch($task->interaction_id)
                                                @case(1)
                                                @break
                                                @case(2)
                                                   @if (count($task->results->where('ready_message',1)) > 0)
                                                      <div class="d-flex justify-content-start">
                                                         <div class="otherBubble bg-warning w-75 shadow">
                                                            <div class="d-flex justify-content-end">
                                                               <span><i class="fas fa-map-pin"></i></span>
                                                            </div>
                                                            <p class="card-text p-2"><small>{{$student->student_name}} hat Dir zurückgemeldet, er hat die Aufgabe erledigt.</small></p>
                                                            @if (count($task->results->where('feedback_message',1)) == 0)
                                                            <div class="text-right">
                                                               <form action="/lehrer/auftrag/erledigt/danke" method="post" enctype="multipart/form-data">
                                                                  @csrf
                                                                  <input type="hidden" name="task_id" value="{{$task->id}}">
                                                                  <input type="hidden" name="created_by" id="feedback_created_by{{$task->id}}" value="teacher">
                                                                  <input type="hidden" name="feedback_message" id="feedback_message_{{$task->id}}" value="1">
                                                                  <button type="submit" class="btn-sm btn-info">Danke, habe ich gesehen!</button>
                                                               </form>
                                                            </div>
                                                            @endif
                                                         </div>
                                                      </div>
                                                   @endif
                                                @break
                                                @case(3)
                                                   @if (count($task->results->where('result_url',1)) > 0)
                                                      <div class="d-flex justify-content-start">
                                                         <div class="otherBubble bg-warning w-75 shadow">
                                                            <div class="d-flex justify-content-end">
                                                               <span><i class="fas fa-map-pin"></i></span>
                                                            </div>
                                                            <p class="card-text p-2"><small>{{$student->student_name}} hat Dir einen Ergebnislink geschickt.</small></p>
                                                            @if (count($task->results->where('feedback_message',1)) == 0)
                                                            <div class="text-right">
                                                               <form action="/lehrer/auftrag/ergebnislink/feedback" method="post" enctype="multipart/form-data">
                                                                  @csrf
                                                                  <input type="hidden" name="task_id" value="{{$task->id}}">
                                                                  <input type="hidden" name="created_by" id="feedback_created_by{{$task->id}}" value="teacher">
                                                                  <input type="hidden" name="feedback_flag" id="feedback_flag_{{$task->id}}" value="1">
                                                                  <textarea class="form-control" name="message" id="feedback_message_{{$task->id}}" rows="5"></textarea>
                                                                  <button type="submit" class="btn-sm btn-info">Danke, habe ich gesehen!</button>
                                                               </form>
                                                            </div>
                                                            @endif
                                                         </div>
                                                      </div>
                                                   @endif
                                                @break
                                                @default
                                             @endswitch
                                          </div>
                                          {{--Ende Aufträge des Lehrers--}}

                                          <div class="card-body overflow-auto" style="max-height:300x;">
                                             @foreach ($task->results->sortBy('created_at') as $result)
                                                @if($result->created_by == 'student')
                                                   @if($result->ready_message !== 1)
                                                      <div class="d-flex text-white justify-content-end mr-3">
                                                         <span><small class="">{{$result->created_at->diffForHumans()}}</small></span>
                                                      </div>
                                                      <div class="d-flex justify-content-start">
                                                         <div class="otherBubble bg-warning w-75 shadow">
                                                            <p class="card-text p-2"><small>{{$result->message}}</small></p>
                                                         </div>
                                                      </div>
                                                   @endif
                                                @else
                                                   @if ($result->feedback_message !== 1)
                                                      <div class="d-flex text-white justify-content-end mr-3">
                                                         <span><small class="">{{$result->created_at->diffForHumans()}}</small></span>
                                                      </div>
                                                      <div class="d-flex justify-content-end">
                                                         <div class="ownBubble bg-light w-75 shadow">
                                                            <p class="card-text p-2"><small>{{$result->message}}</small></p>
                                                         </div>
                                                      </div>
                                                   @endif
                                                @endif
                                             @endforeach
                                          </div>
                                          <div class="card-footer">
                                             <form action="/lehrer/auftrag/nachricht" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="created_by" value="teacher">
                                                <input type="hidden" name="task_id" value="{{$task->id}}">
                                                <div class="input-group mb-3">
                                                   <input name="message" id="message_in_box{{$task->id}}" type="text" class="form-control" placeholder="Schreibe eine Nachricht an {{$student->student_name}} hier..." aria-label="message_to_student" aria-describedby="button-addon2">
                                                   <div class="input-group-append">
                                                      <button class="btn btn-link text-warning" type="submit" id="button_send_message_{{$task->id}}"><i class="fa-2x fas fa-arrow-circle-up"></i></button>
                                                   </div>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                    </td>
                                 </tr>
                                 {{-- Ende Teil für Nachrichten--}}
                              
                                 @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         @endforeach
   @endisset
</div>
@endsection

@section('scripts')

@endsection
