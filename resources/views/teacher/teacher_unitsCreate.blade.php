@extends('layout')

@section('stylesheets')
@endsection

@section('page-header')
<section id="page-header">
    <div class="container p-3">
        <h4>Eine neue lerneinheit erstellen</h4>
    </div>
</section> 
@endsection

@section('content')

<div class="container mt-3">
    <form method="POST" action="/lehrer/lerneinheiten" enctype="multipart/form-data">
    @csrf 
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
                <h3 class="text-brand-blue m-3">Schritt 1: Lerneinheit anlegen</h3> 
            </div>
            <div class="card-body">
                
                <div class="form-group{{ $errors->has('unit_title') ? ' invalid' : '' }}">
                    <label for="unit_title" class="col-10 col-form-label">Titel der Lerneinheit</label>
                    <div class="col-10">
                        <input id="unit_title" type="text" class="form-control" name="unit_title" value="{{ old('unit_title') }}" required>
                        @if ($errors->has('unit_title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('unit_title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('unit_description') ? ' invalid' : '' }}">
                    <label for="unit_description" class="col-10 col-form-label mb-0 pb-0">Kurzbeschreibung der Lerneinheit</label>
                    <label for="unit_description" class="col-10 col-form-label mt-0 pt-0">
                        <small class="text-muted"> Beschreibe hier kurz was die Schüler mit der Einheit lernen sollen.</small>
                    </label>
                    <div class="col-10">
                        <textarea id="unit_description" class="form-control" name="unit_description">{{old('unit_description')}}</textarea>
                        @if ($errors->has('unit_description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('unit_description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('subject_id') ? ' invalid' : '' }}">
                    <label for="topic_id" class="col-10 col-form-label">Die Lerneinheit gehört zu folgendem Fach</label>
                    <div class="col-10">
                        <select class="form-control" id="subject_id" name="subject_id">
				            @if((old('subject_id')) !== null)
                                @php 
                                    $subject_id_old = old('subject_id');
                                    $subject_old = App\Subject::where('id', '=' , $subject_id_old)->first();
                                @endphp
                                <option value="{{$subject_id_old}}">{{$subject_old->subject_title}}</option>
				            @endif
		                    @empty(old('subject_id'))
                                <option value=""></option>
                            @endempty
		                    @foreach ($subjects as $subject)	
					            <option value="{{$subject->id}}">{{$subject->subject_title}}</option>
				            @endforeach
                        </select>
                        @if ($errors->has('topic_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('topic_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                        
                <div class="form-group{{ $errors->has('topic_id') ? ' invalid' : '' }}">
                    <label for="topic_id" class="col-10 col-form-label">Die Lerneinheit gehört zu folgendem Thema: </label>
                    
                    <div class="col-10">
                        <input list="topics" class="form-control" id="topic" name="topic" placeholder="Thema auswählen oder neues eintragen">
                        
                        <datalist id="topics">
                            @if((old('topic_id')) !== null)
                                @php 
                                    $topic_id_old = old('topic_id');
                                    $topic_old = App\Topic::where('id', '=' , $topic_id_old)->first();
                                @endphp
                                <option value="{{$topic_old->topic_title}}">                            @endif
                            @empty(old('topic_id'))
                                <option>Zuerst Fach auswählen</option>
                            @endempty
                        </datalist>
                        
                        <div class="col-md-2">
				            <span id="loader" style="visibility: hidden;">
					            <i class="far fa-spinner fa-spin"></i>
				            </span>
			            </div>
                        @if ($errors->has('topic_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('topic_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                
                @if($teacher->differentiation_on == 1)    
                <div class="form-group{{ $errors->has('differentiation_group') ? ' invalid' : '' }}">
                    <label for="differentiation_id" class="col-10 col-form-label">Differenzierung von Lernniveaus</label>
                    <label for="differentiation_id" class="col-10 col-form-label mt-0 pt-0">
                        <small class="text-muted">Wenn die Aufgabe nur von bestimmten Schülern bearbeitet werden soll, dann wähle hier die Gruppe von Lernniveaus aus, die Du für diese Lerneinheit benutzen möchtest. Ansonsten wähle "Keine Differenzierung".</small>
                    </label>
                    <div class="col-10">
                        <select class="form-control" name="differentiation_group" id="differentiation_group">
                            <option value="">Keine Differenzierung</option>
                            @isset($differentiation_groups)
                                @foreach ($differentiation_groups as $differentiation_group)
                                    <option value="{{$differentiation_group}}">{{$differentiation_group}}</option>
                                @endforeach
                            @endisset
                            <option value="Standard">Standard</option>
                            
                        </select>
                    </div>
                </div>
                 @endif

            </div>

            <div class="card-footer d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Lerneinheit anlegen</button> 
            </div>
        </div>
    </form>       
</div>    

@endsection

@section('scripts')

<script src="{{asset('js/datalist_subject_topic.js')}}"></script>

@endsection
