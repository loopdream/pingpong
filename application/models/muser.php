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
		$data['twitter_avatar'] = $this->get_twitter_avatar($data['twitter_name']);
		return $this->db->insert($this->table, $data)  ?  true : false ;
	}

	public function get_twitter_avatar($name)
	{
		$contents = file_get_contents("https://api.twitter.com/1/users/show.json?screen_name={$name}&include_entities=true");
		$contents = json_decode($contents);
		if (isset($contents->profile_image_url)) return $contents->profile_image_url;
		else return "http://graph.facebook.com/david.kenneth.george.hamilton.dick.ii/picture";
	}

	public function clear()
	{
		$this->db->where('id >', '0');
		$this->db->delete($this->table);
	}
}