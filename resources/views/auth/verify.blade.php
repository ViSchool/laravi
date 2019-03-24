@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-5">
                <div class="card-header">{{ __('Bitte bestätige Deine Emailadresse') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Wir haben Dir eine neue Email mit einem Bestätigungslink geschickt.') }}
                        </div>
                    @endif

                    {{ __('Bevor es weitergeht, würden wir Dich bitten, Deine Emailadresse zu bestätigen.') }}
                    {{ __('Solltest Du die Email nicht erhalten haben, prüfen bitte Deinen Spam-Ordner oder ') }}, <a href="{{ route('verification.resend') }}">{{ __('klick hier um die Email erneut zu senden.') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection