<style>
    .product-details{ height:90px!important; cursor: pointer; }
    .product-details img{ width:38px!important; }
</style>
<?php $rights=explode(',',$userPermissions); ?>
<div class="page-wrapper px-4 mt-4">
    <div class="row">
        <div class="page-header">
            <div class="col">
                <div class="page-title">
                    <h4>Agents List</h4>
                    <h6>Add & Manage your Agents</h6>
                </div>
            </div>
            <div class="col text-end">
                <!--<a href="<?= base_url(''); ?>">-->
                <!--    <button class="btn btn-danger">Agent Report</button>-->
                <!--</a>-->
                <?php if(in_array('createAgent',$rights)): ?>
                <a href="<?= base_url('agents/addAgent'); ?>">
                    <button class="btn btn-primary">Add New Agent</button>
                </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="row px-3">
        <div class="card">
            <div class="card-body">
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
                            <a class="btn btn-filter" id="filter_search">
                                <img src="<?= base_url('assets/img/icons/filter.svg'); ?>" alt="img">
                                <span><img src="<?= base_url('assets/img/icons/closes.svg'); ?>" alt="img"></span>
                            </a>
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset"><img src="<?= base_url('assets/img/icons/search-white.svg'); ?>" alt="img"></a>
                        </div>
                    </div>
                    <div class="wordset">
                    <ul>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="<?= base_url('assets/img/icons/printer.svg'); ?>" alt="img"></a>
                        </li>
                    </ul>
                </div>
            </div>
        <div class="table-responsive">
            <table class="table datanew">
                <thead>
                    <tr>
                        <th>Sr</th>
                        <th>Code | Name</th>
                        <th>Team</th>
                        <th>Post</th>
                        <th>Phone</th>
                        <th>Department</th>
                        <th>Office</th>
                        <th>City</th>
                        <th>Joined</th>
                        <th class="text-center">Status</th>
                        <?php if(in_array('editAgent', $rights) || in_array('deleteAgent', $rights)): ?>
                            <th class="text-center">Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sr=1;
                    foreach($agents as $agent):
                    $status=$agent->agentStatus;
                ?>
                    <tr <?php if($status==0){ ?> style="background:#F7E4E7;" <?php } ?>>
                        <td><?= sprintf("%02d", $sr++); ?></td>
                        <td><?php
                            echo $agent->agentCode." &middot; ".$agent->agentName;
                            if($status==0){ echo "<p class='text-muted' style='font-size:10px;'>Deleted</p>"; }
                            ?></td>
                        <td>
                            <?php echo ($agent->teamId != "") ? $agent->teamName : "<span class='text-danger'>N/A</span>"; ?>
                        </td>
                        <td><?= $agent->desigCode; ?></td>
                        <td><?= $agent->agentPhone; ?></td>
                        <td><?= $agent->departName; ?></td>
                        <td><?= $agent->officeName; ?></td>
                        <td><?= $agent->locName; ?></td>
                        <td><?= date('M d, Y',strtotime($agent->doj)); ?></td>
                        <td class="text-center">
                            <?php if($status==1){ $val="Delete"; ?>
                                <span class="badges bg-lightgreen">Active</span>
                            <?php }else{ $val="Recover"; ?>
                                <span class="badges bg-lightred">Inactive</span>
                            <?php } ?>
                        </td>
                        <?php if(in_array('editAgent', $rights) || in_array('deleteAgent', $rights)): ?>
                            <td class="text-center">
                                <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php if(in_array('editAgent', $rights)): ?>
                                    <li>
                                        <a href="" class="dropdown-item"><img src="<?= base_url('assets/img/icons/edit.svg'); ?>" class="me-2" alt="img">Edit Agent</a>
                                    </li>
                                    <?php endif; if(in_array('deleteAgent', $rights)): ?>
                                    <li class="delAgent" data-id="<?= $agent->agentId; ?>">
                                        <a class="dropdown-item confirm-text"><img src="<?= base_url('assets/img/icons/delete1.svg'); ?>" class="me-2" alt="img"><?= $val; ?> Agent</a>
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
<script>
    $('.delAgent').click(function(){
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
                    url: "<?php echo base_url("agents/deleteAgent/"); ?>" + id,
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