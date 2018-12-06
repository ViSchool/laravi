<?php $__env->startSection('main'); ?>

    <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
          <h4>Neue Serie mit Unterrichtseinheiten anlegen</h4>

<div class="container">	
	<?php echo $__env->make('layouts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<form method="POST" action="/backend/series">
		<?php echo e(csrf_field()); ?>

		<div class="form-group">
			<label for="subject_title">Titel der Serie:</label>
			<input type="text" class="form-control" id="serie_title" name="serie_title" value="<?php echo e(old('serie_title')); ?>">
		</div>
		<div class="form-group">
			<label for="public">Sichtbarkeit der Serie:</label>
			<select id="public" name="public">
				<option value="1">Frontend und Backend</option>
				<option value="0">nur Backend</option>
			</select>
		</div>	
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Serie anlegen</button>
		</div>
	</form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.layout_backend', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>