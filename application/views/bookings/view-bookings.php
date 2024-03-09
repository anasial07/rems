<style>
    .product-details{ height:90px!important; cursor: pointer; }
    .product-details img{ width:38px!important; }
</style>
<?php $role=$this->session->userdata('role'); ?>
<div class="page-wrapper px-4 mt-4">
    <div class="page-header mx-1">
        <div class="page-title">
            <h4>Booking List</h4>
            <h6>Add & Manage your Bookings</h6>
        </div>
        <div class="page-btn">
            <a href="<?= base_url('booking/addBooking'); ?>" class="btn btn-added"><img src="<?= base_url('assets/img/icons/plus.svg'); ?>" alt="img">Add New Booking</a>
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
                            <th>Membership#</th>
                            <th>Customer</th>
                            <th>Agent</th>
                            <th>Category</th>
                            <th>Purchased</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $sr=1;
                        foreach($bookings as $booking):
                        $status=$booking->bookingStatus;
                    ?>
                    <tr>
                        <td><?= sprintf("%02d", $sr++); ?></td>
                        <td>
                            <?php
                                echo $booking->membershipNo;
                                if($booking->fileIssuanceDate!=""){ echo "<p class='text-primary' style='font-size:10px;'>File Issued</p>"; }
                            ?>
                        </td>
                        <td><?= $booking->custmName; ?></td>
                        <td><?= $booking->agentName; ?></td>
                        <td><?= $booking->typeName.' - '.$booking->subCatName; ?></td>
                        <td><?= date('d M, Y',strtotime($booking->purchaseDate)); ?></td>
                        <td class="text-center">
                            <?php
                            if($status==1){ $val="Delete"; ?>
                                <span class="badges bg-lightgreen">Active</span>
                            <?php }else{ $val="Recover"; ?>
                                <span class="badges bg-lightred">Inactive</span>
                            <?php }  ?>
                        </td>
                        <td class="text-center">
                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('booking/bookingDetail/').base_convert($booking->bookingId, 10, 36); ?>" class="dropdown-item"><img src="<?= base_url('assets/img/icons/eye1.svg'); ?>" class="me-2" alt="img">View Booking</a></li>
                                <?php if($role=='admin'): ?>
                                    <li><a href="<?= base_url('booking/updateBooking/').base_convert($booking->bookingId, 10, 36); ?>" class="dropdown-item"><img src="<?= base_url('assets/img/icons/edit.svg'); ?>" class="me-2" alt="img">Edit Booking</a></li>
                                    <li class="delBooking" data-id="<?= $booking->bookingId; ?>">
                                        <a class="dropdown-item confirm-text"><img src="<?= base_url('assets/img/icons/delete1.svg'); ?>" class="me-2" alt="img"><?= $val; ?> Booking</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $('.delBooking').click(function(){
        var id = $(this).data('id');
        swal({
            title: "Are you sure?",
            text: "You want to change the status!",
            type: "info",
            showCancelButton: true,
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
                    url: "<?php echo base_url("booking/deleteBooking/"); ?>" + id,
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