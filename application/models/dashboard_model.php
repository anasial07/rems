<?php defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * undocumented class
 */
class dashboard_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	// ---------------------------- Insert Queries ------------------------------------

	public function add_province($data){
		$this->db->insert('provinces', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function add_City($data){
		$this->db->insert('locations', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function add_Office($data){
		$this->db->insert('offices', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function add_Department($data){
		$this->db->insert('departments', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function add_Project($data){
		$this->db->insert('projects', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function add_category($data){
		$this->db->insert('categories', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function add_subCategory($data){
		$this->db->insert('sub_categories', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function add_type($data){
		$this->db->insert('types', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function add_paymentPlan($data){
		$this->db->insert('payment_plans', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function add_designation($data){
		$this->db->insert('designations', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function add_team($data){
		$this->db->insert('teams', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
	public function addBank($data){
		$this->db->insert('banks', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	// ---------------------------- Select Queries ------------------------------------

	public function getProvinces(){
		$this->db->select('*');
		$this->db->from('provinces')->order_by('provinceId', 'DESC');
		return $this->db->get()->result();
	}
	public function getCities(){
		$this->db->select('*');
		$this->db->from('locations')->order_by('locationId', 'DESC');
		return $this->db->get()->result();
	}
	public function getDepartments(){
		$this->db->select('*');
		$this->db->from('departments')->order_by('departId', 'DESC');
		return $this->db->get()->result();
	}
	public function getProjects($id = null){
		$this->db->select('*');
		$this->db->from('projects');
		$this->db->join('locations', 'projects.projLocation = locations.locationId', 'left');
		$id && $this->db->where('projects.projectId', $id);
		return $this->db->get()->result();
	}
	public function getDesignations(){
		$this->db->select('*');
		$this->db->from('designations')->order_by('desigId', 'DESC');
		return $this->db->get()->result();
	}
	public function totalCustomers(){
		return $this->db->from('customers')->count_all_results();
	}
	public function totalAgents(){
		return $this->db->from('agents')->count_all_results();
	}
	public function totalBookings(){
		return $this->db->from('bookings')->count_all_results();
	}
	public function totalTeams(){
		return $this->db->from('teams')->count_all_results();
	}
	public function totalBookingAmount(){
		$query = $this->db->select_sum('bookingAmount')->get('bookings');
		$result = $query->row();
		return $result->bookingAmount;
	}
	public function totalInstallmentAmount(){
		$query = $this->db->select_sum('installAmount')->get('installments');
		$result = $query->row();
		return $result->installAmount;
	}
	public function activeProvinces(){
		return $this->db->select('*')->from('provinces')->where('provStatus', 1)->order_by('provinceId', 'DESC')->get()->result();
	}
	public function activeCities(){
		return $this->db->select('*')->from('locations')->where('locStatus', 1)->order_by('locationId', 'DESC')->get()->result();
	}
	public function activeProjects(){
		return $this->db->select('*')->from('projects')->where('projStatus', 1)->order_by('projectId', 'DESC')->get()->result();
	}
	public function activeDepart(){
		return $this->db->select('*')->from('departments')->where('departStatus', 1)->order_by('departId', 'DESC')->get()->result();
	}
	public function activeOffices(){
		return $this->db->select('*')->from('offices')->where('officeStatus', 1)->order_by('officeId', 'DESC')->get()->result();
	}
	public function activeDesignations(){
		return $this->db->select('*')->from('designations')->where('desigStatus', 1)->order_by('desigId', 'DESC')->get()->result();
	}
	public function activeBanks(){
		return $this->db->select('*')->from('banks')->where('bankStatus', 1)->order_by('bankId', 'DESC')->get()->result();
	}
	public function cityAgents($id){
		$this->db->select('*');
		$this->db->from('agents');
		$this->db->where(array('locationId' => $id, 'agentStatus' => 1));
		return $this->db->get()->result();
	}
	public function getPayPlans($id){
		$this->db->select('*');
		$this->db->from('payment_plans');
		$this->db->where(array('projectId' => $id, 'planStatus' => 1));
		return $this->db->get()->result();
	}
	public function getPayPlan($id){
		$this->db->select('*');
		$this->db->from('payment_plans');
		$this->db->where(array('payPlanId' => $id));
		return $this->db->get()->row();
	}
	public function activeCategories($id){
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where(array('projectId' => $id, 'catStatus' => 1));
		$this->db->order_by('catId', 'DESC');
		return $this->db->get()->result();
	}
	public function activeSubCats($id){
		$this->db->select('*');
		$this->db->from('sub_categories');
		$this->db->where(array('catId' => $id, 'subCatStatus' => 1));
		$this->db->order_by('subCatId', 'DESC');
		return $this->db->get()->result();
	}
	public function activeTypes($id){
		$this->db->select('*');
		$this->db->from('types');
		$this->db->where(array('subCatId' => $id, 'typeStatus' => 1));
		$this->db->order_by('typeId', 'DESC');
		return $this->db->get()->result();
	}
	public function getOffices(){
		$this->db->select('*');
		$this->db->from('offices');
		$this->db->join('locations', 'offices.locationId = locations.locationId', 'left');
		$this->db->order_by('offices.officeId', 'DESC');
		return $this->db->get()->result();
	}
	public function getProfile($id = null){
		$this->db->select('*');
		$this->db->from('users');
		$this->db->join('locations', 'users.locationId = locations.locationId', 'left');
		$this->db->join('departments', 'users.departmentId = departments.departId', 'left');
		$id && $this->db->where('users.id', $id);
		return $this->db->get()->result();
	}
	public function getCategories(){
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->join('projects', 'categories.projectId = projects.projectId', 'left');
		$this->db->order_by('categories.catId', 'DESC');
		return $this->db->get()->result();
	}
	public function getSubCats(){
		$this->db->select('*');
		$this->db->from('sub_categories');
		$this->db->join('projects', 'sub_categories.projectId = projects.projectId', 'left');
		$this->db->join('categories', 'sub_categories.catId = categories.catId', 'left');
		$this->db->order_by('sub_categories.subCatId', 'DESC');
		return $this->db->get()->result();
	}
	public function getTypes($id = null){
		$this->db->select('*');
		$this->db->from('types');
		$this->db->join('projects', 'types.projectId = projects.projectId', 'left');
		$this->db->order_by('types.typeId', 'DESC');
		$id && $this->db->where('types.typeId', $id);
		return $this->db->get()->result();
	}
	public function getPaymentPlans($id = null){
		$this->db->select('*');
		$this->db->from('payment_plans');
		$this->db->join('projects', 'payment_plans.projectId = projects.projectId', 'left');
		$this->db->join('categories', 'payment_plans.catId = categories.catId', 'left');
		$this->db->join('sub_categories', 'payment_plans.subCatId = sub_categories.subCatId', 'left');
		$this->db->join('types', 'payment_plans.typeId = types.typeId', 'left');
		$this->db->order_by('payment_plans.payPlanId', 'DESC');
		$id && $this->db->where('payment_plans.payPlanId', $id);
		return $this->db->get()->result();
	}
	public function getTeams($id = null){
		$this->db->select('teams.*,
									CONCAT(agents.agentName) AS teamLead,
									CONCAT(agents1.agentName) AS bdm,
									CONCAT(agents2.agentName) AS bcm,
									CONCAT(agents3.agentName) AS zm,
									locations.locName,
									offices.officeName');
		$this->db->from('teams');
		$this->db->join('agents', 'teams.teamLead = agents.agentId', 'left');
		$this->db->join('agents agents1', 'teams.bdm = agents1.agentId', 'left');
		$this->db->join('agents agents2', 'teams.bcm = agents2.agentId', 'left');
		$this->db->join('agents agents3', 'teams.zm = agents3.agentId', 'left');
		$this->db->join('locations', 'teams.locationId = locations.locationId', 'left');
		$this->db->join('offices', 'teams.officeId = offices.officeId', 'left');
		$this->db->order_by('teams.teamId', 'DESC');
		$id && $this->db->where('teams.teamId', $id); // single team
		return $this->db->get()->result();
	}
}
