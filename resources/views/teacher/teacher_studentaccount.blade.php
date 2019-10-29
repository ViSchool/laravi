@extends('layout')

@section('stylesheets')


@endsection

@section('page-header')
<section id="page-header">
    <div class="container p-3">
        <h4>Meine Schüleraccounts</h4>
        
    </div>
</section> 
@endsection

@section('content')


<div class="container mt-3">
    <h3>Schüleraccounts</h3>
    <p>Schüleraccounts können einzelnen Schülern zugeteilt werden. Im Gegensatz zu Klassenaccounts können Schüler mit einzelnen Accounts auch selbst Inhalte bei ViSchool erstellen und diese werden dann in Deinem Account angezeigt.
        Schüleraccounts können nicht von ViSchool einzelnen Schüler zugeordnet werden. Benutze für die manuell erstellten Schüleraccounts bitte auch nur Pseydonyme. Natürlich kannst Du als Lehrer durch die Zuordnung der pseudonymisierten Accounts an einzelne Schüler identifizieren, welcher Account von welchem Schüler genutzt wird. Dies ist dann aber ausschließlich Dir als Lehrer bekannt. 
        Erstelle Schüleraccounts manuell einzeln oder generiere Dir Schüleraccounts als komplette Klassenliste für bis zu 50 Schüler gleichzeitig. 
        </p>
</div>
<div class="container mb-3">
    <button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#newStudentModal">
Schüleraccount manuell erstellen</button>
    <button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#newListModal">
Schüleraccount automatisch erstellen</button>
</div>
<div class="container"> 
    <p>Einzelne Schüleraccounts</p>
    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th scope="col" colspan="2">Benutzername</th>
                <th scope="col">löschen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
             <tr>   
                <td colspan="2">{{$student->student_name}}</td>
                <td>
                    <form action="/lehrer/schueleraccount/loeschen/{{$student->id}}" method="post">
                        @csrf @method('DELETE')
                        <button class="btn text-brand-red" type="submit"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>

<p>Automatisch generierte Schüleraccounts</p>
    <table class="table table-striped">
        <thead class="table-primary">
            <tr>
                <th scope="col">Name der Schülergruppe</th>
                <th scope="col">Anzahl der Schüleraccounts</th>
                <th scope="col">Liste mit Namen/Passwort herunterladen</th>
                <th scope="col">Gruppe komplett löschen</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($studentgroups as $studentgroup)
             <tr>   
                <td>{{$studentgroup->studentgroup_name}}</td>
                <td>{{$studentgroup->accounts}}</td>
                @if ($studentgroup->students()->count() >0 )
                <td>Liste wurde bereits gespeichert</td> 
                @else
                <td class="text-center"><a href="/lehrer/schuelergruppe/schueleraccounts_erstellen/{{$studentgroup->id}}"><i class="far fa-file-pdf fa-2x" style="color:red;"></i></a></td>
                @endif
                <td>
                    <form action="/lehrer/schuelergruppe/löschen/{{$studentgroup->id}}" method="post">
                        @csrf @method('DELETE')
                        <button class="btn text-brand-red" type="submit"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>

    <!-- Modal NewStudent -->
    <div class="modal fade" id="newStudentModal" tabindex="-1" role="dialog" aria-labelledby="newStudentModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="/lehrer/schueleraccount/erstellen" enctype="multipart/form-data">
                @csrf 
                                
                    <div class="modal-header">
                        <h5 class="modal-title" id="newStudentModalLabel">Einen neuen Schüleraccount erstellen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">    
                        <input type="hidden" value="{{$teacher->id}}" name="user_id">
                        <input type="hidden" value="0" name="class_account">
                        
                        <div class="form-group{{ $errors->has('student_name') ? ' invalid' : '' }}">
                            <label for="student_name" class="col-md-4 col-form-label">Benutzername für den Schüleraccount</label>
                             <div class="col-10">
                             <input id="student_name" type="text" class="form-control" name="student_name" value="{{ old('student_name') }}" required>
                                @if ($errors->has('student_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('student_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' invalid' : '' }}">
                            <label for="password" class="col-md-4 col-form-label">Passwort für den Klassenaccount</label>
                             <div class="col-10">
                             <input id="password" type="text" class="form-control" name="password" value="{{ old('password') }}" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                        <button type="submit" class="btn btn-primary">Schüleraccount speichern</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal NewStudentList -->
    <div class="modal fade" id="newListModal" tabindex="-1" role="dialog" aria-labelledby="newListModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="/lehrer/schueleraccount_liste/erstellen" enctype="multipart/form-data">
                @csrf 
                                
                    <div class="modal-header">
                        <h5 class="modal-title" id="newListModal">Eine neue Liste mit Schüleraccounts erstellen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">    
                        <input type="hidden" value="{{$teacher->id}}" name="user_id">
                        <input type="hidden" value="0" name="class_account">
                        
                        <div class="form-group{{ $errors->has('number') ? ' invalid' : '' }}">
                            <label for="number" class="col-md-4 col-form-label">Wieviele Schüleraccounts willst Du erstellen?</label>
                             <div class="col-10">
                             <input id="number" type="number" class="form-control" name="number" value="{{ old('number') }}" required>
                                @if ($errors->has('number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('group_of_students') ? ' invalid' : '' }}">
                            <label for="group_of_students" class="col-md-4 col-form-label">Name für die Schülergruppe</label>
                             <div class="col-10">
                             <input id="group_of_students" type="text" class="form-control" name="group_of_students" value="{{ old('group_of_students') }}" required>
                                @if ($errors->has('group_of_students'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('group_of_students') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                        <button type="submit" class="btn btn-primary">Schüleraccounts erstellen</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



</div>

@endsection




@section('scripts')
<script type="text/javascript">
    @if (count($errors) > 0)
        $('#newStudentModal').modal('show');
    @endif
</script>  
@endsection