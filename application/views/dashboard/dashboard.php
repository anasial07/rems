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
        <div class="text-center mt-1 p-3 bg-white rounded" style="border:1px solid #EBEBEB;">
            <div class="row">
                <div class="col">
                    <h4>Have a nice day! <span style="font-weight: bold; color:#FE9F43;"><?= $this->session->userdata('username'); ?></span></h4>
                    <p>Welcome to REMS - Where Every Moment Shapes the future</p>
                </div>
            </div>
        </div>
    </div>
</div>