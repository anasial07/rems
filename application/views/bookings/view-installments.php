<?php $rights=explode(',',$userPermissions); ?>
<div class="page-wrapper px-4 mt-4">
    <div class="page-header mx-1">
        <div class="page-title">
            <h4>Installment List</h4>
            <h6>Add & Manage your Installments</h6>
        </div>
        <?php if(in_array('createInstallments',$rights)): ?>
        <div class="page-btn">
            <a href="<?= base_url('booking/addInstallment'); ?>" class="btn btn-added"><img src="<?= base_url('assets/img/icons/plus.svg'); ?>" alt="img">Add New Installment</a>
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
                                <th>Amount</th>
                                <th>Payment Mode</th>
                                <th>Receiving Date</th>
                                <th class="text-center">ATL Status</th>
                                <?php if(in_array('installmentReceipt', $rights)): ?>
                                    <th class="text-center">Print</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sr=1;
                                foreach($installments as $install):
                                $ATLSatus=$install->installFilerStatus;
                            ?>
                                <tr>
                                    <td><?= sprintf("%02d", $sr++); ?></td>
                                    <td><?= 'INST-'.sprintf("%02d", $install->installmentId); ?></td>
                                    <td class="fw-bold"><?= $install->membershipNo; ?></td>
                                    <td class="text-success"><?= number_format($install->installAmount); ?></td>
                                    
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
                                    <td><?= date('d M, Y',strtotime($install->installReceivedDate)); ?></td>
                                    <td class="text-center">
                                        <?php
                                        if($ATLSatus=='ATL'){ ?>
                                            <span class="badges bg-lightgreen"><?= $ATLSatus.' | '.$install->installFilerPercent.'%'; ?></span>
                                        <?php }else{ ?>
                                            <span class="badges bg-lightred"><?= $ATLSatus.' | '.$install->installFilerPercent.'%'; ?></span>
                                        <?php }  ?>
                                    </td>
                                    <?php if(in_array('installmentReceipt', $rights)): ?>
                                    <td class="text-center">
                                        <a data-bs-toggle="tooltip" data-bs-placement="top" title="Print Installment Receipt" target="_blank" href="<?= base_url('GeneratePDF/bookingReceipt/').base_convert($install->installmentId, 10, 36).'?receipt=installment'; ?>"><img src="<?= base_url('assets/img/icons/printer.svg') ?>" alt="img"></a>
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