<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	- tauntLoser()
*/

class mGame extends CI_Model {

	var $table = 'games';

	public function __construct()
	{
		parent::__construct();
	}

	public function get_by_id($id='')
	{
		$query = $this->db->get_where($this->table, array('id' => $id));
		return $query->row();	
	}

	public function create_game($p1='', $p2='')
	{

	}

	public function finish_game($id='')
	{

	}

	public function get_current_game()
	{
		//returns false if there is no current game
	}
}