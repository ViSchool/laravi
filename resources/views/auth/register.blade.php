@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Für den Lehrerzugang anmelden</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/register" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        
                        <div class="form-group{{ $errors->has('teacher_name') ? ' has-error' : '' }}">
                            <label for="teacher_name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="teacher_name" type="text" class="form-control" name="teacher_name" value="{{ old('teacher_name') }}"  autofocus>

                                @if ($errors->has('teacher_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('teacher_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('teacher_surname') ? ' has-error' : '' }}">
                            <label for="teacher_surname" class="col-md-4 control-label">Nachname</label>

                            <div class="col-md-6">
                                <input id="teacher_surname" type="text" class="form-control" name="teacher_surname" value="{{ old('teacher_surname') }}" required autofocus>

                                @if ($errors->has('teacher_surname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('teacher_surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">
                                E-Mail Adresse 
                                <p class="small">Bitte benutze hier Deine Emailadresse der Schule, da wir Deinen Account verifizieren.</p>
                            </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       <div class="form-group{{ $errors->has('contract') ? ' has-error' : '' }}">
                            <label for="contract" class="control-label px-4">Wähle das von Dir gewünschte Angebot:</label>
                            <div class="card-deck p-3">
                                <div class="card mb-3" style="min-width:200px;">
                                    <div class="card-header bg-warning">
                                       <div class="form-check form-check-inline d-flex justify-content-start">
                                            <input class="form-check-input mr-4" type="radio" name="contract" id="kostenlos_radio" value="free">
                                            <label class="form-check-label" for="kostenlos_radio">Kostenlos</label>
                                        </div> 
                                    </div>
                                    <div class="card-body">
                                        <ul class="pl-2 m-2">
                                            <li class="small">5 private Lerneinheiten</li> 
                                            <li class="small">1 Jahr technischer Support</li> 
                                        </ul>
                                    </div>
                                    <div class="card-footer text-center ">
                                        <small><br></small>
                                        <small class="">kostenlos</small>
                                    </div>
                                </div>
                                <div class="card mb-3" style="min-width:200px;">
                                    <div class="card-header bg-warning">
                                       <div class="form-check form-check-inline d-flex justify-content-start">
                                            <input class="form-check-input mr-4" type="radio" name="contract" id="lehrer_radio" value="premium">
                                            <label class="form-check-label text-black" for="lehrer_radio">Lehrer</label>
                                        </div> 
                                    </div>
                                    <div class="card-body">
                                        <ul class="pl-2 m-2">
                                            <li class="small">30 private Lerneinheiten</li> 
                                            <li class="small">1 Jahr kostenloser technischer und inhaltlicher Support</li>
                                            <li class="small">6 Monate kostenlos testen</li>    
                                        </ul>
                                    </div>
                                    <div class="card-footer text-center">
                                        <br>
                                        <small class="" >12 Euro/ Jahr</small>
                                    </div>
                                </div>
                                <div class="card mb-3" style="min-width:200px;">
                                    <div class="card-header bg-warning">
                                       <div class="form-check form-check-inline d-flex justify-content-start">
                                            <input class="form-check-input mr-4" type="radio" name="contract" id="schule_radio" value="premium">
                                            <label class="form-check-label" for="schule_radio"> Schulaccount</label>
                                        </div> 
                                    </div>
                                    <div class="card-body">
                                        <small>Bitte wähle unten Deine Schule aus</small>
                                    </div>
                                    <div class="card-footer text-center">
                                        <small class="">kostenlos für Lehrer der Schule</small>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('contract'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('contract') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="mt-4 form-group{{ $errors->has('school_id') ? ' has-error' : '' }}">
                            <label for="school_id" class="col-md-4 control-label">ViSchool-Schulaccount</label>
                            <div class="col-md-6">
                                <select class="form-control" name="school_id" id="school_id">
                                    <option value="">Bitte auswählen, wenn ViSchool-Schulaccount existiert</option>
                                    @foreach ($schools as $school )
                                        <option value="{{$school->id}}">{{$school->school_name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('school_id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('school_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Passwort</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Passwort bestätigen</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('newsletter') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <input class="form-check-input mt-2" type="checkbox" aria-label="Checkbox for Newsletter" id="newsletter" name="newsletter" value="1">
                                <label for="newsletter" class="form-check-label ml-5">ViSchool-Newsletter abbonieren?</label>
                                @if ($errors->has('newsletter'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('newsletter') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>
                        <div class="form-group col-md-6">
                                <strong>
                                    Einverständniserklärung zur Erhebung personenbezogener Daten
                                </strong>
                                <p>
                                    Ich bin damit einverstanden, dass die ViSchool GbR ("ViSchool") anhand der von mir eingegeben Daten (wie z.B. meinen Namen und meine E-Mail Adresse) und sonstigen Daten, die bei ViSchool über mich gemäß der <a href="/datenschutz">Datenschutzerklärung</a>  gespeichert sind, ein Profil mit meinen Daten und den von mir erstellten Inhalten speichert und pflegt. Ich kann mein Profil jederzeit in meinem Leherkonto editieren. Wenn ich mein Lehrerkonto lösche, löscht ViSchool auch das über mich erstellte Profil. Sofern ich auch den Newsletter bestelle, wird meine Emailadresse auch für den Versand des Newsletters an diese Emailadresse verwendet. Die Daten werden nicht an Dritte weitergegeben. 
                                    
                                    Ich bin mir bewusst, dass ich diese Einwilligungserklärung jederzeit mit Wirkung für die Zukunft widerrufen kann. Dazu wende ich mich an ViSchool, z.B. über: info@vischool.de.
                                </p>
                            </div>
                        
                        <div class="form-group{{ $errors->has('data_privacy') ? ' has-error' : '' }}">
                            <div class="col-md-6">
                                <input class="form-check-input mt-2" type="checkbox" aria-label="Checkbox for Data Privacy" id="data_privacy" name="data_privacy" value="1">
                                <label for="data_privacy" class="form-check-label ml-5">Ich willige in die Erhebung meiner personenbezogenen Daten ein.</label>
                                @if ($errors->has('data_privacy'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('data_privacy') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4 d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">
                                    Als Lehrer registrieren
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
