<style>
    .product-details{ height:90px!important; cursor: pointer; }
</style>
<?php $rights=explode(',',$userPermissions); ?>
<div class="page-wrapper px-4 mt-4">
    <div class="row">
        <div class="col">
            <div class="page-header mt-3">
                <div class="page-title">
                    <h4>Payment Plan</h4>
                    <h6>Create & Manage Payment Plans</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php if(in_array('createPayplan',$rights)): ?>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Project</label>
                                <select id="projID" name="projID" class="form-control">
                                    <option selected disabled>Select Project</option>
                                    <?php foreach($projects as $project): ?>
                                        <option value="<?= $project->projectId; ?>"><?= $project->projName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Select Category</label>
                                <select id="categoryID" name="categoryID" class="form-control">
                                    <option selected disabled>Select Category</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Select Sub-Category</label>
                                <select id="subCatID" name="subCatID" class="form-control">
                                    <option selected disabled>Select Sub-Category</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Select Type</label>
                                <select id="typeID" name="typeID" class="form-control">
                                    <option selected disabled>Select Type</option>
                                </select>
                            </div>
                        </div> -->
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label>Plan Name</label>
                                <div class="input-groupicon">
                                    <input oninput="validateMix(event)" id="planName" name="planName" type="text" placeholder="Enter Plan Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Plan Year</label>
                                <div class="input-groupicon">
                                    <input oninput="validateDecimal(event)" name="planYear" id="planYear" type="text" placeholder="Enter Plan Year">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icon/calendar.png'); ?>" alt="img" width="20">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Down Payment</label>
                                <div class="input-groupicon">
                                    <input oninput="validateNmbr(event)" name="downPay" id="downPay" type="text" placeholder="0.0">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icon/percent.png'); ?>" alt="img" width="16">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Confirmation</label>
                                <div class="input-groupicon">
                                    <input oninput="validateNmbr(event)" name="confirmation" id="confirmation" type="text" placeholder="0.0">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icon/percent.png'); ?>" alt="img" width="16">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Semi Annual</label>
                                <div class="input-groupicon">
                                    <input oninput="validateNmbr(event)" name="semiAnnual" id="semiAnnual" type="text" placeholder="0.0">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icon/percent.png'); ?>" alt="img" width="16">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Possession</label>
                                <div class="input-groupicon">
                                    <input oninput="validateNmbr(event)" name="possession" id="possession" type="text" placeholder="0.0">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icon/percent.png'); ?>" alt="img" width="16">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <a id="addPaymentPlan" class="btn form-control btn-submit me-2">Add Payment Plan</a>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <a href="javascript:history.go(-1);" class="btn form-control btn-cancel">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                                <a class="btn btn-filter" id="filter_search">
                                    <img src="<?= base_url('assets/img/icons/filter.svg') ?>" alt="img">
                                    <span><img src="<?= base_url('assets/img/icons/closes.svg') ?>" alt="img"></span>
                                </a>
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset"><img src="<?= base_url('assets/img/icons/search-white.svg') ?>" alt="img"></a>
                            </div>
                        </div>
                        <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="<?= base_url('assets/img/icons/printer.svg') ?>" alt="img"></a>
                            </li>
                        </ul>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table text-center datanew">
                    <thead>
                        <tr>
                            <!-- <th class="text-start">Project</th> -->
                            <!-- <th class="text-start">Sub-Category</th> -->
                            <!-- <th class="text-start">Type</th> -->
                            <th class="text-start">Plan Name</th>
                            <th class="text-start">Year</th>
                            <!-- <th>Down Payment</th>
                            <th>Confirmation</th>
                            <th>Semi Annual</th>
                            <th>Possession</th> -->
                            <th>Status</th>
                            <?php if(in_array('editPayplan', $rights) || in_array('deletePayplan', $rights)): ?>
                            <th>Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach($payPlans as $payPlan):
                            $status=$payPlan->planStatus;
                        ?>
                        <tr <?php if($status==0){ ?> style="background:#F7E4E7;" <?php } ?>>
                            <!-- <td class="text-start"><?= $payPlan->projCode; ?></td> -->
                            <!-- <td class="text-start"><?= $payPlan->subCatName; ?></td> -->
                            <!-- <td class="text-start"><?= $payPlan->marlaSize; ?> Marla</td> -->
                            <td class="text-start">
                                <?php
                                    echo $payPlan->planName;
                                    if($status==0){ echo "<p class='text-muted' style='font-size:10px;'>Deleted</p>"; }
                                ?>
                            </td>
                            <td class="text-start"><?= $payPlan->planYears; ?></td>
                            <!-- <td class="text-danger"><?= $payPlan->downPayment; ?>%</td>
                            <td class="text-danger"><?= $payPlan->confirmPay; ?>%</td>
                            <td class="text-danger"><?= $payPlan->semiAnnual; ?>%</td>
                            <td class="text-danger"><?= $payPlan->possession; ?>%</td> -->
                            <td class="text-center">
                                <?php if($status==1){ $val="Delete"; ?>
                                    <span class="badges bg-lightgreen">Active</span>
                                <?php }else{ $val="Recover"; ?>
                                    <span class="badges bg-lightred">Inactive</span>
                                <?php } ?>
                            </td>
                            <?php if(in_array('editPayplan', $rights) || in_array('deletePayplan', $rights)): ?>
                            <td>
                                <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a data-id="<?= $payPlan->payPlanId; ?>" data-bs-toggle="offcanvas" href="#editCanvas" class="dropdown-item payPlanDetail"><img src="<?= base_url('assets/img/icons/eye1.svg'); ?>" class="me-2" alt="img">View Detail</a>
                                    </li>
                                        <?php if(in_array('editPayplan', $rights)): ?>
                                        <li>
                                            <a href="" class="dropdown-item"><img src="<?= base_url('assets/img/icons/edit.svg'); ?>" class="me-2" alt="img">Edit Plan</a>
                                        </li>
                                        <?php endif; if(in_array('deletePayplan', $rights)): ?>
                                        <li class="delPayPlan" data-id="<?= $payPlan->payPlanId; ?>">
                                            <a class="dropdown-item confirm-text"><img src="<?= base_url('assets/img/icons/delete1.svg'); ?>" class="me-2" alt="img"><?= $val; ?> Plan</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<<<<<<< HEAD
    </div>
