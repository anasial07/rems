<style>
    .product-details{ height:90px!important; cursor: pointer; }
    .product-details img{ width:38px!important; }
    .modalTable tr td{ line-height:1!important; }
</style>
<?php $rights=explode(',',$userPermissions); ?>
<div class="page-wrapper px-4 mt-4">
    <div class="page-header">
        <div class="page-title">
            <h4>Customer List</h4>
            <h6>Add & Manage your Customers</h6>
        </div>
        <?php if(in_array('createCustomer',$rights)): ?>
        <div class="page-btn">
            <a href="<?= base_url('customers/addCustomer'); ?>" class="btn btn-added"><img src="<?= base_url('assets/img/icons/plus.svg') ?>" alt="img">Add New Customer</a>
        </div>
        <?php endif; ?>
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
                        <th>Image | Name</th>
                        <th>CNIC</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th class="text-center">Employee?</th>
                        <th class="text-center">Status</th>
                        <?php if(in_array('editCustomer', $rights) || in_array('deleteCustomer', $rights)): ?>
                        <th class="text-center">Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sr=1;
                    foreach($customers as $customer):
                    $status=$customer->custmStatus;
                ?>
                    <tr <?php if($status==0){ ?> style="background:#F7E4E7;" <?php } ?>>
                        <td><?= sprintf("%02d", $sr++); ?></td>
                        <td data-id="<?= $customer->customerId; ?>" data-bs-toggle="modal" data-bs-target="#customerDetail" class="productimgname customerInfo">
                            <a href="javascript:void(0);">
                                <img width="30" src="<?= base_url('uploads/customers/').$customer->custmPic; ?>" alt="" style="border-radius:5px;">
                            </a>
                            <a href="javascript:void(0);">
                                <?php
                                    echo $customer->custmName;
                                    if($status==0){ echo "<p class='text-muted' style='font-size:10px;'>Deleted</p>"; }
                                ?>
                            </a>
                        </td>
                        <td><?= $customer->custmCNIC; ?></td>
                        <td><?= $customer->primaryPhone; ?></td>
                        <td><?= $customer->locName; ?></td>
                        <td class="text-success text-center">
                            <?php if($customer->isEmployee=='1'): ?>
                                <span class="text-success">Yes</span>
                            <?php else: ?>
                                <span class="text-danger">No</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if($status==1){ $val="Delete"; ?>
                                <span class="badges bg-lightgreen">Active</span>
                            <?php }else{ $val="Recover"; ?>
                                <span class="badges bg-lightred">Inactive</span>
                            <?php } ?>
                        </td>
                        <?php if(in_array('editCustomer', $rights) || in_array('deleteCustomer', $rights)): ?>
                        <td class="text-center">
                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="customerInfo" data-id="<?= $customer->customerId; ?>" data-bs-toggle="modal" data-bs-target="#customerDetail">
                                    <a class="dropdown-item"><img src="<?= base_url('assets/img/icons/eye1.svg'); ?>" class="me-2" alt="img">View Detail</a>
                                </li>
                                <?php if(in_array('editCustomer', $rights)): ?>
                                    <li>
                                        <a href="" class="dropdown-item"><img src="<?= base_url('assets/img/icons/edit.svg'); ?>" class="me-2" alt="img">Edit Customer</a>
                                    </li>
                                <?php endif; if(in_array('deleteCustomer', $rights)): ?>
                                    <li class="delCustomer" data-id="<?= $customer->customerId; ?>">
                                        <a class="dropdown-item confirm-text"><img src="<?= base_url('assets/img/icons/delete1.svg'); ?>" class="me-2" alt="img"><?= $val; ?> Customer</a>
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
</div>
<div class="modal fade" id="customerDetail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">&nbsp;&nbsp;Customer Information</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="modalArea">

            </div>
        </div>
    </div>
