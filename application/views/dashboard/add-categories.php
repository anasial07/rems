<style>
    .product-details{ height:90px!important; cursor: pointer; }
    .product-details img{ width:38px!important; }
</style>
<?php $role=$this->session->userdata('role'); ?>
<div class="page-wrapper px-4 mt-4">
    <div class="row">
        <div class="col">
            <div class="page-header mt-3">
                <div class="page-title">
                    <h4>Categories</h4>
                    <h6>Create & Manage Categories</h6>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col">
                    <a href="<?= base_url('dashboard/addProject'); ?>">
                        <div class="product-details">
                            <img src="<?= base_url('assets/img/icon/project.png'); ?>" alt="img">
                            <h6>Projects</h6>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="<?= base_url('dashboard/addCategories'); ?>">
                        <div class="product-details active">
                            <img src="<?= base_url('assets/img/icon/category.png'); ?>" alt="img">
                            <h6>Categories</h6>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="<?= base_url('dashboard/addSubCategories'); ?>">
                        <div class="product-details">
                            <img src="<?= base_url('assets/img/icon/sub-type.png'); ?>" alt="img">
                            <h6>Sub-Categ...</h6>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="<?= base_url('dashboard/addTypes'); ?>">
                        <div class="product-details">
                            <img src="<?= base_url('assets/img/icon/types.png'); ?>" alt="img">
                            <h6>Types</h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-5">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-12">
                            <div class="form-group">
                                <label>Select Project</label>
                                <select id="projID" name="projID" class="form-control catData">
                                    <option selected disabled>Select Project</option>
                                    <?php foreach($projects as $project): ?>
                                        <option value="<?= $project->projectId; ?>"><?= $project->projName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-12">
                            <div class="form-group">
                                <label>Category Name</label>
                                <div class="input-groupicon">
                                    <input oninput="validate(event)" id="catName" name="catName" class="catData" type="text" placeholder="Enter Category">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <a id="addCat" class="btn form-control btn-submit me-2">Add Category</a>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <a href="javascript:history.go(-1);" class="btn form-control btn-cancel">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
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
                                <th>Project</th>
                                <th>Category</th>
                                <th class="text-center">Status</th>
                                <?php if($role=='admin'): ?>
                                    <th class="text-center">Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sr=1;
                                foreach($categories as $cats):
                                $status=$cats->catStatus;
                            ?>
                            <tr>
                                <td><?= sprintf("%02d", $sr++); ?></td>
                                <td><?= $cats->projCode; ?></td>
                                <td><?= $cats->catName; ?></td>
                                <td class="text-center">
                                    <?php if($status==1){ ?>
                                        <span class="badges bg-lightgreen">Active</span>
                                    <?php }else{ ?>
                                        <span class="badges bg-lightred">Inactive</span>
                                    <?php } ?>
                                </td>
                                <?php if($role=='admin'): ?>
                                    <td class="text-center">
                                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="" class="dropdown-item"><img src="<?= base_url('assets/img/icons/edit.svg'); ?>" class="me-2" alt="img">Edit Category</a>
                                            </li>
                                            <li>
                                                <a href="" class="dropdown-item confirm-text"><img src="<?= base_url('assets/img/icons/delete1.svg'); ?>" class="me-2" alt="img">Delete Category</a>
                                            </li>
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
<script>
    $('#addCat').on('click', function(){
        var projID = $('#projID').val();
        var catName = $('#catName').val();

        if(projID !== "Select Project" && catName !== ""){
            swal({
                title: "Are you sure?",
                text: "You want to add the category!",
                type: "info",
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Yes, add it!",
                cancelButtonClass: "btn-primary",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if(isConfirm){
                    $.ajax({
                        url: "<?php echo base_url("dashboard/addCategory"); ?>",
                        type: "POST",
                        data: {
                            projectId: projID,
                            catName: catName
                        },
                        cache: false,
                        success: function(dataResult){
                            if(dataResult == true){
                                swal({
                                    title: "Congratulation!", 
                                    text: "Category has been added successfully.", 
                                    type: "success"
                                    },
                                    function(){ 
                                        location.reload();
                                    }
                                );
                            }else{
                                swal("Ops!", "Something went wrong.", "error");
                            }
                        }
                    });
                } else {
                    swal.close()
                }
            });
        }else{
            swal("Sorry!", "Please fill all the fields.", "info");
        }
    });
</script>