<?php
require("../config/config.php");

include("verify_logins.php");
$page = pathinfo($_SERVER['REQUEST_URI'], PATHINFO_FILENAME);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Marmore CMS</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?=base_url?>bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="<?=base_url?>plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- daterange picker -->
    <!--<link rel="stylesheet" href="<?=base_url?>plugins/daterangepicker/daterangepicker.css">-->
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?=base_url?>plugins/datepicker/datepicker3.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="<?=base_url?>plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Theme style -->
    <link href="<?=base_url?>dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?=base_url?>dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<body class="skin-blue sidebar-mini">
<div class="wrapper">
<!-- Main Header -->
<header class="main-header">
  <!-- Logo -->
  <a href="javascript:void();" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>Marmore CMS</b></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>Marmore CMS</b></span> </a>
  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"> <span class="sr-only">Toggle navigation </span> </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Tasks Menu -->
        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="logout.php" >
          <!-- The user image in the navbar-->
          <!-- hidden-xs hides the username on small devices so only the image appears. -->
          <span class="hidden-xs">Sign out</span> </a> </li>
        <!-- Control Sidebar Toggle Button -->
      </ul>
    </div>
  </nav>
	</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
						
      <!-- <li class="header">Menu</li>-->
      <!-- Optionally, you can add icons to the links -->
            <li class="<?=($page=='dashboard') ? 'active' : '' ?>"><a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span> </a></li>
            <li class="treeview <?=($page=='list_blogs' || $page=='list_blog_category') ? 'active' : '' ?>">
                <a href="#"><i class='fa fa-pencil-square-o'></i> <span>Manage Blogs</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li class="<?=($page=='list_blogs') ? 'active' : '' ?>"><a href="list_blogs.php">Blog</a></li>
                  <li class="<?=($page=='list_blog_category') ? 'active' : '' ?>"><a href="list_blog_category.php">Blog Category</a></li>
                </ul>
            </li>
            <!--<li class="treeview <?//=($page=='list_service' || $page=='list_service_our_team' || $page=='list_service_overview') ? 'active' : '' ?>">-->
            <!--    <a href="#"><i class='fa fa-cogs'></i> <span>Manage Service</span> <i class="fa fa-angle-left pull-right"></i></a>-->
            <!--    <ul class="treeview-menu">-->
            <!--      <li class="<?//=($page=='list_service') ? 'active' : '' ?>"><a href="list_service.php">Service</a></li>-->
            <!--      <li class="<?//=($page=='list_service_our_team') ? 'active' : '' ?>"><a href="list_service_our_team.php">Service Our Team</a></li>-->
            <!--      <li class="<?//=($page=='list_service_overview') ? 'active' : '' ?>"><a href="list_service_overview.php">Service Overview</a></li>-->
            <!--    </ul>-->
            <!--</li>-->
            <li class="treeview <?=($page=='list_report_category' || $page=='list_report_sub_category' || $page=='list_report') ? 'active' : '' ?>">
                <a href="#"><i class='fa fa-file-code-o'></i> <span>Manage Reports</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <!--<li class="<?//=($page=='list_report_category') ? 'active' : '' ?>"><a href="list_report_category.php">Report Category</a></li>-->
                  <!--<li class="<?//=($page=='list_report_sub_category') ? 'active' : '' ?>"><a href="list_report_sub_category.php">Report Sub-Category</a></li>-->
                  <li class="<?=($page=='list_report') ? 'active' : '' ?>"><a href="list_report.php">Reports</a></li>
                </ul>
            </li>
            <li class="treeview <?=($page=='list_client_story') ? 'active' : '' ?>">
                <a href="#"><i class='fa fa-user'></i><span>Manage Clients</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li class="<?=($page=='list_client_story') ? 'active' : '' ?>"><a href="list_client_story.php">Client Stories</a></li>
                </ul>
            </li>
            <li class="treeview <?=($page=='list_data_book' || $page=='list_data_set') ? 'active' : '' ?>">
                <a href="#"><i class='fa fa-file'></i> <span>Manage Data-Book</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li class="<?=($page=='list_data_book') ? 'active' : '' ?>"><a href="list_data_book.php">Data-Book</a></li>
                 <li class="<?=($page=='list_data_set') ? 'active' : '' ?>"><a href="list_data_set.php">Data Sets</a></li>
                </ul>
            </li>
            <li class="treeview <?=($page=='list_faq') ? 'active' : '' ?>">
                <a href="#"><i class='fa fa-question-circle'></i> <span>Manage FAQ</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li class="<?=($page=='list_faq') ? 'active' : '' ?>"><a href="list_faq.php">FAQ</a></li>
                </ul>
            </li>
            <li class="treeview <?=($page=='list_industry') ? 'active' : '' ?>">
                <a href="#"><i class='fa fa-industry'></i> <span>Manage Industry</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li class="<?=($page=='list_industry') ? 'active' : '' ?>"><a href="list_industry.php">Industry</a></li>
                </ul>
            </li>
            <li class="treeview <?=($page=='list_daily_research') ? 'active' : '' ?>">
                <a href="#"><i class='fa fa-researchgate'></i> <span>Manage Daily Research</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li class="<?=($page=='list_daily_research') ? 'active' : '' ?>"><a href="list_daily_research.php">Daily Research</a></li>
                </ul>
            </li>
            <li class="treeview <?=($page=='list_news') ? 'active' : '' ?>">
                <a href="#"><i class='fa fa-newspaper-o'></i> <span>Manage News </span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li class="<?=($page=='list_news') ? 'active' : '' ?>"><a href="list_news.php">News</a></li>
                </ul>
            </li>
            <li class="treeview <?=($page=='list_gcc') ? 'active' : '' ?>">
                <a href="#"><i class='fa fa-file-code-o'></i> <span>Manage GCC </span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li class="<?=($page=='list_gcc') ? 'active' : '' ?>"><a href="list_gcc.php">GCC</a></li>
                </ul>
            </li>
            <li class="treeview <?=($page=='list_bulletin') ? 'active' : '' ?>">
                <a href="#"><i class='fa fa-file-code-o'></i> <span>Manage Bulletin </span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li class="<?=($page=='list_bulletin') ? 'active' : '' ?>"><a href="list_bulletin.php">Bulletin</a></li>
                </ul>
            </li>
            <li class="treeview <?=($page=='list_webinar') ? 'active' : '' ?>">
                <a href="#"><i class='fa fa-file-code-o'></i> <span>Manage Webinar </span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li class="<?=($page=='list_webinar') ? 'active' : '' ?>"><a href="list_webinar.php">Webinar</a></li>
                </ul>
            </li>
            <li class="treeview <?=($page=='list_career') ? 'active' : '' ?>">
                <a href="#"><i class='fa fa-laptop'></i> <span>Manage Career Jobs </span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li class="<?=($page=='list_career') ? 'active' : '' ?>"><a href="list_career.php">Career</a></li>
                </ul>
            </li>
            <li class="treeview <?=($page=='list_country') ? 'active' : '' ?>">
                <a href="#"><i class='fa fa-map'></i> <span>Manage Country</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li class="<?=($page=='list_country') ? 'active' : '' ?>"><a href="list_country.php">Country</a></li>
                </ul>
            </li>
            <li class="treeview <?=($page=='list_channel') ? 'active' : '' ?>">
                <a href="#"><i class='fa fa-map'></i> <span>Manage Channel</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                  <li class="<?=($page=='list_channel_category') ? 'active' : '' ?>"><a href="list_channel_category.php">Channel Category</a></li>
                  <li class="<?=($page=='list_channel') ? 'active' : '' ?>"><a href="list_channel.php">Channel</a></li>
                </ul>
            </li>
          <li class="<?=($page=='pages') ? 'active' : '' ?>"><a href="pages.php"><i class="fa fa-book"></i> <span>Manage Pages</span> </a></li>
          <li class="<?=($page=='changepassword') ? 'active' : '' ?>"><a href="changepassword.php"><i class="fa fa-cog"></i> <span>Change Password</span> </a></li>
    	  <li class="<?=($page=='logout') ? 'active' : '' ?>"><a href="logout.php"><i class="fa fa-sign-out"></i> <span>Sign out</span> </a></li>
		</ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>

</body>
</html>