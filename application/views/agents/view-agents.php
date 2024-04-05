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
<<<<<<< HEAD
                <?php if(in_array('agentReport',$rights)): ?>
                <a target="_blank" href="<?= base_url('GeneratePDF/agantReport'); ?>">
                    <button class="btn btn-danger">Agent Report</button>
                </a>
                <?php endif; if(in_array('createAgent',$rights)): ?>
=======
                <!--<a href="<?= base_url(''); ?>">-->
                <!--    <button class="btn btn-danger">Agent Report</button>-->
                <!--</a>-->
                <?php if(in_array('createAgent',$rights)): ?>
>>>>>>> a027ff1302f86992f92d7b836705f8861eb92a08
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
<<<<<<< HEAD
                <div class="table-responsive">
                    <table class="table datanew">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th>Code | Name</th>
                                <th>Team</th>
                                <th>Post</th>
                                <th>Phone</th>
                                <!--<th>Department</th>-->
                                <th class="text-center">Status</th>
                                <!--<th>Office</th>-->
                                <!--<th>City</th>-->
                                <!--<th>Joined</th>-->
                                <?php if(in_array('agentSummary',$rights)): ?>
                                    <th class="text-center">Summary</th>
                                <?php endif; if(in_array('editAgent', $rights) || in_array('deleteAgent', $rights)): ?>
                                    <th class="text-center">Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sr=1;
                            foreach($agents as $agent):
                            $status=$agent->agentStatus;
                            $agentCode=$agent->agentCode;
                            if($agentCode < 10){ $agentCode="000".$agentCode; }
                    		else if($agentCode < 100){ $agentCode="00".$agentCode; }
                    		else if($agentCode < 1000){ $agentCode="0".$agentCode; }
                    		else if($agentCode < 10000){ $agentCode=$agentCode; }
                        ?>
                            <tr <?php if($status==0){ ?> style="background:#F7E4E7;" <?php } ?>>
                                <td><?= sprintf("%02d", $sr++); ?></td>
                                <td>
                                <span <?php if($agentCode==0){ ?> class="text-danger" <?php } ?>><?php echo $agentCode; ?></span>
                                <?php
                                    echo " • ".$agent->agentName;
                                    if($status==0){ echo "<p class='text-muted' style='font-size:10px;'>Deleted</p>"; }
                                    ?></td>
                                <td>
                                    <?php echo ($agent->teamId != "") ? $agent->teamName : "<span class='text-danger'>N/A</span>"; ?>
                                </td>
                                <td><?= $agent->desigCode; ?></td>
                                <td><?= $agent->agentPhone; ?></td>
                                <!--<td><?= $agent->departName; ?></td>-->
                                <!--<td><?= $agent->officeName; ?></td>-->
                                <!--<td><?= $agent->locName; ?></td>-->
                                <!--<td><?= date('M d, Y',strtotime($agent->doj)); ?></td>-->
                                <td class="text-center">
                                    <?php if($status==1){ $val="Delete"; ?>
                                        <span class="badges bg-lightgreen">Active</span>
                                    <?php }else{ $val="Recover"; ?>
                                        <span class="badges bg-lightred">Inactive</span>
                                    <?php } ?>
                                </td>
                                <?php if(in_array('agentSummary',$rights)): ?>
                                <td class="text-center">
                                    <span style="cursor:pointer;" data-bs-toggle="offcanvas" href="#agentInfo" data-id="<?= $agent->agentId; ?>" class="agentInfo badges bg-lightyellow">View</span>
                                </td>
                                <?php endif; if(in_array('editAgent', $rights) || in_array('deleteAgent', $rights)): ?>
                                    <td class="text-center">
                                        <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <?php if(in_array('editAgent', $rights)): ?>
                                            <li>
                                                <a class="dropdown-item"><img src="<?= base_url('assets/img/icons/edit.svg'); ?>" class="me-2" alt="img">Edit Agent</a>
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
=======
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
>>>>>>> a027ff1302f86992f92d7b836705f8861eb92a08
        </div>
    </div>
</div>
<div class="offcanvas offcanvas-start" tabindex="-1" id="agentInfo" aria-labelledby="offcanvasagentInfo">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="agent_name"></h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div id="agentCanvas"></div>
        <div class="row my-3">
            <div class="col text-center">
                <div id="chartdiv2"></div>
            </div>
        </div>
    </div>
