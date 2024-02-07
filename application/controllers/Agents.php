<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agents extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('dashboard_model'));
		if(!$this->session->userdata('userId')){
			redirect('');
	}
}
	public function index(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'agents/view-agents';
		$this->load->view('components/template', $data);
	}
	public function addAgent(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'agents/add-agent';
		$data['departments'] = $this->dashboard_model->activeDepart();
		$data['cities'] = $this->dashboard_model->activeCities();
		$data['offices'] = $this->dashboard_model->activeOffices();
		$data['designations'] = $this->dashboard_model->activeDesignations();
		$this->load->view('components/template', $data);
	}
	public function saveAgent(){    // Add Agent
        $data = array(
            'agentCode' => $this->input->post('empCode'),
            // 'agentName' => ucwords($this->input->post('empName')),
            // 'agentPhone' => $this->input->post('empContact'),
            // 'agentEmail' => $this->input->post('empEmail'),
            // 'designationId' => $this->input->post('empDesign'),
            // 'departId' => $this->input->post('empDepart'),
            // 'locationId' => $this->input->post('empCity'),
            // 'officeId' => $this->input->post('empOffice'),
            // 'doj' => $this->input->post('empDOJ'),
            // 'empTeam' => $this->input->post('empTeam'),
            // 'empManger' => $this->input->post('empManger'),
            'addedBy' => $this->session->userdata('userId')
        );

        $this->form_validation->set_rules('empCode', 'Agent Code', 'required');
        // $this->form_validation->set_rules('empName', 'Agent Name', 'required');
        // $this->form_validation->set_rules('empContact', 'Agent Contact', 'required');
        // $this->form_validation->set_rules('empEmail', 'Agent Email', 'required');
        // $this->form_validation->set_rules('empDesign', 'Select Designation', 'required');
        // $this->form_validation->set_rules('empDepart', 'Select Department', 'required');
        // $this->form_validation->set_rules('empCity', 'Select City', 'required');
        // $this->form_validation->set_rules('empOffice', 'Select Office', 'required');
        // $this->form_validation->set_rules('empDOJ', 'Date of Joining', 'required');

        if($this->form_validation->run() == TRUE){
            if($this->agent_model->add_agent($data)){
                echo true;
            }else{
                echo "failed to add agent";
            }
        }
    }
}
