<div class="dropdown">
			<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Inhalt für diese Aufgabe hinzufügen
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item btn btn-link" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="content1" href="#content1">Inhalt aus der Datenbank auswählen</a>
				<a class="dropdown-item btn btn-link" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="specialcontent_1" href="#specialcontent_1">Eigenen Text als Aufgabe formulieren</a>
				<a class="dropdown-item" href="/backend/contents/create">Neuen Inhalt zur Datenbank hinzufügen</a>
			</div>
		</div>
		<hr></hr>
		
		<div id="content1" class=" collapse form-group mb-3">
			<label>Inhalt aus der Datenbank auswählen</label>
			<select id="content_id1" name="content_id1" class="form-control">
				<option value="">Bitte auswählen</option>
				<?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($content->id); ?>"><?php echo e($content->type->content_type); ?>: <?php echo e($content->content_title); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>
		<div id="specialcontent_1" class="collapse form-group mb-3">
			<label>Eigenen Text als Inhalt hinzfügen</label>
			<textarea id="textarea_specialcontent1" name="specialcontent1" class="specialcontent-summernote"></textarea>
		</div>

<!-- Zweites Lernniveau -->
			<div class="dropdown">
				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Alternativen Inhalt für ein zweites Lernniveau hinzufügen
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item btn btn-link" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="content2" href="#content2">Inhalt aus der Datenbank auswählen</a>
					<a class="dropdown-item btn btn-link" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="specialcontent2" href="#specialcontent2">Eigenen Text als Aufgabe formulieren</a>
					<a class="dropdown-item" href="#">Neuen Inhalt zur Datenbank hinzufügen</a>
				</div>
			</div>
		</div>
	
		<div id="content2" class=" collapse form-group mb-3">
			<label>Inhalt aus der Datenbank auswählen</label>
			<select id="content_id2" name="content_id2" class="form-control">
				<option value="">Bitte auswählen</option>
				<?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($content->id); ?>"><?php echo e($content->type->content_type); ?>: <?php echo e($content->content_title); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>
		<div id="specialcontent2" class="collapse form-group mb-3">
			<label>Eigenen Text als Inhalt hinzfügen</label>
			<textarea id="specialcontent2" name="specialcontent2" class="specialcontent-summernote"></textarea>
		</div>
			
			<div class="dropdown">
				<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Alternativen Inhalt für ein drittes Lernniveau hinzufügen
				</button>
				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					<a class="dropdown-item btn btn-link" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="content3" href="#content3">Inhalt aus der Datenbank auswählen</a>
					<a class="dropdown-item btn btn-link" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="specialcontent3" href="#specialcontent3">Eigenen Text als Aufgabe formulieren</a>
					<a class="dropdown-item" href="#">Neuen Inhalt zur Datenbank hinzufügen</a>
				</div>
			</div>
		</div>

<!-- Drittes Lernniveau -->	
		<div id="content3" class=" collapse form-group mb-3">
			<label>Inhalt aus der Datenbank auswählen</label>
			<select id="content_id3" name="content_id3" class="form-control">
				<option value="">Bitte auswählen</option>
				<?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $content): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($content->id); ?>"><?php echo e($content->type->content_type); ?>: <?php echo e($content->content_title); ?></option>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</select>
		</div>	
		<div id="specialcontent3" class="collapse form-group mb-3">
			<label>Eigenen Text als Inhalt hinzfügen</label>
			<textarea id="specialcontent3" name="specialcontent3" class="specialcontent-summernote"></textarea>
		</div>
		</div><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/create_differentiation_raw.blade.php ENDPATH**/ ?>