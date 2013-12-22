<img src="/images/notebook.jpg" alt="an open diary">
<?php if($user): ?>
	<h1> Hello <?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8');?> </h1>
<?php else: ?>
	<h1>Welcome to the <?=APP_NAME?>.</h1>
<?php endif; ?>
	<h2>Sometimes it is hard to keep up with a journal, no matter how much you try. We send you a daily email reminder so that it is super easy to keep writing!
	</h2>