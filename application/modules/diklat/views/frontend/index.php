<!-- <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"> -->
<!-- <link href="<?php echo base_url('assets/home/css/hover.css') ?>" rel="stylesheet"> -->
<!-- <link href="<?php echo base_url('assets/home/css/hover2.css') ?>" rel="stylesheet"> -->
<!-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script> -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>



<style>
    #ppid {
        background-image: url('<?= base_url('assets/img/banner/4.png') ?>') !important;
        background-size: cover !important;
        background-position: center !important;
        background-repeat: no-repeat !important;
    }
</style>

<!-- <section class="cid-ppid mt-5" id="ppid" data-rv-view="1620" style="padding-top: 110px !important; padding-bottom: 110px !important; background: rgba(207, 207, 207, 0.33);" >
    <div class="container-fluid ">		
            <div class="media-container-row ">
                <div class="col-12 col-md-12">
                    <div class="media-container-row" >
                        <div class="mbr-figure rounded" style="padding:50px; background: rgba(255, 255, 255, 0); width: 40%;">
                            <div class="mbr-figure " style=" height:auto; opacity:1.0;">
                                <img src="<?php echo base_url(); ?>assets/img/banner/PPID LOGO.png" style="width:50%; margin:auto;" alt="" media-simple="true">
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
    <img class="img-responsive" src="<?= base_url('assets/media/image/3-diklat.png') ?>" alt="" style=" display: block;
    width:100%;
    height:100%;
    object-fit: cover;">
    <script>
        $(document).ready(function() {
            table = $('#table').DataTable({
                paginationType: 'full_numbers',
                processing: true,
                serverSide: true,
                filter: false,
                autoWidth: false,
                bLengthChange: false,
                ajax: {
                    url: '<?php echo site_url('dasar_hukum/ajax_list') ?>',
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
                'data': 'id_dasar_hukum',
                "visible": false
            },
            {
                'data': 'judul'
            },
            {
                'data': 'file'
            },

            ]
        });
        });
    </script>

<!--  <section id="dasar_hukum" class="cid-struktur bg-white" style="padding-top: 50px; padding-bottom: 50px;" data-rv-view="1620">
     <div class="container align-center">
      <div class="media-container-row align-center">
       <div class="row justify-content-md-center" style="padding-top: 50px; padding-bottom: 50px;">
        <h3 class="mbr-section-title mbr-bold mbr-fonts-style">
         DASAR HUKUM
     </h3>
 </div>
</div>
<div class="card">
    <div class="card-body">
        <table id="table" class="table table-striped table-sm table-bordered">
            <thead>
                <tr class="info">
                    <th style="vertical-align: middle;" width="5%"><center><b>No</b></center></th>
                    <th>id</th>
                    <th style="vertical-align : middle !important;" width="24%"><center><b>Dasar Hukum</b></center></th>
                    <th style="vertical-align : middle !important;" width="15%">Lihat</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
</div>
</section>
-->

<!-- ==============================berita diklat -->

<section id="icon-formulir" class="cid-icon-formulir" data-rv-view="1620" data-aos="fade-right" style="background-color: white; height: 100%">




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
                <img class="logo-video" src="<?= base_url('assets/media/image/diklat.png') ?>" alt="" style="padding-top: 30px; margin-bottom:30px ; width: 200px">
            </div>
        </div>
        <div class="" data-flickity='{ "wrapAround": true, "autoPlay":1500, "pageDots": false }'>
            <?php foreach ($t_diklat as $f) :
                $string = strip_tags($f["isi_diklat"]);
                if (strlen($string) > 1000) {

                        // truncate string
                    $stringCut = substr($string, 0, 1000);
                    $endPoint = strrpos($stringCut, ' ');

                        //if the string doesn't contain any space then it will cut without word basis.
                    $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                        // $string .= '... <a href="/this/story">Read More</a>';
                }
                ?>
                <div class="col-md-4 col-sm-4">
                    <div class="" style=" overflow: hidden; margin-bottom: 10px;  padding-right: 10px; ">
                        <div class="" style="width: 19rem; height: 500px; overflow: hidden; background-color: transparent;">
                            <a href="<?= base_url('diklat/detail/' . $f["id_diklat"]) ?>" style="text-decoration: none; color: #000000; height: 30%">
                                <!-- <a href="<?= base_url('site/detail/' . $f["id_berita"] . '/' . $f["id_kategori"]) ?>" style="text-decoration: none; color: #000000"> -->

                                    <?php if (count($f["path_foto_diklat"]) > 0) {
                                        foreach ($f["path_foto_diklat"] as $k) {
                                            ?>
                                            <img src="<?= base_url('assets/backend/img/img_diklat/' . $k["path_foto_diklat"]) ?>" width="100%" height="300px">
                                            <?php
                                        }
                                    } ?>
                                    <div class="card-body">
                                        <p><?= date('d M Y H:i:s', strtotime($f["tgl_jam"])) ?></p>
                                        <b><?= $f["nama_diklat"] ?></b>

                                        <p style="margin-top: 10px"><?= $string ?>...<a href="<?= base_url('diklat/detail/' . $f["id_diklat"]) ?>"> Baca Selanjutnya</a>

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


<!-- ==============================Akhir Berita diklat -->