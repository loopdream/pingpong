<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	function send_text($number, $message)
	{
		require_once APPPATH . "libraries/Services/Twilio.php";
		$AccountSid = "ACde7c9348d97a26eafd09fa5a269613be";
		$AuthToken = "699b86f2e3f8d581f47e9d3521067f13";

		$client = new Services_Twilio($AccountSid, $AuthToken);
		$sms = $client->account->sms_messages->create(
			"+442033222281", 
			$number,
			$message
		);
	}