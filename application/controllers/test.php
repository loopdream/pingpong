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

		$this->db->query("
			INSERT INTO `users` (`id`, `twitter_name`, `twitter_avatar`, `phone_number`) VALUES
			(83, 'amorini', 'http://a0.twimg.com/profile_images/1434098433/RGA2011_Square_normal.jpg', '+447729112804'),
			(84, 'surdeco', 'http://a0.twimg.com/profile_images/1338301336/andre_normal.png', '+447896229505'),
			(85, 'Pippyduck', 'http://a0.twimg.com/profile_images/56444532/monchichi_normal.jpg', '+447803725141'),
			(86, 'loopdream', 'http://a0.twimg.com/profile_images/1511849737/photostream_normal.jpeg', '+447900905138'),
			(87, 'maracuja', 'http://a0.twimg.com/profile_images/2720722740/adacf6c0b5ebe73e245da1846b2b5885_normal.png', '+447403061588'),
			(88, 'anna_richmond', 'http://a0.twimg.com/profile_images/119823902/IMG_0339_normal.jpg', '+447541889479'),
			(89, 'Zimon14', 'http://a0.twimg.com/profile_images/1206497104/Foto_personale_normal.jpg', '+447586757018');
		");

		$this->db->query("
			INSERT INTO `games` (`id`, `p1_id`, `p2_id`, `p1_score`, `p2_score`, `timestamp`, `finished`) VALUES
			(15, 83, 84, 21, 21, 1355435347, 1);
		");
	}

	public function add_queue()
	{
		$this->db->query("
			INSERT INTO  `queue` (`user_id`, `notified`, `accepted`, `playing`, `finished`)
			VALUES (83, 0,  0,  0, 0),
			(84, 0,  0,  0, 0),
			(85, 0,  0,  0, 0),
			(86, 0,  0,  0, 0),
			(87, 0,  0,  0, 0),
			(88, 0,  0,  0, 0),
			(89, 0,  0,  0, 0);
		");
	}

	public function tweet()
	{
		$this->load->helper('twitter');

		$messages = array(
			"@ricardo and @cucchi just started playing",
			"@ricardo 21 vs 0 @cucchi ... result. PAAADOOOOORUUUUUUU",
			"noone has played in ages *sadface*"
		);

		foreach ($messages as $message) tweet_message($message);
	}

	public function text()
	{
		$this->load->helper('text');

		$messages = array(
			"the table is ready. GET TO DA CHOPPA",
			"ha ha you suck bro"
		);
		$number = "+447403061588";

		foreach ($messages as $message) send_text($number, $message);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */