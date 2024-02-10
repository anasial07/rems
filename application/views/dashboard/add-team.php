<?php $role=$this->session->userdata('role'); ?>
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
                                    <input oninput="validate(event)" id="teamName" name="teamName" type="text" placeholder="Enter Team Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Select Team Lead</label>
                                <select id="teamLead" name="teamLead" class="form-control">
                                    <option selected disabled>Select TL</option>
                                    <?php foreach($agents as $teamLead): if($teamLead->designationId == 1): ?>
                                        <option value="<?= $teamLead->agentName; ?>"><?= $teamLead->agentName; ?></option>
                                    <?php endif; endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Select BDM</label>
                                <select id="bdm" name="bdm" class="form-control">
                                    <option selected disabled>Select BDM</option>
                                    <?php foreach($agents as $bdm): if($bdm->designationId == 2): ?>
                                        <option value="<?= $bdm->agentName; ?>"><?= $bdm->agentName; ?></option>
                                    <?php endif; endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Select BCM</label>
                                <select id="bcm" name="bcm" class="form-control">
                                    <option selected disabled>Select BCM</option>
                                    <?php foreach($agents as $bcm): if($bcm->designationId == 3): ?>
                                        <option value="<?= $bcm->agentName; ?>"><?= $bcm->agentName; ?></option>
                                    <?php endif; endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Select Zonal Manager</label>
                                <select id="zm" name="zm" class="form-control">
                                    <option selected disabled>Select ZM</option>
                                    <?php foreach($agents as $zm): if($zm->designationId == 4): ?>
                                        <option value="<?= $zm->agentName; ?>"><?= $zm->agentName; ?></option>
                                    <?php endif; endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Select City</label>
                                <select id="cityId" name="cityId" class="form-control">
                                    <option selected disabled>Select City</option>
                                    <?php foreach($cities as $city): ?>
                                        <option value="<?= $city->locationId; ?>"><?= $city->locName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-lg-6">
                            <div class="form-group">
                                <label>Select Office</label>
                                <select id="officeId" name="officeId" class="form-control">
                                    <option selected disabled>Select Office</option>
                                    <?php foreach($offices as $office): ?>
                                        <option value="<?= $office->officeId; ?>"><?= $office->officeName; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <a class="addTeam btn form-control btn-submit me-2">Add Team</a>
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
                        <?php 
                            $sr=1;
                            foreach($teams as $team):
                            $status=$team->teamStatus;
                        ?>
                        <tr>
                            <td><?= sprintf("%02d", $sr++); ?></td>
                            <td><?= $team->teamName; ?></td>
                            <td>
                                <?php echo ($team->locName != "") ? $team->locName : "<span class='text-danger'>N/A</span>"; ?>
                            </td>
                            <td><?= date('M d, Y', strtotime($team->createdTeam)); ?></td>
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
                                    <li data-id="<?= $team->teamId; ?>" data-bs-toggle="modal" data-bs-target="#teamDetail" class="teamDetail">
                                        <a class="dropdown-item"><img src="<?= base_url('assets/img/icons/eye1.svg'); ?>" class="me-2" alt="img">View Detail</a>
                                    </li>
                                    <?php if($role=='admin'): ?>
                                        <li>
                                            <a href="" class="dropdown-item"><img src="<?= base_url('assets/img/icons/edit.svg'); ?>" class="me-2" alt="img">Edit Team</a>
                                        </li>
                                        <li>
                                            <a href="" class="dropdown-item confirm-text"><img src="<?= base_url('assets/img/icons/delete1.svg'); ?>" class="me-2" alt="img">Delete Team</a>
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
<div class="modal fade" id="teamDetail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    Team: 
                    <span id="teamTitle"></span>
                </h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="teamInfo">

            </div>
        </div>
    </div>
</div>
<script>
    $('.teamDetail').click(function(){
        var id = $(this).data('id');
        $.ajax({
            url: "<?php echo base_url('dashboard/getTeamInfo/'); ?>" + id,
            method: 'POST',
            dataType: 'JSON',
            data: {id: id},
            success: function(res){
                $('#teamInfo').html('');
                $('#teamTitle').html(res[0].teamName);
                teamLead = res[0].teamLead != null ? res[0].teamLead : 'No Team Lead';
                bdm = res[0].bdm != null ? res[0].bdm : 'No BDM';
                bcm = res[0].bcm != null ? res[0].bcm : 'No BCM';
                zm = res[0].zm != null ? res[0].zm : 'No ZM';
                $('#teamInfo').html(`
                    <div class="row">
                        <div class="col-12">
                            <table class="table">
                                <tr>
                                    <td>Team Lead</td>
                                    <td>${teamLead}</td>
                                </tr>
                                <tr>
                                    <td>BDM</td>
                                    <td>${bdm}</td>
                                </tr>
                                <tr>
                                    <td>BCM</td>
                                    <td>${bcm}</td>
                                </tr>
                                <tr>
                                    <td>ZM</td>
                                    <td>${zm}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                `);
                $('#teamDetail').modal('show');
            }
        });
    });
	$('.addTeam').on('click', function(){
        var teamName = $('#teamName').val();
        var teamLead = $('#teamLead').val();
        var bdm = $('#bdm').val();
        var bcm = $('#bcm').val();
        var zm = $('#zm').val();
        var cityId = $('#cityId').val();
        var officeId = $('#officeId').val();
        if(teamName!=""){
            swal({
                title: "Are you sure?",
                text: "You want to add the team!",
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
                        url: "<?php echo base_url("dashboard/saveTeam"); ?>",
                        type: "POST",
                        data: {
                            teamName: teamName,
                            teamLead: teamLead,
                            bdm: bdm,
                            bcm: bcm,
                            zm: zm,
                            cityId: cityId,
                            officeId: officeId
                        },
                        cache: false,
                        success: function(dataResult){
                            if(dataResult==true){
                                swal({
                                    title: "Congratulation!", 
                                    text: "Team has been added successfully.", 
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
            swal("Sorry!", "Please fill all the team name field.", "info");
        }
	});
</script>