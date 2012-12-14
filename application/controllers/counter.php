<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Counter extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model('mQueue', 'queue');
		$this->load->model('mUser', 'user');
		$this->load->model('mGame', 'game');

		$data['waiting'] = false;
		$data['game'] = $this->game->get_current_game();
		if ($data['game'])
		{
			$data['p1'] = $this->user->get_by_id($data['game']->p1_id);
			$data['p2'] = $this->user->get_by_id($data['game']->p2_id);
		}
		else
		{
			$data['waiting'] = true;
			$data['game'] = $this->game->get_recently_finished_game();
			$data['p1'] = $this->user->get_by_id($data['game']->p1_id);
			$data['p2'] = $this->user->get_by_id($data['game']->p2_id);			
		}

		$this->load->view('counter', $data);
	}
}
 