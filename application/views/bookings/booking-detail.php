<style>
    .heading{ font-size:14px; color:#7367F0; font-weight:600; line-height: 35px; padding-left:2.5%!important; }
    .bookingTable tr td{ border:none!important; line-height:0.3; }
</style>
<?php $role=$this->session->userdata('role'); ?>
<div class="page-wrapper">
    <div class="content">
        <div class="card px-3 py-1">
            <div class="row">
                <div class="page-header my-2">
                    <div class="page-title">
                        <h4 style="font-weight:900; color:#8967F0;"><?= $info[0]->membershipNo; ?></h4>
                        <h6 style="margin-top:-6px!important;">Membership#</h6>
                    </div>
                    <div class="page-btn">
                        <!-- <button type="button" class="btn btn-rounded btn-danger">Cancellation Request</button> -->
                        <a target="_blank" href="<?= base_url('booking/generateBookingMemo/').base_convert($info[0]->bookingId, 10, 36); ?>"><button class="btn btn-rounded btn-primary">Booking Memo</button></a>
                        <a target="_blank" href="<?= base_url('booking/generateWelcomeLetter/').base_convert($info[0]->bookingId, 10, 36); ?>"><button class="btn btn-rounded btn-secondary">Welcome Letter</button></a>
                        <a target="_blank" href="<?= base_url('booking/generateConfirmationLetter/').base_convert($info[0]->bookingId, 10, 36); ?>"><button class="btn btn-rounded btn-info text-white">Confirmation Letter</button></a>
                        <a target="_blank" href="<?= base_url('booking/generateBookingForm/').base_convert($info[0]->bookingId, 10, 36); ?>"><button class="btn btn-rounded btn-dark">Booking Form</button></a>
                        <a target="_blank" href="<?= base_url('booking/generatePaymentPlan/').base_convert($info[0]->bookingId, 10, 36); ?>"><button class="btn btn-rounded btn-success">Payment Plan</button></a>
                        <?php if($info[0]->fileIssuanceDate==""){ ?>
                            <a data-id="<?= $info[0]->bookingId; ?>" class="issueFile"><button class="btn btn-rounded btn-danger">Issue File</button></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card px-4 pt-3">
            <div class="row bg-light py-3">
                <div class="col">
                    <span class="heading">
                        <i class="far fa-user-circle"></i>
                        Customer Information
                    </span>
                    <table class="table bookingTable">
                        <tr>
                            <td>Customer</td>
                            <td><?= $info[0]->custmName; ?></td>
                        </tr>
                        <tr>
                            <td>CNIC</td>
                            <td><?= $info[0]->custmCNIC; ?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><?= $info[0]->primaryPhone; ?></td>
                        </tr>
                        <tr>
                            <td>Employee</td>
                            <?php
                                $emp = ($info[0]->isEmployee == 0) ? "No" : "Yes";
                                $empClass = ($emp == 'No') ? "text-danger" : "text-success";
                            ?>
                            <td class="<?= $empClass; ?>"><?= $emp; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col" style="border-left:1px solid #C6C7C2;">
                    <span class="heading">
                        <i class="far fa-address-book"></i>
                        Booking Information
                    </span>
                    <table class="table bookingTable">
                        <tr>
                            <td>Category</td>
                            <td><?= $info[0]->catName; ?></td>
                        </tr>
                        <tr>
                            <td>Sub-Category</td>
                            <td><?= $info[0]->subCatName; ?></td>
                        </tr>
                        <tr>
                            <td>Type</td>
                            <td><?= $info[0]->typeName.' ('.$info[0]->dimenssion.')'; ?></td>
                        </tr>
                        <tr>
                            <td>Payment Plan</td>
                            <td><?= $info[0]->planYears; ?> Year(s)</td>
                        </tr>
                    </table>
                </div>
                <div class="col" style="border-left:1px solid #C6C7C2;">
                    <span class="heading">
                        <i class="far fa-credit-card"></i>
                        Payment Information
                    </span>
                    <table class="table bookingTable">
                        <tr>
                            <td>Special Discount</td>
                            <td><?= number_format($info[0]->sepDiscount); ?>%</td>
                        </tr>
                        <tr>
                            <td>Features (<?= $info[0]->featuresPercent.'%'; ?>)</td>
                            <td><?= ($info[0]->featuresPercent==0) ? 'N/A' : $info[0]->features; ?></td>
                        </tr>
                        <tr>
                            <td>Sale Price</td>
                            <td><?= number_format($info[0]->salePrice); ?></td>
                        </tr>
                        <tr>
                            <td>Purchase Date</td>
                            <td><?= date('d M, Y',strtotime($info[0]->purchaseDate)); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="card-body p-0">
                    <div class="row my-3">
                        <div class="col">
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
                        </div>
                        <div class="col text-center mt-2">
                            <h6 style="font-size:14px!important;"><?= ($info[0]->fileIssuanceDate=="") ? "The file has not been issued yet." : "The file was issued on <span class='text-danger'>".date('M d, Y',strtotime($info[0]->fileIssuanceDate))."</span> at <span class='text-danger'>".date('g:i:s A',strtotime($info[0]->fileIssuanceDate))."</span>"; ?></h6>
                        </div>
                        <div class="col text-end mt-2">
                            <h6><a target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Account Statement" href="<?= base_url('booking/generateAccountStatement/').base_convert($info[0]->bookingId, 10, 36); ?>">
                                Account Statement
                            </a></h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                                <tr>
                                    <th>Receipt #</th>
                                    <th>Rec Amount</th>
                                    <th>Reference no</th>
                                    <th>Bank Name</th>
                                    <th>Payment Mode</th>
                                    <th>Location</th>
                                    <th>Receving Date</th>
                                    <th>Filer Status</th>
                                    <th>Tax</th>
                                    <th class="text-center">Print</th>
                                    <?php if($role=='admin'): ?>
                                        <th class="text-center">Action</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <?= $info[0]->projCode.'-'.sprintf('%02d',$info[0]->bookingId); ?>
                                        <p style="font-size:11px; margin-top:-4px!important;">Down Payment</p>
                                    </td>
                                    <td><?= number_format($info[0]->bookingAmount); ?></td>
                                    <td><?php echo ($info[0]->bookingReferenceNo == 0) ? "N/A" : $info[0]->bookingReferenceNo; ?></td>
                                    <td><?php echo ($info[0]->bookBankId == 0) ? "N/A" : $info[0]->bankName; ?></td>
                                    <td><?= $info[0]->bookingMode; ?></td>
                                    <td><?= $info[0]->locName; ?></td>
                                    <td><?= date('M d, Y',strtotime($info[0]->purchaseDate)); ?></td>
                                    <td>
                                        <?php if($info[0]->bookFilerStatus == 'Active'){ ?>
                                            <span class="badges bg-lightgreen">Active</span>
                                        <?php }else{ ?>
                                            <span class="badges bg-lightred">Inactive</span>
                                        <?php } ?>
                                    </td>
                                    <td><?= $info[0]->bookFilerPercent; ?>%</td>
                                    <td class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Booking Receipt">
                                        <a target="_blank" href="<?= base_url('booking/generateBookingReceipt/').base_convert($info[0]->bookingId, 10, 36).'?receipt=booking'; ?>"><img src="<?= base_url('assets/img/icons/printer.svg') ?>" alt="img"></a>
                                    </td>
                                    <?php if($role=='admin'): ?>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="" class="dropdown-item"><img src="<?= base_url('assets/img/icons/edit.svg'); ?>" class="me-2" alt="img">Edit Booking</a></li>
                                            </ul>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <?php foreach($installments as $install): ?>
                                <tr>
                                    <td><?= $info[0]->projCode.'-'.sprintf('%02d',$install->installmentId); ?></td>
                                    <td><?= number_format($install->installAmount); ?></td>
                                    <td><?php echo ($install->installReferenceNo == 0) ? "N/A" : $install->installReferenceNo; ?></td>
                                    <td><?php echo ($install->installBankId == 0) ? "N/A" : $install->bankName; ?></td>
                                    <td><?= $install->installPayMode; ?></td>
                                    <td><?= $install->locName; ?></td>
                                    <td><?= date('M d, Y',strtotime($install->installReceivedDate)); ?></td>
                                    <td>
                                        <?php if($install->installFilerStatus == 'Active'){ ?>
                                            <span class="badges bg-lightgreen">Active</span>
                                        <?php }else{ ?>
                                            <span class="badges bg-lightred">Inactive</span>
                                        <?php } ?>
                                    </td>
                                    <td><?= $install->installFilerPercent; ?>%</td>
                                    <td class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Installment Receipt">
                                        <a target="_blank" href="<?= base_url('booking/generateBookingReceipt/').base_convert($install->installmentId, 10, 36).'?receipt=installment'; ?>"><img src="<?= base_url('assets/img/icons/printer.svg') ?>" alt="img"></a>
                                    </td>
                                    <?php if($role=='admin'): ?>
                                        <td class="text-center">
                                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li><a href="" class="dropdown-item"><img src="<?= base_url('assets/img/icons/edit.svg'); ?>" class="me-2" alt="img">Edit Installment</a></li>
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
</div>
<script>
    $('.issueFile').click(function(){
        var id = $(this).data('id');
        swal({
            title: "Are you sure?",
            text: "You want to issue the file!",
            type: "info",
            showCancelButton: true,
            confirmButtonClass: "btn-success",
            confirmButtonText: "Yes, issue",
            cancelButtonClass: "btn-primary",
            cancelButtonText: "No, cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function(isConfirm){
            if(isConfirm){
                $.ajax({
                    url: "<?php echo base_url("booking/issueFile/"); ?>" + id,
                    method: 'POST',
                    dataType: 'JSON',
                    data: {id: id},
                    success: function(res){
                        if(res==true){
                            swal({
                                title: "Congratulation!", 
                                text: "File has been issued successfully.", 
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
                swal.close();
            }
        });
    });
</script>