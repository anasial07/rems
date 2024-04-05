<style>
    .product-details{ height:90px!important; cursor: pointer; }
    .product-details img{ width:38px!important; }
    .modalTable tr td{ line-height:1!important; }
    .checked{ color: orange; }
    .marginTop > p{ margin-top:-13px!important; }
    .offcanvas-fullscreen {
        width: 100%;
        height: 70%;
    }
</style>
<?php $rights=explode(',',$userPermissions); ?>
<div class="page-wrapper px-4 mt-4">
<<<<<<< HEAD
    <div class="row">
        <div class="page-header">
            <div class="col">
                <div class="page-title">
                    <h4>Customer List</h4>
                    <h6>Add & Manage your Customers</h6>
                </div>
            </div>
            <div class="col text-end">
                <button data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom" class="btn btn-success"><i class="fa fa-bar-chart"></i> Graph</button>
                <?php if(in_array('createCustomer',$rights)): ?>
                <a href="<?= base_url('customers/addCustomer'); ?>">
                    <button class="btn btn-primary">Add New Customer</button>
                </a>
                <?php endif; ?>
            </div>
=======
    <div class="page-header">
        <div class="page-title">
            <h4>Customer List</h4>
            <h6>Add & Manage your Customers</h6>
        </div>
        <?php if(in_array('createCustomer',$rights)): ?>
        <div class="page-btn">
            <a href="<?= base_url('customers/addCustomer'); ?>" class="btn btn-added"><img src="<?= base_url('assets/img/icons/plus.svg') ?>" alt="img">Add New Customer</a>
