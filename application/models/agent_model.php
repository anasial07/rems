<?php defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * undocumented class
 */
class customer_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	// ---------------------------- View Records ------------------------------------
    

	// ---------------------------- Insert Records ------------------------------------

	public function add_agent($data){
		$this->db->insert('agents', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
}
