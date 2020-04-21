@extends('layout')

@section('stylesheets')
   <link rel="stylesheet" href="/css/datepicker.css">

@endsection

@section('page-header')
<section id="page-header">
    <div class="container p-3">
	    <h4>Einen neuen Auftrag erstellen</h4>
    </div>
</section> 
@endsection

@section ('content')
    <div class="card">
        <section id="vischool_task">    
            <div class="container-fluid my-4">
                @if(Session::has('success'))
                    <div class="alert alert-success my-3">
        	            {{ Session::get('success') }}
                    </div>
                @endif
            </div>
            <form action="/lehrer/auftrag/erstellen" method="post" enctype="multipart/form-data">
                @csrf 
                @honeypot
                @if(session('unit'))
                    @php
                        $selectedUnit = App\Unit::findOrFail(session('unit'));
                        $block_order_last = 0;
                    @endphp
                @endif

                <div class="card m-5 mx-auto w-75" >
                    <div class="card-header">   
                        <h4 class="m-0 p-0 card-title text-brand-blue justify-content-center d-flex align-items-center">Neuer Auftrag </h4>
                    </div>
                    <div class="card-body">
                        <div class="col-10 mx-auto form-group{{ $errors->has('subject') ? ' invalid' : '' }}">
                            <label for="subject_id" class="col-form-label">Welche Lerneinheit möchtest Du Deinen Schülern als Auftrag geben? </label>
                            <label for="subject_id" class="col-form-label">Wähle bitte zunächst das Fach aus:</label>
                            <select class="form-control text-secondary" id="subject_id" name="subject_id">
                                @if((old('subject_id')) !== null)
                                    @php 
                                        $subject_id_old = old('subject_id');
                                        $subject_old = App\Subject::where('id', '=' , $subject_id_old)->first();
                                    @endphp
                                    <option value="{{$subject_id_old}}">{{$subject_old->subject_title}}</option>
                                @endif
                                @empty(old('subject_id'))
                                    <option value="">Bitte hier Fach auswählen</option>
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

                        <div class="col-10 mx-auto form-group{{ $errors->has('unit') ? ' invalid' : '' }}">
                            <label for="unit_id" class="col-form-label">Welche Lerneinheit möchtest Du Deinen Schülern als Auftrag geben? </label>
                            <select class="form-control text-secondary" id="unit_id" name="unit_id">
                                @if(session('unit'))
                                    <option value="{{$selectedUnit->id}}">{{$selectedUnit->unit_title}}</option>
                                    {{-- @foreach ($units as $unit)
                                        <option value="{{$unit->id}}">{{$unit->unit_title}}</option>
                                    @endforeach --}}
                                @elseif((old('unit_id')) !== null)
                                    @php 
                                        $unit_id_old = old('unit_id');
                                        $unit_old = App\Unit::where('id', '=' , $unit_id_old)->first();
                                    @endphp
                                    <option value="{{$unit_old->id}}">{{$unit_old->unit_title}}></option>                          
                                @endif
                               
                                @empty(old('unit_id'))
                                    <option value="0">Zuerst Fach auswählen</option>
                                @endempty
                                    </select>
                            @if ($errors->has('unit_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('unit_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div id="btn_step2" class="d-none col-10 mx-auto form-group">
                            <input name="interaction_btn" type="submit" class="btn-sm btn-light form-control border border-secondary" value="Gewünschte Rückmeldungen festlegen">
                        </div>
                
                        @if (session('unit'))
                            <div id="interactions" class="form-group col-8 mx-auto">
                                <label class="col-form-label">Welche Art von Rückmeldung sollen Deine Schüler Dir geben?</label>
                                @foreach ($selectedUnit->blocks->sortby('order') as $block)
                                    <div class="form-group">
                                        @if ($block->order !== $block_order_last)
                                        <div class="d-flex flex-row justify-content-start align-items-center">
                                            <label for="block_interaction_id" class="col-form-label"><small>Aufgabe: "{{$block->title}}"</small></label>
                                            <a href="#" data-toggle="modal" data-target="#info_modal">
                                                <span class="ml-3 mt-1"><i class="fas fa-info-circle" style="color: orange"></i></span>
                                            </a>
                                        </div>
                                        
                                           <select name="block_interaction_ids[]" id="block_interaction_ids" class="form-control">
                                            @foreach ($interactions as $interaction )
                                           <option value="{{$block->id}}|{{$interaction->id}}|{{$block->order}}">{{$interaction->interaction_name}}</option>
                                            @endforeach
                                            </select> 
                                        @else
                                            <input type="hidden" name="block_interaction_copies[]" id="block_interaction_same" value="{{$block->id}}|{{$block->order}}">
                                        @endif
                                        
                                        @php
                                            $block_order_last = $block->order;
                                        @endphp
                                        
                                        {{-- Modal mit weitergehenden Infos zu der Aufgabe --}}
                                        <div class="modal fade" id="info_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{$block->title}}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Aufgabe:</p>
                                                        <p class="ml-4"><small>{!!$block->task!!}</small></p>
                                                        <hr>
                                                        <p>Inhalt:</p>
                                                        @if ($block->content_id !== NULL) 
                                                        <p class="ml-4"><small>{{$block->content->content_title}}</small></p>
                                                        @else
                                                        <p class="ml-4"><small>Diese Aufgabe enthält keinen digitalen Inhalt.</small></p>
                                                        @endif

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Schließen</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Ende Modal --}}
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <div class="col-10 mx-auto form-group{{ $errors->has('student') ? ' invalid' : '' }}">
                            <label for="student" class="col-form-label">Welche Klasse oder welcher Schüler soll die Lerneinheit bearbeiten?</label>
                            <select class="form-control text-secondary" id="student_id" name="student_id" placeholder="Klasse oder Schüler auswählen">
                                @if((old('student_id')) !== null)
                                    @php 
                                        $student_id_old = old('student_id');
                                        $student_old = App\Student::where('id', '=' , $student_id_old)->first();
                                    @endphp
                                    <option value="{{$student_old->id}}">{{$student_old->student_name}}</option>                            
                                @else 
                                    <option value="">Bitte Schüler auswählen</option>
                                @endif
                                <optgroup label="Klassen">
                                    @foreach ($studentgroups as $studentgroup)
                                        <option value="{{$studentgroup->id}}_studentgroup">{{$studentgroup->studentgroup_name}}</option>
                                    @endforeach
                                </optgroup>   
                                <optgroup label="Schüler">
                                    @foreach ($students as $student)
                                <option value="{{$student->id}}_student">{{$student->student_name}}</option>
                                    @endforeach
                                </optgroup>   
                            </select>
                            @if ($errors->has('student_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('student_id') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="col-10 mx-auto form-group{{ $errors->has('done_date') ? ' invalid' : '' }}">
                            <label for="student" class="col-form-label">Bis wann sollen die Klasse oder der Schüler die Aufgabe erledigt haben? 
                            <div class="input-append date mt-3" id="datepicker"  data-date-format="dd.mm.yyyy">
                            <input class="form-control text-secondary" size="12" type="text" id="done_date" name="done_date" placeholder="Bitte Datum auswählen">
                                <span class="add-on"></span>
                            </div>
                            @if ($errors->has('done_date'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('done_date') }}</strong>
                                </span>
                            @endif
                        </div>
                        
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <div class="col-10 mx-auto form-group">
                            <button type="submit" class="btn-sm btn-primary form-control">Auftrag speichern</button>
                        </div>
                    </div> 
                </div>   
            </form>           
        </section>
    </div>
@endsection

@section('scripts')

<script src="{{asset('js/select_subject_unit.js')}}"></script>
<script src="{{asset('js/bootstrap-datepicker.js')}}"> </script>
<script type="text/javascript" src="/js/bootstrap-datepicker.de.js" charset="UTF-8"></script>

<script>
    $(document).ready(function(){
    $("select#unit_id").change(function(){
       $('#btn_step2').removeClass('d-none');
       $('#interactions').addClass('d-none');  
    });
});
</script>



<script>
    $(document).ready(function() {
        $('#done_date').click(function() {
            $('#datepicker').datepicker('show');
        });
    });  
</script>

@endsection