</div>
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
=======
>>>>>>> a027ff1302f86992f92d7b836705f8861eb92a08
<script>
    $('.payPlanDetail').click(function(){
        var planID = $(this).data('id');
        $.ajax({
            url: "<?php echo base_url('dashboard/getPlanDetail/'); ?>" + planID,
            method: 'POST',
            dataType: 'JSON',
            data: {planID: planID},
            success: function(res){
                $('#canvasBody').html('');
                $('#canvasTitle').text(res[0].planName);
                $('#notShow').text('');
                var downPayment = parseInt(res[0].downPayment) || 0;
                var confirmPay = parseInt(res[0].confirmPay) || 0;
                var semiAnnual = parseInt(res[0].semiAnnual) || 0;
                var possession = parseInt(res[0].possession) || 0;

                var Installments = 100 - (downPayment + confirmPay + semiAnnual + possession);
                $('#canvasBody').html(`
                    <table class="table">
<<<<<<< HEAD
=======
                        <tr>
                            <td>Plan Name</td>
                            <td>${res[0].planName}</td>
                        </tr>
                        <tr>
                            <td>Plan Year(s)</td>
                            <td>${res[0].planYears}</td>
                        </tr>
>>>>>>> a027ff1302f86992f92d7b836705f8861eb92a08
                        <tr class="bg-light">
                            <td class="fw-bold">
                                Down Payment
                                <span style='font-size:10px; font-weight:normal;' class='text-danger'>(Booking)</span>
                            </td>
                            <td>${res[0].downPayment}%</td>
                        </tr>
                        <tr class="bg-light">
                            <td class="fw-bold">Confirmation</td>
                            <td>${res[0].confirmPay}%</td>
                        </tr>
                        <tr class="bg-light">
                            <td class="fw-bold">Semi Annual</td>
                            <td>${res[0].semiAnnual}%</td>
                        </tr>
                        <tr class="bg-light">
                            <td class="fw-bold">Possession</td>
                            <td>${res[0].possession}%</td>
                        </tr>
                        <tr class="bg-light">
                            <td class='text-danger fw-bold'>
                                Installments
                                <p style='font-size:10px; font-weight:normal; margin-top:-5px;' class='text-danger'>(Starting a month after the booking)</p>
                            </td>
                            <td class='text-danger'>${Installments}%</td>
                        </tr>
                    </table>
                    <div class="row mt-5">
                        <div class="col">
                            <div id="chartdiv3"></div>
                        </div>
                    </div>
                `);
                renderPieChart(downPayment, confirmPay, semiAnnual, possession, Installments);
            }
        });
    });
    function renderPieChart(downPayment, confirmPay, semiAnnual, possession, Installments) {
        am4core.useTheme(am4themes_animated);
        var chart = am4core.create("chartdiv3", am4charts.PieChart);
        chart.data = [
            { "Title": "Down Pay", "Percent": downPayment },
            { "Title": "Confirmation", "Percent": confirmPay },
            { "Title": "Semi Annual", "Percent": semiAnnual },
            { "Title": "Possession", "Percent": possession },
            { "Title": "Installment", "Percent": Installments }
        ];
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "Percent";
        pieSeries.dataFields.category = "Title";
        pieSeries.slices.template.stroke = am4core.color("#fff");
        pieSeries.slices.template.strokeWidth = 2;
        pieSeries.slices.template.strokeOpacity = 1;
        pieSeries.hiddenState.properties.opacity = 1;
        pieSeries.hiddenState.properties.endAngle = -90;
        pieSeries.hiddenState.properties.startAngle = -90;
        pieSeries.labels.template.fontSize = 11;
    }
    $('#addPaymentPlan').on('click', function(){
        // var projID = $('#projID').val();
        // var categoryID = $('#categoryID').val();
        // var subCatID = $('#subCatID').val();
        // var typeID = $('#typeID').val();
        var planName = $('#planName').val();
        var planYear = $('#planYear').val();
        var downPay = $('#downPay').val();
        var confirmation = $('#confirmation').val();
        var semiAnnual = $('#semiAnnual').val();
        var possession = $('#possession').val();
        if(planName!="" && planYear!="" && downPay!="" && confirmation!="" && semiAnnual!="" && possession!=""){
            swal({
                title: "Are you sure?",
                text: "You want to add the payment plan!",
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
                        url: "<?php echo base_url("dashboard/addPaymentPlan"); ?>",
                        type: "POST",
                        data: {
                            // projectId: projID,
                            // catId: categoryID,
                            // subCatId: subCatID,
                            // typeId: typeID,
                            planName: planName,
                            planYears: planYear,
                            downPayment: downPay,
                            confirmPay: confirmation,
                            semiAnnual: semiAnnual,
                            possession: possession
                        },
                        cache: false,
                        success: function(dataResult){
                            if(dataResult==true){
                                swal({
                                    title: "Congratulation!", 
                                    text: "Payment Plan has been added successfully.", 
                                    type: "success"
                                    },function(){ 
                                        location.reload();
                                    }
                                );
                            }else{
                                swal("Ops!", "Something went wrong.", "error");
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
        projID = $(this).val();
        $.ajax({
            url: "<?php echo base_url('dashboard/getCats/'); ?>" + projID,
            method: 'POST',
            dataType: 'JSON',
            data: {projID: projID},
            success: function(res){
                $('#categoryID').find('option').not(':first').remove();
                $.each(res, function(index, data){
                    $('#categoryID').append('<option value="' + data['catId'] + '">' + data['catName'] + '</option>');
                });
            }
        });
    });
    $('#categoryID').change(function(){
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
    $('.delPayPlan').click(function(){
        var id = $(this).data('id');
        swal({
            title: "Are you sure?",
            text: "You want to change the status!",
            type: "info",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonClass: "btn-success",
            confirmButtonText: "Yes, change",
            cancelButtonClass: "btn-primary",
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if(isConfirm){
                $.ajax({
                    url: "<?php echo base_url("dashboard/deletePayPlan/"); ?>" + id,
                    method: 'POST',
                    dataType: 'JSON',
                    data: {id: id},
                    success: function(res){
                        if(res==true){
                            window.location.reload();
                        }else{
                            swal("Ops", "Something went wrong", "info");
                        }
                    }
                });
            }else{
                swal.close()
            }
        });
    });
</script>