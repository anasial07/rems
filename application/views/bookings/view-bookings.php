<?php $rights=explode(',',$userPermissions); ?>
<<<<<<< HEAD
<style>
    .checked{ color: orange; }
</style>
=======
>>>>>>> a027ff1302f86992f92d7b836705f8861eb92a08
<div class="page-wrapper px-4 mt-4">
    <div class="page-header mx-1">
        <div class="page-title">
            <h4>Booking List</h4>
            <h6>Add & Manage your Bookings</h6>
        </div>
        <?php if(in_array('createBooking',$rights)): ?>
        <div class="page-btn">
            <a href="<?= base_url('booking/addBooking'); ?>" class="btn btn-added"><img src="<?= base_url('assets/img/icons/plus.svg'); ?>" alt="img">Add New Booking</a>
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
                                <th>Receipt#</th>
                                <th>Membership#</th>
                                <th>Received</th>
                                <th>Receiveable</th>
                                <th>Purchased</th>
                                <th class="text-center">Verification</th>
                                <?php if(in_array('bookingDetail', $rights) ||
                                in_array('editBooking', $rights) ||
                                in_array('deleteBooking', $rights) ||
                                in_array('verifyBooking', $rights)): ?>
                                <th class="text-center">Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sr=1;
                            foreach($bookings as $booking):
                            $status=$booking->bookingStatus;
                            if($status==1){ $val="Delete"; }
                            else{ $val="Recover"; }
                            $verifyStatus=$booking->bookVerifyStatus;
                            
                            $installAmt=$data['totalInstallAmount'] = $this->booking_model->totalInstallmentAmount($booking->bookingId);
                            $totalRevd=$booking->bookingAmount + $installAmt;
                            $totalPayable=$booking->salePrice-$totalRevd;
                            $percent=($totalRevd/$booking->salePrice)*100;
                        ?>
                        <tr <?php if($status==0){ ?> style="background:#F7E4E7;" <?php } ?>>
                            <td><?= sprintf("%02d", $sr++); ?></td>
                            <td><?php
                                echo "BK-".sprintf('%04d',$booking->bookingId);
                                if($booking->fileIssuanceDate!=""){ echo "<p  style='font-size:10px; margin-top:-5px;' class='text-primary'>File Issued</p>"; }
                                ?>
                            </td> 
                            <td>
                                <span class="fw-bold"><?= $booking->membershipNo; ?></span>
                                <p style='font-size:10px; margin-top:-5px;'><?= $booking->custmName; ?></p>
                            </td>
                            <td class="text-success fw-bold">
                                <?php if($totalPayable>0){ ?>
                                    <i class="fa fa-angle-double-up"></i>
                                <?php }else if($percent>50){
                                    echo "<span class='fa fa-star checked'></span>&nbsp;"; 
                                }
                                    echo number_format($totalRevd);  
                                ?>
                                <p class="fw-normal" style='font-size:10px; margin-top:-5px;'>
                                    <?php if($status==0){ echo "Inactive"; } ?>
                                </p>
                                </td>
                                <td <?php if($percent>50){ ?> class="text-primary fw-bold" <?php }else{ ?> class="text-danger fw-bold" <?php } ?>>
                                    <?php
                                       if($totalPayable>0){
                                           echo number_format($totalPayable);
                                       }else{
                                           echo "<span class='badges bg-lightyellow'>Complete</span>";
                                       }
                                       
                                    if($percent>50 && $percent<100){ ?>
                                        <span class="text-muted float-end" style='font-size:10px;'>&emsp;<?= substr($percent,0,2); ?>%
                                        <i class='fa fa-star checked'></i>
                                        </span>
                                    <?php } ?>
                                </td>
                            <td><?php
                                echo date('d M, Y',strtotime($booking->purchaseDate));
                                echo "<p style='font-size:10px; margin-top:-5px;'>Added by: ".ucwords($booking->userName)."</p>";
                                ?></td>
                            <td class="text-center">
                                <?php
                                if($verifyStatus==1){ $veriStatus="Pending"; ?>
                                    <span class="badges bg-lightgreen">Verified</span>
                                <?php }else{ $veriStatus="Verify"; ?>
                                    <span class="badges bg-lightred">Pending</span>
                                <?php }  ?>
                            </td>
                            <?php if(in_array('bookingDetail', $rights) ||
                                in_array('editBooking', $rights) ||
                                in_array('deleteBooking', $rights) ||
                                in_array('verifyBooking', $rights)): ?>
                            <td class="text-center">
                                <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php if(in_array('bookingDetail', $rights)): ?>
                                        <li><a href="<?= base_url('booking/bookingDetail/').base_convert($booking->bookingId, 10, 36); ?>" class="dropdown-item"><img src="<?= base_url('assets/img/icons/eye1.svg'); ?>" class="me-2" alt="img">View Booking</a></li>
                                    <?php endif; if(in_array('editBooking', $rights)): ?>
                                        <li><a href="<?= base_url('booking/updateBooking/').base_convert($booking->bookingId, 10, 36); ?>" class="dropdown-item"><img src="<?= base_url('assets/img/icons/edit.svg'); ?>" class="me-2" alt="img">Edit Booking</a></li>
                                    <?php endif; if(in_array('deleteBooking', $rights)): ?>
                                        <li class="delBooking" data-id="<?= $booking->bookingId; ?>">
                                            <a class="dropdown-item confirm-text"><img src="<?= base_url('assets/img/icons/delete1.svg'); ?>" class="me-2" alt="img"><?= $val; ?> Booking</a>
                                        </li>
                                    <?php endif; if(in_array('verifyBooking', $rights)): ?>
                                        <li class="approved" data-id="<?= $booking->bookingId; ?>">
                                            <a class="dropdown-item confirm-text"><img src="<?= base_url('assets/img/icons/dollar-square.svg'); ?>" class="me-2" alt="img"><?php echo $veriStatus; ?> Booking</a>
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
<script>
    $('.delBooking').click(function(){
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
    $('.approved').click(function(){
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
                    url: "<?php echo base_url("booking/approveBooking/"); ?>" + id,
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