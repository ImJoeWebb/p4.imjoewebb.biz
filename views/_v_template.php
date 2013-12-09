<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<link rel="stylesheet" type="text/css" href="/css/stylesheet.css">				
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>

<body>	
    

    <div id='menu'>
        <h1 id="appname">
            Daily Diary
        </h1>
        <a class="nav" id="home" href='/'>Home</a>

        <!-- Menu for users who are logged in -->
        <?php if($user): ?>

            <a class="nav" id="logout"  href='/users/logout'>Logout</a>
            <a class="nav" id="profile" href='/users/profile'>Profile</a>
            <a class="nav" id="posts"   href='/posts'>View Posts</a>
            <a class="nav" id="follow"  href='/posts/users'>Follow</a>
            <a class="nav" id="new"     href='/posts/add'>Make a post</a>

        <!-- Menu options for users who are not logged in -->
        <?php else: ?>

            <a class="nav" id="signup"  href='/users/signup'>Sign up</a>
            <a class="nav" id="login"   href='/users/login'>Log in</a>

        <?php endif; ?>

    
  </div>
    <br>

	<?php if(isset($content)) echo $content; ?>

	<?php if(isset($client_files_body)) echo $client_files_body; ?>
</body>
</html>