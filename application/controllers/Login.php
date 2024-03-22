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
		$this->form_validation->set_rules('useremail', 'Email', 'required|trim|valid_email|callback_check_email');
		$this->form_validation->set_rules('userPass', 'Password', 'trim|required');
		if($this->form_validation->run() == TRUE){
			$user_signin = $this->login_model->signin($useremail, $password);
			if($user_signin > '0'){
				$email = $user_signin->userEmail;
				$this->session->set_userdata(array('email' => $email));
				$otp = rand(100000, 999999);
				$this->db->query("UPDATE users SET otp = $otp WHERE userEmail='$email'");
				$this->auth();
				// $this->load->library('email'); // Loading the email library.
				// $this->email->from('no-reply@realtorspk.com', 'Realtors PK');
				// $this->email->to($email);
				// $this->email->subject('Security code');
				// $this->email->message("Your verification code is " .$otp.". Share with none in order to stay secure.");
				// $this->email->send();
			}else{
				$this->session->set_flashdata('failed', 'Incorrect email or password, please retry!');
				return redirect('login', 'refresh');
			}
		}else{
			$this->session->set_flashdata('failed', 'Please enter your official email address.');
			return redirect('login', 'refresh');
		}
	}
	public function check_email($email){
        if(stristr($email, '@ahgroup-pk.com') !== false) return true;
        if(stristr($email, '@s2smark.com') !== false) return true;
        if(stristr($email, '@realtorspk.com') !== false) return true;
    }
	public function auth(){
		if($this->session->userdata('email')){
			$data['title'] = 'Authentication | REMS';
			$this->load->view('login/verify-otp', $data);
		}else{
			return redirect('login', 'refresh');
		}
	}
	public function loginMe(){
		$inputCode = $this->input->post('verify_otp');
		$email=$this->session->userdata('email');
      	$auth = $this->login_model->verifyCode($email, $inputCode);
		if($auth > '0'){
			$id = $auth->userId;
			$role = $auth->role;
			$empName = $auth->empName;
			$empCity = $auth->locCode;
			$view=$this->session->set_userdata(array('userId' => $id, 'role' => $role, 'username' => $empName, 'empCity' => $empCity));
			$data = array('lastLogin' => date('Y-m-d H:i:s'));
			$this->login_model->update_last_login($id, $data);
			redirect('dashboard');
		}else{
			$this->session->set_flashdata('failed', "<strong>Oops! </strong>This isn't the OTP we sent you.");
			return redirect('login/auth');
		}
	}
	public function deactivate_account(){
		if($return = $this->login_model->delete_user()){
			if($return == true){
				$this->session->sess_destroy();
				echo true;
			}
		}else{
			echo false;
		}
	}
	public function reset_password(){
		$email = $this->input->post('email');
		$findEmail = $this->login_model->forgot_password($email);
		if($findEmail > 0){
			$plainPassword = sha1(rand(000000, 999999));
			$data = array('password' => $plainPassword);
			$this->login_model->reset_password($email, $data);
			// $this->load->library('email');
			// $this->email->from('no-reply@ahgroup-pk.com', 'AH Group');
			// $this->email->to($email->userEmail);
			// $this->email->cc('another@another-example.com');
			// $this->email->bcc('them@their-example.com');
			// $this->email->subject('Password Reset');
			// $this->email->message("Your password is " .$plainPassword.". You can change it by logging in to the system using this password.");
			// $this->email->send();
			echo json_encode(1);
		} else {
			echo json_encode(0);
		}
	}
	public function signout(){
		$this->session->sess_destroy();
		redirect('');
	}
}
