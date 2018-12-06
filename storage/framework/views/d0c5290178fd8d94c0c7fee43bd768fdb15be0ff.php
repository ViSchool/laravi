		
<?php $__env->startSection('page-header'); ?>

<div class="m-0 d-none d-sm-block">
	<div class="d-flex justify-content-between align-items-center" style="background-image:url(/images/banner_small.jpeg); height:180px;">
		<div class="d-flex flex-column" style="max-width: 600px;">
			<h3 class="text-brand-yellow p-5 mb-auto">Du willst digitaler unterrichten, hast aber keine Zeit oder Erfahrung?</h3>
			<a class="mt-auto m-5 btn btn-light text-brand-blue" href="#">Jetzt Lehrerzugang erstellen und sofort starten!</a>
		</div>
		<img class="img-fluid m-5" src="/images/vischool_ipad.png" style="height:60%; transform: rotate(15deg);";"></img>
	</div>
</div>

<?php echo $__env->make('teacher.teacher_components.loggedInTeacher', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('content'); ?>

<div class="container my-5">
	
	<h2 class="text-brand-red">Erweitere Deinen Unterricht mit digitalen Tools und Inhalten</h2>
	Wir unterstützen Dich beim Erstellen eigener Lerneinheiten. Unser Angebot ist kostenlos.
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout_teacher', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>