<?php $__env->startSection('main'); ?>
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h2>Neue Lerneinheit anlegen</h2>
          <hr></hr>

<div class="container">
	<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<div class="card w-75">
		<div class="card-header text-center bg-warning">
			<h5>Neue Lerneinheit</h5>
		</div>
	<form class="my-3 " method="POST" action="/backend/units" enctype="multipart/form-data">
		<?php echo e(csrf_field()); ?>

			
			<div class="form-group">
				<label for="unit_title" class="col-md-6 control-label">Titel der Lerneinheit:</label>
				<div class="col-md-10">
				<input id="unit_title" type="text" class="form-control <?php echo e($errors->has('unit_title') ? 'is-invalid' : ''); ?>" name="unit_title" value="<?php echo e(old('unit_title')); ?>" required autofocus>
					<?php if($errors->has('unit_title')): ?>
						<span class="help-block">
							<strong class="text-danger"><?php echo e($errors->first('unit_title')); ?></strong>
						</span>
					<?php endif; ?>
				</div>
			</div>
			
			<div class="form-group mb-3">
				<label for="unit_description" class="col-md-6 control-label">Kurzbeschreibung der Lerneinheit:</label>
				<div class="col-md-10">
					<textarea class="form-control" id="unit_description" name="unit_description" aria-label="description" aria-describedby="description"></textarea>
					<?php if($errors->has('unit_description')): ?>
						<span class="help-block">
							<strong class="text-danger"><?php echo e($errors->first('unit_description')); ?></strong>
						</span>
					<?php endif; ?>
				</div>
			</div>

			<div class="col-md-10">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">Fach:</label>
					</div>
					<select class="form-control custom-select <?php echo e($errors->has('subject_id') ? 'is-invalid' : ''); ?>" id="subject_id" name="subject_id" required autofocus>
						<option value=""></option>
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

			<div class="col-md-10">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text" for="topic_id">Thema:</label>
					</div>
					<select class="form-control custom-select <?php echo e($errors->has('topic_id') ? 'is-invalid' : ''); ?>" id="topic_id" name="topic_id" required autofocus>
						<option>Zuerst Fach auswählen</option>
					</select>
					<?php if($errors->has('topic_id')): ?>
						<span class="help-block">
							<strong class="text-danger"><?php echo e($errors->first('subject_id')); ?></strong>
						</span>
					<?php endif; ?>
				</div>
			</div>

			<div class="col-md-10">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<label class="input-group-text" for="topic_id">Serie:</label>
					</div>
					<select class="form-control custom-select" id="serie_id" name="serie_id">
						<option value="">Gehört zu keiner Serie</option>
						<?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<option value=<?php echo e($serie->id); ?>><?php echo e($serie->serie_title); ?></option>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
				</div>
			</div>

			<div class="col-md-10">
				<div class="input-group mb-3">
					<div class="input-group-prepend">
            		<label for="differentiation_id" class="input-group-text">Differenzierung:</label>
					</div>
					<select class="form-control custom-select" name="differentiation_group" id="differentiation_group">
                  <option value="">Keine Differenzierung</option>
                  <?php if(isset($differentiation_groups)): ?>
                     <?php $__currentLoopData = $differentiation_groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $differentiation_group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($differentiation_group); ?>"><?php echo e($differentiation_group); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                  <option value="Standard">Standard</option>
               </select>
            </div>
         </div>

			<div class="col-md-10 mb-3">
				<div class="row">
					<div class="col-5">
						<div id="noImage" class="card">
							<img class="img-fluid card-img" src="/images/topic_back.jpeg"></img>
							<div class="card-img-overlay d-flex justify-content-center">
								<small class="text-white">Noch kein Bild ausgewählt</small>
							</div>
						</div>
						<div id="hasImage" class="d-none">
							<img class="img-fluid card-img" id="imgUpload" src="#" alt="your image" />
						</div>
					</div>
					<div class="col-7 d-flex flex-column align-self-center">
						<label class="" for="unit_img"><i class="far fa-image"></i> Titelbild für die Lerneinheit</label>
						<input class="form-control-file" type="file" id="imgInp" name="unit_img" style="color:transparent;">
					</div>
				</div>
			</div>



			<div class="col-md-10">
				<div class="form-group">
					<button type="submit" class="form-control btn btn-primary">Lerneinheit speichern</button> 
				</div>
			</div>
		
		
	</div>
	
</form>
</div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<!-- Select2 initialisieren -->
<script>
$(document).ready(function() {
    $(".select2-multi").select2({
    	tags: true,
    	createTag: function (params) {
    		// Don't offset to create a tag if there is no @ symbol
			if (params.term.indexOf('@') === -1) {
      		// Return null to disable tag creation
      		return null;
    		}
    		return {
      		id: params.term,
      		text: params.term
    		}
  		}
    });
});
</script>
<script src="<?php echo e(asset('js/preview_upload_image.js')); ?>"></script>

<script src="<?php echo e(asset('js/ddd_subject_topic.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/create_units.blade.php ENDPATH**/ ?>