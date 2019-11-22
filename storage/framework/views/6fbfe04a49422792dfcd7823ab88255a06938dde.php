  <!doctype html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="ViSchool, digitale Bildung, lernen, zeitgemäße Bildung, digitaler Unterricht, Lerneinheiten, Mathe, Physik, Englisch, Deutsch">
    <meta name="author" content="Katharina Schedel | ViSchool">
    <link rel="icon" href="../../../../favicon.ico">

    <title>ViSchool</title>

    <!-- Bootstrap core CSS -->
    
    
    

    <!-- Custom styles for this template -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/offcanvas.css" rel="stylesheet">
    
<?php echo $__env->yieldContent('stylesheets'); ?>

</head>
  
  <!-- Body  -->
<body>
	<header> 
<?php echo $__env->make('layouts.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  </header> 
    
<!-- Hauptteil der Seite -->
<div id="page">

<?php echo $__env->yieldContent('page-header'); ?>

<main role="main">

<?php echo $__env->yieldContent('content'); ?>
	
</main>
</div>

      <!-- FOOTER -->
<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>

<script src="/js/app.js"></script>
<script src="/js/offcanvas.js"></script>


<?php echo $__env->yieldContent('scripts'); ?>
<script>
$(function () {
  $('[data-toggle="popover"]').popover({html:true})
})
</script>
</body>
</html><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/layout.blade.php ENDPATH**/ ?>