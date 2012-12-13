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
		$this->load->model('mUser', 'user');
		$this->load->model('mGame', 'game');

		$data['waiting_users'] = $this->queue->get_waiting_users();
		$data['game'] = $this->game->get_current_game();
		if ($data['game'])
		{
			$data['p1'] = $this->user->get_by_id($data['game']->p1_id);
			$data['p2'] = $this->user->get_by_id($data['game']->p2_id);
		}
		$this->load->view('test/all', $data);
	}

	public function clear_all()
	{
		$this->load->model('mQueue', 'queue');
		$this->load->model('mUser', 'user');
		$this->load->model('mGame', 'game');

		$this->queue->clear();
		$this->user->clear();
		$this->game->clear();
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */