<div class="bg-white container my-5" id="featured">
   <h3 class="text-center text-uppercase">Nutze fertige Unterrichtseinheiten und passe sie an:</h3>  
   <div class="card-deck justify-content-center">
      <?php $__currentLoopData = $featuredElements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $featuredElement): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
         <?php
            if (isset ($featuredElement->serie_id)) {
               $serie = App\Serie::find($featuredElement->serie_id);
               $subject = $serie->units->first()->subject;
            } else {
               $unit = App\Unit::find($featuredElement->unit_id);
               $subject = $unit->subject;
            }
              $color = rand(1,3);  
         ?>

         <?php if(isset($serie)): ?>
         <div class="d-flex justify-content-center mb-3" id="featuredSerie">
         <a href="/lerneinheiten/serie/<?php echo e($serie->id); ?>">
            <div class="card m-2 h-100" style="width: 13rem;">
               <div class="card-header m-0 p-0 bg-white border-0">
                  <img class="card-img-top pb-5" src="/images/topic_back.jpeg" alt="">
                  <div class="fa-2x text-center card-img-overlay">
                     <span class="fa-stack m-2" style="position:relative; top:9rem;">
                        <i class="fas fa-circle fa-stack-2x" style="color:#03c4eb;"></i>
                        <i class="fa <?php echo e($subject->subject_icon); ?> fa-stack-1x fa-inverse"></i>
                     </span>
                  </div>
                  <div class="card-img-overlay text-center">
                     <small class="text-white"><?php echo e($subject->subject_title); ?>:</small>
                  <h3  
                     <?php switch($color):
                        case (1): ?>
                           class="text-uppercase text-center text-wrap card-title mt-3 text-brand-yellow"
                        <?php break; ?>
                        <?php case (2): ?>
                           class="text-uppercase text-center text-wrap card-title mt-3 text-brand-blue"
                        <?php break; ?>
                        <?php case (3): ?>
                           class="text-uppercase text-center text-wrap card-title mt-3 text-brand-red"
                        <?php break; ?>
                     <?php endswitch; ?>">
                     <?php echo e($serie->serie_title); ?>

                  </h3>
                  </div>
                  <div class="card-body">
                     <small class="text-center mb-auto"><?php echo e($serie->serie_description); ?></small>
                  </div>  
               </div>
            </div>
         </a>
         </div>
         <?php
          $serie = Null;   
         ?>
         <?php endif; ?>

         <?php if(isset($unit)): ?>
            <div class="d-flex justify-content-center mb-3" id="featuredUnit">
            <a href="/lerneinheit/<?php echo e($unit->id); ?>">
               <div class="card m-2 h-100" style="width: 13rem;">
                  <div class="card-header m-0 p-0 bg-white border-0">
                     <img class="card-img-top pb-5" src="/images/topic_back.jpeg" alt="">
                     <div class="fa-2x text-center card-img-overlay">
                        <span class="fa-stack m-2" style="position:relative; top:9rem;">
                           <i class="fas fa-circle fa-stack-2x" style="color:#03c4eb;"></i>
                           <i class="fa <?php echo e($subject->subject_icon); ?> fa-stack-1x fa-inverse"></i>
                        </span>
                     </div>
                     <div class="card-img-overlay text-center">
                        <small class="text-white"><?php echo e($subject->subject_title); ?>:</small>
                     <h3  
                        <?php switch($color):
                           case (1): ?>
                              class="text-uppercase text-center text-wrap card-title mt-3 text-brand-yellow"
                           <?php break; ?>
                           <?php case (2): ?>
                              class="text-uppercase text-center text-wrap card-title mt-3 text-brand-blue"
                           <?php break; ?>
                           <?php case (3): ?>
                              class="text-uppercase text-center text-wrap card-title mt-3 text-brand-red"
                           <?php break; ?>
                        <?php endswitch; ?>">
                        <?php echo e($unit->unit_title); ?>

                     </h3>
                     </div>
                     <div class="card-body">
                        <small class="text-center mb-auto"><?php echo e($unit->unit_description); ?></small>
                     </div>  
                  </div>
               </div>
            </a>
            </div>
         <?php
          $unit = Null;   
         ?>
         <?php endif; ?>
         
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   </div>
   </div>
</div>


<?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/layouts/featured.blade.php ENDPATH**/ ?>