</div>
<input type="hidden" value="<?= base_url(); ?>" id="base_url">
<script>
    $('.customerInfo').click(function(){
        var id = $(this).data('id');
        const imgUrl = '<?=base_url();?>';
        $.ajax({
            url: "<?php echo base_url("customers/customerInfo/"); ?>" + id,
            method: 'POST',
            dataType: 'JSON',
            data: {id: id},
            success: function(res){
                $('#modalArea').html('');
                allFiles(id);
                let empStatus = '';
                var custmStatus = '';
                if(res[0].isEmployee == "1"){
                    empStatus += '<span class="text-success">Employee</span>';
                }else{
                    empStatus += '<span class="text-danger">Customer</span>';
                }
                if(res[0].custmStatus == "1"){
                    custmStatus += '<span class="text-success">Active</span>';
                }else{
                    custmStatus += '<span class="text-danger">In Active</span>';
                }
                var empGender = (res[0].custmGender==1) ? 'Male' : 'Female';
                $('#modalArea').html(`
                    <div class="row">
                        <div class="col-9">
                            <table class="table modalTable">
                                <tr>
                                    <td>Customer Name</td>
                                    <td>${res[0].custmName} (${empStatus})</td>
                                </tr>
                                <tr>
                                    <td>Father's Name</td>
                                    <td>${res[0].fatherName}</td>
                                </tr>
                                <tr>
                                    <td>Customer CNIC</td>
                                    <td>${res[0].custmCNIC}</td>
                                </tr>
                                <tr>
                                    <td>Primary Contact</td>
                                    <td>${res[0].primaryPhone}</td>
                                </tr>
                                <tr>
                                    <td>Secondary Contact</td>
                                    <td>${res[0].secondaryPhone}</td>
                                </tr>
                                <tr>
                                    <td>Customer Email</td>
                                    <td>${res[0].custmEmail}</td>
                                </tr>
                                <tr>
                                    <td>Customer DOB</td>
                                    <td>${res[0].custmDOB}</td>
                                </tr>
                                <tr>
                                    <td>Customer Gender</td>
                                    <td>${empGender}</td>
                                </tr>
                                <tr>
                                    <td>Customer City</td>
                                    <td>${res[0].locName}</td>
                                </tr>
                                <tr>
                                    <td>Present Address</td>
                                    <td>${res[0].presentAddress}</td>
                                </tr>
                                <tr>
                                    <td>Permanent Address</td>
                                    <td>${res[0].permanentAddress}</td>
                                </tr>
                                <tr>
                                    <td>NOK Name</td>
                                    <td>${res[0].nokName}</td>
                                </tr>
                                <tr>
                                    <td>NOK CNIC</td>
                                    <td>${res[0].nokCNIC}</td>
                                </tr>
                                <tr>
                                    <td>NOK Contact</td>
                                    <td>${res[0].nokPhone}</td>
                                </tr>
                                <tr>
                                    <td>NOK Email</td>
                                    <td>${res[0].nokEmail}</td>
                                </tr>
                                <tr>
                                    <td>Relation</td>
                                    <td>${res[0].nokRelation}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-3">
                            <img src="${imgUrl}uploads/customers/${res[0].custmPic}" style="height:160px!important; width:160px!important; border-radius:10px;">
                            <span>Customer Status: ${custmStatus}</span>
                            <div class="row mb-4" id="custmAllFiles"></div>
                        </div>
                    </div>
                    ${res[0].custmStatus == "0" ? 
                        `<div class="row">
                            <div class="col-12 text-center">
                                <div class="alert alert-warning fade show mt-3" role="alert">
                                    The status of this customer is currently <strong>inactive</strong>. If you wish to activate the status, please contact the admin.
                                </div>
                            </div>
                        </div>` : '' }
                `);
                $('#customerDetail').modal('show');
            }
        });
    });
    function allFiles(id){
        $.ajax({
            url: "<?php echo base_url("booking/customerBookings/"); ?>" + id,
            method: 'POST',
            dataType: 'JSON',
            data: {id: id},
            success: function(res) {
                var base_url=$('#base_url').val();
                $('#custmAllFiles').html('');
                if (res && res.length > 0) {
                    var content = `<div class="col-12 mt-4">${res.length.toString().padStart(2, '0')} Booking(s) available<br>`;
                    $.each(res, function(index, data) {
                        var bookingID = data.bookingId.toString(10, 36);
                        content += `<span class="text-muted">${data.membershipNo}</span><br>`;
                    });
                    content += '</div>';
                    $('#custmAllFiles').append(content);
                } else {
                    var content = '<div class="col-12 text-danger mt-4">No Booking available yet!</div>';
                    $('#custmAllFiles').append(content);
                }
            }
        });
    }
    $('.delCustomer').click(function(){
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
                    url: "<?php echo base_url("customers/deleteCustomer/"); ?>" + id,
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