<?php $role=$this->session->userdata('role'); ?>
<div class="page-wrapper px-4 mt-4">
    <div class="page-header">
        <div class="page-title">
            <h4>Users List</h4>
            <h6>Add & Manage your Users</h6>
        </div>
        <div class="page-btn">
            <a data-bs-toggle="modal" data-bs-target="#addNewUser" class="btn btn-added"><img src="<?= base_url('assets/img/icons/plus.svg') ?>" alt="img">Add New User</a>
        </div>
    </div>
    <div class="row px-3">
        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
                            <a class="btn btn-filter" id="filter_search">
                                <img src="<?= base_url('assets/img/icons/filter.svg'); ?>" alt="img">
                                <span><img src="<?= base_url('assets/img/icons/closes.svg'); ?>" alt="img"></span>
                            </a>
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset"><img src="<?= base_url('assets/img/icons/search-white.svg'); ?>" alt="img"></a>
                        </div>
                    </div>
                    <div class="wordset">
                    <ul>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="<?= base_url('assets/img/icons/printer.svg'); ?>" alt="img"></a>
                        </li>
                    </ul>
                </div>
            </div>
        <div class="table-responsive">
            <table class="table datanew">
                <thead>
                    <tr>
                        <th>Sr</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Location</th>
                        <th>Department</th>
                        <th>Role</th>
                        <th>Last Login</th>
                        <th class="text-center">Status</th>
                        <?php if($role=='admin'): ?>
                            <th class="text-center">Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sr=1;
                        foreach($users as $user):
                        $status=$user->userStatus;
                    ?>
                        <tr>
                            <td><?= sprintf("%02d", $sr++); ?></td>
                            <?php if($user->role=='master'){ ?>
                                <td><?= $user->empName; ?></td>
                            <?php }else{ ?>
                                <td><a class="text-primary" href="<?= base_url('dashboard/addPermissions/').$user->userId; ?>"><?= $user->empName; ?></a></td>
                            <?php } ?>
                            <td><?= $user->userName; ?></td>
                            <td><?= $user->userEmail; ?></td>
                            <td><?= $user->locName; ?></td>
                            <td><?= $user->departName; ?></td>
                            <td><?= ucfirst($user->role); ?></td>
                            <td>
                                <?php
                                    echo ($user->lastLogin!=0) ?
                                        date('M d, Y g:h A', strtotime($user->lastLogin))
                                    : "<span class='text-danger'>N/A</span>";
                                ?>
                            </td>
                            <td class="text-center">
                                <?php if($status==1){ ?>
                                    <span class="badges bg-lightgreen">Active</span>
                                <?php }else{ ?>
                                    <span class="badges bg-lightred">Inactive</span>
                                <?php } ?>
                            </td>
                            <?php if($role=='admin'): ?>
                                <td class="text-center">
                                    <a class="me-3" href="">
                                        <img src="<?= base_url('assets/img/icons/edit.svg'); ?>" alt="img">
                                    </a>
                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                        <img src="<?= base_url('assets/img/icons/delete.svg'); ?>" alt="img">
                                    </a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="modal fade" id="addNewUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">&nbsp;&nbsp;Add User Information</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input oninput="validate(event)" id="userFullName" type="text" placeholder="Enter full name">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Username</label>
                            <input oninput="validate(event)" id="userName" type="text" placeholder="Enter username">
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label>Email Address</label>
                            <input oninput="validateEmail(event)" id="userEmailAddr" type="text" placeholder="Enter Email Address">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Set Password</label>
                            <input id="userPassword" type="text" placeholder="Set Password">
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label>Select Location</label>
                            <select id="userCity" class="form-control">
                                <option selected disabled>Select Location</option>
                                <?php foreach($cities as $city): ?>
                                    <option value="<?= $city->locationId; ?>"><?= $city->locName; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label>Select Department</label>
                            <select id="userDepart" class="form-control">
                                <option selected disabled>Select Department</option>
                                <?php foreach($departments as $depart): ?>
                                    <option value="<?= $depart->departId; ?>"><?= $depart->departName; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="form-group">
                            <label>Select Role</label>
                            <select id="userRole" class="form-control">
                                <option selected disabled>Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="manager">Manager</option>
                                <option value="staff">Staff</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <a class="btn form-control btn-submit me-2 addUser">Add New User</a>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <a data-bs-dismiss="modal" aria-label="Close" class="btn form-control btn-cancel me-2">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	$('.addUser').on('click', function(){
        var userFullName = $('#userFullName').val();
        var userName = $('#userName').val();
        var userEmailAddr = $('#userEmailAddr').val();
        var userPassword = $('#userPassword').val();
        var userCity = $('#userCity').val();
        var userDepart = $('#userDepart').val();
        var userRole = $('#userRole').val();
        if(userFullName!="" && userName!="" && userEmailAddr!="" && userPassword!="" && userCity!="Select Location" && userDepart!="Select Department" && userRole!="Select Role"){
            swal({
                title: "Are you sure?",
                text: "You want to add the user!",
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
                        url: "<?php echo base_url("dashboard/addUser"); ?>",
                        type: "POST",
                        data: {
                            userFullName: userFullName,
                            userName: userName,
                            userEmailAddr: userEmailAddr,
                            userPassword: userPassword,
                            userCity: userCity,
                            userDepart: userDepart,
                            userRole: userRole
                        },
                        cache: false,
                        success: function(dataResult){
                            if(dataResult==true){
                                swal({
                                    title: "Congratulation!", 
                                    text: "User has been added successfully.", 
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