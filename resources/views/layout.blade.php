  <!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="ViSChool, digitale Bildung, lernen">
    <meta name="author" content="Katharina Schedel | ViSchool">
    <link rel="icon" href="../../../../favicon.ico">

    <title>ViSchool</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    
    <!-- Custom styles for this template -->
    <link href="/css/new_app.css" rel="stylesheet">
    
@yield('stylesheets')

</head>
  
  <!-- Body  -->
<body>
	<header> 
@include('layouts.nav')
  </header> 
    
<!-- Hauptteil der Seite -->
<div id="page">

@yield('page-header')

<main role="main">

@yield('content')
	
</main>
</div>

      <!-- FOOTER -->
@include('layouts.footer')

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>

<script src="/js/app.js"></script>


@yield ('scripts')
<script>
$(function () {
  $('[data-toggle="popover"]').popover({html:true})
})
</script>

</body>
</html>