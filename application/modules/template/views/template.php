<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Admin | DINKES</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>/plugins/fontawesome-free/css/fontawesome.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>/plugins/toastr/toastr.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/summernote/summernote-bs4.css">
  <!-- datepicker -->
  <link rel="stylesheet" href="<?php echo base_url('assets\plugins\daterangepicker\daterangepicker.css') ?>">

  <link href="<?php echo base_url('assets/') ?>/dist/css/jquery.dm-uploader.min.css" rel="stylesheet">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">




  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="<?php echo base_url('assets/') ?>plugins/jquery/jquery.js"></script>
  <!-- <script type='text/javascript' src="<?php echo base_url(); ?>assets/tangerangkota/web/assets/jquery/jquery.min.js"></script> -->

  <!-- Bootstrap -->
  <script src="<?php echo base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo base_url('assets/') ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url('assets/') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>/dist/js/jquery.dm-uploader.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?php echo base_url('assets/') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>/plugins/moment/moment.min.js"></script>
  <!-- date-range-picker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
  <!-- Toastr -->
  <script src="<?php echo base_url('assets/') ?>/plugins/toastr/toastr.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url('assets/') ?>dist/js/adminlte.js"></script>

  <!-- OPTIONAL SCRIPTS -->
  <script src="<?php echo base_url('assets/') ?>dist/js/demo.js"></script>

  <!-- jQuery Mapael -->
  <script src="<?php echo base_url('assets/') ?>plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="<?php echo base_url('assets/') ?>plugins/raphael/raphael.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="<?php echo base_url('assets/') ?>plugins/chart.js/Chart.min.js"></script>
  <!-- jquery-validation -->
  <script src="<?php echo base_url('assets/') ?>plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>plugins/jquery-validation/additional-methods.min.js"></script>
  <!-- PAGE SCRIPTS -->
  <script src="<?php echo base_url('assets/') ?>dist/js/pages/dashboard2.js"></script>
  <!-- Summernote -->
  <script src="<?php echo base_url('assets/') ?>plugins/summernote/summernote-bs4.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url('assets/') ?>plugins/relcopy/relcopy.js"></script>



</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- SEARCH FORM -->
      <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-user"></i>

          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header"><?= $this->session->nama; ?></span>

            <a href="<?php echo site_url('site/logout'); ?>" class="dropdown-item dropdown-footer">Keluar</a>
            <!-- <a href="<?php echo site_url('site/logout'); ?>" class="btn btn-default btn-flat">Sign out</a> -->
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i class="fas fa-th-large"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= base_url() ?>" class="brand-link">
        <img src="<?= base_url('assets/img/logo-tangerang.gif'); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">DINKES</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <a  class="d-block"><?= $this->session->nama; ?></a>
        </div>
      </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'site') echo 'active'; ?>">
              <a href="<?php echo base_url(); ?>" class="nav-link <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'site') echo 'active'; ?>">
                <i class="nav-icon fas fa-home"></i>
                <p>Home</p>
              </a>
            </li>
            <?php if ($this->session->menu) : ?>
              <?php foreach ($this->session->menu as $row) : ?>
                <?php if ($row['children']) : ?>
                  <?php
                  $active = '';
                  foreach ($row['children'] as $c) {
                    if ($this->uri->segment(1) == $c['path']) {
                      if ($this->uri->segment(2) != '') {
                        $active = 'menu-open';
                      } else {
                        $active = 'menu-open';
                      }
                    }
                  }
                  ?>
                  <li class="nav-item has-treeview <?php echo $active; ?>">
                    <a href="#" class="nav-link">
                      <i class="nav-icon <?php echo $row['icon']; ?>"></i>
                      <p><?php echo $row['nama']; ?>
                        <i class="right fas fa-angle-left"></i>
                      </p>

                    </a>
                    <ul class="nav nav-treeview ">
                      <?php foreach ($row['children'] as $child) : ?>
                        <li class="nav-item <?php if ($this->uri->segment(1) == $child['path'] and $this->uri->segment(2) != null) echo 'active'; ?>">
                          <a class="nav-link" href="<?php echo site_url($child['path']); ?>">
                            <i class="fa fa-circle-o nav-icon"></i>
                            <p><?php echo $child['nama']; ?></p>
                          </a>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                  </li>
                <?php else : ?>
                  <li class="nav-item <?php if ($this->uri->segment(1) == $row['path']) echo 'active'; ?>">
                    <a href="<?php echo site_url($row['path']); ?>" class="nav-link <?php if ($this->uri->segment(1) == '' || $this->uri->segment(1) == 'site') echo 'active'; ?>">
                      <i class="nav-icon <?php echo $row['icon']; ?>"></i>
                      <p><?php echo $row['nama']; ?></p>
                    </a>
                  </li>
                <?php endif; ?>
              <?php endforeach; ?>
            <?php endif; ?>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?php $this->load->view($content); ?>
      <!-- Content Header (Page header)
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard v2</h1>
          </div>
          /.col
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v2</li>
            </ol>
          </div>/.col
        </div>/.row
      </div>/.container-fluid
    </div>
    /.content-header

    Main content
    <section class="content">
      <div class="container-fluid">
        
      </div>
      /. container-fluid
    </section>
    /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2020 <a href="https://diskominfo.tangerangkota.go.id/">Dinas Komunikasi dan Informatika </a>Kota Tangerang</strong>
      <!-- <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.0.4
    </div> -->
    </footer>
  </div>
  <!-- ./wrapper -->
  <!-- PAGE PLUGINS -->


</body>

</html>