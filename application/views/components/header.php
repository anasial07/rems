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
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <style>
                .cursor{ cursor: pointer; }
            </style>
        </head>
        <style>
            .myBadge{
                border-radius:5px;
                padding:3px 6px 3px 6px; 
                color:white;
                font-size:10px;
            }
        </style>
        <?php 
            $role=$this->session->userdata('role');
            $rights=explode(',',$userPermissions);
        ?>
    <body>
        <!-- <div id="global-loader">-->
        <!--    <div class="whirly-loader"> </div>-->
        <!--</div>-->
        <!--<div class="main-wrapper">-->
            <div class="header">
                <div class="header-left active">
                    <a href="<?= base_url(); ?>" class="logo">
                        <img src="<?= base_url('assets/img/ah-logo.png'); ?>" alt="">
                    </a>
                    <a href="" class="logo-small">
                        <img src="<?= base_url('assets/img/AH.png'); ?>" alt="">
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
                    <!-- <li class="nav-item dropdown has-arrow flag-nav">-->
                    <!--    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);" role="button">-->
                    <!--        Reports-->
                    <!--    </a>-->
                    <!--    <div class="dropdown-menu dropdown-menu-right">-->
                    <!--        <a href="javascript:void(0);" class="dropdown-item">-->
                    <!--            <img src="<?= base_url('assets/img/icon/agent.png'); ?>" height="16"> Agent Reoprt-->
                    <!--        </a>-->
                    <!--        <a href="javascript:void(0);" class="dropdown-item">-->
                    <!--            <img src="<?= base_url('assets/img/icon/calendarReport.png'); ?>" height="16"> Monthly Report-->
                    <!--        </a>-->
                    <!--        <a href="javascript:void(0);" class="dropdown-item">-->
                    <!--            <img src="<?= base_url('assets/img/icon/KYC.png'); ?>" height="16"> KYC-->
                    <!--        </a>-->
                    <!--        <a href="javascript:void(0);" class="dropdown-item">-->
                    <!--            <img src="<?= base_url('assets/img/icon/report.png'); ?>" height="16"> Report-->
                    <!--        </a>-->
                    <!--    </div>-->
                    <!--</li>-->
                    <li class="nav-item dropdown flag-nav">
                        <a href="javascript:void(0);">
                            Login as: 
                            <?php
                                echo ucwords($role); 
                                if($role!='master'){ echo "&nbsp;<i class='fa fa-angle-right'></i>&nbsp;".$this->session->userdata('empCity'); } ?>
                         </a>
                    </li>
                    <?php
                    if(in_array('viewNotification', $rights)):
                        $today=date('Y-m-d');
                        $notiBook = $this->db->from('bookings')->where('DATE(createdBooking)', $today)->get()->num_rows();
                    ?>
                    <li class="nav-item dropdown mt-1">
                        <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                            <img src="<?= base_url('assets/img/icons/notification-bing.svg'); ?>" alt="img"> <span class="badge rounded-pill"><?= $notiBook; ?></span>
                        </a>
                        <?php if($notiBook>0){ ?>
                        <div class="dropdown-menu notifications">
                            <div class="topnav-dropdown-header">
                                <span class="notification-title">Today's booking notifications</span>
                            </div>
                            <div class="noti-content">
                                <ul class="notification-list">
                                    <?php
                                        $this->db->select('*')->from('bookings');
                                        $this->db->join('users', 'bookings.bookAddedBy = users.userId', 'left');
                                        $this->db->where('DATE(createdBooking)', $today);
                                        $todayBookings = $this->db->get()->result();
                                        foreach($todayBookings as $todayNoti):
                                    ?>
                                    <li class="notification-message">
                                        <a href="<?= base_url('booking/bookingDetail/').base_convert($todayNoti->bookingId, 10, 36); ?>">
                                            <div class="media d-flex">
                                                <span class="avatar flex-shrink-0">
                                                    <img class="mt-2" src="<?= base_url('assets/img/AH.png'); ?>">
                                                </span>
                                                <div class="media-body flex-grow-1">
                                                    <p class="noti-details"><span class="noti-title"><label class="text-primary"><?= $todayNoti->userName; ?></label> has added a new booking with the membership# </span> <label class="text-danger cursor"><?= $todayNoti->membershipNo; ?></label></p>
                                                    <p class="noti-time"><span class="notification-time"><?= date('g:i:s A',strtotime($todayNoti->createdBooking)); ?></span></p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php if(in_array('viewBooking', $rights)): ?>
                            <div class="topnav-dropdown-footer">
                                <a href="<?= base_url('booking'); ?>">View all Bookings</a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php } ?>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item dropdown has-arrow main-drop">
                        <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                            <span class="user-img"><img src="<?= base_url('assets/img/favicon.png'); ?>" alt="">
                            <span class="status online"></span></span>
                        </a>
                        <div class="dropdown-menu menu-drop-user">
                            <div class="profilename">
                                <hr class="m-0">
                                <a class="dropdown-item" href="<?= base_url('dashboard/myProfile'); ?>"> <i class="me-2" data-feather="user"></i> My Profile</a>
                                <hr class="m-0">
                                <?php if(in_array('viewLogs', $rights)): ?>
                                <a class="dropdown-item" href="<?= base_url('dashboard/logActivity'); ?>"><i class="me-2" data-feather="settings"></i>Log Activity</a>
                                <?php endif; ?>
                                <a class="dropdown-item" href="<?= base_url('dashboard/guideline'); ?>"><i class="me-2" data-feather="file-text"></i>REMS Guideline</a>
                                <a class="dropdown-item logout pb-0" href="<?= base_url('login/signout'); ?>"><img src="<?= base_url('assets/img/icons/log-out.svg'); ?>" class="me-2" alt="img">Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="dropdown mobile-user-menu">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="<?= base_url('dashboard/myProfile'); ?>">My Profile</a>
                        <?php if(in_array('viewLogs', $rights)): ?>
                        <a class="dropdown-item" href="<?= base_url('dashboard/logActivity'); ?>">Log Activity</a>
                        <?php endif; ?>
                        <a class="dropdown-item" href="<?= base_url('dashboard/guideline'); ?>">REMS Guideline</a>
                        <a class="dropdown-item" href="<?= base_url('login/signout'); ?>">Logout</a>
                    </div>
                </div>
                <div class="sidebar" id="sidebar">
                    <div class="sidebar-inner slimscroll bg-white">
                        <div id="sidebar-menu" class="sidebar-menu">
                            <ul>
                                <li class="active">
                                    <a href="<?= base_url('dashboard'); ?>"><img src="<?= base_url('assets/img/icons/dashboard.svg'); ?>" alt="img"><span>Dashboard</span></a>
                                </li>
                                <?php if(
                                in_array('createDesignation',$rights) ||
                                in_array('viewDesignation',$rights) ||
                                in_array('createGeolocation',$rights) ||
                                in_array('viewGeolocation',$rights) ||
                                in_array('createProject',$rights) ||
                                in_array('viewProject',$rights) ||
                                in_array('createPayplan',$rights) ||
                                in_array('viewPayplan',$rights)
                                ): ?>
                                <li class="submenu">
                                    <a><img src="<?= base_url('assets/img/icons/purchase1.svg'); ?>" alt="img"><span>Setup Forms</span> <span class="menu-arrow"></span></a>
                                    <ul>
                                    <?php if(in_array('createDesignation',$rights) || in_array('viewDesignation',$rights)): ?>
                                        <li><a href="<?= base_url('dashboard/addDesignation'); ?>">Designations</a></li>
                                    <?php endif; if(in_array('createGeolocation',$rights) || in_array('viewGeolocation',$rights)): ?>
                                        <li><a href="<?= base_url('dashboard/provinces'); ?>">Geolocations</a></li>
                                    <?php endif; if(in_array('createProject',$rights) || in_array('viewProject',$rights)): ?>
                                        <li><a href="<?= base_url('dashboard/addProject'); ?>">Projects</a></li>
                                    <?php endif; if(in_array('createPayplan',$rights) || in_array('viewPayplan',$rights)): ?>
                                        <li><a href="<?= base_url('dashboard/paymentPlan'); ?>">Payment Plans</a></li>
                                    <?php endif; ?>
                                        <!-- <li><a href="<?= base_url('dashboard/addOffers'); ?>">Offers</a></li> -->
                                    </ul>
                                </li>
                                <?php endif; ?>
                                
                                <?php if(in_array('createAgent',$rights) || in_array('viewAgent',$rights)): ?>
                                <li><a href="<?= base_url('agents'); ?>"><img src="<?= base_url('assets/img/icons/users1.svg'); ?>" alt="img"><span>Agents</span></a></li>
                                <?php endif; ?>
                                
                                <!-- <li><a href="<?= base_url('dashboard/addTeam'); ?>"><img src="<?= base_url('assets/img/icons/users1.svg'); ?>" alt="img"><span>Teams</span></a></li> -->
                                
                                <?php if(in_array('createCustomer',$rights) || in_array('viewCustomer',$rights)): ?>
                                <li><a href="<?= base_url('customers'); ?>"><img src="<?= base_url('assets/img/icons/users1.svg'); ?>" alt="img"><span>Customers</span></a></li>
                                <?php endif; ?>
                                
                                <?php if(in_array('createBooking',$rights) || in_array('viewBooking',$rights)): ?>
                                <li>
                                    <a href="<?= base_url('booking'); ?>"><img src="<?= base_url('assets/img/icons/places.svg'); ?>" alt="img">
                                        <span>Bookings</span>&emsp;&emsp;
                                        <span class="text-primary">
                                            <?php
                                            $countBooking = $this->db->query('SELECT * FROM bookings')->num_rows();
                                                if($countBooking>0){
                                                    echo "<i class='myBadge' style='background:#28C76F'>".sprintf('%02d',$countBooking)."</i>";
                                                }
                                            ?>
                                        </span>
                                    </a>
                                </li>
                                <?php endif; ?>
                                
                                <?php if(in_array('createInstallments',$rights) || in_array('viewInstallments',$rights)): ?>
                                <li><a href="<?= base_url('booking/viewInstallment'); ?>"><img src="<?= base_url('assets/img/icons/expense1.svg'); ?>" alt="img">
                                    <span>Insallments</span>&emsp;
                                        <span class="text-danger" style="font-size:13px!important;">
                                            <?php
                                            $countInstl = $this->db->query('SELECT * FROM installments')->num_rows();
                                                if($countInstl>0){
                                                    echo "<i class='myBadge' style='background:#FF9F43'>".sprintf('%02d',$countInstl)."</i>";
                                                }
                                            ?>
                                        </span>
                                </a></li>
                                <?php endif; ?>
                                
                                <?php if(in_array('createUser',$rights) || in_array('viewUser',$rights)): ?>
                                <li><a href="<?= base_url('dashboard/viewUsers'); ?>"><img src="<?= base_url('assets/img/icons/users1.svg'); ?>" alt="img"><span>Users Management</span></a></li>
                                <?php endif; ?>
                                
                                <li><a href="<?= base_url('dashboard/guideline'); ?>"><img src="<?= base_url('assets/img/icons/transcation.svg'); ?>" alt="img"><span>REMS Guideline</span></a></li>
                                
                                <li><a href="<?= base_url('login/signout'); ?>"><img src="<?= base_url('assets/img/icons/logout-2.svg'); ?>" alt="img"><span>Log out</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>