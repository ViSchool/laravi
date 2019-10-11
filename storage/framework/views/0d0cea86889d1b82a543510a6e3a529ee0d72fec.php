<?php $content = App\Content::find($id); ?>
<?php if(isset($content)): ?>
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
         <?php break; ?>
		<?php endswitch; ?>
	<?php endif; ?>	
	<div class="card-body">
		<a href="/content/<?php echo e($content->id); ?>"><h4 class="card-title"><?php echo e($content->content_title); ?></h4></a>						
	</div>
	<div class="card-footer">
      <small class="text-muted"><i class="<?php echo e($content->type->type_icon); ?> fa-2x"></i> <?php echo e($content->type->content_type); ?></small>
   </div>					
</div>
<?php endif; ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/teacher/teacher_components/chosenContentImage.blade.php ENDPATH**/ ?>