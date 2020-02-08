<div class="modal fade" id="editContentModal" tabindex="-1" role="dialog" aria-labelledby="newContentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="/lehrer/inhalte/<?php echo e($content->id); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                                
                <div class="modal-header">
                    <h5 class="modal-title" id="editContentModalLabel">Inhalt bearbeiten</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>                        </button>
                </div>
                
                <div class="modal-body">        
                    <input type="hidden" value="<?php echo e($teacher->id); ?>" name="user_id">
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
                         <input id="content_title" type="text" class="form-control" name="content_title" value="<?php echo e($content->content_title); ?>" required>
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
                                <option value="<?php echo e($content->tool->id); ?>"><?php echo e($content->tool->tool_title); ?></option>
				                <?php $__currentLoopData = $tools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
					                <option value="<?php echo e($tool->id); ?>"><?php echo e($tool->tool_title); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>    
                    </div>

                    <div class="form-group<?php echo e($errors->has('content_link') ? ' invalid' : ''); ?>">
                        <label for="content_link" class="col-10 col-form-label">Link zum Inhalt</label>
                        <br>
                        <div class="col-11">
                            <input id="content_link" type="text" class="form-control" name="content_link" value="<?php echo e($content->content_link); ?>" placeholder="" required>
                            <?php if($errors->has('content_link')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('content_link')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>


                    <div class="form-group<?php echo e($errors->has('subject_id') ? ' invalid' : ''); ?>">
                        <label for="subject_id" class="col-10 col-form-label">Der Inhalt gehört zu folgendem Fach</label>
                        <div class="col-10">
                            <select class="form-control" id="subject_id" name="subject_id">
                                <option value="<?php echo e($content->subject->id); ?>"><?php echo e($content->subject->subject_title); ?></option>
				                <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subject): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>	
					                <option value="<?php echo e($subject->id); ?>"><?php echo e($subject->subject_title); ?></option>
				                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php if($errors->has('subject_id')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('subject_id')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group<?php echo e($errors->has('topic_id') ? ' invalid' : ''); ?>">
                        <label for="topic_id" class="col-10 col-form-label">Der Inhalt gehört zu folgendem Thema</label>
                        <div class="col-10">
                            <select class="form-control" id="topic_id" name="topic_id">
                                <option value="<?php echo e($content->topic->id); ?>"><?php echo e($content->topic->topic_title); ?></option>
                            </select>
			                <div class="col-md-2">
				                <span id="loader" style="visibility: hidden;">
					                <i class="far fa-spinner fa-spin"></i>
				                </span>
			                </div>
                            <?php if($errors->has('topic_id')): ?>
                                <span class="help-block">
                                    <strong><?php echo e($errors->first('topic_id')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>         
                </div>    
                    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Abbrechen</button>
                    <button type="submit" class="btn btn-primary">Inhalt speichern</button>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/teacher/teacher_components/editContentModal.blade.php ENDPATH**/ ?>