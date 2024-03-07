<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('dashboard_model','customer_model'));
		if(!$this->session->userdata('userId')){
			redirect('');
		}
	}
	public function index(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'customers/view-customers';
		$data['customers'] = $this->customer_model->getCustomers();
		$this->load->view('components/template', $data);
	}
	public function addCustomer(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'customers/add-customer';
		$data['cities'] = $this->dashboard_model->activeCities();
		$this->load->view('components/template', $data);
	}
	public function customerInfo($id){	// Get Customer Full Details (View in Model)
		$data = $this->customer_model->getCustomers($id);
		echo json_encode($data);
	}
	public function getCustmInfo($CNIC){	// Get Customer Info against CNIC
		$data = $this->customer_model->getCustmInfo($CNIC);
		echo json_encode($data);
	}
	public function deleteCustomer($id){ // Delete Customer
		$data = $this->customer_model->deleteCustomer($id);
		echo json_encode($data);
	}

	public function saveCustomer(){
		$config = array(
			'upload_path' => './uploads/customers/',
			'allowed_types' => 'jpg|jpeg|png',
			'encrypt_name' => false,
			'max_size' => 1024,
			'file_name' => $this->input->post('custCNIC') . '_' . time(),
		);
		$custmGender=$this->input->post('gender');
		$this->load->library('upload', $config);
		if($this->upload->do_upload('custmPic')){
			$image = $this->upload->data('file_name');
		}else{
			($custmGender==1) ? $image = 'male.jpg' : $image = 'female.jpg';
		}
		$data = array(
			'custmCNIC' => $this->input->post('custCNIC'),
			'custmName' => ucwords(strtolower($this->input->post('custName'))),
			'fatherName' => ucwords(strtolower($this->input->post('custFather'))),
			'custmEmail' => strtolower($this->input->post('custEmail')),
			'custmDOB' => $this->input->post('custDOB'),
			'primaryPhone' => $this->input->post('custPrimary'),
			'secondaryPhone' => $this->input->post('custSecondary'),
			'cityId' => $this->input->post('custCity'),
			'isEmployee' => $this->input->post('isEmployee'),
			'custmGender' => $custmGender,
			'presentAddress' => ucwords($this->input->post('custPresent')),
			'permanentAddress' => ucwords($this->input->post('custPermanent')),
			'nokName' => ucwords(strtolower($this->input->post('NOKname'))),
			'nokCNIC' => $this->input->post('NOKcnic'),
			'nokPhone' => $this->input->post('NOKcontact'),
			'nokEmail' => strtolower($this->input->post('NOKemail')),
			'nokRelation' => ucwords(strtolower($this->input->post('NOKrelation'))),
			'custmPic' => $image,
			'addedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('custCNIC', 'Customer CNIC', 'required');
		$this->form_validation->set_rules('custName', 'Customer Name', 'required');
		$this->form_validation->set_rules('custCity', 'Select City', 'required');
		$this->form_validation->set_rules('custPrimary', 'Primary Phone', 'required');
		if ($this->form_validation->run() == true) {
			if ($this->customer_model->add_Customer($data)) {
				echo true;
			} else {
				echo false;;
			}
		}
	}
}
