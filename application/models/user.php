<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	
	- registerUser(twittername)
	- workOutAvatar()
*/

class User extends CI_Model
{
	var $table = 'users';

	public function __construct()
	{
		parent::__construct();
	}

	// - getById(id)
	public function get_by_id($id='')
	{
		$query = $this->db->get_where($this->table, array('id' => $id));
		return $query->row();	
	}
}