<?php $__env->startSection('main'); ?>
     <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3"> 
          <h1>FAQs - Übersicht</h1>

<div class="container">
		<table class="table">
			<thead>
				<tr>
					<th>Kategorie</th>
					<th>Frage</th>
					<th>Frage löschen</th>
				</tr>
			</thead>
			<tbody>
				<?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($faq->faq_category); ?></td>
					<td><a href="/backend/faq/<?php echo e($faq->id); ?>"><?php echo e($faq->faq_question); ?></a></td>	
					<td><button class="btn btn-link mb-3" type="button" title="FAQ Frage löschen" data-toggle="modal" data-target="#deleteModal_<?php echo e($faq->id); ?>"><i class="fas fa-trash"></i></button></td>
				</tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</tbody>
		</table>

		<div class="modal fade" id="deleteModal_<?php echo e($faq->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <?php echo $__env->make('components.deleteCheck',['typeDelete'=>'faq','id'=>$faq->id, 'title'=>$faq->faq_question], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>

		<?php echo e($faqs->links()); ?>

		
		<hr></hr>
	<a class="btn btn-primary my-3"href="/backend/faq/create">Neue Frage einfügen</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/index_faq.blade.php ENDPATH**/ ?>