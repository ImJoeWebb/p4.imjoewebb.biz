

<h2>Sign Up</h2>

<?php if(isset($error) && $error == 'blankFields'): ?>
    <div class='error'>
        Signup Failed. Please fill out all fields.
    </div>

<?php endif; ?>

<?php if(isset($error) && $error == 'emailExists'): ?>
    <div class='error'>
        There is already an account associated with this email.
        <a href="/users/login">Login</a>
    </div>

<?php endif; ?>

<?php if(isset($error) && $error == 'emailWrong'): ?>
    <div class='error'>
        This is not a valid email address.
        <a href="/users/login">Login</a>
    </div>

<?php endif; ?>

<form id='signup_form' onsubmit="return validateForm();" method='POST' action='/users/p_signup'>

    First Name<br>
    <input type='text' name='first_name' id='first_name'>
    <br><br>

    Last Name<br>
    <input type='text' name='last_name' id='last_name'>
    <br><br>

    Email<br>
    <input type='text' name='email' id='email'>
    <br><br>

    Password<br>
    <input type='password' name='password' id='password'>
    <br><br>

    <input type='submit'>

</form>

<script>

    
    
</script>
