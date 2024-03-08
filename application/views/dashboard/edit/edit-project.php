<div class="page-wrapper px-4 mt-4">
    <div class="row">
        <div class="col-lg-1 col-sm-12"></div>
        <div class="col-7">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label>Project Code</label>
                                <div class="input-groupicon">
                                    <input oninput="validate(event)" id="projectCode" type="text" placeholder="Enter Project Code" value="<?= $projInfo[0]->projCode; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label>Project Name</label>
                                <div class="input-groupicon">
                                    <input oninput="validateProject(event)" id="projectName" type="text" placeholder="Enter Project Name" value="<?= $projInfo[0]->projName; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label>Select Location</label>
                                <select id="projectCity" class="form-control">
                                    <option disabled>Select Location</option>
                                    <?php foreach($cities as $city): ?>
                                        <option <?= ($projInfo[0]->projLocation == $city->locationId) ? 'selected' : ''; ?> value="<?= $city->locationId; ?>"><?= $city->locName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group">
                                <label>Project Area</label>
                                <div class="input-groupicon">
                                    <input oninput="validateNmbr(event)" id="projectArea" type="text" placeholder="Project Area" value="<?= $projInfo[0]->projArea; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group">
                                <label>Base Price</label>
                                <div class="input-groupicon">
                                    <input oninput="validateNmbr(event)" id="basePrice" type="text" placeholder="0.0" value="<?= $projInfo[0]->projBasePrice; ?>">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icon/rs.png'); ?>" alt="img" width="21">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="page-header">
                                <div class="page-title">
                                    <h6>Setup Details for Letterhead Excellence</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label>Website Address</label>
                                <div class="input-groupicon">
                                    <input id="webAddress" type="text" placeholder="eg: www.ahgroup-pk.com" value="<?= $projInfo[0]->webAddress; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label>E-mail Address</label>
                                <div class="input-groupicon">
                                    <input id="mailAddress" type="text" placeholder="eg: info@ahgroup-pk.com" value="<?= $projInfo[0]->mailAddress; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label>Complete Address</label>
                                <div class="input-groupicon">
                                    <input id="projAddress" type="text" placeholder="Project Address" value="<?= $projInfo[0]->projAddress; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group" style="padding:0 4% 0 4%;">
                                <input type="file" id="projLogo" onchange="selected()" style="display:none;">
                                <label>Project Logo</label>
                                <label for="projLogo">
                                    <div class="row" style="height:40px!important; border:1px solid #DCE0E4; border-radius:5px; cursor:pointer;">
                                        <div class="col pt-2 text-muted">
                                            <span id="logoSel">Browse an image to upload</span>
                                        </div>
                                        <div class="col-3 text-end">
                                            <img id="logoCloud" src="<?= base_url('assets/img/icons/upload.svg'); ?>" width="36" alt="img">
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <a class="btn form-control btn-submit me-2" id="updateProject">Save Changes</a>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <a href="javascript:history.go(-1);" class="btn form-control btn-cancel">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="card mt-4">
                        <div class="card-body">
                            <img src="<?= base_url('uploads/letterHead/').$projInfo[0]->projLogo; ?>"><br>
                            <span style="font-size:10px;"><?= $projInfo[0]->projLogo; ?></span>
                            <input type="hidden" id="oldProjLogo" value="<?= $projInfo[0]->projLogo; ?>">
                            <input type="hidden" id="projId" value="<?= $projInfo[0]->projectId; ?>">
                            <input type="hidden" id="baseUrl" value="<?= base_url(); ?>">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <i class="	fas fa-user-edit text-muted"></i>&emsp;Added By: <span class="text-primary"><?= $projInfo[0]->empName; ?></span><br>
                            <i class="far fa-calendar-alt text-muted"></i>&emsp;&nbsp;Last Update: 
                            <?php
                                if($projInfo[0]->updatedProj==0){
                                    echo "<span class='text-danger'>Not updated yet.</span>";
                                }else{
                                    echo "<span class='text-danger'>".date('d M, Y g:i:s A',strtotime($projInfo[0]->updatedProj))."</span>";
                                }
                            ?><br>
                            <a href="" class="text-muted"><i class="fas fa-recycle"></i>&emsp;Click here to view project logs activity</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#updateProject').on('click', function () {
        var projId = $('#projId').val();
        var projectCode = $('#projectCode').val();
        var projectName = $('#projectName').val();
        var projectCity = $('#projectCity').val();
        var projectArea = $('#projectArea').val();
        var basePrice = $('#basePrice').val();
        var webAddress = $('#webAddress').val();
        var mailAddress = $('#mailAddress').val();
        var projAddress = $('#projAddress').val();
        var oldProjLogo = $('#oldProjLogo').val();
        var projLogo = $('#projLogo')[0].files[0];

        if (projectCode !== "" && projectName !== "" && projectCity !== "Select Location" &&
            projectArea !== "" && basePrice !== "" && webAddress !== "" && mailAddress !== "" && projAddress !== "") {

            swal({
                title: "Are you sure?",
                text: "You want to update the project detail!",
                type: "info",
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Yes, update",
                cancelButtonClass: "btn-primary",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                function (isConfirm) {
                    if (isConfirm) {
                        var formData = new FormData();
                        formData.append('projId', projId);
                        formData.append('projCode', projectCode);
                        formData.append('projName', projectName);
                        formData.append('projLocation', projectCity);
                        formData.append('projArea', projectArea);
                        formData.append('projBasePrice', basePrice);
                        formData.append('webAddress', webAddress);
                        formData.append('mailAddress', mailAddress);
                        formData.append('projAddress', projAddress);
                        formData.append('oldProjLogo', oldProjLogo);
                        formData.append('projLogo', projLogo);
                        $.ajax({
                            url: "<?php echo base_url('dashboard/updateProject'); ?>",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            cache: false,
                            success: function (dataResult) {
                                if (dataResult == true) {
                                    swal({
                                        title: "Congratulations!",
                                        text: "Project has been updated successfully.",
                                        type: "success"
                                    },
                                        function(){
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
            swal("Sorry!", "Please fill all the fields.", "info");
        }
    });
    function selected(){
        var logo=document.getElementById('projLogo');
        var baseUrl=document.getElementById('baseUrl').value;
        if(logo.files.length>0){
            document.getElementById('logoSel').innerHTML="<span class='text-success'>Image selected</span> | <span class='text-danger'>Browse</span></span>";
            document.getElementById('logoCloud').src=baseUrl+"/assets/img/icon/check.png";
        }
    }
</script>