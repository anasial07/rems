<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {
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
		$this->load->view('components/template', $data);
	}
}
