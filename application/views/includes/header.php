<!DOCTYPE html>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  <head profile="http://www.w3.org/2005/10/profile">
<link rel="icon" 
      type="image/png" 
      href="http://23.168.85.150:8081/task-tracker/dhlicon.png">
    <meta charset="UTF-8">
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="Public">
    <title><?php echo $pageTitle; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <!-- FontAwesome 4.3.0 -->
    <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons 2.0.0 -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins 
         folder instead of downloading all of them to reduce the load. -->
    <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url(); ?>assets/style.css" rel="stylesheet" type="text/css" />

        <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/datatables.min.css"/>
 
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/datatables.min.js"></script> -->


    <style>
    	.error{
    		color:red;
    		font-weight: normal;
    	}
    </style>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-2.2.4/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-colvis-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/cr-1.3.3/fh-3.1.2/kt-2.2.1/r-2.1.1/rg-1.0.0/rr-1.2.0/sc-1.4.2/se-1.2.2/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-2.2.4/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/b-1.3.1/b-colvis-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/cr-1.3.3/fh-3.1.2/kt-2.2.1/r-2.1.1/rg-1.0.0/rr-1.2.0/sc-1.4.2/se-1.2.2/datatables.min.js"></script>


    <!-- <script type="text/javascript" src="<?php echo base_url(); ?>assets/datatables.min.js"></script>  -->
<!--      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.15/b-1.3.1/b-colvis-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/cr-1.3.3/fc-3.2.2/fh-3.1.2/r-2.1.1/rg-1.0.0/rr-1.2.0/sc-1.4.2/se-1.2.2/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.15/b-1.3.1/b-colvis-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/cr-1.3.3/fc-3.2.2/fh-3.1.2/r-2.1.1/rg-1.0.0/rr-1.2.0/sc-1.4.2/se-1.2.2/datatables.min.js"></script> -->

<!--         <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/datatables.min.css"/>
 
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/datatables.min.js"></script> -->


    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
    </script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/EasyAutocomplete/jquery.easy-autocomplete.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/EasyAutocomplete/easy-autocomplete.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/EasyAutocomplete/easy-autocomplete.themes.min.css">
    <style type="text/css">
      b.dhl {
        color: #ffb300;
    }

    ul.list-dashboard li {
        float: left;
        width: 150px;
        list-style-type: none;
    }

    ul.list-dashboard {
        padding-top: 10px;
    }

    ul.list-dashboard li span {
        background-color: rgb(68, 134, 173);
        padding: 5px;
        min-width: 50px;
        display: inline-block;
        text-align: center;
    }

    span#allpending {
        background-color: rgb(222, 141, 13);
    }

    span#alldone {
        background-color: rgb(222, 141, 13);
    }


    li#lilatest {
        width: 450px;
        float: left;
        list-style-type: none;
    }

    span#latesttask {
        width: 90%;
        background-color: #de8d0d;
    }

    .alldashboard {
        color: #f3bc65;
        font-weight: 400;
    }

    .skin-blue .main-header .navbar {
        background-color: #ffcb05;
    }

    .skin-blue .main-header .logo {
        background-color: #3c4d54;
        color: #fff;
        border-bottom: 0 solid transparent;
    }




    .skin-blue .main-header li.user-header {
        background-color: #de8d0d;
    }



    ul.list-dashboard li span {
        background-color: rgb(222, 141, 13);
        padding: 5px;
        min-width: 50px;
        display: inline-block;
        text-align: center;
    }

    li.quicksearch {
        padding: 11px;
    }

    input#hwb {
        background-color: #ffcb05;
        border: none;
        width: 200px;
        text-align: center;
        border-bottom: #6b615e solid 1px;
    }



    @media screen and (max-width: 1240px) {
      ul.list-dashboard {
        display: none;
    }
  }

    </style>

  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b class="dhl"><img src="http://23.168.85.150:8081/task-tracker/dhlicon.png" width="40"></b>BKKHUB</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b class="dhl"><img src="http://23.168.85.150:8081/task-tracker/dhlicon.png" width="40"></b>BKKHUB Task Tracker</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="quicksearch">
                <form action="<?= base_url()?>tasks" method="get">
                  <label>Quick search</label>
                  <input type="text" name="hwb" id="hwb" placeholder="Insert HWB and Enter">
                  <input type="hidden" name="task" value="search">
                </form>
                  
              </li>
              <?php if(false) { ?>
              <li class="dashboard">
                <div class="alldashboard">
                  <ul class="list-dashboard">
                    <li id="lilatest"><span id="latesttask"> </span></li>
                    <li>All Task <span id="alltotal"> </span></li>
                    <li>All Pending <span id="allpending"> </span></li>
                    <li>All Done <span id="alldone"> </span></li>
                  </ul>
                </div>
              </li>
              <?php } ?>
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="user-image" alt="User Image"/>
                  <span class="hidden-xs"><?php echo $name; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->

                  <li class="user-header">
                    <img src="<?php echo base_url(); ?>assets/dist/img/avatar.png" class="img-circle" alt="User Image" />
                    <p>
                      <?php echo $name; ?>
                      <small><?php echo $role_text; ?> - <?php echo $this->session->userdata ( 'groupName' ); ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="<?php echo base_url(); ?>loadChangePass" class="btn btn-default btn-flat">Change Password</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?php echo base_url(); ?>logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>dashboard">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
              </a>
            </li>
            <li class="treeview" style="display: none">
              <a href="<?php echo base_url(); ?>task/addNew">
                (1)<i class="fa fa-plane"></i>
                <span>New Task</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>tasks?task=remain">
                (1) <i class="fa fa-ticket"></i>
                <span>My Pending Tasks</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>tasks?task=done">
                (2) <i class="fa fa-ticket"></i>
                <span>My Complete Tasks</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>tasks?task=showall">
                (3) <i class="fa fa-ticket"></i>
                <span>My Team Tasks</span>
              </a>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>tasks">
                (4) <i class="fa fa-ticket"></i>
                <span>My All Tasks</span>
              </a>
            </li>
            <?php
            if($role == ROLE_ADMIN || $role == ROLE_MANAGER)
            {
            ?>
<!--             <li class="treeview">
              <a href="#" >
                <i class="fa fa-thumb-tack"></i>
                <span>Task Status</span>
              </a>
            </li>
            <li class="treeview">
              <a href="#" >
                <i class="fa fa-upload"></i>
                <span>Task Uploads</span>
              </a>
            </li> -->
            <li class="treeview">
              <a href="<?php echo base_url(); ?>task/report" target="_blank">
                <i class="fa fa-files-o"></i>
                <span>Reports</span>
              </a>
            </li>
            <?php
            }
            if($role == ROLE_ADMIN)
            {
            ?>
            <li class="treeview">
              <a href="<?php echo base_url(); ?>userListing">
                <i class="fa fa-users"></i>
                <span>Users</span>
              </a>
            </li>

            <?php
            }
            ?>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

    <script type="text/javascript">
      $( "#hwb" ).focus();
    </script>