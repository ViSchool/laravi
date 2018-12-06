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
<?php echo $__env->make('layouts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<form method="POST" action="<?php echo e(route('backend.units.update',[$unit->id])); ?>" enctype="multipart/form-data">
	<?php echo e(csrf_field()); ?> <?php echo e(method_field('PATCH')); ?>

		<div class="form-group">
			<div class="input-group mb-3">
				<div class="input-group-prepend"> 
					<label class="input-group-text">Titel der Unterrichtseinheit:</label>
				</div>
				<input value="<?php echo e($unit->unit_title); ?>" type="text" class="form-control" id="unit_title" name="unit_title">
			</div>
		</div>
		<div class="form-group mb-3">
				<label class="mb-1">Kurzbeschreibung der Unterrichtseinheit:</label>
			<textarea class="form-control" id="unit_description" name="unit_description" aria-label="description" aria-describedby="description"><?php echo e($unit->unit_description); ?></textarea>
		</div>
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<span class="input-group-text">Fach auswählen:</label>
			</div>
			<select class="form-control custom-select" id="subject_id" name="subject_id">
				<option value="<?php echo e($unit->subject_id); ?>"><?php echo e($unit->subject->subject_title); ?></option>
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
				<option value="<?php echo e($unit->topic_id); ?>"><?php echo e($unit->topic->topic_title); ?></option>
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
		<div class="input-group mb-3">
			<div class="input-group-prepend">
				<label class="input-group-text" for="topic_id">Unterrichtseinheit gehört zur Serie:</label>
			</div>
			<select class="form-control custom-select" id="series" name="series">
				<?php if(isset($currentSerie->id)): ?>
				<option value=<?php echo e($currentSerie->id); ?>><?php echo e($currentSerie->serie_title); ?></option>
				<?php endif; ?>
				<option value="">Gehört zu keiner Serie</option>
				<?php $__currentLoopData = $unit->series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($serie->id); ?>"><?php echo e($serie->serie_title); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>
		<?php if(isset($unit->unit_img)): ?>
		<div>
			<img class="img-fluid" src="/images/units/<?php echo e($unit->unit_img_thumb); ?>"></img>
		</div>
		<?php endif; ?>
		<div class=" form-group form-control my-5">
			<label for="unit_img"><i class="far fa-image"></i> Bild für die Einheit hochladen</label>
			<input type="file" id="unit_img" name="unit_img"></input>
		</div>
		
		<div class="form-group">
			<button type="submit" class="form-control btn btn-primary">Änderungen für die Unterrichtseinheit speichern</button> 
		</div>
	</form>

	<hr></hr>
	<?php if(isset($unit->blocks)): ?>
	<h5 class="mb-3">Zu dieser Unterrichtseinheit gibt es bereits <?php echo e($unit->blocks->count()); ?> Aufgaben:</h5>

    	<table class="table">
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
				<tr>
					<td><a href="/backend/blocks/<?php echo e($block->id); ?>">Aufgabe bearbeiten</a></td>
					<td>
					<?php if(isset($block->alternative)): ?>
					<i class="mr-3 fas fa-exchange-alt" style="color:orange;"></i>
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
	<?php endif; ?>

	<?php if(empty($unit->blocks)): ?>
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

<?php echo $__env->make('layouts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script type="text/javascript">
	$( function() {
	$(".sortable").sortable();
	$(".sortable").disableSelection();
	});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.layout_backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>