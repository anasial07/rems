<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	protected $user_permissions;
	public function __construct()
    {
        parent::__construct();
        $this->load->model(array('dashboard_model', 'agent_model', 'booking_model'));
        $this->load->helper('user_permissions');
        $this->user_permissions = new User_permissions();
        if (!$this->session->userdata('userId')) {
            redirect('');
        }
    }

	// ------------------------ Load Views ------------------------
	public function permission_denied()
	{
		$this->load->view('no-permission');
	}
	public function guideline()
	{
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'rems-guideline';
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function index()
	{
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/dashboard';
		$data['totalCustomers'] = $this->dashboard_model->totalCustomers();
		$data['totalAgents'] = $this->dashboard_model->totalAgents();
		$data['totalBookings'] = $this->dashboard_model->totalBookings();
		$data['totalTeams'] = $this->dashboard_model->totalTeams();
		$data['bookingAmount'] = $this->dashboard_model->totalBookingAmount();
		$data['installAmount'] = $this->dashboard_model->totalInstallmentAmount();
		$data['month_year'] = $this->dashboard_model->dashInstChart();
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$data['recentBookings'] = $this->booking_model->recentBookings();
		$this->load->view('components/template', $data);
	}
	public function provinces()
	{
		if(!$this->user_permissions->check_permission('viewGeolocation')){
			redirect('dashboard/permission_denied');
		}
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-province';
		$data['provinces'] = $this->dashboard_model->getProvinces();
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function cities()
	{
		if(!$this->user_permissions->check_permission('viewGeolocation')){
			redirect('dashboard/permission_denied');
		}
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-city';
		$data['provinces'] = $this->dashboard_model->activeProvinces();
		$data['cities'] = $this->dashboard_model->getCities();
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function offices()
	{
		if(!$this->user_permissions->check_permission('viewGeolocation')){
			redirect('dashboard/permission_denied');
		}
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-office';
		$data['cities'] = $this->dashboard_model->activeCities();
		$data['offices'] = $this->dashboard_model->getOffices();
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function departments()
	{
		if(!$this->user_permissions->check_permission('viewGeolocation')){
			redirect('dashboard/permission_denied');
		}
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-department';
		$data['departments'] = $this->dashboard_model->getDepartments();
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function addProject()
	{
		if(!$this->user_permissions->check_permission('viewProject')){
			redirect('dashboard/permission_denied');
		}
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-projects';
		$data['cities'] = $this->dashboard_model->activeCities();
		$data['projects'] = $this->dashboard_model->getProjects();
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function addCategories()
	{
		if(!$this->user_permissions->check_permission('viewProject')){
			redirect('dashboard/permission_denied');
		}
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-categories';
		$data['projects'] = $this->dashboard_model->activeProjects();
		$data['categories'] = $this->dashboard_model->getCategories();
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function addSubCategories()
	{
		if(!$this->user_permissions->check_permission('viewProject')){
			redirect('dashboard/permission_denied');
		}
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-sub-category';
		$data['projects'] = $this->dashboard_model->activeProjects();
		$data['subCats'] = $this->dashboard_model->getSubCats();
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function addTypes()
	{
		if(!$this->user_permissions->check_permission('viewProject')){
			redirect('dashboard/permission_denied');
		}
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-types';
		$data['projects'] = $this->dashboard_model->activeProjects();
		$data['types'] = $this->dashboard_model->getTypes();
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function myProfile()
	{
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/my-profile';
		$userID = $this->session->userdata('userId');
		$data['info'] = $this->dashboard_model->getProfile($userID);
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function paymentPlan()
	{
		if(!$this->user_permissions->check_permission('viewPayplan')){
			redirect('dashboard/permission_denied');
		}
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-payment-plan';
		$data['projects'] = $this->dashboard_model->activeProjects();
		$data['payPlans'] = $this->dashboard_model->getPaymentPlans();
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function addTeam()
	{
		// $data['title'] = 'Dashboard | REMS';
		// $data['body'] = 'dashboard/add-team';
		// $data['cities'] = $this->dashboard_model->activeCities();
		// $data['offices'] = $this->dashboard_model->activeOffices();
		// $data['agents'] = $this->agent_model->activeAgents();
		// $data['teams'] = $this->dashboard_model->getTeams();
		// $this->load->view('components/template', $data);
	}
	public function addOffers()
	{
		// $data['title'] = 'Dashboard | REMS';
		// $data['body'] = 'dashboard/add-offers';
		// $this->load->view('components/template', $data);
	}
	public function addDesignation()
	{	
		if(!$this->user_permissions->check_permission('viewDesignation')){
			redirect('dashboard/permission_denied');
		}
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/add-designation';
		$data['designations'] = $this->dashboard_model->getDesignations();
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function viewUsers()
	{
		if(!$this->user_permissions->check_permission('viewUser')){
			redirect('dashboard/permission_denied');
		}
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/view-users';
		$data['users'] = $this->dashboard_model->getUser();
		$data['cities'] = $this->dashboard_model->activeCities();
		$data['departments'] = $this->dashboard_model->activeDepart();
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function logActivity()
	{
		if(!$this->user_permissions->check_permission('viewLogs')){
			redirect('dashboard/permission_denied');
		}
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/view-logs';
		$data['allLogs'] = $this->dashboard_model->getLogs();
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function addPermissions($id)
	{
		if(!$this->user_permissions->check_permission('createPermission')){
			redirect('dashboard/permission_denied');
		}
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/create-permissions';
		$data['users'] = $this->dashboard_model->getUser($id);
		$data['permissions'] = $this->dashboard_model->getPermissions($id);
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function projectDetail($progId)
	{	// Get Project Full Details (View in Model)
		$data = $this->dashboard_model->getProjects($progId);
		echo json_encode($data);
	}
	public function getCats($progId)
	{	// Filter Categories
		$data = $this->dashboard_model->activeCategories($progId);
		echo json_encode($data);
	}
	public function getSubCats($catId)
	{	// Filter Sub-Categories
		$data = $this->dashboard_model->activeSubCats($catId);
		echo json_encode($data);
	}
	public function getTypes($id)
	{	// Filter Types
		$data = $this->dashboard_model->activeTypes($id);
		echo json_encode($data);
	}
	public function typeInfo($id)
	{	// Filter Types
		$data = $this->dashboard_model->getTypes($id);
		echo json_encode($data);
	}
	public function getPlanDetail($planID)
	{	// Get Payment Plan Details
		$data = $this->dashboard_model->getPaymentPlans($planID);
		echo json_encode($data);
	}
	public function getTeamInfo($id)
	{	// Get Team Details
		$data = $this->dashboard_model->getTeams($id);
		echo json_encode($data);
	}
	public function fetchBank()
	{	// Get Banks
		$data = $this->dashboard_model->activeBanks();
		echo json_encode($data);
	}
	public function cityAgents($id)
	{	// Get Agents Against City
		$data = $this->dashboard_model->cityAgents($id);
		echo json_encode($data);
	}
	public function getPayPlans($id)
	{	// Get Payment Plans Against Project
		$data = $this->dashboard_model->getPayPlans($id);
		echo json_encode($data);
	}
	public function getPayPlan($id)
	{	// Get Paymentplan Against Payment Plan ID
		$data = $this->dashboard_model->getPayPlan($id);
		echo json_encode($data);
	}
	public function getTypeInfo($id)
	{	// Get Type
		$data = $this->dashboard_model->getTypes($id);
		echo json_encode($data);
	}
	public function editDesignation($id)
	{	// Edit Designation Detail
		if(!$this->user_permissions->check_permission('editDesignation')){
			redirect('dashboard/permission_denied');
		}
		$data = $this->dashboard_model->getDesignations($id);
		echo json_encode($data);
	}
	public function editProvince($id)
	{	// Edit Province Detail
		if(!$this->user_permissions->check_permission('editGeolocation')){
			redirect('dashboard/permission_denied');
		}
		$data = $this->dashboard_model->getProvinces($id);
		echo json_encode($data);
	}
	public function editCity($id)
	{	// Edit City Detail
		if(!$this->user_permissions->check_permission('editGeolocation')){
			redirect('dashboard/permission_denied');
		}
		$data = $this->dashboard_model->getCities($id);
		echo json_encode($data);
	}

	// ---------------------------Delete--------------------------------------

	public function deleteDesignation($id)
	{	// Delete Designation
		if(!$this->user_permissions->check_permission('deleteDesignation')){
			redirect('dashboard/permission_denied');
		}
		$data = $this->dashboard_model->deleteDesignation($id);
		echo json_encode($data);
	}
	public function deleteProvince($id)
	{ // Delete Province
		if(!$this->user_permissions->check_permission('deleteGeolocation')){
			redirect('dashboard/permission_denied');
		}
		$data = $this->dashboard_model->deleteProvince($id);
		echo json_encode($data);
	}
	public function deleteCity($id)
	{ // Delete Province
		if(!$this->user_permissions->check_permission('deleteGeolocation')){
			redirect('dashboard/permission_denied');
		}
		$data = $this->dashboard_model->deleteCity($id);
		echo json_encode($data);
	}
	public function deleteOffice($id)
	{	// Delete Office
		if(!$this->user_permissions->check_permission('deleteGeolocation')){
			redirect('dashboard/permission_denied');
		}
		$data = $this->dashboard_model->deleteOffice($id);
		echo json_encode($data);
	}
	public function deleteDepart($id)
	{	// Delete Department
		if(!$this->user_permissions->check_permission('deleteGeolocation')){
			redirect('dashboard/permission_denied');
		}
		$data = $this->dashboard_model->deleteDepart($id);
		echo json_encode($data);
	}
	public function deleteProject($id)
	{	// Delete Project
		if(!$this->user_permissions->check_permission('deleteProject')){
			redirect('dashboard/permission_denied');
		}
		$data = $this->dashboard_model->deleteProject($id);
		echo json_encode($data);
	}
	public function deleteCategory($id)
	{ // Delete Category
		if(!$this->user_permissions->check_permission('deleteProject')){
			redirect('dashboard/permission_denied');
		}
		$data = $this->dashboard_model->deleteCategory($id);
		echo json_encode($data);
	}
	public function deleteSubCategory($id)
	{ // Delete Sub-Category
		if(!$this->user_permissions->check_permission('deleteProject')){
			redirect('dashboard/permission_denied');
		}
		$data = $this->dashboard_model->deleteSubCategory($id);
		echo json_encode($data);
	}
	public function deleteType($id)
	{ // Delete Type
		if(!$this->user_permissions->check_permission('deleteProject')){
			redirect('dashboard/permission_denied');
		}
		$data = $this->dashboard_model->deleteType($id);
		echo json_encode($data);
	}
	public function deletePayPlan($id)
	{ // Delete Payment Plan
		if(!$this->user_permissions->check_permission('deletePayplan')){
			redirect('dashboard/permission_denied');
		}
		$data = $this->dashboard_model->deletePayPlan($id);
		echo json_encode($data);
	}
	public function deleteUser($id){	// Delete User
		if(!$this->user_permissions->check_permission('deleteUser')){
			redirect('dashboard/permission_denied');
		}
		$data = $this->dashboard_model->deleteUser($id);
		echo json_encode($data);
	}
	// ----------------------------Edit-----------------------------------

	public function editProject($id)
	{
		if(!$this->user_permissions->check_permission('editProject')){
			redirect('dashboard/permission_denied');
		}
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'dashboard/edit/edit-project';
		$data['cities'] = $this->dashboard_model->activeCities();
		$data['projects'] = $this->dashboard_model->getProjects();
		$data['projInfo'] = $this->dashboard_model->getProjects($id);
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}

	// ------------------------ Insert Records ------------------------

	public function addProvince()
	{	// Add Province
		if(!$this->user_permissions->check_permission('createGeolocation')){
			redirect('dashboard/permission_denied');
		}
		$data = array(
			'provCode' => strtoupper($this->input->post('provCode')),
			'provName' => ucwords(strtolower($this->input->post('provName'))),
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('provCode', 'Province Code', 'required');
		$this->form_validation->set_rules('provName', 'Province Name', 'required');
		if ($this->form_validation->run() == TRUE) {
			if ($this->dashboard_model->add_province($data)) {
				echo true;
			} else {
				echo false;
			}
		}
	}
	public function addCity()
	{	// Add City
		if(!$this->user_permissions->check_permission('createGeolocation')){
			redirect('dashboard/permission_denied');
		}
		$data = array(
			'provinceId' => $this->input->post('provinceId'),
			'locCode' => strtoupper($this->input->post('locCode')),
			'locName' => ucwords(strtolower($this->input->post('locName'))),
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('provinceId', 'Select Province', 'required');
		$this->form_validation->set_rules('locCode', 'City Code', 'required');
		$this->form_validation->set_rules('locName', 'City Name', 'required');
		if ($this->form_validation->run() == TRUE) {
			if ($this->dashboard_model->add_City($data)) {
				echo true;
			} else {
				echo false;
			}
		}
	}
	public function addOffice()
	{	// Add Office
		if(!$this->user_permissions->check_permission('createGeolocation')){
			redirect('dashboard/permission_denied');
		}
		$data = array(
			'locationId' => $this->input->post('locationId'),
			'officeName' => ucwords(strtolower($this->input->post('officeName'))),
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('locationId', 'Select City', 'required');
		$this->form_validation->set_rules('officeName', 'Office Name', 'required');
		if ($this->form_validation->run() == TRUE) {
			if ($this->dashboard_model->add_Office($data)) {
				echo true;
			} else {
				echo false;
			}
		}
	}
	public function addDepartment()
	{	// Add Department
		if(!$this->user_permissions->check_permission('createGeolocation')){
			redirect('dashboard/permission_denied');
		}
		$data = array(
			'departCode' => strtoupper($this->input->post('departCode')),
			'departName' => ucwords(strtolower($this->input->post('departName'))),
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('departCode', 'Department Code', 'required');
		$this->form_validation->set_rules('departName', 'Department Name', 'required');
		if ($this->form_validation->run() == TRUE) {
			if ($this->dashboard_model->add_Department($data)) {
				echo true;
			} else {
				echo false;
			}
		}
	}
	public function saveProject()
	{	// Add Project
		if(!$this->user_permissions->check_permission('createProject')){
			redirect('dashboard/permission_denied');
		}
		$config = array(
			'upload_path' => './uploads/letterHead/',
			'allowed_types' => 'jpg|jpeg|png',
			'encrypt_name' => false,
			'max_size' => 1024,
			'file_name' => $this->input->post('projCode') . '_' . time(),
		);
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('projLogo')) {
			$data = $this->upload->data();
			$image = $data['file_name'];
		} else {
			$image = $this->upload->display_errors();
		}
		$data = array(
			'projCode' => strtoupper($this->input->post('projCode')),
			'projName' => $this->input->post('projName'),
			'projLocation' => $this->input->post('projLocation'),
			'projArea' => $this->input->post('projArea'),
			'projBasePrice' => $this->input->post('projBasePrice'),
			'projLogo' => $image,
			'projAddedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('projCode', 'Project Code', 'required');
		$this->form_validation->set_rules('projName', 'Project Name', 'required');
		$this->form_validation->set_rules('projLocation', 'Project City', 'required');
		$this->form_validation->set_rules('projArea', 'Project Area', 'required');
		$this->form_validation->set_rules('projBasePrice', 'Project Base Price', 'required');
		$this->form_validation->set_rules('webAddress', 'Project Web Address', 'required');
		$this->form_validation->set_rules('mailAddress', 'Project Mail Address', 'required');
		$this->form_validation->set_rules('projAddress', 'Project Address', 'required');
		if ($this->form_validation->run() == TRUE) {
			if ($this->dashboard_model->add_Project($data)) {
				echo true;
			} else {
				echo false;
			}
		} else {
			echo validation_errors();
		}
	}
	public function addCategory()
	{	// Add Category
		if(!$this->user_permissions->check_permission('createProject')){
			redirect('dashboard/permission_denied');
		}
		$data = array(
			'projectId' => $this->input->post('projectId'),
			'catName' => ucwords(strtolower($this->input->post('catName'))),
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('projectId', 'Project', 'required');
		$this->form_validation->set_rules('catName', 'Category Name', 'required');
		if ($this->form_validation->run() == TRUE) {
			if ($this->dashboard_model->add_category($data)) {
				echo true;
			} else {
				echo false;
			}
		}
	}
	public function addSubCategory()
	{	// Add Sub-Category
		if(!$this->user_permissions->check_permission('createProject')){
			redirect('dashboard/permission_denied');
		}
		$data = array(
			'projectId' => $this->input->post('projectId'),
			'catId' => $this->input->post('catId'),
			'subCatName' => ucwords(strtolower($this->input->post('subCatName'))),
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('projectId', 'Select Project', 'required');
		$this->form_validation->set_rules('catId', 'Select Category', 'required');
		$this->form_validation->set_rules('subCatName', 'Sub-Category Name', 'required');
		if ($this->form_validation->run() == TRUE) {
			if ($this->dashboard_model->add_subCategory($data)) {
				echo true;
			} else {
				echo false;
			}
		}
	}
	public function addType()
	{	//Add Type
		if(!$this->user_permissions->check_permission('createProject')){
			redirect('dashboard/permission_denied');
		}
		$projID = $this->input->post('projectId');
		$catId = $this->input->post('catId');
		$subCatId = $this->input->post('subCatId');
		$typeName = ucwords(strtolower($this->input->post('typeName')));
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
			$perMarla = $base_price - ($base_price * ($typeDiscount / 100));
			$totalPrice = $perMarla * $marlaSize;
			$data = array(
				'projectId' => $projID,
				'catId' => $catId,
				'subCatId' => $subCatId,
				'typeName' => $typeName,
				// 'base_price' => $base_price,
				'marlaSize' => $marlaSize,
				// 'perMarla' => $perMarla,
				'totalPrice' => $totalPrice,
				'dimenssion' => $dimenssion,
				'discount' => $typeDiscount,
				'addedBy' => $this->session->userdata('userId')
			);
			if ($this->dashboard_model->add_type($data)) {
				echo true;
			} else {
				echo false;
			}
		}
	}
	public function saveDesignation()
	{	// Add Designation
		if(!$this->user_permissions->check_permission('createDesignation')){
			redirect('dashboard/permission_denied');
		}
		$data = array(
			'desigCode' => strtoupper($this->input->post('desigCode')),
			'desigName' => ucwords(strtolower($this->input->post('designName'))),
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('desigCode', 'Designation Code', 'required');
		$this->form_validation->set_rules('designName', 'Designation Name', 'required');
		if ($this->form_validation->run() == TRUE) {
			if ($this->dashboard_model->add_designation($data)) {
				echo true;
			} else {
				echo false;
			}
		}
	}
	public function addPaymentPlan()
	{	// Add Payment Plan
		if(!$this->user_permissions->check_permission('createPayplan')){
			redirect('dashboard/permission_denied');
		}
		$downPay = !empty($this->input->post('downPayment')) ? $this->input->post('downPayment') : 0;
		$conf = !empty($this->input->post('confirmPay')) ? $this->input->post('confirmPay') : 0;
		$semiAnl = !empty($this->input->post('semiAnnual')) ? $this->input->post('semiAnnual') : 0;
		$posses = !empty($this->input->post('possession')) ? $this->input->post('possession') : 0;
		$data = array(
			// 'projectId' => $this->input->post('projectId'),
			// 'catId' => $this->input->post('catId'),
			// 'subCatId' => $this->input->post('subCatId'),
			// 'typeId' => $this->input->post('typeId'),
			'planName' => ucwords(strtolower($this->input->post('planName'))),
			'planYears' => $this->input->post('planYears'),
			'downPayment' => $downPay,
			'confirmPay' => $conf,
			'semiAnnual' => $semiAnl,
			'possession' => $posses,
			'addedBy' => $this->session->userdata('userId')
		);
		// $this->form_validation->set_rules('projectId', 'Select Project', 'required');
		// $this->form_validation->set_rules('catId', 'Select Category', 'required');
		// $this->form_validation->set_rules('subCatId', 'Select Sub-Category', 'required');
		// $this->form_validation->set_rules('typeId', 'Select Type', 'required');
		$this->form_validation->set_rules('planName', 'Plan Name', 'required');
		$this->form_validation->set_rules('planYears', 'Plan Years', 'required');
		$this->form_validation->set_rules('downPayment', 'Down Payment', 'required');
		$this->form_validation->set_rules('confirmPay', 'Confirmation', 'required');
		$this->form_validation->set_rules('semiAnnual', 'Semi Annual', 'required');
		$this->form_validation->set_rules('possession', 'Possession', 'required');
		if ($this->form_validation->run() == TRUE) {
			if ($this->dashboard_model->add_paymentPlan($data)) {
				echo true;
			} else {
				echo false;
			}
		}
	}
	public function saveTeam()
	{	// Add Team
		$data = array(
			'teamName' => ucwords(strtolower($this->input->post('teamName'))),
			'teamLead' => $this->input->post('teamLead'),
			'bdm' => $this->input->post('bdm'),
			'bcm' => $this->input->post('bcm'),
			'zm' => $this->input->post('zm'),
			'locationId' => $this->input->post('cityId'),
			'officeId' => $this->input->post('officeId'),
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('teamName', 'Team Name', 'required');
		if ($this->form_validation->run() == TRUE) {
			if ($this->dashboard_model->add_team($data)) {
				echo true;
			} else {
				echo false;
			}
		}
	}
	public function addBank()
	{	// Add Bank
		$data = array(
			'bankName' => ucfirst(strtolower($this->input->post('bankName'))),
			'branchCode' => $this->input->post('branchCode'),
			'branchAddr' => ucwords($this->input->post('branchAddr')),
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('bankName', 'Bank Name', 'required');
		$this->form_validation->set_rules('branchCode', 'Branch Code', 'required');
		$this->form_validation->set_rules('branchAddr', 'Bank Address', 'required');
		if ($this->form_validation->run() == TRUE) {
			if ($this->dashboard_model->addBank($data)) {
				echo true;
			} else {
				echo false;
			}
		}
	}
	public function addUser()
	{	// Add New User
		if(!$this->user_permissions->check_permission('createUser')){
			redirect('dashboard/permission_denied');
		}
		$data = array(
			'empName' => ucfirst(strtolower($this->input->post('userFullName'))),
			'userName' => strtolower($this->input->post('userName')),
			'userEmail' => strtolower($this->input->post('userEmailAddr')),
			'password' => sha1($this->input->post('userPassword')),
			'locationId' => $this->input->post('userCity'),
			'departmentId' => $this->input->post('userDepart'),
			'role' => $this->input->post('userRole')
		);
		$this->form_validation->set_rules('userFullName', 'Enter Full Name', 'required');
		$this->form_validation->set_rules('userName', 'Enter Username', 'required');
		$this->form_validation->set_rules('userEmailAddr', 'User Email Address', 'trim|valid_email|required');
		$this->form_validation->set_rules('userPassword', 'Set Password', 'trim|required');
		$this->form_validation->set_rules('userCity', 'Select City', 'required');
		$this->form_validation->set_rules('userDepart', 'Select Department', 'required');
		$this->form_validation->set_rules('userRole', 'Select Role', 'required');
		if ($this->form_validation->run() == TRUE) {
			if ($this->dashboard_model->add_user($data)) {
				echo true;
			} else {
				echo false;
			}
		}
	}
	public function savePermissions()
	{	// Create & Update Permissions
		if(!$this->user_permissions->check_permission('createPermission')){
			redirect('dashboard/permission_denied');
		}
		$allPermissions = !empty($this->input->post('permissions')) ? implode(',', $this->input->post('permissions')) : 0;
		$data = array(
			'userID' => $this->input->post('userID'),
			'userPermissions' => $allPermissions
		);
		$exist = $this->input->post('isExistRow');
		if ($exist == 0) {
			$reponse = $this->dashboard_model->createPermissions($data);
		} else {
			$reponse = $this->dashboard_model->updatePermissions($data, $data['userID']);
		}
		if ($reponse == true) {
			echo true;
		} else {
			echo false;
		}
	}
	// -------------------------Update-------------------------------------

	public function updateProfile()
	{	// Update Profile
		$oldPassword = sha1($this->input->post('oldPass'));
		$this->form_validation->set_rules('oldPass', 'Enter Old Password', 'required');
		$this->form_validation->set_rules('newPass', 'Enter New Password', 'required');
		if ($this->form_validation->run() == TRUE) {
			if ($this->dashboard_model->old_password($oldPassword)) {
				$data = array(
					'password' => sha1($this->input->post('newPass'))
				);
				if ($this->dashboard_model->update_password($data)) {
					echo true;
				} else {
					echo false;
				}
			} else {
				echo false;
			}
		} else {
			echo false;
		}
	}
	public function updateProject()
	{	// Update Project Info
		if(!$this->user_permissions->check_permission('editProject')){
			redirect('dashboard/permission_denied');
		}
		if (isset($_FILES['projLogo']['name'])) {
			$config = array(
				'upload_path' => './uploads/letterHead/',
				'allowed_types' => 'jpg|jpeg|png',
				'encrypt_name' => false,
				'file_name' => $this->input->post('projCode') . '_' . time(),
			);
			$this->load->library('upload', $config);
			if ($this->upload->do_upload('projLogo')) {
				$data = $this->upload->data();
				$image = $data['file_name'];
				unlink('./uploads/letterHead/' . $this->input->post('oldProjLogo'));
			}
		} else {
			$image = $this->input->post('oldProjLogo');
		}
		$id = $this->input->post('projId');
		$projArea = $this->input->post('projArea');
		$oldBasePrice = $this->input->post('oldBasePrice');
		$projBasePrice = $this->input->post('projBasePrice');
		$data = array(
			'projCode' => strtoupper($this->input->post('projCode')),
			'projName' => $this->input->post('projName'),
			'projLocation' => $this->input->post('projLocation'),
			'projArea' => $projArea,
			'projBasePrice' => $projBasePrice,
			'projLogo' => $image,
			'updatedProj' => date('Y-m-d H:i:s')
		);
		if ($this->dashboard_model->update_project($id, $data)) {
			$logData = array(
				'Price before update' => number_format($oldBasePrice),
				'Base Price' => number_format($projBasePrice)
			);
			$logs = array(
				'logCategory' => 'project',
				'logData' => json_encode($logData),
				'logAddedBy' => $this->session->userdata('userId')
			);
			$this->dashboard_model->create_logs($logs);
			echo true;
		} else {
			echo false;
		}
	}
	public function updateMyProfile()
	{	// Add Project
		$config = array(
			'upload_path' => './uploads/profiles/',
			'allowed_types' => 'jpg|jpeg|png',
			'encrypt_name' => false,
			'max_size' => 1024,
			'file_name' => $this->session->userdata('userId') . '_' . time(),
		);
		$this->load->library('upload', $config);
		if ($this->upload->do_upload('myProfile')) {
			$data = $this->upload->data();
			$image = $data['file_name'];
			if($this->input->post('defaultProfile')!='default.png'){
				unlink('./uploads/profiles/' . $this->input->post('defaultProfile'));
			}
		} else {
			$image = $this->upload->display_errors();
		}
		$empID = $this->session->userdata('userId');
		if ($this->dashboard_model->updateMyProfile($image, $empID)) {
			echo true;
		} else {
			echo false;
		}
	}
}