>>>>>>> a027ff1302f86992f92d7b836705f8861eb92a08
        </div>
        <?php endif; ?>
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
                            <!--<a href="<?= base_url('customers/export_to_excel'); ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Export Excel Sheet"><img src="<?= base_url('assets/img/icon/excel.svg'); ?>" alt="img"></a>-->
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
                                <th>Profile | Name</th>
                                <th>CNIC</th>
                                <th>City</th>
                                <th>Bookings</th>
                                <th>Employee?</th>
                                <th class="text-center">Status</th>
                                <?php if(in_array('editCustomer', $rights) || in_array('deleteCustomer', $rights)): ?>
                                <th class="text-center">Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $sr=0;
                            $totalActive=0;
                            $totalEmp=0;
                            $totalMale=0;
                            foreach($customers as $customer):
                            $sr++;
                            $status=$customer->custmStatus;
                            $totalEmp+=$customer->isEmployee;
                            $totalMale+=$customer->custmGender;
                            $totalActive+=$status;
                            $totalInactive=$sr-$totalActive;
                            $totalCustm=$sr-$totalEmp;
                            $totalFemale=$sr-$totalMale;
                        ?>
                            <tr <?php if($status==0){ ?> style="background:#F7E4E7;" <?php } ?>>
                                <td>
                                    <?php
                                        echo sprintf("%02d", $sr)."&emsp;&emsp;";
                                        if($customer->custmGender==1){ echo "<i class='fa fa-mars text-danger'></i>"; }
                                        else{ echo "<i class='fa fa-venus text-primary'></i>"; }
                                    ?>
                                </td>
                                <td data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $customer->custmName; ?>" data-id="<?= $customer->customerId; ?>" data-bs-toggle="modal" data-bs-target="#customerDetail" class="productimgname customerInfo">
                                    <a href="javascript:void(0);">
                                        <img width="30" src="<?= base_url('uploads/customers/').$customer->custmPic; ?>" alt="" style="border-radius:5px;">
                                    </a>
                                    <a class="text-primary" href="javascript:void(0);">
                                        <?php
                                            echo mb_strimwidth($customer->custmName, 0, 12, "...");
                                            if($status==0){ echo "<p class='text-muted' style='font-size:10px;'>Deleted</p>"; }
                                        ?>
                                    </a>
                                </td>
                                <td><?= $customer->custmCNIC; ?></td>
                                <td><?= $customer->locName; ?></td>
                                <td>
                                    <?php
                                        $totalBookings=$data['totalBookings'] = $this->booking_model->totalBookings($customer->customerId);
                                    ?>
                                    <span <?php if($totalBookings==0){ ?> class="text-danger" <?php } ?>>
                                        <?php
                                            echo sprintf('%02d',$totalBookings);
                                            if($totalBookings>3){ echo "&emsp;<span class='fa fa-star checked'></span>"; }
                                        ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if($customer->isEmployee==1): ?>
                                        <i class="text-success fa fa-check-circle"></i>&nbsp;
                                        <span class="text-success">Yes</span>
                                    <?php else: ?>
                                        <i class="text-danger fa fa-times-circle"></i>&nbsp;
                                        <span class="text-danger">No</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <?php if($status==1){ $val="Delete"; ?>
                                        <span class="badges bg-lightgreen">Active</span>
                                    <?php }else{ $val="Recover"; ?>
                                        <span class="badges bg-lightred">Inactive</span>
                                    <?php } ?>
                                </td>
                                <?php if(in_array('editCustomer', $rights) || in_array('deleteCustomer', $rights)): ?>
                                <td class="text-center">
                                    <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="customerInfo" data-id="<?= $customer->customerId; ?>" data-bs-toggle="modal" data-bs-target="#customerDetail">
                                            <a class="dropdown-item"><img src="<?= base_url('assets/img/icons/eye1.svg'); ?>" class="me-2" alt="img">View Detail</a>
                                        </li>
                                        <?php if(in_array('editCustomer', $rights)): ?>
                                            <li>
                                                <a href="" class="dropdown-item"><img src="<?= base_url('assets/img/icons/edit.svg'); ?>" class="me-2" alt="img">Edit Customer</a>
                                            </li>
                                        <?php endif; if(in_array('deleteCustomer', $rights)): ?>
                                            <li class="delCustomer" data-id="<?= $customer->customerId; ?>">
                                                <a class="dropdown-item confirm-text"><img src="<?= base_url('assets/img/icons/delete1.svg'); ?>" class="me-2" alt="img"><?= $val; ?> Customer</a>
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
                        <th>Image | Name</th>
                        <th>CNIC</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th class="text-center">Employee?</th>
                        <th class="text-center">Status</th>
                        <?php if(in_array('editCustomer', $rights) || in_array('deleteCustomer', $rights)): ?>
                        <th class="text-center">Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sr=1;
                    foreach($customers as $customer):
                    $status=$customer->custmStatus;
                ?>
                    <tr <?php if($status==0){ ?> style="background:#F7E4E7;" <?php } ?>>
                        <td><?= sprintf("%02d", $sr++); ?></td>
                        <td data-id="<?= $customer->customerId; ?>" data-bs-toggle="modal" data-bs-target="#customerDetail" class="productimgname customerInfo">
                            <a href="javascript:void(0);">
                                <img width="30" src="<?= base_url('uploads/customers/').$customer->custmPic; ?>" alt="" style="border-radius:5px;">
                            </a>
                            <a href="javascript:void(0);">
                                <?php
                                    echo $customer->custmName;
                                    if($status==0){ echo "<p class='text-muted' style='font-size:10px;'>Deleted</p>"; }
                                ?>
                            </a>
                        </td>
                        <td><?= $customer->custmCNIC; ?></td>
                        <td><?= $customer->primaryPhone; ?></td>
                        <td><?= $customer->locName; ?></td>
                        <td class="text-success text-center">
                            <?php if($customer->isEmployee=='1'): ?>
                                <span class="text-success">Yes</span>
                            <?php else: ?>
                                <span class="text-danger">No</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <?php if($status==1){ $val="Delete"; ?>
                                <span class="badges bg-lightgreen">Active</span>
                            <?php }else{ $val="Recover"; ?>
                                <span class="badges bg-lightred">Inactive</span>
                            <?php } ?>
                        </td>
                        <?php if(in_array('editCustomer', $rights) || in_array('deleteCustomer', $rights)): ?>
                        <td class="text-center">
                            <a class="action-set" href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="customerInfo" data-id="<?= $customer->customerId; ?>" data-bs-toggle="modal" data-bs-target="#customerDetail">
                                    <a class="dropdown-item"><img src="<?= base_url('assets/img/icons/eye1.svg'); ?>" class="me-2" alt="img">View Detail</a>
                                </li>
                                <?php if(in_array('editCustomer', $rights)): ?>
                                    <li>
                                        <a href="" class="dropdown-item"><img src="<?= base_url('assets/img/icons/edit.svg'); ?>" class="me-2" alt="img">Edit Customer</a>
                                    </li>
                                <?php endif; if(in_array('deleteCustomer', $rights)): ?>
                                    <li class="delCustomer" data-id="<?= $customer->customerId; ?>">
                                        <a class="dropdown-item confirm-text"><img src="<?= base_url('assets/img/icons/delete1.svg'); ?>" class="me-2" alt="img"><?= $val; ?> Customer</a>
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
<!--Graph Modal-->
<div class="offcanvas offcanvas-bottom offcanvas-fullscreen" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
    <div class="offcanvas-body">
        <div class="row">
            <div class="col text-center">
                <div id="customerChart" style="height:400px; width:600px;"></div>
            </div>
            <div class="col">
                <button type="button" class="btn-close float-end m-2" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                <div class="row text-start text-muted" style="margin-top:15%;">
                    <div class="col-4 marginTop">
                        <p>Total Records</p>
                        <p>Employee</p>
                        <p>Customer</p>
                        <p>Male</p>
                        <p>Female</p>
                        <p>Active</p>
                        <p>Inactive</p>
                    </div>
                    <div class="col-1 marginTop">
                        <p><i class="fas fa-align-center"></i></p>
                        <p><i class="fas fa-user-check"></i></p>
                        <p><i class="fas fa-user-tie"></i></p>
                        <p><i class="fa fa-mars"></i></p>
                        <p><i class="fa fa-venus"></i></p>
                        <p><i class="fa fa-check"></i></p>
                        <p><i class="fa fa-trash-o"></i></p>
                    </div>
                    <div class="col marginTop">
                        <p><?= sprintf('%02d',number_format($sr)); ?></p>
                        <p><?= sprintf('%02d',number_format($totalEmp)); ?></p>
                        <p><?= sprintf('%02d',number_format($totalCustm)); ?></p>
                        <p><?= sprintf('%02d',number_format($totalMale)); ?></p>
                        <p><?= sprintf('%02d',number_format($totalFemale)); ?></p>
                        <p><?= sprintf('%02d',number_format($totalActive)); ?></p>
                        <p><?= sprintf('%02d',number_format($totalInactive)); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Customer Details Modal-->
