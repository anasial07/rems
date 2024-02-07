<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
            <meta name="description" content="">
            <meta name="keywords" content="">
            <meta name="author" content="">
            <meta name="robots" content="noindex, nofollow">
            <title><?= $title; ?></title>
            <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/img/favicon.png'); ?>">
            <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
            <link rel="stylesheet" href="<?= base_url('assets/css/animate.css'); ?>">
            <link rel="stylesheet" href="<?= base_url('assets/css/dataTables.bootstrap4.min.css'); ?>">
            <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome/css/fontawesome.min.css'); ?>">
            <link rel="stylesheet" href="<?= base_url('assets/plugins/fontawesome/css/all.min.css'); ?>">
            <link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
            
            <link rel="stylesheet" href="<?= base_url('assets/plugins/owlcarousel/owl.carousel.min.css'); ?>">
            <link rel="stylesheet" href="<?= base_url('assets/plugins/owlcarousel/owl.theme.default.min.css'); ?>">
            <link rel="stylesheet" href="<?= base_url('assets/plugins/select2/css/select2.min.css'); ?>">
            
            <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-datetimepicker.min.css'); ?>">

            <script src="<?= base_url('assets/js/jquery-3.6.0.min.js'); ?>"></script>

            <script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
            <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css">

        </head>
    <body>
        <!-- <div id="global-loader">
            <div class="whirly-loader"> </div>
        </div> -->
        <div class="main-wrapper">
            <div class="header">
                <div class="header-left active">
                    <a href="<?= base_url(); ?>" class="logo">
                        <img src="<?= base_url('assets/img/logo.png'); ?>" alt="">
                    </a>
                    <a href="" class="logo-small">
                        <img src="<?= base_url('assets/img/logo-small.png'); ?>" alt="">
                    </a>
                    <a id="toggle_btn" href="javascript:void(0);">
                    </a>
                </div>
                <a id="mobile_btn" class="mobile_btn" href="#sidebar">
                    <span class="bar-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </a>
                <ul class="nav user-menu">
                    <li class="nav-item dropdown has-arrow flag-nav">
                        <a href="javascript:void(0);">
                            Login as: <?= ucwords($this->session->userdata('role')); ?>
                         </a>
                    </li>
                    <li class="nav-item dropdown has-arrow main-drop">
                        <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                            <span class="user-img"><img src="<?= base_url('assets/img/AH.png'); ?>" alt="">
                            <span class="status online"></span></span>
                        </a>
                        <div class="dropdown-menu menu-drop-user">
                            <div class="profilename">
                                <hr class="m-0">
                                <a class="dropdown-item" href="<?= base_url('dashboard/myProfile'); ?>"> <i class="me-2" data-feather="user"></i> My Profile</a>
                                <!-- <a class="dropdown-item" href=""><i class="me-2" data-feather="settings"></i>Settings</a> -->
                                <hr class="m-0">
                                <a class="dropdown-item logout pb-0" href="<?= base_url('login/signout'); ?>"><img src="<?= base_url('assets/img/icons/log-out.svg'); ?>" class="me-2" alt="img">Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="dropdown mobile-user-menu">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?= base_url('dashboard/myProfile'); ?>">My Profile</a>
                        <!-- <a class="dropdown-item" href="">Settings</a> -->
                        <a class="dropdown-item" href="<?= base_url('login/signout'); ?>">Logout</a>
                    </div>
                </div>
            </div>
            <div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
                    <div id="sidebar-menu" class="sidebar-menu">
                        <ul>
                            <li class="active">
                                <a href="<?= base_url('dashboard'); ?>"><img src="<?= base_url('assets/img/icons/dashboard.svg'); ?>" alt="img"><span>Dashboard</span></a>
                            </li>
                            <li class="submenu">
                                <a><img src="<?= base_url('assets/img/icons/purchase1.svg'); ?>" alt="img"><span>Setup Forms</span> <span class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="<?= base_url('dashboard/addDesignation'); ?>">Designations</a></li>
                                    <li><a href="<?= base_url('dashboard/provinces'); ?>">Geolocation</a></li>
                                    <li><a href="<?= base_url('dashboard/addProject'); ?>">Projects</a></li>
                                    <li><a href="<?= base_url('dashboard/paymentPlan'); ?>">Payment Plans</a></li>
                                    <li><a href="<?= base_url('dashboard/addOffers'); ?>">Offers</a></li>
                                </ul>
                            </li>
                            <li><a href="<?= base_url('agents'); ?>"><img src="<?= base_url('assets/img/icons/users1.svg'); ?>" alt="img"><span>Agents</span></a></li>
                            <li><a href="<?= base_url('dashboard/addTeam'); ?>"><img src="<?= base_url('assets/img/icons/users1.svg'); ?>" alt="img"><span>Teams</span></a></li>
                            <li><a href="<?= base_url('customers'); ?>"><img src="<?= base_url('assets/img/icons/users1.svg'); ?>" alt="img"><span>Customers</span></a></li>
                            <li><a href="<?= base_url('booking'); ?>"><img src="<?= base_url('assets/img/icons/places.svg'); ?>" alt="img"><span>Bookings</span></a></li>
                            <li><a href="<?= base_url('booking/addInstallment'); ?>"><img src="<?= base_url('assets/img/icons/expense1.svg'); ?>" alt="img"><span>Insallments</span></a></li>
                        </ul>
                    </div>
                </div>
            </div>