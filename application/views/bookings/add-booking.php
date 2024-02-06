<div class="page-wrapper px-4 mt-4">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <div class="page-title">
                    <h4>Add New Booking</h4>
                    <h6>Fill out the form</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-9">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Select Project</label>
                                <select class="form-control">
                                    <option selected disabled>Select Project</option>
                                    <!-- <option>Category</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Select Category</label>
                                <select class="form-control">
                                    <option selected disabled>Select Category</option>
                                    <!-- <option>Category</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Select Sub-Category</label>
                                <select class="form-control">
                                    <option selected disabled>Select Sub-Category</option>
                                    <!-- <option>Category</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Select Type</label>
                                <select class="form-control">
                                    <option selected disabled>Select Type</option>
                                    <!-- <option>Category</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Customer CNIC</label>
                                <div class="input-groupicon">
                                    <input type="text" placeholder="without (-) dashes">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Select City</label>
                                <select class="form-control">
                                    <option selected disabled>Select City</option>
                                    <!-- <option>Category</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Select Agent</label>
                                <select class="form-control">
                                    <option selected disabled>Select Agent</option>
                                    <!-- <option>Category</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Per Marla Price</label>
                                <div class="input-groupicon">
                                    <input disabled type="text" placeholder="0.0">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Special Discount</label>
                                <div class="input-groupicon">
                                    <input type="text" placeholder="0.0">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Amount Paid/Down Payment</label>
                                <div class="input-groupicon">
                                    <input type="text" placeholder="0.0">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Select Payment Mode</label>
                                <select class="form-control">
                                    <option selected disabled>Payment Mode</option>
                                    <!-- <option>Category</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Reference no</label>
                                <div class="input-groupicon">
                                    <input type="text" placeholder="Reference no">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-11 col-lg-5">
                            <div class="form-group">
                                <label>Select Bank</label>
                                <select class="form-control">
                                    <option selected disabled>Select Bank</option>
                                    <!-- <option>Category</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-1 col-lg-1">
                            <label style="color:transparent;">PM</label>
                            <div data-bs-toggle="modal" data-bs-target="#addNewBank" class="add-icon" style="padding-top:15%!important;">
                                <a href="javascript:void(0);"><img src="<?= base_url('assets/img/icons/plus1.svg'); ?>" alt="img"></a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Received In</label>
                                <select class="form-control">
                                    <option selected disabled>Select Location</option>
                                    <!-- <option>Category</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Select Payment Plan</label>
                                <select class="form-control">
                                    <option selected disabled>Select Payment Plan</option>
                                    <!-- <option>Category</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Extra Land Charges</label>
                                <div class="input-groupicon">
                                    <input type="text" placeholder="0.0">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Purchase Date</label>
                                <div class="input-groupicon">
                                    <input type="text" placeholder="DD-MM-YYYY" class="datetimepicker">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icons/calendars.svg'); ?>" alt="img">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Filer Status</label>
                                <select class="form-control">
                                    <option value="Inactive">Inactive</option>
                                    <option value="Active">Active</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Tax Percentage</label>
                                <div class="input-groupicon">
                                    <input type="text" placeholder="0.0">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <label>Features</label>
                            <div class="row mt-3">
                                <div class="col-4">
                                    <input type="checkbox">
                                    <span class="checkmarks"></span>Corner
                                </div>
                                <div class="col-4">
                                    <input type="checkbox">
                                    <span class="checkmarks"></span>Boulevard
                                </div>
                                <div class="col">
                                    <input type="checkbox">
                                    <span class="checkmarks"></span>Park Facing
                                </div>
                            </div>    
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <a href="javascript:void(0);" class="btn form-control btn-submit me-2">Confirm and Submit Booking</a>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <a href="<?= base_url('booking'); ?>" class="btn form-control btn-cancel me-2">View Bookings</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="total-order" style="margin:0%!important;">
                        <ul>
                            <li>
                                <h4>Total Price</h4>
                                <h5>0</h5>
                            </li>
                            <li>
                                <h4>Discount</h4>
                                <h5>0</h5>
                            </li>
                            <li>
                                <h4>Payment Plan</h4>
                                <h5>0 Yr(s)</h5>
                            </li>
                            <li>
                                <h4>Down Payment</h4>
                                <h5>% &middot; 0</h5>
                            </li>
                            <li>
                                <h4>Confirmation</h4>
                                <h5>% &middot; 0</h5>
                            </li>
                            <li>
                                <h4>Semi Annual</h4>
                                <h5>% &middot; 0</h5>
                            </li>
                            <li>
                                <h4>Possession</h4>
                                <h5>% &middot; 0</h5>
                            </li>
                            <li>
                                <h4>Grand Total</h4>
                                <h5>0</h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <h6>Information</h6>
            <span class="text-muted">Feature Charges are 10% of the total amount for each feature.</span>
        </div>
    </div>
</div>
<div class="modal fade" id="addNewBank" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Bank Details</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Bank Name</label>
                            <div class="input-groupicon">
                                <input type="text" placeholder="Enter Bank Name">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label>Branch Code</label>
                            <div class="input-groupicon">
                                <input type="text" placeholder="Enter Branch Code">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label>Branch Location</label>
                            <div class="input-groupicon">
                                <input type="text" placeholder="Enter Branch Location">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <a href="javascript:void(0);" class="btn form-control btn-submit me-2">Submit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>