<script>
var save_method; //for save method string
var table;

$(document).ready(function() {
    table = $('#table').DataTable({
		paginationType:'full_numbers',
        processing: true,
        serverSide: true,
		filter: false,
        autoWidth:false,
        ajax: {
            url: '<?php echo site_url('skpd/ajax_list')?>',
            type: 'POST',
            async: false,
			data: function (data) {
                data.filter = {
					'kode':$('#filter_kode').val(),
					'kode_unor':$('#filter_kode_unor').val(),
					'nama_lengkap':$('#filter_nama_lengkap').val(),
					'nama_singkat':$('#filter_nama_singkat').val()
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
		order: [2, 'asc'],
		columns: [
            {'data':'no','orderable':false},
            {'data':'kode'},
            {'data':'nama_lengkap'},
            {'data':'nama_singkat'},
            {'data':'kode_unor'},
            {'data':'aksi','orderable':false}
        ]
    });

	$("#filter_kode").keyup(function(event){
		if(event.keyCode == 13){
			reload_table();
		}
	});

	$("#filter_kode_unor").keyup(function(event){
		if(event.keyCode == 13){
			reload_table();
		}
	});

	$("#filter_nama_lengkap").keyup(function(event){
		if(event.keyCode == 13){
			reload_table();
		}
	});

	$("#filter_nama_singkat").keyup(function(event){
		if(event.keyCode == 13){
			reload_table();
		}
	});
});

function reload_table(){
    table.ajax.reload(null,false);
}

function detail(id){
    //Ajax Load data from ajax
    $.ajax({ url : "<?php echo site_url('skpd/ajax_detail/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        async: false,
        success: function(data){
            $('.id').html(data.id_skpd);
            $('.kode').html(data.kode);
            $('.nama_lengkap').html(data.nama_lengkap);
            $('.nama_singkat').html(data.nama_singkat);
            $('.kode_unor').html(data.kode_unor);
            $('#modal_detail').modal('show'); // show bootstrap modal when complete loaded
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });
}

</script>
<section class="content-header">
	<h1>Manajemen SKPD</h1>
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">SKPD</li>
	</ol>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
            <table id="table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td></td>
                        <td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_kode" name="filter_kode" maxlength="100"></td>
                        <td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_nama_lengkap" name="filter_nama_lengkap" maxlength="100"></td>
                        <td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_nama_singkat" name="filter_nama_singkat" maxlength="30"></td>
                        <td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_kode_unor" name="filter_kode_unor" maxlength="100"></td>
						<td class="text-center">
							<button type="button" onclick="reload_table()" data-toggle="tooltip" title="Saring" class="btn btn-secondary btn-sm"><i class="glyphicon glyphicon-filter"></i></button>
							<!-- <button type="button" onclick="add()" data-toggle="tooltip" title="Tambah" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i></button> -->
						</td>
                    </tr>
                    <tr class="info">
                        <th width="5%"><b>No</b></th>
                        <th width="17%"><b>Kode</b></th>
                        <th width="38%"><b>Nama Lengkap</b></th>
                        <th width="25%"><b>Nama Singkat</b></th>
                        <th width="10%"><b>Kode Unor</b></th>
                        <th width="5%"><b>Aksi</b></th>
                    </tr>
                </thead>
            </table>
		</div>
	</div>
</section>

<!-- Bootstrap modal detail-->
<div class="modal fade" id="modal_detail" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3>Detail</h3>
            </div>
            <div class="modal-body">
				<strong>ID</strong>
				<p class="text-muted">
					<span class="id"></span>
				</p>
				<hr>
				<strong>Kode SKPD</strong>
				<p class="text-muted">
					<span class="kode"></span>
				</p>
				<hr>
				<strong>Nama Lengkap</strong>
				<p class="text-muted">
					<span class="nama_lengkap"></span>
				</p>
				<hr>
				<strong>Nama Singkat</strong>
				<p class="text-muted">
					<span class="nama_singkat"></span>
				</p>
				<hr>
				<strong>Kode Unor</strong>
				<p class="text-muted">
					<span class="kode_unor"></span>
				</p>
				<hr>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
