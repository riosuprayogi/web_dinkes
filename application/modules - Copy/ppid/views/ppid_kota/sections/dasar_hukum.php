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
			{'data':'file'},
			
		]
	});
});
</script>

<section id="dasar_hukum" class="cid-struktur" data-rv-view="1620">
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
