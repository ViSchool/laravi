<?php $__env->startComponent('mail::message'); ?>

<h1>Hallo Ihr Beiden,  </h1>

ich bin's Eure ViSchool-App! Ihr habt eine neue Anfrage, also los, kümmert Euch drum! 

<?php $__env->startComponent('mail::panel'); ?>
von:     <?php echo e($inquiry->lehrername); ?> <br>
Fach:    <?php echo e($inquiry->fach); ?> <br>
Thema:   <?php echo e($inquiry->thema); ?> <br>
Email:   <?php echo e($inquiry->email); ?> <br>
Telefon: <?php echo e($inquiry->phone); ?> <br>

Das ist die Nachricht: <br>
<?php echo $__env->renderComponent(); ?>

    
<?php $__env->startComponent('mail::panel'); ?>
   <?php echo e($inquiry->message); ?>

<?php echo $__env->renderComponent(); ?>






Du kannst direkt antworten: 

<?php $__env->startComponent('mail::button', ['url' => $url, 'color' => 'success']); ?>
Jetzt antworten
<?php echo $__env->renderComponent(); ?>



Yippieh!,<br>
Deine ViSchool-App

<?php echo $__env->renderComponent(); ?>
<?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/emails/send-inquiry.blade.php ENDPATH**/ ?>