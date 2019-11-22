@extends('layout')

@section('stylesheets')
@endsection

@section('page-header')
<section id="page-header">
    <div class="container p-3">
	    <h4>Mein Lehrerkonto</h4>
    </div>
</section> 
@endsection

@section('content')

@php
 $teacher_id = $teacher->id;   
@endphp
<div class="container mt-3">
     @if (\Session::has('message'))
        <div class="alert alert-warning">
            <p>{!! \Session::get('message') !!}</p>
    	</div>
	@endif
    <div class="card mt-5 mb-5">
        <div class="card-header text-center">
            <h3 class="text-brand-blue m-3">Hallo {{$teacher->teacher_name}}! </h3> 
        </div>
        <div class="card-body">
            <h4 class="card-title mb-5">Mit folgenden Daten bist Du selbst bei der ViSchool registriert:</h4>
            <div class="row d-flex align-items-center mb-3">
                <label for="email" class="col-4">Name</label>
                <input id="email" type="email" class="col-6" name="email" value="{{ $teacher->teacher_name }} {{$teacher->teacher_surname}}" readonly>
            </div> 
            <div class="row d-flex align-items-center mb-3">
                <label for="email" class="col-4">E-Mail Adresse</label>
                <input id="email" type="email" class="col-6" name="email" value="{{ $teacher->email }}" readonly>
            </div>
            <div class="row d-flex align-items-center mb-3">
                <label for="email" class="col-4">ViSchool-Schulaccount</label>
                <input id="email" type="email" class="col-6" name="email" value="
                    @isset($teacher->school_id) 
                        {{$teacher->school->school_name}}
                    @else Kein Schulaccount zugeordnet
                    @endisset
                    " readonly>
            </div> 
            
            <div class="row d-flex align-items-center mb-3">
                <label class="col-4">Passwort ändern? </label>
                <!-- Button trigger modal -->
                <button type="button" class="btn-sm btn-primary" data-toggle="modal" data-target="#passwordModal">Passwort ändern</button>
               

                <!-- Modal -->
                <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="POST" action="/lehrer/{{$teacher_id}}/passwortaendern" enctype="multipart/form-data">
                                @csrf @method('PATCH')     
                                <div class="modal-header">
                                    <h5 class="modal-title" id="passwordModalLabel">Passwort ändern</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">    
                                    <div class="form-group{{ $errors->has('oldpassword') ? ' invalid' : '' }}">
                                        <label for="oldpassword" class="col-md-4 col-form-label">Altes Passwort</label>
                                        <div class="col-md-12">
                                            <input id="oldpassword" type="password" class="form-control" name="oldpassword" required>
                                            @if ($errors->has('oldpassword'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('oldpassword') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>                                         
                                    <div class="form-group{{ $errors->has('password') ? ' invalid' : '' }}">
                                        <label for="password" class="col-md-4 col-form-label">Neues Passwort</label>
                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control" name="password" required>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm" class="col-md-4 col-form-label">Neues Passwort bestätigen</label>
                                        <div class="col-md-12">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                                    <button type="submit" class="btn btn-primary">Neues Passwort speichern</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr>
            
            <h3 class="mt-3 mb-5">Einstellungen</h3>
            <ul class="list-group list-group-flush">
                <li class="list-group-item border-0 my-0">
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="differentiationSwitch"  @if ($teacher->differentiation_on == 1) checked="checked" @endif>
                            <label class="custom-control-label" for="differentiationSwitch">Individuelle Lernniveaus für die Binnendifferenzierung nutzen</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div id="editDiff"  
                            @if ($teacher->differentiation_on == 1) 
                                class="d-block"
                            @else
                                class="d-none"
                            @endif
                        >
                            <div class="form-row my-0">
                                <small class="ml-5 mb-3 mt-0"> <a href="/lehrer/{{$teacher->id}}/lernniveaus/übersicht">Individuelle Lernniveaus bearbeiten</a></small>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item border-0">
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="newsletterSwitch"   @if ($teacher->newsletter == 1) checked="checked" @endif>
                            <label class="custom-control-label" for="newsletterSwitch">Newsletter abonnieren?</label>
                        </div>
                    </div>
                </li>
            </ul>            
            <hr>
            <h3 class="mt-3 mb-5">Statistik</h3>
            <div class="row d-flex align-items-center mb-3">
                <label for="units" class="col-7">alle Lerneinheiten:</label>
                <input id="units" type="number" class="col-2 text-center"  value="{{$teacher->units->count()}}" readonly>
            </div>
            <div class="row d-flex align-items-center mb-3">
                <p class="col-7">davon private Lerneinheiten:</p>
                <input id="units" type="number" class="col-2 text-center"  value="{{$teacher->units->where('status_id', 3)->count()}}" readonly>
            </div>
            <div class="row d-flex align-items-center mb-3">
                <label for="contents" class="col-7">Inhalte:</label>
                <input id="contents" type="number" class="col-2 text-center"  value="{{$teacher->contents->count()}}" readonly>
            </div>
            <div class="row d-flex align-items-center mb-5">
                <label for="contents" class="col-7">Themen:</label>
                <input id="contents" type="number" class="col-2 text-center"  value="{{$teacher->topics->count()}}" readonly>
            </div>
            <div class="row d-flex align-items-center mt-5 mb-3">
                <label for="contents" class="col-7">Schüleraccounts:</label>
                <input id="contents" type="number" class="col-2 text-center"  value="{{$studentsCount}}" readonly>
            </div>
            <div class="row d-flex align-items-center mb-3">
                <label for="contents" class="col-7">Klassenaccounts:</label>
                <input id="contents" type="number" class="col-2 text-center"  value="{{$classCount}}" readonly>
            </div>
        </div>
        <div class="card-footer text-muted pt-5">
           Registriert: {{\Carbon\Carbon::parse($teacher->created_at)->diffForHumans()}}
        </div>
    </div>
</div>    


@endsection

@section('scripts')
<script>
$('document').ready(function () {
   $('#differentiationSwitch').change(function () {
      var diffOn = $('#differentiationSwitch').prop('checked');
      console.log(diffOn);
      var teacherId = {!! json_encode($teacher->id) !!};
      console.log(teacherId);
      if (diffOn == true) {
         $('#editDiff').removeClass('d-none');
         $('#editDiff').addClass('d-block');
         var saveData = $.ajax({
                url: '/lehrer/profile/diffOn/'+teacherId,
                type: "GET",
                complete:function(jqXHR, textStatus) {console.log("completed:"+ textStatus)}
        });
      }
      else {
         $('#editDiff').removeClass('d-block');
         $('#editDiff').addClass('d-none');
         var saveData = $.ajax({
                url: '/lehrer/profile/diffOff/'+teacherId,
                type:"GET",
                complete:function(jqXHR, textStatus) {console.log("completed:"+ textStatus)}
        });
      }
   });
});

</script>    

@endsection