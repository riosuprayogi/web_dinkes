<script>
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
                        <span class="trail-end">Struktur PPID</span>
                    </div>
                </div>
            </div>
            <div class="featured-title-heading-wrap">
                <h1 class="feautured-title-heading">
                    Struktur PPID
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
                                <img class="img-fluid img-responsive img-thumbnail" src="<?php echo base_url('assets/media/image/').$row->isi ?>" alt="">
                            </a>
                        </div>
                        <?php } ?>                    
                    </div>
                </div>
                <div class="themesflat-spacer clearfix" data-desktop="42" data-mobile="35" data-smobile="35"></div>
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->


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

