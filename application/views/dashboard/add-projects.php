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
                    <h4>Projects</h4>
                    <h6>Create & Manage Projects</h6>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col">
                    <a href="<?= base_url('dashboard/addProject'); ?>">
                        <div class="product-details active">
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
        <div class="col-6">
            <div class="card mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label>Project Code</label>
                                <div class="input-groupicon">
                                    <input oninput="validate(event)" class="projectData" name="projCode" id="projectCode" type="text" placeholder="Enter Project Code">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label>Project Name</label>
                                <div class="input-groupicon">
                                    <input oninput="validateSpecial(event)" class="projectData" name="projName" id="projectName" type="text" placeholder="Enter Project Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-6">
                            <div class="form-group">
                                <label>Select Location</label>
                                <select name="projLocation" id="projectCity" class="form-control projectData">
                                    <option selected disabled>Select Location</option>
                                    <?php foreach($cities as $city): ?>
                                        <option value="<?= $city->locationId; ?>"><?= $city->locName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group">
                                <label>Project Area</label>
                                <div class="input-groupicon">
                                    <input oninput="validateNmbr(event)" class="projectData" name="projArea" id="projectArea" type="text" placeholder="Project Area">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group">
                                <label>Base Price</label>
                                <div class="input-groupicon">
                                    <input oninput="validateNmbr(event)" class="projectData" name="projBasePrice" id="basePrice" type="text" placeholder="0.0">
                                    <div class="addonset">
                                        <img src="<?= base_url('assets/img/icon/rs.png'); ?>" alt="img" width="21">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="page-header">
                                <div class="page-title">
                                    <h6>Setup Details for Letterhead Excellence</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label>Website Address</label>
                                <div class="input-groupicon">
                                    <input class="projectData" name="webAddress" id="webAddress" type="text" placeholder="eg: www.ahgroup-pk.com">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label>E-mail Address</label>
                                <div class="input-groupicon">
                                    <input class="projectData" name="mailAddress" id="mailAddress" type="text" placeholder="eg: info@ahgroup-pk.com">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group">
                                <label>Complete Address</label>
                                <div class="input-groupicon">
                                    <input class="projectData" name="projAddress" id="projAddress" type="text" placeholder="Project Address">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-12">
                            <div class="form-group" style="padding:0 4% 0 4%;">
                                <input type="file" name="projLogo" id="projLogo" onchange="selected()" style="display:none;">
                                <label>Project Logo</label>
                                <label for="projLogo">
                                    <div class="row" style="height:40px!important; border:1px solid #DCE0E4; border-radius:5px; cursor:pointer;">
                                        <div class="col pt-2 text-muted">
                                            <span id="logoSel">Browse an image to upload</span>
                                        </div>
                                        <div class="col-3 text-end">
                                            <img id="logoCloud" src="<?= base_url('assets/img/icons/upload.svg'); ?>" width="36" alt="img">
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <input type="hidden" id="baseUrl" value="<?= base_url(); ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <a class="btn form-control btn-submit me-2" id="addProject">Add Project</a>
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
                                <th>Name</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $sr=1;
                                foreach($projects as $project):
                                    $status=$project->projStatus;
                                    $deprc=$project->depreciation;
                            ?>
                            <tr>
                                <td><?= sprintf("%02d", $sr++); ?></td>
                                <td><?= $project->projCode; ?></td>
                                <td><?= $project->projName; ?></td>
                                <td class="text-center">
                                    <?php if($status==1){ ?>
                                        <span class="badges bg-lightgreen">Active</span>
                                    <?php }else{ ?>
                                        <span class="badges bg-lightred">Inactive</span>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li data-id="<?= $project->projectId; ?>" class="viewProject" data-bs-toggle="modal" data-bs-target="#projectDetail">
                                            <a class="dropdown-item"><img src="<?= base_url('assets/img/icons/eye1.svg'); ?>" class="me-2" alt="img">View Detail</a>
                                        </li>
                                        <?php if($role=='admin'): ?>
                                            <li>
                                                <a href="" class="dropdown-item"><img src="<?= base_url('assets/img/icons/edit.svg'); ?>" class="me-2" alt="img">Edit Project</a>
                                            </li>
                                            <li>
                                                <a href="" class="dropdown-item confirm-text"><img src="<?= base_url('assets/img/icons/delete1.svg'); ?>" class="me-2" alt="img">Delete Project</a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="projectDetail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modelTitle"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="modalBody">

            </div>
        </div>
    </div>
</div>
<script>
    $('#addProject').on('click', function () {
        var projectCode = $('#projectCode').val();
        var projectName = $('#projectName').val();
        var projectCity = $('#projectCity').val();
        var projectArea = $('#projectArea').val();
        var basePrice = $('#basePrice').val();
        var webAddress = $('#webAddress').val();
        var mailAddress = $('#mailAddress').val();
        var projAddress = $('#projAddress').val();
        var projLogo = $('#projLogo')[0].files[0];

        if (projectCode !== "" && projectName !== "" && projectCity !== "Select Location" &&
            projectArea !== "" && basePrice !== "" && webAddress !== "" && mailAddress !== "" && projAddress !== "") {

            swal({
                title: "Are you sure?",
                text: "You want to add the project!",
                type: "info",
                showCancelButton: true,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Yes, add it!",
                cancelButtonClass: "btn-primary",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                function (isConfirm) {
                    if (isConfirm) {
                        var formData = new FormData();
                        formData.append('projCode', projectCode);
                        formData.append('projName', projectName);
                        formData.append('projLocation', projectCity);
                        formData.append('projArea', projectArea);
                        formData.append('projBasePrice', basePrice);
                        formData.append('webAddress', webAddress);
                        formData.append('mailAddress', mailAddress);
                        formData.append('projAddress', projAddress);
                        formData.append('projLogo', projLogo);
                        $.ajax({
                            url: "<?php echo base_url('dashboard/saveProject'); ?>",
                            type: "POST",
                            data: formData,
                            processData: false,
                            contentType: false,
                            cache: false,
                            success: function (dataResult) {
                                if (dataResult == true) {
                                    swal({
                                        title: "Congratulations!",
                                        text: "Project has been added successfully.",
                                        type: "success"
                                    },
                                        function () {
                                            location.reload();
                                        }
                                    );
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
            swal("Sorry!", "Please fill all the fields.", "info");
        }
    });
    function selected(){
        var logo=document.getElementById('projLogo');
        var baseUrl=document.getElementById('baseUrl').value;
        if(logo.files.length>0){
            document.getElementById('logoSel').innerHTML="<span class='text-success'>Image selected</span> | <span class='text-danger'>Browse</span></span>";
            document.getElementById('logoCloud').src=baseUrl+"/assets/img/icon/check.png";
        }
    }
    $('.viewProject').click(function(){
        var projId = $(this).data('id');
        const imgUrl = '<?=base_url();?>';
        $.ajax({
            url: "<?php echo base_url("dashboard/projectDetail/"); ?>" + projId,
            method: 'POST',
            dataType: 'JSON',
            data: {projId: projId},
            success: function(res){
                $('#modalBody').html('');
                $('#modelTitle').html(res[0].projName);
                $('#modalBody').html(`
                    <div class="row">
                        <div class="col-5">
                            <table class="table">
                                <tr>
                                    <td>Project Code</td>
                                    <td>${res[0].projCode}</td>
                                </tr>
                                <tr>
                                    <td>Location</td>
                                    <td>${res[0].locName}</td>
                                </tr>
                                <tr>
                                    <td>Project Area</td>
                                    <td>${res[0].projArea}</td>
                                </tr>
                                <tr>
                                    <td>Base Price</td>
                                    <td>${new Intl.NumberFormat().format(res[0].projBasePrice)}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-2"></div>
                        <div class="col">
                            <div class="row">
                                <div class="col-12">
                                    <img src="${imgUrl}uploads/letterHead/${res[0].projLogo}">
                                </div>
                                <div class="col-12 text-start mt-4">
                                    <p><i class="fa fa-map-marker"></i>&emsp;${res[0].projAddress}</p>
                                    <p><i class="fa fa-globe"></i>&emsp;${res[0].webAddress}</p>
                                    <p><i class="fa fa-envelope"></i>&emsp;${res[0].mailAddress}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                `);
                $('#projectDetail').modal('show');
            }
        });
    });
</script>