<style>
    .heading{ font-size:14px; color:#7367F0; font-weight:600; line-height: 35px; padding-left:2.5%!important; }
    .bookingTable tr td{ border:none!important; line-height:0.3; }
    .topBtn{ border-radius:0px; }
</style>
<?php $role=$this->session->userdata('role'); ?>
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4><?= $info[0]->membershipNo; ?></h4>
                <h6>Membership#</h6>
            </div>
            <div class="page-btn">
                <!-- <button type="button" class="btn btn-rounded topBtn btn-danger">Cancellation Request</button> -->
                <a target="_blank" href="<?= base_url('booking/generateBookingMemo/').base_convert($info[0]->bookingId, 10, 36); ?>"><button class="btn btn-rounded topBtn btn-primary">Booking Memo</button></a>
                <a target="_blank" href="<?= base_url('booking/generateWelcomeLetter/').base_convert($info[0]->bookingId, 10, 36); ?>"><button class="btn btn-rounded topBtn btn-secondary">Welcome Letter</button></a>
                <a target="_blank" href="<?= base_url('booking/generateConfirmationLetter/').base_convert($info[0]->bookingId, 10, 36); ?>"><button class="btn btn-rounded topBtn btn-info text-white">Confirmation Letter</button></a>
                <a target="_blank" href="<?= base_url('booking/generateBookingForm/').base_convert($info[0]->bookingId, 10, 36); ?>"><button class="btn btn-rounded topBtn btn-dark">Booking Form</button></a>
                <a target="_blank" href="<?= base_url('booking/generatePaymentPlan/').base_convert($info[0]->bookingId, 10, 36); ?>"><button class="btn btn-rounded topBtn btn-success">Payment Plan</button></a>
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
                            <td>Sale Price</td>
                            <td><?= number_format($info[0]->salePrice); ?></td>
                        </tr>
                        <tr>
                            <td>Discount</td>
                            <td><?= number_format($info[0]->sepDiscount); ?>%</td>
                        </tr>
                        <tr>
                            <td>Features (<?= $info[0]->featuresPercent.'%'; ?>)</td>
                            <td><?= ($info[0]->features==0) ? 'N/A' : $info[0]->features; ?></td>
                        </tr>
                        <tr>
                            <td>Purchase Date</td>
                            <td><?= date('M d, Y',strtotime($info[0]->purchaseDate)); ?></td>
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
                        <div class="col text-center mt-2"><h6>Installment History</h6></div>
                        <div class="col text-end mt-2">
                            <a target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Print Installment History" href="<?= base_url('booking/generateInstallmentHistory/').base_convert($info[0]->bookingId, 10, 36); ?>">
                                <h6>Account Statement</h6>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table datanew">
                            <thead>
                                <tr>
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
                                    <td><?= number_format($info[0]->bookingAmount); ?></td>
                                    <td><?php echo ($info[0]->bookingReferenceNo == 0) ? "N/A" : $info[0]->bookingReferenceNo; ?></td>
                                    <td><?php echo ($info[0]->bookBankId == 0) ? "N/A" : $info[0]->bankName; ?></td>
                                    <td><?= $info[0]->bookingMode; ?></td>
                                    <td><?= $info[0]->locName; ?></td>
                                    <td><?= date('M d, Y',strtotime($info[0]->purchaseDate)); ?></td>
                                    <td>
                                        <span class="<?= ($info[0]->bookFilerStatus == 'Active') ? 'text-success' : 'text-danger'; ?>">
                                            <?= $info[0]->bookFilerStatus; ?>
                                        </span>
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
                                                <li><a href="" class="dropdown-item"><img src="<?= base_url('assets/img/icons/edit.svg'); ?>" class="me-2" alt="img">Edit Installment</a></li>
                                                <li><a href="" class="dropdown-item"><img src="<?= base_url('assets/img/icons/delete1.svg'); ?>" class="me-2" alt="img">Delete Installment</a></li>
                                            </ul>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <?php foreach($installments as $install): ?>
                                <tr>
                                    <td><?= number_format($install->installAmount); ?></td>
                                    <td><?php echo ($install->installReferenceNo == 0) ? "N/A" : $install->installReferenceNo; ?></td>
                                    <td><?php echo ($install->installBankId == 0) ? "N/A" : $install->bankName; ?></td>
                                    <td><?= $install->installPayMode; ?></td>
                                    <td><?= $install->locName; ?></td>
                                    <td><?= date('M d, Y',strtotime($install->installReceivedDate)); ?></td>
                                    <td>
                                        <span class="<?= ($install->installFilerStatus == 'Active') ? 'text-success' : 'text-danger'; ?>">
                                            <?= $install->installFilerStatus; ?>
                                        </span>
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
                                                <li><a href="" class="dropdown-item"><img src="<?= base_url('assets/img/icons/delete1.svg'); ?>" class="me-2" alt="img">Delete Installment</a></li>
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