<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>

<section class="jumbotron p-2 mb-5">	
	<div class="container-fluid" style="background-image:url(/images/banner_small.jpeg);">
			<div class="row ml-5">
				<div class="col-8">
					<h1 class="mt-3 text-info">ViSchool für Lehrer</h1>
					<h3 class="lead text-white">Du willst digitaler unterrichten, hast aber keine Zeit oder Erfahrung? Starte mit fertigen Lerneinheiten oder lass Dich von uns <a href="#coaching">kostenlos</a> zu Deinen eigenen Unterrichtsideen beraten.</h3>
					<p class="text-center">
						<a href="/lehrer/register_soon" class="btn btn-primary my-2">Als Lehrer bei ViSchool anmelden</a>
					</p>
					</div>
					
					<div class="col d-flex justify-content-end">
					<div class="d-none d-sm-block">	
						<img class="img-fluid mt-5" src="/images/vischool_ipad.png" style="max-height:120px; transform: rotate(15deg);"></img>
					</div>
					</div>
			</div>
			
    </div>
  </section>
<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('content'); ?>
<?php if(session('message')): ?>
<div class="alert alert-success" role="alert">
  <?php echo e(session('message')); ?>

</div>
<?php endif; ?>


<div class="container my-5">
	<h2 class="text-brand-blue">Nutze fertige Lerneinheiten zu vielen Themen</h2>
	<p>Nutze die Lerneinheiten, die von Lehrern bereits im Unterricht eingesetzt und erprobt wurden. Sie sind kostenlos und können sofort auch ohne Anmeldung eingesetzt werden. Willst Du die Einheiten nach Deinen Vorstellungen anpassen, musst Du Dir <a href="#">hier</a> einen ViSchool-Lehrerzugang erstellen. </p>
	

<div class="d-flex justify-content-center my-5">
<div class="carousel slide" data-ride="carousel">
	<div class="carousel-inner" >
		
		<div class="carousel-item active bg-white" style="height:100%">
			<div class="card-deck">
				<?php $__currentLoopData = $unitsSet01; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="card" style="max-width: 300px;">
						<div class="card-header m-0 p-0" style="height:150px; overflow:hidden">
							<?php if(isset($unit->unit_img)): ?>
								<img class="card-img-top align-middle" style="width:100%;height:100%;object-fit:cover;" src="/images/units/<?php echo e($unit->unit_img); ?>" alt="Lerneinheiten01">	
							<?php endif; ?> 
							<?php if(empty($unit->unit_img)): ?>
								<img class="card-img-top" src="/images/banner.jpg" alt="Unit" style="height:100%">
							<?php endif; ?>
						</div>
						<div class="d-none d-sm-block">
							<div class="card-body">
								<a href="/lerneinheit/<?php echo e($unit->id); ?>"><?php echo e($unit->unit_title); ?></a>
							</div>
						</div>
						<div class="d-block d-sm-none">
							<div class="card-body text-muted">
								<a href="/lerneinheit/<?php echo e($unit->id); ?>"><?php echo e($unit->unit_title); ?></a>
							</div>
						</div>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
		

		<?php if(count($unitsSet02)!= 0): ?>
		
		<div class="carousel-item bg-white" style="height:100%">
			<div class="card-deck">
				<?php $__currentLoopData = $unitsSet02; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="card" style="max-width: 300px;">
						<div class="card-header m-0 p-0" style="height:150px; overflow:hidden">
							<?php if(isset($unit->unit_img)): ?>
								<img class="card-img-top align-middle" style="width:100%;height:100%;object-fit:cover;" src="/images/units/<?php echo e($unit->unit_img); ?>" alt="Lerneinheiten01">	
							<?php endif; ?> 
							<?php if(empty($unit->unit_img)): ?>
								<img class="card-img-top" src="/images/banner.jpg" alt="Unit" style="height:100%">
							<?php endif; ?>
						</div>
						<div class="d-none d-sm-block">
							<div class="card-body">
								<a href="/lerneinheit/<?php echo e($unit->id); ?>"><?php echo e($unit->unit_title); ?></a>
							</div>
						</div>
						<div class="d-block d-sm-none">
							<div class="card-body text-muted">
								<a href="/lerneinheit/<?php echo e($unit->id); ?>"><?php echo e($unit->unit_title); ?></a>
							</div>
						</div>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
		
		<?php endif; ?>

		<?php if(count($unitsSet03)!= 0): ?>
		
		<div class="carousel-item bg-white" style="height:100%">
			<div class="card-deck">
				<?php $__currentLoopData = $unitsSet03; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="card" style="max-width: 300px;">
						<div class="card-header m-0 p-0" style="height:150px; overflow:hidden">
							<?php if(isset($unit->unit_img)): ?>
								<img class="card-img-top align-middle" style="width:100%;height:100%;object-fit:cover;" src="/images/units/<?php echo e($unit->unit_img); ?>" alt="Lerneinheiten01">	
							<?php endif; ?> 
							<?php if(empty($unit->unit_img)): ?>
								<img class="card-img-top" src="/images/banner.jpg" alt="Unit" style="height:100%">
							<?php endif; ?>
						</div>
						<div class="d-none d-sm-block">
							<div class="card-body">
								<a href="/lerneinheit/<?php echo e($unit->id); ?>"><?php echo e($unit->unit_title); ?></a>
							</div>
						</div>
						<div class="d-block d-sm-none">
							<div class="card-body text-muted">
								<a href="/lerneinheit/<?php echo e($unit->id); ?>"><?php echo e($unit->unit_title); ?></a>
							</div>
						</div>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</div>
		</div>
		
		<?php endif; ?>

	</div>
