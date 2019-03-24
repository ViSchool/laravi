<?php if($average_score == 0): ?>

<?php else: ?>
	<?php $rating = $average_score; ?>  
	<?php $__currentLoopData = range(1,5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php if($rating >0): ?>
			<?php if($rating >0.5): ?>
				<i class="fas fa-star"></i>
			<?php else: ?>
				<i class="fas fa-star-half-alt"></i>
			<?php endif; ?>
		<?php else: ?>
			<i class="far fa-star"></i>
		<?php endif; ?>
			<?php $rating--; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>