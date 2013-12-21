<?php
class posts_controller extends base_controller {
    
    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/
    
    public function __construct() {
        parent::__construct();
      
        # Make sure the user is logged in if they want to use anything in this controller  
            if(!$this->user) {
                die("Members only. <a href='/users/login'>Login</a>");
            }

    } # End of __construct method

    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/
    

    public function add($error = NULL) {
        
        # Setup view
            $this->template->content = View::instance('v_posts_add');
            $this->template->title   = "New Post";

        # Pass data to the view
            $this->template->content->error = $error;

        # Render template
            echo $this->template;

    } # End of add method

    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/

    public function p_add() {

        # Checks that the length of the post is not over 1000 characters
            if (strlen($_POST['content']) > 1000) {
                Router::redirect("/posts/add/tooLong");
            }
        
        # Checks that the length of the post is not blank
            if (strlen($_POST['content']) == 0) {
                Router::redirect("/posts/add/blank");
            }
        # Associate this post with this user
            $_POST['user_id'] = $this->user->user_id;

        # Unix timestamp of when this post was created / modified
            $_POST['created']  = Time::now();
            $_POST['modified'] = Time::now();

        # Insert
        # No need to sanitize $_POST data becasue the insert method does it already
            DB::instance(DB_NAME)->insert('posts', $_POST);

        # Send them back
            Router::redirect("/posts");

    } # End of p_add method

    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/

    public function index() {

        # Set up the view
            $this->template->content = View::instance('v_posts_index');
            $this->template->title   = "All Posts";

        # Build the query
            $q = 'SELECT 
                    posts.post_id,
                    posts.content,
                    posts.created,
                    posts.user_id AS post_user_id,
                    users.first_name,
                    users.last_name
                FROM posts
                INNER JOIN users 
                    ON posts.user_id = users.user_id
                WHERE users.user_id = '.$this->user->user_id;

        # Run the query
            $posts = DB::instance(DB_NAME)->select_rows($q);

        # Pass data to the View
            $this->template->content->posts = $posts;

        # Render the Vew
            echo $this->template;

    } # End of index method


    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/
    

    public function delete($post_id) {
        
        # Delete this post
            $where_condition = 'WHERE post_id = '.$post_id;
            DB::instance(DB_NAME)->delete('posts', $where_condition);

        # Send them back
            Router::redirect("/posts");

    } # End of edit method
   

    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/
    

    public function edit($post_id, $error = NULL) {
        
        # Setup view
            $this->template->content = View::instance('v_posts_edit');
            $this->template->title   = "Edit Post";

        # Build the query
            $q = 'SELECT 
                    post_id,
                    content
                FROM posts
                WHERE post_id = '.$post_id;

        # Run the query
            $edit = DB::instance(DB_NAME)->select_row($q);

        # Pass data (edit) to the view
        $this->template->content->edit = $edit;
        $this->template->content->error = $error;

        # Render template
            echo $this->template;

    } # End of edit method

    /*-------------------------------------------------------------------------------------------------

    -------------------------------------------------------------------------------------------------*/

        public function p_edit($post_id) {

        # Sanitize the user entered data to prevent SQL Injection Attacks
            $_POST = DB::instance(DB_NAME)->sanitize($_POST);  
        
        # Checks that the length of the post is not blank
            if (strlen($_POST['content']) == 0) {
                Router::redirect("/posts/add/blank");
            }
              
        # Checks that the length of the post is not over 1000 characters
            if (strlen($_POST['content']) > 1000) {
                Router::redirect("/posts/edit/" . $post_id . "/tooLong");
            }
        # Unix timestamp of when this post was modified
            $_POST['modified'] = Time::now();

        $where_condition = 'WHERE post_id ='.$post_id;
        # Insert
        # No need to sanitize $_POST data becasue the insert method does it already
            DB::instance(DB_NAME)->update_row('posts', $_POST, $where_condition);

        # Send them back
            Router::redirect("/posts");

    } # End of p_edit method

  

} # End of class