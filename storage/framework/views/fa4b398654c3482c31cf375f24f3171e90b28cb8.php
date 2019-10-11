<?php $__env->startComponent('mail::message'); ?>

<h1>Willkommen bei ViSchool</h1>

Mit Deiner Emailadresse wurde ein neuer Lehrer-Zugang bei vischool.de angemeldet. 
Bitte bestätige Deine Emailadresse, indem Du auf den Button drückst. 

<?php $__env->startComponent('mail::button', ['url' => $url, 'color' => 'primary']); ?>
Email bestätigen
<?php echo $__env->renderComponent(); ?>

Vielen Dank,<br>
Dein ViSchool-Team

<small>
<?php echo app('translator')->get(
    "Sollte der Button nicht funktionieren, kannst Du auch den folgenden Link \n".
    'in Deinen Browser kopieren: [:actionURL](:actionURL)',
    [
        'actionText' => 'Email bestätigen',
        'actionURL' => $url,
    ]
); ?>
</small>

<?php echo $__env->renderComponent(); ?>
<?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/emails/verify-email.blade.php ENDPATH**/ ?>