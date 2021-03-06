<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<!-- <link href="<?php echo base_url('assets/home/css/hover.css') ?>" rel="stylesheet"> -->
<link href="<?php echo base_url('assets/home/css/hover2.css') ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/home/css/hover3.css') ?>" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">

<script type="text/javascript" src="<?php echo base_url('assets/js/custom.js') ?>"></script>

<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
<!-- <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flickity@2/dist/flickity.pkgd.js"> -->
<!-- https://npmcdn.com/flickity@2/dist/flickity.pkgd.js -->

<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<!-- flickity -->
<!-- <link href="<?php echo base_url('assets/home/css/styleslider.css') ?>" rel="stylesheet"> -->

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.css">
<!-- <script type="text/javascript" src="<?php echo base_url('assets/js/script.js') ?>"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.pkgd.min.js"></script>
<!-- <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script> -->
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
        padding-top: 1rem !important;
        padding-bottom: 2rem !important;
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
<style>
    @media (max-width: 1200px) {
        .cv {
            height: 150px;
            font-size: 15px;
        }
    }

    @media (max-width: 767px) {
        .cv {
            height: 250px;
        }
    }
</style>




<!-- Flickity HTML init -->
<!-- Flickity HTML init -->
<!--  <div class="carousel carousel-main" data-flickity style="margin-top: 200px">
     <?php foreach ($sliderbanner as $f) : ?>


        <?php if (count($f["path_foto_banner"]) > 0) {
                foreach ($f["path_foto_banner"] as $k) {
        ?>
              <div class="carousel-cell">
                <img style=" background-size: cover; background-position: center " src="<?= base_url('assets/backend/img/img_banner/' . $k["path_foto_banner"]) ?>"  width="100%" height="600px">
            </div>
            <?php
                }
            } ?>



    <?php endforeach; ?> -->
<!--  <div class="carousel-cell"></div>
  <div class="carousel-cell"></div>
  <div class="carousel-cell"></div>
  <div class="carousel-cell"></div>
  <div class="carousel-cell"></div>
  <div class="carousel-cell"></div>
  <div class="carousel-cell"></div>
  <div class="carousel-cell"></div>
  <div class="carousel-cell"></div>
  <div class="carousel-cell"></div> -->
<!-- </div>

<div class="carousel carousel-nav"
data-flickity='{ "asNavFor": ".carousel-main", "contain": true, "pageDots": false }'>
<?php foreach ($sliderbanner as $f) : ?>


    <?php if (count($f["path_foto_banner"]) > 0) {
        foreach ($f["path_foto_banner"] as $k) {
    ?>
          <div class="carousel-cell">
            <img style=" background-size: cover; background-position: center " src="<?= base_url('assets/backend/img/img_banner/' . $k["path_foto_banner"]) ?>"  width="100%" height="600px">
        </div>
        <?php
        }
    } ?>



<?php endforeach; ?> -->
<!-- <div class="carousel-cell"></div>
<div class="carousel-cell"></div>
<div class="carousel-cell"></div>
<div class="carousel-cell"></div>
<div class="carousel-cell"></div>
<div class="carousel-cell"></div>
<div class="carousel-cell"></div>
<div class="carousel-cell"></div>
<div class="carousel-cell"></div>
<div class="carousel-cell"></div> -->
<!-- </div> -->



<!-- <style>
    #ppid::after {
        background: rgba(255, 255, 255, 0.92);
        }
    </style> -->
<!-- <section class="py-5"></section> -->
<!--  <link  href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="hhttps://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script> -->
<!--  <script >
     $('.slider-for').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      fade: true,
      asNavFor: '.slider-nav'
  });
     $('.slider-nav').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      asNavFor: '.slider-for',
      dots: false,
      centerMode: true,
      focusOnSelect: true
  });
</script> -->



<!-- <div class="container">
    <div class="row">
      <div class="">
        <h2>Video Baznas</h2>
      </div>
    </div>
</div> -->
<!-- <section>

    <div class="tes slider_wrap">
        <div class="banner_slider"> -->
<!-- <img src="<?php echo base_url(); ?>assets/img/banner/1.png">
                    <img src="<?php echo base_url(); ?>assets/img/banner/2.png">
                    <img src="<?php echo base_url(); ?>assets/img/banner/3.png"> -->

<!--          <?php foreach ($sliderbanner as $f) : ?>
                        <div  style="">
                            <?php if (count($f["path_foto_banner"]) > 0) {
                                foreach ($f["path_foto_banner"] as $k) {
                            ?>

                                  <img class="tes2" style="margin-top: 50px;" src="<?= base_url('assets/backend/img/img_banner/' . $k["path_foto_banner"]) ?>" >
                                  <?php
                                }
                            } ?>

                      </div>
                  <?php endforeach; ?>
              </div>
              <div class="thumbnail_slider_area">
                <div class="container">
                    <div class="row thumbnail_slider autoplay center">
                      <?php foreach ($sliderbanner as $f) : ?>
                        <?php if (count($f["path_foto_banner"]) > 0) {
                                foreach ($f["path_foto_banner"] as $k) {
                        ?>
                              <div class="col">
                               <img style="z-index:1; margin-top: 72px; position: relative; background-size: cover; background-position: center " src="<?= base_url('assets/backend/img/img_banner/' . $k["path_foto_banner"]) ?>"  width="100%" height="600px"> </div> -->
<!-- <img class="tes3" src="<?= base_url('assets/backend/img/img_banner/' . $k["path_foto_banner"]) ?>"  width="100%" > </div> -->
<!--  <?php
                                }
                            } ?>
                          <?php endforeach; ?> -->

<!-- <img src="<?php echo base_url(); ?>assets/img/banner/1.png"> -->

<!--  <div class="col">
                        <img src="<?php echo base_url(); ?>assets/img/banner/2.png">
                    </div>
                    <div class="col">
                        <img src="<?php echo base_url(); ?>assets/img/banner/3.png">
                    </div> -->
<!--      </div>
            </div>
        </div>
    </div>
</section>
-->
<!-- ===================  Slider banner -->

<section data-aos="fade-right">


    <div class="">
        <div class="">

            <div class="carousel" data-flickity='{ "wrapAround": true, "autoPlay":2500,  "pageDots": false, "pauseAutoPlayOnHover": false }'>

                <?php foreach ($sliderbanner as $f) : ?>




                    <?php if (count($f["path_foto_banner"]) > 0) {
                        foreach ($f["path_foto_banner"] as $k) {
                    ?>

                            <img style=" margin-top: 70px; background-size: cover; background-position: center; width: 100% " src="<?= base_url('assets/backend/img/img_banner/' . $k["path_foto_banner"]) ?>" height="600px">
                    <?php
                        }
                    } ?>




                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- ==============================Akhir Slider banner -->






<!-- <div style="background-image: url('<?= base_url('assets/img/banner/5.png') ?>') ; height: 100%; background-position: center; background-repeat: no-repeat; background-size: cover;">
    <section class= "cid-ppid" id="ppid" data-rv-view="1620" style="padding-top: 90px !important; background: rgba(207, 207, 207, 0.33);">
        <div class="container-fluid ">
            <div class="media-container-row ">
                <div class="col-12 col-md-12">
                    <div class="media-container-row">
                        <div class="mbr-figure" style="width: 30%;">
                            <img src="<?php echo base_url(); ?>assets/home2/modules/ppid/images/walikota.png" alt="" media-simple="true">
                        </div>
                        <div class="mbr-figure rounded" style="padding:5px; background: rgba(255, 255, 255, 0.92); width: 40%;">
                            <div class="mbr-figure " style="height:100%; opacity:1.0;">
                                <img src="<?php echo base_url(); ?>assets/img/banner/Dinkes_LOGO.png" style="width:50%; margin:auto;" alt="" media-simple="true">
                                <center>  <p style="text-align: center; ">
                                    <?php echo $profil['isi']; ?> -->
