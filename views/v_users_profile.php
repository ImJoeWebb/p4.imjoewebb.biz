<h1>This is the profile of <?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8')?></h1>


<form method='POST' action='/users/p_time'>
    <label for='content'>Select a time to recieve your email:</label><br>
    <input type="time" name="email_time" id='email_time'>
	<br><br>
	<input type='submit' value='Select Time'>

</form>
