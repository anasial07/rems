<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('dashboard_model','booking_model'));
		if(!$this->session->userdata('userId')){
			redirect('');
		}
	}
	public function index(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'bookings/view-bookings';
		$data['bookings'] = $this->booking_model->getBookings();
		$this->load->view('components/template', $data);
	}
	public function addInstallment(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'bookings/add-installment';
		$data['projects'] = $this->dashboard_model->activeProjects();
		$data['banks'] = $this->dashboard_model->activeBanks();
		$data['cities'] = $this->dashboard_model->activeCities();
		$this->load->view('components/template', $data);
	}
	public function bookingDetail(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'bookings/booking-detail';
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
	public function addBooking(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'bookings/add-booking';
		$data['projects'] = $this->dashboard_model->activeProjects();
		$data['cities'] = $this->dashboard_model->activeCities();
		$data['banks'] = $this->dashboard_model->activeBanks();
		$this->load->view('components/template', $data);
	}
	public function saveBooking(){	// Add New Booking
		$projCode=$this->input->post('projectCode');
		$typeSize=$this->input->post('typeSize');
		$custmID=$this->input->post('customerID');
		$purchaseDate = $this->input->post('purchaseDate');
		$year=date('Y', strtotime($purchaseDate));

		if($custmID<10){ $custmID = "000".$custmID; }
		else if($custmID<100){ $custmID = "00".$custmID; }
		else if($custmID<1000){ $custmID = "0".$custmID; }
		else if($custmID<1000){ $custmID = $custmID; }

		$result = '';
		$romanNumerals = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);

		foreach ($romanNumerals as $roman => $value) {
			$matches = intval($typeSize / $value);
			$result .= str_repeat($roman, $matches);
			$typeSize = $typeSize % $value;
		}

		$memberShip=$projCode."/".$result."/".$custmID."/".$year;

		$payMode=$this->input->post('paymentMode');
		if($payMode=='Cash'){
			$refrence=0;
			$bankName='';
		}else{
			$refrence=$this->input->post('referenceNo');
			$bankName=$this->input->post('bank_name');
		}
		$features = !empty($this->input->post('features')) ? implode(',', $this->input->post('features')) : '';
		$data = array(
			'projID' => $this->input->post('projID'),
			'catID' => $this->input->post('catID'),
			'subCatID' => $this->input->post('subCatID'),
			'typeID' => $this->input->post('typeID'),
			'customerID' => $this->input->post('customerID'),
			'cityID' => $this->input->post('cityID'),
			'agentID' => $this->input->post('agentID'),
			'sepDiscount' => $this->input->post('sepDiscount'),
			'paidAmount' => $this->input->post('paidAmount'),
			'paymentMode' => $payMode,
			'referenceNo' => $refrence,
			'bankId' => $bankName,
			'receivedIn' => $this->input->post('receivedIn'),
			'payPlanID' => $this->input->post('payPlanID'),
			'exCharges' => $this->input->post('exCharges'),
			'purchaseDate' => $this->input->post('purchaseDate'),
			'filerStatus' => $this->input->post('filerStatus'),
			'filerPercent' => $this->input->post('filerPercent'),
			'features' => $features,
			'membershipNo' => $memberShip,
			'addedBy' => $this->session->userdata('userId')
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
		if($payMode!='Cash'){
			$this->form_validation->set_rules('referenceNo', 'Enter Reference No', 'required');
			$this->form_validation->set_rules('bank_name', 'Select Bank', 'required');
		}
		if($this->form_validation->run() == TRUE){
			if($this->booking_model->saveBooking($data)){
				echo $memberShip;
			}
		}
	}
	public function saveInstallment(){	// Add Installment
		$payMode=$this->input->post('paymentMode');
		if($payMode=='Cash'){
			$bankName='';
			$refrence=0;
		}else{
			$bankName=$this->input->post('bank_name');
			$refrence=$this->input->post('refrncNo');
		}
		$data = array(
			'bookingId' => $this->input->post('bookingID'),
			'receivedAmount' => $this->input->post('recvAmount'),
			'payMode' => $payMode,
			'bankName' => $bankName,
			'referenceNo' => $refrence,
			'receivedIn' => $this->input->post('recvCity'),
			'receivedDate' => $this->input->post('recvDate'),
			'filerStatus' => $this->input->post('filerStatus'),
			'filerPercent' => $this->input->post('filerPercent'),
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('bookingID', 'Select Booking', 'required');
		$this->form_validation->set_rules('recvAmount', 'Enter Amount', 'required');
		$this->form_validation->set_rules('paymentMode', 'Select Payment Mode', 'required');
		$this->form_validation->set_rules('recvCity', 'Select Location', 'required');
		$this->form_validation->set_rules('recvDate', 'Enter Date', 'required');
		$this->form_validation->set_rules('filerStatus', 'Select Filer Status', 'required');
		$this->form_validation->set_rules('filerPercent', 'Enter Filer Percentage', 'required');
		
		if($payMode!='Cash'){
			$this->form_validation->set_rules('refrncNo', 'Enter Reference No', 'required');
			$this->form_validation->set_rules('bank_name', 'Select Bank', 'required');
		}
		if($this->form_validation->run() == TRUE){
			if($this->booking_model->submitInstallment($data)){
				echo true;
			}else{
				echo false;
			}
		}
	}
}
