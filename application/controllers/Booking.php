<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('dashboard_model'));
		if(!$this->session->userdata('userId')){
			redirect('');
		}
	}
	public function index(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'bookings/view-bookings';
		$this->load->view('components/template', $data);
	}
	public function addInstallment(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'bookings/add-installment';
		$this->load->view('components/template', $data);
	}
	public function bookingDetail(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'bookings/booking-detail';
		$this->load->view('components/template', $data);
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
		$data = array(
			'projID' => $this->input->post('projID'),
			'catID' => $this->input->post('catID'),
			'subCatID' => $this->input->post('subCatID'),
			'typeID' => $this->input->post('typeID'),
			'custmID' => $this->input->post('custmID'),
			'cityID' => $this->input->post('cityID'),
			'agentID' => $this->input->post('agentID'),
			'sepDiscount' => $this->input->post('sepDiscount'),
			'paidAmount' => $this->input->post('paidAmount'),
			'paymentMode' => $this->input->post('paymentMode'),
			'referenceNo' => $this->input->post('referenceNo'),
			'bank_name' => $this->input->post('bank_name'),
			'receivedIn' => $this->input->post('receivedIn'),
			'payPlanID' => $this->input->post('payPlanID'),
			'exCharges' => $this->input->post('exCharges'),
			'purchaseDate' => $this->input->post('purchaseDate'),
			'filerStatus' => $this->input->post('filerStatus'),
			'filerPercent' => $this->input->post('filerPercent'),
			'features' => $this->input->post('features'),
			'addedBy' => $this->session->userdata('userId')
		);
		// $this->form_validation->set_rules('provCode', 'Province', 'required');
		// $this->form_validation->set_rules('provCode', 'Province', 'required');
		// $this->form_validation->set_rules('provCode', 'Province', 'required');
		// $this->form_validation->set_rules('provCode', 'Province', 'required');
		// $this->form_validation->set_rules('provCode', 'Province', 'required');
		// $this->form_validation->set_rules('provCode', 'Province', 'required');
		// $this->form_validation->set_rules('provCode', 'Province', 'required');
		// $this->form_validation->set_rules('provCode', 'Province', 'required');
		// $this->form_validation->set_rules('provCode', 'Province', 'required');
		// $this->form_validation->set_rules('provCode', 'Province', 'required');
		// $this->form_validation->set_rules('provCode', 'Province', 'required');
		// $this->form_validation->set_rules('provCode', 'Province', 'required');
		// $this->form_validation->set_rules('provCode', 'Province', 'required');
		// $this->form_validation->set_rules('provCode', 'Province', 'required');
		// $this->form_validation->set_rules('provCode', 'Province', 'required');
		// $this->form_validation->set_rules('provCode', 'Province', 'required');
		// $this->form_validation->set_rules('provCode', 'Province', 'required');
		// $this->form_validation->set_rules('provCode', 'Province', 'required');
		// $this->form_validation->set_rules('provCode', 'Province', 'required');
		// $this->form_validation->set_rules('provCode', 'Province', 'required');
		if($this->form_validation->run() == TRUE){
			if($this->dashboard_model->saveBooking($data)){
				echo true;
			}else{
				echo false;
			}
		}
	}
}
