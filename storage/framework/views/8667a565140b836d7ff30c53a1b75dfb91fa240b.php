<?php $__env->startSection('main'); ?>

<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h4>Neue Serie anlegen</h4>

<div class="container">	
	<?php echo $__env->make('layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<form method="POST" action="/backend/series">
		<?php echo e(csrf_field()); ?>

		<div class="form-group">
			<label for="subject_title">Titel der Serie:</label>
			<input type="text" class="form-control" id="serie_title" name="serie_title" value="<?php echo e(old('serie_title')); ?>">
		</div>
		
		<div class="form-group<?php echo e($errors->has('serie_description') ? ' invalid' : ''); ?>">
         <label for="task" class="col-10 col-form-label mb-0 pb-0">Beschreibung der Serie</label>
         <label for="task" class="col-10 col-form-label mt-0 pt-0">
				<small class="text-muted"> Hier kannst Du beschreiben, welche Inhalte in der Serie enthalten sind.</small>
			</label>
			<div class="border">
				<textarea id="serie_description" rows="3" class="form-control" name="serie_description" ><?php echo e(old('serie_description')); ?></textarea>
         	<?php if($errors->has('serie_description')): ?>
            <span class="help-block">
               <strong><?php echo e($errors->first('serie_description')); ?></strong>
            </span>
				<?php endif; ?>
			</div>
		</div>
			
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Serie anlegen</button>
		</div>
	</form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<script src="<?php echo e(asset('js/editor.js')); ?>"></script>	

<script>
    $(document).ready(function() {
        $("#serie_description").Editor(
            {
                'fonts': false,
                'styles': false,
                'l_align': false,
                'r_align':false,
                'c_align':false,
                'justify':false, 
                'insert-img':false,
                'insert_table':false,
                'print':false, 
                'select_all':false,
                'indent':false,
                'outdent':false,
                'undo':false,
                'redo':false,
                'source':false,
                'font_size':false,
                'color': false,
                'block_quote':false,
                'ol':false,
                'ul':false,
                'hr_line':false,
                'rm_format':false,
                'togglescreen':false,
            }
        );
    }); 
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/backend/create_series.blade.php ENDPATH**/ ?>