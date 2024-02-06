<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agents extends CI_Controller {
	public function index(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'agents/view-agents';
		$this->load->view('components/template', $data);
	}
	public function addAgent(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'agents/add-agent';
		$this->load->view('components/template', $data);
	}
}
