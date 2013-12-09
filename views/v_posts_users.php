<?php foreach($users as $user): ?>

    <!-- Print this user's name -->
    <?php echo htmlspecialchars($user['first_name'], ENT_QUOTES, 'UTF-8')?> <?php echo htmlspecialchars($user['last_name'], ENT_QUOTES, 'UTF-8')?>

    <!-- If there exists a connection with this user, show a unfollow link -->
    <?php if(isset($connections[$user['user_id']])): ?>
        <a href='/posts/unfollow/<?=$user['user_id']?>'>Unfollow</a>

    <!-- Otherwise, show the follow link -->
    <?php else: ?>
        <a href='/posts/follow/<?=$user['user_id']?>'>Follow</a>
    <?php endif; ?>

    <br><br>

<?php endforeach; ?>
