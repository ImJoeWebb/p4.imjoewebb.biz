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
        
        # Build the query
            $q = 'SELECT 
                    user_id,
                    first_name,
                    last_name,
                    email,
                    email_time
                FROM users';

        # Run the query
            $posts = DB::instance(DB_NAME)->select_rows($q);
        
            $current_time = Time::now();
        
        foreach ($posts as $post) {
            if (Time::display($current_time, 'H') == $post['email_time']) {
                echo "yes";
            
        
            # Build a multi-dimension array of recipients of this email
            $to[] = Array("name" => $post['first_name'] +  " " + $post['last_name'], "email" => $post['email']);
            
            # Build a single-dimension array of who this email is coming from
            # note it's using the constants we set in the configuration above)
            $from = Array("name" => APP_NAME, "email" => APP_EMAIL);
            
            # Subject
            $subject = "Daily Diary";
            
            # You can set the body as just a string of text
            # $body = "This is a reminder to fill in your diary entry for today";
            
            # OR, if your email is complex and involves HTML/CSS, you can build the body via a View just like we do in our controllers
            $body = View::instance('e_daily_email');
            
            # Build multi-dimension arrays of name / email pairs for cc / bcc if you want to 
            $cc  = "";
            $bcc = "";
            
            # With everything set, send the email
            $email = Email::send($to, $from, $subject, $body, true, $cc, $bcc);
            }
        }
        # Render template
            echo $this->template;

    } # End of add method

    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/
   
} # End of class