</div>
</div>


	<div class="d-flex justify-content-center mb-3">
	<a href="/lehrer/units">Zu den fertigen Lerneinheiten für alle Fächern</a>
	</div>
	<hr></hr>

	<h2 class="text-brand-red">Erweitere Deinen Unterricht mit digitalen Tools und Inhalten</h2>
	<img class="img-fluid mb-3" src="/images/unit_example.jpeg"></img>
	<p>Du kannst selbst Lerneinheiten auf Basis aller bei uns hinterlegten Inhalte erstellen. Alles digital? Nein, unsere Lerneinheiten können sowohl ganz klassische Unterrichtselemente enthalten, als auch digitale, wie Videos, Quizzes und Onlineaufgaben. Fehlt Dir ein Inhalt, dann kannst Du ihn selbst hinzufügen. Melde Dich an, um diese Funktionen zu nutzen.</p>
	
	
	
	<hr></hr>
	<h2 class="text-brand-blue">Coaching für Lehrer und Schulen</h2>
	<div id="coaching" class="card-deck">
		<div class="card">
			<a href="/lehrer/coaching"><img class="card-img-top" src="/images/schueler_laptop.jpg" alt="Card image cap"></a>
			<div class="card-body">
				<h4 class="card-title text-brand-red">Für Lehrer</h4>
				<p class="card-text">Du fühlst Dich noch nicht sicher genug, selbst komplette Lerneinheiten zu erstellen? Kein Problem, wir coachen Dich. <a href="/lehrer/coaching">Hier</a> findest Du weitere Informationen.</p>
			</div>
		</div>
		<div class="card">
			<a href="/lehrer/schulcoaching"><img class="card-img-top" src="/images/schulflur.jpg" alt="Card image cap"></a>
			<div class="card-body">
				<h4 class="card-title text-brand-red">Für Schulen</h4>
      			<p class="card-text">Ihr wollt Eure Schule komplett fit machen für digitalen Unterricht? Wir gestalten mit Euch einen zum Beispiel einen Pädagogischen Ganztag zum Thema Digitalisierung. Mehr Infos dazu findet Ihr <a href="/lehrer/schulcoaching">hier</a>.</p>
			</div>
		</div>
	</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/teacher/teacher_welcome.blade.php ENDPATH**/ ?>