</div>
<script src="https://www.amcharts.com/lib/4/core.js"></script>
<script src="https://www.amcharts.com/lib/4/charts.js"></script>
<script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
<script>
    $('.agentInfo').click(function(){
        var id = $(this).data('id');
        $.ajax({
            url: "<?php echo base_url('agents/agentInfo/'); ?>" + id,
            method: 'POST',
            dataType: 'json',
            data: { id: id },
            success: function(res) {
                var totalBookings=res['bookings'].total_bookings;
                var activeBookings=res['bookings'].activeBookings;
                var inactiveBookings=res['bookings'].inactiveBookings;
                if(totalBookings==null){ totalBookings=0; }
                if(activeBookings==null){ activeBookings=0; }
                if(inactiveBookings==null){ inactiveBookings=0; }
                if(totalBookings<10){ totalBookings="0"+totalBookings; }
                if(activeBookings<10){ activeBookings="0"+activeBookings; }
                if(inactiveBookings<10){ inactiveBookings="0"+inactiveBookings; }
                if(activeBookings>inactiveBookings){ 
                    var icon1= "<i class='fa fa-angle-double-up text-success'></i>"; }
                else{ var icon1="<i class='fa fa-angle-double-down text-danger'></i>"; }
                // ------------------------------------------
                
                if(inactiveBookings>activeBookings){ 
                    var icon2= "<i class='fa fa-angle-double-up text-success'></i>"; }
                else{ var icon2="<i class='fa fa-angle-double-down text-danger'></i>"; }
                
                $('#agentCanvas').html('');
                $('#agent_name').text('Agent Report - ' + res['info'][0].agentCode);
                $('#agentCanvas').html(`
                    <div class="row">
                        <div class="col-12">
                            <table class="table">
                                <tr>
                                    <td>
                                        <strong>Designation</strong>
                                        <span class='text-danger' style='font-size:10px;'>(${res['info'][0].desigCode})</span>
                                    </td>
                                    <td>${res['info'][0].desigName}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Department</strong>
                                        <span class='text-danger' style='font-size:10px;'>(${res['info'][0].departCode})</span>
                                    </td>
                                    <td>${res['info'][0].departName}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <strong>Location</strong>
                                        <span class='text-danger' style='font-size:10px;'>(${res['info'][0].locCode})</span>
                                    </td>
                                    <td>${res['info'][0].locName}</td>
                                </tr>
                                <tr>
                                    <td><strong>Office Name</strong></td>
                                    <td>${res['info'][0].officeName}</td>
                                </tr>
                                <tr>
                                    <td><strong>Date of Joining</strong></td>
                                    <td>${res['info'][0].doj}</td>
                                </tr>
                            </table>
                            <table class="table text-center mt-3">
                                <tr>
                                    <th class="text-white bg-primary">Total Bookings</th>
                                    <th class="text-white bg-success">Active Bookings</th>
                                    <th class="text-white bg-danger">Inactive Bookings</th>
                                </tr>
                                <tr class="bg-light">
                                    <td>${totalBookings}</td>
                                    <td>
                                        ${icon1} 
                                        ${activeBookings}
                                    </td>
                                    <td>
                                        ${icon2} 
                                        ${inactiveBookings}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                `);
                renderPieChart(activeBookings, inactiveBookings);
            }
        });
    });
    
    function renderPieChart(activeB, inactiveB) {
        am4core.useTheme(am4themes_animated);
        var chart = am4core.create("chartdiv2", am4charts.PieChart);
        chart.data = [{
            "Title": "Active",
            "Price": activeB
        }, {
            "Title": "Inactive",
            "Price": inactiveB
        }];
        var pieSeries = chart.series.push(new am4charts.PieSeries());
        pieSeries.dataFields.value = "Price";
        pieSeries.dataFields.category = "Title";
        pieSeries.slices.template.stroke = am4core.color("#fff");
        pieSeries.slices.template.strokeWidth = 2;
        pieSeries.slices.template.strokeOpacity = 1;
        pieSeries.hiddenState.properties.opacity = 1;
        pieSeries.hiddenState.properties.endAngle = -90;
        pieSeries.hiddenState.properties.startAngle = -90;
        pieSeries.colors.list = [
            am4core.color("#008140"),  // Active slice color
            am4core.color("#F70000")  // Inactive slice color
        ];
    }
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