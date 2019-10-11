<?php if($paginator->hasPages()): ?>
    <ul class="pagination">
        
        <?php if($paginator->onFirstPage()): ?>
            <li class="page-item disabled"><span class="page-link"><?php echo app('translator')->get('pagination.previous'); ?></span></li>
        <?php else: ?>
            <li class="page-item"><a class="page-link" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev"><?php echo app('translator')->get('pagination.previous'); ?></a></li>
        <?php endif; ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <li class="page-item"><a class="page-link" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next"><?php echo app('translator')->get('pagination.next'); ?></a></li>
        <?php else: ?>
            <li class="page-item disabled"><span class="page-link"><?php echo app('translator')->get('pagination.next'); ?></span></li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
<?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/vendor/pagination/simple-bootstrap-4.blade.php ENDPATH**/ ?>