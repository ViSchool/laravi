<?php if(count($errors)): ?>
		<div class="form-group">
			<div class="alert alert-warning">
				<ul>
					<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<li><?php echo e($error); ?></li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			</div>
		</div>
	<?php endif; ?>
	<?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/layouts/errors.blade.php ENDPATH**/ ?>