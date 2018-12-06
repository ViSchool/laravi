		
<?php $__env->startSection('page-header'); ?>
<div class="d-flex container-fluid justify-content-between" style="background-image:linear-gradient(to left, hsla(190,97%,47%,0)20%,hsl(190,97%,47%)50%);">
	<div class="row">
  		<div class="col-8 px-5">
			<h2 class="display-4 text-white my-3">Digitaler Unterricht</h2>
			<p class="lead text-white">Ohne Vorkenntnisse  fertige Unterrichtseinheiten aus analogen und digitalen Elementen nutzen oder selbst zusammenstellen</p>
		</div>
		<div class="col p-0 m-0">
			<img class="d-none d-sm-block img-fluid p-0 m-0" src="/images/header_foto_teacher.jpg"></img>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
		
<?php $__env->startSection('content'); ?>
<div class="container my-5">
	<div class="row mb-3">
		<div class="col">
			<div class="card">
				<div class="card-header bg-brandyellow text-dark text-center">Toolbox</div>
				<div class="card-body bg-info text-white">
	      			<h3 class="card-title">Selbst Unterrichtseinheiten erstellen</h3>
	      			<p class="card-text">Hier kannst Du ohne Vorkenntnisse Unterrichtseinheiten aus digitalen und analogen Elemenenten zusammenstellen</p>
				</div>
				<div class="card-footer bg-warning text-center">
					<!-- Button to Open the Modal -->
					<?php if(Auth::check()): ?> 
					<button type="button" class="badge bg-light text-dark" data-toggle="modal" data-target="#unit_dialog">Eigene Unterrichtseinheit erstellen
					</button>
					
					<?php else: ?> 
					<button type="button" class="badge bg-light text-dark" data-toggle="modal" data-target="#loginfirst_dialog">Eigene Unterrichtseinheit erstellen
					</button>
					
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="row mb-3">
		<div class="col">
	 		<div class="card">
				<div class="card-header border-success">Tools</div>	
				<div class="card-body">
	      			<h5 class="card-title">Card title</h5>
	      			<p class="card-text">Hier kannst Du verschiedene Tools finden, die Du benutzen kannst, um Deinen Unterricht digitaler zu gestalten</p>
				</div>
				<div class="card-footer border-success">x Tools</div>
			</div>
		</div>
		<div class="col">
			<div class="card">
				<div class="card-header border-success">Unterrichtseinheiten</div>	
				<div class="card-body">
	      			<h5 class="card-title">Fertige Unterrichtseinheiten</h5>
	      			<p class="card-text">Hier kannst Du fertige Unterrichtseinheiten finden, die Du sofort einsetzen kannst</p>
				</div>
				<div class="card-footer border-success">x Unterrichtseinheiten</div>
			</div>

		</div>
	</div>
	
	<div class="row mb-3">
		<div class="col">	
			<div class="card">
				<div class="card-header border-success">Blog</div>	
				<div class="card-body">
	      			<h5 class="card-title">Card title</h5>
	      			<p class="card-text">Hier kannst Du unseren Blog lesen</p>
				</div>
				<div class="card-footer border-success">x Beiträge</div>
			</div>
		</div>
		<div class="col">	
		</div>
	</div>
</div>
		
		

		<!-- The Modal Unit_dialog -->
		<div class="modal fade" tabindex="-1" role="dialog" id="unit_dialog">
  			<div class="modal-dialog modal-dialog-centered" role="document">
    			<div class="modal-content">
					<form method="POST" action="<?php echo e(route('unit.store')); ?>" enctype="multipart/form-data">
					<?php echo e(csrf_field()); ?> 
							
      				<!-- Modal Header -->
      					<div class="modal-header">
        						<h4 class="modal-title">Unterrichtseinheit erstellen</h4>
        						<button type="button" class="close" data-dismiss="modal">&times;</button>
      					</div>

      				<!-- Modal body -->
      					<div class="modal-body">
        						<div class="form-group mt-3">
								<label style="color:white; font-size:1.25rem;" for="subject_id">Fach auswählen:</label>
								<select class="form-control form-control-lg" id="subject_id" name="subject_id">
									<option value=""></option>
									<?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
									<option value="<?php echo e($subject->id); ?>"><?php echo e($subject->subject_title); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</select>
					
								<label style="color:white; font-size:1.25rem;" for="topic_id">Thema auswählen:</label>
								<select class="form-control form-control-lg" id="topic_id" name="topic_id">
									<option>Zuerst Fach auswählen</option>
								</select>
								<div class="col-md-2">
									<span id="loader" style="visibility: hidden;">
									<i class="far fa-spinner fa-spin"></i>
									</span>
								</div>

								<label style="color:white; font-size:1.25rem;" for="unit_title">Titel der Unterichtseinheit:</label>
								<input type="text" class="form-control" id="unit_title" name="unit_title" aria-label="unit_title" aria-describedby="title"/>	
								<label style="color:white; font-size:1.25rem;" for="unit_description">Lernziel/Beschreibung der Unterichtseinheit:</label>	
								<textarea class="form-control" id="unit_description" name="unit_description" aria-label="unit_description" aria-describedby="unit_description"></textarea>
							</div>
						</div>
						<!-- Modal footer -->
						<div class="modal-footer">
    						<button type="button" class="badge border-warning bg-warning p-2 my-3" data-dismiss="modal">Abrechen</button>
							<button class="badge border-primary bg-primary p-2 my-3" type="submit">Lerneinheit anlegen</button>
						</div>
					</form>
      			</div>
      		</div>
		</div>
		
		<!-- The Modal loginfirst_dialog -->
		<div class="modal fade" tabindex="-1" role="dialog" id="loginfirst_dialog">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">			
      				<!-- Modal Header -->
      					<div class="modal-header">
        						<h4 class="modal-title">Bitte logge Dich erst ein </h4>
        						<button type="button" class="close" data-dismiss="modal">&times;</button>
      					</div>

      				<!-- Modal body -->
      					<div class="modal-body">
      						<div class="panel panel-default">
                					<div class="panel-heading">Login</div>
									<div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
						<div class="modal-footer">
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="badge bg-primary">Login</button>
                                <button type="button" class="badge border-warning bg-warning p-2 my-3" data-dismiss="modal">Abrechen</button>

                                <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
						</div>
						</div>
					</form>
      			</div>
      		</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('js/ddd_subject_topic.js')); ?>"></script>
		
<?php $__env->stopSection(); ?>	
		

<?php echo $__env->make('layout_teacher', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>