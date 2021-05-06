<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<!-- <link href="<?php echo base_url('assets/home/css/hover.css')?>" rel="stylesheet"> -->
<link href="<?php echo base_url('assets/home/css/hover2.css')?>" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>



<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> -->
<script>   
	AOS.init(); 
</script>
<style>
	.footer {
		display: block;
		background-color: #36373B;
		height: 70px;
		text-align: center;
		color: #fff;
	}

    /* #exampleModal{
    height: auto !important;
    } */

    .icon-footer {
    	font-size: 18px;
    	color: #fff;
    }

    .icon-medsos-header {
    	height: 55px;
    	margin-top: 7px;
    	margin-right: 20px;
    }

    .icon-medsos-header-ig {
    	height: 55px;
    	margin-top: 7px;
    }

    .logo-liputan {
    	max-width: 150px;
    	height: auto;
    	margin-left: auto;
    	margin-right: auto;
    }

    .logo-video {
    	max-width: 500px;
    	height: auto;
    	margin-left: auto;
    	margin-right: auto;
    }

    .logo-info {
    	max-width: 500px;
    	height: auto;
    	margin-left: auto;
    	margin-right: auto;
    }

    @media only screen and (max-width: 768px) {

    	/* For mobile phones: */
    	.logo-video {
    		padding-left: 0px !important;
    	}

    	.logo-info {
    		max-width: 250px;
    	}
    }

    .mbr-text-footer {
    	font-size: x-small;
    }

    .title_rilis {
    	font-family: 'Rubik', sans-serif;
    	font-size: 25px;
    	font-display: swap;
    }

    #scroll {
    	position: fixed;
    	right: 27px;
    	bottom: 86px;
    	cursor: pointer;
    	width: 50px;
    	height: 50px;
    	background-color: #0000002e;
    	text-indent: -9999px;
    	display: none;
    	-webkit-border-radius: 60px;
    	-moz-border-radius: 60px;
    	border-radius: 60px
    }

    #scroll span {
    	position: absolute;
    	top: 50%;
    	left: 50%;
    	margin-left: -8px;
    	margin-top: -12px;
    	height: 0;
    	width: 0;
    	border: 8px solid transparent;
    	border-bottom-color: #ffffff;
    }

    .swiper-container {
    	width: 100%;
    	height: 100%;
    	margin-left: auto;
    	margin-right: auto;
    }

    .swiper-slide {
    	text-align: center;
    	font-size: 18px;
    	background: #fff;
    	height: calc((100% - 30px) / 2);

    	/* Center slide text vertically */
    	display: -webkit-box;
    	display: -ms-flexbox;
    	display: -webkit-flex;
    	display: flex;
    	-webkit-box-pack: center;
    	-ms-flex-pack: center;
    	-webkit-justify-content: center;
    	justify-content: center;
    	-webkit-box-align: center;
    	-ms-flex-align: center;
    	-webkit-align-items: center;
    	align-items: center;
    }
