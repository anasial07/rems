<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget">
                    <div class="dash-widgetimg">
                        <span><img src="<?= base_url('assets/img/icons/dash1.svg'); ?>" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="<?= $bookingAmount; ?>"><?= $bookingAmount; ?></span></h5>
                        <h6>Total Booking Amount</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash1">
                    <div class="dash-widgetimg">
                        <span><img src="<?= base_url('assets/img/icons/dash2.svg'); ?>" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="<?= $installAmount; ?>"><?= $installAmount; ?></span></h5>
                        <h6>Total Installment Amount</h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-12">
                <div class="dash-widget dash2">
                    <div class="dash-widgetimg">
                        <span><img src="<?= base_url('assets/img/icons/dash3.svg'); ?>" alt="img"></span>
                    </div>
                    <div class="dash-widgetcontent">
                        <h5><span class="counters" data-count="0">0</span></h5>
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
                        <h5><span class="counters" data-count="00">00</span></h5>
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
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Booking & Installment Analytics</h5>
                    </div>
                    <div class="card-body">
                        <div id="s-line-area" class="chart-set"></div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            $chart1Months = json_encode($chart1Months);
            $chart1MonthsArray = json_decode($chart1Months, true);
            if($chart1MonthsArray !== null){
                $chart1Months="";
                foreach($chart1MonthsArray as $data){
                    if (isset($data['bookingDate'])){
                        $chart1Months.=$data['bookingDate'].',';
                    }
                }
            }
            $chart1Months = rtrim($chart1Months, ',');
            if($chart1Months==""){ $chart1Months=date('Y-m'); }
            // -----------------------------------------------------------------
            $chart1BookingAmt = json_encode($chart1BookingAmt);
            $chart1BookingAmtArray = json_decode($chart1BookingAmt, true);
            if($chart1BookingAmtArray !== null){
                $chart1BokAmount="";
                foreach($chart1BookingAmtArray as $data){
                    if (isset($data['totalBookingAmount'])){
                        $chart1BokAmount.=$data['totalBookingAmount'].',';
                    }
                }
            }
            $chart1BokAmount = rtrim($chart1BokAmount, ',');
            if($chart1BokAmount==""){ $chart1BokAmount=0; }
            // -----------------------------------------------------------------
            $chart1InstallAmt = json_encode($chart1InstallAmt);
            $chart1InstallAmtArray = json_decode($chart1InstallAmt, true);
            if($chart1InstallAmtArray !== null){
                $chart1InstAmt="";
                foreach($chart1InstallAmtArray as $data){
                    if (isset($data['totalInstallAmount'])){
                        $chart1InstAmt.=$data['totalInstallAmount'].',';
                    }
                }
            }
            $chart1InstAmt = rtrim($chart1InstAmt, ',');
            if($chart1InstAmt==""){ $chart1InstAmt=0; }
        ?>
        <input type="hidden" id="chart1Months" value="<?= $chart1Months; ?>">
        <input type="hidden" id="chart1BokAmount" value="<?= $chart1BokAmount; ?>">
        <input type="hidden" id="chart1InstAmt" value="<?= $chart1InstAmt; ?>">
    </div>
</div>
<script>
    'use strict';
    $(document).ready(function (){
        var chart1Months = $('#chart1Months').val();
        var chart1BokAmount = $('#chart1BokAmount').val();
        var chart1InstAmt = $('#chart1InstAmt').val();
        
        var monthCatArray = chart1Months.split(',');
        var bokAmtArray = chart1BokAmount.split(',');
        var instAmtArray = chart1InstAmt.split(',');
        if($('#s-line-area').length > 0){
            var sLineArea = {
                chart: { 
                    height: 350, type: 'area',
                    toolbar: { show: false, }
                },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth' },
                series: [
                    { name: 'Bookings',  data: bokAmtArray },
                    { name: 'Installments', data: instAmtArray }
                ],
                xaxis: {
                    type: 'datetime',
                    categories: monthCatArray
                }
            }
            var chart = new ApexCharts(document.querySelector("#s-line-area"), sLineArea);
            chart.render();
        }
    });
</script>