<?php foreach($posts as $post): ?>

	<article>

		<h1><?php echo htmlspecialchars($post['first_name'], ENT_QUOTES, 'UTF-8')?> <?php echo htmlspecialchars($post['last_name'], ENT_QUOTES, 'UTF-8')?> posted:</h1>
		<p><?php echo nl2br(htmlspecialchars($post['content'], ENT_QUOTES, 'UTF-8'))?></p>

		<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
			<?=Time::display($post['created'])?>
		</time>
		<?php if($user->user_id == $post['post_user_id']): ?>
   			<a href='/posts/delete/<?=$post['post_id']?>'>Delete</a>
   		<?php endif; ?>
   		<?php if($user->user_id == $post['post_user_id']): ?>
		   <a href='/posts/edit/<?=$post['post_id']?>'>Edit</a>
		<?php endif; ?>
	</article>

	<?php endforeach; ?>

