
 
<script>

$(document).ready(function() {
    table = $('#table').DataTable({
		paginationType:'full_numbers',
		processing: true,
		serverSide: true,
		filter: false,
		autoWidth: false,
        bLengthChange: false,
		ajax: {
			url: '<?php echo site_url('dasar_hukum/ajax_list')?>',
			type: 'GET',
			header: {
            '<?= $this->security->get_csrf_token_name();?>': '<?php echo $this->security->get_csrf_hash(); ?>', //replace by your name/value
          	},
			data: function (data) {
				data.filter = {
					'username':'',
				};
			}
		},
		language: {
			sProcessing: '<img src="<?php echo base_url('assets/img/process.gif')?>" width="20px"> Sedang memproses...',
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
		columns: [
			{'data':'no','orderable':false},
			{'data':'id_dasar_hukum',"visible": false},
			{'data':'judul'},
		]
	});
    tables = $('#tables').DataTable({
		paginationType:'full_numbers',
		processing: true,
		serverSide: true,
		filter: false,
		autoWidth: false,
        bLengthChange: false,
		ajax: {
			url: '<?php echo site_url('daftar_pembantu/ajax_list')?>',
			type: 'GET',
			header: {
            '<?= $this->security->get_csrf_token_name();?>': '<?php echo $this->security->get_csrf_hash(); ?>', //replace by your name/value
          	},
			data: function (data) {
				data.filter = {
					'username':'',
				};
			}
		},
		language: {
			sProcessing: '<img src="<?php echo base_url('assets/img/process.gif')?>" width="20px"> Sedang memproses...',
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
		columns: [
			{'data':'no','orderable':false},
			{'data':'id_daftar_pembantu',"visible": false},
			{'data':'skpd'},
            {'data':'kategori'},
		]
	});
});
function magnify(nama_foto=null,desk=null){
		$('#img_foto').empty();
		if (nama_foto) {
				// $('#img_foto').append('<img width="100%" src="https://testing.tangerangkota.go.id/angkutan/assets/foto_angkutan/'+nama_foto+'"/>');
				$('#img_foto').attr('src', '<?php echo base_url('assets/media/image/')?>'+nama_foto);
				// $('#hapus_foto').click(function(){ myFunction(); });
				// $('#hapus_foto').attr('onclick', "del_foto('"+nama_foto+"')");
		}

		// $('#desk').text(desk);
		$('#modal_magnify').modal('show'); // show bootstrap modal when complete loaded
}

</script>

<style>
.modal-backdrop.show {
    opacity: 0 !important;
}
input[type=checkbox] {
		display: none;
}

.containerz img {
		transition: transform 0.25s ease;
		cursor: zoom-in;
}

input[type=checkbox]:checked~label>img {
		transform: scale(2);
		cursor: zoom-out;
}

.modal-backdrop {
    z-index: 0 !important;
}
</style>



<div id="featured-title" class="featured-title clearfix">
    <div id="featured-title-inner" class="container clearfix">
        <div class="featured-title-inner-wrap">
            <div id="breadcrumbs">
                <div class="breadcrumbs-inner">
                    <div class="breadcrumb-trail">
                        <a href="<?php echo base_url(); ?>" class="trail-begin">Beranda</a>
                        <span class="sep">|</span>
                        <span class="trail-end">Profil</span>
                    </div>
                </div>
            </div>
            <div class="featured-title-heading-wrap">
                <h1 class="feautured-title-heading">
                    Profil
                </h1>
            </div>
        </div><!-- /.featured-title-inner-wrap -->
    </div><!-- /#featured-title-inner -->
</div>
<!-- ICONBOX -->
<div class="row-iconbox">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="themesflat-spacer clearfix" data-desktop="60" data-mobile="60" data-smobile="60"></div>
                <div class="themesflat-headings style-1 text-center clearfix">
                    <h2 class="heading">PROFIL</h2>
                    <div class="sep has-icon width-125 clearfix">
                        <div class="sep-icon">
                            <span class="sep-icon-before sep-center sep-solid"></span>

                            <span class="sep-icon-after sep-center sep-solid"></span>
                        </div>
                    </div>
                    <p class="sub-heading"><?php echo $profil['isi']; ?>
                    </p>
                </div>
                <div class="themesflat-spacer clearfix" data-desktop="42" data-mobile="35" data-smobile="35"></div>
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div>
</div>

<!-- TESTIMONIALS -->
<div class="row-testimonials parallax-2">
    <div class="container">
        <div class="row">
            <div class="themesflat-spacer clearfix" data-desktop="60" data-mobile="60" data-smobile="60"></div>
            <div class="themesflat-headings style-1 text-center clearfix">
                <h2 class="heading">Struktur PPID</h2>
                <div class="sep has-icon width-125 clearfix">
                    <div class="sep-icon">
                        <span class="sep-icon-before sep-center sep-solid"></span>

                        <span class="sep-icon-after sep-center sep-solid"></span>
                    </div>
                </div>
                <div class="row">
                    <?php foreach($struktur as $row) {?>
                    <div class="col-lg-4 col-md-4 col-6">
                        <a href="javascript:void(0)" onclick="magnify('<?= $row->isi ?>')" class="d-block mb-4 h-100">
                            <img class="img-fluid img-responsive img-thumbnail"
                                src="<?php echo base_url('assets/media/image/').$row->isi ?>" alt="">
                        </a>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="themesflat-spacer clearfix" data-desktop="42" data-mobile="35" data-smobile="35"></div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</div>
<!-- END TESTIMONIALS -->

<!-- END TESTIMONIALS -->
<div class="row-iconbox">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="themesflat-spacer clearfix" data-desktop="60" data-mobile="60" data-smobile="60"></div>
            <div class="themesflat-headings style-1 text-center clearfix">
                <h2 class="heading">Dasar Hukum</h2>
                <div class="sep has-icon width-125 clearfix">
                    <div class="sep-icon">
                        <span class="sep-icon-before sep-center sep-solid"></span>

                        <span class="sep-icon-after sep-center sep-solid"></span>
                    </div>
                </div>
                <div class="row">
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
            </div>
            <div class="themesflat-spacer clearfix" data-desktop="42" data-mobile="35" data-smobile="35"></div>
     
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div>
</div>

<!-- TESTIMONIALS -->
<div class="row-testimonials parallax-2">
    <div class="container">
        <div class="row">
            <div class="themesflat-spacer clearfix" data-desktop="60" data-mobile="60" data-smobile="60"></div>
            <div class="themesflat-headings style-1 text-center clearfix">
                <h2 class="heading">Daftar Pembantu PPID</h2>
                <div class="sep has-icon width-125 clearfix">
                    <div class="sep-icon">
                        <span class="sep-icon-before sep-center sep-solid"></span>

                        <span class="sep-icon-after sep-center sep-solid"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <table id="tables" class="table table-striped table-sm table-bordered">
                                <thead>
                                    <tr class="info">
                                    <th style="vertical-align: middle;" width="5%"><center><b>No</b></center></th>
                                    <th>id</th>
                                    <th style="vertical-align : middle !important;" width="24%"><center><b>SKPD</b></center></th>
                                    <th style="vertical-align : middle !important;" width="24%"><center><b>Pembantu</b></center></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="themesflat-spacer clearfix" data-desktop="42" data-mobile="35" data-smobile="35"></div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</div>
<!-- END TESTIMONIALS -->
<div class="row-iconbox">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="themesflat-spacer clearfix" data-desktop="80" data-mobile="60" data-smobile="60"></div>
                <div class="themesflat-carousel-box has-arrows arrow-center arrow-circle offset-v-24 clearfix"
                    data-gap="30" data-column="1" data-column2="1" data-column3="1" data-auto="true">
                    <div class="owl-carousel owl-theme">
                        <div
                            class="themesflat-testimonials style-1 max-width-70 align-center has-width w100 circle border-solid clearfix">
                            <div class="testimonial-item">
                                <div class="inner">
                                    <div class="icon-wrap">
                                        <span>VISI</span>
                                    </div>
                                    <blockquote class="text">
                                        <p>“ <?php echo @$visi['isi']; ?> ”</p>
                                        <div class="sep has-width w80 accent-bg clearfix"></div>
                                    </blockquote>
                                </div>
                            </div>
                        </div><!-- /.themesflat-testimonials -->
                        <div
                            class="themesflat-testimonials style-1 max-width-70 align-center has-width w100 circle border-solid clearfix">
                            <div class="testimonial-item">
                                <div class="inner">
                                    <div class="icon-wrap">
                                        MISI
                                    </div>
                                    <blockquote class="text">
                                        <p>“ <?php echo @$misi['isi']; ?>

                                            ”</p>
                                        <div class="sep has-width w80 accent-bg clearfix"></div>
                                    </blockquote>
                                </div>
                            </div>
                        </div><!-- /.themesflat-testimonials -->
                    </div>
                </div><!-- /.themesflat-carousel-box -->
                <div class="themesflat-spacer clearfix" data-desktop="68" data-mobile="60" data-smobile="60"></div>
            </div><!-- /.col-md-12 -->
            <div class="themesflat-spacer clearfix" data-desktop="42" data-mobile="35" data-smobile="35"></div>
        </div><!-- /.col-md-12 -->
    </div><!-- /.row -->
</div>

    <!-- TESTIMONIALS -->
    <div class="row-testimonials parallax-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="themesflat-spacer clearfix" data-desktop="60" data-mobile="60" data-smobile="60"></div>
                    <div class="themesflat-headings style-1 text-center clearfix">
                        <h2 class="heading">Maklumat</h2>
                        <div class="sep has-icon width-125 clearfix">
                            <div class="sep-icon">
                                <span class="sep-icon-before sep-center sep-solid"></span>

                                <span class="sep-icon-after sep-center sep-solid"></span>
                            </div>
                        </div>
                        <p class="sub-heading"><?php echo $maklumat['isi']; ?>
                        </p>
                    </div>
                    <div class="themesflat-spacer clearfix" data-desktop="42" data-mobile="35" data-smobile="35"></div>
                </div><!-- /.col-md-12 -->
            </div><!-- /.row -->
        </div>
        <!-- END TESTIMONIALS -->

        <div class="modal fade" id="modal_magnify" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">

                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <!-- <span id="dtl_foto"></span> -->
                            <div class="containerz">
                                <input type="checkbox" id="zoomCheck">
                                <label for="zoomCheck">
                                    <img id="img_foto" class="img-responsive img-thumbnail" src="">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="row-iconbox">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="themesflat-spacer clearfix" data-desktop="60" data-mobile="60" data-smobile="60"></div>
                <div class="themesflat-headings style-1 text-center clearfix">
                    <h2 class="heading">PPID KOTA TANGERANG</h2>
                    <div class="sep has-icon width-125 clearfix">
                        <div class="sep-icon">
                            <span class="sep-icon-before sep-center sep-solid"></span>

                            <span class="sep-icon-after sep-center sep-solid"></span>
                        </div>
                    </div>
                    <img src="<?php echo base_url('assets/home/')?>img/ppid logo-big01-01.png"> 
                    <p class="sub-heading"><?php echo $kontak['alamat']; ?>
                    </p>
                    <p class="sub-heading" style="margin:0 !important; line-height: 25px !important;">
                    Email : <?php echo $kontak['email'];?>
                    <br>
                    Telp : (021) <?php echo $kontak['no_tlp']; ?> || 
                    Fax : (021) <?php echo $kontak['no_fax']; ?>
                    </p>
                </div>
                <div class="themesflat-spacer clearfix" data-desktop="42" data-mobile="35" data-smobile="35"></div>
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div>
</div>