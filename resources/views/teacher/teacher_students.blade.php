@extends('layout')

@section('stylesheets')
@endsection

@section('page-header')
<section id="page-header">
    <div class="container p-3">
	    <h4>Meine Schüler- und Klassenaccounts</h4>
    </div>
</section> 
@endsection

@section('content')

<div class="container mt-3">
    <h3>Klassenaccounts</h3>
    <p>Mit einem "Klassenaccount" kannst Du Deine privat veröffentlichten Inhalte auch Deiner Klasse zugänglich machen. Der Vorteil: Du brauchst nicht auf die Freigabe von ViSchool warten, sondern kannst sofort loslegen mit Deinen Themen, Inhalten und Lerneinheiten. Für einen Klassenaccount brauchst Du nur einen Nutzernamen und ein Passwort anlegen. Dieses gibst Du Deinen Schülern. Sobald Du den Zugang wieder sperren willst, lösche den Zugang einfach wieder hier. 
    </p>

    <a class="btn btn-primary mb-4" href="/lehrer/klassenaccounts">Zu den Klassenaccounts</a>

</div>

<div class="container mt-3 ">
    <h3>Schüleraccounts</h3>
    <p>Auch mit einem "Schüleraccount" können die Schüler Deine privat veröffentlichten Inhalte bei der ViSchool ansehen. Zusätzlich können Schüler mit einem Schüleraccount auch eigene digitale Inhalte erstellen und auf der ViSchool veröffentlichen. Dies ist zum Beispiel dann sinnvoll, wenn Schüler ein eigenes Quiz erstellen sollen und Du alle Ergebnisse in Deinem Lehreraccount sehen möchtest. 
    Schülersccounts bestehen wie Klassenaccounts immer nur aus einem pseudonymisierten Benutzernamen und einem Passwort. Du kannst Schüleraccounts auch automatisiert für 30 Schüler erstellen. 
    </p>

    <a class="btn btn-primary mb-4" href="/lehrer/schueleraccounts">Zu den Schüleraccounts</a>

</div>



@endsection




@section('scripts')
<script type="text/javascript">
    @if (count($errors) > 0)
        $('#newGroupModal').modal('show');
    @endif
</script>  
@endsection