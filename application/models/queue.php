<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	- addPlayer(twitter_name)
	- setPlayed(id)
	- playerAccepts()
	- playerDeclines()
	- getNextPlayer()
*/

class Queue extends CI_Model
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
}