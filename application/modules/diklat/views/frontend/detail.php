
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<!-- <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flickity@2/dist/flickity.pkgd.js"> -->
<!-- https://npmcdn.com/flickity@2/dist/flickity.pkgd.js -->

<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<!-- flickity -->
<!-- <link href="<?php echo base_url('assets/home/css/styleslider.css')?>" rel="stylesheet"> -->

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/2.2.2/flickity.css">
<!-- <script type="text/javascript" src="<?php echo base_url('assets/js/script.js')?>"></script> -->
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
        max-width: 30%;
        height: auto;
        margin-left: auto;
        margin-right: auto;
    }
    @media (max-width: 1000px) {

        .logo-video {
            max-width: 45%;
            padding-top: -30px;
            margin-top: 5px
        }
        @media (max-width: 790px) {

            .logo-video {
                max-width: 45%;
                padding-top: -30px;
                margin-top: -20px
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
            @media (max-width: 1200px) {
                .cardberita {
                    width: 13.5rem;
                    font-size: 10px;
                }
            }
            @media (max-width: 990px) {
                .cardberita {
                    width: 16.5rem;
                    font-size: 15px
                }
            }
        </style>

<!-- <style>
    #ppid::after {
        background: rgba(255, 255, 255, 0.92);
        }
    </style> -->
    <!-- <section class="py-5"></section> -->

<!-- 
    <section id="berita-section" class="services1 cid-news mbr-fullscreen" data-aos="fade-right" >
        <div class="container" >
            <div class="row">
                <div class="col-md-12" >
                    <div class="card-img" style="padding-left: 50px">
                        <img class="logo-video" src="<?php echo base_url(); ?>assets/tangerangkota/modules/home/berita.png" alt="" style="padding-bottom: 10px;">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="carousel" data-flickity='{ "wrapAround": true, "autoPlay":2500,  "pageDots": false, "pauseAutoPlayOnHover": false }'>
                        <?php foreach ($sliderdetaildiklat as $f) : ?>
                            <?php if (count($f["path_foto_diklat"]) > 0) {
                                foreach ($f["path_foto_diklat"] as $k) {
                                  ?>

                                  <img style=" margin:auto; background-size: cover; background-position: center; width: 100% " src="<?= base_url('assets/backend/img/img_diklat/' . $k["path_foto_diklat"]) ?>"   height="500px" width="100%">
                                  <?php
                              }
                          } ?>
                      <?php endforeach; ?>
                  </div>
              </div>
          </div>
      </section> -->


      <!-- <img class="logo-video" src="<?php echo base_url(); ?>assets/media/image/diklat.png" alt="" style="padding-bottom: 10px;width: 20%; margin-bottom: 40px; margin-top: 50px"> -->

      <section id="berita-section" class="services1 cid-news mbr-fullscreen" data-aos="fade-right" >
        <div class="container" >
            <div class="row">

                <div class="col-md-12" >
                    <div class="card-img logo-video" style="padding-left: 50px">
                        <img class="" src="<?php echo base_url(); ?>assets/media/image/diklat.png" alt="" style="padding-bottom: 10px; padding-top: 30px">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                  <div class="col-lg-12">

                    <div class="carousel" data-flickity='{ "wrapAround": true, "autoPlay":2500,  "pageDots": false, "pauseAutoPlayOnHover": false }'>

                        <?php foreach ($sliderdetaildiklat as $f) : ?>
                            <?php if (count($f["path_foto_diklat"]) > 0) {
                                foreach ($f["path_foto_diklat"] as $k) {
                                  ?>
                                  <img style=" margin:auto; background-size: cover; background-position: center; width: 100% " src="<?= base_url('assets/backend/img/img_diklat/' . $k["path_foto_diklat"]) ?>"   height="500px" width="100%">
                                  <?php
                              }
                          } ?>
                      <?php endforeach; ?>
                  </div>
              </div>
              <hr>
              <br>
              <?php foreach ($detailBerita as $detail) : ?>
                <span data-aos="fade-up">Publish <?= date('d M Y H:i:s', strtotime($detail->tgl_jam)) ?></span><br>
                <h3 class="mt-3"><?= $detail->nama_diklat; ?></h3>
                <p style="text-align: justify-all;">
                    <?= $detail->isi_diklat ?>
                </p>
            <?php endforeach; ?>
        </div>
    </div>
    <hr>
</div>
</div>
</div>
</div>
</section>



<section class="featured"  data-aos="fade-right">
    <div class="container">
        <div class="row">
            <div class="col-md-12" >
                <div class="card-img logo-video" style="padding-left: 50px">
                    <img class="" src="<?php echo base_url(); ?>assets/media/image/artikel_terkait.png" alt="" style="padding-bottom: 10px; padding-top: 30px">
                </div>
            </div>
        </div>
        <!-- <h2 style="padding-top: 20px"><center> Artikel Terkait</center></h2> <br> -->
        <div class="container info" >
            <div class="row align-items-start" >
              <?php 
              foreach ($diklatterkait as $f) : 
                ?>
                <div class="col-lg-3 col-xs-12 col-sm-12">
                    <center>
                        <div class="card berita img-responsive cardberita" style=" height: 350px; margin-bottom: 50px; background-color: white; ">
                            <a href="<?= base_url('diklat/detail/' . $f["id_diklat"]) ?>" style="text-decoration: none; color: #000000">

                             <?php if (count($f["path_foto_diklat"]) > 0) {
                                foreach ($f["path_foto_diklat"] as $k) {
                                  ?>
                                  <img src="<?= base_url('assets/backend/img/img_diklat/' . $k["path_foto_diklat"]) ?>"  width="100%" height="250px">
                                  <?php
                              }
                          } ?>
                          <div class="card-body">
                            <b><center> <?= $f["nama_diklat"] ?></center></b>
                            <span><br><br>
                            </span>
                        </div>
                    </a>
                </div></center>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</section>



<!-- 
<section class="featured"  data-aos="fade-right">
    <div class="container mb-3 mt-4">
        <div class="row">
         <div class="col-12 text-center">
            <?php foreach ($diklatterkait as $ka) : ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
    <h2><center> Artikel Terkait</center></h2> <br>
    <div class="container info" >
        <div class="row align-items-start" >
          <?php 
          foreach ($diklatterkait as $f) : 
            $string = strip_tags($f["isi_diklat"]);
            if (strlen($string) > 100) {
                $stringCut = substr($string, 0, 100);
                $endPoint = strrpos($stringCut, ' ');
                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            }
            ?>
            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                    <div class="card berita" style="width: 16.5rem; height: 500px; overflow: hidden; margin-bottom: 50px; background-color: white; ">
                            <a href="<?= base_url('diklat/detail/' . $f["id_diklat"]) ?>" style="text-decoration: none; color: #000000">
                               <?php if (count($f["path_foto_diklat"]) > 0) {
                                foreach ($f["path_foto_diklat"] as $k) {
                                  ?>
                                  <img src="<?= base_url('assets/backend/img/img_diklat/' . $k["path_foto_diklat"]) ?>"  width="100%" height="250px">
                                  <?php
                              }
                          } ?>
                          <div class="card-body">
                            <b><center> <?= $f["nama_diklat"] ?></center></b>
                            <p><?= $string?>...<a href="<?= base_url('diklat/detail/' . $f["id_diklat"]) ?>"> Baca Selanjutnya</a>
                                <span><br><br>
                                </span>
                            </p>

                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</section> -->



<!-- <section>
    <div class="col-md-12" >
        <br><br>
        <h2><center> Artikel Terkait</center></h2> <br>
        <div class="container info">
            <div class=" ">
              <?php foreach ($berita4 as $f) : ?>
                <div class="col-md-12">
                    <div class="card berita" style="width: 19rem; height: 250px; overflow: hidden; margin-bottom: 50px; background-color: white;  padding: 10px; border-radius: 10px;">
                        <a href="<?= base_url('site/detail/' . $f["id_berita"]) ?>" style="text-decoration: none; color: #000000">

                          <?php if (count($f["path_foto_artikel"]) > 0) {
                            foreach ($f["path_foto_artikel"] as $k) {
                              ?>
                              <img src="<?= base_url('assets/backend/img/img_berita/' . $k["path_foto_artikel"]) ?>"  width="35%" height="120px">
                              <b style="font-size: 13px"><?= $f["judul_berita"] ?></b>
                              <?= $f["isi_berita"] ?>
                              <?php
                          }
                      } ?> -->
                          <!-- <div class="col-md-12" >
                              <div class="card-body"  >
                                <!-- <p><?= date('d M Y H:i:s', strtotime($f["tgl_jam"])) ?></p> -->
                                <!-- <b><?= $f["judul_berita"] ?></b> -->
                                <!-- <p><?= $f["isi_berita"] ?></p> -->
                                <!-- </div> -->
                                <!-- </div> -->
                           <!--  <br>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
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






<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog    modal-xl" role="document">
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
    <div class="modal-dialog    modal-lg" role="document">
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
    <div class="modal-dialog    modal-lg" role="document">
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