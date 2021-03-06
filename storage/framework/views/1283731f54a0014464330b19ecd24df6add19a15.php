<?php $__env->startSection('main'); ?>
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h2>Neuen Inhalt anlegen</h2>
          <hr></hr>

<div class="container">
	<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<form method="POST" action="/backend/contents" enctype="multipart/form-data">
<?php echo e(csrf_field()); ?>

	<div class="form-group">
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Titel des Inhalts:</label>
			</div>
			<input type="text" class="form-control" id="content_title" name="content_title" value="<?php echo e(old('content_title')); ?>">
		</div>
			
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Fach auswählen:</label>
			</div>
			<select class="form-control custom-select" id="subject_id" name="subject_id">
				<?php if((old('subject_id')) !== null): ?>
					<?php 
						$subject_id_old = old('subject_id');
						$subject_old = App\Subject::where('id', '=' , $subject_id_old)->first();
					?>
					<option value="<?php echo e($subject_id_old); ?>"><?php echo e($subject_old->subject_title); ?></option>
				<?php endif; ?>
				<?php if(empty(old('subject_id'))): ?>
					<option value=""></option>
				<?php endif; ?>
				<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
					<option value="<?php echo e($subject->id); ?>"><?php echo e($subject->subject_title); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="topic_id">Thema auswählen:</label>
			</div>
			<select class="form-control custom-select" id="topic_id" name="topic_id">
				<?php if((old('topic_id')) !== null): ?>
					<?php 
						$topic_id_old = old('topic_id');
						$topic_old = App\Topic::where('id', '=' , $topic_id_old)->first();
					?>
					<option value="<?php echo e($topic_id_old); ?>"><?php echo e($topic_old->topic_title); ?></option>
				<?php endif; ?>
				<?php if(empty(old('topic_id'))): ?>
					<option>Zuerst Fach auswählen</option>
				<?php endif; ?>
			</select>
			<div class="col-md-2">
				<span id="loader" style="visibility: hidden;">
					<i class="far fa-spinner fa-spin"></i>
				</span>
			</div>
		</div>
		<hr></hr>
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="subject_id">Gehört der Inhalt zu einem Lernportal?</label>
			</div>
			<select class="form-control custom-select" id="portal_id" name="portal_id">
				<?php if((old('portal_id')) !== null): ?>
					<?php 
						$portal_id_old = old('portal_id');
						$portal_old = App\Portal::where('id', '=' , $portal_id_old)->first();
					?>
					<option value="<?php echo e($portal_id_old); ?>"><?php echo e($portal_old->portal_title); ?></option>
				<?php endif; ?>
				<?php if(empty(old('portal_id'))): ?>
					<option value="73"></option>
				<?php endif; ?>
				<?php $__currentLoopData = $portals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $portal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
					<option value="<?php echo e($portal->id); ?>"><?php echo e($portal->portal_title); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="content_link">Link zum Inhalt:</label>
			</div>
			<input type="url" class="form-control" id="content_link" name="content_link" placeholder="URL hierhin kopieren" value="<?php echo e(old('content_link')); ?>"></input>
		</div>
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="tool_id">Provider :</label>
			</div>
			<select class="form-control custom-select" id="tool_id" name="tool_id">
				<?php if((old('tool_id')) !== null): ?>
					<?php 
						$tool_id_old = old('tool_id');
						$tool_old = App\Tool::where('id', '=' , $tool_id_old)->first();
					?>
					<option value="<?php echo e($tool_id_old); ?>"><?php echo e($tool_old->tool_title); ?></option>
				<?php endif; ?>
				<?php if(empty(old('portal_id'))): ?>
				<option value=""></option>
				<?php endif; ?>
				<?php $__currentLoopData = $tools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
				<option value="<?php echo e($tool->id); ?>"><?php echo e($tool->tool_title); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>}}
			</select>
		</div>
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="license">Lizenz:</label>
			</div>
			<select class="form-control custom-select" id="license" name="license">
				<option value="<?php echo e(old('license')); ?>"><?php echo e(old('license')); ?></option>
				<option>Standard-Youtube-Lizenz</option>
				<option>CC-0</option>
				<option>CC BY</option>
				<option>CC BY-SA</option>
				<option>CC BY-ND</option>
				<option>CC BY-NC</option>
				<option>andere</option>
				<option>unbekannt</option>
			</select>
		</div>
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
			<label class="input-group-text" for="content_type">Art des Lerninhalts:</label>
			</div>
			
			<select class="form-control custom-select" id="type_id" name="type_id">
				<?php if((old('type_id')) !== null): ?>
					<?php 
						$type_id_old = old('type_id');
						$type_old = App\Type::where('id', '=' , $type_id_old)->first();
					?>
					<option value="<?php echo e($type_id_old); ?>"><?php echo e($type_old->content_type); ?></option>
				<?php endif; ?>
				<?php if(empty(old('type_id'))): ?>
				<option value=""></option>
				<?php endif; ?>
				<?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($type->id); ?>"><?php echo e($type->content_type); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>
		
		<!-- Geeignet für -->
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="didactics_type"> Geeignet für:</label>
			</div>
			<select class="form-control custom-select" id="didactics_type" name="didactics_type">
				<option value="<?php echo e(old('didactics_type')); ?>"><?php echo e(old('didactics_type')); ?></option>
				<option>Einführung</option>
				<option>Vertiefung</option>
				<option>Nacharbeit</option>
				<option>Hausaufgabe</option>
				<option>Alle</option>
			</select>
		</div>
		
		<!-- How-to -->
		<div class="input-group mb-3">
    			<span class="form-control">Anleitung zum analogen Nachmachen (How-to)? </span>
    		<div class="input-group-append">
    			<div class="input-group-text">
      				<input value="1" type="checkbox" name="how_to" id="how_to">
    			</div>
  			</div>
		</div>
		
		
				<!-- Duration -->
			<div class="input-group mb-3">
  				<div class="input-group-prepend">
    				<span class="input-group-text">Länge des Inhalts: </span>
  				</div>
  				<input type="text" class="form-control" id="content_duration" name="content_duration" value="<?php echo e(old('content_duration')); ?>">
 				<div class="input-group-append">
					<span class="input-group-text">Minuten</span>
				</div>
				<small class=" text-muted font-weight-small">Hier eine ganze Zahl an Minuten eingeben.</small>
			</div>
	
		
		
		<div class=" form-group form-control my-5">
			<label for="content_img"><i class="far fa-image"></i> Bild für den Inhalt hochladen</label>
			<input type="file" id="content_img" name="content_img">
		</div>
	
	<div class="mt-3">
	<h5>Optionale Daten:</h5>
	</div>
				
		<!-- Freie Tags -->	
		<small class="form-text text-muted">Neue Tags mit einem "@" beginnen</small>
		<div class="input-group my-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Tags:</span>
			</div>	
			<select class="custom-select select2-multi" name="tags[]" id="tags" multiple="multiple">
				<option value=""></option>
				<?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($tag->id); ?>"><?php echo e($tag->tag_name); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>
			
		
		
		
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text"for="content_type">Geeignet für folgende Gerätegrößen:</label>
			</div>
			<select class="custom-select" name="devices[]" id="devices" multiple="multiple">
				<?php $__currentLoopData = $devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($device->id); ?>"><?php echo e($device->device_type); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>

		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Technische/Sonstige Einschränkungen:</span>
			</div>
			<textarea class="form-control" name="technical_limitations" id="technical_limitations"><?php echo e(old('technical_limitations')); ?></textarea>
		</div>			

			
		<div class="form-group">
			<button type="submit" class="form-control btn btn-primary">Lerninhalt eintragen</button> 
		</div>
		
		</div>

		
</form>
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

<script src="<?php echo e(asset('js/ddd_subject_topic.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/create_contents.blade.php ENDPATH**/ ?>