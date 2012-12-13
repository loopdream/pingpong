<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	- createGame(id)
	- finishGame(id)
	- currentGame() //returns false if there is no current game
	- tauntLoser()
*/

class Game extends CI_Model {

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
}