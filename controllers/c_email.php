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

        # Render template
            echo $this->template;

    } # End of add method

    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/


} # End of class