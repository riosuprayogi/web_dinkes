<script>

$(document).ready(function() {
    
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
			{'data':'alamat'},
			{'data':'no_tlp'},
			{'data':'email'},
			{'data':'website'},
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
<section id="icon" class="cid-icon" data-rv-view="1620">
	<div class="container align-center">		
		<div class="media-container-row">
            <div class="col-lg-4 col-md-12 col-sm-12 p-5">
                <div class="card-wrapper">
					<a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" class="text-reset">
						<div class="card-img">
							<img src="<?php echo base_url();?>assets/home2/modules/ppid/images/daftar-ppid-min.png" media-simple="true">
							<p>Daftar PPID Pembantu</p>
						</div>
					</a>
				</div>
            </div>
			<div class="col-lg-4 col-md-12 col-sm-12 p-5">
                <div class="card-wrapper">
					<div class="card-img">
						<img src="<?php echo base_url();?>assets/home2/modules/ppid/images/susunan-organisasi-min.png" media-simple="true">
						<p>Susunan Organisasi Tugas dan Fungsi</p>
					</div>
				</div>
            </div>
			<div class="col-lg-4 col-md-12 col-sm-12 p-5">
                <div class="card-wrapper">
					<div class="card-img">
						<img src="<?php echo base_url();?>assets/home2/modules/ppid/images/keputusan-min.png" media-simple="true">
						<p>Keputusan Walikota</p>
					</div>
				</div>
            </div>
		</div>
	</div>

</section>
<modal>

</modal>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog 	modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Daftar PPID Pembantu</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  	<table id="tables" class="table table-striped table-sm table-bordered">
				<thead>
					<tr class="info">
					<th style="vertical-align: middle;" width="5%"><center><b>No</b></center></th>
					<th>id</th>
					<th style="vertical-align : middle !important;" width="24%"><center><b>SKPD</b></center></th>
					<th style="vertical-align : middle !important;" width="24%"><center><b>Pembantu</b></center></th>
					<th style="vertical-align : middle !important;" width="24%"><center><b>Alamat</b></center></th>
					<th style="vertical-align : middle !important;" width="24%"><center><b>No Telepon</b></center></th>
					<th style="vertical-align : middle !important;" width="24%"><center><b>Email</b></center></th>
					<th style="vertical-align : middle !important;" width="24%"><center><b>Website</b></center></th>
					<th style="vertical-align : middle !important;" width="10%"><center><b>Aksi</b></center></th>
					</tr>
				</thead>
		</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