</style>
<style>
	.cid-ppid {
		padding-top: 6rem !important;
		padding-bottom: 0rem !important;
		background-color: #fff;
	}

	.cid-struktur {
		/*padding: 90px 10px 90px 10px;*/
		background-color: #fff;
	}

	.cid-tahap-keberatan {
		/*padding: 90px 10px 90px 10px;*/
		background-color: #eeeeef;
	}

	.cid-visi-misi {
        /* padding-top: 90px;
        padding-bottom: 90px;*/
        background-color: #a0d9f6;
    }

    .cid-icon {
    	padding-top: 6rem !important;
    	padding-bottom: 0rem !important;
    	background-color: #eeeeef;
    }

    .cid-medsos {
    	padding-top: 0rem !important;
    	padding-bottom: 0rem !important;
    	background-color: #d5ead8;
    }

    .cid-icon-formulir {
    	padding-top: 6rem !important;
    	padding-bottom: 6rem !important;
    	background-color: #eeeeef;
    }

    .cid-flow-informasi {
    	padding-top: 6rem !important;
    	padding-bottom: 6rem !important;
    	background-color: #eeeeef;
    }

    .cid-alur-informasi {
    	padding-top: 45px;
    	padding-bottom: 45px;
    	background-color: #d0d2d4;
    }

    /*  VIDEO PLAYER CONTAINER
    ############################### */
    .vid-container {
    	position: relative;
    	padding-bottom: 50%;
    	padding-top: 30px;
    	margin-top: 30px;
    	height: 0;
    }

    .vid-container iframe,
    .vid-container object,
    .vid-container embed {
    	position: absolute;
    	top: 0;
    	left: 0;
    	width: 100%;
    	height: 100%;
    }


    /*  VIDEOS PLAYLIST 
    ############################### */
    .vid-list-container {
    	/*width: 92%;*/
    	overflow: hidden;
    	margin-top: 10px;
    	/*margin-left:4%;*/
    	/*padding-bottom: 20px;*/
    }

    .vid-list {
    	width: 1344px;
    	position: relative;
    	top: 0;
    	left: 0;
    }

    .vid-item {
    	display: block;
    	width: 148px;
    	height: 208px;
    	float: left;
    	margin: 0;
    	padding: 10px;
    }

    .thumb {
    	/*position: relative;*/
    	overflow: hidden;
    	/*height: 84px;*/
    }

    .thumb img {
    	width: 100%;
    	position: relative;
    	top: -13px;
    	height: 100px;
    }

    .vid-item .desc {
    	color: #21A1D2;
    	font-size: 15px;
    	margin-top: 5px;
    }

    .vid-item:hover {
    	/*background: #eee;*/
    	cursor: pointer;
    }

    .arrows {
    	position: relative;
    	width: 100%;
    	text-align: center;
    }

    .arrow-left {
    	color: #fff;
    	display: inline-block;
    	/*position: absolute;*/
    	background: #777;
    	padding: 15px;
    	/*left: -40px;*/
    	/*top: -130px;*/
    	z-index: 99;
    	cursor: pointer;
    }

    .arrow-right {
    	color: #fff;
    	display: inline-block;
    	/*position: absolute;*/
    	background: #777;
    	padding: 15px;
    	/*right: -13px;*/
    	/*top: -130px;*/
    	z-index: 100;
    	cursor: pointer;
    }

    .arrow-left:hover {
    	background: #CC181E;
    }

    .arrow-right:hover {
    	background: #CC181E;
    }


    @media (max-width: 624px) {

        /*.caption {
				margin-top: 40px;
				}*/
				.vid-list-container {
					padding-bottom: 20px;
				}

				/* reposition left/right arrows */
				.arrows {
					position: relative;
					margin: 0 auto;
					width: 96px;
				}

				.arrow-left {
					left: 0;
					top: -17px;
				}

				.arrow-right {
					right: 0;
					top: -17px;
				}
			}

			.medsos {
				width: 150px !important;
				height: 150px !important;
			}

			.medsoss {
				width: 100px !important;
			}

			.cons {
				position: relative;
				width: 50%;
				margin-top: 5px;
			}

			.image {
				display: block;
				width: 100%;
				height: auto;
			}

			.overlay {
				position: absolute;
				top: 0;
				bottom: 0;
				left: 0;
				right: 0;
				height: 100%;
				width: 100%;
				opacity: 0;
				transition: .5s ease;
				background-color: rgba(45, 45, 57, 0.83);
			}

			.cons:hover .overlay {
				opacity: 1;
			}

			.text {
				color: white;
				font-size: 14px;
				position: absolute;
				top: 50%;
				left: 50%;
				-webkit-transform: translate(-50%, -50%);
				-ms-transform: translate(-50%, -50%);
				transform: translate(-50%, -50%);
				text-align: center;
			}
		</style>

<!-- <style>
    #ppid::after {
        background: rgba(255, 255, 255, 0.92);
        }
    </style> -->
    <!-- <section class="py-5"></section> -->
    


    <!-- ========================Berita -->



    <?php 


    foreach ($berita3 as $f) : 
                  // strip tags to avoid breaking any html
    	$string = strip_tags($f["isi_berita"]);
    	if (strlen($string) > 500) {

                // truncate string
    		$stringCut = substr($string, 0, 500);
    		$endPoint = strrpos($stringCut, ' ');

                //if the string doesn't contain any space then it will cut without word basis.
    		$string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                // $string .= '... <a href="/this/story">Read More</a>';
    	}


    	?> 

    <?php endforeach; ?>
    
    <section>
    	<img class="img-responsive" src="<?= base_url('assets/media/image/1.png') ?>" alt="" style=" display: block;
    	width:100%;
    	height:100%;
    	object-fit: cover;">
    </section>
    <!-- ======================== akhir Berita -->


    <!-- ==============================Berita Slider -->
    <section  id="video" class="cid-video mbr-parallax-background mbr-fullscreen" data-rv-view="1620" data-aos="fade-right" style="background-color: white">




<!-- <div class="container">
    <div class="row">
      <div class="">
        <h2>Video Baznas</h2>
      </div>
    </div>
