<div class="page-wrapper px-4 mt-4">
    <div class="row">
        <div class="col">
            <div class="page-header mt-3">
                <div class="page-title">
                    <h4>Add Installment</h4>
                    <h6>Fill out the form</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-6 mb-1">
                            <div class="form-group">
                                <label>Select Project</label>
                                <select class="form-control">
                                    <option selected disabled>Select Project</option>
                                    <!-- <option>Category</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6" id="selectName">
                            <div class="form-group">
                            <label style="display: flex; justify-content: space-between; align-items: center;">Select Customer<span onclick="changeField('0')" style="text-align: right; cursor:pointer;" class="text-primary">Search by CNIC</span></label>
                                <select class="form-control">
                                    <option selected disabled>Select Customer</option>
                                    <!-- <option>Category</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6" id="filterCNIC" style="display:none;">
                            <div class="form-group">
                            <label style="display: flex; justify-content: space-between; align-items: center;">Enter Customer CNIC<span onclick="changeField('1')" style="text-align: right; cursor:pointer;" class="text-primary">Search by name</span></label>
                                <div class="input-groupicon">
                                    <input type="text" placeholder="without (-) dashes">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Select Booking</label>
                                <select class="form-control">
                                    <option selected disabled>Select Booking</option>
                                    <!-- <option>Category</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Receving Amount</label>
                                <div class="input-groupicon">
                                    <input type="text" placeholder="0.0">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-3">
                            <div class="form-group">
                                <label>Reference Number</label>
                                <div class="input-groupicon">
                                    <input type="text" placeholder="Reference Number">
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
                            <div data-bs-toggle="modal" data-bs-target="#addBank" class="add-icon" style="padding-top:15%!important;">
                                <a href="javascript:void(0);"><img src="<?= base_url('assets/img/icons/plus1.svg'); ?>" alt="img"></a>
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
                                <label>Select Location</label>
                                <select class="form-control">
                                    <option selected disabled>Select Location</option>
                                    <!-- <option>Category</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Receving Date</label>
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
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <a href="javascript:void(0);" class="btn form-control btn-submit me-2">Confirm and Submit Installment</a>
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
                                <h4>Category</h4>
                                <h5>-</h5>
                            </li>
                            <li>
                                <h4>Sub-Category</h4>
                                <h5>-</h5>
                            </li>
                            <li>
                                <h4>Type</h4>
                                <h5>-</h5>
                            </li>
                            <li>
                                <h4>Payment Plan</h4>
                                <h5>-</h5>
                            </li>
                            <li>
                                <h4>Features</h4>
                                <h5>-</h5>
                            </li>
                            <li>
                                <h4>Sale Price</h4>
                                <h5>0</h5>
                            </li>
                            <li>
                                <h4>Discount</h4>
                                <h5>%</h5>
                            </li>
                            <li>
                                <h4>Amount Paid</h4>
                                <h5>0</h5>
                            </li>
                            <li>
                                <h4>Purchase Date</h4>
                                <h5>0</h5>
                            </li>
                            <li>
                                <h4>Receiveable</h4>
                                <h5>0</h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="addBank" tabindex="-1" aria-hidden="true">
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

<script type="text/javascript">
    function changeField(val){
        if(val==0){
            document.getElementById("selectName").style.display="none";
            document.getElementById("filterCNIC").style.display="inline";
        }else{
            document.getElementById("selectName").style.display="inline";
            document.getElementById("filterCNIC").style.display="none";
        }
    }
</script>