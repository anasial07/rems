<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customers extends CI_Controller {
	public function index(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'customers/view-customers';
		$this->load->view('components/template', $data);
	}
	public function addCustomer(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'customers/add-customer';
		$this->load->view('components/template', $data);
	}
}