<!-- Informasi merupakan kebutuhan pokok setiap orang. Bahkan lebih mendasar, hak memperoleh informasi adalah salah satu dari hak asasi manusia, hal ini tercantum dalam Undang-Undang Dasar Negara Republik Indonesia Tahun 1945 Pasal 28 F. Dalam pasal tersebut disebutkan bahwa setiap orang berhak untuk berkomunikasi dan memperoleh informasi untuk mengembangkan pribadi dan lingkungan sosialnya, serta berhak untuk mencari, memperoleh, memiliki, dan menyimpan informasi dengan menggunakan segala jenis saluran yang tersedia.  -->
<!--     </p></center>
                            </div>

                        </div>
                        <div class="mbr-figure" style="width: 30%;">
                            <img src="<?php echo base_url(); ?>assets/home2/modules/ppid/images/wakil.png" alt="" media-simple="true">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div> -->

<!-- <div class="wrapper">
  <div class="zoom-effect">
    <div class="kotak">
      <img src="http://www.malasngoding.com/wp-content/uploads/2016/02/gambar.jpg" />
    </div>
  </div>
</div> -->

<!-- ========================Berita -->

<!-- <section class="featured" style="background-color: white;" data-aos="fade-right">
    <div class="container mb-3 mt-4">
        <div class="row">
         <div class="col-12 text-center"> -->
<!-- <?php foreach ($berita3 as $ka) : ?> -->
<!-- <h2><?= strtoupper($ka->kategori_artikel) ?></h2> -->
<!-- <?php endforeach; ?> -->
<!--         </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card-img">
            <img class="logo-video" src="<?php echo base_url(); ?>assets/tangerangkota/modules/home/berita.png" alt="" style="padding-bottom: 10px;">
        </div>
    </div>
</div> -->

<!-- <div class="container info">
    <div class="row align-items-start">
      <?php


        foreach ($berita3 as $f) :
            // strip tags to avoid breaking any html
            $string = strip_tags($f["isi_berita"]);
            if (strlen($string) > 1000) {

                // truncate string
                $stringCut = substr($string, 0, 1000);
                $endPoint = strrpos($stringCut, ' ');

                //if the string doesn't contain any space then it will cut without word basis.
                $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                // $string .= '... <a href="/this/story">Read More</a>';
            }


        ?> -->
<!-- <div class="col-lg-3 col-md-6 col-sm-12"> -->
<!-- <div class="card berita" style="width: 16.5rem; height: 500px; overflow: hidden; margin-bottom: 50px; background-color: #F0FFFF; border-color: black; border: 1px solid grey; box-shadow: 2px 4px 10px rgba(0,0,0,0.8); padding: 10px; border-radius: 10px;"> -->

<!-- <div class="card berita" style="width: 16.5rem; height: 500px; overflow: hidden; margin-bottom: 50px; background-color: transparent; "> -->
<!-- <a href="<?= base_url('site/detail/' . $f["id_berita"] . '/' . $f["id_kategori"]) ?>" style="text-decoration: none; color: #000000"> -->
<!--    <a href="<?= base_url('site/detail/' . $f["id_berita"]) ?>" style="text-decoration: none; color: #000000">

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

                        <p><?= $string ?>
                        <span><br><br> -->

<!-- <a style="margin-top: 40px; margin-bottom: 10px; float: right" href="<?= base_url('site/detail/' . $f["id_berita"]) ?>">Baca Selanjutnya</a> -->
<!-- <a style="margin-top: 40px; margin-bottom: 10px; float: right" href="<?= base_url('site/detail/' . $f["id_berita"] . '/' . $f["id_kategori"]) ?>">Baca Selanjutnya</a> -->
<!--      </span>
                    </p>
                -->
</div>

<!-- <br> -->
<!--        </a>
        </div>
    </div>
<?php endforeach; ?>
</div>
</div>
</section> -->
<!-- ======================== akhir Berita -->





<!-- ==============================Berita Slider -->
<!-- <section  id="video" class="cid-video mbr-parallax-background mbr-fullscreen" data-rv-view="1620" data-aos="fade-right" style="background-color: white"> -->
<section id="icon-formulir" data-aos="fade-right" style="background-color: white; height: 100%">




    <!-- <div class="container">
    <div class="row">
      <div class="">
        <h2>Video Baznas</h2>
      </div>
    </div>
</div> -->
    <div class="container">
        <div class="">
            <div class="title col-lg-12 col-md-12 col-sm-12">
                <div class="card-img">
                    <img class="logo-video" src="<?php echo base_url(); ?>assets/tangerangkota/modules/home/berita.png" alt="" style="padding-top: -10px">
                </div>
            </div>
            <div class="" data-flickity='{ "wrapAround": true, "autoPlay":1500, "pageDots": false }'>
                <?php foreach ($berita3 as $f) :
                    $string = strip_tags($f["isi_berita"]);
                    if (strlen($string) > 1000) {

                        // truncate string
                        $stringCut = substr($string, 0, 1000);
                        $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                        $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                        // $string .= '... <a href="/this/story">Read More</a>';
                    }
                ?>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <!-- <div class="" style=" overflow: hidden; margin-bottom: 10px;  padding-right: 10px; background-color: red" > -->
                        <div class="img-responsive  " style="width: 100%; height: 500px; overflow: hidden; background-color: transparent;">
                            <a href="<?= base_url('site/detail/' . $f["id_berita"]) ?>" style="text-decoration: none; color: #000000; height: 30%">
                                <!-- <a href="<?= base_url('site/detail/' . $f["id_berita"] . '/' . $f["id_kategori"]) ?>" style="text-decoration: none; color: #000000"> -->

                                <?php if (count($f["path_foto_artikel"]) > 0) {
                                    foreach ($f["path_foto_artikel"] as $k) {
                                ?>
                                        <img class="cv" src="<?= base_url('assets/backend/img/img_berita/' . $k["path_foto_artikel"]) ?>" height="250px">
                                <?php
                                    }
                                } ?>
                                <div class="card-body">
                                    <p><?= date('d M Y H:i:s', strtotime($f["tgl_jam"])) ?></p>
                                    <b class="cv"><?= $f["judul_berita"] ?></b>
                                    <p class="cv" style="margin-top: 10px"><?= $string ?><a href="<?= base_url('site/detail/' . $f["id_berita"]) ?>">Baca Selanjutnya</a>
                                    </p>
                                </div>
                                <!-- <br> -->
                            </a>
                            <span><br><br>

                                <!--  <a style="margin-top: 40px; margin-bottom: 10px; float: right" href="<?= base_url('site/detail/' . $f["id_berita"]) ?>">Baca Selanjutnya</a> -->
                                <!-- <a style="margin-top: 40px; margin-bottom: 10px; float: right" href="<?= base_url('site/detail/' . $f["id_berita"] . '/' . $f["id_kategori"]) ?>">Baca Selanjutnya</a> -->
                            </span>
                        </div>

                        <!-- <div class="card-content"> -->
                        <!-- <p class="d-inline" style="margin-left: 0px;">DINAS KESEHATAN | <?= date('d M Y H:i:s', strtotime($c->tgl_jam)) ?></p> -->
                        <!-- <span class="card-title">DINKES News | <?= $tv->nama_video ?></span><br> -->
                        <!-- <center> <a href="" class="btn btn-success btn-sm mt-2" target="__blank"> -->
                        <!-- <i style="background-color: blue" ></i> Lihat Video -->
                        <!-- </a></center> -->
                        <!-- <p class="d-inline" style="margin-left: 70px;">DINKES | <?= date('d M Y H:i:s', strtotime($tv->tgl_jam)) ?></p> -->
                        <!-- </div> -->

                        <!-- </div> -->
                        <!-- </div> -->
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<!-- ==============================Akhir Berita Slider -->


<!-- ==============================FOto -->
<!-- <section  id="video" class="cid-video mbr-parallax-background mbr-fullscreen" data-rv-view="1620" data-aos="fade-right"> -->




<!-- <div class="container">
    <div class="row">
      <div class="">
        <h2>Video Baznas</h2>
      </div>
    </div>
</div> -->
<!-- <div class="container">
    <div class="">
        <div class="title col-lg-12">
            <div class="card-img">
                <img class="logo-video" src="<?php echo base_url(); ?>assets/tangerangkota/images/title_galeri.png" alt="" style="    padding-left: 60px; padding-bottom: 10px;">
            </div>
        </div>
        <div class="" data-flickity='{ "wrapAround": true }'>
            <?php foreach ($galeri3 as $c) : ?>
                <div class="col-md-6 col-sm-6    ">
                    <div class="carousel-cell" style=" overflow: hidden; margin-bottom: 50px;  padding: 10px; border-radius: 10px;">
                        <div class="" style="margin: 10px; overflow:hidden;">
                            <div class="card-image " >
                                <h3 style="text-transform: uppercase;">
                                    <center>
                                        <b><?= $c["nama_album"] ?></b>
                                    </center>
                                </h3>
                                

                                <?php if (count($c["path_detail_foto"]) > 0) {
                                    foreach ($c["path_detail_foto"] as $k) {
                                ?>
                                      <img src="<?= base_url('assets/backend/img/img_galery/' . $k["path_detail_foto"]) ?>"  width="100%" height="250px">
                                      <p><?= date('d M Y H:i:s', strtotime($c["tgl_jam"])) ?></p>
                                      <?php
                                    }
                                } ?>
                              <center> <a href="#" class="btn btn-success btn-sm mt-2" target="__blank">
                                <i style="background-color: blue" ></i> Lihat Album
                            </a></center>
                        </div>
                    </div>


                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>
</section> -->
<!-- ==============================Foto Galeri -->




<!-- 
<section class="featured" style="background-color: white;" data-aos="fade-right">
  <div class="container mb-3 mt-4">
    <div class="row">
      <div class="col-12 text-center"> -->
<!-- <?php foreach ($berita3 as $ka) : ?> -->
<!-- <h2><?= strtoupper($ka->kategori_artikel) ?></h2> -->
<!-- <?php endforeach; ?> -->
<!--    </div>
    </div>
  </div>
  <div class="row">
                    <div class="col-md-12">
                        <div class="card-img">
                            <img class="logo-video" src="<?php echo base_url(); ?>assets/tangerangkota/images/title_galeri.png" alt="" style="padding-bottom: 10px;">
                        </div>
                    </div>
                </div>
            -->
<!-- <div class="container info">
    <div class="row align-items-start">
      <?php foreach ($berita33 as $f) : ?>
        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="card berita" style="width: 16.5rem; height: 500px; overflow: hidden; margin-bottom: 50px; background-color: #F0FFFF; border-color: black; border: 1px solid grey; box-shadow: 2px 4px 10px rgba(0,0,0,0.8); padding: 10px; border-radius: 10px;">
            <a href="<?= base_url('site/detail/' . $f["id_foto_galery"]) ?>" style="text-decoration: none; color: #000000">

              <?php if (count($f["path_detail_foto"]) > 0) {
                    foreach ($f["path_detail_foto"] as $k) {
                ?>
                  <img src="<?= base_url('assets/backend/img/img_galery/' . $k["path_detail_foto"]) ?>"  width="100%" height="250px">
              <?php
                    }
                } ?>
              <div class="card-body" style="text-align: left;" >
                <p><?= date('d M Y H:i:s', strtotime($f["tgl_jam"])) ?></p> -->
<!-- <b><?= $f["judul_berita"] ?></b> -->
<!-- <p><?= $f["isi_berita"] ?></p> -->
<!--       </div>
              
              <br>
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  </center>
</section> -->






<!-- <section id="berita-section" class="services1 cid-news mbr-fullscreen">
    <div class="container">
        <div class="row">
            <div class="col-md-6">

            -->




<!-- <div class="row">
                    <div class="col-md-12">
                        <div class="card-img">
                            <img class="logo-video" src="<?php echo base_url(); ?>assets/tangerangkota/modules/home/rilis.png" alt="" style="padding-bottom: 10px;">
                        </div>
                    </div>
                </div>
            -->
