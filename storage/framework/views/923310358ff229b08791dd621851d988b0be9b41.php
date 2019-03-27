<div class="card m-3" style="width:200px">  
	<?php if(isset($content->content_img_thumb)): ?>
			<a href="/content/<?php echo e($content->id); ?>"><img class="card-img-top" src="/images/contents/<?php echo e($content->content_img); ?>" alt="Bild:<?php echo e($content->content_title); ?>"></img></a>
	<?php endif; ?>
	<?php if(empty($content->content_img_thumb)): ?> 
			<?php switch($content->tool_id):
				case (1): ?>
					<a href="/content/<?php echo e($content->id); ?>"><img class="card-img-top" src="https://img.youtube.com/vi/<?php echo e($content->toolspecific_id); ?>/mqdefault.jpg"></img></a>
				<?php break; ?>
				<?php case (7): ?>
					<a href="/content/<?php echo e($content->id); ?>"><img class="card-img-top" src="<?php echo e($content->img_thumb_url); ?>"></img></a>
				<?php break; ?>
				<?php default: ?>
					<?php if(isset($content->portal->portal_img)): ?>
					    <a href="/content/<?php echo e($content->id); ?>"><img class="card-img-top" src="/images/portals/<?php echo e($content->portal->portal_img); ?>"></img></a>
					<?php endif; ?>
			<?php endswitch; ?>
	<?php endif; ?>	
	<div class="card-body">
			<a href="/content/<?php echo e($content->id); ?>"><h4 class="card-title"><?php echo e($content->content_title); ?></h4></a>
			<p class="card-text">
                <?php 
                    $reviews = App\Review::where('content_id',$content->id)->get();
                    $average_score = $reviews->avg('overall_score');
                ?>
                <!-- Sternchenbewertung auf Inhalte-Card -->
                <?php if($average_score > 0): ?>
                    <?php $rating = $average_score ?>  
                    <?php $__currentLoopData = range(1,5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="fa-stack" style="width:1em" data-toggle="tooltip" data-placement="top" title="Durchschnittliche Bewertung">
                            <i class="far fa-star fa-stack-1x"></i>
                            <?php if($rating >0): ?>
                                <?php if($rating >0.5): ?>
                                    <i class="fas fa-star fa-stack-1x"></i>
                                <?php else: ?>
                                    <i class="fas fa-star-half fa-stack-1x"></i>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php $rating--; ?>
                        </span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </p>
    </div>
    <div class="card-footer d-flex justify-content-between">
            <small class="text-muted">
                <i class="<?php echo e($content->type->type_icon); ?> "></i><?php echo e($content->type->content_type); ?>

            </small>
    </div>
</div>