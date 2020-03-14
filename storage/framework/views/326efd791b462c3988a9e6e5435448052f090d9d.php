<?php $__env->startSection('main'); ?>
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h1>Freizugebende Inhalte</h1>

<div class="container">
	<div class="table-responsive">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Typ</th>
					<th>Titel</th>
					<th>Lehreraccount</th>
					<th>Status ändern</th>
				</tr>
			</thead>
			
			<tbody>
				<tr>
					<th colspan="4" class="bg-info text-white">Freizugebende Inhalte</th>
				</tr>
				<?php if(count($status->contents) == 0): ?>
					<td colspan="4"> Aktuell keine Inhalte zum freigeben</td>	 	
				<?php else: ?>
					<?php $__currentLoopData = $status->contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><small><?php echo e($content->type->content_type); ?></small></td>
							<td><a href="/backend/contents/<?php echo e($content->id); ?>"><small><?php echo e($content->content_title); ?></small></a></td>
							<td><small><?php echo e($content->user->user_name); ?></small></td>
							<td><a class="btn-sm btn-primary" href="/backend/contents/adminapproval/<?php echo e($content->id); ?>">Freigeben</a></td>
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
			</tbody>

			
			<tbody>
				<tr>
					<th colspan="4" class="bg-info text-white">Freizugebende Themen</th>
				</tr>
				<?php if(count($status->topics) == 0): ?>
					<td colspan="4"> Aktuell keine Themen zum freigeben</td>	 	
				<?php else: ?>
					<?php $__currentLoopData = $status->topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><small>Thema</small></td>
							<td><a href="/backend/topics/<?php echo e($topic->id); ?>"><small><?php echo e($topic->topic_title); ?></small></a></td>
							<td><small><?php echo e($topic->user->user_name); ?></small></td>
							<td><a class="btn-sm btn-primary" href="/backend/topics/approve/<?php echo e($topic->id); ?>">Freigeben</a></td>	
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
			</tbody>

			
			<tbody>
				<tr>
					<th colspan="4" class="bg-info text-white">Freizugebende Lerneinheiten</th>
				</tr>
				<?php if(count($status->units) == 0): ?>
					<td colspan="4"> Aktuell keine Lerneinheiten zum freigeben</td>	 	
				<?php else: ?>
					<?php $__currentLoopData = $status->units; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><small>Lerneinheit</small></td>
							<td><small><?php echo e($unit->unit_title); ?></small></td>
							<td><small><?php echo e($unit->user->user_name); ?></small></td>
							<td><a class="btn-sm btn-primary" href="/backend/units/approve/<?php echo e($unit->id); ?>">Freigeben</a></td>	
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
			</tbody>

			
			<tbody>
				<tr>
					<th colspan="4" class="bg-info text-white">Freizugebende Serien</th>
				</tr>
				<?php if(count($status->series) == 0): ?>
					<td colspan="4"> Aktuell keine Serien zum freigeben</td>	 	
				<?php else: ?>
					<?php $__currentLoopData = $status->series; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $serie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td><small>Serie</small></td>
							<td><small><?php echo e($serie->serie_title); ?></small></td>
							<td><small><?php echo e($serie->user->user_name); ?></small></td>
							<td><a class="btn-sm btn-primary" href="/backend/series/approve/<?php echo e($serie->id); ?>">Freigeben</a></td>	
						</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php endif; ?>
			</tbody>



      </table>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/index_approvals.blade.php ENDPATH**/ ?>