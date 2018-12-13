<?php if($average_score == 0): ?>

<?php else: ?>
	<?php $rating = $average_score; ?>  
	<?php $__currentLoopData = range(1,5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<span class="fa-stack" style="width:1em">
			<i class="far fa-star fa-stack-1x"></i>
			<?php if($rating >0): ?>
				<?php if($rating >0.5): ?>
					<i class="fas fa-star fa-stack-1x"></i>
				<?php else: ?>
					<i class="fas fa-star-half fa-stack-1x"></i>
				<?php endif; ?>
			<?php endif; ?>
			<?php $rating--; ?>
		</span>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>