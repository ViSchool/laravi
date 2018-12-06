<?php $__env->startSection('stylesheets'); ?>
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
  <script>
  tinymce.init({
  	selector: 'textarea',
  	plugins: 'link',
  	menubar: false,
  });
  </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>

<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
<h1>Blogbeitrag bearbeiten </h1>

<div class="container">	
	<form method="POST" action="<?php echo e(route('posts.update',[$post->id])); ?>" enctype="multipart/form-data">
		<?php echo e(csrf_field()); ?> <?php echo e(method_field('PATCH')); ?>

		<div class="form-group">
			<label for="post_title">Titel:</label>
			<input type="text" value="<?php echo e($post->post_title); ?>"class="form-control" id="post_title" name="post_title">
		</div>
		<div class="form-group">
			<label for="post_body">Text:</label>
			<textarea class="form-control" id="post_body" name="post_body"><?php echo e($post->post_body); ?></textarea>
		</div>
		
		<div class="form-group">
				<label class="float-left p-2">Aktuelles Bild:</label>
				<?php if(isset($post->post_img)): ?>
				<img class="img-fluid float-left p-2 img-thumbnail" src="/images/posts/<?php echo e($post->post_img); ?>" style="width:150px"></img>
				<?php endif; ?>
		</div>
		<div class="form-group">	
			<label class="my-3" for="post_img">Start-Bild für den Beitrag ändern:</label>
			<input type="file" class="form-control" id="post_img" name="post_img">
		</div>
		
		<div class="form-group my-3">
			<label for="tags">Tags:</label>
			<select class="select2-multi form-control" name="tags[]" id="tags" multiple="multiple">
				<?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($tag->id); ?>"><?php echo e($tag->tag_name); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>	
		
		
		<button type="submit" class=" form-control btn btn-primary">Änderungen speichern</button>
	</form>
</div>
<hr></hr>

<div class=" container form-group">
	<form method="POST" action="<?php echo e(route('posts.destroy',[$post->id])); ?>">
		<?php echo e(csrf_field()); ?> <?php echo e(method_field('DELETE')); ?>

		<button class=" form-control btn btn-warning" type="submit"> Blogbeitrag komplett löschen</button>
	</form>
</div>
			
<?php echo $__env->make('layouts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
$(document).ready(function() {
	$('#tags').select2({
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
	$("#tags").select2().val(<?php echo json_encode($post->tags()->allRelatedIds()); ?>).trigger('change');
});
</script>
<!-- Select2 initialisieren -->
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layout_backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>