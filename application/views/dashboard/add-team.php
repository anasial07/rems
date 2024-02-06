<div class="page-wrapper px-4">
    <div class="row">
        <div class="col">
            <div class="page-header mt-3">
                <div class="page-title">
                    <h4>Teams</h4>
                    <h6>Create & Manage Teams</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="form-group">
                                <label>Team Name</label>
                                <div class="input-groupicon">
                                    <input type="text" placeholder="Enter Team Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Select Team Lead</label>
                                <select class="form-control">
                                    <option selected disabled>Select TL</option>
                                    <!-- <option>Category</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Select BDM</label>
                                <select class="form-control">
                                    <option selected disabled>Select BDM</option>
                                    <!-- <option>Category</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Select BCM</label>
                                <select class="form-control">
                                    <option selected disabled>Select BCM</option>
                                    <!-- <option>Category</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Select Zonal Manager</label>
                                <select class="form-control">
                                    <option selected disabled>Select ZM</option>
                                    <!-- <option>Category</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
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
                                <label>Select Office</label>
                                <select class="form-control">
                                    <option selected disabled>Select Office</option>
                                    <!-- <option>Category</option> -->
                                </select>
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
        <div class="col">
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
                            <th>Sr</th>
                            <th>Team</th>
                            <th>City</th>
                            <th>Created</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>01</td>
                            <td>Avenger</td>
                            <td>Islamabad</td>
                            <td>Jan 31, 2024</td>
                            <td class="text-center"><span class="badges bg-lightgreen">Active</span></td>
                            <td class="text-center">
                                <a class="me-3" href="">
                                    <img src="<?= base_url('assets/img/icons/edit.svg'); ?>" alt="img">
                                </a>
                                <a class="me-3 confirm-text" href="javascript:void(0);">
                                    <img src="<?= base_url('assets/img/icons/delete.svg'); ?>" alt="img">
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>