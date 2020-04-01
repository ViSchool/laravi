  <!-- Body  -->

<?php $__env->startSection('stylesheets'); ?>
	<link href="/css/rotating-card.css" rel="stylesheet" />
<?php $__env->stopSection(); ?>
    
<!-- Hauptteil der Seite -->
<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.hero', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(count($featuredElements) == 3): ?>;
    <?php echo $__env->make('layouts.featured', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<?php endif; ?>
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

<?php $__env->startSection('scripts'); ?>

<script>$(function () {
  $('[data-toggle="tooltip"]').tooltip({
  	trigger: 'hover focus'
  })
});
</script>

<script type="text/javascript">
    $().ready(function(){
        $('[rel="tooltip"]').tooltip();

        $('a.scroll-down').click(function(e){
            e.preventDefault();
            scroll_target = $(this).data('href');
             $('html, body').animate({
                 scrollTop: $(scroll_target).offset().top - 60
             }, 1000);
        });

    });

    function rotateCard(btn){
        var $card = $(btn).closest('.card-container-flip');
        console.log($card);
        if($card.hasClass('hover')){
            $card.removeClass('hover');
        } else {
            $card.addClass('hover');
        }
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/vischool.blade.php ENDPATH**/ ?>