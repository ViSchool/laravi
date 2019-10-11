  <!-- Body  -->

    
<!-- Hauptteil der Seite -->
<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.hero', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      <!-- Subjects   
     ================================================== -->
<?php echo $__env->make('layouts.subjects', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      <!-- About ViSchool   
     ================================================== -->
<?php echo $__env->make('layouts.about', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      <!-- Team   
     ================================================== -->
<?php echo $__env->make('layouts.team', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

      <!-- Blog   
     ================================================== -->
<?php echo $__env->make('layouts.blog', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/vischool.blade.php ENDPATH**/ ?>