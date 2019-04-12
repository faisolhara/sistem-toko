
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Adminox - Responsive Web App Kit</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Nestable css -->
        <link href="plugins/nestable/jquery.nestable.css" rel="stylesheet" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        
        <!-- Mendol -->

        <script src="assets/js/modernizr.min.js"></script>

    </head>


    <body>


        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">

                    <!-- Logo container-->
                    <div class="logo">
                        <!-- Text Logo -->
                        <!--<a href="index.html" class="logo">-->
                            <!--Zircos-->
                        <!--</a>-->
                        <!-- Image Logo -->
                        <a href="index.html" class="logo">
                            <img src="assets/images/logo_dark.png" alt="" height="24">
                        </a>

                    </div>
                    <!-- End Logo container-->


                    <div class="menu-extras">

                        <ul class="nav navbar-nav navbar-right pull-right">
                            <li class="navbar-c-items">
                                <form role="search" class="navbar-left app-search pull-left hidden-xs">
                                     <input type="text" placeholder="Search..." class="form-control">
                                     <a href=""><i class="fa fa-search"></i></a>
                                </form>
                            </li>

                            <li class="dropdown navbar-c-items">
                                <span class="badge badge-topbar badge-success">4</span>
                                 <a href="#" class="right-menu-item dropdown-toggle waves-effect" data-toggle="dropdown">
                                    <i class="mdi mdi-bell"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right dropdown-lg user-list notify-list">
                                    <li class="text-center">
                                        <h5>Notifications</h5>
                                    </li>
                                    <li>
                                        <a href="#" class="user-list-item">
                                            <div class="icon bg-info">
                                                <i class="mdi mdi-account"></i>
                                            </div>
                                            <div class="user-desc">
                                                <span class="name">New Signup</span>
                                                <span class="time">5 hours ago</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="user-list-item">
                                            <div class="icon bg-danger">
                                                <i class="mdi mdi-comment"></i>
                                            </div>
                                            <div class="user-desc">
                                                <span class="name">New Message received</span>
                                                <span class="time">1 day ago</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="user-list-item">
                                            <div class="icon bg-warning">
                                                <i class="mdi mdi-settings"></i>
                                            </div>
                                            <div class="user-desc">
                                                <span class="name">Settings</span>
                                                <span class="time">1 day ago</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="all-msgs text-center">
                                        <p class="m-0"><a href="#">See all Notification</a></p>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown navbar-c-items">
                                <a href="" class="dropdown-toggle waves-effect profile" data-toggle="dropdown" aria-expanded="true"><img src="assets/images/users/avatar-1.jpg" alt="user-img" class="img-circle"> </a>
                                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                                    <li class="text-center">
                                        <h5>Hi, John</h5>
                                    </li>
                                    <li><a href="javascript:void(0)"><i class="dripicons-user m-r-10"></i> Profile</a></li>
                                    <li><a href="javascript:void(0)"><i class="dripicons-mail m-r-10"></i> <span class="badge badge-success pull-right">5</span> Messages</a></li>
                                    <li><a href="javascript:void(0)"><i class="dripicons-gear m-r-10"></i> Settings</a></li>
                                    <li><a href="javascript:void(0)"><i class="dripicons-lock m-r-10"></i> Lock screen</a></li>
                                    <li><a href="javascript:void(0)"><i class="dripicons-power m-r-10"></i> Logout</a></li>
                                </ul>

                            </li>
                        </ul>
                        <div class="menu-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </div>
                    </div>
                    <!-- end menu-extras -->

                </div> <!-- end container -->
            </div>
            <!-- end topbar-main -->

            <div class="navbar-custom">
                <div class="container">
                    <div id="navigation">
                        <!-- Navigation Menu-->
                        <ul class="navigation-menu">

                            <li class="has-submenu">
                                <a href="#"><i class="fi-air-play"></i>Dashboard</a>
                                <ul class="submenu">
                                    <li><a href="index.html">Dashboard 1</a></li>
                                    <li><a href="dashboard-2.html">Dashboard 2</a></li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="fi-briefcase"></i>Admin UI</a>
                                <ul class="submenu megamenu">
                                    <li>
                                        <ul>
                                            <li>
                                                <span>UI Kit</span>
                                            </li>
                                            <li><a href="ui-typography.html">Typography</a></li>
                                            <li><a href="ui-panels.html">Panels</a></li>
                                            <li><a href="ui-buttons.html">Buttons</a></li>
                                            <li><a href="ui-modals.html">Modals</a></li>
                                            <li><a href="ui-checkbox-radio.html">Checkboxs-Radios</a></li>
                                            <li><a href="ui-spinners.html">Spinners</a></li>
                                            <li><a href="ui-ribbons.html">Ribbons</a></li>
                                            <li><a href="ui-portlets.html">Portlets</a></li>
                                            <li><a href="ui-tabs.html">Tabs</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li>
                                                <span>UI Kit</span>
                                            </li>
                                            <li><a href="ui-progressbars.html">Progress Bars</a></li>
                                            <li><a href="ui-notifications.html">Notification</a></li>
                                            <li><a href="ui-carousel.html">Carousel</a>
                                            <li><a href="ui-video.html">Video</a>
                                            <li><a href="ui-tooltips-popovers.html">Tooltips & Popovers</a></li>
                                            <li><a href="ui-images.html">Images</a></li>
                                            <li><a href="ui-bootstrap.html">Bootstrap UI</a></li>
                                            <li><a href="admin-grid.html">Grid</a></li>
                                            <li><a href="admin-sweet-alert.html">Sweet Alert</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li>
                                                <span>Admin UI</span>
                                            </li>
                                            <li><a href="admin-tiles.html">Tiles Box</a></li>
                                            <li><a href="admin-nestable.html">Nestable List</a></li>
                                            <li><a href="admin-rangeslider.html">Range Slider</a></li>
                                            <li><a href="admin-ratings.html">Ratings</a></li>
                                            <li><a href="admin-filemanager.html">File Manager</a></li>
                                            <li><a href="admin-lightbox.html">Lightbox</a></li>
                                            <li><a href="admin-scrollbar.html">Scroll bar</a></li>
                                            <li><a href="admin-slider.html">Slider</a></li>
                                            <li><a href="admin-treeview.html">Treeview</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="fi-box"></i>Components</a>
                                <ul class="submenu">
                                    <li class="has-submenu">
                                        <a href="#">Icons</a>
                                        <ul class="submenu">
                                            <li><a href="icons-colored.html">Colored Icons</a></li>
                                            <li><a href="icons-materialdesign.html">Material Design</a></li>
                                            <li><a href="icons-dripicons.html">Dripicons</a></li>
                                            <li><a href="icons-fontawesome.html">Font awesome</a></li>
                                            <li><a href="icons-feather.html">Feather Icons</a></li>
                                            <li><a href="icons-simple-line.html">Simple line Icons</a></li>
                                            <li><a href="icons-flags.html">Flag Icons</a></li>
                                            <li><a href="icons-file.html">File Icons</a></li>
                                            <li><a href="icons-pe7.html">PE7 Icons</a></li>
                                            <li><a href="icons-typicons.html">Typicons</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-submenu">
                                        <a href="#">Graphs</a>
                                        <ul class="submenu">
                                            <li><a href="chart-flot.html">Flot Chart</a></li>
                                            <li><a href="chart-morris.html">Morris Chart</a></li>
                                            <li><a href="chart-google.html">Google Chart</a></li>
                                            <li><a href="chart-echart.html">Echarts</a></li>
                                            <li><a href="chart-chartist.html">Chartist Charts</a></li>
                                            <li><a href="chart-chartjs.html">Chartjs Chart</a></li>
                                            <li><a href="chart-c3.html">C3 Chart</a></li>
                                            <li><a href="chart-justgage.html">Justgage Charts</a></li>
                                            <li><a href="chart-sparkline.html">Sparkline Chart</a></li>
                                            <li><a href="chart-knob.html">Jquery Knob</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-submenu">
                                        <a href="#">Email</a>
                                        <ul class="submenu">
                                            <li><a href="email-inbox.html">Inbox</a></li>
                                            <li><a href="email-read.html">Read Email</a></li>
                                            <li><a href="email-compose.html">Compose Email</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-submenu">
                                        <a href="#">Tables</a>
                                        <ul class="submenu">
                                            <li><a href="tables-basic.html">Basic Tables</a></li>
                                            <li><a href="tables-layouts.html">Tables Layouts</a></li>
                                            <li><a href="tables-datatable.html">Data Tables</a></li>
                                            <li><a href="tables-foo-tables.html">Foo Tables</a></li>
                                            <li><a href="tables-responsive.html">Responsive Table</a></li>
                                            <li><a href="tables-tablesaw.html">Tablesaw Tables</a></li>
                                            <li><a href="tables-editable.html">Editable Tables</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-submenu">
                                        <a href="#">Maps</a>
                                        <ul class="submenu">
                                            <li><a href="maps-google.html">Google Maps</a></li>
                                            <li><a href="maps-google-full.html">Full Google Map</a></li>
                                            <li><a href="maps-vector.html">Vector Maps</a></li>
                                            <li><a href="maps-mapael.html">Mapael Maps</a></li>
                                        </ul>
                                    </li>
                                    <li class="has-submenu">
                                        <a href="#">Apps</a>
                                        <ul class="submenu">
                                            <li><a href="apps-tickets.html">Tickets</a></li>
                                            <li><a href="apps-taskboard.html">Taskboard</a></li>
                                            <li><a href="apps-calendar.html">Calendar</a></li>
                                            <li><a href="apps-todo.html">Todo</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="fi-paper"></i>Forms</a>
                                <ul class="submenu megamenu">
                                    <li>
                                        <ul>
                                            <li><a href="form-elements.html">Form Elements</a></li>
                                            <li><a href="form-advanced.html">Form Advanced</a></li>
                                            <li><a href="form-layouts.html">Form Layouts</a></li>
                                            <li><a href="form-validation.html">Form Validation</a></li>
                                            <li><a href="form-pickers.html">Form Pickers</a></li>
                                            <li><a href="form-wizard.html">Form Wizard</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li><a href="form-mask.html">Form Masks</a></li>
                                            <li><a href="form-summernote.html">Summernote</a></li>
                                            <li><a href="form-wysiwig.html">Wysiwig Editors</a></li>
                                            <li><a href="form-typeahead.html">Typeahead</a></li>
                                            <li><a href="form-x-editable.html">X Editable</a></li>
                                            <li><a href="form-uploads.html">Multiple File Upload</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="fi-paper-stack"></i>Pages</a>
                                <ul class="submenu megamenu">
                                    <li>
                                        <ul>
                                            <li><a href="page-starter.html">Starter Page</a></li>
                                            <li><a href="page-login.html">Login</a></li>
                                            <li><a href="page-register.html">Register</a></li>
                                            <li><a href="page-logout.html">Logout</a></li>
                                            <li><a href="page-recoverpw.html">Recover Password</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li><a href="page-lock-screen.html">Lock Screen</a></li>
                                            <li><a href="page-confirm-mail.html">Confirm Mail</a></li>
                                            <li><a href="page-404.html">Error 404</a></li>
                                            <li><a href="page-404-alt.html">Error 404-alt</a></li>
                                            <li><a href="page-500.html">Error 500</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            <li class="has-submenu">
                                <a href="#"><i class="fi-layers"></i>Extras</a>
                                <ul class="submenu megamenu">
                                    <li>
                                        <ul>
                                            <li><a href="extras-about.html">About Us</a></li>
                                            <li><a href="extras-contact.html">Contact</a></li>
                                            <li><a href="extras-companies.html">Companies</a></li>
                                            <li><a href="extras-members.html">Members</a></li>
                                            <li><a href="extras-members-2.html">Membars 2</a></li>
                                            <li><a href="extras-timeline.html">Timeline</a></li>
                                            <li><a href="extras-invoice.html">Invoice</a></li>
                                            <li><a href="extras-maintenance.html">Maintenance</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <ul>
                                            <li><a href="extras-coming-soon.html">Coming Soon</a></li>
                                            <li><a href="extras-faq.html">FAQ</a></li>
                                            <li><a href="extras-pricing.html">Pricing</a></li>
                                            <li><a href="extras-profile.html">Profile</a></li>
                                            <li><a href="extras-email-template.html">Email Templates</a></li>
                                            <li><a href="extras-search-result.html">Search Results</a></li>
                                            <li><a href="extras-sitemap.html">Site Map</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                        <!-- End navigation menu -->
                    </div> <!-- end #navigation -->
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->
        </header>
        <!-- End Navigation Bar-->


        <div class="wrapper">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <div class="btn-group pull-right">
                                <ol class="breadcrumb hide-phone p-0 m-0">
                                    <li>
                                        <a href="#">Adminox</a>
                                    </li>
                                    <li>
                                        <a href="#">Admin UI</a>
                                    </li>
                                    <li class="active">
                                        Nestable Lists
                                    </li>
                                </ol>
                            </div>
                            <h4 class="page-title">Nestable Lists</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title end breadcrumb -->


                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-left" id="nestable_list_menu">
                            <button type="button" class="btn btn-pink waves-effect waves-light" data-action="expand-all">Expand All</button>
                            <button type="button" class="btn btn-purple waves-effect waves-light" data-action="collapse-all">Collapse All</button>
                        </div>
                    </div>
                </div>
                <!-- End row -->

                <br>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="m-t-0 header-title"><b>Nestable Lists 1</b></h4>
                                    <p class="text-muted m-b-30 font-14">
                                        Drag & drop hierarchical list with mouse and touch compatibility (jQuery plugin).
                                    </p>

                                    <div class="custom-dd dd" id="nestable_list_1">
                                        <ol class="dd-list">
                                            <li class="dd-item" data-id="1">
                                                <div class="dd-handle">
                                                    Choose a smartwatch
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="2">
                                                <div class="dd-handle">
                                                    Send design for review
                                                </div>
                                                <ol class="dd-list">
                                                    <li class="dd-item" data-id="3">
                                                        <div class="dd-handle">
                                                            Coffee with the team
                                                        </div>
                                                    </li>
                                                    <li class="dd-item" data-id="4">
                                                        <div class="dd-handle">
                                                            Ready my new work
                                                        </div>
                                                    </li>
                                                    <li class="dd-item" data-id="5">
                                                        <div class="dd-handle">
                                                            Make a wireframe
                                                        </div>
                                                        <ol class="dd-list">
                                                            <li class="dd-item" data-id="6">
                                                                <div class="dd-handle">
                                                                    Video app redesign
                                                                </div>
                                                            </li>
                                                            <li class="dd-item" data-id="7">
                                                                <div class="dd-handle">
                                                                    iOS apps design completed
                                                                </div>
                                                            </li>
                                                            <li class="dd-item" data-id="8">
                                                                <div class="dd-handle">
                                                                    Dashboard design started
                                                                </div>
                                                            </li>
                                                        </ol>
                                                    </li>
                                                    <li class="dd-item" data-id="9">
                                                        <div class="dd-handle">
                                                            Homepage design
                                                        </div>
                                                    </li>
                                                    <li class="dd-item" data-id="10">
                                                        <div class="dd-handle">
                                                            Developed UI Kit
                                                        </div>
                                                    </li>
                                                </ol>
                                            </li>

                                        </ol>
                                    </div>
                                </div><!-- end col -->

                                <div class="col-md-6">
                                    <h4 class="m-t-0 header-title"><b>Nestable Lists 2</b></h4>
                                    <p class="text-muted m-b-30 font-14">
                                        Drag & drop hierarchical list with mouse and touch compatibility (jQuery plugin).
                                    </p>

                                    <div class="custom-dd dd" id="nestable_list_2">
                                        <ol class="dd-list">
                                            <li class="dd-item" data-id="11">
                                                <div class="dd-handle">
                                                    Item 11
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="12">
                                                <div class="dd-handle">
                                                    Item 12
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="13">
                                                <div class="dd-handle">
                                                    Item 13
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="14">
                                                <div class="dd-handle">
                                                    Item 14
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="15">
                                                <div class="dd-handle">
                                                    Item 15
                                                </div>
                                                <ol class="dd-list">
                                                    <li class="dd-item" data-id="16">
                                                        <div class="dd-handle">
                                                            Item 16
                                                        </div>
                                                    </li>
                                                    <li class="dd-item" data-id="17">
                                                        <div class="dd-handle">
                                                            Item 17
                                                        </div>
                                                    </li>
                                                    <li class="dd-item" data-id="18">
                                                        <div class="dd-handle">
                                                            Item 18
                                                        </div>
                                                    </li>
                                                </ol>
                                            </li>
                                        </ol>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->
                </div>
                <!-- end Row -->

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="m-t-0 header-title"><b>Nestable Lists 3</b></h4>
                                    <p class="text-muted m-b-30 font-14">
                                        Drag & drop hierarchical list with mouse and touch compatibility (jQuery plugin).
                                    </p>

                                    <div class="custom-dd-empty dd" id="nestable_list_3">
                                        <ol class="dd-list">
                                            <li class="dd-item dd3-item" data-id="13">
                                                <div class="dd-handle dd3-handle"></div>
                                                <div class="dd3-content">
                                                    Item 13
                                                </div>
                                            </li>
                                            <li class="dd-item dd3-item" data-id="14">
                                                <div class="dd-handle dd3-handle"></div>
                                                <div class="dd3-content">
                                                    Item 14
                                                </div>
                                            </li>
                                            <li class="dd-item dd3-item" data-id="15">
                                                <div class="dd-handle dd3-handle"></div>
                                                <div class="dd3-content">
                                                    Item 15
                                                </div>
                                                <ol class="dd-list">
                                                    <li class="dd-item dd3-item" data-id="16">
                                                        <div class="dd-handle dd3-handle"></div>
                                                        <div class="dd3-content">
                                                            Item 16
                                                        </div>
                                                    </li>
                                                    <li class="dd-item dd3-item" data-id="17">
                                                        <div class="dd-handle dd3-handle"></div>
                                                        <div class="dd3-content">
                                                            Item 17
                                                        </div>
                                                    </li>
                                                    <li class="dd-item dd3-item" data-id="18">
                                                        <div class="dd-handle dd3-handle"></div>
                                                        <div class="dd3-content">
                                                            Item 18
                                                        </div>
                                                    </li>
                                                </ol>
                                            </li>
                                        </ol>
                                    </div>
                                </div><!-- end col -->

                            </div> <!-- end row -->
                        </div> <!-- end card-box -->
                    </div> <!-- end col -->
                </div>
                <!-- end Row -->


                <!-- Footer -->
                <footer class="footer text-right">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 text-center">
                                2017 © Adminox - Coderthemes.com
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- End Footer -->

            </div> <!-- end container -->
        </div>
        <!-- end wrapper -->


        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <!--script for this page only-->
        <script src="plugins/nestable/jquery.nestable.js"></script>
        <script src="assets/pages/jquery.nestable.init.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>