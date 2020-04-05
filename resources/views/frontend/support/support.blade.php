@extends('layout')

@section('page-header')
<section id="page-header">
    <div class="container p-3">
    <h4>Wir helfen Dir</h4>
    </div>
</section> 
@endsection

@section('content')
<section id="vischool_support">    
    <div class="container-fluid my-4">
         @if(Session::has('success'))
            <div class="alert alert-success my-3">
        	    {{ Session::get('success') }}
            </div>
        @endif
        <p class="w-75 mx-auto">Hier geht es zu unseren <a href="/faq">FAQ</a> . Vielleicht findest Du ja auch hier Hilfe. </p>

        <form action="/support" method="post" enctype="multipart/form-data">
             @csrf 
             @honeypot
            <div class="card m-5 mx-auto w-75" >
                <div class="card-header">   
                    <h4 class="m-0 p-0 card-title text-brand-blue justify-content-center d-flex align-items-center">Wie können wir Dir helfen ? </h4>
                </div>
                <div class="card-body">
                    <div class="col-10 mx-auto form-group{{ $errors->has('lehrername') ? ' invalid' : '' }}">
                        <label for="lehrername" class="col-form-label">Dein Name:</label>
                        <input id="lehrername" type="text" class="form-control" name="lehrername" value="{{ old('lehrername') }}" autofocus>
                        @if ($errors->has('lehrername'))                        
                            <span class="help-block">
                                <strong>{{ $errors->first('lehrername') }}</strong>
                            </span>
                        @endif
                    </div>
                     
                    <div class=" col-10 mx-auto form-group{{ $errors->has('fach') ? ' invalid' : '' }}">
                        <label for="fach" class="col-form-label">Dein Fach:</label>
                        <input id="fach" type="text" class="form-control" name="fach" value="{{ old('fach') }}" >
                        @if ($errors->has('fach'))
                            <span class="help-block">
                                <strong>{{ $errors->first('fach') }}</strong>
                            </span>
                        @endif
                    </div>
                     
                    <div class="col-10 mx-auto form-group{{ $errors->has('thema') ? ' invalid' : '' }}">
                        <label for="thema" class="col-form-label">Dein Unterrichtsthema:</label>
                        <input id="thema" type="text" class="form-control" name="thema" value="{{ old('thema') }}" >
                        @if ($errors->has('thema'))
                            <span class="help-block">
                                <strong>{{ $errors->first('thema') }}</strong>
                            </span>
                        @endif
                    </div>
                     
                    <div class="col-10 mx-auto form-group{{ $errors->has('email') ? ' invalid' : '' }}">
                        <label for="email" class="col-form-label">Emailadresse unter der wir Dich erreichen:</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-10 mx-auto form-group{{ $errors->has('phone') ? ' invalid' : '' }}">
                        <label for="phone" class="col-form-label">Falls Du möchtest, dass wir Dich anrufen, hinterlasse uns hier Deine Telefonnummer:</label>
                        <input type="tel" id="phone" name="phone"  placeholder="Format: 0171-1234567" class="form-control" value="{{old('phone')}}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="col-10 mx-auto form-group{{ $errors->has('email') ? ' invalid' : '' }}">
                        <label for="message" class="col-form-label">Deine Nachricht:</label>
                        <textarea id="message" rows="10" class="form-control" name="message" placeholder="Liebes ViSchool-Team,  ich interessiere mich für Lerneinheiten in Mathe für die 6. Klasse zum Thema ..... ">{{old('message')}}</textarea>
                        @if ($errors->has('message'))
                            <span class="help-block">
                                <strong>{{ $errors->first('message') }}</strong>
                            </span>
                        @endif
                    </div>
                    <small>Wir erheben Deine Daten aus diesem Kontaktformular lediglich, um Dich zu unserem Supportangebot zu kontaktieren.  Näheres hierzu kannst Du unserer <a href="/datenschutz#kontakt">Datenschutzerklärung</a>  entnehmen. </small>  
                </div>
                <div class="card-footer d-flex justify-content-end">
                    <button type="submit" class="btn-sm btn-primary">Nachricht senden</button>
                </div>    
            </form>           
   </div>
</div>
  


            </form>
        </div>
    </div>  
</section>

@endsection