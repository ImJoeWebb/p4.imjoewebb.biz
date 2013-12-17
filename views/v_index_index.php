<?php if($user): ?>
	<h1> Hello <?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8');?> </h1>
<?php else: ?>
	<h1>Welcome to the <?=APP_NAME?>. Please sign up or log in. </h1>
<?php endif; ?>
	<h2><?=APP_NAME?> sends you a daily email so that it is super easy to keep an online journal!
	</h2>