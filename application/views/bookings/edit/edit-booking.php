<div class="page-wrapper px-4 mt-4">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <div class="page-title">
                    <h4>Edit Booking - <span class="text-primary"><?= $bookingInfo[0]->membershipNo; ?></span></h4>
                    <h6>Modify Your Booking</h6>
                </div>
            </div>
        </div>
        <div class="col text-end">
            Booking Date: <?= date('d M, Y l',strtotime($bookingInfo[0]->purchaseDate)); ?><br>
            Booked By: <span class="text-danger"><?= $bookingInfo[0]->empName; ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Select Project</label>
                                <input type="hidden" id="projectCode">
                                <input type="hidden" id="projectBasePrice">
                                <select id="projID" class="form-control">
                                    <option disabled>Select Project</option>
                                    <?php foreach($projects as $project): ?>
                                        <option <?= ($project->projectId==$bookingInfo[0]->projID) ? 'selected' : ''; ?> value="<?= $project->projectId; ?>"><?= $project->projName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Select Category</label>
                                <select id="catID" class="form-control">
                                    <option disabled>Select Category</option>
                                    <?php foreach($categories as $cat): ?>
                                        <option <?= ($cat->catId==$bookingInfo[0]->catId) ? 'selected' : ''; ?> value="<?= $cat->catId; ?>"><?= $cat->catName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Select Sub-Category</label>
                                <select id="subCatID" class="form-control">
                                    <option disabled>Select Sub-Category</option>
                                    <?php foreach($subCategories as $subCat): ?>
                                        <option <?= ($subCat->subCatId==$bookingInfo[0]->subCatID) ? 'selected' : ''; ?> value="<?= $subCat->subCatId; ?>"><?= $subCat->subCatName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <input type="hidden" id="typeSize">
                                <input type="hidden" id="typeAmount">
                                <input type="hidden" id="typeDiscount">
                                <label>Select Type</label>
                                <select id="typeID" class="form-control">
                                    <option disabled>Select Type</option>
                                    <?php foreach($types as $type): ?>
                                        <option <?= ($type->typeId==$bookingInfo[0]->typeID) ? 'selected' : ''; ?> value="<?= $type->typeId; ?>"><?= $type->typeName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <input type="hidden" id="customerID">
                                <label>Customer CNIC</label>
                                <div class="input-groupicon">
                                    <input maxlength="13" value="<?= $bookingInfo[0]->custmCNIC; ?>" oninput="validateNmbr(event)" id="custCNIC" type="text" placeholder="without (-) dashes">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Select City</label>
                                <select id="cityID" class="form-control">
                                    <option disabled>Select City</option>
                                    <?php foreach($cities as $city): ?>
                                        <option <?= ($city->locationId==$bookingInfo[0]->cityID) ? 'selected' : ''; ?> value="<?= $city->locationId; ?>"><?= $city->locName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Select Agent</label>
                                <select id="agentID" class="form-control">
                                    <option disabled>Select Agent</option>
                                    <?php foreach($agents as $agent): ?>
                                        <option <?= ($agent->agentId==$bookingInfo[0]->agentID) ? 'selected' : ''; ?> value="<?= $agent->agentId; ?>"><?= $agent->agentName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Special Discount</label>
                                <div class="input-groupicon">
                                    <input value="<?= $bookingInfo[0]->sepDiscount; ?>" oninput="validateDecimal(event)" id="sepDiscount" type="text" placeholder="0.0">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icon/percent.png'); ?>" alt="img" width="18">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Amount Paid/Down Payment</label>
                                <div class="input-groupicon">
                                    <input value="<?= $bookingInfo[0]->bookingAmount; ?>" oninput="validateNmbr(event)" id="paidAmount" type="text" placeholder="0.0">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icon/rs.png'); ?>" alt="img" width="22">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $paymentMode=array('Cash','Cheque','IBFT','Wire Transfer','Pay Order'); ?>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Select Payment Mode</label>
                                <select id="paymentMode" class="form-control">
                                    <option selected disabled>Payment Mode</option>
                                    <?php foreach ($paymentMode as $payMode): ?>
                                    <option <?= ($payMode==$bookingInfo[0]->bookingMode) ? 'selected' : ''; ?> value="<?= $payMode; ?>"><?= $payMode; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="refBank">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Reference no</label>
                                <div class="input-groupicon">
                                    <input value="<?= $bookingInfo[0]->bookingReferenceNo; ?>" oninput="validateNmbr(event)" id="referenceNo" type="text" placeholder="Reference no">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-11 col-lg-5">
                            <div class="form-group">
                                <label>Select Bank</label>
                                <select id="bank_name" class="form-control">
                                    <option selected disabled>Select Bank</option>
                                    <?php foreach($banks as $bank): ?>
                                        <option <?= ($bank->bankId==$bookingInfo[0]->bookBankId) ? 'selected' : ''; ?> value="<?= $bank->bankId; ?>"><?= $bank->bankName; ?></option>
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
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Received In</label>
                                <select id="receivedIn" class="form-control">
                                    <option disabled>Select Location</option>
                                    <?php foreach($cities as $city): ?>
                                        <option <?= ($city->locationId==$bookingInfo[0]->bookReceivedIn) ? 'selected' : ''; ?> value="<?= $city->locationId; ?>"><?= $city->locName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Select Payment Plan</label>
                                <select id="payPlanID" class="form-control">
                                    <option disabled>Select Payment Plan</option>
                                    <?php foreach($payPlans as $payPlan): ?>
                                        <option <?= ($payPlan->payPlanId==$bookingInfo[0]->payPlanID) ? 'selected' : ''; ?> value="<?= $payPlan->payPlanId; ?>"><?= $payPlan->planYears.' Year &emsp;(' .$payPlan->downPayment.'% - ' .$payPlan->confirmPay.'% - ' .$payPlan->semiAnnual.'% - ' .$payPlan->possession.'%)' ; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Extra Land Charges</label>
                                <div class="input-groupicon">
                                    <input value="<?= $bookingInfo[0]->exCharges; ?>" oninput="validateNmbr(event)" id="exCharges" type="text" placeholder="0.0">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icon/rs.png'); ?>" alt="img" width="22">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Purchase Date</label>
                                <div class="input-groupicon">
                                    <input value="<?= $bookingInfo[0]->purchaseDate; ?>" oninput="validateDate(event)" id="purchaseDate" type="text" placeholder="DD-MM-YYYY" class="datetimepicker">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icon/calendar.png'); ?>" alt="img" width="20">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Filer Status</label>
                                <select id="filerStatus" class="form-control">
                                    <option <?= ('Inactive'==$bookingInfo[0]->bookFilerStatus) ? 'selected' : ''; ?> value="Inactive">Inactive</option>
                                    <option <?= ('Active'==$bookingInfo[0]->bookFilerStatus) ? 'selected' : ''; ?> value="Active">Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Tax Percentage</label>
                                <div class="input-groupicon">
                                    <input value="<?= $bookingInfo[0]->bookFilerPercent; ?>" oninput="validateDecimal(event)" id="filerPercent" type="text" placeholder="0.0">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icon/percent.png'); ?>" alt="img" width="18">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $bokFeatures=explode(",",$bookingInfo[0]->features); ?>
                        <div class="col-sm-12 col-lg-6">
                            <label>Features</label>
                            <div class="row mt-3">
                                <div class="col-4">
                                    <input <?php if(in_array("Corner", $bokFeatures)){ echo "checked"; } ?> id="cornerFeature" value="Corner" name="feature-charges[]" type="checkbox">
                                    <label for="cornerFeature">
                                        <span class="checkmarks"></span>Corner
                                    </label>
                                </div>
                                <div class="col-4">
                                    <input <?php if(in_array("Boulevard", $bokFeatures)){ echo "checked"; } ?> id="boulevardFeature" value="Boulevard" name="feature-charges[]" type="checkbox">
                                    <label for="boulevardFeature">
                                        <span class="checkmarks"></span>Boulevard
                                    </label>
                                </div>
                                <div class="col">
                                    <input <?php if(in_array("Park Facing", $bokFeatures)){ echo "checked"; } ?> id="parkFacingFeature" value="Park Facing" name="feature-charges[]" type="checkbox">
                                    <label for="parkFacingFeature">
                                        <span class="checkmarks"></span>Park Facing
                                    </label>
                                </div>
                            </div>    
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <a class="btn form-control btn-submit me-2 addBooking">Confirm and Submit Booking</a>
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
                                        <h4>Name</h4>
                                        <h5 id="custmName"><?= $bookingInfo[0]->custmName; ?></h5>
                                    </li>
                                    <li>
                                        <h4>Employee</h4>
                                        <h5 id="custmEmp">
                                            <?= ($bookingInfo[0]->isEmployee==1) ? 'Employee' : 'Customer'; ?>
                                        </h5>
                                    </li>
                                    <li>
                                        <h4>Status</h4>
                                        <h5 id="custmStatus">
                                            <?= ($bookingInfo[0]->custmStatus==1) ? 'Active' : 'Inactive'; ?>
                                        </h5>
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
                                <h6 class="text-muted fw-bold text-center mb-2 showPlaName"><?= $bookingInfo[0]->planName; ?></h6>
                                <ul>
                                    <li>
                                        <h4>Payment Plan</h4>
                                        <h5><span class="showPayPlan"><?= $bookingInfo[0]->planYears; ?></span> Yr(s)</h5>
                                    </li>
                                    <li>
                                        <h4>Down Payment</h4>
                                        <h5><span class="showDownPay"><?= $bookingInfo[0]->downPayment; ?></span> &middot; %</h5>
                                    </li>
                                    <li>
                                        <h4>Confirmation</h4>
                                        <h5><span class="showConfirm"><?= $bookingInfo[0]->confirmPay; ?></span> &middot; %</h5>
                                    </li>
                                    <li>
                                        <h4>Semi Annual</h4>
                                        <h5><span class="showSemiAn"><?= $bookingInfo[0]->semiAnnual; ?></span> &middot; %</h5>
                                    </li>
                                    <li>
                                        <h4>Possession</h4>
                                        <h5><span class="showPossession"><?= $bookingInfo[0]->possession; ?></span> &middot; %</h5>
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
                                        <h4>Features</h4>
                                        <h5><span class="showFeatures"><?= $bookingInfo[0]->featuresPercent; ?></span> &middot; %</h5>
                                        <input type="hidden" id="featuresPercent">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        Feature Charges are <strong>10%</strong> of the total amount for each feature.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$('.addBooking').on('click', function(){
        var projID = $('#projID').val();
        var catID = $('#catID').val();
        var subCatID = $('#subCatID').val();
        var typeID = $('#typeID').val();
        var cityID = $('#cityID').val();
        var agentID = $('#agentID').val();
        var sepDiscount = $('#sepDiscount').val();
        var paidAmount = $('#paidAmount').val();
        var paymentMode = $('#paymentMode').val();
        var referenceNo = $('#referenceNo').val();
        var bank_name = $('#bank_name').val();
        var receivedIn = $('#receivedIn').val();
        var payPlanID = $('#payPlanID').val();
        var exCharges = $('#exCharges').val();
        var purchaseDate = $('#purchaseDate').val();
        var filerStatus = $('#filerStatus').val();
        var filerPercent = $('#filerPercent').val();
        var projectCode = $('#projectCode').val();
        var projectBasePrice = $('#projectBasePrice').val();
        var typeSize = $('#typeSize').val();
        var typeDiscount = $('#typeDiscount').val();
        var custmID = $('#customerID').val();
        var featuresPercent = $('#featuresPercent').val();
        var typeAmount = $('#typeAmount').val();
        var features = [];
        $('input[name="feature-charges[]"]:checked').each(function() {
            features.push($(this).val());
        });
        if(paidAmount!="" && purchaseDate!="" && custmID!="" && filerPercent!=""){
            swal({
                title: "Are you sure?",
                text: "You want to add the booking!",
                type: "info",
                showCancelButton: true,
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
                        url: "<?php echo base_url("booking/saveBooking"); ?>",
                        type: "POST",
                        data: {
                            projID: projID,
                            catID: catID,
                            subCatID: subCatID,
                            typeID: typeID,
                            cityID: cityID,
                            agentID: agentID,
                            sepDiscount: sepDiscount,
                            paidAmount: paidAmount,
                            paymentMode: paymentMode,
                            referenceNo: referenceNo,
                            bank_name: bank_name,
                            receivedIn: receivedIn,
                            payPlanID: payPlanID,
                            exCharges: exCharges,
                            purchaseDate: purchaseDate,
                            filerStatus: filerStatus,
                            filerPercent: filerPercent,
                            projectCode: projectCode,
                            projectBasePrice: projectBasePrice,
                            typeSize: typeSize,
                            typeDiscount: typeDiscount,
                            customerID: custmID,
                            featuresPercent: featuresPercent,
                            typeAmount: typeAmount,
                            features: features
                        },
                        cache: false,
                        success: function(dataResult){
                            if(dataResult.indexOf('/') !== -1){
                                swal({
                                    title: "Congratulation!", 
                                    text: "Booking has been successfully added for Membership# "+dataResult, 
                                    type: "success"
                                    },function(){ 
                                        location.reload();
                                    }
                                );
                            }else{
                                swal("Ops!","Something went wrong.","error");
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
    $('#projID').change(function(){
        var projID = $(this).val();
        $.ajax({
            url: "<?php echo base_url('dashboard/getCats/'); ?>" + projID,
            method: 'POST',
            dataType: 'json',
            data: {projID: projID},
            success: function(res){
                $('#catID').find('option').not(':first').remove();
                $.each(res, function(index, data){
                    $('#catID').append('<option value="' + data.catId + '">' + data.catName + '</option>');
                });
                getPaymentPlans(projID);
                projectInfo(projID);
            }
        });
    });
    $('#catID').change(function(){
        var catId = $(this).val();
        $.ajax({
            url: "<?php echo base_url('dashboard/getSubCats/'); ?>" + catId,
            method: 'POST',
            dataType: 'json',
            data: {catId: catId},
            success: function(res){
                $('#subCatID').find('option').not(':first').remove();
                $.each(res, function(index, data){
                    $('#subCatID').append('<option value="' + data['subCatId'] + '">' + data['subCatName'] + '</option>');
                });
            }
        });
    });
    $('#subCatID').change(function(){
        var subCatID = $(this).val();
        $.ajax({
            url: "<?php echo base_url('dashboard/getTypes/'); ?>" + subCatID,
            method: 'POST',
            dataType: 'json',
            data: {subCatID: subCatID},
            success: function(res){
                $('#typeID').find('option').not(':first').remove();
                $.each(res, function(index, data){
                    $('#typeID').append('<option value="' + data['typeId'] + '">' + data['typeName'] + '</option>');
                });
            }
        });
    });
    // $('#typeID').change(function(){
    //     var typeID = $(this).val();
    //     $.ajax({
    //         url: "<?php echo base_url('dashboard/typeInfo/'); ?>" + typeID,
    //         method: 'POST',
    //         dataType: 'json',
    //         data: {typeID: typeID},
    //         success: function(res){
    //             $('#typeAmount').val(res[0].totalPrice);
    //         }
    //     });
    // });
    $('#cityID').change(function(){
        var cityID = $(this).val();
        $.ajax({
            url: "<?php echo base_url('dashboard/cityAgents/'); ?>" + cityID,
            method: 'POST',
            dataType: 'json',
            data: {cityID: cityID},
            success: function(res){
                $('#agentID').find('option').not(':first').remove();
                $.each(res, function(index, data){
                    $('#agentID').append('<option value="' + data['agentId'] + '">' + data['agentName'] + '</option>');
                });
            }
        });
    });
    function getPaymentPlans(projID){
        $.ajax({
            url: "<?php echo base_url('dashboard/getPayPlans/'); ?>" + projID,
            method: 'POST',
            dataType: 'json',
            data: { projID: projID },
            success: function(res){
                $('#payPlanID').find('option').not(':first').remove();
                $.each(res, function(index, data){
                    $('#payPlanID').append('<option value="' + data.payPlanId + '">' + data.planYears + ' Year &emsp;(' + data.downPayment + '% - ' + data.confirmPay + '% -  ' + data.semiAnnual + '% - ' + data.possession + '% )</option>');
                });
            }
        });
    }
    function projectInfo(projID){
        $.ajax({
            url: "<?php echo base_url('dashboard/projectDetail/'); ?>" + projID,
            method: 'POST',
            dataType: 'json',
            data: { projID: projID },
            success: function(res){
                $('#projectCode').val(res[0].projCode);
                $('#projectBasePrice').val(res[0].projBasePrice);
            }
        });
    }
    $('#custCNIC').change(function(){
        var cnic = $(this).val();
        $.ajax({
            url: '<?= base_url('customers/getCustmInfo/'); ?>' + cnic,
            method: 'POST',
            dataType: 'JSON',
            success: function(data){
                if(data){
                    $('#customerID').val(data.customerId);
                    $('#custmName').text(data.custmName);
                    if(data.isEmployee == 1){
                        $('#custmEmp').html('Employee');
                    }else{
                        $('#custmEmp').html('Customer');
                    }
                    if(data.custmStatus == 1){
                        $('#custmStatus').html('Active').addClass('text-success');
                    }else{
                        $('#custmStatus').html('Inactive').addClass('text-danger');
                        $('input, select').prop('disabled', true);
                        swal({
                            title: "Sorry!",
                            text: "This customer's status is inactive",
                            type: "info",
                            showCancelButton: true,
                            confirmButtonClass: "btn-success",
                            confirmButtonText: "Reset, form!",
                            cancelButtonClass: "btn-primary",
                            cancelButtonText: "No, cancel!",
                            closeOnConfirm: false,
                            closeOnCancel: true
                        },
                        function(isConfirm){
                            if(isConfirm){
                                window.location.reload();
                            }
                        });
                    }
                }else{
                    $('#custmName').text('-');
                    $('#custmEmp').html('-');
                    $('input, select').prop('disabled', true);
                    swal({
                        title: "Sorry!",
                        text: "There is no customer associated with the provided CNIC ("+cnic+")",
                        type: "info",
                        showCancelButton: true,
                        confirmButtonClass: "btn-success",
                        confirmButtonText: "Reset, form!",
                        cancelButtonClass: "btn-primary",
                        cancelButtonText: "No, cancel!",
                        closeOnConfirm: false,
                        closeOnCancel: true
                    },
                    function(isConfirm){
                        if(isConfirm){
                            window.location.reload();
                        }
                    });
                }
            }
        });
    });
    $('#payPlanID').change(function(){
        var planId = $(this).val();
        $.ajax({
            url: '<?= base_url('dashboard/getPayPlan/'); ?>' + planId,
            method: 'POST',
            dataType: 'JSON',
            success: function(data){
                if(data){
                    $('.showPlaName').html(data.planName);
                    $('.showPayPlan').html(data.planYears);
                    $('.showDownPay').html(data.downPayment);
                    $('.showConfirm').html(data.confirmPay);
                    $('.showSemiAn').html(data.semiAnnual);
                    $('.showPossession').html(data.possession);
                }
            }
        });
    });
    $('#typeID').change(function(){
        var typeID = $(this).val();
        $.ajax({
            url: '<?= base_url('dashboard/getTypeInfo/'); ?>' + typeID,
            method: 'POST',
            dataType: 'JSON',
            success: function(data){
                if(data){
                    $('#typeSize').val(data[0].marlaSize);
                    $('#typeDiscount').val(data[0].discount);
                    $('#typeAmount').val(data[0].totalPrice);
                }
            }
        });
    });
    $('input[name="feature-charges[]"]').change(function () {
        var checkedCheckboxes = $('input[name="feature-charges[]"]:checked');
        var featurePercent = checkedCheckboxes.length === 3 ? 25 : checkedCheckboxes.length * 10;

        $('.showFeatures').text(featurePercent);
        $('#featuresPercent').val(featurePercent);
    })
</script>