</div> -->
<div class="container">
	<div class="">
		<div class="title col-lg-12">
			<div class="card-img">
				<img class="logo-video" src="<?php echo base_url(); ?>assets/tangerangkota/modules/home/berita.png" alt="" style="    padding-left: 60px; padding-bottom: 10px;">
			</div>
		</div>
		<div class="" data-flickity='{ "wrapAround": true }'>
			<?php foreach ($berita3 as $f) : ?>
				<div class="col-md-4 col-sm-6    ">
					<div class="carousel-cell" style=" overflow: hidden; margin-bottom: 50px;  padding: 10px; border-radius: 10px;">
						<div class="" style="width: 16.5rem; height: 500px; overflow: hidden; margin-bottom: 50px; background-color: transparent; ">
							<a href="<?= base_url('site/detail/' . $f["id_berita"]) ?>" style="text-decoration: none; color: #000000">
								<!-- <a href="<?= base_url('site/detail/' . $f["id_berita"].'/'.$f["id_kategori"]) ?>" style="text-decoration: none; color: #000000"> -->

									<?php if (count($f["path_foto_artikel"]) > 0) {
										foreach ($f["path_foto_artikel"] as $k) {
											?>
											<img src="<?= base_url('assets/backend/img/img_berita/' . $k["path_foto_artikel"]) ?>"  width="100%" height="250px">
											<?php
										}
									} ?>
									<div class="card-body">
										<p><?= date('d M Y H:i:s', strtotime($f["tgl_jam"])) ?></p>
										<b><?= $f["judul_berita"] ?></b>

										<p><?= $string?>
										<span><br><br>

											<a style="margin-top: 40px; margin-bottom: 10px; float: right" href="<?= base_url('site/detail/' . $f["id_berita"]) ?>">Baca Selanjutnya</a>
											<!-- <a style="margin-top: 40px; margin-bottom: 10px; float: right" href="<?= base_url('site/detail/' . $f["id_berita"].'/'.$f["id_kategori"]) ?>">Baca Selanjutnya</a> -->
										</span>
									</p>

								</div>

								<!-- <br> -->
							</a>
						</div>

						<!-- <div class="card-content"> -->
							<!-- <p class="d-inline" style="margin-left: 0px;">DINAS KESEHATAN | <?= date('d M Y H:i:s', strtotime($c->tgl_jam)) ?></p> -->
							<!-- <span class="card-title">DINKES News | <?= $tv->nama_video ?></span><br> -->
							<!-- <center> <a href="" class="btn btn-success btn-sm mt-2" target="__blank"> -->
								<!-- <i style="background-color: blue" ></i> Lihat Video -->
							</a></center>
							<!-- <p class="d-inline" style="margin-left: 70px;">DINKES | <?= date('d M Y H:i:s', strtotime($tv->tgl_jam)) ?></p> -->
							<!-- </div> -->

							<!-- </div> -->
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>
<!-- ==============================Akhir Berita Slider -->





<script>
	$(document).ready(function() {
		tables = $('#tables').DataTable({
			paginationType: 'full_numbers',
			processing: true,
			serverSide: true,
			filter: false,
			autoWidth: false,
			bLengthChange: false,
			ajax: {
				url: '<?php echo site_url('daftar_pembantu/ajax_list') ?>',
				type: 'GET',
				header: {
                    '<?= $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', //replace by your name/value
                },
                data: function(data) {
                	data.filter = {
                		'username': '',
                	};
                }
            },
            language: {
            	sProcessing: '<img src="<?php echo base_url('assets/img/process.gif') ?>" width="20px"> Sedang memproses...',
            	sLengthMenu: 'Tampilkan _MENU_ entri',
            	sZeroRecords: 'Tidak ditemukan data yang sesuai',
            	sInfo: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
            	sInfoEmpty: 'Menampilkan 0 sampai 0 dari 0 entri',
            	sInfoFiltered: '(disaring dari _MAX_ entri keseluruhan)',
            	sInfoPostFix: '',
            	sSearch: 'Cari:',
            	sUrl: '',
            	oPaginate: {
            		sFirst: '<<',
            		sPrevious: '<',
            		sNext: '>',
            		sLast: '>>'
            	}
            },
            order: [1, 'desc'],
            columns: [{
            	'data': 'no',
            	'orderable': false
            },
            {
            	'data': 'id_daftar_pembantu',
            	"visible": false
            },
            {
            	'data': 'skpd'
            },
            {
            	'data': 'kategori'
            },
            {
            	'data': 'alamat'
            },
            {
            	'data': 'no_tlp'
            },
            {
            	'data': 'email'
            },
            {
            	'data': 'website'
            },
            ]
        });
	});

	function magnify(nama_foto = null, desk = null) {
		$('#img_foto').empty();
		if (nama_foto) {
            // $('#img_foto').append('<img width="100%" src="https://testing.tangerangkota.go.id/angkutan/assets/foto_angkutan/'+nama_foto+'"/>');
            $('#img_foto').attr('src', '<?php echo base_url('assets/media/image/') ?>' + nama_foto);
            // $('#hapus_foto').click(function(){ myFunction(); });
            // $('#hapus_foto').attr('onclick', "del_foto('"+nama_foto+"')");
        }

        // $('#desk').text(desk);
        $('#modal_magnify').modal('show'); // show bootstrap modal when complete loaded
    }
