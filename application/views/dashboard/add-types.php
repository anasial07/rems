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
                    <h4>Types</h4>
                    <h6>Create & Manage Types</h6>
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
                        <div class="product-details">
                            <img src="<?= base_url('assets/img/icon/sub-type.png'); ?>" alt="img">
                            <h6>Sub-Categ...</h6>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="<?= base_url('dashboard/addTypes'); ?>">
                        <div class="product-details active">
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
                                <select id="projID" name="projID" class="form-control">
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
                                <select id="catId" name="catId" class="form-control catName">
                                    <option selected disabled>Select Category</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Sub-Category</label>
                                <select id="subCatId" name="subCatId" class="form-control">
                                    <option selected disabled>Select Sub-Category</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label>Type Name</label>
                                <div class="input-groupicon">
                                    <input id="typeName" name="typeName" type="text" placeholder="Enter Type Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label>Marla Size</label>
                                <div class="input-groupicon">
                                    <input id="typeSize" name="typeSize" class="typeSize" type="text" placeholder="5, 8, 11 etc...">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label>Total Price</label>
                                <div class="input-groupicon">
                                    <input disabled class="text-danger" name="totalPrice" id="totalPrice" type="text" placeholder="0.0">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icon/rs.png'); ?>" alt="img" width="22">
                                    </div>
                                </div>
                                <p style="font-size:10px;" class="text-muted mt-1">This field cannot be edited.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label>Discount <span style="font-size:12px;" class="text-muted">(Optional)</span></label>
                                <div class="input-groupicon">
                                    <input name="typeDiscount" id="typeDiscount" type="text" placeholder="0.0">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icon/percent.png'); ?>" alt="img" width="18">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <a class="btn form-control btn-submit me-2" id="addType">Add Type</a>
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
                            <tr class="text-center">
                                <th class="text-start">Project</th>
                                <th class="text-start">Type Name</th>
                                <th>Size</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Status</th>
                                <?php if($role=='admin'): ?>
                                    <th>Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($types as $type):
                                    $status=$type->typeStatus;
                            ?>
                            <tr class="text-center">
                                <td class="text-start"><?= $type->projCode; ?></td>
                                <td class="text-start"><?= $type->typeName; ?></td>
                                <td><?= $type->marlaSize; ?> Marla</td>
                                <td><?= number_format($type->discountedPrice); ?></td>
                                <td class="text-danger"><?= $type->discount; ?>%</td>
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
                                            <a href="" class="dropdown-item"><img src="<?= base_url('assets/img/icons/edit.svg'); ?>" class="me-2" alt="img">Edit Type</a>
                                        </li>
                                        <li>
                                            <a href="" class="dropdown-item confirm-text"><img src="<?= base_url('assets/img/icons/delete1.svg'); ?>" class="me-2" alt="img">Delete Type</a>
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
    $('#projID').change(function(){
        var projID = $(this).val();
        $.ajax({
            url: "<?php echo base_url('dashboard/getCats/'); ?>" + projID,
            method: 'POST',
            dataType: 'json',
            data: {projID: projID},
            success: function(res){
                $('.catName').find('option').not(':first').remove();
                $.each(res, function(index, data){
                    $('.catName').append('<option value="' + data.catId + '">' + data.catName + '</option>');
                });
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText);
            }
        });
    });
    $('#catId').change(function(){
        var catId = $(this).val();
        $.ajax({
            url: "<?php echo base_url('dashboard/getSubCats/'); ?>" + catId,
            method: 'POST',
            dataType: 'json',
            data: {catId: catId},
            success: function(res){
                $('#subCatId').find('option').not(':first').remove();
                $.each(res, function(index, data){
                    $('#subCatId').append('<option value="' + data['subCatId'] + '">' + data['subCatName'] + '</option>');
                });
            }
        });
    });
    $('#typeSize').keyup(calculatePrice);
    $('#projID').change(calculatePrice);
    function calculatePrice(){
        var projId = $('#projID').val();
        var typeSize = $('#typeSize').val();
        if(typeSize != "" && projId != "Select Project"){
            $.ajax({
                url: "<?php echo base_url('dashboard/calculatePrice/'); ?>" + projId,
                method: 'POST',
                dataType: 'JSON',
                data: { projectId: projId },
                success: function(res){
                    var finalPrice= 0;
                    var basePrice = res.projBasePrice;
                    var depreciation = res.depreciation;

                    if(typeSize < 6){
                        finalPrice=basePrice*typeSize;
                    }else{
                        finalPrice = "Pending";
                    }

                    // var finalPrice = (depreciation - (basePrice * (basePrice / 100))) * typeSize;
                    $('#totalPrice').val(finalPrice.toLocaleString());
                }
            });
        }
    }
    $('#addType').on('click', function () {
        var projID = $('#projID').val();
        var catId = $('#catId').val();
        var subCatId = $('#subCatId').val();
        var typeName = $('#typeName').val();
        var typeSize = $('#typeSize').val();
        var totalPrice = $('#totalPrice').val();
        var typeDiscount = $('#typeDiscount').val();

        if (projID != "Select Project" && catId != "Select Category" && subCatId != "Select Sub-Category" && typeName != "" && typeSize!="") {
            swal({
                title: "Are you sure?",
                text: "You want to add the type!",
                type: "info",
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Yes, add it!",
                cancelButtonClass: "btn-primary",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "<?php echo base_url('dashboard/addType'); ?>",
                        type: "POST",
                        data: {
                            projectId: projID,
                            catId: catId,
                            subCatId: subCatId,
                            typeName: typeName,
                            marlaSize: typeSize,
                            totalPrice: totalPrice,
                            discount: typeDiscount
                        },
                        cache: false,
                        success: function (dataResult) {
                            if (dataResult) {
                                swal({
                                    title: "Congratulation!",
                                    text: "Type has been added successfully.",
                                    type: "success"
                                }, function(){
                                    location.reload();
                                });
                            }else{
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