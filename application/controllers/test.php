<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller
{
	public function index()
	{
		echo '{ "message": "OK" }';
	}

	public function all()
	{
		$this->load->model('mQueue', 'queue');
		$data['waiting_users'] = $this->queue->get_waiting_users();
		
		$this->load->view('test/all', $data);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */