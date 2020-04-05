@component('mail::message')

<h1>Hallo Ihr Beiden,  </h1>

ich bin's Eure ViSchool-App! Ihr habt eine neue Anfrage, also los, kümmert Euch drum! 

@component('mail::panel')
von:     {{$inquiry->lehrername}} <br>
Fach:    {{$inquiry->fach}} <br>
Thema:   {{$inquiry->thema}} <br>
Email:   {{$inquiry->email}} <br>
Telefon: {{$inquiry->phone}} <br>

Das ist die Nachricht: <br>
@endcomponent

    
@component('mail::panel')
   {{$inquiry->message}}
@endcomponent






Du kannst direkt antworten: 

@component('mail::button', ['url' => $url, 'color' => 'success'])
Jetzt antworten
@endcomponent



Yippieh!,<br>
Deine ViSchool-App

@endcomponent
