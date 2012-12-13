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
		$game = $this->get_current_game();
		if ($game) return false;

		$data['p1_id'] = $p1->id;
		$data['p2_id'] = $p2->id;
		$data['p1_score'] = 0;
		$data['p2_score'] = 0;
		$data['timestamp'] = mktime();
		$data['finished'] = 0;
		return $this->db->insert($this->table, $data)  ?  true : false ;
	}

	public function finish_game($p1score=0, $p2score=0)
	{
		$game = $this->get_current_game();

		$data['finished'] = 1;
		$data['p1_score'] = $p1score;
		$data['p2_score'] = $p2score;
		return $this->db->update($this->table, $data, array("finished" => 0))  ?  true : false ;
	}

	public function get_current_game()
	{
		$query = $this->db->get_where($this->table, array('finished' => 0));
		return $query->row();	
	}

	public function clear()
	{
		$this->db->where('id >', '0');
		$this->db->delete($this->table);
	}

}