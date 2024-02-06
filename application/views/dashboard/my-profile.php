<style>
    .height{ margin-top: -12px; }
    .pulse {
        animation: pulse-animation 2s infinite;
        border-radius:100%;
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
<?php $role=$this->session->userdata('role'); ?>
<div class="page-wrapper">
    <div class="content">
        <div class="card">
            <div class="card-body">
                <div class="profile-set">
                    <div class="profile-head"></div>
                    <div class="profile-top">
                        <div class="profile-content mt-2">
                            <div class="profile-contentimg" style="height:100px; width:100px;">
                                <img src="<?= base_url('assets/img/AH.png'); ?>" alt="img">
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
                                <p class="height"><?= $info[0]->departName; ?></p>
                                <p class="height">
                                    Active 
                                    <i class="fa fa-circle text-green pulse" style="font-size:13px;"></i>
                                </p>
                                <p class="height"><?= date('d M, Y', strtotime($info[0]->createdAt)); ?></p>
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
                                        <input type="password" class="pass-input" placeholder="Current password">
                                        <span class="fas toggle-password fa-eye-slash"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6"></div>
                            <div class="col-sm-12 col-lg-6">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <div class="pass-group">
                                        <input type="password" class="pass-inputs" placeholder="Set new password">
                                        <span class="fas toggle-passworda fa-eye-slash"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-6"></div>
                            <div class="col-sm-12 col-lg-6">
                                <a href="javascript:void(0);" class="btn btn-submit form-control me-2">Save Changes</a>
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
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-lg-9">
                        <h3 class="text-danger"><span style="font-weight:600;">Danger zone</span> &middot; Delete account</h3>
                        <span>Once you delete your account, there is no going back. Please be certain. You'll be logged out right away.</span>
                    </div>
                    <div class="col">
                        <a href="javascript:void(0);" class="btn form-control btn-submit mt-1" style="background:red!important;">Deactivate my account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>