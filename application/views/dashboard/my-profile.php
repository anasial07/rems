<style>
    .height {
        margin-top: -12px;
    }

    .pulse {
        animation: pulse-animation 2s infinite;
        border-radius: 100%;
    }

    @keyframes pulse-animation {
        0% {
            box-shadow: 0 0 0 0px rgba(0, 0, 0, 0.3);
        }

        50% {
            box-shadow: 0 0 0 20px rgba(0, 0, 0, 0);
        }

        100% {
            box-shadow: 0 0 0 20px rgba(0, 0, 0, 0);
        }
    }
</style>
<?php
$role = $this->session->userdata('role');
$empProfile = ($info[0]->empProfile != 0) ? $info[0]->empProfile : 'default.png';
?>
<div class="page-wrapper">
    <div class="content">
        <div class="card">
            <div class="card-body">
                <div class="profile-set">
                    <div class="profile-head"></div>
                    <div class="profile-top">
                        <div class="profile-content mt-2">
                            <div class="profile-contentimg">
                                <img src="<?= base_url('uploads/profiles/') . $empProfile; ?>" alt="img" id="blah">
                                <div class="profileupload">
                                    <input type="file" id="imgInp">
                                    <input type="hidden" id="defaultProfile" value="<?= $empProfile; ?>">
                                    <a href="javascript:void(0);"><img src="<?= base_url('assets/img/icons/edit-set.svg'); ?>" alt="img"></a>
                                </div>
                            </div>
                            <div class="profile-contentname">
                                <h2>AH Group of Companies</h2>
                                <h4>Real Estate Management System</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="row">
                            <div class="col-3">
                                <p>Name (Full)</p>
                                <p class="height">Username</p>
                                <p class="height">Email</p>
                                <p class="height">Role</p>
                                <p class="height">Location</p>
                                <p class="height">Department</p>
                                <p class="height">Status</p>
                                <p class="height">Signed Up</p>
                                <p class="height">Last Login</p>
                            </div>
                            <div class="col-9">
                                <p><?= $info[0]->empName; ?></p>
                                <p class="height"><?= $info[0]->userName; ?></p>
                                <p class="height"><?= $info[0]->userEmail; ?></p>
                                <p class="height"><?= ucfirst($role); ?></p>
                                <p class="height"><?= $info[0]->locName; ?></p>
                                <p class="height">
                                    <?= ($info[0]->departName==0) ? 'Master' : $info[0]->departName; ?>
                                </p>
                                <p class="height">
                                    Active
                                    <i class="fa fa-circle text-green pulse" style="font-size:13px;"></i>
                                </p>
                                <p class="height"><?= date('d M, Y', strtotime($info[0]->userCreatedAt)); ?></p>
                                <p class="height"><?= date('d M, Y g:i:s A', strtotime($info[0]->lastLogin)); ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-sm-12 col-lg-1"></div> -->
                    <div class="col">
                        <div class="row">
                            <div class="col-sm-12 col-lg-6"></div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label>Current Password</label>
                                    <div class="pass-group">
                                        <input type="password" id="oldPass" class="pass-input" placeholder="Current password">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6"></div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <div class="pass-group">
                                        <input type="password" id="newPass" class="pass-inputs" placeholder="Set new password">
                                        <span class="fas toggle-passworda fa-eye-slash"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6"></div>
                            <div class="col-sm-12 col-lg-6">
                                <a href="javascript:void(0);" class="btn btn-submit form-control me-2 updateProfile">Save Changes</a>
                            </div>
                            <!-- <div class="col"></div>
                            <div class="col-7">
                                <a href="javascript:void(0);" class="btn btn-submit form-control me-2">Save Changes</a>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($role != 'master') : ?>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-9">
                            <h3 class="text-danger"><span style="font-weight:600;">Danger zone</span> &middot; Delete account</h3>
                            <span>Once you delete your account, there is no going back. Please be certain. You'll be logged out right away.</span>
                        </div>
                        <div class="col">
                            <a href="javascript:void(0);" class="btn form-control btn-submit mt-1 deactivateAccount" style="background:red!important;">Deactivate my account</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
    $('.updateProfile').on('click', function() {
        var oldPass = $('#oldPass').val();
        var newPass = $('#newPass').val();
        if (oldPass != "" && newPass != "") {
            swal({
                    title: "Are you sure?",
                    text: "You want to change the password!",
                    type: "info",
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Yes, change it!",
                    cancelButtonClass: "btn-primary",
                    cancelButtonText: "No, cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "<?php echo base_url("dashboard/updateProfile"); ?>",
                            type: "POST",
                            data: {
                                oldPass: oldPass,
                                newPass: newPass
                            },
                            cache: false,
                            success: function(dataResult) {
                                if (dataResult == true) {
                                    swal({
                                        title: "Congratulation!",
                                        text: "Password has been changed successfully.",
                                        type: "success"
                                    }, function() {
                                        location.reload();
                                    });
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
            swal("Sorry!", "Please fill all the field.", "info");
        }
    });
    $('.deactivateAccount').on('click', function() {
        swal({
                title: "Are you sure?",
                text: "You want to deactivate your account!",
                type: "info",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes, deactivate it!",
                cancelButtonClass: "btn-success",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "<?php echo base_url('login/deactivate_account'); ?>",
                        type: "POST",
                        data: {},
                        dataType: "json",
                        cache: false,
                        success: function(dataResult) {
                            if (dataResult == true) {
                                swal({
                                    title: "Deactivated!",
                                    text: "After processing your request, it has been confirmed that your account has been successfully deactivated.",
                                    type: "success"
                                }, function() {
                                    location.reload();
                                });
                            } else {
                                swal("Oops!", dataResult, "error");
                            }
                        }
                    });
                } else {
                    swal.close()
                }
            });
    });
    $('#imgInp').on('change', function() {
        var formData = new FormData();
        var defaultProfile = $('#defaultProfile').val();
        var myProfile = $('#imgInp')[0].files[0];
        formData.append('defaultProfile', defaultProfile);
        formData.append('myProfile', myProfile);
        $.ajax({
            url: "<?php echo base_url('dashboard/updateMyProfile'); ?>",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(dataResult) {
                if (dataResult == true) {
                    swal({
                        title: "Congratulations!",
                        text: "Profile has been updated successfully.",
                        type: "success"
                    },
                    function(){ 
                        location.reload();
                    });
                } else {
                    swal("Oops!", "Something went wrong.", "error");
                }
            }
        });
    });
</script>