</script>


<section id="icon-formulir" class="cid-icon-formulir" data-rv-view="1620">
	<div class="container align-center">

		<div class="media-container-row align-center">
			<div class="row justify-content-md-center" style="text-align:justify; color: #000000;">
				<h5 class="mbr-section-title mbr-fonts-style" style="padding-top: 50px;">
					<p style="text-align: center;">

						<strong>DINAS KESEHATAN KOTA TANGERANG</strong>
					</p>
					<p style="text-align: center; font-weight: normal;">
						<?= $kontak['alamat'] ?>
					</p>
					<p style="text-align: center; font-weight: normal;">
						Telp: <?= $kontak['no_tlp'] . ',' ?> Fax: <?= $kontak['no_fax'] ?>
					</p>
                    <!-- <p style="text-align: center; font-weight: normal;">

                    </p> -->
                    <p style="text-align: center; font-weight: normal;">
                    	Website: dinkes.tangerangkota.go.id Email: <?= $kontak['email'];  ?>
                    </p>
                </h5>
            </div>
        </div>
        <div class="media-container-row align-center">
        	<div class="col-md-6">
        		<a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" class="text-reset">
        			<img src="<?php echo base_url(); ?>assets/img/banner/Logo-Skpd.png" style="width:60%; margin:auto;" alt="" media-simple="true">
        		</a>
        	</div>
        	<div class="col-md-6">
        		<a target="_blank" href="<?= 'https://play.google.com/store/apps/details?id=id.go.tangerangkota.tangeranglive' ?>">
        			<img src="<?php echo base_url(); ?>assets/img/banner/Logo-Laksa.png" style="width:60%; margin:auto;" alt="" media-simple="true">
        		</a>
        	</div>
        </div>
        <div class="media-container-row align-center">
        	<a target="_blank" href="https://play.google.com/store/apps/details?id=id.go.tangerangkota.pusatinformasi">
        		<img src="<?php echo base_url(); ?>assets/img/icon/PLAYSTORE-BUTTON.png" style="width:35%; margin:auto;" alt="" media-simple="true">
        	</a>
        </div>
    </div>
</section>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog 	modal-xl" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Daftar PPID Pembantu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="tables" class="table table-striped table-sm table-bordered">
						<thead>
							<tr class="info">
								<th style="vertical-align: middle;" width="5%">
									<center><b>No</b></center>
								</th>
								<th>id</th>
								<th style="vertical-align : middle !important;" width="24%">
									<center><b>SKPD</b></center>
								</th>
								<th style="vertical-align : middle !important;" width="24%">
									<center><b>Pembantu</b></center>
								</th>
								<th style="vertical-align : middle !important;" width="24%">
									<center><b>Alamat</b></center>
								</th>
								<th style="vertical-align : middle !important;" width="24%">
									<center><b>No Telepon</b></center>
								</th>
								<th style="vertical-align : middle !important;" width="24%">
									<center><b>Email</b></center>
								</th>
								<th style="vertical-align : middle !important;" width="24%">
									<center><b>Website</b></center>
								</th>

							</tr>
						</thead>
					</table>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="strukturModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog 	modal-lg" role="document">
		<div class="modal-content" style="overflow:auto;">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Struktur</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<?php foreach ($struktur as $row) { ?>
							<img src="<?php echo base_url('assets/media/image/') . $row->isi ?>" class="img-fluid" style="width: 100%;">
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="perwalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog 	modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Keperwal</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<?php foreach (@$kepwal as $row) { ?>
							<iframe style="height:450px; width:100%; overflow:x-hidden;" src="<?php echo base_url('assets/media/image/') . $row->isi ?>" frameborder="0"></iframe>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>




<script>
	$('.owl-carousel').owlCarousel({
		loop: true,
		margin: 20,
		nav: true,
		items: 2,
	});
</script>