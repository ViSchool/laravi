<?php $__env->startSection('main'); ?>
	<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
		<h1>Dashboard</h1>
	<div class="container">
		<section class="row text-center placeholders">
			<div class="border-0 card col-6 col-sm-3">
				<img src="/images/topic_back.jpeg" width="200" height="200" class=" card-img img-fluid rounded-circle" alt="Generic placeholder thumbnail">		
				<div class="card-img-overlay">
					<h2 class="card-text text-info"><?php echo e($nrSubjects); ?></h2>
				</div>
				<p class="mt-4">Fächer</p>
			</div>
			
			<div class="border-0 card col-6 col-sm-3">
				<img src="/images/topic_back.jpeg" width="200" height="200" class=" card-img img-fluid rounded-circle" alt="Generic placeholder thumbnail">		
				<div class="card-img-overlay">
					<h2 class="card-text text-info"><?php echo e($nrTopics); ?></h2>
				</div>
				<p class="mt-4">Themen</p>
			</div>
			
			<div class="border-0 card col-6 col-sm-3">
				<img src="/images/topic_back.jpeg" width="200" height="200" class=" card-img img-fluid rounded-circle" alt="Generic placeholder thumbnail">		
				<div class="card-img-overlay">
					<h2 class="card-text text-info"><?php echo e($nrContents); ?></h2>
				</div>
				<p class="mt-4">Inhalte</p>
			</div>
			
			<div class="border-0 card col-6 col-sm-3">
				<img src="/images/topic_back.jpeg" width="200" height="200" class=" card-img img-fluid rounded-circle" alt="Generic placeholder thumbnail">		
				<div class="card-img-overlay">
					<h2 class="card-text text-info"><?php echo e($nrUnits); ?></h2>
				</div>
				<p class="mt-4">Lerneinheiten</p>
			</div>
		</section>
		</div>


	<h4>Letzte gemeldete Fehler</h4>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Inhalt Titel (ID)</th>
						<th>Inhalt Typ</th>
						<th>Fehler Art</th>
						<th>Fehler Beschreibung</th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $mistakes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mistake): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						
						<td><small><?php echo e($mistake->content->content_title); ?> (<?php echo e($mistake->content_id); ?>)</small></td>
						<td><small><?php echo e($mistake->content->type->content_type); ?></small></td>
						<td><small><?php echo e($mistake->mistake_type); ?></small></td>
						<td><small><?php echo e($mistake->mistake_description); ?></small></td>
						
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</tbody>
            </table>
          </div>
        </main>
      </div>
    </div>
<?php $__env->stopSection(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/main.blade.php ENDPATH**/ ?>