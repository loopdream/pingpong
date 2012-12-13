<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Queue extends CI_Controller
{
	public function index()
	{
		echo '{ "message": "OK" }';
	}

	public function waiting()
	{
		$this->load->model('mQueue', 'queue');

		$waiting_users = $this->queue->get_waiting_users();
		header('Content-type: application/json');
		echo json_encode($waiting_users);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */