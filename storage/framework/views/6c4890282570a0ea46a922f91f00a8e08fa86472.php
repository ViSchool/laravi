<?php $__env->startSection('page-header'); ?>
<section id="page-header">
    <div class="container p-3">
    <h4>Frequently Asked Questions </h4>
    </div>
</section> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section id="vischool_faq">    
    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-4">
                <div class="list-group" id="list-tab" role="tablist">
                    <a class="list-group-item list-group-item-action active" id="list-<?php echo e($minFirstCategory); ?>-list" data-toggle="list" href="#list-<?php echo e($minFirstCategory); ?>" role="tab" aria-controls="<?php echo e($minFirstCategory); ?>"><small><?php echo e($firstCategory); ?></small></a>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $minCategory = trim(preg_replace('/\s+/','', $category));
                    ?>
                        <a class="list-group-item list-group-item-action" id="list-<?php echo e($minCategory); ?>-list" data-toggle="list" href="#list-<?php echo e($minCategory); ?>" role="tab" aria-controls="<?php echo e($minCategory); ?>"><small><?php echo e($category); ?></small></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                </div>
            </div>
            <div class="col-8">
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="list-<?php echo e($firstCategory); ?>" role="tabpanel" aria-labelledby="list-<?php echo e($firstCategory); ?>-list">  
                        
                        <div class="accordion" id="accordionFirstCategory">
                            <?php $__currentLoopData = $faqs->where('faq_category',$firstCategory); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card border border-light">
                                    <div class="card-header bg-white" id="question_<?php echo e($faq->id); ?>">
                                        <h2 class="mb-0">
                                            <button class="btn text-left" type="button" data-toggle="collapse" data-target="#collapse_<?php echo e($faq->id); ?>" aria-expanded="true" aria-controls="collapse_<?php echo e($faq->id); ?>">
                                                <?php echo e($faq->faq_question); ?>

                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapse_<?php echo e($faq->id); ?>" class="collapse" aria-labelledby="question_<?php echo e($faq->id); ?>" data-parent="#accordionFirstCategory">
                                        <div class="card-body">
                                            <?php echo e($faq->faq_answer); ?>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $minCategory = trim(preg_replace('/\s+/', '', $category));
                        ?>
                        <div class="tab-pane fade" id="list-<?php echo e($minCategory); ?>" role="tabpanel" aria-labelledby="list-<?php echo e($minCategory); ?>-list">
                            
                            <div class="accordion" id="accordion_<?php echo e($minCategory); ?>">
                                <?php $__currentLoopData = $faqs->where('faq_category',$category); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card border border-light">
                                        <div class="card-header bg-white" id="question_<?php echo e($faq->id); ?>">
                                            <h2 class="mb-0">
                                                <button class="btn text-left" type="button" data-toggle="collapse" data-target="#collapse_<?php echo e($faq->id); ?>" aria-expanded="true" aria-controls="collapse_<?php echo e($faq->id); ?>">
                                                    <?php echo e($faq->faq_question); ?>

                                                </button>
                                            </h2>
                                        </div>
                                        <div id="collapse_<?php echo e($faq->id); ?>" class="collapse" aria-labelledby="question_<?php echo e($faq->id); ?>" data-parent="#accordion_<?php echo e($minCategory); ?>">
                                            <div class="card-body">
                                                <?php echo e($faq->faq_answer); ?>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>  
    </div>
    <div class="container">
        <p>Nicht gefunden was Du suchst? Schreibe uns <a href="/support">hier eine Nachricht</a>  und wir melden uns bei Dir!</p>
    </div> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/frontend/support/faq.blade.php ENDPATH**/ ?>