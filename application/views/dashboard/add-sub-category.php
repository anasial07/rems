<style>
    .product-details{ height:90px!important; cursor: pointer; }
    .product-details img{ width:38px!important; }
</style>
<?php $rights=explode(',',$userPermissions); ?>
<div class="page-wrapper px-4 mt-4">
    <div class="row">
        <div class="col">
            <div class="page-header mt-3">
                <div class="page-title">
                    <h4>Sub-Categories</h4>
                    <h6>Create & Manage Sub-Categories</h6>
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
                        <div class="product-details">
                            <img src="<?= base_url('assets/img/icon/category.png'); ?>" alt="img">
                            <h6>Categories</h6>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="<?= base_url('dashboard/addSubCategories'); ?>">
                        <div class="product-details active">
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
        <?php if(in_array('createProject',$rights)): ?>
        <div class="col-5">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-12">
                            <div class="form-group">
                                <label>Select Project</label>
                                <select id="projectID" name="projectID" class="form-control">
                                    <option selected disabled>Select Project</option>
                                    <?php foreach($projects as $project): ?>
                                        <option value="<?= $project->projectId; ?>"><?= $project->projName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Category</label>
                                <select id="catID" name="catID" class="form-control">
                                    <option selected disabled>Select Category</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label>Sub-Category Name</label>
                                <div class="input-groupicon">
                                    <input oninput="validate(event)" id="subCatName" name="subCatName" type="text" placeholder="Enter Sub-Category">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <a id="addSubCat" class="btn form-control btn-submit me-2">Add Sub-Category</a>
                        </div>
                        <div class="col-lg-6 col-sm-6">
                            <a href="javascript:history.go(-1);" class="btn form-control btn-cancel">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="col-7">
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
                                <th>Sub-Category</th>
                                <th class="text-center">Status</th>
                                <?php if(in_array('editProject', $rights) || in_array('deleteProject', $rights)): ?>
                                    <th class="text-center">Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $sr=1;
                                foreach($subCats as $subCat):
                                $status=$subCat->subCatStatus;
                            ?>
                            <tr <?php if($status==0){ ?> style="background:#F7E4E7;" <?php } ?>>
                                <td><?= sprintf("%02d", $sr++); ?></td>
                                <td><?= $subCat->projCode; ?></td>
                                <td><?= $subCat->catName; ?></td>
                                <td><?php
                                    echo $subCat->subCatName;
                                    if($status==0){ echo "<p class='text-muted' style='font-size:10px;'>Deleted</p>"; }
                                ?></td>
                                <td class="text-center">
                                    <?php if($status==1){ $val="Delete"; ?>
                                        <span class="badges bg-lightgreen">Active</span>
                                    <?php }else{ $val="Recover"; ?>
                                        <span class="badges bg-lightred">Inactive</span>
                                    <?php } ?>
                                </td>
                                <?php if(in_array('editProject', $rights) || in_array('deleteProject', $rights)): ?>
                                    <td class="text-center">
                                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                        <?php if(in_array('editProject', $rights)): ?>
                                            <li>
                                                <a href="" class="dropdown-item"><img src="<?= base_url('assets/img/icons/edit.svg'); ?>" class="me-2" alt="img">Edit Sub-Category</a>
                                            </li>
                                        <?php endif; if(in_array('deleteProject', $rights)): ?>
                                            <li class="delSubCat" data-id="<?= $subCat->subCatId; ?>">
                                                <a class="dropdown-item confirm-text"><img src="<?= base_url('assets/img/icons/delete1.svg'); ?>" class="me-2" alt="img"><?=  $val; ?> Sub-Category</a>
                                            </li>
                                        <?php endif; ?>
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
</div>
<script>
	$('#addSubCat').on('click', function(){
        var projectID = $('#projectID').val();
        var catID = $('#catID').val();
        var subCatName = $('#subCatName').val();
        if(projectID!="Select Project" && catID!="Select Category" && subCatName!=""){
            swal({
                title: "Are you sure?",
                text: "You want to add the sub-category!",
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
            function(isConfirm){
                if(isConfirm){
                    $.ajax({
                        url: "<?php echo base_url("dashboard/addSubCategory"); ?>",
                        type: "POST",
                        data: {
                            projectId: projectID,
                            catId: catID,
                            subCatName: subCatName
                        },
                        cache: false,
                        success: function(dataResult){
                            if(dataResult==true){
                                swal({
                                    title: "Congratulation!", 
                                    text: "Sub-Category has been added successfully.", 
                                    type: "success"
                                    },function(){ 
                                        location.reload();
                                    }
                                );
                            }else{
                                swal("Ops!", "Something went wrong.", "error");
                            }
                        }
                    });
                }else{
                    swal.close()
                }
            });
        }else{
            swal("Sorry!", "Please fill all the field.", "info");
        }
	});
    $('#projectID').change(function(){
        projectID = $(this).val();
        $.ajax({
            url: "<?php echo base_url('dashboard/getCats/'); ?>" + projectID,
            method: 'POST',
            dataType: 'JSON',
            data: {projectID: projectID},
            success: function(res){
                $('#catID').find('option').not(':first').remove();
                $.each(res, function(index, data){
                    $('#catID').append('<option value="' + data['catId'] + '">' + data['catName'] + '</option>');
                });
            }
        });
    });
    $('.delSubCat').click(function(){
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
        function(isConfirm){
            if(isConfirm){
                $.ajax({
                    url: "<?php echo base_url("dashboard/deleteSubCategory/"); ?>" + id,
                    method: 'POST',
                    dataType: 'JSON',
                    data: {id: id},
                    success: function(res){
                        if(res==true){
                            window.location.reload();
                        }else{
                            swal("Ops", "Something went wrong", "info");
                        }
                    }
                });
            }else{
                swal.close()
            }
        });
    });
</script>