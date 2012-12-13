<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Text extends CI_Controller
{
	public function index()
	{
		echo '{ "message": "OK" }';
	}

	public function receive()
	{
		$this->load->model('mQueue', 'queue');
		$this->load->model('mUser', 'user');

		// get the user
		$user = $this->user->get_by_number($_REQUEST['From']);
		if (!$user)
		{
			$this->user->register_user($_REQUEST);
			$user = $this->user->get_by_number($_REQUEST['From']);
		}

		$result = $this->queue->add_player($user);

	    header("content-type: text/xml");
	    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
		echo "<Response>";
		echo "<Sms>you are in the queue babe x x x x</Sms>";
		echo "</Response>";
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */