<style>
	#ppid{
		background-image: url('<?= base_url('assets/img/banner/informasi-serta-merta.png') ?>') !important;
		background-size: cover!important ;
		background-position: center !important;
		background-repeat: no-repeat !important;
	}
	.logo-video{
		max-width: 500px;
		height: auto;
		margin-left: auto;
		margin-right: auto;
	}
	/* .rny-post-slide .post-img img {
		max-height: 500px !important;
	} */
    .rny-post-slide .post-img img {
		max-height: fit-content  !important;
	}

    /* .rny-post-slide .post-img img {
		max-height: 500px !important;
	} */
    .owl-carousel .owl-item img {
        width: 60% !important;
        margin: auto !important;
    }
    
</style>

<!-- <section class="cid-ppid mt-5" id="ppid" data-rv-view="1620" style="padding-top: 110px !important; padding-bottom: 110px !important; background: rgba(207, 207, 207, 0.33);" >
    <div class="container-fluid ">		
            <div class="media-container-row ">
                <div class="col-12 col-md-12">
                    <div class="media-container-row" >
                        <div class="mbr-figure rounded" style="padding:50px; background: rgba(255, 255, 255, 0); width: 40%;">
                            <div class="mbr-figure " style=" height:auto; opacity:1.0;">
                                <img src="<?php echo base_url();?>assets/img/banner/PPID LOGO.png" style="width:50%; margin:auto;" alt="" media-simple="true">
                                <p style="text-align: center; ">
                                <?php echo $profil['isi']; ?>
                                    Informasi merupakan kebutuhan pokok setiap orang. Bahkan lebih mendasar, hak memperoleh informasi adalah salah satu dari hak asasi manusia, hal ini tercantum dalam Undang-Undang Dasar Negara Republik Indonesia Tahun 1945 Pasal 28 F. Dalam pasal tersebut disebutkan bahwa setiap orang berhak untuk berkomunikasi dan memperoleh informasi untuk mengembangkan pribadi dan lingkungan sosialnya, serta berhak untuk mencari, memperoleh, memiliki, dan menyimpan informasi dengan menggunakan segala jenis saluran yang tersedia. 
                                </p>
                                <h1 class="align-center " style="font-size: 90px; padding:50px;">
                                    DASAR HUKUM
                                </h1>

                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>    
</section> -->
<img class="img-responsive" src="<?= base_url('assets/img/banner/informasi-serta-merta.png') ?>" alt="" style=" display: block;
    width:100%;
    height:100%;
    object-fit: cover;">

<section id="dasar_hukum" class="cid-struktur bg-white" style="padding-top: 50px; padding-bottom: 50px;" data-rv-view="1620">
	<div class="container align-center">
		<div class="col-md-12">
                <!-- <div class="row">
                    <div class="col-md-12">
                        <div class="card-img">
                            <img class="logo-video"src="<?php echo base_url();?>assets/tangerangkota/modules/home/rilis.png" alt="" style="padding-bottom: 10px;">
                        </div>
                    </div>    
                </div> -->
                
				<div class="row">
					<div class="col-md-12">
                        <div id="owl-carousel-siaran" class="owl-carousel owl-theme">
                            <?php
                            $link_kota = 'https://tangerangkota.go.id/';
                                    if(!empty($serta_merta))
                                    {
                                        foreach($serta_merta as $ber)
                                        {
                            ?>
                                <div class="item">
                                    <div class="rny-post-slide">
                                        <div class="post-img">
                                            <a href="<?php echo base_url('artikel/detail/').$ber['id_berita'].'/'.$ber['slug'];?>" >
                                                <img src="<?php echo $link_kota.$ber['foto'];?>">
                                            </a>
                                        </div>
                                        <div class="post-content">
                                            <div class="post-date">
                                                <span class="month"><?php echo indonesian_date($ber['create_date']);?></span>
                                            </div>
                                            <h5 class="post-title"><a href="<?php echo base_url('artikel/detail/').$ber['id_berita'].'/'.$ber['slug'];?>"><?php echo $ber['judul'];?></a></h5>

                                            <div class="post-description">
                                                <?php echo $ber['intro'];?>
                                            </div>

                                                <span class="rny-bacalagi"><a href="<?php echo base_url('artikel/detail/').$ber['id_berita'].'/'.$ber['slug'];?>">Selengkapnya</a></span>
                                        </div>
                                    </div>
                                </div>
							<?php }}else{?>
								<h1>
									Data Tidak Ditemukan
								</h1>
							<?php } ?>
                        </div>
					</div>
				</div>
            </div>
    </div>
</section>
