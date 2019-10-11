@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-5">
                <div class="card-header">{{ __('Vielen Dank!') }}</div>

                <div class="card-body">
                    Vielen Dank, Deine Emailadresse wurde verifiziert. Du kannst Dich jetzt die Lehrerfunktione von ViSchool nutzen. 
                </div>
                <div class="card-footer text-center">
                    <a  class="btn btn-primary" href="/">Zur Startseite</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection