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

		// is there a game in progress?
		$game = $this->game->get_current_game();
		if ($game)
		{
			echo '{ "status": "error", "message": "there is a game in progress" }';
			return;
		}

		list($p1, $p2) = $this->queue->get_next_players();
		if ($p1 && $p2)
		{
			$game = $this->game->create_game($p1, $p2);
			if ($game)
			{
				$this->queue->set_notified($p1);
				$this->queue->set_notified($p2);

				$this->load->helper('text');
				$message = "the table is ready, GET TO DA CHOPPA";
				send_text($p1->phone_number, $message);
				send_text($p2->phone_number, $message);
			}

			$this->load->helper('twitter');
			tweet_message("@{$p1->twitter_name} and @{$p2->twitter_name} just started playing");
		}
		else
			echo '{ "status": "error", "message": "there aren\'t enough players yet." }';
	}

	public function finish($p1score=0, $p2score=0)
	{
		$this->load->model('mgame', 'game');
		$game = $this->game->get_current_game();
		if (!$game)
		{
			echo '{ "status": "error", "message": "there are no games in progress" }';
			return;
		}

		$this->load->model('mqueue', 'queue');
		$this->load->model('muser', 'user');
		$p1 = $this->user->get_by_id($game->p1_id);
		$p2 = $this->user->get_by_id($game->p2_id);
		$queue = $this->queue->set_played($p1);
		$queue = $this->queue->set_played($p2);

		$this->load->helper('twitter');
		tweet_message("@{$p1->twitter_name} {$p1score} vs {$p2score} @{$p2->twitter_name} ... result. PAAADOOOOORUUUUUUU");

		$game = $this->game->finish_game($p1score, $p2score);
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