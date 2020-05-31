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
    @if (\Session::has('successDowngrade'))
        <div class="alert alert-success">
            <p>{!! \Session::get('successDowngrade') !!}</p>
    	</div>
    @endif

    <div class="card m-5">
        <div class="card-header text-center">
            <h3 class="text-brand-blue m-3">Hallo {{$teacher->teacher_name}}! </h3> 
        </div>
        <div class="card-body">
            <h4 class="card-title mb-5">Mit folgenden Daten bist Du selbst bei der ViSchool registriert:</h4>
            <div class="flex-row d-flex align-items-center mb-3 form-group justify-content-between">
                <label for="email" class="col-4">Name:</label>
                <input class="text-secondary form-control" id="email" type="email" name="email" value="{{ $teacher->teacher_name }} {{$teacher->teacher_surname}}" readonly>
            </div>
            <div class="flex-row d-flex align-items-center mb-3 form-group justify-content-between">
                <label for="email" class="col-4">E-Mail Adresse:</label>
                <input class="text-secondary form-control" id="email" type="email" name="email" value="{{ $teacher->email }}" readonly>
            </div>
            <div class="flex-row d-flex align-items-center mb-3 form-group justify-content-between">
                <label for="contract" class="col-4">Art des Accounts:</label>
                <input class="text-secondary form-control" id="contract" type="text" name="contract" value="{{$teacher->contract->contract_title}}" readonly>
            </div>
            @if($teacher->contract_id == 2 && Carbon::now()->subMonths(6) < $teacher->email_verified_at)
                <div class="flex-row d-flex align-items-center mb-3 form-group justify-content-between">
                    <label for="test" class="col-4">Probezeitraum läuft ab:</label>
                    <input class="text-secondary form-control" id="test" type="text" name="test" value="{{Carbon::create($teacher->email_verified_at)->addMonths(6)->format('d.m.Y')}}" readonly>
                </div>
            @endif
            <div class="flex-row d-flex align-items-center mb-3 form-group justify-content-between">
                <label for="email" class="col-4">ViSchool-Schulaccount:</label>
                <input class="text-secondary form-control" id="email" type="email" name="email" value="
                    @isset($teacher->school_id)
                        {{$teacher->school->school_name}}
                    @else Kein Schulaccount zugeordnet
                    @endisset
                    " readonly>
            </div>
            <div class="flex-row d-flex align-items-center mb-3 form-group justify-content-between">
                <label class="col-4">Passwort ändern? </label>
                <!-- Button trigger modal -->
                <button type="button" class="btn-sm btn-primary" data-toggle="modal" data-target="#passwordModal">Passwort ändern</button>
            </div>


            <!-- Modal Passwort ändern -->
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
                                            <span class="help-block"><strong>{{ $errors->first('oldpassword') }}</strong></span>
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
            <!-- Ende Modal Passwort ändern -->

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
        <div class="card-footer text-muted d-flex justify-content-between">
           <span>Registriert: {{\Carbon\Carbon::parse($teacher->created_at)->diffForHumans()}}</span>
            <button type="button" class="btn-sm" data-toggle="modal" data-target="#deleteAccount">
                Account löschen
            </button>
        </div>

        <!-- Modal Account löschen -->
        <div class="modal fade" id="deleteAccount" tabindex="-1" role="dialog" aria-labelledby="deleteAccount" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Account bei ViSchool löschen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="card-text font-weight-bolder">Du willst Deinen Account mit dem Benutzernamen "{{$teacher->user_name}}" löschen?</p>
                    @if ($teacher->contract_id == 2)
                        <p class="card-text">Du hast Dich bei ViSchool mit einem kostenpflichtigen Account angemeldet. Möchtest Du Deinen Account zum Ende des Monats in einen kostenlosen Account umwandeln? Bitte beachte, dass Dir dann weniger private Lerneinheiten zur Verfügung stehen.</p>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-primary mb-4" href="/lehrer/account_downgrade_kostenlos">Ja, ändert meinen Account in einen kostenlosen Account!</a>
                        </div>
                    @endif
                    <p class="card-text mt-4">Wenn wir den Account löschen, sind auch alle Deine Inhalte bei ViSchool nicht mehr zugänglich, Deine privaten Lerneinheiten werden gelöscht. Möchtest Du die Inhalte und Lerneinheiten auch später ohne Account nutzen, dann beantrage für alle die Veröffentlichung bei ViSchool.de. Andernfalls löschen wir Deine privaten Lerneinheiten und Inhalte 7 Tage nach der Löschung Deines Accounts.</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                    <a href="/lehrer/account_löschen" class="btn btn-danger">Ganz sicher! Löscht den Account!</a>
                </div>
                </div>
            </div>
        </div>
        <!-- Modal Account löschen -->
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