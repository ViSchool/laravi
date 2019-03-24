<?php $__env->startSection('main'); ?>
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <div class="container">
          <h2><?php echo e($content->content_title); ?></h2>
          </div>
          <hr></hr>

<div class="container">	
<form method="POST" action="<?php echo e(route('contents.update',[$content->id])); ?>" enctype="multipart/form-data">
<?php echo e(csrf_field()); ?> <?php echo e(method_field('PATCH')); ?>

	<div class="form-group">
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Titel des Inhalts:</label>
			</div>
			<input  value="<?php echo e($content->content_title); ?>" type="text" class="form-control" id="content_title" name="content_title">
		</div>
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Fach auswählen:</label>
			</div>
			<select class="form-control custom-select" id="subject_id" name="subject_id">
			<option value="<?php echo e($content->subject_id); ?>"><?php echo e($content->subject->subject_title); ?></option>
			<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
			<option value="<?php echo e($subject->id); ?>"><?php echo e($subject->subject_title); ?></option>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="topic_id">Anderes Thema auswählen:</label>
			</div>
			<select class="form-control custom-select" id="topic_id" name="topic_id">
				<option value="<?php echo e($content->topic_id); ?>"><?php echo e($content->topic->topic_title); ?></option>
				<?php $__currentLoopData = $currentSubject->topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($topic->id); ?>"><?php echo e($topic->topic_title); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
				<?php if(isset($content->portal_id)): ?>
				<option value="<?php echo e($content->portal_id); ?>"><?php echo e($content->portal->portal_title); ?></option>
				<?php endif; ?>
				<option value="73"></option>
				<?php $__currentLoopData = $portals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $portal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
				<option value="<?php echo e($portal->id); ?>"><?php echo e($portal->portal_title); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="content_link">Link zum Inhalt:</label>
			</div>
			<input type="url" class="form-control" id="content_link" name="content_link" value="<?php echo e($content->content_link); ?>"" placeholder="<?php echo e($content->content_link); ?>"></input>
		</div>
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="tool_id">Provider :</label>
			</div>
			<select class="form-control custom-select" id="tool_id" name="tool_id">
				<option value="<?php echo e($content->tool_id); ?>"><?php echo e($content->tool->tool_title); ?></option>
				<?php $__currentLoopData = $tools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
				<option value="<?php echo e($tool->id); ?>"><?php echo e($tool->tool_title); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>
		
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="license">Lizenz:</label>
			</div>
			<select class="form-control custom-select" id="license" name="license">
				<option><?php echo e($content->license); ?></option>
				<option>Standard-Youtube-Lizenz</option>
				<option>CC-0</option>
				<option>CC BY</option>
				<option>CC-BY-SA</option>
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
				<option value="<?php echo e($content->type->id); ?>"><?php echo e($content->type->content_type); ?></option>
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
				<option><?php echo e($content->didactics_type); ?></option>
				<option>Einführung</option>
				<option>Vertiefung</option>
				<option>Nacharbeit</option>
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
  				<input type="text" value="<?php echo e($content->content_duration); ?>" class="form-control" id="content_duration" name="content_duration">
 				<div class="input-group-append">
					<span class="input-group-text">Minuten</span>
				</div>
			</div>
		<?php if(isset($content->content_img)): ?>
		<div>
			<img class="img-fluid" src="/images/contents/<?php echo e($content->content_img_thumb); ?>"></img>
		</div>
		<?php endif; ?>
		
		<div class="custom-file form-group form-control my-5">
			<label class="custom-file-label" for="content_img"><i class="far fa-image"></i> Anderes Bild für den Inhalt hochladen</label>
			<input class="custom-file-input" type="file" id="content_img" name="content_img">
		</div>
	
	<div class="mt-3">
	<h5>Optionale Daten:</h5>
	</div>
				
		<!-- Freie Tags -->	
		<div class="input-group my-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Tags:</span>
			</div>	
			<select class="select2-multi custom-select" name="tags[]" id="tags" multiple="multiple">
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
				<span class="input-group-text">Technische Einschränkungen:</span>
			</div>
			<textarea value="<?php echo e($content->technical_limitations); ?>" class="form-control" name="technical_limitations" id="technical_limitations"></textarea>
		</div>			

			
		<div class="form-group">
			<button type="submit" class="form-control btn btn-primary">Änderungen speichern</button> 
		</div>
	</form>
</div>
<hr></hr>

<div class="form-group">
	<form method="POST" action="<?php echo e(route('contents.destroy',[$content->id])); ?>">
		<?php echo e(csrf_field()); ?> <?php echo e(method_field('DELETE')); ?>

		<button class=" form-control btn btn-warning" type="submit"> Inhalt komplett löschen</button>
	</form>
</div>


<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<!-- Select2 initialisieren -->
<script>
$(document).ready(function() {
    $('#tags').select2({
    	tags: true
    });
    $("#tags").select2().val(<?php echo json_encode($content->tags()->allRelatedIds()); ?>).trigger('change');
	});
</script>

<script src="<?php echo e(asset('js/ddd_subject_topic.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>