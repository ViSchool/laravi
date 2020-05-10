@extends('layout')

@section ('page-header')
<section id="page-header">
   <div class="container p-3">
      <h4>Das sind Deine Aufgaben, {{$student->student_name}}:</h4>
   </div>
</section> 
@endsection

@section ('content')
<div class="container my-5">
   @isset($jobsByTeacher)
      @foreach ($jobsByTeacher as $teacher_id  => $jobs)
         @php
            $teacher = App\User::findOrFail($teacher_id);
         @endphp
         <h3 class="mt-3 text-brand-blue">Aufträge von: {{$teacher->teacher_name}} {{$teacher->teacher_surname}}</h3>                       
         @foreach ($jobs as $job)
            @php
               $progress = round(count($job->tasks->where('student_check',1))/count($job->tasks)*100);
               $count_news = 0;
               foreach($job->tasks as $task) {
                  $news = count($task->results->where('result_viewed',NULL)->where('created_by','teacher'));
                  $count_news = $count_news + $news;
               }
            @endphp
            <div id="card_{{$job->unit_id}}" class="card mb-3">
               <div class="card-header">
                  <div class="d-flex flex-row align-items-top my-3">
                     <div class="m-0 p-0 col-5">
                        <button class="btn btn-link text-left m-0" type="button" data-toggle="collapse" data-target="#collapse_{{$job->unit_id}}_{{$teacher_id}}" aria-expanded="false" aria-controls="collapse_{{$job->unit_id}}_{{$teacher_id}}">
                           {{$job->unit->unit_title}} <span><i class="fas fa-caret-down"></i></span>
                        </button>
                     </div>
                     <div class="col-4">
                        @if ($job->jobStatus->id == 3)
                           <form action="/schueler/lerneinheit_starten" method="POST" enctype="multipart/form-data">
                              @method('PATCH')
                              @csrf
                              <input type="hidden" name="job_id" value="{{$job->id}}">
                              <div class="d-flex flex-column">
                                 <button class="btn-sm btn-primary" type="submit" title="Klicke hier um mit der Lerneinheit zu starten">Starten </button>
                              </div>
                           </form>
                        @else
                           @if ($job->jobStatus->id > 3)
                              @if($job->jobStatus->id < 11)
                                 <div class="d-flex flex-column">
                                    <a class="m-1 btn-sm btn-warning text-center" href="/unit/{{$job->unit_id}}"> Zur Lerneinheit </a>
                                    <form class="m-1" action="/schueler/auftraege/abgeben" method="post">
                                       @csrf @method('PATCH')
                                       <input type="hidden" name="student_id" value="{{$student->id}}">
                                       <input type="hidden" name="job_id" value="{{$job->id}}">
                                       @if ($progress < 100)
                                          <button title="Kreuze alle Aufgaben als fertig an, um die Aufgabe abzugeben." class="w-100 btn-sm btn-secondary text-center" disabled type="submit"> Abgeben </button>
                                       @else
                                          <button class="w-100 btn-sm btn-success text-center" type="submit"> Abgeben </button>
                                       @endif
                                    </form>
                                 </div>
                              @else 
                                 <div class="d-flex flex-column">
                                    <form class="m-1" action="/schueler/auftraege/zurueckholen" method="post">
                                       @csrf @method('PATCH')
                                       <input type="hidden" name="student_id" value="{{$student->id}}">
                                       <input type="hidden" name="job_id" value="{{$job->id}}">
                                       <button class="w-100 btn-sm btn-info text-center" type="submit"> Zu schnell abgegeben, nochmal zurückholen! </button>
                                    </form>
                                 </div>
                              @endif
                           @endif
                           <div title="Du hast {{$count_news}} neue Nachrichten" class="text-left mt-3" style="min-width: 5rem">
                              @if($count_news > 0)
                                 <button type="button" data-toggle="collapse" data-target="#collapse_{{$job->unit_id}}_{{$teacher_id}}" aria-expanded="false" aria-controls="collapse_{{$job->unit_id}}_{{$teacher_id}}" class="btn btn-primary ml-3" style=""><i class=" far fa-envelope"></i></button>
                                 <span class="badge news_notify badge-danger" style="position: relative; top:-15px; left:-12px;">{{$count_news}}</span>
                              @endif
                           </div>
                        @endif
                     </div>
                     <div class="col text-center">
                        <small>Fällig</small><br>
                        <small class="">{{$job->done_date->diffForHumans()}}</small>
                     </div>
                  </div>
                  @if ($job->jobStatus->id > 3)
                     <div class="row" id="headingTwo">
                        <div class="col">
                           <small>So viel hast Du schon geschafft:</small>
                           @if($progress < 5)
                              <div class="progress bg-secondary">
                                 <div class="progress-bar bg-secondary" role="progressbar" aria-valuenow="{{$progress}}" aria-valuemin="100" aria-valuemax="100" style="width: 100%">{{$progress}}%</div>
                              </div>
                           @else
                              <div class="progress bg-secondary">
                                 <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$progress}}%">{{$progress}}%</div>
                              </div>
                           @endif
                        </div>
                     </div>
                  @endif
               </div>

               <div id="collapse_{{$job->unit_id}}_{{$teacher_id}}" class="collapse 
                  @if (session('unit_open') == $job->unit_id) show @endif
                  " aria-labelledby="headingOne">

                  <div class="card-body">
                     <div class=" table-borderless table-responsive m-0 p-0" >
                        <table class="table mx-1" >
                           <thead class="">
                              <th>Einzelne Aufgaben</th>
                              <th class="text-center">Aufgabe fertig?</th>
                           </thead>
                           <tbody>
                              @foreach ($job->tasks as $task)
                                 @php
                                 $news_task =  count($task->results->where('result_viewed','==',NULL)->where('created_by','teacher')->all());
                                 @endphp
                                 <tr>
                                    <td class="d-flex flex-row justify-content-start align-items-end">
                                       @if ($news_task > 0)
                                          <a href="/schueler/auftraege/viewed/{{$task->id}}">
                                             <div title="Du hast {{$news_task}} neue Nachrichten" class="text-left" style="min-width: 5rem" id="div_news_{{$task->id}}">
                                                <span data-toggle="collapse" data-target="#collapse_task_news_{{$task->id}}" aria-expanded="true" aria-controls="collapse_task_news_{{$task->id}}" title="Nachrichten zu dieser Aufgabe anschauen" class="align-bottom clickable btn btn-link text-left">{{$task->block->title}} <i class="fas fa-caret-down"></i></span>
                                                <span class="badge news_notify badge-danger" style="position: relative; top:-18px; left:-12px;">{{$news_task}}</span>
                                             </div>
                                          </a>
                                       @else
                                          <span data-toggle="collapse" data-target="#collapse_task_news_{{$task->id}}" aria-expanded="true" aria-controls="collapse_task_news_{{$task->id}}" title="Nachrichten zu dieser Aufgabe anschauen" class="align-bottom clickable btn btn-link text-left">{{$task->block->title}} <i class="fas fa-caret-down"></i></span> 
                                       @endif
                                    </td>
                                    <td class=" align-middle text-center">
                                       <form action="/schueler/auftrag/student_check" method="post" enctype="multipart/form-data">
                                          @csrf @method('PATCH')
                                          <input type="hidden" name="task_id" value="{{$task->id}}">
                                          @if ($task->student_check == 1)
                                             <input type="checkbox" name="result_for_student_check" value="1" id="result_for_student_check_{{$task->id}}" checked onChange="this.form.submit()">
                                             <input type="hidden" name="result_for_student_check" value="0">  
                                          @else 
                                             @switch($task->interaction_id)
                                                @case(1)
                                                   <input type="checkbox" name="result_for_student_check" value="1" id="result_for_student_check_{{$task->id}}"  onChange="this.form.submit()"> 
                                                @break
                                                @case(2)
                                                   @if (count($task->results->where('ready_message',1)) > 0) 
                                                      <input type="checkbox" name="result_for_student_check" value="1" id="result_for_student_check_{{$task->id}}"  onChange="this.form.submit()"> 
                                                   @else
                                                      <input type="checkbox" name="result_for_student_check" value="1" id="result_for_student_check_{{$task->id}}" disabled onChange="this.form.submit()">
                                                      <span class="text-danger" title="Du musst noch eine Rückmeldung geben."><i class="fas fa-exclamation-triangle"></i></span>
                                                   @endif
                                                @break
                                                @case(3)
                                                   @if (count($task->results->where('result_url','!==',NULL)) > 0) 
                                                      <input type="checkbox" name="result_for_student_check" value="1" id="result_for_student_check_{{$task->id}}"  onChange="this.form.submit()"> 
                                                   @else
                                                      <input type="checkbox" name="result_for_student_check" value="1" id="result_for_student_check_{{$task->id}}" disabled onChange="this.form.submit()">
                                                      <span class="text-danger" title="Du musst noch eine Rückmeldung geben."><i class="fas fa-exclamation-triangle"></i></span>
                                                   @endif
                                                @break
                                                @default
                                             @endswitch
                                          @endif
                                       </form>
                                    </td>
                                 </tr>

                                 {{-- Teil für Nachrichten--}}
                                 <tr class="">
                                    <td colspan="4" >
                                       <div id="collapse_task_news_{{$task->id}}" class="news card bg-primary border-primary collapse 
                                          @if (session('task_news_open') == $task->id) show @endif
                                       " aria-labelledby="">
                                          <div class="card-header">
                                             <h5 class="text-white">Deine Nachrichten zur Aufgabe: {{$task->block->title}}</h5>
                                          </div>

                                          {{-- Aufträge des Lehrers als fest gepinnte Nachrichten--}}  
                                          <div class="card-body">
                                             <div class="d-flex justify-content-start">
                                                <div class="otherBubble bg-warning w-75 shadow">
                                                   <div class="d-flex justify-content-end">
                                                      <span><i class="fas fa-map-pin"></i></span> 
                                                   </div>
                                                   @switch($task->interaction_id)
                                                      @case(1)
                                                         <p class="card-text p-2"><small>Eine Rückmeldung zu dieser Aufgabe ist nicht nötig. Wenn Du Fragen hast, schreibe aber gerne eine Nachricht. </small></p>
                                                      @break
                                                      @case(2)
                                                         <p class="card-text p-2"><small>Melde bitte hier zurück, wenn Du Deine Aufgabe erledigt hast:</small></p>
                                                         @if (count($task->results->where('ready_message',1)) > 0)
                                                            <div class="d-flex justify-content-between">
                                                               @if(count($task->results->where('feedback_message')) < 0)
                                                                  <a href="/schueler/auftrag/erledigt/zuruecknehmen/{{$task->id}}"><small> Meldung zurücknehmen </small></a>
                                                               @else 
                                                                  <small>Deine Rückmeldung wurde bestätigt.</small>
                                                               @endif
                                                               <span class="text-success"> <i class="fa-2x far fa-check-square"></i></span>
                                                            </div>
                                                         @else
                                                            <div class="text-right">
                                                               <form action="/schueler/auftrag/erledigt" method="post" enctype="multipart/form-data">
                                                                  @csrf
                                                                  <input type="hidden" name="task_id" value="{{$task->id}}">
                                                                  <input type="hidden" name="created_by" id="created_by" value="student">
                                                                  <input type="hidden" name="ready_message" id="ready_message_{{$task->id}}" value="1">
                                                                  <button type="submit" class="btn-sm btn-info">Ich habe die Aufgabe erledigt.</button>
                                                               </form>
                                                            </div>
                                                         @endif
                                                      @break
                                                      @case(3)
                                                         <p class="card-text p-2"><small>Dein Lehrer möchte zu dieser Aufgabe einen Link zu Deiner Lösung von Dir haben:</small></p>
                                                         @if (count($task->results->where('result_url','!==',NULL)) > 0) 
                                                            <div class="d-flex justify-content-between">
                                                               @if(count($task->results->where('feedback_message',1)) < 1)
                                                                  <a href="/schueler/auftrag/ergebnis/zuruecknehmen/{{$task->id}}"><small> Meldung zurücknehmen </small></a>
                                                               @else
                                                                  @php
                                                                     $feedback = $task->results->where('feedback_message',1);
                                                                  @endphp
                                                                  <small> Das ist die Korrektur zur Deiner Lösung:  </small>
                                                                  <small> {{$feedback->message}}  </small>
                                                               @endif
                                                               <span class="text-success"> <i class="fa-2x far fa-check-square"></i></span>
                                                            </div>
                                                         @else
                                                            <div class="d-flex justify-content-end">
                                                               <button type="button" class="btn-sm btn-success" data-toggle="modal" data-target="#resultModal_{{$task->id}}">Ergebnis zur Aufgabe senden</button>
                                                            </div>
                                                         @endif
                                                      @break
                                                      @default
                                                   @endswitch
                                                </div>
                                             </div>
                                          </div>
                                          {{--Ende Aufträge des Lehrers--}}

                                          <div class="card-body overflow-auto" style="max-height:300x;">
                                             @foreach ($task->results->sortBy('created_at') as $result)
                                                @if($result->created_by == 'teacher')
                                                   @if($result->feedback_message !== 1)
                                                      <div class="d-flex flex-column justify-content-start w-75 mb-3 my-1">
                                                      <div class="d-flex text-white justify-content-between mb-0">
                                                         <span class="ml-3"><small>{{$job->teacher->teacher_name}} {{$job->teacher->teacher_surname}}</small></span>
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
                                                   @if ($result->ready_message !== 1)
                                                      <div class="row mb-3 my-1">
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
                                             <form action="/schueler/auftrag/nachricht" method="post" enctype="multipart/form-data" >
                                                @csrf
                                                <input type="hidden" name="created_by" value="student">
                                                <input type="hidden" name="task_id" value="{{$task->id}}">
                                                <div class="input-group mb-3">
                                                   <input name="message" id="message_in_box{{$task->id}}" type="text" class="form-control" placeholder="Schreibe eine Nachricht an {{$teacher->teacher_name}} {{$teacher->teacher_surname}} hier..." aria-label="message_to_student" aria-describedby="button-addon2">
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


                                 {{-- Modal für Ergebnis--}}
                                 <div class="modal fade" id="resultModal_{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="resultModalLabel">Schicke Dein Ergebnis zur Aufgabe "{{$task->block->title}}"</h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                             </button>
                                          </div>
                                          <form action="/schueler/auftrag/ergebnis" method="post" enctype="multipart/form-data">
                                             @csrf
                                             <div class="modal-body form-group">
                                                <input type="hidden" name="task_id" value="{{$task->id}}">
                                                <input type="hidden" name="created_by" id="created_by" value="student">
                                                <label class="col-form-label" for="result_url">Kopiere den Link zu Deinem Ergebnis hierhin: </label>
                                                <input class="form-control mb-5" type="url" name="result_url" id="result_url_{{$task->id}}" required placeholder="https://....">
                                                <textarea class="form-control" name="message" id="message_{{$task->id}}" rows="5" placeholder="Hier kannst Du noch eine zusätzliche Nachricht zu Deinem Ergebnis für {{$teacher->teacher_name}} {{$teacher->teacher_surname}} hinterlassen..." ></textarea>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                                                <button type="submit" class="btn btn-primary">Nachricht senden</button>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div> 
                                 {{-- Ende Modal für Ergebnis--}}
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         @endforeach
      @endforeach
   @endisset
</div>
@endsection

@section('scripts')

@endsection
