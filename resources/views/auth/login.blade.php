@extends('layout')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="col-md-10">
        <div class="card mb-3">
            <div class="card-header bg-white">Login</div>
            <div class="card-body">
                <form class="" method="POST" action="{{ route('login') }}">
                @csrf
                    <div class=" form-row form-group{{ $errors->has('email') ? ' invalid' : '' }}">
                        <label for="email" class="col-md-4 col-form-label">E-Mailadresse</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class=" form-row form-group{{ $errors->has('password') ? ' invalid' : '' }}">
                        <label for="password" class="col-md-4 col-form-label">Passwort</label>
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
                        <div class="col-md-6">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <div class="col-md-8">
                            <button type="submit" class="text-right btn btn-primary">
                                Anmelden
                            </button>
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Passwort vergessen?
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
