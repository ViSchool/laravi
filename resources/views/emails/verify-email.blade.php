@component('mail::message')

<h1>Willkommen bei ViSchool</h1>

Mit Deiner Emailadresse wurde ein neuer Lehrer-Zugang bei vischool.de angemeldet. 
Bitte bestätige Deine Emailadresse, indem Du auf den Button drückst. 

@component('mail::button', ['url' => $url, 'color' => 'primary'])
Email bestätigen
@endcomponent

Vielen Dank,<br>
Dein ViSchool-Team

<small>
@lang(
    "Sollte der Button nicht funktionieren, kannst Du auch den folgenden Link \n".
    'in Deinen Browser kopieren: [:actionURL](:actionURL)',
    [
        'actionText' => 'Email bestätigen',
        'actionURL' => $url,
    ]
)
</small>

@endcomponent
