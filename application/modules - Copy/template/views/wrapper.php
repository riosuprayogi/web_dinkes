<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$this->session->app_lname?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- [favicon] begin -->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/img/logo-tangerang.gif');?>"/>
	<link rel="icon" type="image/x-icon" href="<?php echo base_url('assets/img/logo-tangerang.gif');?>" />
	<!-- [favicon] end -->

    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.css');?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/font-awesome/css/font-awesome.min.css');?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/ionicons/css/ionicons.min.css');?>">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.css');?>">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/select2/select2.css');?>">
	<!-- daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.css');?>">
	<!-- bootstrap datepicker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.min.css');?>">
    <!-- bootstrap datetimepicker -->
    <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datetimepicker/bootstrap-datetimepicker.css');?>">
    <!-- Sweetalert CSS -->
	<link rel="stylesheet" href="<?php echo base_url('assets/plugins/sweetalert/sweetalert.css');?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.css');?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css');?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/style.css');?>">

    <!-- jQuery 2.2.3 -->
    <script src="<?php echo base_url('assets/plugins/jQuery/jquery-2.2.3.min.js');?>"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js');?>"></script>
    <!-- SlimScroll -->
    <script src="<?php echo base_url('assets/plugins/slimScroll/jquery.slimscroll.min.js');?>"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('assets/plugins/fastclick/fastclick.js');?>"></script>
    <!-- DataTables -->
    <script src="<?php echo base_url('assets/plugins/datatables/jquery.dataTables.min.js');?>"></script>
    <script src="<?php echo base_url('assets/plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url('assets/plugins/select2/select2.full.min.js');?>"></script>
	<!-- InputMask -->
    <script src="<?php echo base_url('assets/plugins/input-mask/jquery.inputmask.js');?>"></script>
	<!-- Moment -->
    <script src="<?php echo base_url('assets/plugins/moment/moment.js');?>"></script>
	<!-- date-range-picker -->
    <script src="<?php echo base_url('assets/plugins/daterangepicker/daterangepicker.js');?>"></script>
	<!-- bootstrap datepicker -->
    <script src="<?php echo base_url('assets/plugins/datepicker/bootstrap-datepicker.js');?>"></script>
    <!-- bootstrap datetimepicker -->
    <script src="<?php echo base_url('assets/plugins/datetimepicker/bootstrap-datetimepicker.min.js');?>"></script>
    <!-- CKEDITOR -->
    <script src="<?php echo base_url('assets/plugins/ckeditor/ckeditor.js');?>"></script>
    <!-- Sweetalert JavaScript -->
	<script src="<?php echo base_url('assets/plugins/sweetalert/sweetalert.min.js');?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/dist/js/app.js');?>"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <script>
        $(document).ready(function(){
            // function load_unseen_notification(view = '')
            // {
            // $.ajax({
            //         url:"<?php echo site_url('site/notif')?>",
            //         method:"POST",
            //         data:{view:view},
            //         dataType:"json",
            //         success:function(data)
            //         {
            //             $('.notif').html(data.notification);
            //             if(data.unseen_notification > 0)
            //             {
            //             $('.count_nofitikasi').html(data.unseen_notification);
            //             }
            //         }
            //     });
            // }
            
            load_unseen_notification();
            load_unseen_notification_rujuk();

            // setInterval(function(){ 
            //   load_unseen_notification();; 
            // }, 5000);
        });

        function getrujukan(){
            $(".sidebar-menu>li.treeview.active>ul.treeview-menu>li").removeClass('active');
            window.location.replace("<?php echo site_url('catatan_rujukan/notif')?>");
            // $(location).attr('href', '<?php echo site_url('catatan_rujukan/notif')?>');
        }

        function getkesehatan(){
            $(".sidebar-menu>li.treeview.active>ul.treeview-menu>li").removeClass('active');
            window.location.replace("<?php echo site_url('catatan_kesehatan/notif')?>");
            // $(location).attr('href', '<?php echo site_url('catatan_rujukan/notif')?>');
        }

        function load_unseen_notification(view = '')
            {
            $.ajax({
                    url:"<?php echo site_url('site/notif')?>",
                    method:"POST",
                    data:{view:view},
                    dataType:"json",
                    success:function(data)
                    {
                        $('.notif').html(data.notification);
                        if(data.unseen_notification > 0)
                        {
                        $('.count_nofitikasi').html(data.unseen_notification);
                        }
                    }
                });
            }

            function load_unseen_notification_rujuk(view = '')
            {
            $.ajax({
                    url:"<?php echo site_url('site/notif2')?>",
                    method:"POST",
                    data:{view:view},
                    dataType:"json",
                    success:function(data)
                    {
                        $('.rujuk').html(data.notification);
                        if(data.unseen_notification > 0)
                        {
                        $('.count_rujuk').html(data.unseen_notification);
                        }
                    }
                });
            }
    </script>
    <body class="hold-transition skin-<?=$this->session->app_scheme?$this->session->app_scheme:'purple'?> sidebar-mini<?=!$this->session->app_id?' sidebar-collapse':''?>">
        <!-- Site wrapper -->
        <div class="wrapper">
            <header class="main-header">
                <a href="<?php echo base_url();?>" class="logo">
                    <span class="logo-mini"><b>RPS</b></span>
                    <span class="logo-lg"><b><?=strtoupper($this->session->app_name)?></b></span>
                </a>
                <nav class="navbar navbar-static-top">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <!-- <li>
                                <a href="<?php echo site_url('switcher');?>"><b>Aplikasi</b></a>
                            </li> -->
                            
                            <?php
                             if($this->session->app_id == 1 || $this->session->app_id == 10 ){?>
                             <li class="dropdown messages-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-medkit"></i>
                                    <span class="label label-danger count_rujuk"></span>
                                    </a>
                                    <ul class="dropdown-menu rujuk">
                                    </ul>
                                
                            </li>

                            <li class="dropdown messages-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell-o"></i>
                                    <span class="label label-danger count_nofitikasi"></span>
                                    </a>
                                    <ul class="dropdown-menu notif">
                                    </ul>
                                
                            </li>
                             <?php }
                            ?>
                              
                            
                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <span class="hidden-xs"><b><?php echo $this->session->nama;?></b></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <p>
                                            <b><?php echo $this->session->nama;?></b>
                                            <small><?php echo $this->session->skpd;?></small>
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="<?php echo site_url('profile');?>" class="btn btn-default btn-flat">Profile</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="<?php echo site_url('site/logout');?>" class="btn btn-default btn-flat">Sign out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>

            <!-- =============================================== -->

            <aside class="main-sidebar">
                <section class="sidebar">
                    <ul class="sidebar-menu">
                        <li class="<?php if($this->uri->segment(1) == '' || $this->uri->segment(1) == 'site') echo 'active';?>">
                            <a href="<?php echo base_url();?>">
                                <i class="fa fa-home"></i> <span>Home</span>
                            </a>
                        </li>
                        <?php if ($this->session->menu):?>
                        <?php foreach($this->session->menu as $row):?>
    						<?php if($row['children']):?>
    							<?php
    								$active = '';
    								foreach($row['children'] as $c){
    									if($this->uri->segment(1) == $c['path'] AND $this->uri->segment(2) == '' ){
    										$active = 'active';
    									}
    								}
    							?>
                                <li class="treeview <?php echo $active;?>">
                                    <a href="#">
                                        <i class="<?php echo $row['icon'];?>"></i> <span><?php echo $row['nama'];?></span>
                                        <span class="pull-right-container">
                                            <i class="fa fa-angle-left pull-right"></i>
                                        </span>
                                    </a>
                                    <ul class="treeview-menu">
                                        <?php foreach($row['children'] as $child):?>
                                            <li class="<?php if($this->uri->segment(1) == $child['path'] AND $this->uri->segment(2) == '' ) echo 'active';?>">
                                                <a href="<?php echo site_url($child['path']);?>">
                                                    <i class="fa fa-circle-o"></i> <span><?php echo $child['nama'];?></span>
                                                </a>
                                            </li>
                                        <?php endforeach;?>
                                    </ul>
                                </li>
    						<?php else:?>
                                <li class="<?php if($this->uri->segment(1) == $row['path']) echo 'active';?>">
                                    <a href="<?php echo site_url($row['path']);?>">
                                        <i class="<?php echo $row['icon'];?>"></i> <span><?php echo $row['nama'];?></span>
                                    </a>
                                </li>
    						<?php endif;?>
    					<?php endforeach;?>
                        <?php endif;?>
                    </ul>
                </section>
            </aside>

            <!-- =============================================== -->

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <?php $this->load->view($content);?>
            </div>
            <footer class="main-footer">
                <strong>Copyright &copy; 2017-2019 <a href="http://diskominfo.tangerangkota.go.id">Dinas Komunikasi dan Informatika</a> Kota Tangerang</strong>
            </footer>
        </div>
    </body>
</html>



