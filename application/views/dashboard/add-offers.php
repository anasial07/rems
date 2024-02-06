<div class="page-wrapper px-4 mt-3">
    <div class="row">
        <div class="col">
            <div class="page-header">
                <div class="page-title">
                    <h4>Offers</h4>
                    <h6>Create & Manage Offers</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Select Project</label>
                                <select class="form-control">
                                    <option selected disabled>Select Project</option>
                                    <!-- <option>Category</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Offer Name</label>
                                <div class="input-groupicon">
                                    <input type="text" placeholder="Enter Offer Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label>Offer in Percentage</label>
                                <div class="input-groupicon">
                                    <input type="text" placeholder="0.0">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icon/percent.png'); ?>" alt="img" width="15">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Starting Date</label>
                                <div class="input-groupicon">
                                    <input type="text" placeholder="DD-MM-YYYY" class="datetimepicker">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icons/calendars.svg'); ?>" alt="img">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Ending Date</label>
                                <div class="input-groupicon">
                                    <input type="text" placeholder="DD-MM-YYYY" class="datetimepicker">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icons/calendars.svg'); ?>" alt="img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <a href="javascript:void(0);" class="btn form-control btn-submit me-2">Submit</a>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <a href="javascript:history.go(-1);" class="btn form-control btn-cancel">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                                <a class="btn btn-filter" id="filter_search">
                                    <img src="<?= base_url('assets/img/icons/filter.svg') ?>" alt="img">
                                    <span><img src="<?= base_url('assets/img/icons/closes.svg') ?>" alt="img"></span>
                                </a>
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset"><img src="<?= base_url('assets/img/icons/search-white.svg') ?>" alt="img"></a>
                            </div>
                        </div>
                        <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="<?= base_url('assets/img/icons/printer.svg') ?>" alt="img"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table  datanew">
                        <thead>
                            <tr>
                                <th>Project</th>
                                <th>Offer Name</th>
                                <th>Off</th>
                                <th>Duration</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>AHC</td>
                                <td>Ramdan Offer</td>
                                <td class="text-danger">10%</td>
                                <td>12-Jan-2024 &middot; 12-Feb-2024</td>
                                <td class="text-center"><span class="badges bg-lightgreen">Active</span></td>
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="" class="dropdown-item"><img src="<?= base_url('assets/img/icons/edit.svg'); ?>" class="me-2" alt="img">Edit Offer</a>
                                        </li>
                                        <li>
                                            <a href="" class="dropdown-item confirm-text"><img src="<?= base_url('assets/img/icons/delete1.svg'); ?>" class="me-2" alt="img">Delete Offer</a>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>