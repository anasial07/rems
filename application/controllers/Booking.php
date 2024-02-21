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
		$typeSizeCheck=$typeSize;
		$custmID=$this->input->post('customerID');
		$purchaseDate = $this->input->post('purchaseDate');
		$typeAmount = $this->input->post('typeAmount');
		$sepDiscount = ($this->input->post('sepDiscount')=="") ? 0 : $this->input->post('sepDiscount');
		$exCharges = ($this->input->post('exCharges')=="") ? 0 : $this->input->post('exCharges');
		$featuresPercent = ($this->input->post('featuresPercent')=="") ? 0 : $this->input->post('featuresPercent');
		$year=date('Y', strtotime($purchaseDate));

		$subtotal=$typeAmount - ($typeAmount * ($sepDiscount / 100));
		$total=$subtotal - $exCharges;
		$salePrice=$total - ($total * ($featuresPercent / 100));

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
		$result=$result;
		if (strpos($typeSizeCheck, '.') == true) {
			$result=$result.'S';
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
		$features = !empty($this->input->post('features')) ? implode(',', $this->input->post('features')) : 0;
		$data = array(
			'projID' => $this->input->post('projID'),
			'catID' => $this->input->post('catID'),
			'subCatID' => $this->input->post('subCatID'),
			'typeID' => $this->input->post('typeID'),
			'customerID' => $this->input->post('customerID'),
			'cityID' => $this->input->post('cityID'),
			'agentID' => $this->input->post('agentID'),
			'sepDiscount' => $sepDiscount,
			'bookingAmount' => $this->input->post('paidAmount'),
			'bookingMode' => $payMode,
			'bookingReferenceNo' => $refrence,
			'bookBankId' => $bankName,
			'bookReceivedIn' => $this->input->post('receivedIn'),
			'payPlanID' => $this->input->post('payPlanID'),
			'exCharges' => $exCharges,
			'salePrice' => $salePrice,
			'purchaseDate' => $this->input->post('purchaseDate'),
			'bookFilerStatus' => $this->input->post('filerStatus'),
			'bookFilerPercent' => $this->input->post('filerPercent'),
			'featuresPercent' => $featuresPercent,
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
	public function generateBookingMemo($id){
		$bookingID=base_convert($id, 36, 10);
		$info = $this->booking_model->getBookings($bookingID);
        $pdf = new Pdf();
		$pdf->SetMargins(7, 7, 7, 7);
        $pdf->AddPage('A4');
        $pdf->SetFont('', 'B', 14);
		$pdf->SetTitle('File Issuance Memo - '.$info[0]->membershipNo);
        $logo = base_url('uploads/letterHead/'.$info[0]->projLogo);

		$pdf->writeHTMLCell(40, 5, 5, 5, '<img src="' . $logo . '">', 0, 0, false, false, '');
		$pdf->cell(120, 6, $info[0]->projName, 0, 0, 'C');

        $pdf->SetFont('', '', 10);
		$pdf->cell(40, 3, $info[0]->mailAddress, 0, 1, 'R');

		$pdf->cell(38, 5, '', 0, 0, '');
		$pdf->cell(120, 10, '(A Project of AH Group)', 0, 0, 'C');
		$pdf->cell(40, 3, $info[0]->webAddress, 0, 1, 'R');
		$pdf->Ln(20);
		
        $pdf->SetFont('', 'B', 13);
		$pdf->cell(197, 6, 'File Issuance Memo', 0, 1, 'C');
		$pdf->Ln(12);

        $pdf->SetFont('', 'B', 11);
		$pdf->cell(38, 5, 'To:', 0, 0, '');
		$pdf->cell(160, 5, 'Management', 0, 1, '');
		$pdf->cell(38, 5, 'From:', 0, 0, '');
		$pdf->cell(160, 5, 'Client Care Department', 0, 1, '');
		$pdf->cell(38, 5, 'CC:', 0, 0, '');
		$pdf->cell(160, 5, 'Finance Department', 0, 1, '');
		$pdf->cell(38, 5, 'Dated:', 0, 0, '');
		$pdf->cell(160, 5, date('F d, Y'), 0, 1, '');
		$pdf->Line(8, 72.5, 203, 72.5);
        $pdf->SetFont('', '', 11);
		$pdf->cell(197, 7, 'File may be issued as per the following detail please:-', 0, 1, '');
		$pdf->Ln(5);
		
		$pdf->cell(38, 6, 'Customer Name:', 0, 0, '');
		$pdf->cell(160, 6, $info[0]->custmName, 0, 1, '');
		$pdf->cell(38, 6, 'File No:', 0, 0, '');
		$pdf->cell(160, 6, $info[0]->membershipNo, 0, 1, '');
		$pdf->cell(38, 6, 'Booking Date:', 0, 0, '');
		$pdf->cell(160, 6, date('F d, Y',strtotime($info[0]->purchaseDate)), 0, 1, '');
		$pdf->cell(38, 6, 'Property Size:', 0, 0, '');
		$pdf->cell(160, 6, $info[0]->typeName, 0, 1, '');
		$pdf->cell(38, 6, 'Property Type:', 0, 0, '');
		$pdf->cell(160, 6, $info[0]->catName, 0, 1, '');
		$pdf->cell(38, 6, 'Net Price:', 0, 0, '');
		$pdf->cell(160, 6, '------------', 0, 1, '');
		$pdf->cell(38, 6, 'Discounted Price:', 0, 0, '');
		$pdf->cell(160, 6, '------------', 0, 1, '');
		$pdf->cell(38, 6, 'Sale Price:', 0, 0, '');
		$pdf->cell(160, 6, '------------', 0, 1, '');
		$pdf->cell(38, 6, 'Per Marla Price:', 0, 0, '');
		$pdf->cell(160, 6, number_format($info[0]->perMarla), 0, 1, '');
		$pdf->cell(38, 6, 'Amount Received:', 0, 0, '');
		$pdf->cell(40, 6, '------------', 0, 0, '');
        $pdf->SetFont('', 'I', 10);
		$pdf->cell(20, 6, '25%', 1, 0, 'C');
		$pdf->cell(100, 6, '(Booking and Confirmation)', 1, 1, '');
        $pdf->SetFont('', '', 10);
		
		$pdf->cell(38, 6, 'Inword:', 0, 0, '');
		$pdf->cell(160, 6, 'Two Hundred Fifty Thousand Rupee Only', 1, 1, '');
		
		$pdf->cell(38, 6, 'Payment Mode:', 0, 0, '');
		$pdf->cell(160, 6, $info[0]->bookingMode, 0, 1, '');
		$pdf->cell(38, 6, 'Receivable:', 0, 0, '');
		$pdf->cell(160, 6, '------------', 0, 1, '');
		$pdf->cell(38, 6, 'Agent:', 0, 0, '');
		$pdf->cell(160, 6, $info[0]->agentName, 0, 1, '');
		$pdf->cell(38, 6, 'Region:', 0, 0, '');
		$pdf->cell(160, 6, $info[0]->locName, 0, 1, '');
		$pdf->Ln(30);
		
		$pdf->cell(40, 6, 'Prepared by:', 0, 0, '');
		$pdf->cell(40, 6, '______________________');
		$pdf->cell(30, 6, '', '');
		$pdf->cell(40, 6, 'Verified by:', 0, 0, '');
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

	public function generateWelcomeLetter($id){
		$bookingID=base_convert($id, 36, 10);
		$info = $this->booking_model->getBookings($bookingID);
        $pdf = new Pdf();
		$pdf->SetMargins(7, 7, 7, 7);
        $pdf->AddPage('A4');
        $pdf->SetFont('', 'B', 14);
		$pdf->SetTitle('Welcome Letter - '.$info[0]->membershipNo);
        $logo = base_url('uploads/letterHead/'.$info[0]->projLogo);

		$pdf->writeHTMLCell(40, 5, 5, 5, '<img src="' . $logo . '">', 0, 0, false, false, '');
		$pdf->cell(120, 6, $info[0]->projName, 0, 0, 'C');

        $pdf->SetFont('', '', 10);
		$pdf->cell(40, 3, $info[0]->mailAddress, 0, 1, 'R');

		$pdf->cell(38, 5, '', 0, 0, '');
		$pdf->cell(120, 10, '(A Project of AH Group)', 0, 0, 'C');
		$pdf->cell(40, 3, $info[0]->webAddress, 0, 1, 'R');
		$pdf->Ln(20);
		
        $pdf->SetFont('', 'B', 15);
		$pdf->cell(197, 6, 'Welcome', 0, 1, 'C');
        $pdf->SetFont('', '', 8);
		$pdf->cell(197, 6, 'TO', 0, 1, 'C');
        $pdf->SetFont('', 'B', 15);
		$pdf->cell(197, 6, $info[0]->projName, 0, 1, 'C');
        $pdf->SetFont('', 'U', 10);
		$pdf->cell(197, 6, 'A prestigious project by '.$info[0]->projName.', a member Company of AH Group', 0, 1, 'C');
		$pdf->Ln(13);
		
        $pdf->SetFont('', '', 12);
		$pdf->cell(99, 5, 'Ref: '.$info[0]->membershipNo);
		$pdf->cell(99, 5, date('F d, Y'), 0, 1, 'R');
		$pdf->Ln(5);
		
		$pdf->cell(99, 5, 'Customer Name', 1);
		$pdf->cell(99, 5, $info[0]->custmName, 1, 1);
		$pdf->cell(99, 5, "Father's/Spouse Name", 1);
		$pdf->cell(99, 5, $info[0]->fatherName, 1, 1);
		$pdf->cell(99, 5, "CNIC/NICOP", 1);
		$pdf->cell(99, 5, $info[0]->custmCNIC, 1, 1);
		$pdf->cell(99, 5, "Membership No", 1);
		$pdf->cell(99, 5, $info[0]->membershipNo, 1, 1);
		$pdf->cell(99, 5, "Plot Type", 1);
		$pdf->cell(99, 5, $info[0]->catName, 1, 1);
		$pdf->cell(99, 5, "Plot Size", 1);
		$pdf->cell(99, 5, $info[0]->typeName, 1, 1);
		$pdf->cell(99, 5, "Dimenssion", 1);
		$pdf->cell(99, 5, $info[0]->dimenssion, 1, 1);
		$pdf->Ln(5);

		$pdf->cell(198, 5, 'Respected: '.$info[0]->custmName.',', 0, 1);
		$pdf->Ln(5);
		
		$pdf->MultiCell(197, 5, 'The Management of '.$info[0]->projName.' welcomes you in its prestigious housing project. Your Booking Application Form has been accepted and a plot of the above-mentioned category in '.$info[0]->projName.', has been booked in your name under the above Membership Number subject to the terms & conditions overleaf at Booking Application Form. The above Membership Number will only be used as a reference, however, the exact location of Plot and Street number etc will be provided after the ballot.', 0, 'J', false);
		$pdf->Ln(3);
		$pdf->MultiCell(197, 5, 'You are requested to make the remaining payments through Cash/PO/Bank Draft in favor of '.$info[0]->projName.' within the prescribed dates according to the decide schedule attached to avoid any surcharges at a later stage. This booking is not transferable unless/until authorized by the AH Management.', 0, 'J', false);
		$pdf->Ln(3);
		$pdf->MultiCell(197, 5, 'We are committed to deliver the project in time, maintain Gold Standards all through the infrastructure developments and project management.', 0, 1);
        $pdf->Ln(3);
		$pdf->MultiCell(197, 5, 'Thanking you in anticipation and assuring you our best services.', 0, 1);
		$pdf->Ln(3);
		$pdf->MultiCell(197, 5, 'With Profound Regards,', 0, 1);
		$pdf->Ln(40);

		$pdf->cell(60, 5, '', 'B');
		$pdf->cell(78, 5, '');
		$pdf->cell(60, 5, '', 'B', 1);
		$pdf->cell(60, 5, 'For & on behalf of', 0, 0, 'C');
		$pdf->cell(78, 5, '');
		$pdf->cell(60, 5, 'Stamp', 0, 1, 'C');
		$pdf->cell(60, 5, $info[0]->projName, 0, 0, 'C');

		$pdf->Output();
	}

	public function generateConfirmationLetter($id){
		$bookingID=base_convert($id, 36, 10);
		$info = $this->booking_model->getBookings($bookingID);
        $pdf = new Pdf();
		$pdf->SetMargins(7, 7, 7, 7);
        $pdf->AddPage('A4');
        $pdf->SetFont('', 'B', 14);
		$pdf->SetTitle('Confirmation Letter - '.$info[0]->membershipNo);
        $logo = base_url('uploads/letterHead/'.$info[0]->projLogo);

		$pdf->writeHTMLCell(40, 5, 5, 5, '<img src="' . $logo . '">', 0, 0, false, false, '');
		$pdf->cell(120, 6, $info[0]->projName, 0, 0, 'C');

        $pdf->SetFont('', '', 10);
		$pdf->cell(40, 3, $info[0]->mailAddress, 0, 1, 'R');

		$pdf->cell(38, 5, '', 0, 0, '');
		$pdf->cell(120, 10, '(A Project of AH Group)', 0, 0, 'C');
		$pdf->cell(40, 3, $info[0]->webAddress, 0, 1, 'R');
		$pdf->Ln(20);
		
        $pdf->SetFont('', 'B', 15);
		$pdf->cell(197, 6, 'CONFIRMATION LETTER', 0, 1, 'C');
		$pdf->Ln(20);
		
        $pdf->SetFont('', '', 12);
		$pdf->cell(99, 5, 'Ref: '.$info[0]->membershipNo);
		$pdf->cell(99, 5, date('F d, Y'), 0, 1, 'R');
		$pdf->Ln(5);
		
		$pdf->cell(99, 5, 'Customer Name', 1);
		$pdf->cell(99, 5, $info[0]->custmName, 1, 1);
		$pdf->cell(99, 5, "Father's/Spouse Name", 1);
		$pdf->cell(99, 5, $info[0]->fatherName, 1, 1);
		$pdf->cell(99, 5, "CNIC/NICOP", 1);
		$pdf->cell(99, 5, $info[0]->custmCNIC, 1, 1);
		$pdf->cell(99, 5, "Membership No", 1);
		$pdf->cell(99, 5, $info[0]->membershipNo, 1, 1);
		$pdf->cell(99, 5, "Plot Type", 1);
		$pdf->cell(99, 5, $info[0]->catName, 1, 1);
		$pdf->cell(99, 5, "Plot Size", 1);
		$pdf->cell(99, 5, $info[0]->typeName, 1, 1);
		$pdf->cell(99, 5, "Dimenssion", 1);
		$pdf->cell(99, 5, $info[0]->dimenssion, 1, 1);
		$pdf->Ln(6);
		
		$pdf->cell(197, 5, 'Respected Sir/Madam', 0, 1);
		$pdf->Ln(3);

		$pdf->MultiCell(197, 5, 'The management of '.$info[0]->projName.' is pleased to inform you that your membership is CONFIRMED with the company and you will be issued an allocation letter after ballot of your plot.', 0, 'J', false);
		$pdf->MultiCell(197, 5, 'The  payment plan of  the plot file you  have got confirmed is pertains to the cost of land only which you have to follow for a period of '.$info[0]->planYears.' years, however, schedule of development charges shall be shared with you after the ballot and development work starts.', 0, 1);
		$pdf->MultiCell(197, 5, 'We wish you all the very best and expect a prosper, peaceful journey with our company.', 0, 1);
		$pdf->Ln(2);
		$pdf->MultiCell(197, 5, 'With Profound Regards!', 0, 1);
		$pdf->Ln(40);

		$pdf->cell(60, 5, '', 'B');
		$pdf->cell(78, 5, '');
		$pdf->cell(60, 5, '', 'B', 1);
		$pdf->cell(60, 5, 'For & on behalf of', 0, 0, 'C');
		$pdf->cell(78, 5, '');
		$pdf->cell(60, 5, 'Stamp', 0, 1, 'C');
		$pdf->cell(60, 5, $info[0]->projName, 0, 0, 'C');

		$pdf->Output();
	}
	
	public function generateBookingReceipt($id){
		$bookingID=base_convert($id, 36, 10);
		$receipt = $this->input->get('receipt');
		if($receipt=='booking'){
			$info = $this->booking_model->getBookings($bookingID);
		}
        $pdf = new Pdf();
		$pdf->SetMargins(7, 7, 7, 7);
        $pdf->AddPage('A4');
        $pdf->SetFont('', 'B', 14);
		$pdf->SetTitle(ucfirst($receipt).' Receipt - '.$info[0]->membershipNo);
        $logo = base_url('uploads/letterHead/'.$info[0]->projLogo);

		$pdf->writeHTMLCell(40, 5, 5, 5, '<img src="' . $logo . '">', 0, 0, false, false, '');
		$pdf->cell(120, 6, $info[0]->projName, 0, 0, 'C');

        $pdf->SetFont('', '', 10);
		$pdf->cell(40, 3, $info[0]->mailAddress, 0, 1, 'R');

		$pdf->cell(38, 5, '', 0, 0, '');
		$pdf->cell(120, 10, '(A Project of AH Group)', 0, 0, 'C');
		$pdf->cell(40, 3, $info[0]->webAddress, 0, 1, 'R');
		$pdf->Ln(20);
		
        $pdf->SetFont('', 'B', 15);
		$pdf->cell(197, 6, 'PAYMENT RECEIPT', 0, 1, 'C');
		$pdf->Ln(20);

		$recpNo=$info[0]->bookingId;
		if($recpNo<10){ $recpNo="0000".$recpNo; }
		else if($recpNo<100){ $recpNo="000".$recpNo; }
		else if($recpNo<1000){ $recpNo="00".$recpNo; }
		else if($recpNo<10000){ $recpNo="0".$recpNo; }
		else if($recpNo<100000){ $recpNo=$recpNo; }

        $pdf->SetFont('', 'B', 11);
		$pdf->cell(50, 6, 'Voucher Number:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(50, 6, 'RV-'.$info[0]->projCode.'-'.$recpNo,'B');
		$pdf->cell(22, 6, '');
        $pdf->SetFont('', 'B', 11);
		$pdf->cell(25, 6, 'Dated:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(50, 6, date('M d, Y',strtotime($info[0]->purchaseDate)),'B', 1);
		$pdf->cell(197, 10, 'We are hereby acknowledged for and on behalf of '.$info[0]->projName.', that we have received', 0, 1);
		
        $pdf->SetFont('', '', 11);
		$pdf->cell(50, 6, 'Received with thanks from:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(147, 6, $info[0]->custmName,'B', 1);
		$pdf->Ln(3);
		
        $pdf->SetFont('', 'B', 11);
		$pdf->cell(50, 7, 'Membership No:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(50, 7, $info[0]->membershipNo,'B');
		$pdf->cell(22, 7, '');
        $pdf->SetFont('', 'B', 11);
		$pdf->cell(25, 7, 'CNIC No:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(50, 7, $info[0]->custmCNIC,'B', 1);
		
		$agentName = $info[0]->agentName;
		if(strlen($agentName)>20){ $agentName = substr($agentName,0,20).'...'; }
        $pdf->SetFont('', 'B', 11);
		$pdf->cell(50, 7, 'Agent Name:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(50, 7, $agentName,'B');
		$pdf->cell(22, 7, '');
        $pdf->SetFont('', 'B', 11);
		$pdf->cell(25, 7, 'Mobile:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(50, 7, $info[0]->primaryPhone,'B', 1);
		
        $pdf->SetFont('', 'B', 11);
		$pdf->cell(50, 7, 'Area Plot:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(50, 7, $info[0]->typeName,'B');
		$pdf->cell(22, 7, '');
        $pdf->SetFont('', 'B', 11);
		$pdf->cell(25, 7, 'Dimesion:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(50, 7, $info[0]->dimenssion,'B', 1);
		$pdf->Ln(7);
		
        $pdf->SetFont('', 'B', 11);
		$pdf->cell(50, 7, 'Mode of Payment:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(50, 7, $info[0]->bookingMode,'B', 1);
		
        $pdf->SetFont('', 'B', 11);
		$pdf->cell(50, 7, 'Amount Received:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(50, 7, number_format($info[0]->bookingAmount),'B', 1);
		
		function numberToWords($number) {
			$words=array('Zero', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eeight', 'Nine');
			$teenWords=array('Ten', 'Eleven', 'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen');
			$tensWords=array('Twenty', 'Thirty', 'Forty', 'Fifty', 'Sixty', 'Seventy', 'Eighty', 'Ninety');
			$scaleNames=array('', 'Thousand', 'Million', 'Billion', 'Trillion');
			$scaleIndex = 0;
			if($number < 10){
				return $words[$number];
			}elseif($number < 20){
				return $teenWords[$number - 10];
			}elseif($number < 100){
				return $tensWords[($number / 10) - 2] . (($number % 10 !== 0) ? ' ' . numberToWords($number % 10) : '');
			}elseif($number < 1000){
				return $words[floor($number / 100)] . ' Hundred' . (($number % 100 !== 0) ? ' and ' . numberToWords($number % 100) : '');
			}else{
				while ($number >= 1000) {
					$number /= 1000;
					$scaleIndex++;
				}
				return numberToWords($number) . ' ' . $scaleNames[$scaleIndex];
			}
		}
		$number = $info[0]->bookingAmount;

        $pdf->SetFont('', 'B', 11);
		$pdf->cell(50, 7, 'Amount in Word:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(147, 7, numberToWords($number).' Rupee Only','B', 1);
		
        $pdf->SetFont('', 'B', 11);
		$pdf->cell(12, 7, 'Note:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(147, 7, 'Government taxes will be applicable on all sales, purchases, installments, investment transfer, refund etc.', 0, 1);
		
        $pdf->SetFont('', 'B', 11);
		$pdf->cell(25, 7, 'Description:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(147, 7, ucfirst($receipt).' Received', 0, 1);
		$pdf->Ln(50);
		
        $pdf->SetFont('', 'B', 11);
		$pdf->cell(50, 7, 'Received by:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(50, 7, '______________________');
		$pdf->cell(22, 7, '');
        $pdf->SetFont('', 'B', 11);
		$pdf->cell(25, 7, 'Paid By:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(50, 7, '______________________', 0, 1);
		$pdf->Ln(8);
		
        $pdf->SetFont('', 'B', 11);
		$pdf->cell(50, 7, 'Name:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(50, 7, '______________________');
		$pdf->cell(22, 7, '');
        $pdf->SetFont('', 'B', 11);
		$pdf->cell(25, 7, 'Name:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(50, 7, '______________________', 0, 1);

		$pdf->Output();
	}
	
	public function generateBookingForm($id){
		$bookingID=base_convert($id, 36, 10);
		$info = $this->booking_model->getBookings($bookingID);
		$totalInstallAmount = $this->booking_model->totalInstallmentAmount($bookingID);
		$receivedAmount=$totalInstallAmount+$info[0]->bookingAmount;
		$receivableAmount=$info[0]->salePrice-$receivedAmount;
        $pdf = new Pdf();
		$pdf->SetMargins(7, 7, 7, 7);
		$pdf->SetAutoPageBreak(TRUE, $bottom = 0);
        $pdf->AddPage('A4');
        $pdf->SetFont('', 'B', 14);
		$pdf->SetTitle('Booking Form - '.$info[0]->membershipNo);
        $logo = base_url('uploads/letterHead/'.$info[0]->projLogo);

		$pdf->writeHTMLCell(40, 5, 5, 5, '<img src="' . $logo . '">', 0, 0, false, false, '');
		$pdf->cell(120, 6, $info[0]->projName, 0, 0, 'C');

        $pdf->SetFont('', '', 10);
		$pdf->cell(40, 3, $info[0]->mailAddress, 0, 1, 'R');

		$pdf->cell(38, 5, '', 0, 0, '');
		$pdf->cell(120, 10, '(A Project of AH Group)', 0, 0, 'C');
		$pdf->cell(40, 3, $info[0]->webAddress, 0, 1, 'R');
		$pdf->Ln(20);
		
        $bookingFont = base_url('uploads/letterHead/bookingFont.png');
		$pdf->SetXY(69, 30);
		$pdf->Image($bookingFont, $pdf->GetX(), $pdf->GetY(), 70);
		$pdf->Ln(15);

        $profile = base_url('uploads/customers/'.$info[0]->custmPic);
		$pdf->SetXY(179, 58);
		$pdf->Image($profile, $pdf->GetX(), $pdf->GetY(), 25);
		$pdf->Ln(20);

		$custmID=$info[0]->customerId;
		if($custmID < 10){ $custmID="000".$custmID; }
		else if($custmID < 100){ $custmID="00".$custmID; }
		else if($custmID < 1000){ $custmID="0".$custmID; }
		else if($custmID < 10000){ $custmID=$custmID; }

		$pdf->Ln(-21);
		$pdf->SetFont('', 'B', 11);
		$pdf->Cell(40, 6, 'Membership No');
        $pdf->SetFont('', '', 11);
		$pdf->Cell(117, 6, $info[0]->membershipNo, 0, 1);
        $pdf->SetFont('', 'B', 11);
		$pdf->Cell(40, 5, 'Customer ID');
        $pdf->SetFont('', '', 11);
		$pdf->Cell(157, 5, $custmID, 0, 1);
        $pdf->SetFont('', 'B', 11);
		$pdf->Cell(40, 5, 'Type');
        $pdf->SetFont('', '', 11);
		$pdf->Cell(157, 5, $info[0]->catName.' • '.$info[0]->subCatName, 0, 1);
        $pdf->SetFont('', 'B', 11);
		$pdf->Cell(40, 5, 'Plot Detail');
        $pdf->SetFont('', '', 11);
		$pdf->Cell(157, 5, $info[0]->typeName.' • ('.$info[0]->dimenssion.')', 0, 1);
        $pdf->SetFont('', 'B', 11);
		$pdf->Cell(40, 5, 'Booking Date');
        $pdf->SetFont('', '', 11);
		$pdf->Cell(157, 5, date('F d, Y',strtotime($info[0]->purchaseDate)), 0, 1);
		$pdf->Ln(3);
		
        $pdf->SetFont('', 'B', 11);
		$pdf->SetTextColor(255, 255, 255);
		$pdf->Cell(197, 7, 'Applicant Information', 0, 1, 'C', true);
		$pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('', '', 11);
		$pdf->Ln(5);

		$pdf->Cell(40, 7, 'Applicant Name');
		$custName = $info[0]->custmName;
		if(strlen($custName)>20){ $custName = substr($custName,0,20).'...'; }
		$pdf->Cell(53, 7, $custName, 'B');
		$pdf->Cell(10, 7, '');
		$pdf->Cell(40, 7, 'S/O, D/O, W/O');
		$DO=$info[0]->fatherName;
		if(strlen($DO)>20){ $DO = substr($DO,0,20).'...'; }
		$pdf->Cell(53, 7, $DO , 'B', 1);
		
		$pdf->Cell(40, 7, 'CNIC / Passport');
		$pdf->Cell(53, 7, $info[0]->custmCNIC, 'B');
		$pdf->Cell(10, 7, '');
		$pdf->Cell(40, 7, 'Date of Birth');
		$dob = ($info[0]->custmDOB!="") ? $info[0]->custmDOB : "";
		$pdf->Cell(53, 7, date('F d, Y',strtotime($dob)), 'B', 1);
		
		$pdf->Cell(40, 7, 'Phone');
		$pdf->Cell(53, 7, $info[0]->primaryPhone, 'B');
		$pdf->Cell(10, 7, '');
		$pdf->Cell(40, 7, 'Mobile');
		$pdf->Cell(53, 7, $info[0]->secondaryPhone, 'B', 1);
		
		$pdf->Cell(40, 7, 'Email');
		$pdf->Cell(53, 7, $info[0]->custmEmail, 'B', 1);
		
		$pdf->Cell(40, 7, 'Address');
		$pdf->Cell(157, 7, $info[0]->presentAddress, 'B', 1);
		$pdf->Cell(40, 7, '');
        $pdf->SetFont('', '', 8);
		$pdf->Cell(157, 2, '(Overseas Pakistanis need to attach the copy of foreign passport, NICOP)', 0, 1);
        $pdf->SetFont('', '', 11);
		$pdf->Ln(5);
		
        $pdf->SetFont('', 'B', 11);
		$pdf->SetTextColor(255, 255, 255);
		$pdf->Cell(197, 7, 'Next of Kin Information', 0, 1, 'C', true);
		$pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('', '', 11);
		$pdf->Ln(5);

		$pdf->Cell(40, 7, 'NOK Name');
		$nokName = $info[0]->nokName;
		if(strlen($nokName)>20){ $nokName = substr($nokName,0,20).'...'; }
		$pdf->Cell(53, 7, $nokName, 'B');
		$pdf->Cell(10, 7, '');
		$pdf->Cell(40, 7, 'CNIC / Passport');
		$pdf->Cell(53, 7, $info[0]->nokCNIC, 'B', 1);
		
		$pdf->Cell(40, 7, 'Phone');
		$pdf->Cell(53, 7, $info[0]->nokPhone, 'B');
		$pdf->Cell(10, 7, '');
		$pdf->Cell(40, 7, 'Email');
		$pdf->Cell(53, 7, $info[0]->nokEmail, 'B', 1);
		
		$pdf->Cell(40, 7, 'Relation');
		$pdf->Cell(53, 7, $info[0]->nokRelation, 'B', 1);
		$pdf->Ln(6);
		
        $pdf->SetFont('', 'B', 11);
		$pdf->SetTextColor(255, 255, 255);
		$pdf->Cell(197, 7, 'Payment Information', 0, 1, 'C', true);
		$pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('', '', 11);	
		$pdf->MultiCell(197, 7, 'I confirm that the  particulars/information given above are true to the best of my knowledge.', 0, 1);
		$pdf->Ln(3);

		$pdf->Cell(40, 7, 'Land Price');
		$pdf->Cell(53, 7, number_format($info[0]->totalPrice), 'B');
		$pdf->Cell(10, 7, '');
		$pdf->Cell(40, 7, 'Discount');
		$pdf->Cell(53, 7, $info[0]->sepDiscount.'%', 'B', 1);

		$features = ($info[0]->featuresPercent == 0) ? 'None' : $info[0]->features;
		$pdf->Cell(40, 7, 'Features ('.$info[0]->featuresPercent.'%)');
		$pdf->Cell(53, 7, $features, 'B');
		$pdf->Cell(10, 7, '');
		$pdf->Cell(40, 7, 'Sale Price');
		$pdf->Cell(53, 7, number_format($info[0]->salePrice), 'B', 1);
		
		$pdf->Cell(40, 7, 'Mode of Payment');
		$pdf->Cell(53, 7, $info[0]->bookingMode, 'B');
		$pdf->Cell(10, 7, '');
		$pdf->Cell(40, 7, 'Amount Received');
		$pdf->Cell(53, 7, number_format($receivedAmount), 'B', 1);
		
		$pdf->Cell(40, 7, 'Extra Charges');
		$pdf->Cell(53, 7, number_format($info[0]->exCharges), 'B');
		$pdf->Cell(10, 7, '');
		$pdf->Cell(40, 7, 'Receivable');
		$pdf->Cell(53, 7, number_format($receivableAmount), 'B', 1);
		$pdf->Ln(20);

		$pdf->Cell(59, 7, '', 'B');
		$pdf->Cell(10, 7, '');
		$pdf->Cell(59, 7, '', 'B');
		$pdf->Cell(10, 7, '');
		$pdf->Cell(59, 7, '', 'B', 1);

        $pdf->SetFont('', '', 9);
		$pdf->Cell(59, 7, 'Booking Officer Signature', 0, 0, 'C');
		$pdf->Cell(10, 7, '');
		$pdf->Cell(59, 7, 'Company Stamp', 0, 0, 'C');
		$pdf->Cell(10, 7, '');
		$pdf->Cell(59, 7, 'Manager CCD', 0, 1, 'C');
		$pdf->Ln(19);
		
        $pdf->SetFont('', 'B', 9);
		$pdf->Cell(19, 4, 'Head Office');
        $pdf->SetFont('', '', 9);
		$pdf->Cell(178, 4, '- Office #11 2nd floor, Umer Building,', 0, 1);
		$pdf->Cell(98, 0, 'Jinnah Avenue, Blue Area, Islamabad 440000.');
		$pdf->Cell(78, 0, $this->session->userdata('username'), 0, 1, 'R');
		$pdf->Cell(98, 0, 'Conatct Number: 0331-1110884');
		$pdf->Cell(78, 0, date('M d, Y g:i A'), 0, 1, 'R');

		$string = $info[0]->typeName.'/'.$info[0]->typeName.'/'.date('Y',strtotime($info[0]->purchaseDate)).'/'.$custmID.'/'.$info[0]->custmName.'/'.$info[0]->fatherName.'/'.$info[0]->locCode;
		$google_chart_api_url = "https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=".$string."";
		$pdf->SetXY(186, 272);
		$pdf->Image($google_chart_api_url, $pdf->GetX(), $pdf->GetY(), 18);
		$pdf->Ln(20);
		
        $pdf->SetFont('', 'B', 11);
		$pdf->SetTextColor(255, 255, 255);
		$pdf->Cell(197, 7, 'Terms and Conditions', 0, 1, 'C', true);
		$pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('', '', 11);
		$pdf->Ln(5);

		$pdf->Output();
	}
	
	public function generatePaymentPlan($id){
		$bookingID=base_convert($id, 36, 10);
		$info = $this->booking_model->getBookings($bookingID);
		$pdf = new Pdf();
		$pdf->AddPage('L', array(210, 360));
		$pdf->SetMargins(10, 10, 10);
		$pdf->SetAutoPageBreak(true, 10);
        $pdf->SetFont('', 'B', 14);
		$pdf->SetTitle('Payment Plan - '.$info[0]->membershipNo);
        $logo = base_url('uploads/letterHead/'.$info[0]->projLogo);

		$pdf->writeHTMLCell(40, 5, 10, 5, '<img src="' . $logo . '">', 0, 0, false, false, '');
		$pdf->Cell(258, 6, $info[0]->projName, 0, 0, 'C');

        $pdf->SetFont('', '', 10);
		$pdf->Cell(40, 3, $info[0]->mailAddress, 0, 1, 'R');

		$pdf->Cell(40, 5, '');
		$pdf->Cell(258, 10, '(A Project of AH Group)', 0, 0, 'C');
		$pdf->Cell(40, 3, $info[0]->webAddress, 0, 1, 'R');
		$pdf->Ln(16);
		
        $pdf->SetFont('', 'B', 18);
		$pdf->Cell(338, 6, 'Payment Plan', 0, 1, 'C');
        $pdf->SetFont('', 'I', 12);
		$pdf->Cell(338, 6, $info[0]->membershipNo, 0, 1, 'C');
		$pdf->Ln(12);
		
		// ------------------------------------------------------------------------------------------------------------
		$planYears=$info[0]->planYears;	// Plan Years
		$totalMonths=$info[0]->planYears * 12;	// Plan Total Months

		$bookingAmount=$info[0]->bookingAmount;	// Amount Received During Booking
		$salePrice=$info[0]->salePrice;	// Total Sale Price

		$downPayment=$salePrice * $info[0]->downPayment / 100;	// Down Payment
		$confirmation=$salePrice * $info[0]->confirmPay / 100;	// Confirmation
		$semiAnnual=$salePrice * $info[0]->possession / 100;	// Semi Annual
		$possession=$salePrice * $info[0]->possession / 100;	// Possession

		$dcsp=$downPayment + $confirmation + $semiAnnual + $possession;

		$totalPrice = $salePrice - $dcsp;
		$totalSemiAnnual=$totalMonths/6;

		$currentRemianing=$downPayment - $bookingAmount;   // Remianing Amount 
		$remaingAfterDownPay=$salePrice - $downPayment;	   // Total Remianing Amount

		$confirmMonth=date('F, Y', strtotime($info[0]->purchaseDate . ' +1 month'));    // Next Month After Booking

		$installments=$this->booking_model->getInstallments($bookingID);
		// ------------------------------------------------------------------------------------------------------------

        $pdf->SetFont('', 'B', 12);
		$pdf->Cell(260, 6, 'Member Information');
		$pdf->Cell(78, 6, 'Other Information', 0, 1);

        $pdf->SetFont('', '', 12);
		$pdf->Cell(40, 6, 'Reg No');
		$pdf->Cell(220, 6, $info[0]->membershipNo);
		$pdf->Cell(35, 6, 'Category');
		$pdf->Cell(43, 6, $info[0]->catName, 0, 1);
		$pdf->Cell(40, 6, 'Member Name');
		$pdf->Cell(220, 6, $info[0]->custmName);
		$pdf->Cell(35, 6, 'Sub-Category');
		$pdf->Cell(43, 6, $info[0]->subCatName, 0, 1);
		$pdf->Cell(40, 6, 'CNIC');
		$pdf->Cell(220, 6, $info[0]->custmCNIC);
		$pdf->Cell(35, 6, 'Type');
		$pdf->Cell(43, 6, $info[0]->typeName.' ('.$info[0]->dimenssion.')', 0, 1);
		$pdf->Cell(40, 6, "Phone");
		$pdf->Cell(220, 6, $info[0]->primaryPhone);
		$pdf->Cell(35, 6, 'Plan Name');
		$pdf->Cell(35, 6, $info[0]->planName, 0, 1);
		$pdf->Cell(40, 6, "Father's Name");
		$pdf->Cell(220, 6, $info[0]->fatherName);
		$pdf->Cell(35, 6, 'Payment Plan');
		$pdf->Cell(35, 6, $planYears.' Years ('.$totalMonths.' mo*)', 0, 1);
		$pdf->Cell(40, 6, 'Address');
		$pdf->Cell(220, 6, $info[0]->presentAddress);
		$pdf->Cell(35, 6, 'City');
		$pdf->Cell(43, 6, $info[0]->locName, 0, 1);
		$pdf->Ln(6);

		$pdf->SetFillColor(193, 193, 193);
		$pdf->Cell(338, 1, '', 0, 1, '', true);
		$pdf->Cell(40, 6, 'Project Name', 0, 0, '', true);
		$pdf->Cell(220, 6, $info[0]->projName, 0, 0, '', true);
		$pdf->Cell(35, 6, 'Type Size', 0, 0, '', true);
		$pdf->Cell(43, 6, $info[0]->typeName, 0, 1, '', true);
		$pdf->Cell(40, 6, 'Per Marla Price', 0, 0, '', true);
		$pdf->Cell(220, 6, number_format($info[0]->perMarla), 0, 0, '', true);
		$pdf->Cell(35, 6, 'Payment Mode', 0, 0, '', true);
		$pdf->Cell(43, 6, $info[0]->bookingMode, 0, 1, '', true);
        $pdf->SetFont('', '', 12);
		$pdf->Cell(40, 6, 'Special Discount', 0, 0, '', true);
		$pdf->Cell(220, 6, $info[0]->sepDiscount.'%', 0, 0, '', true);
		$pdf->Cell(35, 6, 'Filer Status', 0, 0, '', true);
		$pdf->Cell(43, 6, $info[0]->bookFilerStatus.' ('.$info[0]->bookFilerPercent.'%)', 0, 1, '', true);
		$pdf->Cell(40, 6, 'Extra Land Charges', 0, 0, '', true);
		$pdf->Cell(220, 6, number_format($info[0]->exCharges), 0, 0, '', true);
		$pdf->Cell(35, 6, 'Recevied In', 0, 0, '', true);
		$pdf->Cell(43, 6, $info[0]->locName, 0, 1, '', true);
		$pdf->Cell(40, 6, 'Sale Price', 0, 0, '', true);
		$pdf->Cell(220, 6, number_format($salePrice), 0, 0, '', true);
		$pdf->Cell(35, 6, 'Booking Date', 0, 0, '', true);
		$pdf->Cell(43, 6, date('F d, Y',strtotime($info[0]->purchaseDate)), 0, 1, '', true);
		$pdf->Cell(40, 6, 'Features', 0, 0, '', true);
		$pdf->Cell(220, 6, $info[0]->features.'  ('.$info[0]->featuresPercent.'%)', 0, 0, '', true);
		$pdf->Cell(35, 6, '', 0, 0, '', true);
		$pdf->Cell(43, 6, '', 0, 1, '', true);
		$pdf->Cell(338, 1, '', 0, 1, '', true);
		$pdf->SetFillColor(0, 0, 0);
		$pdf->Ln(6);

        $pdf->SetFont('', '', 11);
		$pdf->SetTextColor(255, 255, 255);
		$pdf->Cell(8, 6, 'Sr', 1, 0, 'C', true);
		$pdf->Cell(40, 6, 'Narration', 1, 0, 'C', true);
		$pdf->Cell(35, 6, 'Installment Type', 1, 0, 'C', true);
		$pdf->Cell(30, 6, 'Due Month', 1, 0, 'C', true);
		$pdf->Cell(30, 6, 'Amount', 1, 0, 'C', true);
		$pdf->Cell(30, 6, 'Received', 1, 0, 'C', true);
		$pdf->Cell(30, 6, 'Remaining', 1, 0, 'C', true);
		$pdf->Cell(30, 6, 'Receipt Date', 1, 0, 'C', true);
		$pdf->Cell(30, 6, 'Payment Mode', 1, 0, 'C', true);
		$pdf->Cell(25, 6, 'Filer Status', 1, 0, 'C', true);
		$pdf->Cell(15, 6, 'Tax', 1, 0, 'C', true);
		$pdf->Cell(35, 6, 'Balance Amount', 1, 1, 'C', true);
		$pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('', '', 11);

		$pdf->SetFillColor(193, 193, 193);
		$pdf->Cell(338, 8, 'Booking Information', 1, 1, 'C', true);
		$pdf->SetFillColor(255, 255, 255);

		// Down Payment Details
		$pdf->Cell(8, 6, '01', 1, 0, 'C');
		$pdf->Cell(75, 6, 'Down Payment ('.$info[0]->downPayment.'%)', 1);
		$pdf->Cell(30, 6, date('M, Y',strtotime($info[0]->purchaseDate)), 1, 0, 'C');
		$pdf->Cell(30, 6, number_format($downPayment), 1, 0, 'C');
		$pdf->Cell(30, 6, number_format($bookingAmount), 1, 0, 'C');
		$pdf->Cell(30, 6, number_format($currentRemianing), 1, 0, 'C');
		$pdf->Cell(30, 6, date('M d, Y',strtotime($info[0]->purchaseDate)), 1, 0, 'C');
		$pdf->Cell(30, 6, $info[0]->bookingMode, 1, 0, 'C');
		$pdf->Cell(25, 6, $info[0]->bookFilerStatus, 1, 0, 'C');
		$pdf->Cell(15, 6, $info[0]->bookFilerPercent.'%', 1, 0, 'C');
		$pdf->Cell(35, 6, number_format($remaingAfterDownPay), 1, 1, 'C');
		
		// Confirmation Detail
		$confirmAmount=0;
		$confirmDate="";
		$confirmMode="";
		$confirmFiler="";
		$confirmFilerPerc="";
		$isConfirm=0;
		$confirmationMonth=$confirmMonth;
		$remaingAfterConfirm="";
		$enable=0;
		foreach($installments as $install):
			$confirmationMonth=date('F, Y', strtotime($install[0]->installReceivedDate));
			if($confirmationMonth == $confirmMonth){
				$confirmAmount=$install[0]->installAmount;
				$isConfirm=1;
			}else{
				$isConfirm=0;
			}
		endforeach;

		$currentRemianing = $currentRemianing + $confirmation - $confirmAmount;

		$remaingAfterConfirm = $remaingAfterDownPay - $confirmAmount;

		$pdf->Cell(8, 6, '02', 1, 0, 'C');
		$pdf->Cell(75, 6, 'Confirmation ('.$info[0]->confirmPay.'%)', 1);
		$pdf->Cell(30, 6, date('M, Y',strtotime($confirmMonth)), 1, 0, 'C');
		$pdf->Cell(30, 6, number_format($confirmation), 1, 0, 'C');
		$pdf->Cell(30, 6, $confirmAmount, 1, 0, 'C');
		$pdf->Cell(30, 6, $currentRemianing, 1, 0, 'C');
		$pdf->Cell(30, 6, $confirmDate, 1, 0, 'C');
		$pdf->Cell(30, 6, $confirmMode, 1, 0, 'C');
		$pdf->Cell(25, 6, $confirmFiler, 1, 0, 'C');
		$pdf->Cell(15, 6, $confirmFilerPerc, 1, 0, 'C');
		$pdf->Cell(35, 6, $remaingAfterConfirm, 1, 1, 'C');

		$pdf->SetFillColor(193, 193, 193);
		$pdf->Cell(338, 8, 'Installments - Starting a month after the booking', 1, 1, 'C', true);
		$pdf->SetTextColor(0, 0, 0);
		
		$pdf->Cell(8, 6, '03', 1, 0, 'C');
		$pdf->Cell(40, 6, 'Installment', 1);
		$pdf->Cell(35, 6, 'Monthly', 1);
		$pdf->Cell(30, 6, date('M d, Y'), 1, 0, 'C');
		$pdf->Cell(30, 6, number_format(5500000), 1, 0, 'C');
		$pdf->Cell(30, 6, number_format(5500000), 1, 0, 'C');
		$pdf->Cell(30, 6, number_format(5500), 1, 0, 'C');
		$pdf->Cell(30, 6, date('M d, Y'), 1, 0, 'C');
		$pdf->Cell(30, 6, 'Cash', 1, 0, 'C');
		$pdf->Cell(25, 6, 'Active', 1, 0, 'C');
		$pdf->Cell(15, 6, '10.5%', 1, 0, 'C');
		$pdf->Cell(35, 6, number_format(5500000), 1, 1, 'C');
		
		$pdf->Output();
	}
}
