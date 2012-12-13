<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class mQueue extends CI_Model
{
	var $table = 'queue';

	public function __construct()
	{
		parent::__construct();
	}

	public function get_by_id($id='')
	{
		$query = $this->db->get_where($this->table, array('id' => $id));
		return $query->row();	
	}

	public function add_player($user='')
	{
		$queue = $this->get_by_user($user);
		if ($queue) return false;

		$data['user_id'] = $user->id;
		$data['notified'] = 0;
		$data['accepted'] = 0;
		$data['playing'] = 0;
		$data['finished'] = 0;
		return $this->db->insert($this->table, $data)  ?  true : false ;
	}

	public function get_by_user($user='')
	{
		$query = $this->db->get_where($this->table, array('user_id' => $user->id));
		return $query->row();	
	}

	public function get_waiting_users()
	{
		$this->load->model('muser', 'user');
		$query = $this->db->get_where($this->table, array('notified' => 0));
		$results = $query->result();
		$results_array = array();
		foreach ($results as $key => $result)
			$results_array[] = $this->user->get_by_id($result->user_id);
		return $results_array;
	}

	public function set_played($id='')
	{

	}

	// playerAccepts()
	//
	// we're not doing because we're assuming the player accepts

	public function player_declines($id='')
	{

	}

	public function get_next_player()
	{

	}
}