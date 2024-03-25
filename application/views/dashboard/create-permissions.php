<?php
    $myRights = array();
    if (!empty($permissions->userPermissions)) {
        $userPermissions = $permissions->userPermissions;
        $myRights = explode(",", $userPermissions);
    }
    $rights=explode(',',$userPermissions);
?>
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Create Permissions - <span class="text-primary"><?= $users[0]->empName; ?></span> (<?= ucwords($users[0]->role); ?>)</h4>
                <h6>Administration of Access Rights</h6>
                <input type="hidden" value="<?= $users[0]->userId; ?>" id="thisUser">
            </div>
            <div class="page-btn">
                <?php if(empty($permissions->userID)){ ?>
                <a style="cursor:pointer;" class="btn btn-added createPermissions">Create Permissions</a>
                <input type="hidden" value="0" id="isExistRow">
                <?php }else{ ?>
                    <a style="cursor:pointer;" class="btn btn-added createPermissions">Update Permissions</a>
                <input type="hidden" value="1" id="isExistRow">
                <?php } ?>
            </div>
        </div>
        <div class="card">
            <div class="row">
                <div class="col-12">
                    <div class="productdetails product-respon">
                        <ul>
                            <li>
                                <h4><img width="15" src="<?= base_url('assets/img/icon/agent.png'); ?>"> Designation</h4>
                                <div class="input-checkset">
                                    <ul>
                                        <li>
                                            <label class="inputcheck">Create
                                                <input <?= in_array("createDesignation", $myRights) ? 'checked' : ''; ?> type="checkbox" value="createDesignation" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="inputcheck">View
                                                <input <?= in_array("viewDesignation", $myRights) ? 'checked' : ''; ?> type="checkbox" value="viewDesignation" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <!--<li>-->
                                        <!--    <label class="inputcheck">Edit-->
                                        <!--        <input <?= in_array("editDesignation", $myRights) ? 'checked' : ''; ?> type="checkbox" value="editDesignation" name="user-permission[]">-->
                                        <!--        <span class="checkmark"></span>-->
                                        <!--    </label>-->
                                        <!--</li>-->
                                        <li>
                                            <label class="inputcheck">Delete
                                                <input <?= in_array("deleteDesignation", $myRights) ? 'checked' : ''; ?> type="checkbox" value="deleteDesignation" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <h4><img width="13" src="<?= base_url('assets/img/icon/location.png'); ?>"> Geolocation</h4>
                                <div class="input-checkset">
                                    <ul>
                                        <li>
                                            <label class="inputcheck">Create
                                                <input <?= in_array("createGeolocation", $myRights) ? 'checked' : ''; ?> type="checkbox" value="createGeolocation" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="inputcheck">View
                                                <input <?= in_array("viewGeolocation", $myRights) ? 'checked' : ''; ?> type="checkbox" value="viewGeolocation" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <!--<li>-->
                                        <!--    <label class="inputcheck">Edit-->
                                        <!--        <input <?= in_array("editGeolocation", $myRights) ? 'checked' : ''; ?> type="checkbox" value="editGeolocation" name="user-permission[]">-->
                                        <!--        <span class="checkmark"></span>-->
                                        <!--    </label>-->
                                        <!--</li>-->
                                        <li>
                                            <label class="inputcheck">Delete
                                                <input <?= in_array("deleteGeolocation", $myRights) ? 'checked' : ''; ?> type="checkbox" value="deleteGeolocation" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <h4><img width="15" src="<?= base_url('assets/img/icon/office.png'); ?>"> Project</h4>
                                <div class="input-checkset">
                                    <ul>
                                        <li>
                                            <label class="inputcheck">Create
                                                <input <?= in_array("createProject", $myRights) ? 'checked' : ''; ?> type="checkbox" value="createProject" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="inputcheck">View
                                                <input <?= in_array("viewProject", $myRights) ? 'checked' : ''; ?> type="checkbox" value="viewProject" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="inputcheck">Edit
                                                <input <?= in_array("editProject", $myRights) ? 'checked' : ''; ?> type="checkbox" value="editProject" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="inputcheck">Delete
                                                <input <?= in_array("deleteProject", $myRights) ? 'checked' : ''; ?> type="checkbox" value="deleteProject" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <h4><img width="13" src="<?= base_url('assets/img/icon/coin.png'); ?>"> Payment Plan</h4>
                                <div class="input-checkset">
                                    <ul>
                                        <li>
                                            <label class="inputcheck">Create
                                                <input <?= in_array("createPayplan", $myRights) ? 'checked' : ''; ?> type="checkbox" value="createPayplan" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="inputcheck">View
                                                <input <?= in_array("viewPayplan", $myRights) ? 'checked' : ''; ?> type="checkbox" value="viewPayplan" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <!--<li>-->
                                        <!--    <label class="inputcheck">Edit-->
                                        <!--        <input <?= in_array("editPayplan", $myRights) ? 'checked' : ''; ?> type="checkbox" value="editPayplan" name="user-permission[]">-->
                                        <!--        <span class="checkmark"></span>-->
                                        <!--    </label>-->
                                        <!--</li>-->
                                        <li>
                                            <label class="inputcheck">Delete
                                                <input <?= in_array("deletePayplan", $myRights) ? 'checked' : ''; ?> type="checkbox" value="deletePayplan" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <h4><img width="15" src="<?= base_url('assets/img/icon/agent.png'); ?>"> Agent</h4>
                                <div class="input-checkset">
                                    <ul>
                                        <li>
                                            <label class="inputcheck">Create
                                                <input <?= in_array("createAgent", $myRights) ? 'checked' : ''; ?> type="checkbox" value="createAgent" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="inputcheck">View
                                                <input <?= in_array("viewAgent", $myRights) ? 'checked' : ''; ?> type="checkbox" value="viewAgent" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <!--<li>-->
                                        <!--    <label class="inputcheck">Edit-->
                                        <!--        <input <?= in_array("editAgent", $myRights) ? 'checked' : ''; ?> type="checkbox" value="editAgent" name="user-permission[]">-->
                                        <!--        <span class="checkmark"></span>-->
                                        <!--    </label>-->
                                        <!--</li>-->
                                        <li>
                                            <label class="inputcheck">Delete
                                                <input <?= in_array("deleteAgent", $myRights) ? 'checked' : ''; ?> type="checkbox" value="deleteAgent" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <h4><img width="15" src="<?= base_url('assets/img/icon/agent.png'); ?>"> Customer</h4>
                                <div class="input-checkset">
                                    <ul>
                                        <li>
                                            <label class="inputcheck">Create
                                                <input <?= in_array("createCustomer", $myRights) ? 'checked' : ''; ?> type="checkbox" value="createCustomer" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="inputcheck">View
                                                <input <?= in_array("viewCustomer", $myRights) ? 'checked' : ''; ?> type="checkbox" value="viewCustomer" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <!--<li>-->
                                        <!--    <label class="inputcheck">Edit-->
                                        <!--        <input <?= in_array("editCustomer", $myRights) ? 'checked' : ''; ?> type="checkbox" value="editCustomer" name="user-permission[]">-->
                                        <!--        <span class="checkmark"></span>-->
                                        <!--    </label>-->
                                        <!--</li>-->
                                        <li>
                                            <label class="inputcheck">Delete
                                                <input <?= in_array("deleteCustomer", $myRights) ? 'checked' : ''; ?> type="checkbox" value="deleteCustomer" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <h4><img width="15" src="<?= base_url('assets/img/icon/file.png'); ?>"> Booking</h4>
                                <div class="input-checkset">
                                    <ul>
                                        <li>
                                            <label class="inputcheck">Create
                                                <input <?= in_array("createBooking", $myRights) ? 'checked' : ''; ?> type="checkbox" value="createBooking" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="inputcheck">View
                                                <input <?= in_array("viewBooking", $myRights) ? 'checked' : ''; ?> type="checkbox" value="viewBooking" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <!--<li>-->
                                        <!--    <label class="inputcheck">Edit-->
                                        <!--        <input <?= in_array("editBooking", $myRights) ? 'checked' : ''; ?> type="checkbox" value="editBooking" name="user-permission[]">-->
                                        <!--        <span class="checkmark"></span>-->
                                        <!--    </label>-->
                                        <!--</li>-->
                                        <li>
                                            <label class="inputcheck">Delete
                                                <input <?= in_array("deleteBooking", $myRights) ? 'checked' : ''; ?> type="checkbox" value="deleteBooking" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="inputcheck">Booking Detail
                                                <input <?= in_array("bookingDetail", $myRights) ? 'checked' : ''; ?> type="checkbox" value="bookingDetail" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="inputcheck">Verify Booking
                                                <input <?= in_array("verifyBooking", $myRights) ? 'checked' : ''; ?> type="checkbox" value="verifyBooking" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li class="mt-1">
                                            <label class="inputcheck">Issue File
                                                <input <?= in_array("issueFile", $myRights) ? 'checked' : ''; ?> type="checkbox" value="issueFile" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li class="mt-1">
                                            <label class="inputcheck">Booking Summary
                                                <input <?= in_array("bookingSummary", $myRights) ? 'checked' : ''; ?> type="checkbox" value="bookingSummary" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li class="mt-1">
                                            <label class="inputcheck">Booking Receipt
                                                <input <?= in_array("bookingReceipt", $myRights) ? 'checked' : ''; ?> type="checkbox" value="bookingReceipt" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li class="mt-1">
                                            <label class="inputcheck">Account Statement
                                                <input <?= in_array("accountStatement", $myRights) ? 'checked' : ''; ?> type="checkbox" value="accountStatement" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <h4><img width="15" src="<?= base_url('assets/img/icon/calendarReport.png'); ?>"> Installment</h4>
                                <div class="input-checkset">
                                    <ul>
                                        <li>
                                            <label class="inputcheck">Create
                                                <input <?= in_array("createInstallments", $myRights) ? 'checked' : ''; ?> type="checkbox" value="createInstallments" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="inputcheck">View
                                                <input <?= in_array("viewInstallments", $myRights) ? 'checked' : ''; ?> type="checkbox" value="viewInstallments" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <!--<li>-->
                                        <!--    <label class="inputcheck">Edit-->
                                        <!--        <input <?= in_array("editInstallments", $myRights) ? 'checked' : ''; ?> type="checkbox" value="editInstallments" name="user-permission[]">-->
                                        <!--        <span class="checkmark"></span>-->
                                        <!--    </label>-->
                                        <!--</li>-->
                                        <li>
                                            <label class="inputcheck">Delete
                                                <input <?= in_array("deleteInstallments", $myRights) ? 'checked' : ''; ?> type="checkbox" value="deleteInstallments" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="inputcheck">Installment Receipt
                                                <input <?= in_array("installmentReceipt", $myRights) ? 'checked' : ''; ?> type="checkbox" value="installmentReceipt" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <h4><img width="15" src="<?= base_url('assets/img/icon/pdf.png'); ?>"> Booking Letters</h4>
                                <div class="input-checkset">
                                    <ul>
                                        <li class="mt-1">
                                            <label class="inputcheck">Booking Memo
                                                <input <?= in_array("bookingMemo", $myRights) ? 'checked' : ''; ?> type="checkbox" value="bookingMemo" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li class="mt-1">
                                            <label class="inputcheck">Welcome Letter
                                                <input <?= in_array("welcomeLetter", $myRights) ? 'checked' : ''; ?> type="checkbox" value="welcomeLetter" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li class="mt-1">
                                            <label class="inputcheck">Confirmation Letter
                                                <input <?= in_array("confirmLetter", $myRights) ? 'checked' : ''; ?> type="checkbox" value="confirmLetter" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li class="mt-1">
                                            <label class="inputcheck">Booking Form
                                                <input <?= in_array("bookingForm", $myRights) ? 'checked' : ''; ?> type="checkbox" value="bookingForm" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li class="mt-1">
                                            <label class="inputcheck">Payment Plan
                                                <input <?= in_array("paymentPlan", $myRights) ? 'checked' : ''; ?> type="checkbox" value="paymentPlan" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <h4><img width="15" src="<?= base_url('assets/img/icon/cog.png'); ?>"> User Management</h4>
                                <div class="input-checkset">
                                    <ul>
                                        <li>
                                            <label class="inputcheck">Create
                                                <input <?= in_array("createUser", $myRights) ? 'checked' : ''; ?> type="checkbox" value="createUser" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="inputcheck">View
                                                <input <?= in_array("viewUser", $myRights) ? 'checked' : ''; ?> type="checkbox" value="viewUser" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <!--<li>-->
                                        <!--    <label class="inputcheck">Edit-->
                                        <!--        <input <?= in_array("editUser", $myRights) ? 'checked' : ''; ?> type="checkbox" value="editUser" name="user-permission[]">-->
                                        <!--        <span class="checkmark"></span>-->
                                        <!--    </label>-->
                                        <!--</li>-->
                                        <li>
                                            <label class="inputcheck">Delete
                                                <input <?= in_array("deleteUser", $myRights) ? 'checked' : ''; ?> type="checkbox" value="deleteUser" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="inputcheck">Create Permissions
                                                <input <?= in_array("createPermission", $myRights) ? 'checked' : ''; ?> type="checkbox" value="createPermission" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <h4><img width="15" src="<?= base_url('assets/img/icon/track.png'); ?>"> Others</h4>
                                <div class="input-checkset">
                                    <ul>
                                        <li>
                                            <label class="inputcheck">Log Activity
                                                <input <?= in_array("viewLogs", $myRights) ? 'checked' : ''; ?> type="checkbox" value="viewLogs" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="inputcheck">Notifications
                                                <input <?= in_array("viewNotification", $myRights) ? 'checked' : ''; ?> type="checkbox" value="viewNotification" name="user-permission[]">
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Note:</strong> Please be aware that the assigned permissions are crafted to enrich user experience while upholding the integrity and security of our platform.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php if($users[0]->userStatus==0){ ?>
        <div class="row">
            <div class="col-12 text-center">
                <div class="alert alert-warning fade show mt-3" role="alert">
                    The status of this user is currently <strong>inactive</strong>. If you wish to activate the status, please contact the admin.
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<script>
    $('.createPermissions').on('click', function(){
        var userID = $('#thisUser').val();
        var isExistRow = $('#isExistRow').val();
        var permissions = [];
        $('input[name="user-permission[]"]:checked').each(function(){
            permissions.push($(this).val());
        });
        swal({
            title: "Are you sure?",
            text: "You want to create permissions for this user!",
            type: "info",
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonClass: "btn-success",
            confirmButtonText: "Yes, create it!",
            cancelButtonClass: "btn-primary",
            cancelButtonText: "No, cancel!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if(isConfirm){
                $.ajax({
                    url: "<?php echo base_url("dashboard/savePermissions"); ?>",
                    type: "POST",
                    data: {
                        userID: userID,
                        isExistRow: isExistRow,
                        permissions: permissions
                    },
                    cache: false,
                    success: function(dataResult){
                        if(dataResult==true){
                            swal({
                                title: "Congratulation!", 
                                text: "Permissions have been granted for this user.", 
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
	});
</script>