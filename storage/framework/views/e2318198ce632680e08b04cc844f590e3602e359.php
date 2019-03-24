<?php $__env->startSection('main'); ?>
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h1> Tags - Übersicht</h1>

<div class="container">
	<div class="row mb-3">
		<a class="btn btn-primary" data-toggle="collapse" href="#createTag">Neuen Tag anlegen</a>
		<div class="collapse" id="createTag">
			<form method="POST" action="/backend/tags">
				<?php echo e(csrf_field()); ?>

			<div class="card card-body">
				<div class="form-group">
					<label for="tag_name">Tag:</label>
					<input type="text" class="form-control" id="tag_name" name="tag_name">
				</div>
				<div class="form-group">
					<label for="tag-group">Tag-Gruppe:</label>
					<select class="form-control mb-4" id="tag_group" name="tag_group">
						<option value="ohne"></option>
						<option>Klassenstufe</option>
					</select>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Tag eintragen</button>
				</div>
	<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
			</form>
		</div>
	</div>
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Tag</th>
					<th>Tag-Gruppe</th>
					<th>Löschen</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($tag->id); ?></td>
					<td><a href="/backend/tags/<?php echo e($tag->id); ?>"><?php echo e($tag->tag_name); ?></a></td>	
					<td><?php echo e($tag->tag_group); ?></td>
					<td><form method="POST" action="<?php echo e(route('tags.destroy',[$tag->id])); ?>">
				<?php echo e(csrf_field()); ?> <?php echo e(method_field('DELETE')); ?>

					<button class="btn btn-link" type="submit"><i class="far fa-trash-alt"></i></button>
			</form>
		</div>
		</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
		<hr></hr>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>