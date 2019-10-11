<?php $__env->startSection('main'); ?>


<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
	<div class="card mb-4" style="max-width: 400px">
		<div class="card-header bg-warning">
			<h5>Tag "<?php echo e($tag->tag_name); ?>" bearbeiten</h5>
		</div>
  		<div class="card-body">
			
		  <form method="POST" action="/backend/tags/<?php echo e($tag->id); ?>">
				<?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
					<div class="form-group">
						<label for="tag_name">Tag:</label>
						<input type="text" class="form-control" id="tag_name" name="tag_name" value="<?php echo e($tag->tag_name); ?>">
					</div>
					<div class="form-group">
						<label for="tag-group">Tag-Gruppe:</label>
						<select class="form-control mb-4" id="tag_group" name="tag_group">
							<option><?php echo e($tag->tag_group); ?></option>
							<?php $__currentLoopData = $taggroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taggroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option><?php echo e($taggroup); ?></option>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<option value="new">Neue Taggruppe</option>
					</select>
					<div id="new_tag_group_container" class="d-none">
						<label  for="new_tag-group">Name der neuen Tag-Gruppe:</label>
						<input type="text" class="form-control" id="new_tag_group" name="new_tag_group">
					</div>	
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Änderungen speichern</button>
				</div>
	<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</form>
  		</div>
	</div>	
	
	
	<h4> Inhalte mit dem Tag: "<?php echo e($tag->tag_name); ?>" <small>(<?php echo e(count($tag->contents)); ?> Inhalte)</small></h4>
	<div class="container">
		<table class="table table-sm">
			<thead>
				<tr>
					<th>Titel des Inhalts</th>
					<th>Fach</th>
					<th>Thema</th>
					<th>Typ</th>
					
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $tag->contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
				<td><a href="/backend/contents/<?php echo e($content->id); ?>"><?php echo e($content->content_title); ?></a></td>
				<td> <?php echo e($content->subject->subject_title); ?></td>
				<td> <?php echo e($content->topic->topic_title); ?></td>
				<td> <?php echo e($content->type->content_type); ?></td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
	</div>
</main>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
	
<script>
$(document).ready(function() {
$('#tag_group').change(function() {
 if ($(this).val() == 'new') {
     new_tag_group_container.classList.remove('d-none');
  }
});
});
</script>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/single_tag.blade.php ENDPATH**/ ?>