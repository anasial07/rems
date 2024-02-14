<?php defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * undocumented class
 */
class booking_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	// ---------------------------- View Records ------------------------------------
    
	public function getBookings($id = null){
		$this->db->select('*');
		$this->db->from('bookings');
		$this->db->join('projects', 'bookings.projID = projects.projectId', 'left');
		$this->db->join('categories', 'bookings.catID = categories.catId', 'left');
		$this->db->join('sub_categories', 'bookings.subCatID = sub_categories.subCatId', 'left');
		$this->db->join('types', 'bookings.typeID = types.typeId', 'left');
		$this->db->join('customers', 'bookings.customerID = customers.customerId', 'left');
		$this->db->join('locations', 'bookings.cityID = locations.locationId', 'left');
		$this->db->join('agents', 'bookings.agentID = agents.agentId', 'left');
		$this->db->join('banks', 'bookings.bookBankId = banks.bankId', 'left');
		$this->db->join('payment_plans', 'bookings.payPlanID = payment_plans.payPlanId', 'left');
		$this->db->order_by('bookings.bookingId', 'DESC');
		$id && $this->db->where('bookings.bookingId', $id);
		return $this->db->get()->result();
	}
	public function filterCustomers($id){
		$this->db->select('customers.*');
		$this->db->from('customers');
		$this->db->join('bookings', 'customers.customerId = bookings.customerID');
		$this->db->where(array('bookings.projID' => $id, 'customers.custmStatus' => 1));
		return $this->db->get()->result();
	}
	public function filterBookings($id){
		$this->db->select('*');
		$this->db->from('bookings');
		$this->db->join('customers', 'bookings.customerID = customers.customerId', 'left');
		$this->db->where(array('bookings.customerID' => $id));
		return $this->db->get()->result();
	}
	public function filterBookingByCNIC($id = null){
		$this->db->select('*');
		$this->db->from('bookings');
		$this->db->join('projects', 'bookings.projID = projects.projectId', 'left');
		$this->db->join('categories', 'bookings.catID = categories.catId', 'left');
		$this->db->join('sub_categories', 'bookings.subCatID = sub_categories.subCatId', 'left');
		$this->db->join('types', 'bookings.typeID = types.typeId', 'left');
		$this->db->join('customers', 'bookings.customerID = customers.customerId', 'left');
		$this->db->join('locations', 'bookings.cityID = locations.locationId', 'left');
		$this->db->join('agents', 'bookings.agentID = agents.agentId', 'left');
		$this->db->join('banks', 'bookings.bookBankId = banks.bankId', 'left');
		$this->db->join('payment_plans', 'bookings.payPlanID = payment_plans.payPlanId', 'left');
		$this->db->order_by('bookings.bookingId', 'DESC');
		$id && $this->db->where('customers.custmCNIC', $id);
		return $this->db->get()->result();
	}
	public function getInstallments($id = null){
		$this->db->select('*');
		$this->db->from('installments');
		$this->db->join('bookings', 'installments.bookingId = bookings.bookingId', 'left');
		$this->db->join('locations', 'installments.installReceivedIn = locations.locationId', 'left');
		$this->db->join('banks', 'installments.installBankId = banks.bankId', 'left');
		$id && $this->db->where('installments.bookingId', $id);
		return $this->db->get()->result();
	}

	// ---------------------------- Insert Records ------------------------------------

	public function saveBooking($data){
		$this->db->insert('bookings', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function submitInstallment($data){
		$this->db->insert('installments', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
}
