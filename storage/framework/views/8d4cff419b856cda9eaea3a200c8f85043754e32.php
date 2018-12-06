<?php $__env->startSection('stylesheets'); ?>
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>
  tinymce.init({
  	selector: 'textarea',
  	plugins: 'link',
  	menubar: false
  });
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>

    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h1>Blogbeiträge erstellen </h1>

<div class="container">	
	<form method="POST" action="/backend/blog" enctype="multipart/form-data">
		<?php echo e(csrf_field()); ?>

		<div class="form-group">
			<label for="post_title">Titel:</label>
			<input type="text" class="form-control" id="post_title" name="post_title">
		</div>
		<div class="form-group">
			<label for="post_body">Text:</label>
			<textarea class="form-control" id="post_body" name="post_body"></textarea>
		</div>
		<div class="form-group">
		<label for="post_img">Start-Bild für den Beitrag:</label>
		<input type="file" class="form-control" id="post_img" name="post_img">
		</div>
		
		<!-- Freie Tags -->	
		<div class="form-group my-3">
			<label class="form-text" for="tags">Tags:</label>
			<small class="form-text text-muted">Neue Tags mit einem "@" beginnen</small>
			<select class="select2-multi form-control" name="tags[]" id="tags" multiple="multiple">
				<option value=""></option>
				<?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($tag->id); ?>"><?php echo e($tag->tag_name); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>	
		

			<button type="submit" class=" form-control btn btn-primary">Neuen Blogbeitrag speichern</button>
</div>		
	<?php echo $__env->make('layouts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>