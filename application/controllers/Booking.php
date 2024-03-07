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
	public function customerBookings($id){	// Get Booking info By CNIC
		$data = $this->booking_model->customerBookings($id);
		echo json_encode($data);
	}
	public function deleteBooking($id){	// Get Booking info By CNIC
		$data = $this->booking_model->deleteBooking($id);
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
		$projID=$this->input->post('projID');
		$projCode=$this->input->post('projectCode');
		$projectBasePrice=$this->input->post('projectBasePrice');
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
		$total=$subtotal + $exCharges;
		$salePrice=$total + ($total * ($featuresPercent / 100));

		$total_bookings=0;
		$this->db->select('COUNT(bookingId) as total_bookings');
		$query = $this->db->from('bookings')->where('projID', $projID)->get();
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
			'projID' => $projID,
			'bookingBasePrice' => $projectBasePrice,
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
			'bookingtypeDiscount' => $this->input->post('typeDiscount'),
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
	public function issueFile($id){
		$data = $this->booking_model->issueFile($id);
		echo json_encode($data);
	}

	// ------------------------------- Generate PDF Files -------------------------------
	public function generateBookingMemo($id){
		$bookingID=base_convert($id, 36, 10);
		$info = $this->booking_model->getBookings($bookingID);
        $pdf = new Pdf();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Muhammad Anas');
		$pdf->SetTitle('File Issuance Memo - '.$info[0]->membershipNo);
		$pdf->SetSubject('File Issuance Memo of '.$info[0]->membershipNo);
		$pdf->SetKeywords('File Issuance Memo');
		$filename='File Issuance Memo'.'.pdf';
		$pdf->SetMargins(7, 7, 7, 7);
		$pdf->SetAutoPageBreak(TRUE, $bottom = 0);
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
		
		($info[0]->custmGender=='1') ? $pre='Mr. ' : $pre='Ms. ';

		$pdf->cell(38, 6, 'Customer Name:', 0, 0, '');
		$pdf->cell(160, 6, $pre.$info[0]->custmName, 0, 1, '');
		$pdf->cell(38, 6, 'File No:', 0, 0, '');
		$pdf->cell(160, 6, $info[0]->membershipNo, 0, 1, '');
		$pdf->cell(38, 6, 'Booking Date:', 0, 0, '');
		$pdf->cell(160, 6, date('F d, Y',strtotime($info[0]->purchaseDate)), 0, 1, '');
		$pdf->cell(38, 6, 'Property Size:', 0, 0, '');
		$pdf->cell(160, 6, $info[0]->typeName, 0, 1, '');
		$pdf->cell(38, 6, 'Property Type:', 0, 0, '');
		$pdf->cell(160, 6, $info[0]->catName, 0, 1, '');
		$pdf->cell(38, 6, 'Net Price:', 0, 0, '');
		$pdf->cell(160, 6, number_format($info[0]->totalPrice), 0, 1, '');
		$pdf->cell(38, 6, 'Special Discount:', 0, 0, '');
		$pdf->cell(160, 6, $info[0]->sepDiscount.'%', 0, 1, '');
		$pdf->cell(38, 6, 'Sale Price:', 0, 0, '');
		$pdf->cell(160, 6, number_format($info[0]->salePrice), 0, 1, '');
		// $pdf->cell(38, 6, 'Per Marla Price:', 0, 0, '');
		// $pdf->cell(160, 6, ''), 0, 1, '');
		$pdf->cell(38, 6, 'Amount Received:', 0, 0, '');

		$totalInstallAmount = $this->booking_model->totalInstallmentAmount($bookingID);
		$totalPaid=$info[0]->bookingAmount + $totalInstallAmount;
		$receiveable=$info[0]->salePrice - $totalPaid;
		$paidPercent=(($totalPaid/$info[0]->salePrice)*100);
		($paidPercent >= 20) ? $other='Booking and Confirmation' : $other='Booking';

		$pdf->cell(40, 6, number_format($totalPaid), 0, 0, '');
        $pdf->SetFont('', 'I', 10);
		$pdf->cell(20, 6, substr($paidPercent, 0, 4).'%', 0, 0, 'C');
		$pdf->cell(100, 6, '('.$other.')', 0, 1, '');
        $pdf->SetFont('', '', 10);

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
		
		$pdf->cell(38, 6, 'Inword:', 0, 0, '');
		$pdf->cell(160, 6, numberToWords($totalPaid).' Rupees Only', 0, 1, '');
		
		$pdf->cell(38, 6, 'Payment Mode:', 0, 0, '');
		$pdf->cell(160, 6, $info[0]->bookingMode, 0, 1, '');
		$pdf->cell(38, 6, 'Receivable:', 0, 0, '');
		$pdf->cell(160, 6, number_format($receiveable), 0, 1, '');
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
		$pdf->Ln(42);

		$pdf->SetFont('', 'B', 9);
		$pdf->Cell(19, 4, 'Head Office');
        $pdf->SetFont('', '', 9);
		$pdf->Cell(178, 4, '- Office #11 2nd floor, Umer Building,', 0, 1);
		$pdf->Cell(98, 0, 'Jinnah Avenue, Blue Area, Islamabad 440000.');
		$pdf->Cell(98, 0, $this->session->userdata('username'), 0, 1, 'R');
		$pdf->Cell(98, 0, 'Conatct Number: 0331-1110884');
		$pdf->Cell(98, 0, date('M d, Y g:i A'), 0, 1, 'R');
		
        $pdf->Output($filename, 'I');
    }

	public function generateWelcomeLetter($id){
		$bookingID=base_convert($id, 36, 10);
		$info = $this->booking_model->getBookings($bookingID);
        $pdf = new Pdf();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Muhammad Anas');
		$pdf->SetTitle('Welcome Letter - '.$info[0]->membershipNo);
		$pdf->SetSubject('Welcome Letter of '.$info[0]->membershipNo);
		$pdf->SetKeywords('Welcome Letter');
		$filename='Welcome Letter'.'.pdf';
		$pdf->SetMargins(7, 7, 7, 7);
		$pdf->SetAutoPageBreak(TRUE, $bottom = 0);
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
		
		($info[0]->custmGender=='1') ? $pre='Mr. ' : $pre='Ms. ';

		$pdf->cell(99, 5, 'Customer Name', 1);
		$pdf->cell(99, 5, $pre.$info[0]->custmName, 1, 1);
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
		$pdf->Ln(20);

		$pdf->cell(60, 5, '', 'B');
		$pdf->cell(78, 5, '');
		$pdf->cell(60, 5, '', 'B', 1);
		$pdf->cell(60, 5, 'For & on behalf of', 0, 0, 'C');
		$pdf->cell(78, 5, '');
		$pdf->cell(60, 5, 'Stamp', 0, 1, 'C');
		$pdf->cell(60, 5, $info[0]->projName, 0, 0, 'C');
		$pdf->Ln(30);

		$pdf->SetFont('', 'B', 9);
		$pdf->Cell(19, 4, 'Head Office');
        $pdf->SetFont('', '', 9);
		$pdf->Cell(178, 4, '- Office #11 2nd floor, Umer Building,', 0, 1);
		$pdf->Cell(98, 0, 'Jinnah Avenue, Blue Area, Islamabad 440000.');
		$pdf->Cell(98, 0, $this->session->userdata('username'), 0, 1, 'R');
		$pdf->Cell(98, 0, 'Conatct Number: 0331-1110884');
		$pdf->Cell(98, 0, date('M d, Y g:i A'), 0, 1, 'R');

		$pdf->Output($filename, 'I');
	}

	public function generateConfirmationLetter($id){
		$bookingID=base_convert($id, 36, 10);
		$info = $this->booking_model->getBookings($bookingID);
        $pdf = new Pdf();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Muhammad Anas');
		$pdf->SetTitle('Confirmation Letter - '.$info[0]->membershipNo);
		$pdf->SetSubject('Confirmation Letter of '.$info[0]->membershipNo);
		$pdf->SetKeywords('Confirmation Letter');
		$filename='Confirmation Letter'.'.pdf';
		$pdf->SetMargins(7, 7, 7, 7);
		$pdf->SetAutoPageBreak(TRUE, $bottom = 0);
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
		
		($info[0]->custmGender=='1') ? $pre='Mr. ' : $pre='Ms. ';

		$pdf->cell(99, 5, 'Customer Name', 1);
		$pdf->cell(99, 5, $pre.$info[0]->custmName, 1, 1);
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
		$pdf->Ln(2);
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
		$pdf->Ln(62);

		$pdf->SetFont('', 'B', 9);
		$pdf->Cell(19, 4, 'Head Office');
        $pdf->SetFont('', '', 9);
		$pdf->Cell(178, 4, '- Office #11 2nd floor, Umer Building,', 0, 1);
		$pdf->Cell(98, 0, 'Jinnah Avenue, Blue Area, Islamabad 440000.');
		$pdf->Cell(98, 0, $this->session->userdata('username'), 0, 1, 'R');
		$pdf->Cell(98, 0, 'Conatct Number: 0331-1110884');
		$pdf->Cell(98, 0, date('M d, Y g:i A'), 0, 1, 'R');

		$pdf->Output($filename, 'I');
	}
	
	public function generateBookingReceipt($id){
		$bookingID=base_convert($id, 36, 10);
		$receipt = $this->input->get('receipt');
		if($receipt=='booking'){
			$info = $this->booking_model->getBookings($bookingID);
			$receiptType=ucfirst($receipt);
			$receiptTitle=strtoupper($receipt);
			$recpNo=$info[0]->bookingId;
			$receiptDate=$info[0]->purchaseDate;
			$payMode=$info[0]->bookingMode;
			$receiptAmount=$info[0]->bookingAmount;
		}else{
			$info = $this->booking_model->getInstallmentInfo($bookingID);
			$receiptType=ucfirst($receipt);
			$receiptTitle=strtoupper($receipt);
			$recpNo=$info[0]->installmentId;
			$receiptDate=$info[0]->installReceivedDate;
			$payMode=$info[0]->installPayMode;
			$receiptAmount=$info[0]->installAmount;
		}
        $pdf = new Pdf();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Muhammad Anas');
		$pdf->SetTitle($receiptType.' Receipt - '.$info[0]->membershipNo);
		$pdf->SetSubject('Confirmation of '.$receiptType.' Receipt');
		$pdf->SetKeywords($receiptType.' Receipt');
		$filename=$receiptType.' Receipt'.'.pdf';
		$pdf->SetMargins(7, 7, 7, 7);
		$pdf->SetAutoPageBreak(TRUE, $bottom = 0);
        $pdf->AddPage('A4');
        $pdf->SetFont('', 'B', 14);
		$pdf->SetTitle($receiptType.' Receipt - '.$info[0]->membershipNo);
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
		$pdf->cell(197, 6, $receiptTitle.' RECEIPT', 0, 1, 'C');
		$pdf->Ln(20);

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
		$pdf->cell(50, 6, date('M d, Y',strtotime($receiptDate)),'B', 1);
		$pdf->cell(197, 10, 'We are hereby acknowledged for and on behalf of '.$info[0]->projName.', that we have received', 0, 1);
		
		($info[0]->custmGender=='1') ? $pre='Mr. ' : $pre='Ms. ';

        $pdf->SetFont('', '', 11);
		$pdf->cell(50, 6, 'Received with thanks from:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(147, 6, $pre.$info[0]->custmName,'B', 1);
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
		$pdf->cell(25, 7, 'Dimension:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(50, 7, $info[0]->dimenssion,'B', 1);
		$pdf->Ln(7);
		
        $pdf->SetFont('', 'B', 11);
		$pdf->cell(50, 7, 'Mode of Payment:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(50, 7, $payMode,'B', 1);
		
        $pdf->SetFont('', 'B', 11);
		$pdf->cell(50, 7, 'Amount Received:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(50, 7, number_format($receiptAmount),'B', 1);
		
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

        $pdf->SetFont('', 'B', 11);
		$pdf->cell(50, 7, 'Amount in Word:');
        $pdf->SetFont('', '', 11);
		$pdf->cell(147, 7, numberToWords($receiptAmount).' Rupees Only','B', 1);
		
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
		$pdf->Ln(58);

		$pdf->SetFont('', 'B', 9);
		$pdf->Cell(19, 4, 'Head Office');
        $pdf->SetFont('', '', 9);
		$pdf->Cell(178, 4, '- Office #11 2nd floor, Umer Building,', 0, 1);
		$pdf->Cell(98, 0, 'Jinnah Avenue, Blue Area, Islamabad 440000.');
		$pdf->Cell(98, 0, $this->session->userdata('username'), 0, 1, 'R');
		$pdf->Cell(98, 0, 'Conatct Number: 0331-1110884');
		$pdf->Cell(98, 0, date('M d, Y g:i A'), 0, 1, 'R');

		$pdf->Output($filename, 'I');
		// $pdf->Output();
	}
	
	public function generateBookingForm($id){
		$bookingID=base_convert($id, 36, 10);
		$info = $this->booking_model->getBookings($bookingID);
		$totalInstallAmount = $this->booking_model->totalInstallmentAmount($bookingID);
		$receivedAmount=$totalInstallAmount+$info[0]->bookingAmount;
		$receivableAmount=$info[0]->salePrice-$receivedAmount;
        $pdf = new Pdf();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Muhammad Anas');
		$pdf->SetTitle('Booking Form - '.$info[0]->membershipNo);
		$pdf->SetSubject('Booking Form of '.$info[0]->membershipNo);
		$pdf->SetKeywords('Booking Form');
		$filename='Booking Form'.'.pdf';
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

		if($info[0]->custmGender=='1'){
			$pre='Mr. ';
			$extra='S/O';
		}else{
			$pre='Ms. ';
			$extra='D/O, W/O';
		}

		$pdf->Cell(40, 7, 'Applicant Name');
		$custName = $info[0]->custmName;
		if(strlen($custName)>20){ $custName = substr($custName,0,20).'...'; }
		$pdf->Cell(53, 7, $pre.$custName, 'B');
		$pdf->Cell(10, 7, '');
		$pdf->Cell(40, 7, $extra);
		$DO=$info[0]->fatherName;
		if(strlen($DO)>20){ $DO = substr($DO,0,20).'...'; }
		$pdf->Cell(53, 7, $DO , 'B', 1);
		
		$pdf->Cell(40, 7, 'CNIC / Passport');
		$pdf->Cell(53, 7, $info[0]->custmCNIC, 'B');
		$pdf->Cell(10, 7, '');
		$pdf->Cell(40, 7, 'Date of Birth');
		$dob = ($info[0]->custmDOB!="") ? date('F d, Y',strtotime($info[0]->custmDOB)) : "";
		$pdf->Cell(53, 7, $dob, 'B', 1);
		
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
		$pdf->Cell(40, 7, 'Special Discount');
		$pdf->Cell(53, 7, $info[0]->sepDiscount.'%', 'B', 1);

		$features = ($info[0]->featuresPercent == 0) ? 'None' : $info[0]->features;
		$pdf->Cell(40, 7, 'Features ('.$info[0]->featuresPercent.'%)');
		$pdf->Cell(53, 7, $features, 'B');
		$pdf->Cell(10, 7, '');
		$pdf->Cell(40, 7, 'Extra Charges');
		$pdf->Cell(53, 7, number_format($info[0]->exCharges), 'B', 1);
		
		$pdf->Cell(40, 7, 'Sale Price');
		$pdf->Cell(53, 7, number_format($info[0]->salePrice), 'B');
		$pdf->Cell(10, 7, '');
		$pdf->Cell(40, 7, 'Amount Received');
		$pdf->Cell(53, 7, number_format($receivedAmount), 'B', 1);
		
		$pdf->Cell(40, 7, 'Mode of Payment');
		$pdf->Cell(53, 7, $info[0]->bookingMode, 'B');
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
		$pdf->MultiCell(197, 5, '1. The  applicant  acknowledges  and agrees that  the booking  will be considered  confirmed upon the successful  completion of  the booking  amount,  equivalent  to 20% of the  total plot  value, within  the stipulated  time frame. Failure to do so may regrettably lead to the cancellation of the booking. ', 0, 1);
		$pdf->MultiCell(197, 5, '2. Once a plot has been booked, it is  not permissible to  transfer, assign, or sell  it to any other individual without securing prior written consent from the Management of '.$info[0]->projName.'.', 0, 1);
		$pdf->MultiCell(197, 5, '3. For  prime locations, including  corners, park-facing, or boulevard  views, additional charges will be applicable.', 0, 1);
		$pdf->MultiCell(197, 5, '4. In case of extra land, additional charges  will be applicable.', 0, 1);
		$pdf->MultiCell(197, 5, '5. A plot  allocated to an  applicant by '.$info[0]->projName.' management  must be utilized  exclusively for the purpose  applied for or intended by the applicant.', 0, 1);
		$pdf->MultiCell(197, 5, '6. Payments received after the due date will be subject to a late payment surcharge.', 0, 1);
		$pdf->MultiCell(197, 5, '7. Plot numbers will be assigned to clients after  balloting process, and possession  will be granted after a period of four years, subject to the settlement of all outstanding dues. Please be advised that the possession and development timelines are subject to influence by various internal and external factors.', 0, 1);
		$pdf->MultiCell(197, 5, '8. If any applicant fails to  pay two consecutive installments within the prescribed period, the allotment/booking is liable to be canceled without notice.', 0, 1);
		$pdf->MultiCell(197, 5, '9. A  10% discount  will be given on full payment, and a 5% discount  will be given for 50% payments  of the total amount.', 0, 1);
		$pdf->MultiCell(197, 5, '10. In case of a refund, the applicant shall be required to submit a written application with a clear reason. A deduction of 20% shall be made from the amount paid till the date. The refund amount shall be disbursed after a period of 180 working days, subsequent to the approval date.', 0, 1);
		$pdf->MultiCell(197, 5, '11. The construction or modification of structures on the plot must adhere to the guidelines, regulations, and approval processes set forth by '.$info[0]->projName.' and government authorities.', 0, 1);
		$pdf->MultiCell(197, 5, '12. '.$info[0]->projName.' retains the authority to allocate or sell a plot that has been canceled, whether due to non-payment of dues or for any other reason, to another applicant. The former applicant shall not retain any rights over the said plot, and the decision of '.$info[0]->projName.' in this matter will be considered final.', 0, 1);
		$pdf->MultiCell(197, 5, '13. The management of '.$info[0]->projName.' reserves the right to relocate the allotted plot to a different location and modify the payment plan if deemed necessary, keeping in view the circumstances.', 0, 1);
		$pdf->MultiCell(197, 5, '14. The transfer of the allocated plot is permissible solely after the reception of updated payments and charges. The applicant is obligated to surrender all original documents pertaining to the property to '.$info[0]->projName.' management before the transfer process commences. Additionally, both the transferor and transferee are required to provide written statements on affidavit affirming the details of the transfer.', 0, 1);
		$pdf->MultiCell(197, 5, '15. It is obligatory for  the property owner to pay of all applicable taxes, dues, and fees to the Federal Board of Revenue, TMA, or any other government departments.', 0, 1);
		$pdf->MultiCell(197, 5, '16. Development charges, utilities charges, maintenance charges, or any other relevant fees will be collected at a subsequent stage in accordance with the specified terms and conditions.', 0, 1);
		$pdf->MultiCell(197, 5, '17. In the event of dispute between the applicant and '.$info[0]->projName.' or between two clients, the matter will be respectfully directed to the '.$info[0]->projName.' Management Board for resolution. The decision reached by the Board will be considered conclusive and binding on all parties involved.', 0, 1);
		$pdf->Ln(3);

        $pdf->SetFont('', 'B', 11);
		$pdf->Cell(197, 5, 'Declaration:', 0, 1);
        $pdf->SetFont('', '', 11);
		$pdf->MultiCell(197, 5, 'I, hereby declare that I have carefully read and comprehended the above-mentioned terms and conditions. I unconditionally accept the terms set forth, and I commit to abide by the existing rules, regulations, or any terms & conditions that may be prescribed by '.$info[0]->projName.' from time to time.', 0, 1);
		$pdf->MultiCell(197, 5, 'I affirm that the information provided by me is true and correct to the best of my knowledge. I acknowledge that I will be held responsible for any inaccuracies or errors in the data provided by me.', 0, 1);
		$pdf->Ln(16);

		$pdf->Cell(98, 1, '');
		$pdf->Cell(98, 0, 'Applicant Signature & Thumb Impression', 0, 1, 'R');
		$pdf->Cell(197, 0, '', 'T', 1);

        $pdf->SetFont('', 'B', 11);
		$pdf->Cell(45, 5, 'FOR OFFICE USE ONLY', 'B', 1);
        $pdf->SetFont('', '', 10);
		$pdf->Ln(1);
		$pdf->Cell(123, 4, 'Copy of CNIC/NICOP/Passport of applicant');
        $pdf->SetFont('', 'B', 10);
		$pdf->Cell(78, 4, 'Booking Executive ____________________', 0, 1);
        $pdf->SetFont('', '', 10);
		$pdf->Cell(123, 4, 'Copy of CNIC/NICOP/Passport of NOK', 0, 1);
        $pdf->SetFont('', '', 10);
		$pdf->Cell(123, 4, '2 passport size fresh photographs', 0, 1);
		$pdf->Cell(123, 4, 'Original Payment Slip');
        $pdf->SetFont('', 'B', 10);
		$pdf->Cell(78, 4, 'Manager CCD         ____________________', 0, 1);
		
		$pdf->Output($filename, 'I');
	}
	
	public function generatePaymentPlan($id){
		$bookingID=base_convert($id, 36, 10);
		$info = $this->booking_model->getBookings($bookingID);
		$pdf = new Pdf();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Muhammad Anas');
		$pdf->SetTitle('Payment Plan - '.$info[0]->membershipNo);
		$pdf->SetSubject('Payment Plan of '.$info[0]->membershipNo);
		$pdf->SetKeywords('Payment Plan');
		$filename='Payment Plan'.'.pdf';
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

		$currentRemianing=$downPayment - $bookingAmount;   // Remaining Amount 
		$balance=$salePrice - $bookingAmount;	   // Total Remianing Amount (Balance)

		$date = DateTime::createFromFormat('d-m-Y', $info[0]->purchaseDate);
		$date->modify('+1 month');
		$compareMonth1 = $date->format('Y-m');
		$confirmMonth = date('M, Y',strtotime($compareMonth1));

		$installments=$this->booking_model->getInstallments($bookingID);
		$enable=0;
		// ------------------------------------------------------------------------------------------------------------

        $pdf->SetFont('', 'B', 12);
		$pdf->Cell(260, 6, 'Member Information');
		$pdf->Cell(78, 6, 'Other Information', 0, 1);

		($info[0]->custmGender=='1') ? $pre='Mr. ' : $pre='Ms. ';

        $pdf->SetFont('', '', 12);
		$pdf->Cell(40, 6, 'Reg No');
		$pdf->Cell(220, 6, $info[0]->membershipNo);
		$pdf->Cell(35, 6, 'Category');
		$pdf->Cell(43, 6, $info[0]->catName, 0, 1);
		$pdf->Cell(40, 6, 'Member Name');
		$pdf->Cell(220, 6, $pre.$info[0]->custmName);
		$pdf->Cell(35, 6, 'Sub-Category');
		$pdf->Cell(43, 6, $info[0]->subCatName, 0, 1);
		$pdf->Cell(40, 6, 'CNIC');
		$pdf->Cell(220, 6, $info[0]->custmCNIC);
		$pdf->Cell(35, 6, 'Type Name');
		$pdf->Cell(43, 6, $info[0]->typeName, 0, 1);
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
		$pdf->Ln(3);

		$pdf->SetFillColor(193, 193, 193);
		$pdf->Cell(338, 1, '', 0, 1, '', true);
		$pdf->Cell(40, 6, 'Project Name', 0, 0, '', true);
		$pdf->Cell(220, 6, $info[0]->projName, 0, 0, '', true);
		$pdf->Cell(35, 6, 'Dimension', 0, 0, '', true);
		$pdf->Cell(43, 6, $info[0]->dimenssion, 0, 1, '', true);
		$pdf->Cell(40, 6, 'Type Discount', 0, 0, '', true);
		$pdf->Cell(220, 6, $info[0]->bookingtypeDiscount.'%', 0, 0, '', true);
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
		$pdf->Cell(40, 6, 'Features ('.$info[0]->featuresPercent.'%)', 0, 0, '', true);
		$pdf->Cell(220, 6, ($info[0]->featuresPercent==0) ? 'N/A' : $info[0]->features, 0, 0, '', true);
		$pdf->Cell(35, 6, 'Booking Date', 0, 0, '', true);
		$pdf->Cell(43, 6, date('F d, Y',strtotime($info[0]->purchaseDate)), 0, 1, '', true);
		$pdf->Cell(40, 6, 'Sale Price', 0, 0, '', true);
		$pdf->Cell(220, 6, number_format($salePrice), 0, 0, '', true);
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
		$pdf->Cell(35, 6, 'Balance', 1, 1, 'C', true);
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
		$pdf->Cell(35, 6, number_format($balance), 1, 1, 'C');
		
		$totalPay=$bookingAmount;
		
		$today=date('Y-m');
		$currentMonth=date('M, Y');
		$confirmDate="";
		$confirmAmount=0;
		$confirmMode="";
		$confirmFiler="";
		$confirmTax="";
		if(count($installments)>0):
			foreach($installments as $confirm):
				$confirmDateMatch=date('Y-m',strtotime($confirm->installReceivedDate));
				if($confirmDateMatch == $compareMonth1){
					$confirmDate=date('d M, Y',strtotime($confirmDateMatch));
					$confirmAmount=$confirm->installAmount;
					$confirmMode=$confirm->installPayMode;
					$confirmFiler=$confirm->installFilerStatus;
					$confirmTax=$confirm->installFilerPercent;
					break;
				}
			endforeach;
		endif;
		
		if($compareMonth1 <= $today){
			$currentRemianing = $currentRemianing + $confirmation - $confirmAmount;
			$showCurrentRemianing=number_format($currentRemianing);
		}else{
			$showCurrentRemianing='';
		}
		($compareMonth1 == $today) ? $color=true : $color=false;

		$balance = $balance - $confirmAmount;
		$showConfirmAmount=number_format($confirmAmount);
		$totalPay+=$confirmAmount;
		
		$pdf->Cell(8, 6, '02', 1, 0, 'C');
		$pdf->Cell(75, 6, 'Confirmation ('.$info[0]->confirmPay.'%)', 1);
		$pdf->Cell(30, 6, $confirmMonth, 1, 0, 'C');
		$pdf->Cell(30, 6, number_format($confirmation), 1, 0, 'C');
		$pdf->Cell(30, 6, $showConfirmAmount, 1, 0, 'C');
		$pdf->Cell(30, 6, $showCurrentRemianing, 1, 0, 'C', $color);
		$pdf->Cell(30, 6, $confirmDate, 1, 0, 'C');
		$pdf->Cell(30, 6, $confirmMode, 1, 0, 'C');
		$pdf->Cell(25, 6, $confirmFiler, 1, 0, 'C');
		$pdf->Cell(15, 6, $confirmTax, 1, 0, 'C');
		$pdf->Cell(35, 6, number_format($balance), 1, 1, 'C');

		$pdf->SetFillColor(193, 193, 193);
		$pdf->Cell(338, 8, 'Installments - Starting a month after the booking', 1, 1, 'C', true);
		$pdf->SetTextColor(0, 0, 0);
		
		// Installments
    	$mySemiAnnual = 0;
		$installmentPrice = $salePrice - $dcsp;
		$totalSemiAnnual=$totalMonths/6;
		$myInstallment = intval($installmentPrice/($totalMonths-$totalSemiAnnual));
		
		$semiAnnualAmount = $salePrice * $info[0]->semiAnnual / 100;
		$mySemiAnnual=$semiAnnualAmount/$totalSemiAnnual;

		for($i=1; $i<=$totalMonths; $i++):
			$date = DateTime::createFromFormat('M, Y', $confirmMonth);
			$date->modify('+'.$i.' month');
			$compareMonth2 = $date->format('Y-m');
			$installmentMonth = date('M, Y',strtotime($compareMonth2));
			$thisInstallment = ($i) % 6 ? $myInstallment : $mySemiAnnual;

			$installAmount=0;
			$instalMonth="";
			$instalMode="";
			$instalFiler="";
			$instalTax="";
			$totalPaid=0;
			$instalRecipt='';
			if(count($installments)>0):
				foreach($installments as $instal):
					$instalMonthMatch=date('Y-m',strtotime($instal->installReceivedDate));
					if($instalMonthMatch == $compareMonth2){
						$instalMonth=date('d M, Y',strtotime($instalMonthMatch));
						$instalRecipt=$instal->projCode.'-'.sprintf('%02d',$instal->installmentId);
						$installAmount=$instal->installAmount;
						$instalMode=$instal->installPayMode;
						$instalFiler=$instal->installFilerStatus;
						$instalTax=$instal->installFilerPercent."%";
						break;
					}
				endforeach;
			endif;
			
			if($compareMonth2 <= $today){
				$currentRemianing = $currentRemianing + $thisInstallment - $installAmount;
				$showCurrentRemianing=number_format($currentRemianing);
				$showInstallAmount=number_format($installAmount);
			}else{
				$showCurrentRemianing='';
				$showInstallAmount='';
			}

			$totalPaid+=$installAmount;
			$totalPay+=$totalPaid;
			$balance = $balance - $confirmAmount - $totalPaid;

			($compareMonth2 == $today) ? $color=true : $color=false;
			
			$sr=$i+2;
			$pdf->Cell(8, 6, sprintf('%02d', $sr), 1, 0, 'C');
			$pdf->Cell(20, 6, 'Installment', 'TBL');
			$pdf->SetFont('', '', 8);
			$pdf->Cell(20, 6, $instalRecipt, 'TBR', 0, 'C');
			$pdf->SetFont('', '', 11);
			$pdf->Cell(35, 6, ($i % 6) ? 'Monthly' : 'Semi-Annual', 1);
			$pdf->Cell(30, 6, $installmentMonth, 1, 0, 'C');
			$pdf->Cell(30, 6, number_format($thisInstallment), 1, 0, 'C');
			$pdf->Cell(30, 6, $showInstallAmount, 1, 0, 'C');
			$pdf->Cell(30, 6, $showCurrentRemianing, 1, 0, 'C', $color);
			$pdf->Cell(30, 6, $instalMonth, 1, 0, 'C');
			$pdf->Cell(30, 6, $instalMode, 1, 0, 'C');
			$pdf->Cell(25, 6, $instalFiler, 1, 0, 'C');
			$pdf->Cell(15, 6, $instalTax, 1, 0, 'C');
			$pdf->Cell(35, 6, number_format($balance), 1, 1, 'C');
			$lastMonth=$installmentMonth;
		endfor;
		
		$pdf->SetFillColor(193, 193, 193);
		$pdf->Cell(338, 8, 'Possession', 1, 1, 'C', true);
		$pdf->SetTextColor(0, 0, 0);
		
		$newPoss = DateTime::createFromFormat('M, Y', $installmentMonth);
		$newPoss->modify('+1 month');
		$compareMonth3 = $newPoss->format('Y-m');
		$possMonth=date('M, Y',strtotime($compareMonth3));

		$possAmount=0;
		$possMode="";
		$possessionMonth="";
		$possFiler="";
		$possTax="";
		if(count($installments)>0):
			foreach($installments as $poss):
				$possMonthMatch=date('Y-m',strtotime($poss->installReceivedDate));
				if($possMonthMatch >= $compareMonth3){
					$possessionMonth=date('d M, Y',strtotime($possMonthMatch));
					$possAmount=$poss->installAmount;
					$possMode=$poss->installPayMode;
					$possFiler=$poss->installFilerStatus;
					$possTax=$poss->installFilerPercent."%";
					break;
				}
			endforeach;
		endif;

		if($compareMonth3 <= $today){
			$currentRemianing = $currentRemianing + $possession - $possAmount;
			$showCurrentRemianing=number_format($currentRemianing);
			$showPossAmount=number_format($possAmount);
		}else{
			$showCurrentRemianing='';
			$showPossAmount='';
		}

		$balance = $balance - $possAmount;
		$totalPay+=$possAmount;
		
		($compareMonth3 == $today) ? $color=true : $color=false;
		

		$pdf->Cell(8, 6, sprintf('%02d', $sr+1), 1, 0, 'C');
		$pdf->Cell(75, 6, 'Possession ('.$info[0]->possession.'%)', 1);
		$pdf->Cell(30, 6, $possMonth, 1, 0, 'C');
		$pdf->Cell(30, 6, number_format($possession), 1, 0, 'C');
		$pdf->Cell(30, 6, $showPossAmount, 1, 0, 'C');
		$pdf->Cell(30, 6, $showCurrentRemianing, 1, 0, 'C', $color);
		$pdf->Cell(30, 6, $possessionMonth, 1, 0, 'C');
		$pdf->Cell(30, 6, $possMode, 1, 0, 'C');
		$pdf->Cell(25, 6, $possFiler, 1, 0, 'C');
		$pdf->Cell(15, 6, $possTax, 1, 0, 'C');
		$pdf->Cell(35, 6, number_format($balance), 1, 1, 'C');

        $pdf->SetFont('', 'B', 11);
		$pdf->Cell(113, 6, 'Total', 1, 0, 'C');
		$pdf->Cell(30, 6, number_format($salePrice), 1, 0, 'C');
		$pdf->Cell(30, 6, number_format($totalPay), 1, 0, 'C');
		$pdf->Cell(30, 6, number_format($currentRemianing), 1, 0, 'C');
		$pdf->Cell(100, 6, '', 1, 0, 'C');
		$pdf->Cell(35, 6, number_format($balance), 1, 1, 'C');

		$pdf->Output($filename, 'I');
	}
	
	public function generateAccountStatement($id){
		$bookingID=base_convert($id, 36, 10);
		$info = $this->booking_model->getInstallments($bookingID);
		$installSize = count($info);
		if($installSize==0){
			$info = $this->booking_model->getBookings($bookingID);
		}
        $pdf = new Pdf();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Muhammad Anas');
		$pdf->SetTitle('Account Statement - '.$info[0]->membershipNo);
		$pdf->SetSubject('Account Statement of '.$info[0]->membershipNo);
		$pdf->SetKeywords('Account Statement');
		$filename='Account Statement'.'.pdf';
		$pdf->SetMargins(7, 7, 7, 7);
        $pdf->AddPage('A4');
        $pdf->SetFont('', 'B', 14);
		$pdf->SetTitle('Account Statement - '.$info[0]->membershipNo);
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
		$pdf->cell(197, 6, 'Account Statement', 0, 1, 'C');
        $pdf->SetFont('', '', 11);
		$pdf->cell(197, 6, $info[0]->membershipNo, 0, 1, 'C');
		$pdf->Ln(8);

        $pdf->SetFont('', 'B', 11);
		$pdf->Cell(140, 5, 'Member Information');
		$pdf->Cell(57, 5, 'Payment Information', 0, 1);
        $pdf->SetFont('', '', 11);
		
		($info[0]->custmGender=='1') ? $pre='Mr. ' : $pre='Ms. ';

		$pdf->Cell(40, 5, 'Member Name:');
		$pdf->Cell(100, 5, $pre.$info[0]->custmName);
		$pdf->Cell(28, 5, 'Net Price:');
		$pdf->Cell(28, 5, number_format($info[0]->totalPrice), 0, 1, 'R');
		
		$pdf->Cell(40, 5, "Father's Name:");
		$pdf->Cell(100, 5, $info[0]->fatherName);
		$pdf->Cell(28, 5, 'Extra Land Charges:');
		$pdf->Cell(28, 5, number_format($info[0]->exCharges), 0, 1, 'R');

		$pdf->Cell(40, 5, 'CNIC:');
		$pdf->Cell(100, 5, $info[0]->custmCNIC);
		$pdf->Cell(28, 5, 'Fetaure Charges:');
		$pdf->Cell(28, 5, $info[0]->featuresPercent.'%', 0, 1, 'R');
		
		$pdf->Cell(40, 5, "Contact:");
		$pdf->Cell(100, 5, $info[0]->primaryPhone);
		$pdf->Cell(28, 5, 'Discount:');
		$pdf->Cell(28, 5, number_format($info[0]->sepDiscount), 0, 1, 'R');
		
		$pdf->Cell(40, 5, "City:");
		$pdf->Cell(100, 5, $info[0]->locName);
		$pdf->Cell(28, 5, 'Sale Price:');
		$pdf->Cell(28, 5, number_format($info[0]->salePrice), 0, 1, 'R');
		$pdf->Ln(5);

		$pdf->SetFont('', '', 11);
		$pdf->SetTextColor(255, 255, 255);
		$pdf->Cell(21, 6, 'Inst #', 1, 0, 'C', true);
		$pdf->Cell(30, 6, 'Narration', 1, 0, 'C', true);
		$pdf->Cell(25, 6, 'Received', 1, 0, 'C', true);
		$pdf->Cell(25, 6, 'Remaining', 1, 0, 'C', true);
		$pdf->Cell(26, 6, 'Receipt Date', 1, 0, 'C', true);
		$pdf->Cell(30, 6, 'Payment Mode', 1, 0, 'C', true);
		$pdf->Cell(25, 6, 'Filer Status', 1, 0, 'C', true);
		$pdf->Cell(15, 6, 'Tax', 1, 1, 'C', true);
		$pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('', '', 11);

		// Booking Detail
		$totalSalePrice=$info[0]->salePrice;
		$bookingAmount=$info[0]->bookingAmount;
		$totalRemain=$totalSalePrice - $bookingAmount;

		$pdf->Cell(21, 6, $info[0]->projCode.'-'.sprintf('%02d',$info[0]->bookingId), 1, 0, 'C');
		$pdf->Cell(30, 6, 'Down Payment', 1);
		$pdf->Cell(25, 6, number_format($bookingAmount), 1, 0, 'C');
		$pdf->Cell(25, 6, number_format($totalRemain), 1, 0, 'C');
		$pdf->Cell(26, 6, date('M d, Y',strtotime($info[0]->purchaseDate)), 1, 0, 'C');
		$pdf->Cell(30, 6, $info[0]->bookingMode, 1, 0, 'C');
		$pdf->Cell(25, 6, $info[0]->bookFilerStatus, 1, 0, 'C');
		$pdf->Cell(15, 6, $info[0]->bookFilerPercent.'%', 1, 1, 'C');

		$totalRemainaing=$totalRemain;
		$totalRcv=0;
		if($installSize>0){
			foreach($info as $install):
				// Installment Detail
				$instRcv=$install->installAmount;
				$totalRcv+=$instRcv;
				$totalRemainaing=$totalRemain - $totalRcv;
				$pdf->Cell(21, 6, $install->projCode.'-'.sprintf('%02d',$install->installmentId), 1, 0, 'C');
				$pdf->Cell(30, 6, 'Installment', 1);
				$pdf->Cell(25, 6, number_format($instRcv), 1, 0, 'C');
				$pdf->Cell(25, 6, number_format($totalRemainaing), 1, 0, 'C');
				$pdf->Cell(26, 6, date('M d, Y',strtotime($install->installReceivedDate)), 1, 0, 'C');
				$pdf->Cell(30, 6, $install->installPayMode, 1, 0, 'C');
				$pdf->Cell(25, 6, $install->installFilerStatus, 1, 0, 'C');
				$pdf->Cell(15, 6, $install->installFilerPercent.'%', 1, 1, 'C');
			endforeach;
		}
        $pdf->SetFont('', 'B', 11);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->SetFillColor(193, 193, 193);
		$pdf->Cell(51, 6, 'Payments Overview', 1, 0, 'C', true);
		$pdf->Cell(25, 6, number_format($totalRcv+$bookingAmount), 1, 0, 'C', true);
		$pdf->Cell(25, 6, number_format($totalRemainaing), 1, 0, 'C', true);
        $pdf->SetFont('', '', 10);
		$pdf->Cell(96, 6, 'Insights into recent transactions and financial status', 1, 1, 'C', true);
		$pdf->SetTextColor(0, 0, 0);
		$pdf->Ln(5);
		
		$pdf->SetFont('', 'B', 11);
		$pdf->Cell(197, 6, 'NOTE: THIS IS COMPUTER GENERATED REPORT, NO SIGNATURE REQUIRED', 0, 1);
		$pdf->SetFont('', '', 11);
		$pdf->MultiCell(197, 6, "The current receiving report supersedes any previously issued receiving reports regarding customer payment. This report is being issued based on the cash and banking instruments submitted by the client. Any banking instrument, if returned or rejected for any reason by the customer's bank or banking channel involved, shall not", 0, 'J');
		$pdf->Cell(197, 4, 'be deemed as payment of dues by the client.', 0, 1);

        $pdf->Output($filename, 'I');
    }
}
