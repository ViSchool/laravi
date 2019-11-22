<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
<section id="page-header">
    <div class="container p-3">
    <h4>Aufgaben zur Lerneinheit "<?php echo e($unit->unit_title); ?>"</h4>
    </div>
</section> 
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



<div class="container mt-3">
    <h3>Bereits erstellte Aufgaben</h3>
    <p>Klicke auf die einzelnen Aufgaben, um sie zu ändern oder füge eine neue Aufgabe ein.</p>
</div>
<div class="container">
    <a class="btn btn-primary form-control" href="/lehrer/lerneinheiten/<?php echo e($unit->id); ?>/aufgabe">Eine neue Aufgabe einfügen</a>
</div>

<!--Anzeige der Inhalte-->


<div class="container mt-3 mb-5">
    <hr> 
    <h3>Diese Aufgaben gibt es bereits in der Lerneinheit:</h3>
    <div class="table-responsive">
        <table class="table table-striped table-sm my-5">
            <thead class="table-primary">
                <tr>
                    <th class="text-center" scope="col">Reihenfolge<br>ändern</th>
                    <th class="text-center" scope="col">Überschrift für die Aufgabe</th>
                    <th class="text-center" scope="col">Lernniveau</th>
                    <th class="text-center" scope="col">Zeit für die<br> Aufgabe</th>
                    <th class="text-center" scope="col">Löschen</th>
                </tr>
            </thead>
            <tbody>
                <?php
					$maxOrder = $unit->blocks->max('order');
					$minOrder = $unit->blocks->min('order');
				?>
				<?php $__currentLoopData = $unit->blocks->sortBy('order'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php 
                if (App\Block::where([
                    ['order', $block->order],
                    ['unit_id',$block->unit_id]
                    ])->count() > 1) {
                        $alternative = 1;
                    }
                else {$alternative = 0;}
                ?>
                <tr>
                    <td class="text-center">
						<?php if($block->order != $minOrder): ?>
						<form method="POST" action="<?php echo e(route('backend.blocks.update_orderup', $block->id)); ?>">
						<?php echo e(csrf_field()); ?> <?php echo e(method_field('PATCH')); ?> 
							<button class="btn btn-link" type="submit"><i class="fas fa-lg fa-chevron-up"></i></button>
						</form>
						<?php endif; ?>
						<?php if($block->order != $maxOrder): ?>
						<form method="POST" action="<?php echo e(route('backend.blocks.update_orderdown', $block->id)); ?>">
						<?php echo e(csrf_field()); ?> <?php echo e(method_field('PATCH')); ?> 
							<button class="btn btn-link" type="submit"><i class="fas fa-lg fa-chevron-down"></i></button>
						</form>
						<?php endif; ?>
					</td>
                    <td>
                        <?php if($alternative == 1): ?>
                            <i class="mr-3 fas fa-exchange-alt" style="color:orange;"></i>
					    <?php endif; ?>
                        <a href="/lehrer/lerneinheiten/aufgabe/bearbeiten/<?php echo e($block->id); ?>"><?php echo e($block->title); ?></a> 
                    </td>
                    <td class="text-center"><?php echo e($block->differentiation->differentiation_title); ?></td>	
                    <td class="text-center"><?php echo e($block->time); ?></td>
                <td class="text-center"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteModal_<?php echo e($block->id); ?>"><i class="far fa-trash-alt"></i></button></td>
                    
                </tr>
            <div class="modal fade" id="deleteModal_<?php echo e($block->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <?php echo $__env->make('components.deleteCheck',['typeDelete'=>'block','id'=>$block->id,'title'=>$block->title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>    
            </tbody>
        </table>
        
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>  

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/teacher/teacher_blocks.blade.php ENDPATH**/ ?>