<input type="hidden" value="<?= base_url(); ?>" id="base_url">
<div class="modal fade" id="customerDetail" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">&nbsp;&nbsp;Customer Information</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body" id="modalArea">

            </div>
        </div>
    </div>
</div>

<script>
    $('.customerInfo').click(function(){
        var id = $(this).data('id');
        const imgUrl = '<?=base_url();?>';
        $.ajax({
            url: "<?php echo base_url("customers/customerInfo/"); ?>" + id,
            method: 'POST',
            dataType: 'JSON',
            data: {id: id},
            success: function(res){
                $('#modalArea').html('');
                allFiles(id);
                let empStatus = '';
                var custmStatus = '';
                if(res[0].isEmployee == "1"){
                    empStatus += '<span class="text-success">Employee</span>';
                }else{
                    empStatus += '<span class="text-danger">Customer</span>';
                }
                if(res[0].custmStatus == "1"){
                    custmStatus += '<span class="text-success">Active</span>';
                }else{
                    custmStatus += '<span class="text-danger">In Active</span>';
                }
                var empGender = (res[0].custmGender==1) ? 'Male' : 'Female';
                if(res[0].custmDOB!=null){
                    var custmDOB=res[0].custmDOB;
                }else{
                    var custmDOB=""
                }
                $('#modalArea').html(`
                    <div class="row">
                        <div class="col-9">
                            <table class="table modalTable">
                                <tr>
                                    <td>Customer Name</td>
                                    <td>${res[0].custmName} (${empStatus})</td>
                                </tr>
                                <tr>
                                    <td>Father's Name</td>
                                    <td>${res[0].fatherName}</td>
                                </tr>
                                <tr>
                                    <td>Customer CNIC</td>
                                    <td>${res[0].custmCNIC}</td>
                                </tr>
                                <tr>
                                    <td>Primary Contact</td>
                                    <td>${res[0].primaryPhone}</td>
                                </tr>
                                <tr>
                                    <td>Secondary Contact</td>
                                    <td>${res[0].secondaryPhone}</td>
                                </tr>
                                <tr>
                                    <td>Customer Email</td>
                                    <td>${res[0].custmEmail}</td>
                                </tr>
                                <tr>
                                    <td>Customer DOB</td>
                                    <td>${custmDOB}</td>
                                </tr>
                                <tr>
                                    <td>Customer Gender</td>
                                    <td>${empGender}</td>
                                </tr>
                                <tr>
                                    <td>Customer City</td>
                                    <td>${res[0].locName}</td>
                                </tr>
                                <tr>
                                    <td>Present Address</td>
                                    <td>${res[0].presentAddress}</td>
                                </tr>
                                <tr>
                                    <td>Permanent Address</td>
                                    <td>${res[0].permanentAddress}</td>
                                </tr>
                                <tr>
                                    <td>NOK Name</td>
                                    <td>${res[0].nokName}</td>
                                </tr>
                                <tr>
                                    <td>NOK CNIC</td>
                                    <td>${res[0].nokCNIC}</td>
                                </tr>
                                <tr>
                                    <td>NOK Contact</td>
                                    <td>${res[0].nokPhone}</td>
                                </tr>
                                <tr>
                                    <td>NOK Email</td>
                                    <td>${res[0].nokEmail}</td>
                                </tr>
                                <tr>
                                    <td>Relation</td>
                                    <td>${res[0].nokRelation}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-3">
                            <img src="${imgUrl}uploads/customers/${res[0].custmPic}" style="height:160px!important; width:160px!important; border-radius:10px;">
                            <span>Customer Status: ${custmStatus}</span>
                            <div class="row mb-4" id="custmAllFiles"></div>
                        </div>
                    </div>
                    ${res[0].custmStatus == "0" ? 
                        `<div class="row">
                            <div class="col-12 text-center">
                                <div class="alert alert-warning fade show mt-3" role="alert">
                                    The status of this customer is currently <strong>inactive</strong>. If you wish to activate the status, please contact the admin.
                                </div>
                            </div>
                        </div>` : '' }
                `);
                $('#customerDetail').modal('show');
            }
        });
    });
    function allFiles(id){
        $.ajax({
            url: "<?php echo base_url("booking/customerBookings/"); ?>" + id,
            method: 'POST',
            dataType: 'JSON',
            data: {id: id},
            success: function(res) {
                var base_url=$('#base_url').val();
                $('#custmAllFiles').html('');
                if (res && res.length > 0) {
                    var content = `<div class="col-12 mt-4">${res.length.toString().padStart(2, '0')} Booking(s) available<br>`;
                    $.each(res, function(index, data) {
                        var bookingID = data.bookingId.toString(10, 36);
                        content += `<span class="text-muted">${data.membershipNo}</span><br>`;
                    });
                    content += '</div>';
                    $('#custmAllFiles').append(content);
                } else {
                    var content = '<div class="col-12 text-danger mt-4">No Booking available yet!</div>';
                    $('#custmAllFiles').append(content);
                }
            }
        });
    }
    $('.delCustomer').click(function(){
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
                    url: "<?php echo base_url("customers/deleteCustomer/"); ?>" + id,
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

<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<input type="hidden" id="totalRec" value="<?= $sr; ?>">
<input type="hidden" id="totalEmp" value="<?= $totalEmp; ?>">
<input type="hidden" id="totalCustm" value="<?= $totalCustm; ?>">
<input type="hidden" id="totalMale" value="<?= $totalMale; ?>">
<input type="hidden" id="totalFemale" value="<?= $totalFemale; ?>">
<input type="hidden" id="totalActive" value="<?= $totalActive; ?>">
<input type="hidden" id="totalInactive" value="<?= $totalInactive; ?>">
<script>
    var totalRec=document.getElementById("totalRec").value;
    var totalEmp=document.getElementById("totalEmp").value;
    var totalCustm=document.getElementById("totalCustm").value;
    var totalMale=document.getElementById("totalMale").value;
    var totalFemale=document.getElementById("totalFemale").value;
    var totalActive=document.getElementById("totalActive").value;
    var totalInactive=document.getElementById("totalInactive").value;
    am5.ready(function(){
        var root = am5.Root.new("customerChart");
        root.setThemes([
          am5themes_Animated.new(root)
        ]);
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
          panX: false,
          panY: false,
          wheelX: "panX",
          wheelY: "zoomX",
          paddingLeft: 0,
          layout: root.verticalLayout
        }));
        
        var colors = chart.get("colors");
        var data = [
            {
                country: "Total", visits: parseInt(totalRec),
                columnSettings: { fill: colors.next() }
            }, {
                country: "Employee", visits: parseInt(totalEmp),
                columnSettings: { fill: colors.next() }
            }, { 
                country: "Customer", visits: parseInt(totalCustm),
                columnSettings: { fill: colors.next() }
            }, { 
                country: "Male", visits: parseInt(totalMale),
                columnSettings: { fill: colors.next() }
            }, { 
                country: "Female", visits: parseInt(totalFemale),
                columnSettings: { fill: colors.next() }
            }, { 
                country: "Active", visits: parseInt(totalActive),
                columnSettings: { fill: "#28C76F" }
            }, { 
                country: "Inactive", visits: parseInt(totalInactive),
                columnSettings: { fill: "#ff0000" }
            }
        ];
        var xRenderer = am5xy.AxisRendererX.new(root, {
          minGridDistance: 30,
          minorGridEnabled: true
        })
        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
          categoryField: "country",
          renderer: xRenderer,
          bullet: function (root, axis, dataItem) {
            return am5xy.AxisBullet.new(root, {
              location: 0.5,
              sprite: am5.Picture.new(root, {
                width: 24,
                height: 24,
                centerY: am5.p50,
                centerX: am5.p50,
                src: dataItem.dataContext.icon
              })
            });
          }
        }));
        xRenderer.grid.template.setAll({ location: 1 })
        xRenderer.labels.template.setAll({ paddingTop: 20 });
        xAxis.data.setAll(data);
        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
          renderer: am5xy.AxisRendererY.new(root, {
            strokeOpacity: 0.1
          })
        }));
        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
          xAxis: xAxis,
          yAxis: yAxis,
          valueYField: "visits",
          categoryXField: "country"
        }));
        series.columns.template.setAll({
          tooltipText: "{categoryX}: {valueY}",
          tooltipY: 0,
          strokeOpacity: 0,
          templateField: "columnSettings"
        });
        series.data.setAll(data);
        series.appear();
        chart.appear(1000, 100);
    });
</script>