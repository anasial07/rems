<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<style>
    .widget {
        border-radius: 0.75rem;
        background-color: #fff;
        padding: 1rem;
    }
    .widget canvas {
        min-height: 20.3rem;
    }
</style>
<<<<<<< HEAD
<?php
    function formatAmount($amount){
        if($amount >= 1000000000){
            return round($amount / 1000000000, 2).'B';
        }elseif($amount >= 1000000){
            return round($amount / 1000000, 2).'M';
        }elseif($amount >= 1000){
            return round($amount / 1000, 2).'K';
        }else{
            return $amount;
        }
    }
    $dashBooking_total = formatAmount($bookingAmount);
    $dashInst_total = formatAmount($installAmount);
?>
=======
>>>>>>> a027ff1302f86992f92d7b836705f8861eb92a08
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget">
                    <div class="dash-widgetimg">
                        <span><img src="<?= base_url('assets/img/icons/dash1.svg'); ?>" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters"><?= $dashBooking_total; ?></span></h5>
                        <h6>Booking Amount</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash1">
                    <div class="dash-widgetimg">
                        <span><img src="<?= base_url('assets/img/icons/dash2.svg'); ?>" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters"><?= $dashInst_total; ?></span></h5>
                        <h6>Instal... Amount</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash2">
                    <div class="dash-widgetimg">
                        <span><img src="<?= base_url('assets/img/icons/dash3.svg'); ?>" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters">00</span></h5>
                        <h6>Total Rebate</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash3">
                    <div class="dash-widgetimg">
                        <span><img src="<?= base_url('assets/img/icons/dash4.svg'); ?>" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters">00</span></h5>
                        <h6>Total Sale Amount</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count">
                    <div class="dash-counts">
                        <h4><?= sprintf('%02d', number_format($totalCustomers)); ?></h4>
                        <h5>Customers</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="user"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das1">
                    <div class="dash-counts">
                        <h4><?= sprintf('%02d', number_format($totalAgents)); ?></h4>
                        <h5>Agents</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="user-check"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das2">
                    <div class="dash-counts">
                        <h4><?= sprintf('%02d', number_format($totalBookings)); ?></h4>
                        <h5>Bookings</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="file-text"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12 d-flex">
                <div class="dash-count das3">
                    <div class="dash-counts">
                        <h4><?= sprintf('%02d', number_format($totalTeams)); ?></h4>
                        <h5>Teams</h5>
                    </div>
                    <div class="dash-imgs">
                        <i data-feather="file"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9 col-md-7 col-sm-12 mb-2">
                <div class="widget">
                    <?php
                    $instMonths="";
                    $instSum="";
                    foreach ($month_year as $values) {
                        $instMonths.=$values['month_year'].",";
                        $instSum.=$values['total_amount'] .",";
                    }
                    ?>
                    <input id="instMonths" type="hidden" value="<?= $instMonths; ?>">
                    <input id="instSum" type="hidden" value="<?= $instSum; ?>">
                    <canvas id="dashInstChart"></canvas>
                </div>
            </div>
            <div class="col-lg-3 col-md-5 col-sm-12">
                <?php foreach($recentBookings as $recent): ?>
                <div class="card m-0 mb-1">
                    <div class="card-body py-2">
                        <strong><?= $recent->membershipNo; ?></strong>
                        <p class="text-muted" style="font-size:10px;">
                            <?= date('d M, Y - l',strtotime($recent->purchaseDate)); ?>
                            <label class="float-end text-danger"><?= $recent->locCode; ?></label>
                        </p>
<<<<<<< HEAD
                        <p class="text-muted" style="font-size:10px; margin-top:-21px;">Added by: <span class="text-primary"><?= ucwords($recent->userName); ?></span></p>
=======
                        <p class="text-muted" style="font-size:10px; margin-top:-21px;">Added by: <span class="text-primary"><?= $recent->userName; ?></span></p>
>>>>>>> a027ff1302f86992f92d7b836705f8861eb92a08
                    </div>
                </div>
                <?php endforeach; ?>
                <div class="card m-0 mb-1 py-2 text-white" style="background:#FF9F43;">
                    <div class="card-body py-2">
                        <strong>Recently Added Bookings</strong>
                        <p style="margin-top:-6px; font-size:11px;">See the newest bookings here</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-3 p-3 bg-white rounded" style="border:1px solid #EBEBEB;">
            <div class="row">
                <div class="col">
                    <h4>Have a nice day! <span style="font-weight: bold; color:#FE9F43;"><?= $this->session->userdata('username'); ?></span></h4>
                    <p>Welcome to REMS - Where Every Moment Shapes the future</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const ctx = document.getElementById("dashInstChart");
    const instMonths = document.getElementById("instMonths").value;
    const instSum = document.getElementById("instSum").value;
    Chart.defaults.color = "#272626";
    new Chart(ctx, {
        type: "line",
        data: {
        labels: instMonths.split(','),
        datasets: [
            {
            label: "",
            data: instSum.split(','),
            backgroundColor: "black",
            borderColor: "coral",
            borderRadius: 6,
            cubicInterpolationMode: 'monotone',
            fill: false,
            borderSkipped: false,
            },
        ],
        },
        options: {
        interaction: {
            intersect: false,
            mode: 'index'
        },
        elements: {
            point:{
                radius: 0
            }
        },
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
            display: false,
            },
            title: {
            display: true,
            text: "Installment Analytics",
            padding: {bottom: 24},
            font: {
                size: 16,
                weight: "bold",
            },
            },
            tooltip: {
            backgroundColor: "#FF9F43",
            bodyColor: "#272626",
            yAlign: "bottom",
            cornerRadius: 4,
            titleColor: "#272626",
            usePointStyle: true,
            callbacks: {
                label: function(context) {
                    if (context.parsed.y !== null) {
                    const label = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'PKR' }).format(context.parsed.y);
                    return label;
                    }
                    return null;
                }
            }
            },
        },
        },
    });
</script>