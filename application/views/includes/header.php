<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title><?= $pageTitle; ?> | DUPAK Basarnas</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.4 -->
  <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- FontAwesome 4.3.0 -->
  <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <!-- Ionicons 2.0.0 -->
  <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  <!-- Theme style -->
  <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/css/kegiatan.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://adminlte.io/themes/dev/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.css">

  <!-- <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/fullcalendar/dist/fullcalendar.print.min.css"> -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/plugins/timepicker/bootstrap-timepicker.min.css">
  <link href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
  <style>
    .error {
      color: red;
      font-weight: normal;
    }
  </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body class="skin-yellow sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?php echo base_url(); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><i class="fa fa-circle-thin"></i></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b><i class="fa fa-circle-thin"></i> Dupak Basarnas</b></span>
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
                <img src="<?php echo base_url(); ?>upload/images/<?php echo $fotoProfil ?>" class="user-image" alt="User Image" />
                <span class="hidden-xs"><?php echo $name; ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?php echo base_url(); ?>upload/images/<?php echo $fotoProfil ?>" class="img-circle" alt="User Image" />
                  <p>
                    <?php echo $name; ?>
                    <small><?php echo $role_text; ?></small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo base_url(); ?>loadChangePass" class="btn btn-default btn-flat">Ubah Profil</a>
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
          <li class="header">Sidebar Menu</li>
          <?php
            if ($role != 18 && $role !=19) {
            ?>
          <li class="treeview">
              <a href="<?php echo base_url(); ?>">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span></i>
              </a>
          </li>
          <?php
          }
          ?>
          <?php
            if ($role == 1) {
            ?>
          <li class="treeview active" style="height:auto;">
            <a href="#">
              <i class="fa fa-laptop"></i>
              <span>Master Data</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <!-- Child -->
              <li>
                <a href="<?php echo base_url(); ?>role/roleListing">
                  <i class="fa fa-thumb-tack"></i>
                  <span>Hak Akses</span>
                </a>
              </li>
              <li>
                <a href="<?php echo base_url(); ?>pangkat/pangkatListing">
                  <i class="fa fa-ticket"></i>
                  <span>Jabatan</span>
                </a>
              </li>
              <li>
                <a href="<?php echo base_url(); ?>jabatan/jabatanListing">
                  <i class="fa fa-upload"></i>
                  <span>Pangkat</span>
                </a>
              </li>
              <li>
                <a href="<?php echo base_url(); ?>jenjang/jenjangListing">
                  <i class="fa fa-briefcase"></i>
                  <span>Jenjang</span>
                </a>
              </li>
              <li>
                <a href="<?php echo base_url(); ?>userListing">
                  <i class="fa fa-users"></i>
                  <span>Pegawai</span>
                </a>
              </li>
              <li>
                <a href="<?php echo base_url(); ?>unsur/unsurListing">
                  <i class="fa fa-bookmark"></i>
                  <span>Unsur</span>
                </a>
              </li>
              <li>
                <a href="<?php echo base_url(); ?>subunsur/subunsurListing">
                  <i class="fa  fa-flag"></i>
                  <span>Sub Unsur</span>
                </a>
              </li>
              <li>
                <a href="<?php echo base_url(); ?>butir/butirListing">
                  <i class="fa fa-folder"></i>
                  <span>Butir</span>
                </a>
              </li>
              <li>
                <a href="<?php echo base_url(); ?>butir_kegiatan/butirKegiatanListing">
                  <i class="fa fa-external-link"></i>
                  <span>Butir Kegiatan</span>
                </a>
              </li>
            </ul>
          </li>
        <?php
            }
        ?>
        
        <li class="treeview active" style="height:auto;">
          <a href="#">
            <i class="fa fa-line-chart"></i>
            <span>Kegiatan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <!-- Child -->
            <?php
            if ($role != 18 && $role !=19) {
            ?>
            <li>
              <a href="<?php echo base_url(); ?>kegiatan">
                <i class="fa fa-book"></i>
                <span>Kegiatan Harian</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>kegiatan/riwayatKegiatanHarian">
                <i class="fa fa-history"></i>
                <span>Riwayat Kegiatan Harian</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>kegiatan/spmk">
                <i class="fa fa-bar-chart"></i>
                <span>SPMK</span>
              </a>
            </li>
            <li>
              <a href="<?php echo base_url(); ?>kegiatan/dupak">
                <i class="fa fa-calendar"></i>
                <span>Dupak</span>
              </a>
            </li>
            <?php
            }
            ?>
            <?php
            if ($role == 1 || $role == 18 || $role ==19) {
            ?>
              <li>
                <a href="<?php echo base_url(); ?>kegiatan/approvalKegiatan">
                  <i class="fa fa-check"></i>
                  <span>Persetujuan Kegiatan Harian</span>
                </a>
              </li>
            <?php
            }
            ?>
          </ul>
        </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>