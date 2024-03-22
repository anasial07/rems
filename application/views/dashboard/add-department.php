<style>
    .product-details {
        height: 90px !important;
        cursor: pointer;
    }

    .product-details img {
        width: 38px !important;
    }
</style>
<?php $role = $this->session->userdata('role'); ?>
<div class="page-wrapper px-4 mt-4">
    <div class="row">
        <div class="col">
            <div class="page-header mt-3">
                <div class="page-title">
                    <h4>Departments</h4>
                    <h6>Create & Manage Departments</h6>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col">
                    <a href="<?= base_url('dashboard/provinces'); ?>">
                        <div class="product-details">
                            <img src="<?= base_url('assets/img/icon/province.png'); ?>" alt="img">
                            <h6>Province</h6>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="<?= base_url('dashboard/cities'); ?>">
                        <div class="product-details">
                            <img src="<?= base_url('assets/img/icon/city.png'); ?>" alt="img">
                            <h6>City</h6>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="<?= base_url('dashboard/offices'); ?>">
                        <div class="product-details">
                            <img src="<?= base_url('assets/img/icon/office.png'); ?>" alt="img">
                            <h6>Office</h6>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="<?= base_url('dashboard/departments'); ?>">
                        <div class="product-details active">
                            <img src="<?= base_url('assets/img/icon/department.png'); ?>" alt="img">
                            <h6>Department</h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label>Department Code</label>
                                <div class="input-groupicon">
                                    <input oninput="validate(event)" id="departCode" name="departCode" class="departData" type="text" placeholder="Enter Department Code">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label>Department Name</label>
                                <div class="input-groupicon">
                                    <input oninput="validate(event)" id="departName" name="departName" class="departData" type="text" placeholder="Enter Department Name">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <a id="addDepart" class="btn form-control btn-submit me-2">Add Department</a>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <a href="javascript:history.go(-1);" class="btn form-control btn-cancel">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card mt-4">
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
                                    <th>Code</th>
                                    <th>Department</th>
                                    <th class="text-center">Status</th>
                                    <?php if ($role == 'admin') { ?>
                                        <th class="text-center">Action</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sr = 1;
                                foreach ($departments as $depart) :
                                    $status = $depart->departStatus;
                                ?>
                                    <tr>
                                        <td><?= sprintf("%02d", $sr++); ?></td>
                                        <td><?= $depart->departCode; ?></td>
                                        <td><?= $depart->departName; ?></td>
                                        <td class="text-center">
                                            <?php if ($status == 1) { ?>
                                                <span class="badges bg-lightgreen">Active</span>
                                            <?php } else { ?>
                                                <span class="badges bg-lightred">Inactive</span>
                                            <?php } ?>
                                        </td>
                                        <?php if ($role == 'admin') : ?>
                                            <td class="text-center">
                                                <a class="me-3" href="">
                                                    <img src="<?= base_url('assets/img/icons/edit.svg'); ?>" alt="img">
                                                </a>
                                                <a class="me-3 confirm-text delDepart" data-id="<?= $depart->departId; ?>">
                                                    <?php if ($status == 1) { ?>
                                                        <img src="<?= base_url('assets/img/icons/delete.svg'); ?>" alt="img">
                                                    <?php } else { ?>
                                                        <img src="<?= base_url('assets/img/icon/recycle.png'); ?>" width="20">
                                                    <?php } ?>
                                                </a>
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
    $('#addDepart').on('click', function() {
        var departCode = $('#departCode').val();
        var departName = $('#departName').val();
        if (departCode != "" && departName != "") {
            swal({
                    title: "Are you sure?",
                    text: "You want to add the department!",
                    type: "info",
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Yes, add it!",
                    cancelButtonClass: "btn-primary",
                    cancelButtonText: "No, cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "<?php echo base_url("dashboard/addDepartment"); ?>",
                            type: "POST",
                            data: {
                                departCode: departCode,
                                departName: departName
                            },
                            cache: false,
                            success: function(dataResult) {
                                if (dataResult == true) {
                                    swal({
                                        title: "Congratulation!",
                                        text: "Department has been added successfully.",
                                        type: "success"
                                    }, function() {
                                        location.reload();
                                    });
                                } else {
                                    swal("Ops!", "Something went wrong.", "error");
                                }
                            }
                        });
                    } else {
                        swal.close()
                    }
                });
        } else {
            swal("Sorry!", "Please fill all the field.", "info");
        }
    });
    $('.delDepart').click(function() {
        var id = $(this).data('id');
        swal({
                title: "Are you sure?",
                text: "You want to change the status!",
                type: "info",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Yes, change",
                cancelButtonClass: "btn-primary",
                cancelButtonText: "No, cancel",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "<?php echo base_url("dashboard/deleteDepart/"); ?>" + id,
                        method: 'POST',
                        dataType: 'JSON',
                        data: {
                            id: id
                        },
                        success: function(res) {
                            if (res == true) {
                                window.location.reload();
                            } else {
                                swal("Ops", "Something went wrong", "info");
                            }
                        }
                    });
                } else {
                    swal.close()
                }
            });
    });
</script>