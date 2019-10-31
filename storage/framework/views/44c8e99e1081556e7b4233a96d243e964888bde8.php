<?php $__env->startSection('stylesheets'); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.css" rel="stylesheet">
<script src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>
<script src="jquery.ui.touch-punch.min.js"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <div class="container">
          <h2><?php echo e($unit->unit_title); ?></h2>
          </div>
          <hr></hr>

<div class="container">
<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="card">
		<div class="card-header text-center bg-warning">
			<h5>Lerneinheit bearbeiten</h5>
		</div>
		<form class="my-3" method="POST" action="<?php echo e(route('backend.units.update',[$unit->id])); ?>" enctype="multipart/form-data">
		<?php echo e(csrf_field()); ?> <?php echo e(method_field('PATCH')); ?>

			
			<div class="form-group">
				<label for="unit_title" class="col-md-6 col-form-label">Titel der Unterrichtseinheit:</label>
				<div class="col-lg-10">
					<input id="unit_title" type="text" class="form-control <?php echo e($errors->has('unit_title') ? 'invalid' : ''); ?>" name="unit_title" value="<?php echo e($unit->unit_title); ?>" required autofocus>
					<?php if($errors->has('unit_title')): ?>
						<span class="help-block">
							<strong class="text-danger"><?php echo e($errors->first('unit_title')); ?></strong>
						</span>
					<?php endif; ?>
				</div>
			</div>


			<div class="form-group mb-3">
				<label for="unit_description" class="col-md-6 col-form-label">Kurzbeschreibung der Unterrichtseinheit:</label>
				<div class="col-lg-10">
					<textarea class="form-control" id="unit_description" name="unit_description" aria-label="description" aria-describedby="description"><?php echo e($unit->unit_description); ?></textarea>
					<?php if($errors->has('unit_description')): ?>
						<span class="help-block">
							<strong class="text-danger"><?php echo e($errors->first('unit_description')); ?></strong>
						</span>
					<?php endif; ?>
				</div>
			</div>

			<div class="col-lg-10">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">Fach:</label>
					</div>
					<select class="form-control custom-select" id="subject_id" name="subject_id" required autofocus>
						<option value="<?php echo e($unit->subject_id); ?>"><?php echo e($unit->subject->subject_title); ?></option>
						<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
						<option value="<?php echo e($subject->id); ?>"><?php echo e($subject->subject_title); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
					<?php if($errors->has('subject_id')): ?>
						<span class="help-block">
							<strong class="text-danger"><?php echo e($errors->first('subject_id')); ?></strong>
						</span>
					<?php endif; ?>
				</div>
			</div>
			
			<div class="col-lg-10">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text" for="topic_id">Thema:</label>
					</div>
					<select class="form-control custom-select" id="topic_id" name="topic_id">
						<option value="<?php echo e($unit->topic_id); ?>"><?php echo e($unit->topic->topic_title); ?></option>
						<?php $__currentLoopData = $currentSubject->topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($topic->id); ?>"><?php echo e($topic->topic_title); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
				</div>
			</div>

			<div class="col-lg-10">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text" for="topic_id">Serie:</label>
					</div>
					<select class="form-control custom-select" id="serie" name="serie">
						<?php if(isset($currentSerie)): ?>
						<option value=<?php echo e($currentSerie->id); ?>><?php echo e($currentSerie->serie_title); ?></option>
						<?php endif; ?>
						<option value="">Gehört zu keiner Serie</option>
						<?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value="<?php echo e($serie->id); ?>"><?php echo e($serie->serie_title); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
				</div>
			</div>

			<div class="col-lg-10">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
      				<label for="differentiation_id" class="input-group-text">Differenzierung:</label>
					</div>
					<select class="form-control custom-select" name="differentiation_group" id="differentiation_group">
						<?php if(isset($unit->differentiation_group)): ?>
							<option value="<?php echo e($unit->differentiation_group); ?>"><?php echo e($unit->differentiation_group); ?></option>
						<?php endif; ?>
						<option value="">Keine Differenzierung</option>
						<option value="Standard">Standard</option>
                	<?php if(isset($differentiation_groups)): ?>
                  	<?php $__currentLoopData = $differentiation_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $differentiation_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  		<option value="<?php echo e($differentiation_group); ?>"><?php echo e($differentiation_group); ?></option>
                  	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
						  
               </select>
            </div>
         </div>

			<div class="col-lg-10 mb-3">
				<div class="row">
					<div class="col-5">
						<?php if(isset($unit->unit_img)): ?>
							<div class="card">
								<img class="img-fluid card-img" src="/images/units/<?php echo e($unit->unit_img_thumb); ?>"></img>
							</div>
						<?php endif; ?>
						<?php if(empty($unit->unit_img)): ?>
						<div id="noImage" class="card">
							<img class="img-fluid card-img" src="/images/topic_back.jpeg"></img>
							<div class="card-img-overlay d-flex justify-content-center">
								<small class="text-white">Noch kein Bild ausgewählt</small>
							</div>
						</div>
						<div id="hasImage" class="d-none">
							<img class="img-fluid card-img" id="imgUpload" src="#" alt="your image" />
						</div>
						<?php endif; ?>
					</div>
					<div class="col-7 d-flex flex-column align-self-center">
						<label class="" for="unit_img"><i class="far fa-image"></i> Titelbild für die Lerneinheit</label>
						<input class="form-control-file" type="file" id="imgInp" name="unit_img" style="color:transparent;">
					</div>
				</div>
			</div>

			<div class="col-lg-10">
				<div class="input-group mb-3">
					<div class="input-group-prepend ">
						<label class="input-group-text bg-warning" for="status_id">Status:</label>
					</div>
					<select class="form-control custom-select" id="status_id" name="status_id">
						<option value="<?php echo e($unit->status_id); ?>">Aktueller Status: <?php echo e($unit->status->status_name); ?></option>
						<?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($status->id); ?>"> Ändern in: <?php echo e($status->status_name); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
				</div>
			</div>

			<div class="col-lg-10">
				<div class="form-group">
					<button type="submit" class="form-control btn btn-primary">Änderungen speichern</button> 
				</div>
			</div>
		</form>
	</div>

	<hr>
	<?php if(count($unit->blocks) > 0): ?>
	<h5 class="mb-3">Zu dieser Unterrichtseinheit gibt es bereits <?php echo e($unit->blocks->count()); ?> Aufgaben:</h5>

    	<table class="table  table-sm">
			<thead>
				<tr>
					<th>Aufgabe</th>
					<th>Titel der Aufgabe</th>
					<th>Reihenfolge ändern</th>
				</tr>
			</thead>
			<tbody class="sortable">
				<?php
					$maxOrder = $unit->blocks->max('order');
					$minOrder = $unit->blocks->min('order');
				?>
				<?php $__currentLoopData = $unit->blocks->sortBy('order'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php if(count($unit->blocks->where('order',$block->order)) > 1): ?>
					<tr class="table-info">
				<?php else: ?> 
					<tr>
				<?php endif; ?>
					<td><a href="/backend/blocks/<?php echo e($block->id); ?>">Aufgabe bearbeiten</a></td>
					<td>
						<?php if(count($unit->blocks->where('order',$block->order)) > 1): ?>
							<i class="mr-3 fas fa-exchange-alt" style="color:orange;"></i><br>
						<?php endif; ?>
					<?php echo e($block->title); ?> (<?php echo e($block->differentiation->differentiation_title); ?>)</td>	
					<td>
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
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	<?php else: ?> 
		<h5 class="mb-3">Zu dieser Unterrichtseinheit gibt es noch keine Aufgaben.</h5>
	<?php endif; ?>

	<div>
		<a href="/backend/blocks/<?php echo e($unit->id); ?>/create1" class="btn btn-primary mb-3 form-control">Neue Aufgabe einfügen</a>
	</div>
	
	<div class="form-group">
		<form method="POST" action="<?php echo e(route('backend.units.destroy',[$unit->id])); ?>">
			<?php echo e(csrf_field()); ?> <?php echo e(method_field('DELETE')); ?>

			<button class=" form-control btn btn-warning" type="submit"> Lerneinheit komplett löschen</button>
		</form>
	</div>
</div>

<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/preview_upload_image.js')); ?>"></script>
<script src="<?php echo e(asset('js/ddd_subject_topic.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/show_units.blade.php ENDPATH**/ ?>