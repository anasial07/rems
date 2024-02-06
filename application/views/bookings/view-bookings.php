<style>
    .product-details{ height:90px!important; cursor: pointer; }
    .product-details img{ width:38px!important; }
</style>
<div class="page-wrapper px-4 mt-4">
    <div class="page-header">
        <div class="page-title">
            <h4>Booking List</h4>
            <h6>Add & Manage your Bookings</h6>
        </div>
        <div class="page-btn">
            <a href="<?= base_url('booking/addBooking'); ?>" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img">Add New Booking</a>
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
                            <th>Membership</th>
                            <th>Agent</th>
                            <th>Plan</th>
                            <th>Price</th>
                            <th>Amount</th>
                            <th>Mode</th>
                            <th>Purchased</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>01</td>
                        <td>AHC/V/0005/2023</td>
                        <td>Micah Lott</td>
                        <td>5 Marla</td>
                        <td>0.0</td>
                        <td>400,000</td>
                        <td>Cash</td>
                        <td>Jan 03, 1972</td>
                        <td class="text-center"><span class="badges bg-lightgreen">Active</span></td>
                        <td class="text-center">
                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('booking/bookingDetail'); ?>" class="dropdown-item"><img src="<?= base_url('assets/img/icons/eye1.svg'); ?>" class="me-2" alt="img">View Booking</a></li>
                                <li><a href="" class="dropdown-item"><img src="<?= base_url('assets/img/icons/edit.svg'); ?>" class="me-2" alt="img">Edit Booking</a></li>
                                <li><a href="" class="dropdown-item"><img src="<?= base_url('assets/img/icons/delete1.svg'); ?>" class="me-2" alt="img">Delete Booking</a></li>
                            </ul>
                        </td>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>