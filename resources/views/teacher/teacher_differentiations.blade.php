@extends('layout')

@section('stylesheets')
@endsection

@section('page-header')
<section id="page-header">
    <div class="container p-3">
	    <h4>Meine individuellen Lernniveaus</h4>
    </div>
</section> 
@endsection

@section('content')


<div class="container mt-3">
    <p>Lernniveaus bieten die Möglichkeit innerhalb einer Unterrichtseinheit einzelne Aufgaben zu differenzieren. Damit kannst Du eine Binnendifferenzierung für Deine Schüler realisieren. Die Namen für die einzelnen Lernniveaus sind jeweils in Gruppen angelegt und Du kannst für Deine Lernniveaus genau die Namen benutzen, die Ihr an Eurer Schule dafür vereinbart habt.</p>
    
    <a href="/lehrer/{{$teacher->id}}/"></a>

    <div class="card-deck">
        @foreach ($differentiation_groups as $differentiation_group)
        <div class="card mt-5 mb-5" style="width: 200px">
            <div class="card-header">
                <h4 class="text-brand-blue">Gruppe: {{$differentiation_group}}</h4> 
            </div>
            <div class="card-body">         
                @php
                    $differentiations = App\Differentiation::where('differentiation_group',$differentiation_group)->get();  
                @endphp
                <p>Zu dieser Gruppe gehören folgende Lernniveaus:</p>
                <ul>
                    @foreach ($differentiations as $differentiation )
                        <li>{{$differentiation->differentiation_title}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    <form action="/lehrer/{{$teacher->id}}/lernniveaus/löschen/{{$differentiation_group}}" method="POST" enctype="multipart/form-data"> 
                    @csrf @method('DELETE')   
                        <button class="btn-sm" type="submit"><i class="fas fa-trash-alt"></i></button> 
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mb-5">
    <a class="btn-sm btn-primary" data-toggle="collapse" href="#newGroup" role="button" aria-expanded="false" aria-controls="newGroup">Eine neue Gruppe von Lernniveaus anlegen</a>
    </div>

    <div class="collapse multi-collapse" id="newGroup">
        <div class="card mt-5 mb-5" style="width: 200px">
        <form method="POST" action="/lehrer/{{$teacher->id}}/lernniveaus/erstellen" enctype="multipart/form-data">
                @csrf
                    <div class="card-header">
                    <input type="hidden" id="teacher_id" name="teacher_id" value="{{$teacher->id}}">
                        <div class="form-group{{ $errors->has('differentiation_group') ? ' has-error' : '' }}">
                            <label for="differentiation_group" class=" col-12 col-form-label text-brand-blue">Name der neuen Gruppe:</label>
                            <div class="col-12">
                                <input id="differentiation_group" type="text" class="form-control" name="differentiation_group" required>
                                @if ($errors->has('differentiation_group'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('differentiation_group') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>     
                    </div>
                    <div class="card-body">         
                        <div class="form-group{{ $errors->has('differentiations') ? ' has-error' : '' }}">
                            <label for="differentiations" class=" col-12 col-form-label"> <small>Zu dieser Gruppe gehören folgende Lernniveaus:</small></label>
                            <div class="col-12">
                                <div class="input-group">
                                    <input id="differentiation_1" type="text" class="form-control" name="differentiation_1" placeholder="Erstes Lernniveau" required>
                                    <input id="differentiation_2" type="text" class="form-control" name="differentiation_2" placeholder="Zweites Lernniveau" required>
                                    <input id="differentiation_3" type="text" class="form-control" name="differentiation_3" placeholder="Drittes Lernniveau (optional)">
                                    <input id="differentiation_4" type="text" class="form-control" name="differentiation_4" placeholder="Viertes Lernniveau (optional)">
                                    <input id="differentiation_5" type="text" class="form-control" name="differentiation_5" placeholder="Fünftes Lernniveau (optional)">
                                </div>
                                @if ($errors->has('differentiations'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('differentiation_group') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-12 mb-3 mt-3">
                                <button class="btn-sm btn-primary" type="submit"> Lernniveaus speichern</button>
                            </div>
                        </div> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>    


@endsection