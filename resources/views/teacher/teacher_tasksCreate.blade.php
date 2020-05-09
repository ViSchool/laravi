@extends('layout')

@section('stylesheets')
   <link rel="stylesheet" href="/css/datepicker.css">

@endsection

@section('page-header')
<section id="page-header">
    <div class="container p-3">
	    <h4>Gewünschte Rückmeldungen festlegen </h4>
    </div>
</section> 
@endsection

@section ('content')
    <div class="container-fluid my-4">
        @if(Session::has('success'))
            <div class="alert alert-success my-3">
        	    {{ Session::get('success') }}
            </div>
        @endif
        <div class="card">
            <form action="/lehrer/auftrag/aufgaben/erstellen" method="post" enctype="multipart/form-data">
                @csrf 
                

                
                
                <input type="hidden" name="job_id" value={{$job->id}}>
                <div id="interactions" class="form-group col-10 mx-auto">
                    <label class="col-form-label">Welche Art von Rückmeldung sollen Dir Deine Schüler zu folgender Lerneinheit geben? </label>
                    <h5 class="col-10 mt-3">"{{$job->unit->unit_title}}"</h5>
                    @foreach ($blocks->sortBy('order') as $block)
                        <div class="form-group col-10">
                            <div class="d-flex flex-row justify-content-start align-items-center">
                                @if (count($blocks->where('order',$block->order)) > 1) 
                                    <label for="block_interaction_id" class="col-form-label"><small>Aufgabe: "{{$block->title}}" <br> (Differenzierung: {{$block->differentiation->differentiation_title}})</small></label>
                                @else
                                    <label for="block_interaction_id" class="col-form-label"><small>Aufgabe: "{{$block->title}}"</small></label>
                                @endif
                                <a href="#" data-toggle="modal" data-target="#info_modal">
                                    <span class="ml-3 mt-1"><i class="fas fa-info-circle" style="color: orange"></i></span>
                                </a>
                            </div>

                            <select name="block_interaction_ids[]" id="block_interaction_ids" class="form-control">
                                @foreach ($interactions as $interaction )
                                    <option value="{{$block->id}}|{{$interaction->id}}">{{$interaction->interaction_name}}</option>
                                @endforeach
                            </select>

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
                                                <p class="ml-4"><a target="_blank" href="/content/{{$block->content->id}}"><small>{{$block->content->content_title}}</small></a></p>
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

                <div class="col-10 mx-auto form-group{{ $errors->has('assignment') ? ' invalid' : '' }}">
                    <label for="assignment" class="col-form-label">Du kannst den Auftrag Deinen Schülern sofort anzeigen oder in Deiner Auftragsübersicht später aktivieren. Wähle aus:</label>
                    <div class="  d-flex flex-column justify-content-between px-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="assignment" id="inlineRadio1" value="sofort" checked>
                            <label class="form-check-label" for="inlineRadio1"><small>Sofort</small> </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="assignment" id="inlineRadio2" value="spaeter">
                            <label class="form-check-label" for="inlineRadio2"><small>Später</small> </label>
                        </div>
                    </div>
                    @if ($errors->has('assignment'))
                        <span class="help-block">
                            <strong>{{ $errors->first('assignment') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="card-footer d-flex justify-content-end">
                    <div class="col-10 mx-auto form-group">
                        <button type="submit" class="btn-sm btn-primary form-control">Auftrag speichern</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')

@endsection