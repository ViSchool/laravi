@extends('layout')

@section('stylesheets')
@endsection

@section('page-header')
<section id="page-header">
    <div class="container p-3">
        <h4>Unterrichtseinheit "{{$unit->unit_title}}" ändern</h4>
    </div>
</section> 
@endsection

@section('content')

<div class="container mt-3">
<form method="POST" action="/lehrer/unterrichtseinheiten/bearbeiten/{{$unit->id}}" enctype="multipart/form-data">
    @csrf @method('PATCH')
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
                <h3 class="text-brand-blue m-3">Unterrichtseinheit ändern</h3> 
            </div>
            <div class="card-body">
                
                <div class="form-group{{ $errors->has('unit_title') ? ' invalid' : '' }}">
                    <label for="unit_title" class="col-10 col-form-label">Titel der Unterrichtseinheit</label>
                    <div class="col-10">
                        <input id="unit_title" type="text" class="form-control" name="unit_title" value="{{$unit->unit_title}}" required>
                        @if ($errors->has('unit_title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('unit_title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('unit_description') ? ' invalid' : '' }}">
                    <label for="unit_description" class="col-10 col-form-label mb-0 pb-0">Kurzbeschreibung der Unterrichtseinheit</label>
                    <label for="unit_description" class="col-10 col-form-label mt-0 pt-0">
                        <small class="text-muted"> Beschreibe hier kurz was die Schüler mit der Einheit lernen sollen.</small>
                    </label>
                    <div class="col-10">
                        <textarea id="unit_description" class="form-control" name="unit_description">{{$unit->unit_description}}</textarea>
                        @if ($errors->has('unit_description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('unit_description') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('subject_id') ? ' invalid' : '' }}">
                    <label for="subject_id" class="col-10 col-form-label">Die Unterrichtseinheit gehört zu folgendem Fach</label>
                    <div class="col-10">
                        <select class="form-control" id="subject_id" name="subject_id">
				            @if($unit->subject_id !== null)
                                @php 
                                    $subject_id_old = $unit->subject_id;
                                    $subject_old = App\Subject::where('id', '=' , $subject_id_old)->first();
                                @endphp
                                <option value="{{$subject_id_old}}">{{$subject_old->subject_title}}</option>
				            @endif
		                    @empty($unit->subject_id)
                                <option value=""></option>
                            @endempty
		                    @foreach ($subjects as $subject)	
					            <option value="{{$subject->id}}">{{$subject->subject_title}}</option>
				            @endforeach
                        </select>
                        @if ($errors->has('subject_id'))
                            <span class="help-block">
                                <strong>{{ $errors->first('subject_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                        
                <div class="form-group{{ $errors->has('topic_id') ? ' invalid' : '' }}">
                    <label for="topic_id" class="col-10 col-form-label">Die Unterrichtseinheit gehört zu folgendem Thema</label>
                    <div class="col-10">
                        <select class="form-control" id="topic_id" name="topic_id">
                            @if($unit->topic_id !== null)
                                @php 
                                    $topic_id_old = $unit->topic_id;
                                    $topic_old = App\Topic::where('id', '=' , $topic_id_old)->first();
                                @endphp
                                <option value="{{$topic_id_old}}">{{$topic_old->topic_title}}</option>
                            @endif
                            @empty($unit->topic_id)
                                <option>Zuerst Fach auswählen</option>
                            @endempty
                        </select>
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

                <div class="form-group{{ $errors->has('differentiation_group') ? ' invalid' : '' }}">
                    <label for="differentiation_id" class="col-10 col-form-label">Differenzierung von Lernniveaus</label>
                    <label for="differentiation_id" class="col-10 col-form-label mt-0 pt-0">
                        <small class="text-muted">Wenn die Aufgabe nur von bestimmten Schülern bearbeitet werden soll, dann wähle hier die Gruppe von Lernniveaus aus, die Du für diese Unterrichtseinheit benutzen möchtest. Ansonsten wähle "Keine Differenzierung".</small>
                    </label>
                    <div class="col-10">
                        <select class="form-control" name="differentiation_group" id="differentiation_group">
                            @if($unit->differentiation_group !== null)
                                <option>{{$unit->differentiation_group}}</option>
                            @endif
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

            </div>

            <div class="card-footer d-flex justify-content-between">
                <a href="/lehrer/unterrichtseinheiten" class="btn btn-outline-danger">Abbrechen</a>
                <button type="submit" class="btn btn-primary">Änderungen speichern</button> 
            </div>
        </div>
    </form>       
</div>    

@endsection

@section('scripts')

<script src="{{asset('js/choose_content.js')}}"></script>
<script src="{{asset('js/ddd_subject_topic.js')}}"></script>

@endsection
