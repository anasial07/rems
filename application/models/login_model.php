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
	public function update_last_login($userID, $data){
		$this->db->where('userId', $userID);
		$this->db->update('users', $data);
	}
	public function delete_user(){
		$userID = $this->session->userdata('userId');
		$result = $this->db->query("UPDATE users SET `userStatus` = NOT `userStatus` WHERE userId='$userID'");
		return $result ? true : false;
	}
	public function verifyCode($email, $inputCode){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where(array('userEmail' => $email, 'otp' => $inputCode));
		return $this->db->get()->row();
	}
	public function forgot_password($email){
		$query = $this->db->get_where('users', array('userEmail' => $email));
		return $query->num_rows();
	}
	public function reset_password($email, $data){
		$this->db->where('userEmail', $email);
		$this->db->update('users', $data);
		return true;
	}
}
