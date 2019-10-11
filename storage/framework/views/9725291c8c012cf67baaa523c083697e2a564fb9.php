  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ganz sicher? </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Du möchtest <strong>"<?php echo e($title); ?>"</strong>  löschen? Dann klicke unten auf Löschen, ansonsten kannst Du es auch einfach lassen. 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
         <?php switch($typeDelete):
            case ('block'): ?>
               <form method="POST" action="/lehrer/unterrichtseinheiten/aufgabe/löschen/<?php echo e($id); ?>">
                  <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
			         <button class=" form-control btn btn-warning" type="submit"> Aufgabe löschen</button>
		         </form>
            <?php break; ?>
         
            <?php case ('content'): ?>
               Second case...
            <?php break; ?>

            <?php case ('differentiation'): ?>
               Second case...
            <?php break; ?>

            <?php case ('portal'): ?>
               Second case...
            <?php break; ?>

            <?php case ('post'): ?>
               Second case...
            <?php break; ?>

            <?php case ('question'): ?>
               Second case...
            <?php break; ?>

            <?php case ('school'): ?>
               Second case...
            <?php break; ?>

            <?php case ('serie'): ?>
               Second case...
            <?php break; ?>

            <?php case ('subject'): ?>
               Second case...
            <?php break; ?>

            <?php case ('tool'): ?>
               Second case...
            <?php break; ?>

            <?php case ('topic'): ?>
               Second case...
            <?php break; ?>

            <?php case ('unit'): ?>
               <form method="POST" action="/lehrer/newUnitDelete/<?php echo e($id); ?>">
                  <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
			         <button class="form-control btn btn-info" type="submit"> Unterrichtseinheit löschen</button>
		         </form>
            <?php break; ?>

            <?php default: ?>
               Default case...
         <?php endswitch; ?>
        
      </div>
    </div>
  </div><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/components/deleteCheck.blade.php ENDPATH**/ ?>