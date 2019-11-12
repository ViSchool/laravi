<nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
	<ul class="nav nav-pills flex-column">
		<li class="nav-item">
			<a class="nav-link" href="/backend">Übersicht <span class="sr-only"></span></a>
		</li>
	</ul>

	<ul class="nav nav-pills flex-column">
		<li class="nav-item">
			<?php
				 $status = App\Status::find(2);
				 $nrApprovals= count($status->contents) + count($status->units) + count($status->topics) + count($status->series);
			?>
			<a class="nav-link" href="/backend/freigaben">Freigaben <?php if($nrApprovals > 0): ?> <sup class="badge badge-pill badge-danger"><?php echo e($nrApprovals); ?></sup> <?php endif; ?></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/backend/subjects">Fächer</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/backend/topics">Themen</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/backend/contents">Inhalte</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/backend/units">Lerneinheiten</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/backend/series">Serien</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/backend/portals">Lernportale</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="/backend/tools">Tool-Datenbank</a>
		</li>
		<li class="nav-item">
				<a class="nav-link" href="/backend/tags">Tags</a>
		</li>
		<li class="nav-item">
				<a class="nav-link" href="/backend/schools">Schulen</a>
		</li>
		<li class="nav-item">
				<a class="nav-link" href="/backend/teacher">Lehrer</a>
		</li>
		<li class="nav-item">
				<a class="nav-link" href="/backend/faq">FAQs</a>
		</li>
	</ul>
				
	<ul class="nav nav-pills flex-column">
		
		
		<li class="nav-item">
			<a class="nav-link" href="/backend/blog"><i class="far fa-edit"></i> Blog</a>
		</li>
		
		<li class="nav-item">
			 <a class="nav-link" href="<?php echo e(route('admin.logout')); ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
  		</li>
  		<li class="nav-item">
			 <a class="nav-link" href="<?php echo e(route('vischool')); ?>"><i class="fas fa-home"></i> ViSchool</a>
  		</li>
	</ul>
</nav>
<?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/sidebar.blade.php ENDPATH**/ ?>