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
   @isset($jobsByUnit)
         @foreach ($jobsByUnit as $unit_id => $jobs)
            @php
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
            @endphp


            <div id="card_unit{{$unit->id}}" class="card mb-3">
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
                        <small class="">{{$job->done_date->diffForHumans()}}</small>
                     </div>
                  </div>
                  <div class="row mt-3">
                     <div class="col">
                        <div class="d-flex justify-content-start align-items-baseline">
                           <h5 class="">Bearbeitungsstand: </h5>
                           <p> {{$job->jobStatus->jobStatus_description}}</p>
                        </div>
                        @if($job->jobStatus->jobStatus_progress < 5)
                           <div class="progress bg-secondary">
                              <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="{{$job->jobStatus->jobStatus_progress}}" aria-valuemin="100" aria-valuemax="100" style="width: 100%">
                              </div>
                           </div>
                        @else
                           <div class="progress bg-secondary">
                              <div class="progress-bar" role="progressbar" aria-valuenow="{{$job->jobStatus->jobStatus_progress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$job->jobStatus->jobStatus_progress}}%; {{--background: {{$progresscolor}};--}}">
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
                              @foreach ($job->tasks as $task)
                                 @php
                                    $news_task =  count($task->results->where('result_viewed','==',NULL)->where('created_by','student')->all());  
                                 @endphp
                                 <tr>
                                    <td class="d-flex flex-row justify-content-start">
                                       @if ($news_task > 0)
                                          <a href="/lehrer/auftraege/viewed/{{$task->id}}">
                                             <div title="Du hast {{$news_task}} neue Nachrichten" class="text-left"  id="div_news_{{$task->id}}">
                                                <span data-toggle="collapse" data-target="#collapse_task_news_{{$task->id}}" aria-expanded="true" aria-controls="collapse_task_news_{{$task->id}}" title="Nachrichten zu dieser Aufgabe anschauen" class="align-middle clickable btn btn-link text-left">{{$task->block->title}} <i class="fas fa-caret-down"></i></span>
                                                <span class=" badge news_notify badge-danger" style="position: relative; top:-18px; left:-12px;">{{$news_task}}</span>
                                             </div>
                                          </a>
                                       @else
                                          <span data-toggle="collapse" data-target="#collapse_task_news_{{$task->id}}" aria-expanded="true" aria-controls="collapse_task_news_{{$task->id}}" title="Nachrichten zu dieser Aufgabe anschauen" class="align-items-stretch align-middle clickable btn btn-link text-left">{{$task->block->title}}<i class="fas fa-caret-down"></i></span> 
                                       @endif
                                    </td>
                                    <td class="align-middle">
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
                                                   <span class="text-danger" title="Die Aufgabe wurde noch nicht erledigt."><i class="fa-2x fas fa-times-circle"></i></span>
                                                @else
                                                   <span class="text-warning"><i class="fa-2x fas fa-hourglass-half"></i></span>
                                                @endif
                                             @else
                                                <span class="text-success" title="Der Schüler hat die Bearbeitung bestätigt."><i class="fa-2x fas fa-check-circle"></i></span>
                                             @endif
                                             @break
                                          @case(3)
                                             @if (count($task->results->where('result_url', '!=', NULL)) == 0)
                                                @if($task->done_date < Carbon::now())
                                                      <span class="text-danger" ><i class="fa-2x fas fa-times-circle"></i></span>
                                                   @else
                                                      <span class="text-warning"><i class="fa-2x fas fa-hourglass-half"></i></span>
                                                   @endif
                                                @else
                                                   @php
                                                      $result = $task->results->where('result_url', '!=', NULL)->first();   
                                                   @endphp
                                                   <a class="text-success" href="{{$result->result_url}}"><small> Zum Ergebnis </small></a>
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
                                                   @if (count($task->results->where('result_url','!=',NULL)) > 0)
                                                      @php
                                                         $result = $task->results->where('result_url','!=',NULL)->first();
                                                      @endphp
                                                      <div class="d-flex justify-content-start">
                                                         <div class="otherBubble bg-warning w-75 shadow">
                                                            <div class="d-flex justify-content-end">
                                                               <span><i class="fas fa-map-pin"></i></span>
                                                            </div>
                                                            <p class="card-text p-2"><small>{{$student->student_name}} hat Dir einen Ergebnislink geschickt.</small></p>
                                                         <p class="card-text p-2"> <a title="Ergebnislink: {{$result->result_url}}" target="_blank" class="btn-sm btn-info form-control text-center" href="{{$result->result_url}}">Ergebnis ansehen</a></p>
                                                            @if (count($task->results->where('feedback_message',1)) == 0)
                                                            <div class="text-right">
                                                               <form action="/lehrer/auftrag/ergebnislink/feedback" method="post" enctype="multipart/form-data">
                                                                  @csrf
                                                                  <input type="hidden" name="task_id" value="{{$task->id}}">
                                                                  <input type="hidden" name="created_by" id="feedback_created_by{{$task->id}}" value="teacher">
                                                                  <input type="hidden" name="feedback_flag" id="feedback_flag_{{$task->id}}" value="1">
                                                                  <label class="text-left mb-0" for="message"><small> Hier kannst Du {{$student->student_name}} eine Nachricht hinterlassen: </small></label>
                                                                  <textarea class="form-control" name="message" id="feedback_message_{{$task->id}}" rows="5" placeholder="Gib Deinem Schüler hier ein Feedback zu seinem Ergebnis..."></textarea>
                                                                  <button type="submit" class=" btn-sm btn-info mt-2">Feedback senden</button>
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

                                          <div class="card-body overflow-auto" style="max-height:400x;">
                                             @foreach ($task->results->sortBy('created_at') as $result)
                                                @if($result->created_by == 'student')
                                                   @if($result->ready_message !== 1)
                                                   <div class="d-flex flex-column justify-content-start w-75 mb-3 my-1">
                                                      <div class="d-flex text-white justify-content-between mb-0">
                                                         <span class="ml-3"><small>{{$job->student->student_name}}</small></span>
                                                         <span><small class="mr-3">{{$result->created_at->diffForHumans()}}</small></span>
                                                      </div>
                                                      <div class="d-flex justify-content-start ">
                                                         <div class="otherBubble bg-warning shadow mt-0 w-100">
                                                            <p class="card-text p-1"><small>{{$result->message}}</small></p>
                                                         </div>
                                                      </div>
                                                   </div>
                                                   @endif
                                                @else
                                                   @if ($result->feedback_message !== 1)
                                                      <div class="row">
                                                         <div class="col-3"></div>
                                                         <div class="d-flex col-9 p-1 justify-content-end flex-column">
                                                            <div class="d-flex text-white justify-content-between mb-0">
                                                               <span class="ml-3"><small>Du</small></span>
                                                               <span><small class="mr-3">{{$result->created_at->diffForHumans()}}</small></span>
                                                            </div>
                                                            <div class="d-flex justify-content-end m-0">
                                                               <div class="ownBubble bg-light shadow w-100 m-0">
                                                                  <p class="card-text text-right p-2"><small>{{$result->message}}</small></p>
                                                               </div>
                                                            </div>
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
