<link rel="stylesheet" href="<?php echo base_url();?>assets/home2/mobirise/css/mbr-additional_ppid.css" type="text/css">

<style>
    .icon{
        width: 150px !important;
    }
	.card-horizontal {
		display: flex;
		flex: 1 1 auto;
	}
</style>
<!-- <div style="background-image: url('<?= base_url('assets/img/banner/2.png') ?>'); height:100%; background-position: center; background-repeat: no-repeat; background-size: cover;"">
    <section class="cid-ppid mt-5" id="ppid" data-rv-view="1620" style="padding-top: 40px !important; padding-bottom: 40px!important; background: rgba(207, 207, 207, 0.33);" >
        <div class="container-fluid ">		
            <div class="media-container-row ">
                <div class="col-12 col-md-12">
                    <div class="media-container-row" >
                        <div class="mbr-figure rounded" style="padding:10px; background: rgba(255, 255, 255, 0.92); width: 40%;">
                            <div class="mbr-figure " style=" height:auto; opacity:1.0;">
                                <img src="<?php echo base_url();?>assets/img/banner/PPID LOGO.png" style="width:50%; margin:auto;" alt="" media-simple="true">
                                <p style="text-align: center; ">
                                <?php echo $profil['isi']; ?>
                                    Informasi merupakan kebutuhan pokok setiap orang. Bahkan lebih mendasar, hak memperoleh informasi adalah salah satu dari hak asasi manusia, hal ini tercantum dalam Undang-Undang Dasar Negara Republik Indonesia Tahun 1945 Pasal 28 F. Dalam pasal tersebut disebutkan bahwa setiap orang berhak untuk berkomunikasi dan memperoleh informasi untuk mengembangkan pribadi dan lingkungan sosialnya, serta berhak untuk mencari, memperoleh, memiliki, dan menyimpan informasi dengan menggunakan segala jenis saluran yang tersedia. 
                                </p>
                                <h1 class="align-center " style="font-size: 70px; padding:50px;">
                                    DATA & DOKUMEN
                                </h1>

                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </section>
</div> -->
<style>
	.col-md-6{
			margin-top: 5px !important;
			margin-bottom: 5px !important;
		}
	@media only screen and (max-width: 768px) {
		/* For mobile phones: */
		#dokumen {
			height:auto;
			padding-bottom: 75% !important;
		}
		#footer{
			margin-top: 100px !important;
		}
		.col-md-6{
			margin-top: 5px !important;
			margin-bottom: 5px !important;
		}
		.cid-icon-formulir {
			padding-top: 2rem !important;
			padding-bottom: 2rem !important;
			background-color: #eeeeef;
		}
	}
</style>
<img class="img-responsive" src="<?= base_url('assets/img/banner/BG-FOR-WEB-4.png') ?>" alt="" style="
	display:block;
    width:100%;
    height:100%;
    object-fit: cover;">
<section id="icon-formulir" class="cid-icon-formulir"  data-rv-view="1620">
	<div class="container">		
		<div class="media-container-row my-3">

            <div class="row align-left">
				<div class="col-md-6">
					<a class="text-dark js-scroll-trigger" href="#dokumen" onclick="link_dokumen(1)">
						<div class="card">
							<div class="card-horizontal">
								<div class="img-square-wrapper">
									<img class="icon" src="<?php echo base_url();?>assets/img/icon/icon-06.png" alt="Card image cap">
								</div>
								<div class="card-body">
									<h4 class="card-title">Laporan Layanan Informasi dan Dokumentasi (LLID)</h4>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-6">
					<a class="text-dark js-scroll-trigger" href="#dokumen" onclick="link_dokumen(2)">
						<div class="card"  >
							<div class="card-horizontal">
								<div class="img-square-wrapper">
									<img class="icon" src="<?php echo base_url();?>assets/img/icon/icon-09.png" alt="Card image cap">
								</div>
								<div class="card-body">
									<h4 class="card-title">Informasi Umum Tentang Layanan Publik</h4>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="media-container-row">
            <div class="row align-left">
			<div class="col-md-6 ">
				<a class="text-dark js-scroll-trigger" href="#dokumen" onclick="link_dokumen(3)">
					<div class="card">
						<div class="card-horizontal">
							<div class="img-square-wrapper">
								<img class="icon" src="<?php echo base_url();?>assets/img/icon/icon-07.png" alt="Card image cap">
							</div>
							<div class="card-body">
								<h4 class="card-title">Laporan Akses Informasi Publik Pemerintah Kota Tangerang</h4>
							</div>
						</div>
					</div>
				</a>
				</div>
				<div class="col-md-6 ">
					<a class="text-dark js-scroll-trigger" href="#dokumen" onclick="link_dokumen(4)">
						<div class="card">
							<div class="card-horizontal">
								<div class="img-square-wrapper">
									<img class="icon" src="<?php echo base_url();?>assets/img/icon/icon-08.png" alt="Card image cap">
								</div>
								<div class="card-body">
									<h4 class="card-title">Daftar Informasi dan Dokumentasi Publik (DDIP)</h4>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="container">		
		
	</div>
</section>
<section id="dokumen" data-rv-view="1620" style="display:none; overflow: hidden; padding-top: 36.25%; padding-bottom: 15%;position: relative;">
	<iframe id="iframe_dokumen" src="" frameborder="0" style="border: 0; height: 100%;left: 0;position: absolute;top: 0;width: 100%;"></iframe>
</section>
<script>
	function link_dokumen(id){
		$("#dokumen").show();
		
		
		// window.location.href = '<?= base_url('dokumen?key=') ?>'+id;
		$("#iframe_dokumen").each(function(){
			// $(this).attr("src", $(this).data("src"));
			$(this).attr("src", '<?= base_url('dokumen?key=') ?>'+id);
		}); 
		
	}


</script>