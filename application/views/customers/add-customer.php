<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Add New Customer</h4>
                <h6>Fill out the form</h6>
            </div>
            <div class="page-btn">
                <a class="btn btn-primary text-white me-2 addCustomer">Add Customer</a>
                <a class="btn btn-danger me-2" data-bs-toggle="offcanvas" data-bs-target="#captureLivePic" aria-controls="offcanvasTop"><i class="fa fa-camera"></i></a>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Customer CNIC</label>
                                    <input maxlength="13" oninput="validateNmbr(event)" id="custCNIC" name="custCNIC" type="text" placeholder="Enter CNIC without (-) dashes">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <input oninput="validate(event)" id="custName" name="custName" type="text" placeholder="Enter Customer full name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Father's Name</label>
                                    <input oninput="validate(event)" id="custFather" name="custFather" type="text" placeholder="Enter Father's name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Customer Email</label>
                                    <input oninput="validateEmail(event)" id="custEmail" name="custEmail" type="text" placeholder="Enter Email i.e: abc@gmail.com">
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <div class="input-groupicon">
                                        <input id="custDOB" name="custDOB" type="text" placeholder="DD-MM-YYYY" class="datetimepicker">
                                        <div class="addonset">
                                            <img src="<?= base_url('assets/img/icon/calendar.png'); ?>" alt="img" width="20">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="form-group">
                                    <label>Primary Phone</label>
                                    <input maxlength="13" oninput="validateNmbr(event)" id="custPrimary" name="custPrimary" type="text" placeholder="Primary Phone">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="form-group">
                                    <label>Secondary Phone</label>
                                    <input maxlength="13" oninput="validateNmbr(event)" id="custSecondary" name="custSecondary" type="text" placeholder="Optional">
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label>Select Location</label>
                                    <select id="custCity" name="custCity" class="form-control">
                                        <option selected disabled>Select Location</option>
                                        <?php foreach($cities as $city): ?>
                                            <option value="<?= $city->locationId; ?>"><?= $city->locName; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-3">
                                <div class="status-toggle mt-4">
                                    <span id="empSh">Customer</span>
                                    <input onclick="isEmploye(this.value)" value="0" type="checkbox" id="isEmployee" class="check" checked>
                                    <label for="isEmployee" class="checktoggle">checkbox</label>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-3">
                                <div class="status-toggle mt-4">
                                <span id="genSh">Male</span>
                                <input onclick="gender(this.value)" value="1" type="checkbox" id="gender" class="check" checked>
                                    <label for="gender" class="checktoggle">checkbox</label>
                                </div>
                            </div>
                            <!-- <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label>Is Employee?</label>
                                    <select id="isEmployee" name="isEmployee" class="form-control">
                                        <option value="No">No - Customer is not our employee</option>
                                        <option value="Yes">Yes - Customer is our employee</option>
                                    </select>
                                </div>
                            </div> -->
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Present Address</label>
                                    <input id="custPresent" name="custPresent" type="text" placeholder="Present Address">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Permanent Address</label>
                                    <input id="custPermanent" name="custPermanent" type="text" placeholder="Enter complete permanent address">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-1 col-sm-12"></div>
                    <div class="col">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Next of Kin Name</label>
                                    <input oninput="validate(event)" id="NOKname" name="NOKname" type="text" placeholder="Next of Kin Name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Next of Kin CNIC</label>
                                    <input maxlength="13" oninput="validateNmbr(event)" id="NOKcnic" name="NOKcnic" type="text" placeholder="Next of Kin CNIC">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Next of Kin Contact</label>
                                    <input maxlength="11" oninput="validateNmbr(event)" id="NOKcontact" name="NOKcontact" type="text" placeholder="Next of Kin Contact">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Next of Kin Email</label>
                                    <input oninput="validateEmail(event)" id="NOKemail" name="NOKemail" type="text" placeholder="Next of Kin Email">
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <div class="form-group">
                                    <label>Relation with NOK</label>
                                    <input oninput="validate(event)" id="NOKrelation" name="NOKrelation" type="text" placeholder="Relation with NOK">
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <div class="form-group">
                                    <div class="image-upload" style="height:160px!important;">
                                        <input type="file" id="uploadCustm" name="custmPic" onchange="selected()">
                                        <div class="image-uploads my-2">
                                            <img id="logoCloud" width="45" src="<?= base_url('assets/img/icons/upload.svg'); ?>" alt="img">
                                            <h4 id="custmSel">Browse and Upload Customer Image</h4>
                                            <small style="font-size:12px;" class="text-muted">Ensure that the image size does not exceed 1MB</small>
                                        </div>
                                        <input type="hidden" id="baseUrl" value="<?= base_url(); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="offcanvas offcanvas-end" tabindex="-1" id="captureLivePic" aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Offcanvas top</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        
    </div>
</div>
<script>
    $('.addCustomer').on('click', function () {
        var formData = new FormData();
        formData.append('custCNIC', $('#custCNIC').val());
        formData.append('custName', $('#custName').val());
        formData.append('custFather', $('#custFather').val());
        formData.append('custEmail', $('#custEmail').val());
        formData.append('custDOB', $('#custDOB').val());
        formData.append('custPrimary', $('#custPrimary').val());
        formData.append('custSecondary', $('#custSecondary').val());
        formData.append('custCity', $('#custCity').val());
        formData.append('isEmployee', $('#isEmployee').val());
        formData.append('gender', $('#gender').val());
        formData.append('custPresent', $('#custPresent').val());
        formData.append('custPermanent', $('#custPermanent').val());
        formData.append('NOKname', $('#NOKname').val());
        formData.append('NOKcnic', $('#NOKcnic').val());
        formData.append('NOKcontact', $('#NOKcontact').val());
        formData.append('NOKemail', $('#NOKemail').val());
        formData.append('NOKrelation', $('#NOKrelation').val());
        var custmPicFile = $('#uploadCustm')[0].files[0];
        if (custmPicFile) {
            formData.append('custmPic', custmPicFile);
        } else {
            var defaultImageName = 'default.jpg';
            formData.append('custmPic', defaultImageName);
        }
        if (formData.get('custCNIC') !== "" && formData.get('custName') !== "" && formData.get('custCity') != "Select Location" && formData.get('custPrimary') !== "") {
            swal({
                title: "Are you sure?",
                text: "You want to add the customer!",
                type: "info",
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Yes, add it!",
                cancelButtonClass: "btn-primary",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                function (isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "<?php echo base_url('customers/saveCustomer'); ?>",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            cache: false,
                            success: function (dataResult) {
                                if (dataResult == true) {
                                    swal({
                                        title: "Congratulations!",
                                        text: "Customer has been added successfully.",
                                        type: "success"
                                    },
                                        function () {
                                            location.reload();
                                        }
                                    );
                                } else {
                                    swal("Ops!", "Something went wrong.", "error");
                                }
                            }
                        });
                    } else {
                        swal.close()
                    }
                });
        } else {
            swal("Sorry!", "Please fill the mandatory fields.", "info");
        }
    });
    function selected(){
        var cutmImg=document.getElementById('uploadCustm');
        var baseUrl=document.getElementById('baseUrl').value;
        if(cutmImg.files.length>0){
            document.getElementById('custmSel').innerHTML="<span class='text-success'>Image selected</span> | <span class='text-danger'>Browse</span>";
            document.getElementById('logoCloud').src=baseUrl+"/assets/img/icon/check.png";
        }
    }
    function gender(gen){
        if(gen==1){
            document.getElementById('gender').value=0;
            document.getElementById('genSh').innerHTML='Female';
        }else{
            document.getElementById('gender').value=1;
            document.getElementById('genSh').innerHTML='Male';
        }
    }
    function isEmploye(emp){
        if(emp==0){
            document.getElementById('isEmployee').value=1;
            document.getElementById('empSh').innerHTML='Employee';
        }else{
            document.getElementById('isEmployee').value=0;
            document.getElementById('empSh').innerHTML='Customer';
        }
    }
</script>