
<?php if(isset($error) && $error == "tooLong"): ?>
    <div class='error')>
        Post must be less than 1000 characters.
    </div>
    <br>
<?php endif; ?>

<form method='POST' action='/posts/p_add'>

	<label for='content'>New Post:</label><br>
	<textarea name='content' id='content' maxlength="1000"></textarea>

	<br><br>
	<input type='submit' value='New post'>

</form>
