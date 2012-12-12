<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * twitter.php
 *
 * The twitter controller
 *
 * @author Simon Emms <simon@simonemms.com>
 */
class twitter_test extends CI_Controller {
    
    
    
    
    /**
     * Construct
     * 
     * Set up the Twitter library
     */
    public function __construct() {
        
        parent::__construct();
        
        /* Load the Twitter library */
        $this->load->library('twitter');
        
        /* Set it to show errors */
        //$this->twitter->debug();
        
    }
    




    /**
     * Auth
     * 
     * Authorizes the Twitter login.
     * 
     * Ordinarily, much of this would be done
     * in a view file, but this is just a demo
     *
     * @author Simon Emms <simon@simonemms.com>
     */
    public function index() {
        
        /* Check we're logged in */
        if($this->twitter->is_logged_in()) {
            /* We are */
            
            /* Show my timeline */
            $arrTwitter = $this->twitter->fetch_home_timeline();
            
            /* Show my mentions */
            //$arrTwitter = $this->twitter->fetch_mentions();
            
            /* Show public timeline */
            //$arrTwitter = $this->twitter->fetch_public_timeline();
            
            /* Show my retweets */
            //$arrTwitter = $this->twitter->fetch_retweeted_by_me();
            
            /* Show my timeline's retweets */
            //$arrTwitter = $this->twitter->fetch_retweeted_to_me();
            
            /* Show my tweets retweeted */
            //$arrTwitter = $this->twitter->fetch_retweets_of_me();
            
            /* Show the given user's timeline */
            //$arrTwitter = $this->twitter->fetch_user_timeline(null, 'riggerthegeek');
            
            /* Parse the text to add */
            $arrTwitter = $this->twitter->parse_tweet($arrTwitter);
            
            $tweets = '';
            if(count($arrTwitter) > 0) {
                foreach($arrTwitter as $twitter) {
                    $tweets .= '<b>'.$this->twitter->parse_username($twitter['user']['screen_name'], null, true).'</b><br />';
                    $tweets .= $twitter['parsed_text'].'<br /><hr />';
                }
            }
            
            echo $tweets;exit;
            
        } else {
            /* We're not - display login */
            echo '<a href="'.site_url('twitter_test/login').'">
                <img src="https://dev.twitter.com/sites/default/files/images_documentation/sign-in-with-twitter_0.png" alt="Login with Twitter" />
            </a>';
        }

    }
    
    
    
    
    
    
    /**
     * Login
     * 
     * Manage the site login
     */
    public function login() {
        /* Are we logged in */
        if($this->twitter->is_logged_in()) {
            /* Yes - back to homepage */
            redirect(site_url('twitter_test'));
        } else {
            /* No - login */
            $this->twitter->login();
        }
    }
    
    
    
    
    
    
    
    /**
     * Logout
     * 
     * Logout and redirect to home
     * 
     * @author Simon Emms <simon@simonemms.com> 
     */
    public function logout() {
        
        $this->twitter->logout();
        
        redirect('twitter_test');
        
    }

}
?>