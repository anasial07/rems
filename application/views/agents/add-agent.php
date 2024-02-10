<div class="page-wrapper px-4">
    <div class="row">
        <div class="col">
            <div class="page-header mt-3">
                <div class="page-title">
                    <h4>Agent - Employee</h4>
                    <h6>Create & Manage Agent - Employee</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group">
                                <label>Employee Code</label>
                                <div class="input-groupicon">
                                    <input oninput="validateMix(event)" id="empCode" name="empCode" type="text" placeholder="Enter Employee Code">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group">
                                <label>Employee Name</label>
                                <div class="input-groupicon">
                                    <input oninput="validate(event)" id="empName" name="empName" type="text" placeholder="Enter Employee Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group">
                                <label>Employee Contact</label>
                                <div class="input-groupicon">
                                    <input oninput="validateNmbr(event)" id="empContact" name="empContact" type="text" placeholder="Enter Contact no">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group">
                                <label>Employee Email</label>
                                <div class="input-groupicon">
                                    <input id="empEmail" name="empEmail" type="text" placeholder="Enter Employee Email">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Select Designation</label>
                                <select id="empDesign" name="empDesign" class="form-control">
                                    <option selected disabled>Select Designation</option>
                                    <?php foreach($designations as $designation): ?>
                                        <option value="<?= $designation->desigId; ?>"><?= $designation->desigCode." - ".$designation->desigName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Select Department</label>
                                <select id="empDepart" name="empDepart" class="form-control">
                                    <option selected disabled>Select Department</option>
                                    <?php foreach($departments as $depart): ?>
                                        <option value="<?= $depart->departId; ?>"><?= $depart->departName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Select City</label>
                                <select id="empCity" name="empCity" class="form-control">
                                    <option selected disabled>Select City</option>
                                    <?php foreach($cities as $city): ?>
                                        <option value="<?= $city->locationId; ?>"><?= $city->locName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Select Office</label>
                                <select id="empOffice" name="empOffice" class="form-control">
                                    <option selected disabled>Select Office</option>
                                    <?php foreach($offices as $office): ?>
                                        <option value="<?= $office->officeId; ?>"><?= $office->officeName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Select Team</label>
                                <select id="empTeam" name="empTeam" class="form-control">
                                    <option selected disabled>Select Team</option>
                                    <?php foreach($teams as $team): ?>
                                        <option value="<?= $team->teamId; ?>"><?= $team->teamName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Report to</label>
                                <select id="reporto" name="reporto" class="form-control">
                                    <option selected disabled>Report to</option>
                                    <?php foreach($designations as $designation): ?>
                                        <option value="<?= $designation->desigId; ?>"><?= $designation->desigCode." - ".$designation->desigName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Select Manager</label>
                                <select id="empManger" name="empManger" class="form-control">
                                    <option selected disabled>Select Manager</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Date of Joining</label>
                                <div class="input-groupicon">
                                    <input id="empDOJ" name="empDOJ" type="text" placeholder="DD-MM-YYYY" class="datetimepicker">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icon/calendar.png'); ?>" alt="img" width="20">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <a class="btn form-control btn-submit me-2 addAgent">Add Agent / Employee</a>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <a href="javascript:history.go(-1);" class="btn form-control btn-cancel">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#reporto').change(function(){
        var id = $(this).val();
        $.ajax({
            url: "<?php echo base_url('agents/getManagers/'); ?>" + id,
            method: 'POST',
            dataType: 'JSON',
            data: {id: id},
            success: function(res){
                $('#empManger').find('option').not(':first').remove();
                $.each(res, function(index, data){
                    $('#empManger').append('<option value="' + data['agentId'] + '">' + data['agentName'] + '</option>');
                });
            }
        });
    });
    $('.addAgent').on('click', function(){
        var agentCode = $('#empCode').val();
        var agentName = $('#empName').val();
        var agentPhone = $('#empContact').val();
        var agentEmail = $('#empEmail').val();
        var designationId = $('#empDesign').val();
        var departId = $('#empDepart').val();
        var locationId = $('#empCity').val();
        var officeId = $('#empOffice').val();
        var doj = $('#empDOJ').val();
        var empTeam = $('#empTeam').val();
        var empManger = $('#empManger').val();
        if(agentCode!=="" && agentName!=="" && agentPhone!="" && agentEmail!=="" && designationId!=="Select Designation" && departId!=="Select Department" && locationId!=="Select City" && officeId!=="Select Office" && doj!==""){
            swal({
                title: "Are you sure?",
                text: "You want to add the agent!",
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
                        url: "<?php echo base_url("agents/saveAgent"); ?>",
                        type: "POST",
                        data: {
                            agentCode: agentCode,
                            agentName: agentName,
                            agentPhone: agentPhone,
                            agentEmail: agentEmail,
                            designationId: designationId,
                            departId: departId,
                            locationId: locationId,
                            officeId: officeId,
                            doj: doj,
                            empTeam: empTeam,
                            empManger: empManger
                        },
                        cache: false,
                        success: function(dataResult){
                            console.log(dataResult);
                            if(dataResult==true){
                                swal({
                                    title: "Congratulation!", 
                                    text: "Agent has been added successfully.", 
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
</script>