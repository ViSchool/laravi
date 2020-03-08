<div class="modal fade" id="newInstantContentModal" tabindex="-1" role="dialog" aria-labelledby="newContentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="newInstantContentForm" method="POST" action="/lehrer/inhalte" enctype="multipart/form-data">
                <?php echo csrf_field(); ?> 
                    <div class="modal-header">
                        <h5 class="modal-title" id="newInstantContentModalLabel">Einen neuen Inhalt erstellen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">    
                        
                        <input type="hidden" value="<?php echo e($teacher->id); ?>" name="user_id">
                        <input type="hidden" value="<?php echo e($subject_id); ?>" name="subject_id">
                        <input type="hidden" value="<?php echo e($topic_id); ?>" name="topic_id">
                        <input type="hidden" value="instant" name="instant">
                        <input type="hidden" value="<?php echo e($block_id); ?>" name="block_id">

                        
                        <input type="hidden" 
                            <?php if($teacher->teacher_id == $teacher->id): ?>
                                value="teacher" 
                            <?php else: ?> 
                                value="student"
                            <?php endif; ?>
                        name="teacherOrStudent">


                        <div class="form-group<?php echo e($errors->has('content_title') ? ' invalid' : ''); ?>">
                            <label for="content_title" class="col-10 col-form-label">Name des Inhalts</label>
                             <div class="col-10">
                             <input id="new_content_title" type="text" class="form-control" name="content_title" value="<?php echo e(old('content_title')); ?>" >
                                <?php if($errors->has('content_title')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('content_title')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('tool_id') ? ' invalid' : ''); ?>">
                            <label for="content_provider" class="col-10 col-form-label">Der Inhalt stammt von folgendem Anbieter:</label>
                            <div class="col-10">
                                <select class="form-control" id="tool_id" name="tool_id">
				                    <?php if((old('tool_id')) !== null): ?>
                                        <?php 
                                            $tool_id_old = old('tool_id');
                                            $tool_old = App\Tool::where('id', '=' , $tool_id_old)->first();
                                        ?>
                                        <option value="<?php echo e($tool_id_old); ?>"><?php echo e($tool_old->tool_title); ?></option>
				                    <?php endif; ?>
				                    <?php if(empty(old('tool_id'))): ?>
					                    <option value=""></option>
				                    <?php endif; ?>
				                    <?php $__currentLoopData = $tools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
					                    <option value="<?php echo e($tool->id); ?>"><?php echo e($tool->tool_title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>    
                        </div>

                        <div class="form-group<?php echo e($errors->has('content_link') ? ' invalid' : ''); ?>">
                            <label for="content_link" class="col-10 col-form-label">Link zum Inhalt</label>
                            <br>
                            <small id="examplelink" class="text-muted col-10">Beispiellink</small>
                             <div class="col-11">
                                <input id="content_link" type="text" class="form-control" name="content_link" value="<?php echo e(old('content_link')); ?>" placeholder=""">
                                <?php if($errors->has('content_link')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('content_link')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                        <button type="submit" form="newInstantContentForm" class="btn btn-primary">Inhalt speichern</button>
                    </div>
                </form>
            </div>
        </div>
    </div><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/teacher/teacher_components/newInstantContentModal.blade.php ENDPATH**/ ?>