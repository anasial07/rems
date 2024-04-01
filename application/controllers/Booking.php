<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {
	protected $user_permissions;
	public function __construct(){
		parent::__construct();
		$this->load->model(array('dashboard_model','booking_model'));
        $this->load->helper('user_permissions');
        $this->user_permissions = new User_permissions();
		$this->load->library('pdf');
		if(!$this->session->userdata('userId')){
			redirect('');
		}
	}
    public function permission_denied()
	{
		$this->load->view('no-permission');
	}
	public function index(){
		if(!$this->user_permissions->check_permission('viewBooking')){
			redirect('dashboard/permission_denied');
		}
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'bookings/view-bookings';
		$data['bookings'] = $this->booking_model->getBookings();
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function viewInstallment(){
		if(!$this->user_permissions->check_permission('viewInstallments')){
			redirect('dashboard/permission_denied');
		}
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'bookings/view-installments';
		$data['installments'] = $this->booking_model->individualInstallments();
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function addInstallment(){
		if(!$this->user_permissions->check_permission('createInstallments')){
			redirect('dashboard/permission_denied');
		}
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'bookings/add-installment';
		$data['projects'] = $this->dashboard_model->activeProjects();
		$data['banks'] = $this->dashboard_model->activeBanks();
		$data['cities'] = $this->dashboard_model->activeCities();
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function bookingDetail($id){	// Get Complete Info of Booking
		if(!$this->user_permissions->check_permission('bookingDetail')){
			redirect('dashboard/permission_denied');
		}
		$bookingID=base_convert($id, 36, 10);
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'bookings/booking-detail';
		$data['info'] = $this->booking_model->getBookings($bookingID);
		$data['installments'] = $this->booking_model->getInstallments($bookingID);
		$data['totalInstallAmount'] = $this->booking_model->totalInstallmentAmount($bookingID);
		$data['countInstallments'] = $this->booking_model->count_all_installments($bookingID);
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function getCustomers($id){	// Get Customers Against Project ID
		$data = $this->booking_model->filterCustomers($id);
		echo json_encode($data);
	}
	public function getMyBooking($id){	// Get Bookings Against Customer ID
		$data = $this->booking_model->filterBookings($id);
		echo json_encode($data);
	}
	public function getBooking($id){	// Get Booking info
		$data = $this->booking_model->getBookings($id);
		echo json_encode($data);
	}
	public function getBookingByCNIC($id){	// Get Booking info By CNIC
		$data = $this->booking_model->filterBookingByCNIC($id);
		echo json_encode($data);
	}
	public function customerBookings($id){
		$data = $this->booking_model->customerBookings($id);
		echo json_encode($data);
	}
	public function deleteBooking($id){
		if(!$this->user_permissions->check_permission('deleteBooking')){
			redirect('dashboard/permission_denied');
		}
		$data = $this->booking_model->deleteBooking($id);
		echo json_encode($data);
	}
	public function approveBooking($id){
		if(!$this->user_permissions->check_permission('verifyBooking')){
			redirect('dashboard/permission_denied');
		}
		$data = $this->booking_model->approveBooking($id);
		echo json_encode($data);
	}
	public function addBooking(){
		if(!$this->user_permissions->check_permission('createBooking')){
			redirect('dashboard/permission_denied');
		}
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'bookings/add-booking';
		$data['projects'] = $this->dashboard_model->activeProjects();
		$data['cities'] = $this->dashboard_model->activeCities();
		$data['banks'] = $this->dashboard_model->activeBanks();
		$data['payPlans'] = $this->dashboard_model->getPayPlans();
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function saveBooking(){	// Add New Booking
		if(!$this->user_permissions->check_permission('createBooking')){
			redirect('dashboard/permission_denied');
		}
		$projID=$this->input->post('projID');
		$projCode=$this->input->post('projectCode');
		$projectBasePrice=$this->input->post('projectBasePrice');
		$typeSize=$this->input->post('typeSize');
		$typeSizeCheck=$typeSize;
		$custmID=$this->input->post('customerID');
		$purchaseDate = date('Y-m-d',strtotime($this->input->post('purchaseDate')));
		$typeAmount = $this->input->post('typeAmount');
		$sepDiscount = ($this->input->post('sepDiscount')=="") ? 0 : $this->input->post('sepDiscount');
		$exCharges = ($this->input->post('exCharges')=="") ? 0 : $this->input->post('exCharges');
		$featuresPercent = ($this->input->post('featuresPercent')=="") ? 0 : $this->input->post('featuresPercent');
		$year=date('Y', strtotime($purchaseDate));

		$subtotal=$typeAmount - ($typeAmount * ($sepDiscount / 100));
		$total=$subtotal + $exCharges;
		$salePrice=$total + ($total * ($featuresPercent / 100));

		$total_bookings=0;
		$this->db->select('COUNT(bookingId) as total_bookings');
		$query = $this->db->from('bookings')->where('projID', $projID)->get();
		$result = $query->row();
		$totalBookings = $result->total_bookings;
		$total_bookings = $totalBookings++; 

		if($totalBookings<10){ $totalBookings = "000".$totalBookings; }
		else if($totalBookings<100){ $totalBookings = "00".$totalBookings; }
		else if($totalBookings<1000){ $totalBookings = "0".$totalBookings; }
		else if($totalBookings<1000){ $totalBookings = $totalBookings; }

		$result = '';
		$romanNumerals = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);

		foreach ($romanNumerals as $roman => $value) {
			$matches = intval($typeSize / $value);
			$result .= str_repeat($roman, $matches);
			$typeSize = $typeSize % $value;
		}
		$result=$result;
		if (strpos($typeSizeCheck, '.') == true) {
			$result=$result.'S';
		}

		$memberShip=$projCode."/".$result."/".$totalBookings."/".$year;
		
        $refrence=0;
        $bankName=0;
        $adjustInfo=0;
		$payMode=$this->input->post('paymentMode');
		
		$refrence=$this->input->post('referenceNo');
		$bankName=$this->input->post('bank_name');
		$adjustInfo=ucfirst(strtolower($this->input->post('adjustInfo')));
			
		$features = !empty($this->input->post('features')) ? implode(',', $this->input->post('features')) : 0;
		$filerPercent = !empty($this->input->post('filerPercent')) ? $this->input->post('filerPercent') : 0;
		$data = array(
			'projID' => $projID,
			'bookingBasePrice' => $projectBasePrice,
			'catID' => $this->input->post('catID'),
			'subCatID' => $this->input->post('subCatID'),
			'typeID' => $this->input->post('typeID'),
			'customerID' => $this->input->post('customerID'),
			'cityID' => $this->input->post('cityID'),
			'agentID' => $this->input->post('agentID'),
			'sepDiscount' => $sepDiscount,
			'bookingAmount' => $this->input->post('paidAmount'),
			'bookingMode' => $payMode,
			'bookingReferenceNo' => $refrence,
			'bookBankId' => $bankName,
			'bookAdjustmentInfo' => $adjustInfo,
			'bookReceivedIn' => $this->input->post('receivedIn'),
			'payPlanID' => $this->input->post('payPlanID'),
			'bookingtypeDiscount' => $this->input->post('typeDiscount'),
			'exCharges' => $exCharges,
			'bokNetPrice' => $typeAmount,
			'salePrice' => $salePrice,
			'purchaseDate' => $purchaseDate,
			'bookFilerStatus' => $this->input->post('filerStatus'),
			'bookFilerPercent' => $filerPercent,
			'featuresPercent' => $featuresPercent,
			'features' => $features,
			'membershipNo' => $memberShip,
			'bookAddedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('projID', 'Select Project', 'required');
		$this->form_validation->set_rules('catID', 'Select Category', 'required');
		$this->form_validation->set_rules('subCatID', 'Select Sub-Category', 'required');
		$this->form_validation->set_rules('typeID', 'Select Type', 'required');
		$this->form_validation->set_rules('customerID', 'Enter Customer CNIC', 'required');
		$this->form_validation->set_rules('cityID', 'Select City', 'required');
		$this->form_validation->set_rules('agentID', 'Select Agent', 'required');
		$this->form_validation->set_rules('paidAmount', 'Enter Paid Amount', 'required');
		$this->form_validation->set_rules('paymentMode', 'Select Payment Mode', 'required');
		$this->form_validation->set_rules('receivedIn', 'Select City', 'required');
		$this->form_validation->set_rules('payPlanID', 'Select Payment Plan', 'required');
		$this->form_validation->set_rules('purchaseDate', 'Enter Purchase Date', 'required');
		if($payMode!='Cash' && $payMode!='Adjustment'){
			$this->form_validation->set_rules('referenceNo', 'Enter Reference No', 'required|trim');
			$this->form_validation->set_rules('bank_name', 'Select Bank', 'required');
		}
		if($payMode=='Adjustment'){
			$this->form_validation->set_rules('adjustInfo', 'Enter adjustment information', 'required');
		}
		if($this->form_validation->run() == TRUE){
			if($this->booking_model->saveBooking($data)){
				echo $memberShip;
			}
		}
	}
	public function saveInstallment(){	// Add Installment
		if(!$this->user_permissions->check_permission('createInstallments')){
			redirect('dashboard/permission_denied');
		}
		$refrence=0;
        $bankName=0;
        $adjustInfo=0;
		$payMode=$this->input->post('paymentMode');
		
		$bankName=$this->input->post('bank_name');
		$refrence=$this->input->post('refrncNo');
		$adjustInfo=ucfirst(strtolower($this->input->post('adjustInfo')));
		$data = array(
			'bookingId' => $this->input->post('bookingID'),
			'installAmount' => $this->input->post('recvAmount'),
			'installPayMode' => $payMode,
			'installBankId' => $bankName,
			'installAdjustmentInfo' => $adjustInfo,
			'installReferenceNo' => $refrence,
			'installReceivedIn' => $this->input->post('recvCity'),
			'installReceivedDate' => date('Y-m-d',strtotime($this->input->post('recvDate'))),
			'InstallFilerStatus' => $this->input->post('filerStatus'),
			'installFilerPercent' => $this->input->post('filerPercent'),
			'installAddedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('bookingID', 'Select Booking', 'required');
		$this->form_validation->set_rules('recvAmount', 'Enter Amount', 'required');
		$this->form_validation->set_rules('paymentMode', 'Select Payment Mode', 'required');
		$this->form_validation->set_rules('recvCity', 'Select Location', 'required');
		$this->form_validation->set_rules('recvDate', 'Enter Date', 'required');
		$this->form_validation->set_rules('filerStatus', 'Select Filer Status', 'required');
		$this->form_validation->set_rules('filerPercent', 'Enter Filer Percentage', 'required');
		
		if($payMode!='Cash' && $payMode!='Adjustment'){
			$this->form_validation->set_rules('refrncNo', 'Enter Reference No', 'required|trim');
			$this->form_validation->set_rules('bank_name', 'Select Bank', 'required');
		}
		if($payMode=='Adjustment'){
			$this->form_validation->set_rules('adjustInfo', 'Enter adjustment information', 'required');
		}
		if($this->form_validation->run() == TRUE){
			if($this->booking_model->submitInstallment($data)){
				echo true;
			}else{
				echo false;
			}
		}else{
		    echo validation_errors();
		}
	}
	public function issueFile($id){
		if(!$this->user_permissions->check_permission('issueFile')){
			redirect('dashboard/permission_denied');
		}
	    $issueFile = $this->input->post('issueDate');
		$data = $this->booking_model->issueFile($id, $issueFile);
		echo json_encode($data);
	}

	// -------------------------------  Update -------------------------------

	public function updateBooking($id){
		if(!$this->user_permissions->check_permission('editBooking')){
			redirect('dashboard/permission_denied');
		}
		$bookingID=base_convert($id, 36, 10);
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'bookings/edit/edit-booking';
		$data['bookingInfo'] = $this->booking_model->getBookings($bookingID);
		$data['projects'] = $this->dashboard_model->activeProjects();
		$data['cities'] = $this->dashboard_model->activeCities();
		$data['banks'] = $this->dashboard_model->activeBanks();
		$data['categories'] = $this->dashboard_model->activeCategories($data['bookingInfo'][0]->projectId);
		$data['subCategories'] = $this->dashboard_model->projSubCats($data['bookingInfo'][0]->catID);
		$data['types'] = $this->dashboard_model->activeTypes($data['bookingInfo'][0]->subCatId);
		$data['agents'] = $this->dashboard_model->cityAgents($data['bookingInfo'][0]->cityID);
		$data['payPlans'] = $this->dashboard_model->getPayPlans($data['bookingInfo'][0]->projID);
		$this->load->view('components/template', $data);
	}
}
