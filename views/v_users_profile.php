<h1>This is the profile of <?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8')?></h1>

<?php if(isset($error) && $error == "notValid"): ?>
    <div class='error')>
        Please enter a valid hour.
    </div>
    <br>
<?php endif; ?>

<form method='POST' action='/users/p_profile'>
    <label for='content'>Select a time to recieve your email:</label><br>
    <input type="number" name="email_time" id='email_time' max="23" min="0">
	<br><br>
	<input type='submit' value='Select Time'>

</form>
