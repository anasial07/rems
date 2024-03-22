<style>
    .heading{ font-size:14px; color:#7367F0; font-weight:600; line-height: 35px; padding-left:2.5%!important; }
    .bookingTable tr td{ border:none!important; line-height:0.3; }
    .custom-xl { height: 100%!important; }
    @media screen and (max-width: 1366px) {
      .hidSm{ display:none; }
    }
    @media screen and (min-width: 1440px) {
      .hidLg{ display:none; }
    }
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
                    <div class="page-btn text-end">
                        <!-- <button type="button" class="btn btn-rounded btn-danger">Cancellation Request</button> -->
                        <a target="_blank" href="<?= base_url('GeneratePDF/bookingMemo/').base_convert($info[0]->bookingId, 10, 36); ?>"><button class="btn btn-rounded btn-primary">Booking Memo</button></a>
                        <a target="_blank" href="<?= base_url('GeneratePDF/welcomeLetter/').base_convert($info[0]->bookingId, 10, 36); ?>"><button class="btn btn-rounded btn-secondary">Welcome Letter</button></a>
                        <a target="_blank" href="<?= base_url('GeneratePDF/confirmationLetter/').base_convert($info[0]->bookingId, 10, 36); ?>"><button class="btn btn-rounded btn-info text-white">Confirmation Letter</button></a>
                        <div class="btn-group hideLg">
                            <button type="button" class="btn btn-danger rounded-2" data-bs-toggle="dropdown" aria-expanded="false">
                              Other <i class="fa fa-angle-down"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a target="_blank" href="<?= base_url('GeneratePDF/bookingForm/').base_convert($info[0]->bookingId, 10, 36); ?>" class="dropdown-item">Booking Form</a></li>
                                <li><a class="dropdown-item" target="_blank" href="<?= base_url('GeneratePDF/paymentPlan/').base_convert($info[0]->bookingId, 10, 36); ?>">Payment Plan</a></li>
                            <?php if($info[0]->fileIssuanceDate==""){ ?>
                                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#fileIssueModal">Issue File</a></li>
                            <?php } ?>
                            </ul>
                        </div>
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
                            <td>Discount</td>
                            <td><?= number_format($info[0]->sepDiscount); ?>%</td>
                        </tr>
                        <tr>
                            <td>Features (<?= $info[0]->featuresPercent.'%'; ?>)</td>
                            <td><?= ($info[0]->featuresPercent==0) ? "<span class='text-danger'>N/A</span>" : $info[0]->features; ?></td>
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
                    <div class="row my-2">
                        <div class="col py-2">
                            <h6><a data-bs-toggle="offcanvas" data-bs-target="#paySummary" aria-controls="offcanvasTop">Booking Summary <span style="font-size:11px;" class="text-primary">[view]</span></a></h6>
                            <div class="search-input" style="display:none!important;"></div>
                        </div>
                        <div class="col text-end">
                            <h6><a target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Account Statement" href="<?= base_url('GeneratePDF/accountStatement/').base_convert($info[0]->bookingId, 10, 36); ?>">
                                Account Statement
                            </a></h6>
                            <p style="font-size:14px!important;"><?= ($info[0]->fileIssuanceDate=="") ? "The file has not been issued yet" : "The file was issued on <span class='text-danger'>".date('M d, Y',strtotime($info[0]->fileIssuanceDate)); ?></p>
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
                                    <th>ATL Status</th>
                                    <th class="text-center">Print</th>
                                    <?php if($role=='admin'): ?>
                                        <th class="text-center">Action</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>  
                            <?php
                            $bokRecp=$info[0]->bookingId;
                            if($bokRecp<10){ $bokRecp = "000".$bokRecp; }
                    		else if($bokRecp<100){ $bokRecp = "00".$bokRecp; }
                    		else if($bokRecp<1000){ $bokRecp = "0".$bokRecp; }
                    		else if($bokRecp<1000){ $bokRecp = $bokRecp; }
                            ?>
                                <tr>
                                    <td>
                                        <?= 'BK-'.$bokRecp; ?>
                                        <p style="font-size:11px; margin-top:-4px!important;">Down Payment</p>
                                    </td>
                                    <td>
                                        <?= number_format($info[0]->bookingAmount); ?>
                                        <?php if($info[0]->bookVerifyStatus==0){ ?>
                                            <p class="text-danger" style="font-size:11px; margin-top:-4px!important;">Not verified</p>
                                        <?php }else{ ?>
                                        <p class="text-success" style="font-size:11px; margin-top:-4px!important;">Verified</p>
                                        <?php } ?>
                                    </td>
                                    <td><?php echo ($info[0]->bookingReferenceNo == 0) ? "<span class='text-danger'>N/A</span>" : $info[0]->bookingReferenceNo; ?></td>
                                    <td><?php echo ($info[0]->bookBankId == 0) ? "<span class='text-danger'>N/A</span>" : $info[0]->bankName; ?></td>
                                    <td>
                                        <?php 
                                            if($info[0]->bookingMode == 'Cash'){
                                                $modeIcon="cash.png";
                                            }else if($info[0]->bookingMode == 'Cheque'){
                                                $modeIcon="cheque.png";
                                            }else if($info[0]->bookingMode == 'IBFT'){
                                                $modeIcon="ibft.png";
                                            }else if($info[0]->bookingMode == 'Wire Transfer'){
                                                $modeIcon="wiretransfer.png";
                                            }else if($info[0]->bookingMode == 'Pay Order'){
                                                $modeIcon="payOrder.png";
                                            }
                                            echo "<img width='20' src='".base_url('assets/img/icons/'.$modeIcon)."'> ";
                                            echo $info[0]->bookingMode;
                                         ?>
                                    </td>
                                    <td><?= $info[0]->locName; ?></td>
                                    <td><?= date('M d, Y',strtotime($info[0]->purchaseDate)); ?></td>
                                    <td>
                                        <?php
                                        if($info[0]->bookFilerStatus=='ATL'){ ?>
                                            <span class="badges bg-lightgreen">
                                                <?= $info[0]->bookFilerStatus." | ".$info[0]->bookFilerPercent."%"; ?>
                                            </span>
                                        <?php }else{ ?>
                                            <span class="badges bg-lightred">
                                                <?= $info[0]->bookFilerStatus." | ".$info[0]->bookFilerPercent."%"; ?>
                                            </span>
                                        <?php }  ?>
                                    </td>
                                    <td class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Booking Receipt">
                                        <a target="_blank" href="<?= base_url('GeneratePDF/bookingReceipt/').base_convert($info[0]->bookingId, 10, 36).'?receipt=booking'; ?>"><img src="<?= base_url('assets/img/icons/printer.svg') ?>" alt="img"></a>
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
                                    <td><?php
                            $instRcp=$install->installmentId;
                            if($instRcp<10){ $instRcp = "000".$instRcp; }
                    		else if($instRcp<100){ $instRcp = "00".$instRcp; }
                    		else if($instRcp<1000){ $instRcp = "0".$instRcp; }
                    		else if($instRcp<1000){ $instRcp = $instRcp; }
                                    echo 'INST-'.$instRcp; 
                                    ?></td>
                                    <td><?= number_format($install->installAmount); ?></td>
                                    <td><?php echo ($install->installReferenceNo == 0) ? "<span class='text-danger'>N/A</span>" : $install->installReferenceNo; ?></td>
                                    <td><?php echo ($install->installBankId == 0) ? "<span class='text-danger'>N/A</span>" : $install->bankName; ?></td>
                                    <td><?php
                                    $instlPyMode=$install->installPayMode;
                                    if($instlPyMode == 'Cash'){
                                        $instIcon="cash.png";
                                    }else if($instlPyMode == 'Cheque'){
                                        $instIcon="cheque.png";
                                    }else if($instlPyMode == 'IBFT'){
                                        $instIcon="ibft.png";
                                    }else if($instlPyMode == 'Wire Transfer'){
                                        $instIcon="wiretransfer.png";
                                    }else if($instlPyMode == 'Pay Order'){
                                        $instIcon="payOrder.png";
                                    }
                                    echo "<img width='20' src='".base_url('assets/img/icons/'.$instIcon)."'> ";
                                    echo $instlPyMode;
                                    ?></td>
                                    <td><?= $install->locName; ?></td>
                                    <td><?= date('M d, Y',strtotime($install->installReceivedDate)); ?></td>
                                    <td>
                                        <?php
                                        if($install->installFilerStatus=='ATL'){ ?>
                                            <span class="badges bg-lightgreen">
                                                <?= $install->installFilerStatus." | ".$install->installFilerPercent."%"; ?>
                                            </span>
                                        <?php }else{ ?>
                                            <span class="badges bg-lightred">
                                                <?= $install->installFilerStatus." | ".$install->installFilerPercent."%"; ?>
                                                </span>
                                        <?php }  ?>
                                    </td>
                                    <td class="text-center" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Installment Receipt">
                                        <a target="_blank" href="<?= base_url('GeneratePDF/bookingReceipt/').base_convert($install->installmentId, 10, 36).'?receipt=installment'; ?>"><img src="<?= base_url('assets/img/icons/printer.svg') ?>" alt="img"></a>
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
<div class="offcanvas offcanvas-top custom-xl" tabindex="-1" id="paySummary" aria-labelledby="offcanvasTopLabel">
    <div class="offcanvas-body mx-3">
        <div class="card bg-light">
            <div class="row py-2">
                <div class="col"></div>
                <div class="col text-center">
                    <h4 style="font-weight:900; color:#8967F0;">
                        <?= $info[0]->membershipNo; ?>
                    </h4>
                    Membership#
                </div>
                <div class="col text-danger text-end py-3 px-4">
                    <span style="cursor:pointer;" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa fa-times"></i> Close</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <table class="table bookingTable">
                    <tr>
                        <td colspan="2"><span class="pl-3" style="font-weight:900; color:#8967F0;">Plan Information</span></td>
                    </tr>
                    <tr>
                        <td>Plan Price</td>
                        <td><?= number_format($info[0]->bookingBasePrice*$info[0]->marlaSize); ?></td>
                    </tr>
                    <tr>
                        <td>Type Discount</td>
                        <td>
                            <?= $info[0]->bookingtypeDiscount; ?>% •
                            <span class="text-primary"><?= number_format(($info[0]->bookingBasePrice * $info[0]->marlaSize) * ($info[0]->bookingtypeDiscount/100)); ?></span>
                            <span style="font-size:10px;">Rupees</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Net Price</td>
                        <td><?= number_format($info[0]->bokNetPrice); ?></td>
                    </tr>
                    <tr>
                        <td>Per Marla Price</td>
                        <td><?= number_format($info[0]->bokNetPrice/$info[0]->marlaSize); ?></td>
                    </tr>
                    <tr>
                        <td>Special Discount</td>
                        <td>
                            <?= $info[0]->sepDiscount; ?>% •
                            <span class="text-primary"><?= number_format($info[0]->bokNetPrice * ($info[0]->sepDiscount/100)); ?></span>
                            <span style="font-size:10px;">Rupees</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Extra Land Charges</td>
                        <td><?= number_format($info[0]->exCharges); ?></td>
                    </tr>
                    <tr>
                        <td>Feature Charges <?= ($info[0]->featuresPercent==0) ? "<span class='text-primary' style='font-size:10px;'>(N/A)</span>" : "<span class='text-primary' style='font-size:10px;'>".$info[0]->features."</span>"; ?></td>
                        <td>
                            <?= $info[0]->featuresPercent; ?>% •
                            <span class="text-primary"><?= number_format($info[0]->salePrice * ($info[0]->featuresPercent/100)); ?></span>
                            <span style="font-size:10px;">Rupees</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-danger">Sale Price</td>
                        <td class="fw-bold text-danger"><?= number_format($info[0]->salePrice); ?></td>
                    </tr>
                    <tr>
                        <td>Down Payment</td>
                        <td>
                            <?= sprintf('%02d',$info[0]->downPayment); ?>% •
                            <span class="text-primary"><?= number_format($info[0]->salePrice * $info[0]->downPayment / 100); ?></span>
                            <span style="font-size:10px;">Rupees</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Confirmation</td>
                        <td>
                            <?= sprintf('%02d',$info[0]->confirmPay); ?>% •
                            <span class="text-primary"><?= number_format($info[0]->salePrice * $info[0]->confirmPay / 100); ?></span>
                            <span style="font-size:10px;">Rupees</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Semi-Annual</td>
                        <td>
                            <?= sprintf('%02d',$info[0]->semiAnnual); ?>% •
                            <span class="text-primary"><?= number_format($info[0]->salePrice * $info[0]->semiAnnual / 100); ?></span>
                            <span style="font-size:10px;">Rupees</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Possession</td>
                        <td>
                            <?= sprintf('%02d',$info[0]->possession); ?>% •
                            <span class="text-primary"><?= number_format($info[0]->salePrice * $info[0]->possession / 100); ?></span>
                            <span style="font-size:10px;">Rupees</span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-4" style="border-left:1px solid #C6C7C2;">
                <table class="table bookingTable">
                    <tr>
                        <td colspan="2"><span class="pl-3" style="font-weight:900; color:#8967F0;">Booking Information</span></td>
                    </tr>
                    <tr>
                        <td>Receipt No</td>
                        <td><?= 'BK-'.$bokRecp; ?></td>
                    </tr>
                    <tr>
                        <td>Booking Amount <span style="font-size:10px;">(Down Payment)</span></td>
                        <td><?= number_format($info[0]->bookingAmount); ?></td>
                    </tr>
                    <tr>
                        <td>Payment Plan</td>
                        <td><?= $info[0]->planYears; ?> Years <span class="text-primary" style="font-size:12px;">(<?= $info[0]->planYears*12; ?> mo*)</span></td>
                    </tr>
                    <tr>
                        <td>Payment Mode</td>
                        <td><?= $info[0]->bookingMode; ?></td>
                    </tr>
                    <tr>
                        <td>Reference No</td>
                        <td><?php echo ($info[0]->bookingReferenceNo == 0) ? "<span class='text-danger'>N/A</span>" : $info[0]->bookingReferenceNo; ?></td>
                    </tr>
                    <tr>
                        <td>Bank Name</td>
                        <td><?php echo ($info[0]->bankName == 0) ? "<span class='text-danger'>N/A</span>" : $info[0]->bankName; ?></td>
                    </tr>
                    <tr>
                        <td>Agent Name</td>
                        <td><?= $info[0]->agentName; ?></td>
                    </tr>
                    <tr>
                        <td>Received In</td>
                        <td><?= $info[0]->locName; ?></td>
                    </tr>
                    <tr>
                        <td>Booking Date</td>
                        <td><?= date('d-m-Y l',strtotime($info[0]->purchaseDate)); ?></td>
                    </tr>
                    <tr>
                        <td>Booked By</td>
                        <td><?= $info[0]->empName; ?></td>
                    </tr>
                    <tr>
                        <td>Issuance Date</td>
                        <td><?= ($info[0]->fileIssuanceDate!='') ? "<span class='text-primary'>".date('d-m-Y l',strtotime($info[0]->fileIssuanceDate))."</span>" : "<span class='text-danger'>Not issued yet</span>"; ?></td>
                    </tr>
                    <tr>
                        <td>Updated at</td>
                        <td><?= ($info[0]->updatedBooking!=null) ? "<span class='text-primary'>".date('d-m-Y',strtotime($info[0]->updatedBooking))."</span>" : "<span class='text-danger'>Not updated yet</span>"; ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-4" style="border-left:1px solid #C6C7C2;">
                <table class="table bookingTable">
                    <tr>
                        <td colspan="2"><span class="pl-3" style="font-weight:900; color:#8967F0;">Payment Summary</span></td>
                    </tr>
                    <tr>
                        <td>Amount Received From Booking</td>
                        <td><?= number_format($info[0]->bookingAmount); ?></td>
                    </tr>
                    <tr>
                        <td>Total Number of Installments</td>
                        <td>
                            <?= $info[0]->planYears*12; ?>
                            <span class="text-primary" style="font-size: 10px;">Installments</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Total Recevied Installments</td>
                        <td>
                            <?= sprintf('%02d', $countInstallments); ?>
                            <span class="text-primary" style="font-size: 10px;">Installments Received</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Total Pending Installments</td>
                        <td>
                            <?= sprintf('%02d', ($info[0]->planYears*12) - $countInstallments); ?>
                            <span class="text-primary" style="font-size: 10px;">Installments Pending</span>
                        </td>
                    </tr>
                    <tr>
                        <td>Amount Received From Installments</td>
                        <td><?= ($totalInstallAmount==0) ? "<span class='text-danger'>Not received yet</span>" : number_format($totalInstallAmount); ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bold">Total Amount</td>
                        <td class="fw-bold"><?= $saleP=number_format($info[0]->salePrice); ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-success">Total Received</td>
                        <td class="fw-bold text-success"><?= $recvAmt=number_format($info[0]->bookingAmount + $totalInstallAmount); ?></td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-danger">Total Receivable</td>
                        <td class="fw-bold text-danger"><?= $dueAmt=number_format($info[0]->salePrice - ($info[0]->bookingAmount + $totalInstallAmount)); ?></td>
                    </tr>
                </table>
                <div class="row mt-5">
                    <div class="col text-center">
                        <div id="chartdiv1"></div>
                        <input type="hidden" value="<?= $saleP; ?>" id="totalAmt">
                        <input type="hidden" value="<?= $recvAmt; ?>" id="recvAmt">
                        <input type="hidden" value="<?= $dueAmt; ?>" id="dueAmt">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div id="chartdiv2"></div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="fileIssueModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <div class="row">
                <div class="col">
                    <h5 class="modal-title">File Issuance Date</h5>
                    <p style="margin-top:-5px!important;">Enter the date carefully, as it will not be editable later.<br>
                        <span class="text-danger"><?= $info[0]->membershipNo; ?></span>
                    </p>
                </div>
            </div>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Select Issuance Date</label>
                        <div class="input-groupicon">
                            <input id="fileIssuanceDate" oninput="validateDate(event)" type="text" value="<?= date('d-m-Y'); ?>" placeholder="DD-MM-YYYY" class="datetimepicker">
                            <div class="addonset">
                                <img src="<?= base_url('assets/img/icon/calendar.png'); ?>" width="20" alt="img">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-secondary form-control" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="col-6">
                    <button data-id="<?= $info[0]->bookingId; ?>" type="button" class="btn btn-primary issueFile form-control">Procceed</button>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<script>
    var totalAmt=document.getElementById("totalAmt").value;
    var recvAmt=document.getElementById("recvAmt").value;
    var dueAmt=document.getElementById("dueAmt").value;
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chartdiv1", am4charts.PieChart);
    chart.data = [ {
      "Title": "Received",
      "Price": recvAmt
    }, {
      "Title": "Due",
      "Price": dueAmt
    } ];
    
    var pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = "Price";
    pieSeries.dataFields.category = "Title";
    pieSeries.slices.template.stroke = am4core.color("#fff");
    pieSeries.slices.template.strokeWidth = 2;
    pieSeries.slices.template.strokeOpacity = 1;
    pieSeries.hiddenState.properties.opacity = 1;
    pieSeries.hiddenState.properties.endAngle = -90;
    pieSeries.hiddenState.properties.startAngle = -90;
</script>
<script>
    $('.issueFile').click(function(){
        var id = $(this).data('id');
        var issueDate = $('#fileIssuanceDate').val();
        swal({
            title: "Are you sure?",
            text: "You want to issue the file!",
            type: "info",
            showCancelButton: true,
            showLoaderOnConfirm: true,
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
                    data: {
                        id: id,
                        issueDate: issueDate
                    },
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