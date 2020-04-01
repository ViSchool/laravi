<?php $__env->startSection('main'); ?>
   <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
      <h3>Features für die Startseite</h3>
		<?php
		 $countFeatured = App\Featured::all()->count();	 
		?>
		<div class="container my-3">
			<?php if($countFeatured < 3): ?>
				<div class="alert alert-info" role="alert">
  					Features werden derzeit nicht angezeigt. Alle drei Features müssen festgelegt sein, damit sie angezeigt werden.
				</div>
			<?php else: ?>
				<div class="d-flex form-group">
					<form action="/backend/featured_off" method="post">
						<?php echo csrf_field(); ?>
						<input type="hidden" name="feature_switch">
						<button class="btn btn-warning" type="submit">Features nicht mehr anzeigen.</button>
					</form>
				</div>
			<?php endif; ?>
			
			
			
			<form method="POST" action="/backend/featured" enctype="multipart/form-data">
			<?php echo csrf_field(); ?>
			<div class="card-deck">
				<?php if(isset($feature_01)): ?>
					<?php
					if ($feature_01->serie_id > 0) {
						$feature1 = $feature_01->serie;
						$title1=$feature1->serie_title;
						$type1="Serie";
					}	 else {
						$feature1 = $feature_01->unit;
						$title1=$feature1->unit_title;
						$type1="Lerneinheit";
					}
					?>	
				<?php endif; ?>
					<div class="card mb-3" style="min-width: 15rem;">
						<div class="card-header bg-info">
							<h5 class="card-title text-white">Feature 1</h5>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="feature1">Hier das Feature 1 auswählen</label>
								<select class="custom-select" name="feature1" id="feature1">
									<?php if(isset($feature1->serie_title)): ?>
										<option value="serie|<?php echo e($feature1->id); ?>"><?php echo e($title1); ?> (<?php echo e($type1); ?>)</option>	 
									<?php elseif(isset($feature1->unit_title)): ?>
										<option value="unit|<?php echo e($feature1->id); ?>"><?php echo e($title1); ?> (<?php echo e($type1); ?>)</option>
									<?php else: ?>	 
										<option value="">Bitte auswählen</option> 
									<?php endif; ?>
									<optgroup label="Serien">
										<?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="serie|<?php echo e($serie->id); ?>"><?php echo e($serie->serie_title); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</optgroup>
									<optgroup label="Lerneinheiten">
										<?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="snit|<?php echo e($unit->id); ?>"><?php echo e($unit->unit_title); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</optgroup>
								</select>
								<?php if($errors->has('feature1')): ?>
									<span class="help-block">
										<strong><?php echo e($errors->first('feature1')); ?></strong>
									</span>
								<?php endif; ?>
							</div>
						</div>
					</div> 
				
				<?php if(isset($feature_02)): ?>
					<?php
					if ($feature_02->serie_id !== NULL) {
						$feature2 = $feature_02->serie;
						$title2=$feature2->serie_title;
						$type2="Serie";
					}	 else {
						$feature2 = $feature_02->unit;
						$title2=$feature2->unit_title;
						$type2="Lerneinheit";
					}
					?>
					<?php endif; ?>	
					<div class="card mb-3" style="min-width: 15rem;">
						<div class="card-header bg-info">
							<h5 class="card-title text-white">Feature 2</h5>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="feature2">Hier das Feature 2 auswählen</label>
								<select class="custom-select" name="feature2" id="feature2">
									<?php if(isset($feature2->serie_title)): ?>
										<option value="serie|<?php echo e($feature2->id); ?>"><?php echo e($title2); ?> (<?php echo e($type2); ?>)</option>	 
									<?php elseif(isset($feature2->unit_title)): ?>
										<option value="unit|<?php echo e($feature2->id); ?>"><?php echo e($title2); ?> (<?php echo e($type2); ?>)</option>
									<?php else: ?>	 
										<option value="">Bitte auswählen</option> 
									<?php endif; ?>
									<optgroup label="Serien">
										<?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="serie|<?php echo e($serie->id); ?>"><?php echo e($serie->serie_title); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</optgroup>
									<optgroup label="Lerneinheiten">
										<?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="snit|<?php echo e($unit->id); ?>"><?php echo e($unit->unit_title); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</optgroup>
								</select>
								<?php if($errors->has('feature2')): ?>
									<span class="help-block">
										<strong><?php echo e($errors->first('feature2')); ?></strong>
									</span>
								<?php endif; ?>
							</div>
						</div>
					</div> 
				
				<?php if(isset($feature_03)): ?>
					<?php
					if ($feature_03->serie_id > 0) {
						$feature3 = $feature_03->serie;
						$title3=$feature3->serie_title;
						$type3="Serie";
					}	 else {
						$feature3 = $feature_03->unit;
						$title3=$feature3->unit_title;
						$type3="Lerneinheit";
					}
					?>
					<?php endif; ?>	
					<div class="card mb-3" style="min-width: 15rem;">
						<div class="card-header bg-info">
							<h5 class="card-title text-white">Feature 3</h5>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="feature3">Hier das Feature 3 auswählen</label>
								<select class="custom-select" name="feature3" id="feature3">
									<?php if(isset($feature3->serie_title)): ?>
										<option value="serie|<?php echo e($feature3->id); ?>"><?php echo e($title3); ?> (<?php echo e($type3); ?>)</option>	 
									<?php elseif(isset($feature3->unit_title)): ?>
										<option value="unit|<?php echo e($feature3->id); ?>"><?php echo e($title3); ?> (<?php echo e($type3); ?>)</option>
									<?php else: ?>	 
										<option value="">Bitte auswählen</option> 
									<?php endif; ?>
									<optgroup label="Serien">
										<?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="serie|<?php echo e($serie->id); ?>"><?php echo e($serie->serie_title); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</optgroup>
									<optgroup label="Lerneinheiten">
										<?php $__currentLoopData = $units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="snit|<?php echo e($unit->id); ?>"><?php echo e($unit->unit_title); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</optgroup>
								</select>
								<?php if($errors->has('feature3')): ?>
									<span class="help-block">
										<strong><?php echo e($errors->first('feature3')); ?></strong>
									</span>
								<?php endif; ?>
							</div>
						</div>
					</div> 
			</div>	
			<div class="d-flex justify-content-end mb-5">
				<button class="btn btn-warning" type="submit">Änderungen speichern</button>
			</div>
			</form>
		</div>
	
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/index_features.blade.php ENDPATH**/ ?>