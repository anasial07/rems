<style>
    .heading{ font-size:14px; color:#7367F0; font-weight:600; line-height: 35px; padding-left:2.5%!important; }
    .bookingTable tr td{ border:none!important; line-height:0.3; }
</style>
<div class="page-wrapper">
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>AHC/V/0005/2023</h4>
                <h6>Membership#</h6>
            </div>
            <div class="page-btn">
            <button type="button" class="btn btn-rounded btn-danger">Cancellation Request</button>
            <button type="button" class="btn btn-rounded btn-primary">Booking Memo</button>
            <button type="button" class="btn btn-rounded btn-secondary">Welcome Letter</button>
            <button type="button" class="btn btn-rounded btn-info text-white">Confirmation Latter</button>
            <button type="button" class="btn btn-rounded btn-dark">Booking Form</button>
            <button type="button" class="btn btn-rounded btn-success">Payment Plan</button>
            </div>
        </div>
        <div class="card p-4">
            <div class="row bg-light py-3">
                <div class="col">
                    <span class="heading">Customer Information</span>
                    <table class="table bookingTable">
                        <tr>
                            <td>Customer</td>
                            <td>Muhammad Anas</td>
                        </tr>
                        <tr>
                            <td>CNIC</td>
                            <td>3810173371555</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>03344903350</td>
                        </tr>
                        <tr>
                            <td>Employee</td>
                            <td class="text-success">Yes</td>
                        </tr>
                    </table>
                </div>
                <div class="col" style="border-left:1px solid #C6C7C2;">
                    <span class="heading">Booking Information</span>
                    <table class="table bookingTable">
                        <tr>
                            <td>Category</td>
                            <td>Residencial</td>
                        </tr>
                        <tr>
                            <td>Sub-Category</td>
                            <td>Plot</td>
                        </tr>
                        <tr>
                            <td>Type</td>
                            <td>5 Marla</td>
                        </tr>
                        <tr>
                            <td>Payment Plan</td>
                            <td>4 Year(s)</td>
                        </tr>
                    </table>
                </div>
                <div class="col" style="border-left:1px solid #C6C7C2;">
                    <span class="heading">Payment Information</span>
                    <table class="table bookingTable">
                        <tr>
                            <td>Sale Price</td>
                            <td>2,000,000</td>
                        </tr>
                        <tr>
                            <td>Discount</td>
                            <td>200,000</td>
                        </tr>
                        <tr>
                            <td>Features</td>
                            <td>N/A</td>
                        </tr>
                        <tr>
                            <td>Purchase Date</td>
                            <td>Aug 08, 2023</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
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
                            <li><h6>Installment History</h6></li>
                        </ul>
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
                                <th>Tax %</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php for($i=1; $i<=20; $i++): ?>
                            <tr>
                                <td>500,000</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>Cash</td>
                                <td>Islamabad</td>
                                <td>Jan 03, 2024</td>
                                <td class="text-success">Filer</td>
                                <td>5%</td>
                                <td class="text-center"><span class="badges bg-lightgreen">Paid</span></td>
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="" class="dropdown-item"><img src="<?= base_url('assets/img/icons/edit.svg'); ?>" class="me-2" alt="img">Edit Installment</a></li>
                                        <li><a href="" class="dropdown-item"><img src="<?= base_url('assets/img/icons/delete1.svg'); ?>" class="me-2" alt="img">Delete Installment</a></li>
                                    </ul>
                                </td>
                            </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>