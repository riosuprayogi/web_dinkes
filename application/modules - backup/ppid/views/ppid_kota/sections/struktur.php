<section id="struktur" class="cid-struktur mbr-fullscreen" data-rv-view="1620">
	<div class="container align-center">
		<div class="media-container-row align-center">
			<div class="row justify-content-md-center" style="padding-top:50px; padding-bottom: 50px;">
				<h3 class="mbr-section-title mbr-bold mbr-fonts-style">
					STRUKTUR ORGANISASI
				</h3>
			</div>
		</div>
		
		<div class="media-container-row align-center">
        	<div class="card-wrapper">
            	<div class="card-img">
				<?php foreach($struktur as $row) {?>
					<!-- <div class="col-lg-3 col-md-4 col-6">
						<button type="button" onclick='del("<?= $row->isi?>")' class="btn btn-danger btn-sm btn-block"><i class="fas fa-fw fa-trash"></i></button>
						<a href="javascript:void(0)" onclick="magnify('<?= $row->isi ?>')" class="d-block mb-4 h-100">
							<img class="img-fluid img-responsive img-thumbnail" src="<?php echo base_url('assets/media/image/').$row->isi ?>" alt="">
						</a>
					</div> -->
					<img src="<?php echo base_url('assets/media/image/').$row->isi ?>" media-simple="true" style="width: 100%;">

				<?php } ?>	
					<!-- <img src="<?php echo base_url();?>assets/home2/modules/ppid/images/struktur_ppid.png" media-simple="true" style="width: 100%;"> -->
				</div>
			</div>
        </div>
    </div>
</section>