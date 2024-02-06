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
	public function getProjects(){
		$this->db->select('*');
		$this->db->from('projects')->order_by('projectId', 'DESC');
		return $this->db->get()->result();
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
		$id && $this->db->where('users.id', $id); // single user
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
	public function calculate_price($projId){
		$this->db->select('projBasePrice, depreciation');
		$this->db->from('projects')->where('projectId', $projId);
		return $this->db->get()->row();
	}
	public function getTypes(){
		$this->db->select('*');
		$this->db->from('types');
		$this->db->join('projects', 'types.projectId = projects.projectId', 'left');
		$this->db->order_by('types.typeId', 'DESC');
		return $this->db->get()->result();
	}
	public function get_project_detail($projId){
		$this->db->select('*');
		$this->db->from('projects');
		$this->db->join('locations', 'projects.projLocation = locations.locationId', 'left');
		$this->db->where('projects.projectId', $projId);
		return $this->db->get()->row();
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
}
