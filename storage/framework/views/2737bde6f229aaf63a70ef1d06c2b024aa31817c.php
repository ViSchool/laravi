  <!-- Body  -->

    
<!-- Hauptteil der Seite -->
<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.hero', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      <!-- Subjects   
     ================================================== -->
<?php echo $__env->make('layouts.subjects', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      <!-- About ViSchool   
     ================================================== -->
<?php echo $__env->make('layouts.about', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      <!-- Team   
     ================================================== -->
<?php echo $__env->make('layouts.team', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      <!-- Blog   
     ================================================== -->
<?php echo $__env->make('layouts.blog', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>