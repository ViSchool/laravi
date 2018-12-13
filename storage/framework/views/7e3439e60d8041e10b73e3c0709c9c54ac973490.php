<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>

<div class="m-0 d-none d-sm-block">
	<div class="d-flex justify-content-between align-items-center" style="background-image:url(/images/banner_small.jpeg); height:180px;">
		<div class="d-flex flex-column" style="max-width: 600px;">
			<h3 class="text-brand-yellow p-5 mb-auto">Du willst digitaler unterrichten, hast aber keine Zeit oder Erfahrung?</h3>
			<button type="button" class="mt-auto m-5 btn btn-primary text-white" data-toggle="modal" data-target="#actionModal">Jetzt Unterstützung für digitalen Unterricht nachfragen!</button>
		</div>
		<img class="img-fluid m-5" src="/images/vischool_ipad.png" style="height:60%; transform: rotate(15deg);";"></img>
	</div>
</div>

<!-- Modal für Call to Action -->
<div class="modal" id="actionModal" tabindex="-1" role="dialog" aria-labelledby="actionModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="actionModalLabel">Wie können wir Dich unterstützen?</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/lehrer/anfrage" method="POST">
		<?php echo e(csrf_field()); ?>

          <div class="form-group">
            <label for="lehrerName" class="col-form-label">Dein Name:</label>
            <input type="text" class="form-control" id="lehrerName" name="lehrername">
          </div>
          <div class="form-group">
            <label for="fach" class="col-form-label">Dein Fach:</label>
            <input type="text" class="form-control" id="subject" name="fach">
          </div>
          	<div class="form-group">
            <label for="thema" class="col-form-label">Dein Unterrichtsthema:</label>
            <input type="text" class="form-control" id="thema" name="thema">
          </div>
          	<div class="form-group">
            <label for="email" class="col-form-label">Emailadresse unter der wir Dich erreichen:</label>
            <input type="email" class="form-control" id="email" name="email">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn-sm btn-secondary" data-dismiss="modal">Abbrechen</button>
        <button type="submit" class="btn-sm btn-primary">Anfrage senden</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php echo $__env->make('teacher.teacher_components.loggedInTeacher', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('content'); ?>
<?php if(session('message')): ?>
<div class="alert alert-success" role="alert">
  <?php echo e(session('message')); ?>

</div>
<?php endif; ?>

<div class="container my-5">
	<h2 class="text-brand-blue">Nutze fertige Unterrichtseinheiten zu vielen Themen</h2>
	<p>Nutze die Unterrichtseinheiten, die von Lehrern bereits im Unterricht eingesetzt und erprobt wurden. Sie sind kostenlos und können sofort auch ohne Anmeldung eingesetzt werden. Willst Du die Einheiten nach Deinen Vorstellungen anpassen, musst Du Dir <a href="#">hier</a> einen ViSchool-Lehrerzugang erstellen. </p>
	
<div class="carousel slide mt-5" data-ride="carousel">
   <div class="carousel-inner">
       <div class="carousel-item active bg-white">
           <div class="row">
							<?php $__currentLoopData = $unitsSet01; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="col">
									<div class="card text-center">
										<?php if(isset($unit->unit_img)): ?>
											<img class="card-img-top" src="/images/units/<?php echo e($unit->unit_img); ?>" alt="Lerneinheiten01">	
										<?php endif; ?> 
										<?php if(empty($unit->unit_img)): ?>
											<img class="card-img-top" src="/images/banner_small.jpeg" alt="Unit" >
										<?php endif; ?>
											<div class="card-body m-0">
												<a href="/lerneinheit/<?php echo e($unit->id); ?>"><?php echo e($unit->unit_title); ?></a>
											</div>
									</div>
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           </div>
			 </div>
			 <div class="carousel-item bg-white">	 
					 <div class="row">
               <?php $__currentLoopData = $unitsSet02; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="col-3">
									<div class="card text-center m-0 p-0">
										<?php if(isset($unit->unit_img)): ?>
											<img class="card-img-top" src="/images/units/<?php echo e($unit->unit_img); ?>" alt="Lerneinheiten01">	
										<?php endif; ?> 
										<?php if(empty($unit->unit_img)): ?>
											<img class="card-img-top" src="/images/topic_back.jpeg" alt="Unit" >
										<?php endif; ?>
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
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           </div>
			 </div>
			 <div class="carousel-item bg-white">	 
					 <div class="row">
						<?php if($unitsSet03 == null): ?>
								ist  leer
						<?php endif; ?>
						<?php $__currentLoopData = $unitsSet03; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<div class="col">
									<div class="card p-2 text-center">
										<?php if(isset($unit->unit_img)): ?>
											<img class="card-img-top" src="/images/units/<?php echo e($unit->unit_img); ?>" alt="Lerneinheiten01">	
										<?php endif; ?> 
										<?php if(empty($unit->unit_img)): ?>
											<img class="card-img-top" src="/images/banner_small.jpeg" alt="Unit" >
										<?php endif; ?>
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
								</div>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
           </div>
       </div>
   </div>
</div>


	<div class="d-flex justify-content-center my-3">
	<a href="/lehrer/units">Zu den fertigen Unterrichtseinheiten für alle Fächern</a>
	</div>
	<hr></hr>

	<h2 class="text-brand-red">Erweitere Deinen Unterricht mit digitalen Tools und Inhalten</h2>
	<img class="img-fluid mb-3" src="/images/unit_example.jpeg"></img>
	<p>Du kannst selbst Unterrichtseinheiten auf Basis aller bei uns hinterlegten Inhalte erstellen. Alles digital? Nein, unsere Unterrichtseinheiten können sowohl ganz klassische Unterrichtselemente enthalten, als auch digitale, wie Videos, Quizzes und Onlineaufgaben. Fehlt Dir ein Inhalt, dann kannst Du ihn selbst hinzufügen. Melde Dich an, um diese Funktionen zu nutzen.</p>
	
	<hr></hr>
	<h2 class="text-brand-blue">Lerne Tools kennen</h2>
	<p>Es gibt zahlreiche kostenlos nutzbare Tools, die Du für Deinen Unterricht nutzen kannst. Wie Du sie anwendest, erklären wir Dir hier. </p>
		<hr></hr>
	<h2 class="text-brand-red">Unser Bewertungssystem</h2>
	<div class="row">
		<div class="col">
		<img class="img-fluid" src="/images/logo_aha.jpg"></img>
		</div>
		<div class="col">
		<img class="img-fluid" src="/images/logo_cool.jpg"></img>
		</div>
		<div class="col">
		<img class="img-fluid" src="/images/logo_wirkt.jpg"></img>
		</div>
	</div>
	
	<hr></hr>
	<h2 class="text-brand-blue">Coaching für Lehrer und Schulen</h2>
	<div class="card-deck">
		<div class="card">
			<a href="/lehrer/coaching"><img class="card-img-top" src="/images/schueler_laptop.jpg" alt="Card image cap"></a>
			<div class="card-body">
				<h4 class="card-title text-brand-red">Für Lehrer</h4>
				<p class="card-text">Du fühlst Dich noch nicht sicher genug, selbst komplette Unterrichtseinheiten zu erstellen? Kein Problem, wir coachen Dich. <a href="/lehrer/coaching">Hier</a> findest Du weitere Informationen.</p>
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
<?php echo $__env->make('layout_teacher', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>