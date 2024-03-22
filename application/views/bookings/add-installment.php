<div class="page-wrapper px-4 mt-4">
    <div class="row">
        <div class="col">
            <div class="page-header mt-3">
                <div class="page-title">
                    <h4>Add Installment</h4>
                    <h6>Fill out the form</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-6 mb-1">
                            <div class="form-group">
                                <label>Select Project</label>
                                <select id="projectID" class="form-control">
                                    <option selected disabled>Select Project</option>
                                    <?php foreach($projects as $project): ?>
                                    <option value="<?= $project->projectId; ?>"><?= $project->projName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6" id="selectName">
                            <div class="form-group">
                            <label style="display: flex; justify-content: space-between; align-items: center;">Select Customer<span onclick="changeField('0')" style="text-align: right; cursor:pointer;" class="text-primary">Search by CNIC</span></label>
                                <select id="getCustomers" class="form-control">
                                    <option selected disabled>Select Customer</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6" id="filterCNIC" style="display:none;">
                            <div class="form-group">
                            <label style="display: flex; justify-content: space-between; align-items: center;">Enter Customer CNIC<span onclick="changeField('1')" style="text-align: right; cursor:pointer;" class="text-primary">Search by name</span></label>
                                <div class="input-groupicon">
                                    <input maxlength="13" id="customerCNIC" oninput="validateNmbr(event)" type="text" placeholder="without (-) dashes">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Select Booking</label>
                                <select id="bookingID" class="form-control">
                                    <option selected disabled>Select Booking</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Receving Amount</label>
                                <div class="input-groupicon">
                                    <input id="recvAmount" oninput="validateNmbr(event)" type="text" placeholder="0.0">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icon/rs.png'); ?>" alt="img" width="22">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $paymentMode=array('Cash','Cheque','IBFT','Wire Transfer','Pay Order'); ?>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Payment Mode</label>
                                <select id="paymentMode" class="form-control">
                                    <option selected disabled>Payment Mode</option>
                                    <?php foreach ($paymentMode as $payMode): ?>
                                        <option value="<?= $payMode; ?>"><?= $payMode; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="refBank">
                        <div class="col-sm-11 col-lg-5">
                            <div class="form-group">
                                <label>Select Bank</label>
                                <select id="bank_name" class="form-control">
                                    <option selected disabled>Select Bank</option>
                                    <?php foreach ($banks as $bank): ?>
                                        <option value="<?= $bank->bankId; ?>"><?= $bank->bankName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-1 col-lg-1">
                            <label style="color:transparent;">PM</label>
                            <div data-bs-toggle="modal" data-bs-target="#addNewBank" class="add-icon" style="padding-top:15%!important;">
                                <a href="javascript:void(0);"><img src="<?= base_url('assets/img/icons/plus1.svg'); ?>" alt="img"></a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Reference Number</label>
                                <div class="input-groupicon">
                                    <input id="refrncNo" oninput="validateNmbr(event)" type="text" placeholder="Reference Number">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Select Location</label>
                                <select id="recvCity" class="form-control">
                                    <option selected disabled>Select Location</option>
                                    <?php foreach ($cities as $city): ?>
                                        <option value="<?= $city->locationId; ?>"><?= $city->locName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Receving Date</label>
                                <div class="input-groupicon">
                                    <input id="recvDate" oninput="validateDate(event)" type="text" placeholder="DD-MM-YYYY" class="datetimepicker">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icon/calendar.png'); ?>" width="20" alt="img">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>ATL Status</label>
                                <select id="filerStatus" class="form-control">
                                    <option value="NATL">NATL</option>
                                    <option value="ATL">ATL</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>ATL Percentage</label>
                                <div class="input-groupicon">
                                    <input id="filerPercent" oninput="validateDecimal(event)" type="text" placeholder="0.0">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icon/percent.png'); ?>" alt="img" width="18">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <a class="btn form-control btn-submit me-2 addInstallment">Confirm and Submit Installment</a>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <a href="<?= base_url('booking'); ?>" class="btn form-control btn-cancel me-2">View Bookings</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="total-order" style="margin:0%!important;">
                                <ul>
                                    <li>
                                        <h4>Membership#</h4>
                                        <h5 class="membership">-</h5>
                                    </li>
                                    <li>
                                        <h4>Category</h4>
                                        <h5 class="bokCat">-</h5>
                                    </li>
                                    <li>
                                        <h4>Sub-Category</h4>
                                        <h5 class="bokSubCat">-</h5>
                                    </li>
                                    <li>
                                        <h4>Type</h4>
                                        <h5 class="bokType">-</h5>
                                    </li>
                                    <li>
                                        <h4>Plan Name</h4>
                                        <h5 class="bokPlanName">-</h5>
                                    </li>
                                    <li>
                                        <h4>Payment Plan</h4>
                                        <h5 class="bokPayPlan">-</h5>
                                    </li>
                                    <li>
                                        <h4>Purchase Date</h4>
                                        <h5 class="bokDate">-</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                        <div class="total-order" style="margin:0%!important;">
                                <ul>
                                    <li>
                                        <h4>Name</h4>
                                        <h5 class="custmName">-</h5>
                                    </li>
                                    <li>
                                        <h4>Father's Name</h4>
                                        <h5 class="fathName">-</h5>
                                    </li>
                                    <li>
                                        <h4>CNIC</h4>
                                        <h5 class="cutmCNIC">-</h5>
                                    </li>
                                    <li>
                                        <h4>Contact</h4>
                                        <h5 class="custmContact">-</h5>
                                    </li>
                                    <li>
                                        <h4>Employee</h4>
                                        <h5 class="custmEmp">-</h5>
                                    </li>
                                    <li>
                                        <h4>Status</h4>
                                        <h5 class="empStatus">-</h5>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$('.addInstallment').on('click', function(){
        var bookingID = $('#bookingID').val();
        var recvAmount = $('#recvAmount').val();
        var paymentMode = $('#paymentMode').val();
        var bank_name = $('#bank_name').val();
        var refrncNo = $('#refrncNo').val();
        var recvCity = $('#recvCity').val();
        var recvDate = $('#recvDate').val();
        var filerStatus = $('#filerStatus').val();
        var filerPercent = $('#filerPercent').val();
        if(bookingID!="Select Booking" && recvAmount!="" && recvCity!="Select Location" && recvDate!=""){
            swal({
                title: "Are you sure?",
                text: "You want to add the installment!",
                type: "info",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Yes, add it!",
                cancelButtonClass: "btn-primary",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if(isConfirm){
                    $.ajax({
                        url: "<?php echo base_url("booking/saveInstallment"); ?>",
                        type: "POST",
                        data: {
                            bookingID: bookingID,
                            recvAmount: recvAmount,
                            paymentMode: paymentMode,
                            bank_name: bank_name,
                            refrncNo: refrncNo,
                            recvCity: recvCity,
                            recvDate: recvDate,
                            filerStatus: filerStatus,
                            filerPercent: filerPercent
                        },
                        cache: false,
                        success: function(dataResult){
                            if(dataResult==true){
                                swal({
                                    title: "Congratulation!", 
                                    text: "Installment has been added successfully.", 
                                    type: "success"
                                    },function(){ 
                                        location.reload();
                                    }
                                );
                            }else{
                                swal("Ops!", dataResult, "error");
                            }
                        }
                    });
                }else{
                    swal.close()
                }
            });
        }else{
            swal("Sorry!", "Please fill all the field.", "info");
        }
	});
    function changeField(val){
        if (val == 0) {
            $("#selectName").hide();
            $("#filterCNIC").show();
        } else {
            $("#selectName").show();
            $("#filterCNIC").hide();
        }
    }
    $('#projectID').change(function(){
        var projID = $(this).val();
        $.ajax({
            url: "<?php echo base_url('booking/getCustomers/'); ?>" + projID,
            method: 'POST',
            dataType: 'json',
            data: {projID: projID},
            success: function(res){
                $('#getCustomers').find('option').not(':first').remove();
                $.each(res, function(index, data){
                    $('#getCustomers').append('<option value="' + data['customerId'] + '">' + data['custmName'] + ' - ' + data['custmCNIC'] + '</option>');
                });
            }
        });
    });
    $('#getCustomers').change(function(){
        var custmID = $(this).val();
        $.ajax({
            url: "<?php echo base_url('booking/getMyBooking/'); ?>" + custmID,
            method: 'POST',
            dataType: 'json',
            data: {custmID: custmID},
            success: function(res){
                $('#bookingID').find('option').not(':first').remove();
                $.each(res, function(index, data){
                    var bookType = data['typeName'];
                    $('#bookingID').append('<option value="' + data['bookingId'] + '">' + data['membershipNo'] + '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;' + bookType + '</option>');
                });
                $(".custmName").html(res[0].custmName);

                var father='';
                if(res[0].fatherName==""){ father = "N/A"; }
                else{ father = res[0].fatherName; }

                $(".fathName").html(father);
                $(".cutmCNIC").html(res[0].custmCNIC);
                $(".custmContact").html(res[0].primaryPhone);

                var emp='';
                if(res[0].isEmployee==0){ emp = "No"; }
                else{ emp = "Yes"; }
                $(".custmEmp").html(emp);

                var empStatus='';
                if(res[0].custmStatus==0){ empStatus = "Inactive"; }
                else{ empStatus = "Active"; }
                $(".empStatus").html(empStatus);
            }
        });
    });
    $('#bookingID').change(function(){
        var bokID = $(this).val();
        $.ajax({
            url: "<?php echo base_url('booking/getBooking/'); ?>" + bokID,
            method: 'POST',
            dataType: 'json',
            data: {bokID: bokID},
            success: function(res){
                $(".membership").html(res[0].membershipNo);
                $(".bokCat").html(res[0].catName);
                $(".bokSubCat").html(res[0].subCatName);
                $(".bokType").html(res[0].typeName);
                $(".bokPlanName").html(res[0].planName);
                $(".bokPayPlan").html(res[0].planYears+" Year(s)");
                $(".bokDate").html(res[0].purchaseDate);
                if(res[0].bookingStatus==0){
                    $('input, select').prop('disabled', true);
                    swal({
                        title: "Sorry!",
                        text: "The booking you have selected is inactive.",
                        icon: "info",
                        buttons: true,
                        dangerMode: true,
                    }).then((yes) => {
                        if(yes){ window.location.reload(); }
                    });
                }
            }
        });
    });
    $('#customerCNIC').change(function(){
        var custmcnic = $(this).val();
        $.ajax({
            url: "<?php echo base_url('booking/getBookingByCNIC/'); ?>" + custmcnic,
            method: 'POST',
            dataType: 'json',
            data: {custmcnic: custmcnic},
            success: function(res){
                if(res.length > 0){
                    $('#bookingID').find('option').not(':first').remove();
                    $.each(res, function(index, data){
                        var status = data['bookingStatus'];
                        if(status == 0){ status = 'Inactive'; }
                        else{ status = ''; }
                        $('#bookingID').append('<option value="' + data['bookingId'] + '">' + data['membershipNo'] + '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;' + status + '</option>');
                    });
                    $(".custmName").html(res[0].custmName);

                    var father='';
                    if(res[0].fatherName==""){ father = "N/A"; }
                    else{ father = res[0].fatherName; }

                    $(".fathName").html(father);
                    $(".cutmCNIC").html(res[0].custmCNIC);
                    $(".custmContact").html(res[0].primaryPhone);

                    var emp='';
                    if(res[0].isEmployee==0){ emp = "No"; }
                    else{ emp = "Yes"; }
                    $(".custmEmp").html(emp);

                    var empStatus='';
                    if(res[0].custmStatus==0){ empStatus = "Inactive"; }
                    else{ empStatus = "Active"; }
                    $(".empStatus").html(empStatus);
                }else{
                    $('input, select').prop('disabled', true);
                    swal("Sorry","This customer does not have any booking.","info");
                }
            }
        });
    });
</script>