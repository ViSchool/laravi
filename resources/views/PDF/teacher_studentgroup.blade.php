 <!doctype html>
<html lang="de">

  <head>

    <title>ViSchool</title>
    <meta charset="utf-8">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    
    <!-- Custom styles for this template -->
    <link href="/css/app.css" rel="stylesheet">
</head>
  
  <!-- Body  -->
<body>
	<header>
      <div class="container">
         <div class="row">
            <div class="col">
              <h2 class="text-brand-blue">ViSchool</h2>
            </div>
         </div>
         <div class="row">
            <div class="col">
              <h4>Liste mit Passwörtern für die Schülergruppe "{{$studentgroup->studentgroup_name}}"</h4> 
            </div>
         </div>
      </div>
   </header> 
    
<!-- Hauptteil der Seite -->
<div id="page">
<main role="main">
  <div class="container">
    <table class="table table-striped table-bordered">
        <thead class="table-primary">
            <tr>
                <th scope="col">Benutzername</th>
                <th scope="col">Passwort</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
             <tr>
                <td>{{$student->student_name}}</td>
                <td>{{$student->password_cl}}</td>
              </tr>
            @endforeach
            
        </tbody>
    </table>
    <div>
    <p>Erstellt am: @php $time = Carbon\Carbon::now()->format('d M Y'); @endphp {{$time}} von {{$teacher->teacher_name}} {{$teacher->teacher_surname}}</p>
    </div>
  </div>
</main>
</div>

      <!-- FOOTER -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

<script src="/js/app.js"></script>


</body>
</html>