<!-- <div class="row">
                    <div class="col-md-12">
                        <div id="owl-carousel-siaran" class="owl-carousel owl-theme">
                            <?php
                            $link_kota = 'https://tangerangkota.go.id/';
                            if (!empty($siaran)) {
                                foreach ($siaran as $ber) {
                            ?>
                                    <div class="item">
                                        <div class="rny-post-slide">
                                            <div class="post-img">
                                                <a href="<?php echo base_url('artikel/detail/') . $ber['id_berita'] . '/' . $ber['slug']; ?>">
                                                    <img src="<?php echo $link_kota . $ber['foto']; ?>">
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <div class="post-date">
                                                    <span class="month"><?php echo indonesian_date($ber['created_on']); ?></span>
                                                </div>
                                                <h5 class="post-title"><a href="<?php echo base_url('artikel/detail/') . $ber['id_berita'] . '/' . $ber['slug']; ?>"><?php echo $ber['judul']; ?></a></h5>

                                                <div class="post-description" style="overflow: hidden;
                                                                        text-overflow: ellipsis;
                                                                        display: -webkit-box;
                                                                        -webkit-line-clamp: 8; 
                                                                        -webkit-box-orient: vertical;">
                                                    <?php echo $ber['intro']; ?>
                                                </div>

                                                <span class="rny-bacalagi"><a href="<?php echo base_url('artikel/detail/') . $ber['id_berita'] . '/' . $ber['slug']; ?>">Selengkapnya</a></span>
                                            </div>
                                        </div>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div> -->
<!-- </div> -->

<!-- <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-img">
                            <img class="logo-video" src="<?php echo base_url(); ?>assets/tangerangkota/modules/home/berita.png" alt="" style="padding-bottom: 10px;">
                        </div>
                    </div>
                </div> -->

<!--  <div class="container info">
                        <div class="row align-items-start">
                          <?php foreach ($berita3 as $f) : ?>
                            <div class="col-lg-3 col-md-6 col-sm-12">
                              <div class="card berita" style="width: 16rem; height: 450px; overflow: hidden;">
                                <a href="<?= base_url('site/detail/' . $f["id_berita"]) ?>" style="text-decoration: none; color: #000000">

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
                                    <p><?= $f["isi_berita"] ?></p>
                                  </div>
                                </a>
                              </div>
                            </div>
                          <?php endforeach; ?>
                        </div>
                    </div> -->

<!--  <div class="row">
                    <div class="col-md-12">
                        <div id="owl-carousel-berita" class="owl-carousel owl-theme"> -->
<!--   <?php
        if (!empty($berita2)) {
            foreach ($berita2 as $ber) {
                // var_dump($ber);
                // die();
        ?> -->
<!-- <div class="item"> -->
<!--  <div class="rny-post-slide">
                                            <div class="post-img">
                                                <a href="<?php echo base_url('artikel/detail/') . $ber['id_berita'] . '/' . $ber['slug']; ?>">
                                                    <img src="<?php echo $link_kota . $ber['foto']; ?>">
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <div class="post-date">
                                                    <span class="month"><?php echo indonesian_date($ber['created_on']); ?></span>
                                                </div>
                                                <h5 class="post-title"><a href="<?php echo base_url('artikel/detail/') . $ber['id_berita'] . '/' . $ber['slug']; ?>"><?php echo $ber['judul']; ?></a></h5>

                                                <div class="post-description" style="overflow: hidden;
                                                                        text-overflow: ellipsis;
                                                                        display: -webkit-box;
                                                                        -webkit-line-clamp: 8; 
                                                                        -webkit-box-orient: vertical;">
                                                    <?php echo $ber['tgl_jam']; ?>
                                                </div>

                                                <span class="rny-bacalagi"><a href="<?php echo base_url('artikel/detail/') . $ber['id_berita'] . '/' . $ber['slug']; ?>">Selengkapnya</a></span>
                                            </div>
                                        </div>
                                    </div>
                            <?php }
                    } ?>
                        </div>
                    </div> -->
<!--        </div>
            </div>


        </div>
    </div>
</section> -->

<!-- <section id="berita-section" class="services1 cid-news mbr-fullscreen">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-img">
                            <img class="logo-video" src="<?php echo base_url(); ?>assets/tangerangkota/modules/home/rilis.png" alt="" style="padding-bottom: 10px;">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div id="owl-carousel-siaran" class="owl-carousel owl-theme">
                            <?php
                            $link_kota = 'https://tangerangkota.go.id/';
                            if (!empty($siaran)) {
                                foreach ($siaran as $ber) {
                            ?>
                                    <div class="item">
                                        <div class="rny-post-slide">
                                            <div class="post-img">
                                                <a href="<?php echo base_url('artikel/detail/') . $ber['id_berita'] . '/' . $ber['slug']; ?>">
                                                    <img src="<?php echo $link_kota . $ber['foto']; ?>">
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <div class="post-date">
                                                    <span class="month"><?php echo indonesian_date($ber['created_on']); ?></span>
                                                </div>
                                                <h5 class="post-title"><a href="<?php echo base_url('artikel/detail/') . $ber['id_berita'] . '/' . $ber['slug']; ?>"><?php echo $ber['judul']; ?></a></h5>

                                                <div class="post-description" style="overflow: hidden;
                                                                        text-overflow: ellipsis;
                                                                        display: -webkit-box;
                                                                        -webkit-line-clamp: 8; 
                                                                        -webkit-box-orient: vertical;">
                                                    <?php echo $ber['intro']; ?>
                                                </div>

                                                <span class="rny-bacalagi"><a href="<?php echo base_url('artikel/detail/') . $ber['id_berita'] . '/' . $ber['slug']; ?>">Selengkapnya</a></span>
                                            </div>
                                        </div>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-img">
                            <img class="logo-video" src="<?php echo base_url(); ?>assets/tangerangkota/modules/home/berita.png" alt="" style="padding-bottom: 10px;">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div id="owl-carousel-berita" class="owl-carousel owl-theme">
                            <?php
                            if (!empty($berita)) {
                                foreach ($berita as $ber) {
                            ?>
                                    <div class="item">
                                        <div class="rny-post-slide">
                                            <div class="post-img">
                                                <a href="<?php echo base_url('artikel/detail/') . $ber['id_berita'] . '/' . $ber['slug']; ?>">
                                                    <img src="<?php echo $link_kota . $ber['foto']; ?>">
                                                </a>
                                            </div>
                                            <div class="post-content">
                                                <div class="post-date">
                                                    <span class="month"><?php echo indonesian_date($ber['created_on']); ?></span>
                                                </div>
                                                <h5 class="post-title"><a href="<?php echo base_url('artikel/detail/') . $ber['id_berita'] . '/' . $ber['slug']; ?>"><?php echo $ber['judul']; ?></a></h5>

                                                <div class="post-description" style="overflow: hidden;
                                                                        text-overflow: ellipsis;
                                                                        display: -webkit-box;
                                                                        -webkit-line-clamp: 8; 
                                                                        -webkit-box-orient: vertical;">
                                                    <?php echo $ber['intro']; ?>
                                                </div>

                                                <span class="rny-bacalagi"><a href="<?php echo base_url('artikel/detail/') . $ber['id_berita'] . '/' . $ber['slug']; ?>">Selengkapnya</a></span>
                                            </div>
                                        </div>
                                    </div>
                            <?php }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section> -->
<!-- <section>
    <div class="col-lg-12" >
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active" style="width: 30%" >
      <?php foreach ($baznastv as $tv) : ?>
          <div class="col-lg-12 col-md-12 col-sm-12 justify-content-center">
            <div class="carousel-cell">
              <div class="" style="margin: 10px; overflow:hidden;">
                <div class="card-image embed-responsive">
                  <div class="embed-responsive embed-responsive-16by9">
                    <iframe width="350" height="200" style="overflow-x: hidden;" src="<?= $tv->link_video ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                  </div>
                </div>

                <div class="card-content m-2">
                  <span class="card-title">Baznas News | <?= $tv->nama_video ?></span><br>
                  <a href="<?= $tv->link_video ?>" class="btn btn-success btn-sm mt-2">
                    <i></i> Lihat Video
                  </a>
                  <p class="d-inline" style="margin-left: 70px;">Baznas Tv | <?= date('d M Y H:i:s', strtotime($tv->tgl_jam)) ?></p>
                </div>

              </div>
            </div>
          </div>
        <?php endforeach; ?>
    </div>
    <div class="carousel-item" style="width: 30%">
      <img src="<?php echo base_url(); ?>assets/home2/modules/ppid/images/wakil.png" class="d-block w-100" alt="gambar">
    </div>
    <div class="carousel-item" style="width: 30%">
      <img src="<?php echo base_url(); ?>assets/home2/modules/ppid/images/wakil.png" class="d-block w-100" alt="gambar">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</div>
</section> -->

<!-- ==============================Video Slider -->

<!-- <section  id="video" class="cid-video mbr-parallax-background mbr-fullscreen" data-rv-view="1620" data-aos="fade-right"> -->
<section id="icon-formulir" class="cid-icon-formulir" data-rv-view="1620" style="" data-aos="fade-right">




    <!-- <div class="container">
    <div class="row">
      <div class="">
        <h2>Video Baznas</h2>
      </div>
    </div>
</div> -->
    <div class="container">
        <!--  <div class="row">
        <div class="title col-md-6">
            <div class="card-img">
                <div class="card-img">
                    <img class="logo-video" src="<?php echo base_url(); ?>assets/tangerangkota/images/title_video.png" alt="" style="    padding-left: 60px; padding-bottom: 10px;">
                </div>
            </div>
        </div>
        <div class="title col-6">
            <div class="card-img">
                <img class="logo-video" src="<?php echo base_url(); ?>assets/tangerangkota/images/title_galeri.png" alt="" style="    padding-left: 60px; padding-bottom: 10px;">
            </div>
        </div>
    </div> -->

        <!--Left-->
        <!-- ===================== -->
        <div class="row">
            <div class="title col-12 col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="card-img">
                    <div class="card-img">
                        <img class="logo-video" src="<?php echo base_url(); ?>assets/tangerangkota/images/title_video.png" alt="" style="    padding-left: 60px; padding-bottom: 10px;">
                    </div>
                </div>


                <?php
                foreach ($video_dinkes as $k => $v) :
                    if ($k == '0') :
                ?>
                        <div class="rny-vid-container">
                            <iframe id="rny_vid_frame" class="img-responsive img-thumbnail" src="<?= $v->link_video ?>?autoplay=0&rel=0&showinfo=0&autohide=1" frameborder="0" width="560" height="315"></iframe>
                        </div>
                <?php endif;
                endforeach;
                ?>

                <div class="logo-liputan" style="padding-top: 10px; padding-bottom: 10px;">
                    <!-- <img class="logo-liputan" src="<?php echo base_url(); ?>assets/tangerangkota/images/logo_tngtv.png" alt=""> -->
                </div>

                <div class="rny-vid-list-container">
                    <div class="rny-vid-list">
                        <?php foreach ($video_dinkes as $k => $v) : ?>
                            <div class="rny-vid-item" onClick="document.getElementById('rny_vid_frame').src='<?= $v->link_video ?>?autoplay=1&rel=0&showinfo=0&autohide=1'">
                                <div class="rny-thumb" style="background: url('https://i.ytimg.com/vi/<?php echo getidyoutube($v->link_video); ?>/hqdefault.jpg');height: 100px;background-size: cover;">
                                </div>
                                <div class="desc" style="text-align: center;">
                                    <a href="javascript:void" title="<?php echo text($v->nama_video); ?>" style="font-weight: 700;font-size:14px;color: #000">
                                        <?php echo text(readMore($v->nama_video, 35)); ?>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- LEFT AND RIGHT ARROWS -->
                <div class="rny-arrows">
                    <div class="rny-arrow-left"><i class="fa fa-chevron-left fa-lg"></i></div>
                    <div class="rny-arrow-right"><i class="fa fa-chevron-right fa-lg"></i></div>
                </div>
                <hr><br>
            </div>



            <div class="title col-12 col-lg-6 col-md-12 col-sm-12 c">
                <div class="card-img">
                    <img class="logo-video" src="<?php echo base_url(); ?>assets/tangerangkota/images/title_galeri.png" alt="" style="    padding-left: 60px; padding-bottom: 40px;">
                </div>

                <?php
                foreach ($galeri4 as $k => $v) :
                    if ($k == '0') :
                ?>
                        <div class="">
                            <!-- <iframe id="rny_vid_frame" src="<?= $v->link_video ?>?autoplay=0&rel=0&showinfo=0&autohide=1" frameborder="0" width="560" height="315"></iframe> -->
                            <img style="padding-top: -90px; max-height: 302px; min-height: 302px" class="img-responsive img-thumbnail" id="rny_vid_frame-humas" src="<?= base_url('assets/backend/img/img_galery/' . $v['path_detail_foto']) ?>" width="590" height="815">
                        </div>
                <?php endif;
                endforeach;
                ?>

                <div class="logo-liputan" style="padding-top: 10px; padding-bottom: 10px;">
                    <!-- <img class="logo-liputan" src="<?php echo base_url(); ?>assets/tangerangkota/images/logo_tngtv.png" alt=""> -->
                </div>

                <div class="rny-vid-list-container-humas">
                    <div class="rny-vid-list-humas">
                        <?php foreach ($galeri4 as $k => $v) : ?>
                            <div class="rny-vid-item" onClick="document.getElementById('rny_vid_frame-humas').src='<?= base_url('assets/backend/img/img_galery/' . $v['path_detail_foto']) ?>'">
                                <div class="rny-thumb" style="height: 100px;background-size: cover;">
                                    <img style="height: 150px" src="<?= base_url('assets/backend/img/img_galery/' . $v['path_detail_foto']) ?>">
                                </div>
                                <div class="desc" style="text-align: center;">
                                    <a href="javascript:void" title="<?php echo text($v['nama_album']); ?>" style="font-weight: 700;font-size:14px;color: #000">
                                        <?php echo text(readMore($v['nama_album'], 35)); ?>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- LEFT AND RIGHT ARROWS -->
                <div class="rny-arrows">
                    <div class="rny-arrow-left-humas"><i class="fa fa-chevron-left fa-lg"></i></div>
                    <div class="rny-arrow-right-humas"><i class="fa fa-chevron-right fa-lg"></i></div>
                </div>
                <hr>
            </div>









            <!-- 
<div class="col-6 col-md-6">
    <?php
    foreach ($galeri4 as $k => $v) :
        if ($k == '0') :
    ?>
            <div class="rny-vid-container-humas">
                <iframe id="rny_vid_frame-humas" src="<?php echo str_replace('watch?v=', 'embed/', $v['video_url']); ?>?autoplay=0&rel=0&showinfo=0&autohide=1" frameborder="0" width="560" height="315"></iframe>
                <img style="margin-top: -30px"  id="rny_vid_frame-humas"  src="<?= base_url('assets/backend/img/img_galery/' . $v['path_detail_foto']) ?>" height="300 "> -->
            <!-- <img   src="<?= base_url('assets/backend/img/img_galery/12a065cc7f036251dad165ea9f353394.jpeg') ?>" > -->
            <!--  </div>
        <?php endif;
    endforeach;
        ?> -->

            <!--  <div class="logo-liputan" style="padding-top: 10px; padding-bottom: 10px;">
                            <img class="logo-liputan" src="<?php echo base_url(); ?>assets/tangerangkota/images/logo_humas.png" alt="">
                        </div> -->

            <!--      <div class="rny-vid-list-container-humas">
                            <div class="rny-vid-list-humas">
                                <?php foreach ($galeri4 as $k => $v) : ?>
                                    <div class="rny-vid-item" onClick="document.getElementById('rny_vid_frame-humas').src='<?= base_url('assets/backend/img/img_galery/' . $v['path_detail_foto']) ?>'">
                                        <div class="rny-thumb" style="height: 100px;background-size: cover; margin-top: 20px">
                                            <img  style="height: 150px" src="<?= base_url('assets/backend/img/img_galery/' . $v['path_detail_foto']) ?>"  >
                                        </div>
                                        <div class="desc" style="text-align: center;">
                                            <a href="javascript:void"  style="font-weight: 700;font-size:14px;color: #000">
                                                <?php echo text(readMore($v['ket_foto'], 35)); ?>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div> -->

            <!-- LEFT AND RIGHT ARROWS -->
            <!--  <div class="rny-arrows">
                            <div class="rny-arrow-left-humas"><i class="fa fa-chevron-left fa-lg"></i></div>
                            <div class="rny-arrow-right-humas"><i class="fa fa-chevron-right fa-lg"></i></div>
                        </div> -->
        </div>
    </div>
    </div>
</section>
<!-- ======================== AKhir video -->



<!-- ==============================Video Slider -->

<!-- <section  id="video" class="cid-video mbr-parallax-background mbr-fullscreen" data-rv-view="1620" data-aos="fade-right"> -->
<!-- <section  id="icon-formulir" class="cid-icon-formulir" data-rv-view="1620" style="" data-aos="fade-right">
            -->



<!-- <div class="container">
    <div class="row">
      <div class="">
        <h2>Video Baznas</h2>
      </div>
    </div>
</div> -->
<!-- <div class="container">
    <div class="">
        <div class="title col-lg-12">
            <div class="card-img">
                <img class="logo-video" src="<?php echo base_url(); ?>assets/tangerangkota/images/title_video.png" alt="" style="    padding-left: 60px; padding-bottom: 10px;">
            </div>
        </div>
        <div class="" data-flickity='{ "wrapAround": true,  "autoPlay":1500, "pageDots": false }'>
            <?php foreach ($video_dinkes as $tv) : ?>
              <div class="col-md-8 col-sm-8    ">
                <div class="carousel-cell" style=" overflow: hidden; margin-bottom: 50px; background-color: transparent;    padding: 10px;">
                  <div class="" style="margin: 10px; overflow:hidden;">
                    <div class="card-image ">
                        <h6 style="text-transform: uppercase;">
                            <center>
                                <b><?= $tv->nama_video ?></b>
                            </center>
                        </h6>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe width="250" height="100" style="overflow-x: hidden; " src="<?= $tv->link_video ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>

                    <div class="card-content">
                        <p class="d-inline" style="margin-left: 0px;">DINAS KESEHATAN | <?= date('d M Y H:i:s', strtotime($tv->tgl_jam)) ?></p> -->
<!-- <span class="card-title">DINKES News | <?= $tv->nama_video ?></span><br> -->
<!--     <center>
                            <a href="<?= $tv->link_video ?>" class="btn btn-success btn-sm mt-2" target="__blank">
                                <i style="background-color: blue" ></i> Lihat Video
                            </a>
                        </center> -->
<!-- <p class="d-inline" style="margin-left: 70px;">DINKES | <?= date('d M Y H:i:s', strtotime($tv->tgl_jam)) ?></p> -->
<!--                </div>

                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</div>
</div>

</div>
</div>
</section> -->
<!-- ======================== AKhir video -->



<!-- ==============================Video Slider -->

<!-- <section  id="video" class="cid-video mbr-parallax-background mbr-fullscreen" data-rv-view="1620" data-aos="fade-right" style="background-color: white"> -->
<section id="icon-formulir" class="cid-icon-formulir" data-rv-view="1620" data-aos="fade-right" style="background-color: white">



    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="background-color: transparent;">
                    <div class="card-header bg-transparent">
                        <h3 class="align-center">
                            Media Sosial
                        </h3>
                    </div>
                    <div class="card-body bg-transparent">
                        <div class="row">
                            <div class="col-md-4 align-center">
                                <!-- <img class="medsos" src="<?= base_url('assets/img/logo kecil2-11-11.png') ?>" alt="">
                                <hr> -->
                                <!--   <h3>Kota Tangerang</h3>
                            <div class="row">
                                <a class="align-center col-md-4" target="_blank" href="https://id-id.facebook.com/kotatng/">
                                    <img class="medsoss" src="<?= base_url('assets/img/sosmed-07.png') ?>" alt="">
                                </a>
                                <a class="align-center col-md-4" target="_blank" href="https://www.instagram.com/tangerangkota/?hl=id">
                                    <img class="medsoss" src="<?= base_url('assets/img/sosmed-08.png') ?>" alt="">
                                </a>
                                <a class="align-center col-md-4" target="_blank" href="https://twitter.com/Kota_Tangerang">
                                    <img class="medsoss" src="<?= base_url('assets/img/sosmed-09.png') ?>" alt="">
                                </a>
                            </div> -->
                            </div>
                            <div class="col-lg-4 align-center">
                                <!-- <img class="medsos" src="<?php echo base_url(); ?>assets/img/banner/Dinkes_LOGO.png" alt=""> -->
                                <!-- <hr> -->
                                <h3>DINAS KESEHATAN</h3>
                                <div class="row">
                                    <a class="align-center col-md-6" target="_blank" href="https://www.youtube.com/channel/UCKGFxu_Sb2LFwMoi5h_zDow">
                                        <img class="medsoss" src="<?= base_url('assets/img/sosmed-10.png') ?>" alt="">
                                    </a>
                                    <!-- <a class="align-center col-md-4" target="_blank" href="https://twitter.com/HumasTangerang"> -->
                                    <!-- <img class="medsoss" src="<?= base_url('assets/img/sosmed-09.png') ?>" alt=""> -->
                                    <!-- </a> -->
                                    <a class="align-center col-md-4" target="_blank" href="https://www.instagram.com/dinkes.kotatangerang/?hl=id">
                                        <img class="medsoss" src="<?= base_url('assets/img/sosmed-08.png') ?>" alt="">
                                    </a>
                                </div>
                            </div>
                            <!-- <div class="col-md-4 align-center">
                            <img class="medsos" src="<?= base_url('assets/img/logo kecil2-06.png') ?>" alt="">
                            <hr>
                            <h3>Tangerang TV</h3>
                            <div class="row">
                                <a class="align-center col-md-12" target="_blank" href="https://www.youtube.com/channel/UCJLaDC3R7kVrAV3zBIP53zQ">
                                    <img class="medsoss" src="<?= base_url('assets/img/sosmed-10.png') ?>" alt="">
                                </a>
                            </div>
                        </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- <div class="container">
    <div class="row">
      <div class="">
        <h2>Video Baznas</h2>
      </div>
    </div>
</div> -->
    <!-- <div class="container">
    <div class="">
        <div class="title col-lg-12">
            <div class="card-img">
                <img class="logo-video" src="<?php echo base_url(); ?>assets/tangerangkota/images/title_video.png" alt="" style="    padding-left: 60px; padding-bottom: 10px;">
            </div>
        </div>
        <div class="" data-flickity='{ "wrapAround": true }'>
            <?php foreach ($video_dinkes as $tv) : ?>
              <div class="col-md-8 col-sm-8    ">
                <div class="carousel-cell" style=" overflow: hidden; margin-bottom: 50px; background-color: transparent; border-color: black;   padding: 10px;">
                  <div class="" style="margin: 10px; overflow:hidden;">
                    <div class="card-image ">
                        <h3 style="text-transform: uppercase;">
                            <center>
                                <b><?= $tv->nama_video ?></b>
                            </center>
                        </h3>
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe width="250" height="100" style="overflow-x: hidden; border-radius: 10px" src="<?= $tv->link_video ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>

                    <div class="card-content">
                        <p class="d-inline" style="margin-left: 0px;">DINAS KESEHATAN | <?= date('d M Y H:i:s', strtotime($tv->tgl_jam)) ?></p> -->
    <!-- <span class="card-title">DINKES News | <?= $tv->nama_video ?></span><br> -->
    <!--  <center>
                            <a href="<?= $tv->link_video ?>" class="btn btn-success btn-sm mt-2" target="__blank">
                                <i style="background-color: blue" ></i> Lihat Video
                            </a>
                        </center> -->
    <!-- <p class="d-inline" style="margin-left: 70px;">DINKES | <?= date('d M Y H:i:s', strtotime($tv->tgl_jam)) ?></p> -->
    <!--            </div>

                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</div>
</div>

</div>
</div> -->
</section>




<section id="icon-formulir" data-aos="fade-right" style="background-color:white; height: 100%; align-content: center;">




    <!-- <div class="container">
    <div class="row">
      <div class="">
        <h2>Video Baznas</h2>
      </div>
    </div>
</div> -->
    <center>
        <div class="container">
            <div class="title col-lg-12 col-md-12 col-sm-12">
                <div class="card-img">
                    <img class="logo-video mitrastyle" src="<?php echo base_url(); ?>assets/tangerangkota/images/mitra_kerja.png" alt="" style="padding-top: -10px; width: 30%; padding-bottom: 40px;">
                </div>
            </div>
            <div class="" data-flickity='{ "wrapAround": true, "autoPlay":1500, "pageDots": false }' style="width: 80%">
                <?php foreach ($mitra as $f) :
                    // $string = strip_tags($f["isi_mitra"]);
                    // if (strlen($string) > 1000) {

                    // truncate string
                    // $stringCut = substr($string, 0, 1000);
                    // $endPoint = strrpos($stringCut, ' ');

                    //if the string doesn't contain any space then it will cut without word basis.
                    // $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                    // $string .= '... <a href="/this/story">Read More</a>';
                    // }
                ?>
                    <div class="col-md-4 col-sm-6 col-xs-12" style="background-color: transparent;">
                        <!-- <div class="" style=" overflow: hidden; margin-bottom: 10px;  padding-right: 10px; background-color: red" > -->
                        <!-- <div class="" style="width: 100%;  overflow: hidden; background-color: red;"> -->
                        <a target="__blank" href="<?= ($f["link_mitra"]) ?>" style="text-decoration: none; color: #000000;">
                            <!-- <a href="<?= base_url('site/detail/' . $f["id_berita"] . '/' . $f["id_kategori"]) ?>" style="text-decoration: none; color: #000000"> -->

                            <?php if (count($f["path_gambar_mitra"]) > 0) {
                                foreach ($f["path_gambar_mitra"] as $k) {
                            ?>
                                    <img class="mitrastyle" src="<?= base_url('assets/backend/img/img_mitra/' . $k["path_gambar_mitra"]) ?>" height="100px" width="30%">
                            <?php
                                }
                            } ?>

                            <!-- <br> -->
                        </a>
                        <span><br><br>

                            <!--  <a style="margin-top: 40px; margin-bottom: 10px; float: right" href="<?= base_url('site/detail/' . $f["id_berita"]) ?>">Baca Selanjutnya</a> -->
                            <!-- <a style="margin-top: 40px; margin-bottom: 10px; float: right" href="<?= base_url('site/detail/' . $f["id_berita"] . '/' . $f["id_kategori"]) ?>">Baca Selanjutnya</a> -->
                        </span>
                        <!-- </div> -->

                        <!-- <div class="card-content"> -->
                        <!-- <p class="d-inline" style="margin-left: 0px;">DINAS KESEHATAN | <?= date('d M Y H:i:s', strtotime($c->tgl_jam)) ?></p> -->
                        <!-- <span class="card-title">DINKES News | <?= $tv->nama_video ?></span><br> -->
                        <!-- <center> <a href="" class="btn btn-success btn-sm mt-2" target="__blank"> -->
                        <!-- <i style="background-color: blue" ></i> Lihat Video -->
                        <!-- </a></center> -->
                        <!-- <p class="d-inline" style="margin-left: 70px;">DINKES | <?= date('d M Y H:i:s', strtotime($tv->tgl_jam)) ?></p> -->
                        <!-- </div> -->

                        <!-- </div> -->
                        <!-- </div> -->
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </center>
</section>




<!-- <section id="video" class="cid-video mbr-parallax-background mbr-fullscreen" data-rv-view="1620">
    <div class="mbr-overlay" style="opacity: 0.50;background-color: rgba(239, 240, 240, 0.75);"></div>

    <div class="container">
        <div class="row"> -->
<!--Titles-->
<!-- <div class="title col-12">
                <div class="card-img">
                    <img class="logo-video" src="<?php echo base_url(); ?>assets/tangerangkota/images/title_video.png" alt="" style="    padding-left: 60px; padding-bottom: 10px;">
                </div>
            </div> -->
<!--Left-->
<!-- ===================== -->
<!--   <div class="col-12 col-md-6">
                <?php
                foreach ($video_tng as $k => $v) :
                    if ($k == '0') :
                ?> -->
<!--          <div class="rny-vid-container">
                            <iframe id="rny_vid_frame" src="<?php echo str_replace('watch?v=', 'embed/', $v['video_url']); ?>?autoplay=0&rel=0&showinfo=0&autohide=1" frameborder="0" width="560" height="315"></iframe>
                        </div>
                <?php endif;
                endforeach;
                ?>

                <div class="logo-liputan" style="padding-top: 10px; padding-bottom: 10px;">
                    <img class="logo-liputan" src="<?php echo base_url(); ?>assets/tangerangkota/images/logo_tngtv.png" alt="">
                </div>
            -->
<!--   <div class="rny-vid-list-container">
                    <div class="rny-vid-list">
                        <?php foreach ($video_tng as $k => $v) : ?>
                            <div class="rny-vid-item" onClick="document.getElementById('rny_vid_frame').src='<?php echo str_replace('watch?v=', 'embed/', $v['video_url']); ?>?autoplay=1&rel=0&showinfo=0&autohide=1'">
                                <div class="rny-thumb" style="background: url('https://i.ytimg.com/vi/<?php echo getidyoutube($v['video_url']); ?>/hqdefault.jpg');height: 100px;background-size: cover;">
                                </div>
                                <div class="desc" style="text-align: center;">
                                    <a href="javascript:void" title="<?php echo text($v['caption']); ?>" style="font-weight: 700;font-size:14px;color: #000">
                                        <?php echo text(readMore($v['caption'], 35)); ?>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div> -->

<!-- LEFT AND RIGHT ARROWS -->
<!--    <div class="rny-arrows">
                    <div class="rny-arrow-left"><i class="fa fa-chevron-left fa-lg"></i></div>
                    <div class="rny-arrow-right"><i class="fa fa-chevron-right fa-lg"></i></div>
                </div>

            </div> -->
<!-- ===================== -->
<!--Right-->
<!--  <div class="col-12 col-md-12">
                <?php
                foreach ($video_humas as $k => $v) :
                    if ($k == '0') :
                        // var_dump($video_humas);
                        // die();
                ?> -->
<!--  <div class="rny-vid-container-humas"> -->
<!-- <p><?= $v["judul_berita"] ?></p> -->
<!-- <iframe id="rny_vid_frame-humas" src="<?php echo str_replace('watch?v=', 'embed/', $v['video_url']); ?>?autoplay=0&rel=0&showinfo=0&autohide=1" frameborder="0" width="560" height="315"></iframe> -->
<!-- <iframe id="rny_vid_frame-humas" src="https://www.youtube.com/embed/OZ2GIqfs0SY" frameborder="0" width="560" height="315"></iframe> -->
<!-- <iframe id="rny_vid_frame-humas" src="<?php echo str_replace('watch?v=', 'embed/', $v['video_url']); ?>" frameborder="0" width="560" height="315"></iframe> -->
<!-- </div> -->
<!--   <?php endif;
                endforeach;
        ?> -->

<!-- <div class="logo-liputan" style="padding-top: 10px; padding-bottom: 10px;">
                    <img class="logo-liputan" src="<?php echo base_url(); ?>assets/tangerangkota/images/logo_humas.png" alt="">
                </div>  -->
<!--  <div class="logo-liputan" style="padding-top: 10px; padding-bottom: 10px;">
                    <img class="logo-liputan" src="<?php echo base_url(); ?>assets/img/banner/Dinkes_LOGO.png" alt="">
                </div>

                <div class="rny-vid-list-container-humas">
                    <div class="rny-vid-list-humas">
                        <?php foreach ($video_humas as $k => $v) : ?>
                            <div class="rny-vid-item" onClick="document.getElementById('rny_vid_frame-humas').src='<?php echo str_replace('watch?v=', 'embed/', $v['video_url']); ?>?autoplay=1&rel=0&showinfo=0&autohide=1'">
                                <div class="rny-thumb" style="background: url('https://i.ytimg.com/vi/<?php echo getidyoutube($v['video_url']); ?>/hqdefault.jpg');height: 100px;background-size: cover;">
                                </div>
                                <div class="desc" style="text-align: center;">
                                    <a href="javascript:void" title="<?php echo text($v['caption']); ?>" style="font-weight: 700;font-size:14px;color: #000">
                                        <?php echo text(readMore($v['caption'], 35)); ?>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div> -->

<!-- LEFT AND RIGHT ARROWS -->
<!-- <div class="rny-arrows">
                    <div class="rny-arrow-left-humas"><i class="fa fa-chevron-left fa-lg"></i></div>
                    <div class="rny-arrow-right-humas"><i class="fa fa-chevron-right fa-lg"></i></div>
                </div>

            </div>
        </div>
    </div>
</section> -->

<!-- <section class="mbr-section contacts2 cid-info mbr-fullscreen" id="info">
    <div class="container">
        <div class="media-container-row align-center">
            <div class="card-img">
                <img class="logo-info" style="padding-left: 70px;" src="<?php echo base_url(); ?>assets/tangerangkota/images/title_info.png" alt="">
            </div>
        </div>

        <div class="row align-center">
            <?php
            if (!empty($banner)) {
                foreach ($banner as $b) {
            ?>
                    <div class="col-lg-12 col-md-12 col-sm-12 p-5">
                        <div class="home-container">
                            <img src="<?php echo $link_kota . $b['foto']; ?>" alt="IMG-<?php echo $b['slug']; ?>" class="home-image">

                            <?php $b['tipe'] == '0' ? $link = base_url() . 'home/detail_banner/' . $b['id_banner_berita'] . '/' . $b['slug'] : $link = $b['link']; ?>
                            <div class="home-overlay">
                                <a href="<?php echo $link; ?>" target="_blank">
                                    <div class="home-text"><?php echo $b['judul']; ?></div>
                                </a>
                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
</section> -->


<!-- <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-transparent">
                    <h3 class="align-center">
                        Media Sosial
                    </h3>
                </div>
                <div class="card-body bg-transparent">
                    <div class="row">
                        <div class="col-md-4 align-center"> -->
<!-- <img class="medsos" src="<?= base_url('assets/img/logo kecil2-11-11.png') ?>" alt="">
                                <hr> -->
<!--   <h3>Kota Tangerang</h3>
                            <div class="row">
                                <a class="align-center col-md-4" target="_blank" href="https://id-id.facebook.com/kotatng/">
                                    <img class="medsoss" src="<?= base_url('assets/img/sosmed-07.png') ?>" alt="">
                                </a>
                                <a class="align-center col-md-4" target="_blank" href="https://www.instagram.com/tangerangkota/?hl=id">
                                    <img class="medsoss" src="<?= base_url('assets/img/sosmed-08.png') ?>" alt="">
                                </a>
                                <a class="align-center col-md-4" target="_blank" href="https://twitter.com/Kota_Tangerang">
                                    <img class="medsoss" src="<?= base_url('assets/img/sosmed-09.png') ?>" alt="">
                                </a>
                            </div> -->
<!--  </div>
                        <div class="col-lg-4 align-center"> -->
<!-- <img class="medsos" src="<?php echo base_url(); ?>assets/img/banner/Dinkes_LOGO.png" alt=""> -->
<!-- <hr> -->
<!--  <h3>DINAS KESEHATAN</h3>
                            <div class="row">
                                <a class="align-center col-md-6" target="_blank" href="https://www.youtube.com/channel/UCKGFxu_Sb2LFwMoi5h_zDow">
                                    <img class="medsoss" src="<?= base_url('assets/img/sosmed-10.png') ?>" alt="">
                                </a> -->
<!-- <a class="align-center col-md-4" target="_blank" href="https://twitter.com/HumasTangerang"> -->
<!-- <img class="medsoss" src="<?= base_url('assets/img/sosmed-09.png') ?>" alt=""> -->
<!-- </a> -->
<!--  <a class="align-center col-md-4" target="_blank" href="https://www.instagram.com/dinkes.kotatangerang/?hl=id">
                                        <img class="medsoss" src="<?= base_url('assets/img/sosmed-08.png') ?>" alt="">
                                    </a>
                                </div>
                            </div> -->
<!-- <div class="col-md-4 align-center">
                            <img class="medsos" src="<?= base_url('assets/img/logo kecil2-06.png') ?>" alt="">
                            <hr>
                            <h3>Tangerang TV</h3>
                            <div class="row">
                                <a class="align-center col-md-12" target="_blank" href="https://www.youtube.com/channel/UCJLaDC3R7kVrAV3zBIP53zQ">
                                    <img class="medsoss" src="<?= base_url('assets/img/sosmed-10.png') ?>" alt="">
                                </a>
                            </div>
                        </div> -->
<!--  </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- <hr> -->
<!-- <section id="struktur" class="cid-struktur mbr-fullscreen" data-rv-view="1620"> -->
<!-- <section id="icon-formulir" class="cid-icon-formulir" data-rv-view="1620" style=""> -->
<!-- <div class="container align-center"> -->
<!-- <div class="media-container-row align-center">
			<div class="row justify-content-md-center" style="padding-top:50px; padding-bottom: 50px;">
				<h3 class="mbr-section-title mbr-bold mbr-fonts-style">
					STRUKTUR ORGANISASI
				</h3>
			</div>
		</div> -->

<!--    <div class="media-container-row align-center">
            <div class="card-wrapper">
                <div class="card-img">
                    <?php foreach ($profil_image as $row) { ?> -->
<!-- <div class="col-lg-3 col-md-4 col-6">
						<button type="button" onclick='del("<?= $row->isi ?>")' class="btn btn-danger btn-sm btn-block"><i class="fas fa-fw fa-trash"></i></button>
						<a href="javascript:void(0)" onclick="magnify('<?= $row->isi ?>')" class="d-block mb-4 h-100">
							<img class="img-fluid img-responsive img-thumbnail" src="<?php echo base_url('assets/media/image/') . $row->isi ?>" alt="">
						</a>
					</div> -->
<!--  <img src="<?php echo base_url('assets/media/image/') . $row->isi ?>" media-simple="true" style="width: 100%;">

                    <?php } ?> -->
<!-- <img src="<?php echo base_url(); ?>assets/home2/modules/ppid/images/struktur_ppid.png" media-simple="true" style="width: 100%;"> -->
<!--  </div>
        </div>
    </div>
    <div class="media-container-row">
        <div class="col-md-6"> -->
<!-- <?php foreach (@$kepwal as $row) { ?>
                <a href="<?php echo base_url('assets/media/image/') . $row->isi ?>" class="text-dark">
                    <img style="width:20%; margin:auto;" src="https://img.icons8.com/fluent/48/000000/file.png" alt="">
                    <p><span>Keputusan Walikota Kota Tangerang</span><br><span>Tentang Struktur Organisasi, Uraian Tugas dan Fungsi</span></p>
                </a>
                <?php } ?> -->
<!-- </div> -->
<!--  <div class="col-md-6">
                <img src="<?php echo base_url(); ?>assets/img/banner/Dinkes_LOGO.png" style="width:50%; margin:auto;" alt="" media-simple="true">
            </div> -->
<!--  </div>
    </div>
</section> -->
<hr>
<!-- <section id="visi-misi" class="cid-visi-misi mbr-fullscreen bg-white" data-rv-view="1620"> -->
<!-- <section id="icon-formulir" class="cid-icon-formulir" data-rv-view="1620" style="background-color: white">
    <div class="container align-center">
        <div class="media-container-row align-center"> -->
<!-- <div class="row float-center justify-content-md-center" style="width:100%; margin:auto; padding-top:50px;padding-bottom: 50px;">
				<h2 class="mbr-section-title mbr-bold mbr-fonts-style">
					<strong>Visi dan Misi PPID</strong>
                </h2>
			</div>
            <img class="float-right" src="<?php echo base_url(); ?>assets/img/banner/PPID LOGO.png" style="width:150px; position:absolute; right: 10px;top: 28px;" alt="" media-simple="true"> -->
<!-- </div>
        <div class="media-container-row align-center">
            <div class="row justify-content-md-center" style="text-align:justify; color: #000000;">
                <h4 class="mbr-section-title mbr-fonts-style">
                    <?php foreach ($visi as $row) { ?>
                        <img src="<?php echo base_url('assets/media/image/') . $row->isi ?>" media-simple="true" style="width: 100%;">

                    <?php } ?>
                </p>
            </h4>
        </div>
    </div>
</div>
</section> -->
<hr>
<!-- <section id="maklumat" class="cid-struktur mbr-fullscreen" data-rv-view="1620"> -->
<!-- <section id="icon-formulir" class="cid-icon-formulir" data-rv-view="1620" style="">
    <div class="container align-center">


        <div class="media-container-row align-center">
            <div class="card-wrapper">
                <div class="card-img" media-simple="true" style="width: 100%;">
                    <?php foreach ($maklumat as $row) { ?>
                        <img src="<?php echo base_url('assets/media/image/') . $row->isi ?>" media-simple="true" style="width: 100%;">
                        <?php } ?> -->
<!-- <?= $maklumat['isi'] ?> -->
<!-- <img src="<?php echo base_url(); ?>assets/home2/modules/ppid/images/struktur_ppid.png" media-simple="true" style="width: 100%;"> -->
<!--    </div>
            </div>
        </div>
    </div>
</section> -->

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
<!-- <section id="icon" class="cid-icon" data-rv-view="1620"> -->
<!--   <section id="icon-formulir" class="cid-icon-formulir" data-rv-view="1620" style="background-color: white">
        <div class="container align-center">
            <div class="media-container-row">
                <div class="col-lg-4 col-md-6 col-sm-12 p-5">
                    <div class="card-wrapper">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" class="text-reset">
                            <div class="card-img">
                                <img src="<?php echo base_url(); ?>assets/home2/modules/ppid/images/daftar-ppid-min.png" media-simple="true">
                                <p>Daftar PPID Pembantu</p>
                            </div>
                        </a>
                    </div>
                </div> -->
<!-- <div class="col-lg-4 col-md-12 col-sm-12 p-5">
					<a href="javascript:void(0)" data-toggle="modal" data-target="#strukturModal" class="text-reset">
                        <div class="card-wrapper">
                            <div class="card-img">
                                <img src="<?php echo base_url(); ?>assets/home2/modules/ppid/images/susunan-organisasi-min.png" media-simple="true">
                                <p>Susunan Organisasi Tugas dan Fungsi</p>
                            </div>
                        </div>
					</a>
                </div> -->
<!--  <div class="col-lg-4 col-md-6 col-sm-12 p-5">
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#perwalModal" class="text-reset">
                        <div class="card-wrapper">
                            <div class="card-img">
                                <img src="<?php echo base_url(); ?>assets/home2/modules/ppid/images/keputusan-min.png" media-simple="true">
                                <p>Keputusan Walikota</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </section> -->

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
            <!-- <div class="col-md-6">
                <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" class="text-reset">
                    <img src="<?php echo base_url(); ?>assets/img/banner/Logo-Skpd.png" style="width:60%; margin:auto;" alt="" media-simple="true">
                </a>
            </div> -->
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
                            <!-- <iframe style="height:450px; width:100%; overflow:x-hidden;" src="<?php echo base_url('assets/media/image/') . $row->isi ?>" frameborder="0"></iframe> -->
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