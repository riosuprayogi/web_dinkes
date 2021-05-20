<!DOCTYPE html>
<head>
		<!-- Site made with Mobirise Website Builder v4.3.0, https://mobirisethemes.com -->
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo base_url();?>assets/home2/images/logo2.png" type="image/x-icon">
		<meta name="description" content="PPID Kota Tangerang">
		<title>PPID Kota Tangerang</title>

		<link rel="stylesheet" href="<?php echo base_url();?>assets/home2/web/assets/mobirise-icons/mobirise-icons.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/home2/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/home2/bootstrap/css/bootstrap-grid.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/home2/bootstrap/css/bootstrap-reboot.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/home2/socicon/css/styles.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/home2/dropdown/css/style.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/home2/tether/tether.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/home2/theme/css/style.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/home2/theme/css/navbar.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/home2/css/scroll.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/home2/mobirise/css/mbr-additional_ppid.css" type="text/css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/home2/modules/footer.css">
		<link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css');?>">
  		<link rel="stylesheet" href="<?php echo base_url('assets/') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
		<script type='text/javascript' src="<?php echo base_url();?>assets/home2/web/assets/jquery/jquery.min.js"></script>
		<script type='text/javascript' src="<?php echo base_url();?>assets/home2/popper/popper.min.js"></script>
		<script type='text/javascript' src="<?php echo base_url();?>assets/home2/bootstrap/js/bootstrap.min.js"></script>
		  <!-- DataTables -->
		<script src="<?php echo base_url('assets/') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url('assets/') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
		<script src="<?php echo base_url('assets/') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
		<script src="<?php echo base_url('assets/') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <!-- https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css -->
        <!-- <link src="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet"> -->
        <!-- SweetAlert2 -->
        <script src="<?php echo base_url('assets/') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
        <!-- jquery-validation -->
        <script src="<?php echo base_url('assets/') ?>plugins/jquery-validation/jquery.validate.min.js"></script>
		<link rel="stylesheet" href="<?php echo base_url('assets/') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
		
		<link rel="stylesheet" src="<?php echo base_url('assets/') ?>plugins/fontawesome-free/css/fontawesome.css">
		<script src="<?php echo base_url('assets/') ?>plugins/jquery-validation/additional-methods.min.js"></script>
		
		
		<script type='text/javascript' src="<?php echo base_url();?>assets/home2/popper/popper.min.js"></script>
		<script src="https://www.tangerangkota.go.id/assets/themes/mydevio_2018/js/scrollreveal.min.js"></script>
		<!-- <script src="https://www.tangerangkota.go.id/assets/themes/mydevio_2018/js/mydevio.js"></script>
		<script src="https://www.tangerangkota.go.id/assets/themes/mydevio_2018/js/homeland.js"></script> -->

		
        <!-- DataTables -->
        <script src="<?php echo base_url('assets/') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url('assets/') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="<?php echo base_url('assets/') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo base_url('assets/') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
		

		
</head>

<body >
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark" id="mainNav">
	<div class="container-fluid">
		<a class="navbar-brand js-scroll-trigger" href="<?= base_url() ?>"><img src="assets/home2/images/logo-navbar.png" alt=""></a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			Menu
			<i class="fas fa-bars"></i>
		</button>
		<div class="collapse navbar-collapse " id="navbarResponsive">
			<ul class="navbar-nav text-uppercase ml-auto">
				<li class="nav-item"> 
					<a class="nav-link js-scroll-trigger" href="<?= base_url()?>">Beranda</a>
				</li>
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="<?= base_url('dasar_hukum')?>">Dasar Hukum</a>
				</li>
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="<?= base_url('layanan')?>">Layanan PPID</a>
				</li>
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="<?= base_url('data_dokumen')?>">Data & Dokumen</a>
				</li>
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="<?= base_url('permohonan')?>">Formulir</a>
				</li>
				<li class="nav-item">
					<a class="nav-link js-scroll-trigger" href="<?= base_url('daftar_informasi')?>">Daftar Informasi</a>
				</li>

			</ul>
		</div>
		
	</div>
</nav>


<?php $this->load->view($content);?>    

		<script type='text/javascript' src="<?php echo base_url();?>assets/home2/smoothscroll/smooth-scroll.js"></script>
		<script type='text/javascript' src="<?php echo base_url();?>assets/home2/dropdown/js/nav-dropdown.js"></script>
        <script type='text/javascript' src="<?php echo base_url();?>assets/home2/dropdown/js/navbar-dropdown.js"></script>
        <script type='text/javascript' src="<?php echo base_url();?>assets/home2/touchswipe/jquery.touch-swipe.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url();?>assets/home2/tether/tether.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url();?>assets/home2/vimeoplayer/jquery.mb.vimeo_player.js"></script>
        <script type='text/javascript' src="<?php echo base_url();?>assets/home2/parallax/jarallax.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url();?>assets/home2/sociallikes/social-likes.js"></script>
        <script type='text/javascript' src="<?php echo base_url();?>assets/home2/ytplayer/jquery.mb.ytplayer.min.js"></script>
        <script type='text/javascript' src="<?php echo base_url();?>assets/home2/slidervideo/script.js"></script>
        <script type='text/javascript' src="<?php echo base_url();?>assets/home2/bootstrapcarouselswipe/bootstrap-carousel-swipe.js"></script>
        <script type='text/javascript' src="<?php echo base_url();?>assets/home2/theme/js/script2.js"></script>
		<script type='text/javascript' src="<?php echo base_url();?>assets/home2/theme/js/navbar.js"></script>
<script>
			$(document).ready(function(){
				$(window).scroll(function () {
						if ($(this).scrollTop() > 50) {
							$('#scroll').fadeIn();
						} else {
							$('#scroll').fadeOut();
						}
					});
					// scroll body to 0px on click
					$('#scroll').click(function () {
						$('body,html').animate({
							scrollTop: 0
						}, 400);
						return false;
					});
			});
		</script>
</html>

