<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model(array('dashboard_model','booking_model'));
		$this->load->library('pdf');
		if(!$this->session->userdata('userId')){
			redirect('');
		}
	}
	public function index(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'bookings/view-bookings';
		$data['bookings'] = $this->booking_model->getBookings();
		$this->load->view('components/template', $data);
	}
	public function addInstallment(){
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'bookings/add-installment';
		$data['projects'] = $this->dashboard_model->activeProjects();
		$data['banks'] = $this->dashboard_model->activeBanks();
		$data['cities'] = $this->dashboard_model->activeCities();
		$this->load->view('components/template', $data);
	}
	public function bookingDetail($id){	// Get Complete Info of Booking
		$bookingID=base_convert($id, 36, 10);
		$data['title'] = 'Dashboard | REMS';
		$data['body'] = 'bookings/booking-detail';
		$data['info'] = $this->booking_model->getBookings($bookingID);
		$data['installments'] = $this->booking_model->getInstallments($bookingID);
		$this->load->view('components/template', $data);
	}
	public function getCustomers($id){	// Get Customers Against Project ID
		$data = $this->booking_model->filterCustomers($id);
		echo json_encode($data);
	}
	public function getMyBooking($id){	// Get Bookings Against Customer ID
		$data = $this->booking_model->filterBookings($id);
		echo json_encode($data);
	}
	public function getBooking($id){	// Get Booking info
		$data = $this->booking_model->getBookings($id);
		echo json_encode($data);
	}
	public function getBookingByCNIC($id){	// Get Booking info By CNIC
		$data = $this->booking_model->filterBookingByCNIC($id);
		echo json_encode($data);
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
		$projCode=$this->input->post('projectCode');
		$typeSize=$this->input->post('typeSize');
		$custmID=$this->input->post('customerID');
		$purchaseDate = $this->input->post('purchaseDate');
		$year=date('Y', strtotime($purchaseDate));

		$total_bookings=0;
		$this->db->select('COUNT(bookingId) as total_bookings');
		$query = $this->db->from('bookings')->get();
		$result = $query->row();
		$totalBookings = $result->total_bookings;
		$total_bookings = $totalBookings++; 

		if($totalBookings<10){ $totalBookings = "000".$totalBookings; }
		else if($totalBookings<100){ $totalBookings = "00".$totalBookings; }
		else if($totalBookings<1000){ $totalBookings = "0".$totalBookings; }
		else if($totalBookings<1000){ $totalBookings = $totalBookings; }

		$result = '';
		$romanNumerals = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);

		foreach ($romanNumerals as $roman => $value) {
			$matches = intval($typeSize / $value);
			$result .= str_repeat($roman, $matches);
			$typeSize = $typeSize % $value;
		}

		$memberShip=$projCode."/".$result."/".$totalBookings."/".$year;

		$payMode=$this->input->post('paymentMode');
		if($payMode=='Cash'){
			$refrence=0;
			$bankName='';
		}else{
			$refrence=$this->input->post('referenceNo');
			$bankName=$this->input->post('bank_name');
		}
		$features = !empty($this->input->post('features')) ? implode(',', $this->input->post('features')) : '';
		$data = array(
			'projID' => $this->input->post('projID'),
			'catID' => $this->input->post('catID'),
			'subCatID' => $this->input->post('subCatID'),
			'typeID' => $this->input->post('typeID'),
			'customerID' => $this->input->post('customerID'),
			'cityID' => $this->input->post('cityID'),
			'agentID' => $this->input->post('agentID'),
			'sepDiscount' => $this->input->post('sepDiscount'),
			'bookingAmount' => $this->input->post('paidAmount'),
			'bookingMode' => $payMode,
			'bookingReferenceNo' => $refrence,
			'bookBankId' => $bankName,
			'bookReceivedIn' => $this->input->post('receivedIn'),
			'payPlanID' => $this->input->post('payPlanID'),
			'exCharges' => $this->input->post('exCharges'),
			'purchaseDate' => $this->input->post('purchaseDate'),
			'bookFilerStatus' => $this->input->post('filerStatus'),
			'bookFilerPercent' => $this->input->post('filerPercent'),
			'featuresPercent' => $this->input->post('featuresPercent'),
			'features' => $features,
			'membershipNo' => $memberShip,
			'bookAddedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('projID', 'Select Project', 'required');
		$this->form_validation->set_rules('catID', 'Select Category', 'required');
		$this->form_validation->set_rules('subCatID', 'Select Sub-Category', 'required');
		$this->form_validation->set_rules('typeID', 'Select Type', 'required');
		$this->form_validation->set_rules('customerID', 'Enter Customer CNIC', 'required');
		$this->form_validation->set_rules('cityID', 'Select City', 'required');
		$this->form_validation->set_rules('agentID', 'Select Agent', 'required');
		$this->form_validation->set_rules('paidAmount', 'Enter Paid Amount', 'required');
		$this->form_validation->set_rules('paymentMode', 'Select Payment Mode', 'required');
		$this->form_validation->set_rules('receivedIn', 'Select City', 'required');
		$this->form_validation->set_rules('payPlanID', 'Select Payment Plan', 'required');
		$this->form_validation->set_rules('purchaseDate', 'Enter Purchase Date', 'required');
		if($payMode!='Cash'){
			$this->form_validation->set_rules('referenceNo', 'Enter Reference No', 'required');
			$this->form_validation->set_rules('bank_name', 'Select Bank', 'required');
		}
		if($this->form_validation->run() == TRUE){
			if($this->booking_model->saveBooking($data)){
				echo $memberShip;
			}
		}
	}
	public function saveInstallment(){	// Add Installment
		$payMode=$this->input->post('paymentMode');
		if($payMode=='Cash'){
			$bankName='';
			$refrence=0;
		}else{
			$bankName=$this->input->post('bank_name');
			$refrence=$this->input->post('refrncNo');
		}
		$data = array(
			'bookingId' => $this->input->post('bookingID'),
			'installAmount' => $this->input->post('recvAmount'),
			'installPayMode' => $payMode,
			'installBankId' => $bankName,
			'installReferenceNo' => $refrence,
			'installReceivedIn' => $this->input->post('recvCity'),
			'installReceivedDate' => $this->input->post('recvDate'),
			'InstallFilerStatus' => $this->input->post('filerStatus'),
			'installFilerPercent' => $this->input->post('filerPercent'),
			'installAddedBy' => $this->session->userdata('userId')
		);
		$this->form_validation->set_rules('bookingID', 'Select Booking', 'required');
		$this->form_validation->set_rules('recvAmount', 'Enter Amount', 'required');
		$this->form_validation->set_rules('paymentMode', 'Select Payment Mode', 'required');
		$this->form_validation->set_rules('recvCity', 'Select Location', 'required');
		$this->form_validation->set_rules('recvDate', 'Enter Date', 'required');
		$this->form_validation->set_rules('filerStatus', 'Select Filer Status', 'required');
		$this->form_validation->set_rules('filerPercent', 'Enter Filer Percentage', 'required');
		
		if($payMode!='Cash'){
			$this->form_validation->set_rules('refrncNo', 'Enter Reference No', 'required');
			$this->form_validation->set_rules('bank_name', 'Select Bank', 'required');
		}
		if($this->form_validation->run() == TRUE){
			if($this->booking_model->submitInstallment($data)){
				echo true;
			}else{
				echo false;
			}
		}
	}





	// ------------------------------- Generate PDF Files -------------------------------
	public function generateBookingMemo() {
        $pdf = new Pdf();
		$pdf->SetMargins(7, 7, 7, 7);
        $pdf->AddPage('A4');
        $pdf->SetFont('', 'B', 14);
        $logo = base_url('uploads/letterHead/ahcity.png');

		$pdf->writeHTMLCell(40, 5, 5, 5, '<img src="' . $logo . '">', 0, 0, false, false, '');
		$pdf->cell(120, 6, 'AH City Pvt, Ltd', 0, 0, 'C');

        $pdf->SetFont('', '', 10);
		$pdf->cell(40, 3, 'info@ahgroup-pk.com', 0, 1, 'R');

		$pdf->cell(38, 5, '', 0, 0, '');
		$pdf->cell(120, 10, '(A Project of AH Group)', 0, 0, 'C');
		$pdf->cell(40, 3, 'www.ahgroup-pk.com', 0, 1, 'R');
		$pdf->Ln(20);
		
        $pdf->SetFont('', 'B', 13);
		$pdf->cell(197, 6, 'File Issuance Memo', 0, 1, 'C');
		$pdf->Ln(12);

        $pdf->SetFont('', 'B', 10);
		$pdf->cell(38, 5, 'To:', 0, 0, '');
		$pdf->cell(160, 5, 'Management', 0, 1, '');
		$pdf->cell(38, 5, 'From:', 0, 0, '');
		$pdf->cell(160, 5, 'Client Care Department', 0, 1, '');
		$pdf->cell(38, 5, 'CC:', 0, 0, '');
		$pdf->cell(160, 5, 'Finance Department', 0, 1, '');
		$pdf->cell(38, 5, 'Dated:', 0, 0, '');
		$pdf->cell(160, 5, date('F d, Y'), 0, 1, '');
		$pdf->Line(8, 72, 203, 72);
        $pdf->SetFont('', '', 10);
		$pdf->cell(197, 7, 'File may be issued as per the following detail please:-', 0, 1, '');
		$pdf->Ln(5);
		
		$pdf->cell(38, 6, 'Customer Name:', 0, 0, '');
		$pdf->cell(160, 6, 'Saima', 0, 1, '');
		$pdf->cell(38, 6, 'File No:', 0, 0, '');
		$pdf->cell(160, 6, 'AHC/V/00083/2022', 0, 1, '');
		$pdf->cell(38, 6, 'Booking Date:', 0, 0, '');
		$pdf->cell(160, 6, date('F d, Y'), 0, 1, '');
		$pdf->cell(38, 6, 'Property Size:', 0, 0, '');
		$pdf->cell(160, 6, '5 Marla', 0, 1, '');
		$pdf->cell(38, 6, 'Property Type:', 0, 0, '');
		$pdf->cell(160, 6, 'Residential', 0, 1, '');
		$pdf->cell(38, 6, 'Net Price:', 0, 0, '');
		$pdf->cell(160, 6, '2,000,000', 0, 1, '');
		$pdf->cell(38, 6, 'Discounted Price:', 0, 0, '');
		$pdf->cell(160, 6, '1,000,000', 0, 1, '');
		$pdf->cell(38, 6, 'Sale Price:', 0, 0, '');
		$pdf->cell(160, 6, '1,000,000', 0, 1, '');
		$pdf->cell(38, 6, 'Per Marla Price:', 0, 0, '');
		$pdf->cell(160, 6, '2,000,000', 0, 1, '');
		$pdf->cell(38, 6, 'Amount Received:', 0, 0, '');
		$pdf->cell(40, 6, '250,0000', 0, 0, '');
        $pdf->SetFont('', 'I', 10);
		$pdf->cell(20, 6, '25%', 0, 0, 'C');
		$pdf->cell(100, 6, '(Booking and Confirmation)', 0, 1, '');
        $pdf->SetFont('', '', 10);
		
		$pdf->cell(38, 6, 'Inword:', 0, 0, '');
		$pdf->cell(160, 6, 'Two Hundred Fifty Thousand Rupee Only', 0, 1, '');
		
		$pdf->cell(38, 6, 'Payment Mode:', 0, 0, '');
		$pdf->cell(160, 6, 'Cash', 0, 1, '');
		$pdf->cell(38, 6, 'Receivable:', 0, 0, '');
		$pdf->cell(160, 6, '750,000', 0, 1, '');
		$pdf->cell(38, 6, 'Agent:', 0, 0, '');
		$pdf->cell(160, 6, 'Muhammad Imad', 0, 1, '');
		$pdf->cell(38, 6, 'Region:', 0, 0, '');
		$pdf->cell(160, 6, 'Peshawar', 0, 1, '');
		$pdf->Ln(30);
		
		$pdf->cell(40, 6, 'Prepared by:', 0, 0, '');
		$pdf->cell(40, 6, '______________________');
		$pdf->cell(30, 6, '', '');
		$pdf->cell(40, 6, 'Checked by:', 0, 0, '');
		$pdf->cell(40, 6, '______________________',0, 1);
		$pdf->Ln(10);
		
		$pdf->cell(40, 6, 'Recovery Section:', 0, 0, '');
		$pdf->cell(40, 6, '______________________');
		$pdf->cell(30, 6, '', '');
		$pdf->cell(40, 6, 'Finance Deptt:', 0, 0, '');
		$pdf->cell(40, 6, '______________________',0, 1);
		$pdf->Ln(10);
		
		$pdf->cell(40, 6, 'Approved by:', 0, 0, '');
		$pdf->cell(40, 6, '______________________');
		$pdf->cell(30, 6, '', '');
		$pdf->cell(40, 6, 'Dated:', 0, 0, '');
		$pdf->cell(40, 6, '______________________',0, 1);
		
        $pdf->Output();
    }

	public function generateWelcomeLetter(){
		$pdf = new Pdf();
		$pdf->SetMargins(7, 7, 7, 7);
        $pdf->AddPage('A4');
        $pdf->SetFont('', 'B', 14);
        $logo = base_url('uploads/letterHead/ahcity.png');

		$pdf->writeHTMLCell(40, 5, 5, 5, '<img src="' . $logo . '">', 0, 0, false, false, '');
		$pdf->cell(120, 6, 'AH City Pvt, Ltd', 0, 0, 'C');

        $pdf->SetFont('', '', 10);
		$pdf->cell(40, 3, 'info@ahgroup-pk.com', 0, 1, 'R');

		$pdf->cell(38, 5, '');
		$pdf->cell(120, 10, '(A Project of AH Group)', 0, 0, 'C');
		$pdf->cell(40, 3, 'www.ahgroup-pk.com', 0, 1, 'R');
		$pdf->Ln(20);
		
        $pdf->SetFont('', 'B', 13);
		$pdf->cell(197, 6, 'Confirmation Letter', 0, 1, 'C');
		$pdf->Ln(20);
		
        $pdf->SetFont('', '', 12);
		$pdf->cell(99, 5, 'Ref: AHC/V/00082/2022');
		$pdf->cell(99, 5, date('F d, Y'), 0, 1, 'R');
		$pdf->Ln(5);
		
		$pdf->cell(99, 5, 'Customer Name', 1);
		$pdf->cell(99, 5, 'Fayaz Ahmad', 1, 1);
		$pdf->cell(99, 5, "Father's/Spouse Name", 1);
		$pdf->cell(99, 5, 'Abdul Razaq', 1, 1);
		$pdf->cell(99, 5, "CNIC/NICOP", 1);
		$pdf->cell(99, 5, '4250194117239', 1, 1);
		$pdf->cell(99, 5, "Membership No", 1);
		$pdf->cell(99, 5, 'AHC/V/00082/2022', 1, 1);
		$pdf->cell(99, 5, "Plot Type", 1);
		$pdf->cell(99, 5, 'Residential', 1, 1);
		$pdf->cell(99, 5, "Plot Size", 1);
		$pdf->cell(99, 5, '5 Marla', 1, 1);
		$pdf->cell(99, 5, "Dimenssion", 1);
		$pdf->cell(99, 5, '25 X 50', 1, 1);
		$pdf->Ln(5);

        $pdf->SetFont('', 'B', 12);
		$pdf->cell(198, 5, 'Respected Sir/Madam,', 0, 1);
        $pdf->SetFont('', '', 12);
		$pdf->Ln(2);
		
		$pdf->MultiCell(197, 5, 'The Management of AH City (Pvt) Ltd welcomes you in its prestigious housing project. Your Booking Application Form has been accepted and a  plot of the above-mentioned category in AH City (Pvt) Ltd, has been booked in your name under the above "Membership Number" subject to the terms & conditions overleaf at Booking Application Form. The above "Membership Number" will only be used as a reference, however, the exact location of Plot and Street number etc will be provided after the ballot.', 0, 1);
		$pdf->Ln(3);
		$pdf->MultiCell(197, 5, 'You are requested to make the remaining payments through Cash/PO/Bank Draft in favor of AH City (Pvt) Ltd within the prescribed dates according to the decide schedule attached to avoid any surcharges at a later stage. This booking is not transferable unless/until authorized by the AH Management.', 0, 1);
		$pdf->Ln(3);
		$pdf->MultiCell(197, 5, 'We are committed to deliver the project in time, maintain Gold Standards all through the infrastructure developments and project management.', 0, 1);
        $pdf->Ln(3);
		$pdf->MultiCell(197, 5, 'Thanking you in anticipation and assuring you our best services.', 0, 1);
		$pdf->Ln(3);
		$pdf->MultiCell(197, 5, 'With Profound Regards,', 0, 1);

		$pdf->Output();
	}
}
