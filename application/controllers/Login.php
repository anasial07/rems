<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('login_model'));
	}
	public function index(){
		if($this->session->userdata('userId')){
			redirect('dashboard');
		}
		$data['title'] = 'Dashboard | REMS';
		$this->load->view('login/sign-in', $data);
	}
	public function signin(){
		$useremail = $this->input->post('useremail');
      	$password = sha1($this->input->post('userPass'));
		$this->form_validation->set_rules('useremail', 'Email', 'required');
		$this->form_validation->set_rules('userPass', 'Password', 'required');
		if($this->form_validation->run() == TRUE){
			$user_signin = $this->login_model->signin($useremail, $password);
			if($user_signin > '0'){
				$userId = $user_signin->userId;
				$role = $user_signin->role;
				$this->session->set_userdata(array('userId' => $userId, 'role' => $role));
				// $otp = rand(100000, 999999);
				// $this->db->query("UPDATE users SET otp = $otp WHERE email='$email'");

				redirect('dashboard');

				// $this->load->library('email'); // Loading the email library.
				// $this->email->from('no-reply@realtorspk.com', 'Realtors PK');
				// $this->email->to($email);
				// $this->email->subject('Security code');
				// $this->email->message("Your verification code is " .$otp.". Share with none in order to stay secure.");
				// $this->email->send();

			}else{
				$this->session->set_flashdata('failed', 'Incorrect username or password, please retry!');
				return redirect('login', 'refresh');
			}
		}else{
			return redirect('login', 'refresh');
		}
	}
	public function welcome(){
		$this->load->view('login/welcome');
	}
	public function signout(){
		$this->session->sess_destroy();
		redirect('');
	}
}
