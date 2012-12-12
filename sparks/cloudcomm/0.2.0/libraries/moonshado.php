<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Moonshado {
	private $api_key = null;
	private $originating_address = null;
	private $base = null;
	public $ci = null;
	
	public function __construct() {
		$this->ci =& get_instance();
		$this->api_key = $this->ci->config->item('moonshado_key');
		$this->originating_address = $this->ci->config->item('moonshado_number');
		$this->base = $this->ci->config->item('moonshado_base');
	}
	
	public function sms($to, $body) {
		$payload = array(	'message[device_address]' =>	$to,
							'message[body]' =>				$body
							);
		return $this->send('gateway/sms', $payload);
	}	

	private function send($endpoint, $payload) {
		// Set data
		$payload['message[originating_address]'] = $this->originating_address;
		$payload['api_key'] = $this->api_key;

		// Send
		$ch = curl_init($this->base . $endpoint);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$results = curl_exec($ch);
		curl_close($ch);
		
		return $results;
	}
	
}