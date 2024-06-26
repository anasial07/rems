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
                    <h4>Offices</h4>
                    <h6>Create & Manage Offices</h6>
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
                        <div class="product-details active">
                            <img src="<?= base_url('assets/img/icon/office.png'); ?>" alt="img">
                            <h6>Office</h6>
                        </div>
                    </a>
                </div>
                <div class="col">
                    <a href="<?= base_url('dashboard/departments'); ?>">
                        <div class="product-details">
                            <img src="<?= base_url('assets/img/icon/department.png'); ?>" alt="img">
                            <h6>Department</h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php if(in_array('createGeolocation',$rights)): ?>
        <div class="col">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select City</label>
                                <select id="cityID" name="cityID" class="form-control officeData" required>
                                    <option selected disabled>Select City</option>
                                    <?php foreach($cities as $city): ?>
                                        <option value="<?= $city->locationId; ?>"><?= $city->locName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label>Office Name</label>
                                <div class="input-groupicon">
                                    <input class="officeData" id="officeName" name="officeName" type="text" placeholder="Enter City Name" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a id="addOffice" class="btn form-control btn-submit me-2">Add Office</a>
                        </div>
                        <div class="col">
                            <a href="javascript:history.go(-1);" class="btn form-control btn-cancel">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
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
                            <th>City</th>
                            <th>Office</th>
                            <th class="text-center">Status</th>
                            <?php if(in_array('editGeolocation', $rights) || in_array('deleteGeolocation', $rights)): ?>
                                <th class="text-center">Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sr=1;
                            foreach($offices as $office):
                            $status=$office->officeStatus;
                        ?>
                        <tr <?php if($status==0){ ?> style="background:#F7E4E7;" <?php } ?>>
                            <td><?= sprintf("%02d", $sr++); ?></td>
                            <td><?= $office->locName; ?></td>
                            <td><?php
                                echo $office->officeName;
                                if($status==0){ echo "<p class='text-muted' style='font-size:10px;'>Deleted</p>"; }
                                ?></td>
                            <td class="text-center">
                                <?php if($status==1){ ?>
                                    <span class="badges bg-lightgreen">Active</span>
                                <?php }else{ ?>
                                    <span class="badges bg-lightred">Inactive</span>
                                <?php } ?>
                            </td>
                            <?php if(in_array('editGeolocation', $rights) || in_array('deleteGeolocation', $rights)): ?>
                                <td class="text-center">
                                <?php if(in_array('editGeolocation', $rights)): ?>
                                    <a class="me-3" href="">
                                        <img src="<?= base_url('assets/img/icons/edit.svg'); ?>" alt="img">
                                    </a>
                                <?php endif; if(in_array('deleteGeolocation', $rights)): ?>
                                    <a class="me-3 confirm-text delOffice" data-id="<?= $office->officeId; ?>">
                                        <?php if($status==1){ ?>
                                            <img src="<?= base_url('assets/img/icons/delete.svg'); ?>" alt="img">
                                        <?php }else{ ?>
                                            <img src="<?= base_url('assets/img/icon/recycle.png'); ?>" width="20">
                                        <?php } ?>
                                    </a>
                                <?php endif; ?>
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
	$('#addOffice').on('click', function(){
        var cityID = $('#cityID').val();
        var officeName = $('#officeName').val();
        if(cityID!="Select Province" && officeName!=""){
            swal({
                title: "Are you sure?",
                text: "You want to add the office!",
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
                        url: "<?php echo base_url("dashboard/addOffice"); ?>",
                        type: "POST",
                        data: {
                            locationId: cityID,
                            officeName: officeName
                        },
                        cache: false,
                        success: function(dataResult){
                            if(dataResult==true){
                                swal({
                                    title: "Congratulation!", 
                                    text: "Office has been added successfully.", 
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
    $('.delOffice').click(function(){
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
                    url: "<?php echo base_url("dashboard/deleteOffice/"); ?>" + id,
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