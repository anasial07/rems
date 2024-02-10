<?php defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * undocumented class
 */
class customer_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	// ---------------------------- View Records ------------------------------------
    
	public function getCustomers($id = null){
		$this->db->select('*');
		$this->db->from('customers');
		$this->db->join('locations', 'customers.cityId = locations.locationId', 'left');
		$this->db->order_by('customers.customerId', 'DESC');
		$id && $this->db->where('customers.customerId', $id);
		return $this->db->get()->result();
	}
	public function getCustmInfo($CNIC){
		$this->db->select('*');
		$this->db->from('customers');
		$this->db->where(array('custmCNIC' => $CNIC, 'custmStatus' => 1));
		return $this->db->get()->row();
	}

	// ---------------------------- Insert Records ------------------------------------

	public function add_Customer($data){
		$this->db->insert('customers', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	
}
