		
<?php $__env->startSection('page-header'); ?>

<div class="m-0 d-none d-sm-block">
	<div class="d-flex justify-content-between align-items-center" style="background-image:url(/images/banner_small.jpeg); height:180px;">
		<div class="d-flex flex-column" style="max-width: 600px;">
			<h3 class="text-brand-yellow p-5 mb-auto">Du willst digitaler unterrichten, hast aber keine Zeit oder Erfahrung?</h3>
			<a class="mt-auto m-5 btn btn-light text-brand-blue" href="/register">Jetzt Lehrerzugang erstellen und sofort starten!</a>
		</div>
		<img class="img-fluid m-5" src="/images/vischool_ipad.png" style="height:60%; transform: rotate(15deg);";"></img>
	</div>
</div>



<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('content'); ?>

<div class="container my-5">
	
	<h2 class="text-brand-red">Erweitere Deinen Unterricht mit digitalen Tools und Inhalten</h2>
	Wir unterstützen Dich beim Erstellen eigener Lerneinheiten. Unser Angebot ist in zwei verschiedenen Varianten verfügbar:
</div>

<div class="container">
  	<div class="card-deck mb-3">
    	<div class="card mb-4 shadow-sm">
      	<div class="card-header text-center">
        		<h4 class="my-0 font-weight-normal">Kostenlos</h4>
      	</div>
      	<div class="card-body">
        		<h1 class="card-title pricing-card-title text-center">€ 0 <small class="text-muted">/ Monat</small></h1>
				<ul class="list-group list-unstyled list-group-flush">
					<li class="list-group-item border-0">Unbegrenzte kostenlose öffentliche Lerneinheiten</li>
					<li class="list-group-item border-0">5 private Lerneinheiten</li>
					<li class="list-group-item border-0">Kostenloser technischer Support innerhalb von 7 Tagen für 1 Jahr</li>
				</ul>
			</div>
			<div class="card-footer bg-white border-0 d-flex justify-content-center">
        		<a href="/register" class="btn btn-primary w-100">Jetzt kostenlos registrieren</a>
      	</div>
    	</div>
    	<div class="card mb-4 shadow-sm">
      	<div class="card-header text-center">
        		<h4 class="my-0 font-weight-normal">Günstiger Einstieg</h4>
      	</div>
      	<div class="card-body">
        		<h1 class="card-title pricing-card-title text-center">€ 12 <small class="text-muted">/ Jahr</small></h1>
				<ul class="list-group list-unstyled list-group-flush">
					<li class="list-group-item border-0">Unbegrenzte kostenlose öffentliche Lerneinheiten</li>
					<li class="list-group-item border-0">30 private Lerneinheiten</li>
					<li class="list-group-item border-0">Kostenloser technischer Support innerhalb von 3 Tagen für 1 Jahr</li>
					<li class="list-group-item border-0">Kostenloser inhaltlicher Support bei der Erstellung von Lerneinheiten (bis 10 Lerneinheiten/Jahr)</li>
				</ul>
			</div>
			<div class="card-footer bg-white border-0 d-flex justify-content-center">
        		<a href="/register" class="btn btn-primary w-100">6 Monate kostenlos testen</a>
      	</div>      	
    	</div>
	</div>
</div>	

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/teacher/teacher_coaching.blade.php ENDPATH**/ ?>