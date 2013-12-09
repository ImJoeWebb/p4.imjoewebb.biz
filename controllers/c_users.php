<?php
class users_controller extends base_controller {

    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/

    public function __construct() {
        parent::__construct();
        
    } # End of __construct method

    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/

    public function index() {
        echo "This is the index page";

    } # End of index method

    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/

    public function signup($error = NULL) {
        # Setup view
            $this->template->content = View::instance('v_users_signup');
            $this->template->title   = "Sign Up";

        # Pass data to the view
            $this->template->content->error = $error;
        # Render template
            echo $this->template;

    } # End of signup method

    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/

    public function p_signup() {

        # Sanitize the user entered data to prevent SQL Injection Attacks
            $_POST = DB::instance(DB_NAME)->sanitize($_POST);
        #Check for blank fields
        foreach($_POST as $field => $input) {
            if (empty($input)) {
                Router::redirect('/users/signup/blankFields');
            }
        }
        if (DB::instance(DB_NAME)->select_field("SELECT email FROM users WHERE email ='".$_POST['email']."'") == $_POST['email']) {
            Router::redirect('/users/signup/emailExists');
        }

        # Dump out the results of POST to see what the form submitted
            $_POST['created'] = Time::now();
            $_POST['password'] =sha1(PASSWORD_SALT.$_POST['password']);
            $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

        # Store user data in database
            DB::instance(DB_NAME)->insert_row('users', $_POST); 
        # Redirect to the login page
            Router::redirect('/users/login');

    } # End of p_signup method

    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/

    public function login($error = NULL) {
        # Makes sure that you can't try logging in again when you are alread logged in
        if($this->user) {
                Router::redirect('/');
            }
        # Set up the view
            $this->template->content = View::instance('v_users_login');
        # Pass data to the view
            $this->template->content->error = $error;
        # Render the view
            echo $this->template;

    } # End of login method

    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/

    public function p_login() {

        # Sanitize the user entered data to prevent SQL Injection Attacks
            $_POST = DB::instance(DB_NAME)->sanitize($_POST);
        # Hash submitted password so we can compare it against one in the db
            $_POST['password'] =sha1(PASSWORD_SALT.$_POST['password']);

        # Search the db for this email and password
        # Retrieve the token if it's available
            $q =
                'SELECT token
                FROM users
                WHERE email = "'.$_POST['email'].'"
                AND password = "'.$_POST['password'].'"';

            $token = DB::instance(DB_NAME)->select_field($q);

        # If we didn't find a matching token in the databse, it means login failed
            if($token) {
                setcookie('token', $token, strtotime('+2 weeks'), '/');
                # Send them to the main page - or whever you want them to go
                Router::redirect("/");
            }
            else {
                # If we didn't find a matching token in the database, it means login failed
                Router::redirect("/users/login/error");
            }

    } # End of p_login method

    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/

    public function logout() {
        # Generate and save a new token for next login
            $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
        # Create the data array we'll use with the update method
        # In this case, we're only updating one field, so our array only has one entry
            $data = Array("token" => $new_token);                           
        # Do the update
            DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");
        # Delete their token cookie by setting it to a date in the past - effectively logging them out
            setcookie("token", "", strtotime('-1 year'), '/');
        # Send them back to the main index.
            Router::redirect("/");

    } # End of logout method

    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/

    public function profile($user_name = NULL) {
            if(!$this->user) {
                Router::redirect('/users/login');
            }
        /*
        If you look at _v_template you'll see it prints a $content variable in the <body>
        Knowing that, let's pass our v_users_profile.php view fragment to $content so 
        it's printed in the <body>
        */
            $this->template->content = View::instance('v_users_profile');
        # $title is another variable used in _v_template to set the <title> of the page
            $this->template->title = "Profile of  ".$this->user->first_name;
        # Pass information to the view fragment
            $this->template->content->user_name = $user_name;
        # Render View
            echo $this->template;

    } # End of profile method

    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/

} # end of the class