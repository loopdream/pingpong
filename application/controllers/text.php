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
		$user = $this->user->get_by_number($_GET['number']);
		if (!$user)
		{
			$this->user->register_user($_GET);
			$user = $this->user->get_by_number($_GET['number']);
		}

		$result = $this->queue->add_player($user);

		// add them to the queue
		echo '{ "message": "OK" }';
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */