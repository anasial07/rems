<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Add New Customer</h4>
                <h6>Fill out the form</h6>
            </div>
            <div class="page-btn">
                <a href="javascript:void(0);" class="btn btn-submit me-2">Submit</a>
                <a href="javascript:history.go(-1);" class="btn btn-cancel">Back</a>
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
                                    <input type="text" placeholder="Enter CNIC without (-) dashes">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <input type="text" placeholder="Enter Customer full name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Father's Name</label>
                                    <input type="text" placeholder="Enter Father's name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Customer Email</label>
                                    <input type="text" placeholder="Enter Email i.e: abc@hmail.com">
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <div class="input-groupicon">
                                        <input type="text" placeholder="DD-MM-YYYY" class="datetimepicker">
                                        <div class="addonset">
                                            <img src="<?= base_url('assets/img/icons/calendars.svg'); ?>" alt="img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="form-group">
                                    <label>Primary Phone</label>
                                    <input type="text" placeholder="Primary Phone">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-12">
                                <div class="form-group">
                                    <label>Secondary Phone</label>
                                    <input type="text" placeholder="Optional">
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label>Select Location</label>
                                    <select class="form-control">
                                        <option selected disabled>Select Location</option>
                                        <!-- <option>Category</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label>Is Employee?</label>
                                    <select class="form-control">
                                        <option value="No">No - Customer is not our employee</option>
                                        <option value="Yes">Yes - Customer is our employee</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Present Address</label>
                                    <input type="text" placeholder="Present Address">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Permanent Address</label>
                                    <input type="text" placeholder="Enter complete permanent address">
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
                                    <input type="text" placeholder="Next of Kin Name">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Next of Kin CNIC</label>
                                    <input type="text" placeholder="Next of Kin CNIC">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Next of Kin Contact</label>
                                    <input type="text" placeholder="Next of Kin Contact">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label>Next of Kin Email</label>
                                    <input type="text" placeholder="Next of Kin Email">
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <div class="form-group">
                                    <label>Relation with NOK</label>
                                    <input type="text" placeholder="Relation with NOK">
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <div class="form-group">
                                    <div class="image-upload" style="height:160px!important;">
                                        <input type="file" id="uploadCustm" onchange="selected()">
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
<script>
    function selected(){
        var cutmImg=document.getElementById('uploadCustm');
        var baseUrl=document.getElementById('baseUrl').value;
        if(cutmImg.files.length>0){
            document.getElementById('custmSel').innerHTML="<span class='text-success'>Image selected</span> | <span class='text-danger'>Browse</span>";
            document.getElementById('logoCloud').src=baseUrl+"/assets/img/icon/check.png";
        }
    }
</script>