<?php $__env->startSection('stylesheets'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>

<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
   <h1>FAQs erstellen </h1>
	<div class="container">	
	<form method="POST" action="/backend/faq/<?php echo e($faq->id); ?>" enctype="multipart/form-data">
			<?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
			<div class="form-group">
				<label for="faq_category">Kategorie:</label>
			<input class="form-control" type="text" list="categories" id="faq_category" name="faq_category" placeholder="Kategorie auswählen oder eine Neue eintragen" value="<?php echo e($faq->faq_category); ?>"/>
				<datalist id="categories">
					<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option><?php echo e($category); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</datalist>
				<?php if($errors->has('faq_category')): ?>
					<span class="help-block">
						<strong class="text-danger"><?php echo e($errors->first('faq_category')); ?></strong>
					</span>
				<?php endif; ?>
			</div>
			<div class="form-group">
				<label for="faq_question">Frage:</label>
			<input type="text" class="form-control" id="faq_question" name="faq_question" value="<?php echo e($faq->faq_question); ?>">
				<?php if($errors->has('faq_question')): ?>
					<span class="help-block">
						<strong class="text-danger"><?php echo e($errors->first('faq_question')); ?></strong>
					</span>
				<?php endif; ?>
			</div>
			<div class="form-group">
				<label for="faq_answer">Antwort:</label>
			<textarea class="form-control" id="faq_answer" name="faq_answer"><?php echo e($faq->faq_answer); ?></textarea>
				<?php if($errors->has('faq_answer')): ?>
					<span class="help-block">
						<strong class="text-danger"><?php echo e($errors->first('faq_answer')); ?></strong>
					</span>
				<?php endif; ?>
			</div>	
			<button type="submit" class=" form-control btn btn-primary">Frage speichern</button>		
		</form>
	</div>
</main>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/show_faq.blade.php ENDPATH**/ ?>