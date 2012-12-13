<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
	
	- registerUser(twittername)
	- workOutAvatar()
*/

class mUser extends CI_Model
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

	public function get_by_number($number='')
	{
		$query = $this->db->get_where($this->table, array('phone_number' => $number));
		return $query->row();	
	}

	public function register_user($details)
	{
		$data['phone_number'] = $details['From'];
		$data['twitter_name'] = str_replace("@", "", $details['Body']);
		$data['twitter_avatar'] = 'http://graph.facebook.com/david.kenneth.george.hamilton.dick.ii/picture';
		return $this->db->insert($this->table, $data)  ?  true : false ;
	}

	public function clear()
	{
		$this->db->where('id >', '0');
		$this->db->delete($this->table);
	}
}