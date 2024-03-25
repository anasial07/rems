<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agents extends CI_Controller {
	protected $user_permissions;
	public function __construct(){
		parent::__construct();
		$this->load->model(array('dashboard_model','agent_model'));
        $this->load->helper('user_permissions');
        $this->user_permissions = new User_permissions();
		if(!$this->session->userdata('userId')){
			redirect('');
        }
    }
    public function permission_denied()
	{
		$this->load->view('no-permission');
	}
	public function index(){
		if(!$this->user_permissions->check_permission('viewAgent')){
			redirect('dashboard/permission_denied');
		}
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'agents/view-agents';
		$data['agents'] = $this->agent_model->getAgents();
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function getManagers($id){	// Get Managers
		$data = $this->agent_model->activeManagers($id);
		echo json_encode($data);
	}
	public function deleteAgent($id){ // Delete Agent
		if(!$this->user_permissions->check_permission('deleteAgent')){
			redirect('dashboard/permission_denied');
		}
		$data = $this->agent_model->deleteAgent($id);
		echo json_encode($data);
	}

    // -----------------------------------------------------------------

	public function addAgent(){
		if(!$this->user_permissions->check_permission('createAgent')){
			redirect('dashboard/permission_denied');
		}
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'agents/add-agent';
		$data['departments'] = $this->dashboard_model->activeDepart();
		$data['cities'] = $this->dashboard_model->activeCities();
		$data['offices'] = $this->dashboard_model->activeOffices();
		$data['designations'] = $this->dashboard_model->activeDesignations();
		$data['teams'] = $this->agent_model->activeTeams();
		$data['userPermissions'] = $this->dashboard_model->get_userPermissions();
		$this->load->view('components/template', $data);
	}
	public function saveAgent(){    // Add Agent
		if(!$this->user_permissions->check_permission('createAgent')){
			redirect('dashboard/permission_denied');
		}
        $data = array(
            'agentCode' => $this->input->post('agentCode'),
            'agentName' => ucwords(strtolower($this->input->post('agentName'))),
            'agentPhone' => $this->input->post('agentPhone'),
            'agentEmail' => $this->input->post('agentEmail'),
            'designationId' => $this->input->post('designationId'),
            'departId' => $this->input->post('departId'),
            'locationId' => $this->input->post('locationId'),
            'officeId' => $this->input->post('officeId'),
            'doj' => date('Y-m-d',strtotime($this->input->post('doj'))),
            'teamId' => $this->input->post('empTeam'),
            'managerId' => $this->input->post('empManger'),
            'addedBy' => $this->session->userdata('userId')
        );
        $this->form_validation->set_rules('agentCode', 'Agent Code', 'trim');
        $this->form_validation->set_rules('agentName', 'Agent Name', 'required');
        $this->form_validation->set_rules('agentEmail', 'Agent Email', 'trim|valid_email|');
        $this->form_validation->set_rules('agentPhone', 'Agent Contact', 'trim|required|max_length[12]|numeric');
        $this->form_validation->set_rules('designationId', 'Select Designation', 'required');
        $this->form_validation->set_rules('departId', 'Select Department', 'required');
        $this->form_validation->set_rules('locationId', 'Select City', 'required');
        $this->form_validation->set_rules('officeId', 'Select Office', 'required');
        $this->form_validation->set_rules('doj', 'Date of Joining', 'required');
        if($this->form_validation->run() == TRUE){
            if($this->agent_model->add_agent($data)){
                echo true;
            }else{
                echo false;
            }
        }
    }
}
