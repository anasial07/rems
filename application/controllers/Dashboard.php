<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('dashboard_model','agent_model'));
		if(!$this->session->userdata('userId')){
			redirect('');
		}
	}

	// ------------------------ Load Views ------------------------

	public function index(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/dashboard';
		$this->load->view('components/template', $data);
	}
	public function provinces(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-province';
		$data['provinces'] = $this->dashboard_model->getProvinces();
		$this->load->view('components/template', $data);
	}
	public function cities(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-city';
		$data['provinces'] = $this->dashboard_model->activeProvinces();
		$data['cities'] = $this->dashboard_model->getCities();
		$this->load->view('components/template', $data);
	}
	public function offices(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-office';
		$data['cities'] = $this->dashboard_model->activeCities();
		$data['offices'] = $this->dashboard_model->getOffices();
		$this->load->view('components/template', $data);
	}
	public function departments(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-department';
		$data['departments'] = $this->dashboard_model->getDepartments();
		$this->load->view('components/template', $data);
	}
	public function addProject(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-projects';
		$data['cities'] = $this->dashboard_model->activeCities();
		$data['projects'] = $this->dashboard_model->getProjects();
		$this->load->view('components/template', $data);
	}
	public function addCategories(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-categories';
		$data['projects'] = $this->dashboard_model->activeProjects();
		$data['categories'] = $this->dashboard_model->getCategories();
		$this->load->view('components/template', $data);
	}
	public function addSubCategories(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-sub-category';
		$data['projects'] = $this->dashboard_model->activeProjects();
		$data['subCats'] = $this->dashboard_model->getSubCats();
		$this->load->view('components/template', $data);
	}
	public function addTypes(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-types';
		$data['projects'] = $this->dashboard_model->activeProjects();
		$data['types'] = $this->dashboard_model->getTypes();
		$this->load->view('components/template', $data);
	}
	public function myProfile(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/my-profile';
		$data['info'] = $this->dashboard_model->getProfile();
		$this->load->view('components/template', $data);
	}
	public function paymentPlan(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-payment-plan';
		$data['projects'] = $this->dashboard_model->activeProjects();
		$data['payPlans'] = $this->dashboard_model->getPaymentPlans();
		$this->load->view('components/template', $data);
	}
	public function addTeam(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-team';
		$data['cities'] = $this->dashboard_model->activeCities();
		$data['offices'] = $this->dashboard_model->activeOffices();
		$data['agents'] = $this->agent_model->activeAgents();
		$data['teams'] = $this->dashboard_model->getTeams();
		$this->load->view('components/template', $data);
	}
	public function addOffers(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-offers';
		$this->load->view('components/template', $data);
	}
	public function addDesignation(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-designation';
		$data['designations'] = $this->dashboard_model->getDesignations();
		$this->load->view('components/template', $data);
	}
	public function projectDetail($progId){	// Get Project Full Details (View in Model)
		$data = $this->dashboard_model->getProjects($progId);
		echo json_encode($data);
	}
	public function getCats($progId){	// Filter Categories
		$data = $this->dashboard_model->activeCategories($progId);
		echo json_encode($data);
	}
	public function getSubCats($catId){	// Filter Sub-Categories
		$data = $this->dashboard_model->activeSubCats($catId);
		echo json_encode($data);
	}
	public function getTypes($subCatId){	// Filter Types
		$data = $this->dashboard_model->activeTypes($subCatId);
		echo json_encode($data);
	}
	public function getPlanDetail($planID){	// Get Payment Plan Details
		$data = $this->dashboard_model->getPaymentPlans($planID);
		echo json_encode($data);
	}
	public function getTeamInfo($id){	// Get Team Details
		$data = $this->dashboard_model->getTeams($id);
		echo json_encode($data);
	}
	public function fetchBank(){	// Get Banks
		$data= $this->dashboard_model->activeBanks();
		echo json_encode($data);
	}
	public function cityAgents($id){	// Get Agents Against City
		$data= $this->dashboard_model->cityAgents($id);
		echo json_encode($data);
	}
	public function getPayPlans($id){	// Get Payment Plans Against Project
		$data= $this->dashboard_model->getPayPlans($id);
		echo json_encode($data);
	}
	public function getPayPlan($id){	// Get Paymentplan Against Payment Plan ID
		$data= $this->dashboard_model->getPayPlan($id);
		echo json_encode($data);
	}
	public function getTypeInfo(){	// Get Banks
		$data = $this->dashboard_model->getTypes();
		echo json_encode($data);
	}

	// ------------------------ Insert Records ------------------------

	public function addProvince(){	// Add Province
		$data = array(
			'provCode' => strtoupper($this->input->post('provCode')),
			'provName' => ucwords($this->input->post('provName')),
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('provCode', 'Province Code', 'required');
		$this->form_validation->set_rules('provName', 'Province Name', 'required');
		if($this->form_validation->run() == TRUE){
			if($this->dashboard_model->add_province($data)){
				echo true;
			}else{
				echo false;
			}
		}
	}
	public function addCity(){	// Add City
		$data = array(
			'provinceId' => $this->input->post('provinceId'),
			'locCode' => strtoupper($this->input->post('locCode')),
			'locName' => ucwords($this->input->post('locName')),
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('provinceId', 'Select Province', 'required');
		$this->form_validation->set_rules('locCode', 'City Code', 'required');
		$this->form_validation->set_rules('locName', 'City Name', 'required');
		if($this->form_validation->run() == TRUE){
			if($this->dashboard_model->add_City($data)){
				echo true;
			}else{
				echo false;
			}
		}
	}
	public function addOffice(){	// Add Office
		$data = array(
			'locationId' => $this->input->post('locationId'),
			'officeName' => ucwords($this->input->post('officeName')),
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('locationId', 'Select City', 'required');
		$this->form_validation->set_rules('officeName', 'Office Name', 'required');
		if($this->form_validation->run() == TRUE){
			if($this->dashboard_model->add_Office($data)){
				echo true;
			}else{
				echo false;
			}
		}
	}
	public function addDepartment(){	// Add Department
		$data = array(
			'departCode' => strtoupper($this->input->post('departCode')),
			'departName' => ucwords($this->input->post('departName')),
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('departCode', 'Department Code', 'required');
		$this->form_validation->set_rules('departName', 'Department Name', 'required');
		if($this->form_validation->run() == TRUE){
			if($this->dashboard_model->add_Department($data)){
				echo true;
			}else{
				echo false;
			}
		}
	}
	public function saveProject(){	// Add Project
		$config = array(
			'upload_path' => './uploads/letterHead/',
			'allowed_types' => 'jpg|jpeg|png',
			'encrypt_name' => false,
			'max_size' => 1024,
			'file_name' => $this->input->post('projCode').'_'.time(),
		);
		$this->load->library('upload', $config);
		if($this->upload->do_upload('projLogo')){
			$data = $this->upload->data();
			$image = $data['file_name'];
		}else{
			$image = $this->upload->display_errors();
		}
		$data = array(
			'projCode' => strtoupper($this->input->post('projCode')),
			'projName' => $this->input->post('projName'),
			'projLocation' => $this->input->post('projLocation'),
			'projArea' => $this->input->post('projArea'),
			'projBasePrice' => $this->input->post('projBasePrice'),
			'webAddress' => $this->input->post('webAddress'),
			'mailAddress' => $this->input->post('mailAddress'),
			'projAddress' => $this->input->post('projAddress'),
			'projLogo' => $image,
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('projCode', 'Project Code', 'required');
		$this->form_validation->set_rules('projName', 'Project Name', 'required');
		$this->form_validation->set_rules('projLocation', 'Project City', 'required');
		$this->form_validation->set_rules('projArea', 'Project Area', 'required');
		$this->form_validation->set_rules('projBasePrice', 'Project Base Price', 'required');
		$this->form_validation->set_rules('webAddress', 'Project Web Address', 'required');
		$this->form_validation->set_rules('mailAddress', 'Project Mail Address', 'required');
		$this->form_validation->set_rules('projAddress', 'Project Address', 'required');
		if($this->form_validation->run() == TRUE){
			if($this->dashboard_model->add_Project($data)){
				echo true;
			}else{
				echo false;
			}
		}else{
			echo validation_errors();
		}
	}
	public function addCategory(){	// Add Category
		$data = array(
			'projectId' => $this->input->post('projectId'),
			'catName' => ucwords($this->input->post('catName')),
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('projectId', 'Project', 'required');
		$this->form_validation->set_rules('catName', 'Category Name', 'required');
		if($this->form_validation->run() == TRUE){
			if($this->dashboard_model->add_category($data)){
				echo true;
			}else{
				echo false;
			}
		}
	}
	public function addSubCategory(){	// Add Sub-Category
		$data = array(
			'projectId' => $this->input->post('projectId'),
			'catId' => $this->input->post('catId'),
			'subCatName' => ucwords($this->input->post('subCatName')),
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('projectId', 'Select Project', 'required');
		$this->form_validation->set_rules('catId', 'Select Category', 'required');
		$this->form_validation->set_rules('subCatName', 'Sub-Category Name', 'required');
		if($this->form_validation->run() == TRUE){
			if($this->dashboard_model->add_subCategory($data)){
				echo true;
			}else{
				echo false;
			}
		}
	}
	public function addType(){	//Add Type
		$projID = $this->input->post('projectId');
		$catId = $this->input->post('catId');
		$subCatId = $this->input->post('subCatId');
		$typeName = ucfirst($this->input->post('typeName'));
		$marlaSize = $this->input->post('marlaSize');
		$dimenssion = $this->input->post('dimenssion');
		$base_price = $this->input->post('base_price');
		$typeDiscount = $this->input->post('discount');
		$typeDiscount = ($typeDiscount == "") ? 0 : $typeDiscount;
	
		$this->form_validation->set_rules('projectId', 'Select Project', 'required');
		$this->form_validation->set_rules('catId', 'Select Category', 'required');
		$this->form_validation->set_rules('subCatId', 'Select Sub-Category', 'required');
		$this->form_validation->set_rules('typeName', 'Type Name', 'required');
		$this->form_validation->set_rules('marlaSize', 'Marla Size', 'required');
		$this->form_validation->set_rules('dimenssion', 'Dimensions', 'required');
	
		if ($this->form_validation->run() == TRUE) {
			$percent = $typeDiscount / 100;
			$perMarla = $base_price - ($percent * $base_price);
			$totalPrice = $perMarla * $marlaSize;
			$data = array(
				'projectId' => $projID,
				'catId' => $catId,
				'subCatId' => $subCatId,
				'typeName' => $typeName,
				'base_price' => $base_price,
				'marlaSize' => $marlaSize,
				'perMarla' => $perMarla,
				'totalPrice' => $totalPrice,
				'dimenssion' => $dimenssion,
				'discount' => $typeDiscount,
				'addedBy' => $this->session->userdata('userId')
			);
			if($this->dashboard_model->add_type($data)) {
				echo true;
			}else{
				echo false;
			}
		}
	}
	public function saveDesignation(){	// Add Designation
		$data = array(
			'desigCode' => strtoupper($this->input->post('desigCode')),
			'desigName' => ucwords($this->input->post('designName')),
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('desigCode', 'Designation Code', 'required');
		$this->form_validation->set_rules('designName', 'Designation Name', 'required');
		if($this->form_validation->run() == TRUE){
			if($this->dashboard_model->add_designation($data)){
				echo true;
			}else{
				echo false;
			}
		}
	}	
	public function addPaymentPlan(){	// Add Payment Plan
		$data = array(
			'projectId' => $this->input->post('projectId'),
			'catId' => $this->input->post('catId'),
			'subCatId' => $this->input->post('subCatId'),
			'typeId' => $this->input->post('typeId'),
			'planName' => ucwords($this->input->post('planName')),
			'planYears' => $this->input->post('planYears'),
			'downPayment' => $this->input->post('downPayment'),
			'confirmPay' => $this->input->post('confirmPay'),
			'semiAnnual' => $this->input->post('semiAnnual'),
			'possession' => $this->input->post('possession'),
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('projectId', 'Select Project', 'required');
		$this->form_validation->set_rules('catId', 'Select Category', 'required');
		$this->form_validation->set_rules('subCatId', 'Select Sub-Category', 'required');
		$this->form_validation->set_rules('typeId', 'Select Type', 'required');
		$this->form_validation->set_rules('planName', 'Plan Name', 'required');
		$this->form_validation->set_rules('planYears', 'Plan Years', 'required');
		$this->form_validation->set_rules('downPayment', 'Down Payment', 'required');
		$this->form_validation->set_rules('confirmPay', 'Confirmation', 'required');
		$this->form_validation->set_rules('semiAnnual', 'Semi Annual', 'required');
		$this->form_validation->set_rules('possession', 'Possession', 'required');
		if($this->form_validation->run() == TRUE){
			if($this->dashboard_model->add_paymentPlan($data)){
				echo true;
			}else{
				echo false;
			}
		}
	}
	public function saveTeam(){	// Add Team
		$data = array(
			'teamName' => ucwords($this->input->post('teamName')),
			'teamLead' => $this->input->post('teamLead'),
			'bdm' => $this->input->post('bdm'),
			'bcm' => $this->input->post('bcm'),
			'zm' => $this->input->post('zm'),
			'locationId' => $this->input->post('cityId'),
			'officeId' => $this->input->post('officeId'),
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('teamName', 'Team Name', 'required');
		if($this->form_validation->run() == TRUE){
			if($this->dashboard_model->add_team($data)){
				echo true;
			}else{
				echo false;
			}
		}
	}
	public function addBank(){	// Add Bank
		$data = array(
			'bankName' => ucfirst($this->input->post('bankName')),
			'branchCode' => $this->input->post('branchCode'),
			'branchAddr' => ucwords($this->input->post('branchAddr')),
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('bankName', 'Bank Name', 'required');
		$this->form_validation->set_rules('branchCode', 'Branch Code', 'required');
		$this->form_validation->set_rules('branchAddr', 'Bank Address', 'required');
		if($this->form_validation->run() == TRUE){
			if($this->dashboard_model->addBank($data)){
				echo true;
			}else{
				echo false;
			}
		}
	}
}
