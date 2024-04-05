<?php defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * undocumented class
 */
class Booking_model extends CI_Model{
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
		$this->db->join('users', 'bookings.bookAddedBy = users.userId', 'left');
		$this->db->order_by('bookings.bookingId', 'DESC');
		$id && $this->db->where('bookings.bookingId', $id);
		return $this->db->get()->result();
	}
	public function individualInstallments(){
	    $id=$this->session->userdata('userId');
<<<<<<< HEAD
	    $role=$this->session->userdata('role');
		$this->db->select('*');
		$this->db->from('installments');
		$this->db->join('bookings', 'installments.bookingId = bookings.bookingId', 'left');
		$this->db->join('users', 'installments.installAddedBy = users.userId', 'left');
		$this->db->join('customers', 'bookings.customerID = customers.customerId', 'left');
		if($role!='master'){
		    $id && $this->db->where('installments.installAddedBy', $id);
		}
		$this->db->order_by('installments.installmentId', 'DESC');
		return $this->db->get()->result();
	}
	public function totalBookings($id) {
        $this->db->where('customerID', $id);
        $query = $this->db->get('bookings');
        return $query->num_rows();
    }
=======
		$this->db->select('*');
		$this->db->from('installments');
		$this->db->join('bookings', 'installments.bookingId = bookings.bookingId', 'left');
		$id && $this->db->where('installments.installAddedBy', $id);
		return $this->db->get()->result();
	}
>>>>>>> a027ff1302f86992f92d7b836705f8861eb92a08
	public function recentBookings(){
		$this->db->select('*');
		$this->db->from('bookings');
		$this->db->join('locations', 'bookings.cityID = locations.locationId', 'left');
		$this->db->join('users', 'bookings.bookAddedBy = users.userId', 'left');
		$this->db->order_by('bookings.bookingId', 'DESC');
        $this->db->limit(4);
		return $this->db->get()->result();
	}
	public function filterCustomers($id){
		$this->db->select('customers.*');
		$this->db->from('customers');
		$this->db->join('bookings', 'customers.customerId = bookings.customerID');
		$this->db->where(array('bookings.projID' => $id, 'customers.custmStatus' => 1));
		$this->db->group_by('customers.customerId');
		return $this->db->get()->result();
	}
	public function filterBookings($id){
		$this->db->select('*');
		$this->db->from('bookings');
		$this->db->join('customers', 'bookings.customerID = customers.customerId', 'left');
		$this->db->join('types', 'bookings.typeID = types.typeId', 'left');
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
		$this->db->join('projects', 'bookings.projID = projects.projectId', 'left');
		$this->db->join('payment_plans', 'bookings.payPlanID = payment_plans.payPlanId', 'left');
		$this->db->join('types', 'bookings.typeID = types.typeId', 'left');
		$this->db->join('customers', 'bookings.customerID = customers.customerId', 'left');
		$this->db->join('locations', 'installments.installReceivedIn = locations.locationId', 'left');
		$this->db->join('banks', 'installments.installBankId = banks.bankId', 'left');
		$id && $this->db->where('installments.bookingId', $id);
		return $this->db->get()->result();
	}
	public function getInstallmentInfo($id){
		$this->db->select('*');
		$this->db->from('installments');
		$this->db->join('bookings', 'installments.bookingId = bookings.bookingId', 'left');
		$this->db->join('projects', 'bookings.projID = projects.projectId', 'left');
		$this->db->join('customers', 'bookings.customerID = customers.customerId', 'left');
		$this->db->join('agents', 'bookings.agentID = agents.agentId', 'left');
		$this->db->join('types', 'bookings.typeID = types.typeId', 'left');
		$this->db->join('locations', 'installments.installReceivedIn = locations.locationId', 'left');
		$this->db->where('installments.installmentId', $id);
		return $this->db->get()->result();
	}
	public function customerBookings($id){
		$this->db->select('*');
		$this->db->from('bookings');
		$this->db->where('bookings.customerID', $id);
		return $this->db->get()->result();
	}
	public function issueFile($id, $issueDate){
		return $this->db->query("UPDATE bookings SET fileIssuanceDate = '$issueDate' WHERE bookingId=$id");
	}
	public function deleteBooking($id){
		$result = $this->db->query("UPDATE bookings SET `bookingStatus` = NOT `bookingStatus` WHERE bookingId=$id");
		return $result ? true : false;
	}
	public function approveBooking($id){
		$result = $this->db->query("UPDATE bookings SET `bookVerifyStatus` = NOT `bookVerifyStatus` WHERE bookingId=$id");
		return $result ? true : false;
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
	public function totalInstallmentAmount($id){
		$this->db->select_sum('installAmount', 'totalInstallAmount');
		$this->db->where('bookingId', $id);
		$query = $this->db->get('installments');
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$totalInstallAmount = $row->totalInstallAmount;
			return $totalInstallAmount;
		}else{
			return 0;
		}
	}
	public function count_all_installments($id){
	return $this->db->from('installments')->where('bookingId', $id)->get()->num_rows();
		}
}
