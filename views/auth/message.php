<?php if ($session->has('error')): ?>
	<div class="alert alert-danger" role="alert">
		<?= $session->getFlash('error'); ?>
	</div>
<?php endif; ?>

