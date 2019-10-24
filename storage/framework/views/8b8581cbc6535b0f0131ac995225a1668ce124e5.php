<?php $__env->startSection('stylesheets'); ?>
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h4>Serien mit Unterrichtseinheiten administrieren</h4>

<div class="container">
	<p>Hier sind alle Serien mit einzelnen Unterrichtseinheiten gelistet</p>
		<table class="table">
			<thead>
				<tr>
					<th>Titel der Serie</th>
					<th>Anzahl zugehöriger Unterrichtseinheiten</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><a href="/backend/series/<?php echo e($serie->id); ?>"><?php echo e($serie->serie_title); ?></a></td>	
					<td><i class="<?php echo e($serie->status->status_icon); ?>"></i><br><?php echo e($serie->status->status_name); ?></td>
					<td>
						<?php
							$units = $serie->units->count();
						?> 
						<?php echo e($units); ?>

					</td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
		<?php echo e($series->links()); ?>

		<hr></hr>
	<a class="btn btn-primary"href="/backend/series/create">Neue Serie erstellen</a>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/index_series.blade.php ENDPATH**/ ?>