
<?php if(isset($error) && $error == "tooLong"): ?>
    <div class='error')>
        Post must be less than 1000 characters.
    </div>
    <br>
<?php endif; ?>

<?php if(isset($error) && $error == "blank"): ?>
    <div class='error')>
        Post cannot be blank.
    </div>
    <br>
<?php endif; ?>

<form method='POST' action='/posts/p_edit/<?=$edit['post_id'] ?>'>

    <label for='content'>Edit Post:</label><br>
    <input name='content' id='content' value="<?php echo htmlspecialchars($edit['content'], ENT_QUOTES, 'UTF-8'); ?>" maxlength='1000'></textarea>

    <br><br>
    <input type='submit' value='Edit post'>

</form>
