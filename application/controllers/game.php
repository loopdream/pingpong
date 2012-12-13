<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Game extends CI_Controller
{
	public function index()
	{
		echo '{ "message": "OK" }';
	}

	public function start()
	{
		$this->load->model('mQueue', 'queue');
		$this->load->model('mGame', 'game');

		$p1 = $this->queue->get_next_player();
		$p2 = $this->queue->get_next_player();
		$game = $this->game->create_game($p1, $p2);

		echo '{ "message": "OK", "game_id": "5" }';
	}

	public function finish($id='')
	{
		$this->load->model('mgame', 'game');

		$game = $this->game->finish_game($id);
		echo '{ "message": "OK" }';
	}

	public function replay()
	{
		// you don't have to do anything lol
		echo '{ "message": "OK" }';
	}		
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */