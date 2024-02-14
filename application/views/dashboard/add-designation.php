<?php $role=$this->session->userdata('role'); ?>
<div class="page-wrapper px-4 mt-4">
    <div class="row">
        <div class="col">
            <div class="page-header mt-3">
                <div class="page-title">
                    <h4>Designations</h4>
                    <h6>Create & Manage Designation</h6>
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
                                <label>Designation Code</label>
                                <div class="input-groupicon">
                                    <input oninput="validate(event)" type="text" placeholder="Enter Designation Code" id="designCode" name="designCode" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label>Designation Name</label>
                                <div class="input-groupicon">
                                    <input oninput="validate(event)" type="text" placeholder="Enter Designation Name" id="designName" name="designName" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <a class="btn form-control btn-submit me-2" id="addDesignation">Add Designation</a>
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
                            <th>Designation</th>
                            <th class="text-center">Status</th>
                            <?php if($role=='admin'): ?>
                                <th class="text-center">Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sr=1;
                            foreach($designations as $designation):
                            $status=$designation->desigStatus;
                        ?>
                        <tr>
                            <td><?= sprintf("%02d", $sr++); ?></td>
                            <td><?= $designation->desigCode; ?></td>
                            <td><?= $designation->desigName; ?></td>
                            <td class="text-center">
                                <?php if($status==1){ ?>
                                    <span class="badges bg-lightgreen">Active</span>
                                <?php }else{ ?>
                                    <span class="badges bg-lightred">Inactive</span>
                                <?php } ?>
                            </td>
                            <?php if($role=='admin'): ?>
                                <td class="text-center">
                                    <a class="me-3" href="">
                                        <img src="<?= base_url('assets/img/icons/edit.svg'); ?>" alt="img">
                                    </a>
                                    <a class="me-3 confirm-text" href="javascript:void(0);">
                                        <img src="<?= base_url('assets/img/icons/delete.svg'); ?>" alt="img">
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
<script>
	$('#addDesignation').on('click', function(){
        var designCode = $('#designCode').val();
        var designName = $('#designName').val();
        if(designCode !== "" && designName !== ""){
            swal({
                title: "Are you sure?",
                text: "You want to add the designation!",
                type: "info",
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Yes, add it!",
                cancelButtonClass: "btn-primary",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm){
                if(isConfirm){
                    $.ajax({
                        url: "<?php echo base_url('dashboard/saveDesignation'); ?>",
                        type: "POST",
                        data: {
                            desigCode: designCode,
                            designName: designName
                        },
                        cache: false,
                        success: function(dataResult){
                            if(dataResult == true){
                                swal({
                                    title: "Congratulation!", 
                                    text: "Designation has been added successfully.", 
                                    type: "success"
                                }, function(){ 
                                    location.reload();
                                });
                            } else {
                                swal("Ops!", "Something went wrong.", "error");
                            }
                        }
                    });
                } else {
                    swal.close();
                }
            });
        } else {
            swal("Sorry!", "Please fill all the fields.", "info");
        }
    });
</script>