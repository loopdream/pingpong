<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function tweet_message($message='')
	{
		if (!$message) return false;

        require_once APPPATH.'libraries/tmhTwitter/tmhOAuth.php';
        require_once APPPATH.'libraries/tmhTwitter/tmhUtilities.php';

		$CI =& get_instance();
        $CI->load->config('tmhTwitter');

		$tmhOAuth = new tmhOAuth(array(
			'consumer_key'    =>  $CI->config->item('twitter_consumer_token'), 
			'consumer_secret' =>  $CI->config->item('twitter_consumer_secret'), 
			'user_token'      =>  $CI->config->item('twitter_access_token'),
			'user_secret'     =>  $CI->config->item('twitter_access_secret')
		));
		$message .= "#" . mktime() . " #rgamakeday";
		$code = $tmhOAuth->request('POST', $tmhOAuth->url('1/statuses/update'), array(
		  'status' => $message
		));
	}
