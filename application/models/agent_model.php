<?php defined('BASEPATH') OR exit('No direct script access allowed!');

/**
 * undocumented class
 */
class Agent_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	// ---------------------------- View Records ------------------------------------
    
	public function activeTeams(){
		return $this->db->select('*')->from('teams')->where('teamStatus', 1)->order_by('teamId', 'DESC')->get()->result();
	}
	public function activeManagers($id){
		return $this->db->select('*')->from('agents')->where(array('agentStatus' => 1, 'designationId' => $id))->order_by('agentId', 'DESC')->get()->result();
	}
	public function activeAgents(){
		return $this->db->select('*')->from('agents')->where(array('agentStatus' => 1))->order_by('agentId', 'DESC')->get()->result();
	}
	public function deleteAgent($id){
		$result = $this->db->query("UPDATE agents SET `agentStatus` = NOT `agentStatus` WHERE agentId=$id");
		return $result ? true : false;
	}
	public function getAgents($id = null){
		$this->db->select('*');
		$this->db->from('agents');
		$this->db->join('locations', 'agents.locationId = locations.locationId', 'left');
		$this->db->join('offices', 'agents.officeId = offices.officeId', 'left');
		$this->db->join('departments', 'agents.departId = departments.departId', 'left');
		$this->db->join('designations', 'agents.designationId = designations.desigId', 'left');
		$this->db->join('teams', 'agents.teamId = teams.teamId', 'left');
		$id && $this->db->where('agents.agentId', $id);
		$this->db->order_by('agents.agentId', 'DESC');
		return $this->db->get()->result();
	}
	public function totalAgentBookings($agentId) {
        $query = $this->db->select('COUNT(*) AS total_bookings')
            ->select('SUM(bookingStatus = 1) AS activeBookings')
            ->select('SUM(bookingStatus = 0) AS inactiveBookings')
            ->from('bookings')
            ->where('agentID', $agentId)
            ->get();
        return $query->row_array();
    }

	// ---------------------------- Insert Records ------------------------------------

	public function add_agent($data){
		$this->db->insert('agents', $data);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
}
