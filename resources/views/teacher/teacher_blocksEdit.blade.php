@extends('layout')

@section('stylesheets')

@endsection

@section('page-header')
<section id="page-header">
    <div class="container p-3">
        <h4>Aufgabe zur Lerneinheit "{{$block->unit->unit_title}}" bearbeiten</h4>
    </div>
</section> 
@endsection

@section('content')

<div class="container mt-3">
<form method="POST" action="/lehrer/lerneinheiten/aufgabe/bearbeiten/{{$block->id}}" enctype="multipart/form-data">
    @csrf @method('PATCH')
        <input type="hidden" name="block_id" value="{{$block->id}}">
        <input type="hidden" value="{{$teacher->id}}" name="user_id">
        <input 
            type="hidden" 
            name="teacherOrStudent" 
            @if ($teacher->teacher_id == $teacher->id)
                value="teacher" 
            @else 
                value="student"
            @endif    
        >
        <div class="card mb-3">
            <div class="card-header text-center">
                <h3 class="text-brand-blue m-3">Aufgabe bearbeiten</h3> 
            </div>
            <div class="card-body">
                
                <div class="form-group{{ $errors->has('block_title') ? ' invalid' : '' }}">
                    <label for="block_title" class="col-10 col-form-label">Überschrift für die Aufgabe</label>
                    <div class="col-10">
                        <input id="block_title" type="text" class="form-control" name="block_title" value="{{$block->title}}" required>
                        @if ($errors->has('block_title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('block_title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('task') ? ' invalid' : '' }}">
                    <label for="task" class="col-10 col-form-label mb-0 pb-0">Aufgabentext</label>
                    <label for="task" class="col-10 col-form-label mt-0 pt-0">
                        <small class="text-muted"> Schreibe hier möglichst präzise, was der Schüler tun soll, z.B.: <span class="text-muted font-italic">Schau Dir das folgende Video an.</span> </small>
                    </label>
                    <div class="col-10">
                        <textarea id="task" class="form-control" name="task">{{$block->task}}</textarea>
                        @if ($errors->has('task'))
                            <span class="help-block">
                                <strong>{{ $errors->first('task') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('content_id') ? ' invalid' : '' }}">
                    <label for="content_id_button" class="col-10 col-form-label mb-0 pb-0">Digitalen Inhalt hinzufügen (optional)</label>
                    <label for="content_id_button" class="col-10 col-form-label mt-0 pt-0">
                        <small class="text-muted"> Wenn Du der Aufgabe einen digitalen Inhalt hinzufügen willst, such Dir über den Button einen Inhalt aus.</small>
                    </label>
                    <div class="col-10 d-flex justify-content-start align-items-center">
                        
                        {{-- Inhalt einfügen, wenn es ein neuer Inhalt ist --}}
                        @if(Session::has('content_title'))
                            <div class="card bg-secondary mr-3" style="width: 150px;"> 
                                <div class="card-body text-white text-center">
                                   <small id="content_title"> {{Session::get('content_title')}} </small>
                                </div>
                            </div>
                            <input type="hidden" id="content_id" name="content_id" value="{{Session::get('content_id')}}">
                            <div>
                                <button  id="content_id_button" type="button" class="my-2 btn-sm btn-primary form-control" data-toggle="modal" data-target="#chooseContentModal">
                                    Inhalt aussuchen
                                </button>
                                <button  id="deleteContent" type="button" class="my-2 btn-sm btn-warning form-control">
                                    Keinen Inhalt verwenden
                                </button>
                            </div>
                        {{-- Inhalt einfügen, wenn es ein vorhandener Inhalt ist  --}}
                        @elseif ($block->content_id !== NULL)
                            <div class="card bg-secondary mr-3" style="width: 150px;"> 
                                <div class="card-body text-white text-center">
                                   <small id="content_title"> {{$block->content->content_title}} </small>
                                </div>
                            </div>
                            <div>
                                <button  id="content_id_button" type="button" class="my-2 btn-sm btn-primary form-control" data-toggle="modal" data-target="#chooseContentModal">
                                    Inhalt aussuchen
                                </button>
                                <input type="hidden" id="content_id" name="content_id" value="">
                                {{-- Button deleteContent ist ausgeblendet und wird erst nach Auswahl des Inhalts angezeigt --}}
                                <button  id="deleteContent" type="button" class="my-2 btn-sm btn-warning form-control ">
                                    Keinen Inhalt verwenden
                                </button>
                            </div>
                        @else
                            @php
                                session()->forget(['content_title','content_id']);
                            @endphp
                            <div class="card bg-secondary mr-3" style="width: 150px;"> 
                                <div class="card-body text-white text-center">
                                   <small id="content_title"> Du hast noch keinen Inhalt ausgesucht. </small>
                                </div>
                            </div>
                            <div>
                                <button  id="content_id_button" type="button" class="my-2 btn-sm btn-primary form-control" data-toggle="modal" data-target="#chooseContentModal">
                                    Inhalt aussuchen
                                </button>
                                <input type="hidden" id="content_id" name="content_id" value="">
                                {{-- Button deleteContent ist ausgeblendet und wird erst nach Auswahl des Inhalts angezeigt --}}
                                <button  id="deleteContent" type="button" class="d-none my-2 btn-sm btn-warning form-control ">
                                    Keinen Inhalt verwenden
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                <div id="chosenContent" class="form-group">
                </div>

                <div class="modal fade" id="chooseContentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalScrollableTitle">Inhalt aussuchen</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <small>Hier werden die alle Inhalte zu dem von Dir gewählten Thema angezeigt, wenn Du einen Inhalt eines anderen Themas einfügen willst, wähle hier ein anderes Fach und oder Thema aus.</small>


                                <div class="row">
                                @foreach ($contents as $content)
                                 
                                    <div class="col">
                                        @include('teacher.teacher_components.choose_content_card')
                                    </div>
                                @endforeach
                                </div>
                            </div>
                            <div class="modal-footer d-flex">
                                <button data-toggle="modal" data-dismiss="modal" data-target="#newInstantContentModal" id="newInstantContentModalCreate" type="button" class="btn btn-warning mr-auto">Neuer Inhalt</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                                <button data-toggle="modal" data-target="#chooseContentModal" id="chooseContentModalSave" type="button" class="btn btn-primary">Speichern</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group{{ $errors->has('time') ? ' invalid' : '' }}">
                    <label for="time" class="col-10 col-form-label">Zeit für die Aufgabe</label>
                    <div class="col-10">
                        <input id="time" type="number" class="form-control" name="time" value="{{$block->time}}" required>
                        @if ($errors->has('time'))
                            <span class="help-block">
                                <strong>{{ $errors->first('time') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('tipp') ? ' invalid' : '' }}">
                    <label for="task" class="col-10 col-form-label mb-0 pb-0">Tipp (optional)</label>
                    <label for="task" class="col-10 col-form-label mt-0 pt-0">
                        <small class="text-muted"> Hier kannst Du den Schülern noch einen Tipp für Ihre Aufgabe mitgeben.</small>
                    </label>
                    <div class="col-10">
                        <textarea id="tipp" class="form-control" name="tipp">{{$block->tips}}</textarea>
                        @if ($errors->has('tipp'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tipp') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                @if($block->unit->differentiation_group != NULL)
                <div class="form-group{{ $errors->has('differentiation_id') ? ' invalid' : '' }}">
                    <label for="differentiation_id" class="col-10 col-form-label">Differenzierung von Lernniveaus</label>
                    <label for="differentiation_id" class="col-10 col-form-label mt-0 pt-0">
                        <small class="text-muted">Die Aufgabe kann für unterschiedliche Lernniveaus der Gruppe <span class="font-weight-bold">"{{$block->unit->differentiation_group}}"</span> differenziert werden. Wähle hier das entsprechende Niveau aus oder wähle "Alle", wenn keine Differenzierung erfolgen soll.</small>
                    </label>
                    <div class="col-10">
                        <select class="form-control" id="differentiation_id" name="differentiation_id">
                            @if($block->differentiation_id !== null)
                                 @php 
                                    $differentiation_id_old = $block->differentiation_id;
                                    $differentiation_old = App\Differentiation::where('id', '=' , $differentiation_id_old)->first();
                                @endphp
                                @if ($block->differentiation_id !== 13)
                                    <option value="{{$differentiation_id_old}}">{{$differentiation_old->differentiation_title}}</option>
                                    <option value="13">Alle</option>
                                @else
                                    <option value="{{$differentiation_id_old}}">{{$differentiation_old->differentiation_title}}</option>
                                    @foreach($differentiations as $differentiation)
                                        <option value="{{$differentiation->id}}">{{$differentiation->differentiation_title}}</option>
                                    @endforeach
                                @endif
				            @endif
		                    @empty($block->differentiation_id)
                                <option value="">Bitte wählen</option>
                                @foreach($differentiations as $differentiation)
                                    <option value="{{$differentiation->id}}">{{$differentiation->differentiation_title}}</option>
                                @endforeach
                                <option value="13">Alle</option>
                            @endempty     
                        </select>
                        @if ($errors->has('differentiation_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('differentiation_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>  
                @endif              
            </div>            
                
            <div class="card-footer d-flex justify-content-between">
                <a href="/lehrer/lerneinheiten" class="btn btn-outline-danger">Abbrechen</a>
                <button type="submit" class="btn btn-primary">Änderungen speichern</button> 
            </div>
        </div>
</form>       
</div>    


{{-- Modal um neuen Inhalt einzustellen --}}
@include('teacher.teacher_components.newInstantContentModal',['tools'=>$tools,'subject_id'=>$unit->subject->id,'topic_id'=>$unit->topic->id,'block_id'=>$block->id])


@endsection

@section('scripts')

<script src="{{asset('js/ddd_subject_topic.js')}}"></script>
<script src="{{asset('js/unit_choose_existing_content.js')}}"></script>
<script src="{{asset('js/unit_choose_new_content.js')}}"></script>
<script src="{{asset('js/unit_delete_chosen_content.js')}}"></script>

@endsection
