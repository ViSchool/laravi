<?php if(Auth::guard('web')->check()): ?>
	<p class="text-success">You are logged in as a User</p>
<?php else: ?>
	<p class="text-danger">You are logged out as a User</p>
<?php endif; ?>

<?php if(Auth::guard('admin')->check()): ?>
	<p class="text-success">You are logged in as a Admin</p>
<?php else: ?>
	<p class="text-danger">You are logged out as a Admin</p>
<?php endif; ?><?php /**PATH /Users/katmac/Sites/vischool/laravi/resources/views/components/who.blade.php ENDPATH**/ ?>