<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
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


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-2.2.4/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/af-2.2.0/b-1.3.1/b-colvis-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/cr-1.3.3/fc-3.2.2/fh-3.1.2/r-2.1.1/rg-1.0.0/sc-1.4.2/se-1.2.2/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-2.2.4/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/af-2.2.0/b-1.3.1/b-colvis-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/cr-1.3.3/fc-3.2.2/fh-3.1.2/r-2.1.1/rg-1.0.0/sc-1.4.2/se-1.2.2/datatables.min.js"></script>





    <style>
    	.error{
    		color:red;
    		font-weight: normal;
    	}
      html, body {
        height: 100%;
      }

      .wrapper {
        height: 100%;
      }
    </style>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/js/jQuery-2.1.4.min.js"></script>

    <script type="text/javascript" src="<?php echo base_url(); ?>assets/datatables.min.js"></script>

    <script type="text/javascript">
        var baseURL = "<?php echo base_url(); ?>";
    </script>
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- <script src="//code.jquery.com/jquery-1.11.2.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/EasyAutocomplete/jquery.easy-autocomplete.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/EasyAutocomplete/easy-autocomplete.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/EasyAutocomplete/easy-autocomplete.themes.min.css">

    <style type="text/css">
      ul.sidebar-menu li label {
        width: 84px;
        color: #999999;
        padding-left: 13px;
    }

    section.sidebar h2 {
        color: #dcdcdc;
        text-align: center;
        font-size: 18px;
    }
    </style>
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      
      <header class="main-header">
        <!-- Logo -->
        <a href="<?php echo base_url(); ?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>DHL</b>BKKHUB</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>DHLBKKHUB</b>Task Tracker</span>
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
          <h2>Filter</h2>
          <ul class="sidebar-menu">
          <li>
            <label>Start date</label>
            <input type="text" name="start" id="start" value="<?= date('Y-m-d', strtotime('-7 days')) ?>">
          </li>

          <li>
            <label>End date</label>
            <input type="text" name="end" id="end" value="<?= date('Y-m-d') ?>">
          </li>

          <li>
            <label>Worker</label>
            <select id="worker">
            <option value="0">All workers</option>
              <?php foreach ($report['users'] as $user): ?>
                <option value="<?= $user->userId ?>">
                  <?php //if($user->userId == $record->assigned_to) { ?>
                  <!-- selected -->
                  <?php //} ?>
                  > <?= $user->name ?></option>
                <?php endforeach ?>>
              </select>
          </li>

          <li>
            <label>Status</label>
            <select id="status">
            <option value="0">All status</option>
              <?php foreach ($report['status'] as $sta): ?>
                <option value="<?= $sta->statusId ?>">
                  <?php //if($user->userId == $record->assigned_to) { ?>
                  <!-- selected -->
                  <?php //} ?>
                  > <?= $sta->statusName ?></option>
                <?php endforeach ?>>
              </select>
          </li>

          <li>
            <label></label>
            <button class="btn btn-success" id="filterbtn">Filter</button> 
          </li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <script type="text/javascript">
        $('#filterbtn').click(function() {
          start = $('#start').val().replace(/-/g,'');
          start+="0000";

          end = $('#end').val().replace(/-/g,'');
          end+="2359";

          params = ''+$('#worker').val();
          params += '-'+$('#status').val();

          url = '<?= base_url() ?>tasks/report/<?= $report["groupId"] ?>/'+start+'/'+end+'/'+params;
// alert(url);
          window.location.href = url;
        });

      </script>