<!DOCTYPE html>
<html>
	<head>
		<!-- Site made with Mobirise Website Builder v4.3.0, https://mobirisethemes.com -->
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo base_url();?>assets/home2/images/logo2.png" type="image/x-icon">
		<meta name="description" content="<?php echo $title;?>">
		<title><?php echo $title;?></title>
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

	</head>
	
	<body>
		<?php echo $this->load->view('navbar');?>

		<!--<section class="engine"><a href="#">bootstrap modal popup</a></section>-->

		<?php echo $this->load->view('ppid/ppid_kota/sections/slide');?>

		<?php echo $this->load->view('ppid/ppid_kota/sections/ppid_intro');?>
		
		<?php echo $this->load->view('ppid/ppid_kota/sections/medsos');?>

		<?php echo $this->load->view('ppid/ppid_kota/sections/struktur');?>

		<?php echo $this->load->view('ppid/ppid_kota/sections/visi_misi');?>

		<?php echo $this->load->view('ppid/ppid_kota/sections/maklumat');?>
		
		<?php echo $this->load->view('ppid/ppid_kota/sections/icon_ppid');?>

		<?php echo $this->load->view('ppid/ppid_kota/sections/dasar_hukum');?>

		<?php echo $this->load->view('ppid/ppid_kota/sections/alur_informasi');?>

		<?php echo $this->load->view('ppid/ppid_kota/sections/flow_informasi');?>

		<?php echo $this->load->view('ppid/ppid_kota/sections/sengketa_informasi');?>
		
		<?php echo $this->load->view('ppid/ppid_kota/sections/tahap_keberatan');?>
		
		<?php echo $this->load->view('ppid/ppid_kota/sections/pengajuan_keberatan');?>
		
		<?php echo $this->load->view('ppid/ppid_kota/sections/icon_formulir');?>

		<?php echo $this->load->view('ppid/ppid_kota/footer');?>

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
	</body>
</html>