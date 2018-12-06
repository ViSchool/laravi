<?php $__env->startSection('main'); ?>
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h1> Thema bearbeiten</h1>

<div class="container">
	<div class="container">	
 	<form method="POST" action="<?php echo e(route('topics.update',[$topic->id])); ?>"> 	
	 <?php echo e(csrf_field()); ?> <?php echo e(method_field('PATCH')); ?>

		<div class="form-group">
			<label for="topic_title">Name des Themas:</label>
			<input type="text" class="form-control" id="topic_title" name="topic_title" value="<?php echo e($topic->topic_title); ?>">
		</div>
		
		<div class="form-group">
			<label for="subjects">Das Thema gehört zum Fach:</label>
			<select class="form-control" id="subjects" multiple="multiple" name="subjects[]"> 
			<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<option value="<?php echo e($subject->id); ?>"><?php echo e($subject->subject_title); ?></option> 
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>
				
		<div class="form-group">
			<button type="submit" class="btn btn-secondary">Änderungen speichern</button>
		</div>
	</form>
		<hr></hr>
		<div class="form-group">
			<form method="POST" action="<?php echo e(route('topics.destroy',[$topic->id])); ?>">
				<?php echo e(csrf_field()); ?> <?php echo e(method_field('DELETE')); ?>

					<button class="btn btn-warning" type="submit"> Thema komplett löschen</button>
			</form>
		</div>
	
	<?php echo $__env->make('layouts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
</div>
<hr></hr>
<div class = "container mt-5">
<h4>Inhalte zum Thema <span class="btn-lg btn-info"><?php echo e($topic->topic_title); ?></span></h4>
		<table class="table">
			<thead>
				<tr>
					<th>Name des Inhalts</th>
					<th>Art des Inhalts</th>
				</tr>
			</thead>
			<tbody>
				<?php if(isset($topic->content)): ?>
				<?php $__currentLoopData = $topic->content->sortBy('content_title'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><a href="/backend/contents/<?php echo e($content->id); ?>"><?php echo e($content->content_title); ?></a></td>	
					<td><?php echo e($content->content_type); ?></td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
			</tbody>
		</table>	
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
	<script>
		$(document).ready(function() {
		$("#subjects").select2();
		$("#subjects").select2().val(<?php echo json_encode($topic->subjects()->allRelatedIds()); ?>).trigger('change');
		});
	</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layout_backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>