<?php defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * undocumented class
 */
class Login_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	// Check for credentials and log the user in
	public function signin($username, $password){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where("(users.userEmail = '$username')");
		$this->db->where(array('users.password' => $password, 'users.userStatus' => 1));
		return $this->db->get()->row();
	}
}
