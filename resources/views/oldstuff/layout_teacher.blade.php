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
       	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
        
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    
    <!-- Custom styles for this template -->
    <link href="/css/new_app.css" rel="stylesheet">
    
@yield('stylesheets')

</head>
  
  <!-- Body  -->
<body>
	<header> 
@include('layouts.nav_teacher')
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
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<svg xmlns="http://www.w3.org/2000/svg" width="500" height="500" viewBox="0 0 500 500" preserveAspectRatio="none" style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;">
<defs>
<style type="text/css"></style>
</defs>
<text x="0" y="25" style="font-weight:bold;font-size:25pt;font-family:Arial, Helvetica, Open Sans, sans-serif">500x500</text>
</svg>

@yield ('scripts')
<script>
$(function () {
  $('[data-toggle="popover"]').popover({html:true})
})
</script>

</body>
</html>