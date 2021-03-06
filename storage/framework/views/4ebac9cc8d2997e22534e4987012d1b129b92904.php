<?php $__env->startSection('main'); ?>
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <div><h2>Lerninhalte administrieren
          <a href="/backend/contents/create"><i class="far fa-plus-square"></i></a></h2></div>
          

<div class="container">
	<div class="my-4">
	<p>Inhalte nach Fächern filtern:</p>
	<?php $__currentLoopData = $subjects->sortBy('subject_title'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<a class="btn btn-info m-1" href="/backend/contents/subjectfilter/<?php echo e($subject->id); ?>"><?php echo e($subject->subject_title); ?></a>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
		<table class="table">
			<thead>
				<tr>
					<th>Titel des Inhalts</th>
					<th>Thema</th>
					<th>Fach</th>
					<th>Typ</th>
					<th>Test</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><a href="<?php echo e(route ('backend.contents.show',[$content->id])); ?>"><?php echo e($content->content_title); ?></a></td>	
					<td><?php echo e($content->topic->topic_title); ?></td>
					<td><?php echo e($content->subject->subject_title); ?></td>
					<td><?php echo e($content->type->content_type); ?></td>
					<td><a href="/backend/questions/<?php echo e($content->id); ?>"><i class="far fa-question-circle"></i></a></td>
					<td><?php echo e($content->status->status_name); ?></td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>
		<ul class="pagination"><?php echo e($contents->links()); ?></ul>
		<hr></hr>
	<a class="btn btn-primary" href="/backend/contents/create">Neuen Lerninhalt eintragen</a>
	
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views//backend/index_contents.blade.php ENDPATH**/ ?>