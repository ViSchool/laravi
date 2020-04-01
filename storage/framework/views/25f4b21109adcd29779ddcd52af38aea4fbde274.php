<?php $__env->startSection('main'); ?>
    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h1> Fach bearbeiten</h1>

<div class="container">
	<div class="container">	
 	<form method="POST" action="<?php echo e(route('subjects.update',[$subject->id])); ?>">
		<?php echo e(csrf_field()); ?> <?php echo e(method_field('PATCH')); ?>

		
		<div class="form-group">
			<label for="subject_title">Fachname:</label>
			<input type="text" class="form-control" id="subject_title" name="subject_title" value="<?php echo e($subject->subject_title); ?>">
		</div>

	
		

		<div class="form-group">
			<p>Der folgende Icon wird für <?php echo e($subject->subject_title); ?> angezeigt:</p>
			<p class="fa-3x"><i class="<?php echo e($subject->subject_icon); ?>"></i></p>
			<label for="subject_icon">Neues Icon auwählen: </label>
			<select class="form-control" id="subject_icon" name="subject_icon">
				<option><?php echo e($subject->subject_icon); ?></option>
				<?php $__currentLoopData = $icons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<option value="<?php echo e($icon->icon_title); ?>"><?php echo e($icon->icon_title); ?>: &#x<?php echo e($icon->icon_number); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>			</select>
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-secondary">Änderungen speichern</button>
		</div>
	<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	</form>
	<hr></hr>
		<div class="form-group">
			<form method="POST" action="<?php echo e(route('subjects.destroy',[$subject->id])); ?>">
				<?php echo e(csrf_field()); ?> <?php echo e(method_field('DELETE')); ?>

					<button class="btn btn-warning" type="submit"> Fach komplett löschen</button>
			</form>
		</div>
				

</div>

<hr></hr>
<div class = "container">
<h4>Themen im Fach <?php echo e($subject->subject_title); ?></h4>
		<table class="table">
			<thead>
				<tr>
					<th>Name des Themas</th>
					<th>Anzahl der Inhalte</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $subject->topics->sortBy('topic_title'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><a href="/backend/topics/<?php echo e($topic->id); ?>"><?php echo e($topic->topic_title); ?></a></td>	
					<td><?php echo e($topic->content()->count()); ?></td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>	
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/show_subjects.blade.php ENDPATH**/ ?>