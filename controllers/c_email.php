<?php
class email_controller extends base_controller {
    
    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/
    
    public function __construct() {
        parent::__construct();
      
        # Make sure the user is logged in if they want to use anything in this controller  
        #    if(!$this->user) {
        #        die("Members only. <a href='/users/login'>Login</a>");
        #    }

    } # End of __construct method

    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/
    

    public function email() {
        
        # Setup view
            $this->template->content = View::instance('v_email_email');
            $this->template->title   = "Send Email";
        
            # Build a multi-dimension array of recipients of this email
            $to[] = Array("name" => "Judy Grimes", "email" => "imjoewebb@gmail.com");
            
            # Build a single-dimension array of who this email is coming from
            # note it's using the constants we set in the configuration above)
            $from = Array("name" => APP_NAME, "email" => APP_EMAIL);
            
            # Subject
            $subject = "Test email";
            
            # You can set the body as just a string of text
            $body = "This is an email from your web app";
            
            # OR, if your email is complex and involves HTML/CSS, you can build the body via a View just like we do in our controllers
            # $body = View::instance('e_users_welcome');
            
            # Build multi-dimension arrays of name / email pairs for cc / bcc if you want to 
            $cc  = "";
            $bcc = "";
            
            # With everything set, send the email
            $email = Email::send($to, $from, $subject, $body, true, $cc, $bcc);

        # Render template
            echo $this->template;

    } # End of add method

    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/
    public function p_time() {

        # Checks that the length of the post is not over 1000 characters
            if (strlen($_POST['content']) > 1000) {
                Router::redirect("/posts/add/tooLong");
            }
        # Associate this post with this user
            $_POST['user_id'] = $this->user->user_id;

        # Unix timestamp of when this post was created / modified
            $_POST['created']  = Time::now();
            $_POST['modified'] = Time::now();

        # Insert
        # No need to sanitize $_POST data because the insert method does it already
            DB::instance(DB_NAME)->insert('email', $_POST);

        # Send them back
            Router::redirect("/profile");

    } # End of p_add method


    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/

} # End of class