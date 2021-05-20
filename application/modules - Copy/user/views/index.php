<style>
.select2-selection--single {
	height: 100% !important;
}
.select2-selection__rendered{
	word-wrap: break-word !important;
	text-overflow: inherit !important;
	white-space: normal !important;
}
</style>
<script>
var save_method; //for save method string
var table;
var table2;

$(document).ready(function() {
	jQuery(function($){
			$.ajaxSetup({
				data: {'<?= $this->security->get_csrf_token_name() ?>' : '<?= $this->security->get_csrf_hash() ?>'}
			});
		});
	table = $('#table').DataTable({
		paginationType:'full_numbers',
		processing: true,
		serverSide: true,
		filter: false,
		autoWidth: false,
		ajax: {
			url: '<?php echo site_url('user/ajax_list')?>',
			type: 'GET',
			data: function (data) {

				data.<?= $this->security->get_csrf_token_name();?>= $('#csrf').val();
				data.filter = {
					'username':$('#filter_username').val(),
					'nama':$('#filter_nama').val(),
					'skpd':$('#filter_skpd').val()
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
			{'data':'username'},
			{'data':'nama'},
			{'data':'nama_unor'},
			{'data':'aksi','orderable':false}
		]
	});

	table2 = $('#table2').DataTable({
		paging: false,
		processing: true,
		serverSide: true,
		sort:false,
		filter: false,
		info: false,
		autoWidth:false,
		ajax: {
			url: '<?php echo site_url('user/ajax_list_cart')?>',
			type: 'GET',
			data: function (data) {
				data.<?= $this->security->get_csrf_token_name();?>= $('#csrf').val();
			}
		},
		columns: [
			{'data':'no','orderable':false},
			{'data':'app_name','orderable':false},
			// {'data':'access_name','orderable':false},
			{'data':'aksi','orderable':false}
		]
	});

	table3 = $('#table3').DataTable({
		paging: false,
		processing: true,
		serverSide: true,
		sort:false,
		filter: false,
		info: false,
		autoWidth:false,
		ajax: {
			url: '<?php echo site_url('user/ajax_list_cart')?>',
			type: 'GET',
			data: function (data) {
				data.<?= $this->security->get_csrf_token_name();?>= $('#csrf').val();
			}
		},
		columns: [
			{'data':'no','orderable':false},
			{'data':'app_name','orderable':false},
			// {'data':'access_name','orderable':false},
		]
	});

	$.ajax({ url : "<?php echo site_url('user/ajax_skpd/')?>",
		type: "GET",
		dataType: "JSON",
		async: false,
		success: function(data){
			$('[name="filter_skpd"]').empty();
			$('[name="filter_skpd"]').append('<option value="ALL">SEMUA</option>');
			for (var i = 0; i < data.skpd.length; i++) {
				$('[name="filter_skpd"]').append('<option value=' + data.skpd[i].id_skpd + '>' + data.skpd[i].nama_singkat + '</option>');
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});

	$('[name="username"]').change(function(){
		$(this).parent().parent().removeClass('has-error');
		$(this).next().empty();
	});

	$('[name="nama"]').change(function(){
		$(this).parent().parent().removeClass('has-error');
		$(this).next().empty();
	});

	$('[name="app_id"]').change(function(){
		$(this).parent().removeClass('has-error');
		$(this).next().next().empty();
		if ($(this).val())
			$('#appname').val( $(this).find('option:selected').text() );
	});
	$('[name="access"]').change(function(){
		$(this).parent().removeClass('has-error');
		$(this).next().next().empty();
	});

	$('[name="nama_skpd"]').change(function(){
		$(this).parent().parent().removeClass('has-error');
		$(this).next().empty();
	});

	$("#filter_username").keyup(function(event){
		if(event.keyCode == 13){
			reload_table();
		}
	});

	$("#filter_nama").keyup(function(event){
		if(event.keyCode == 13){
			reload_table();
		}
	});

	$("#filter_skpd").change(function(){
		reload_table();
	});
});

function reload_table(){
	table.ajax.reload(null,false);
}

function add(){
	save_method = 'add';
	$('#form1')[0].reset(); // reset form on modals
	$('#form2')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.col-md-12').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string

	//Ajax Load data from ajax
	$.ajax({ url : "<?php echo site_url('user/ajax_add/')?>",
		type: "GET",
		dataType: "JSON",
		async: false,
		success: function(data){
			$('[name="app_id"],[name="access"]').empty();
			$('[name="app_id"],[name="access"]').append('<option value="">--PILIH--</option>');
			for (var i = 0; i < data.aplikasi.length; i++) {
				$('[name="app_id"]').append('<option value=' + data.aplikasi[i].id_app + '>' + data.aplikasi[i].nama_app + '</option>');
			}

			$('[name="access"]').append('<option value="unor">Hanya SKPD</option>');
			$('[name="access"]').append('<option value="full">Semua SKPD</option>');

			$('[name="cek_username"]').show();
			$('#btnCekNip').show();

			table2.ajax.reload(null,false);

			$('#modal_form').modal('show'); // show bootstrap modal
			$('.modal-title').text('Tambah'); // Set Title to Bootstrap modal title
		},
		error: function (jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
}

function edit(id){

	save_method = 'edit';
	$('#form1')[0].reset(); // reset form on modals
	$('#form2')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.col-md-12').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string

	//Ajax Load data from ajax
	$.ajax({ url : "<?php echo site_url('user/ajax_edit/')?>/" + id,
		type: "GET",
		dataType: "JSON",
		async: false,
		success: function(data){
			$('[name="app_id"],[name="access"]').empty();
			$('[name="app_id"],[name="access"]').append('<option value="">--PILIH--</option>');
			for (var i = 0; i < data.aplikasi.length; i++) {
				$('[name="app_id"]').append('<option value=' + data.aplikasi[i].id_app + '>' + data.aplikasi[i].nama_app + '</option>');
			}

			$('[name="access"]').append('<option value="unor">Hanya SKPD</option>');
			$('[name="access"]').append('<option value="full">Semua SKPD</option>');

			$('[name="id"]').val(data.id_user);
			$('[name="username"],[name="oldusername"]').val(data.username);
			$('[name="cek_username"]').val(data.username);
			$('[name="nama"]').val(data.nama);
			$('[name="id_skpd"]').val(data.id_skpd);
			$('[name="nama_skpd"]').val(data.skpd);
			$('[name="kode_unor"]').val(data.kode_unor);
			$('[name="nama_unor"]').val(data.nama_unor); // adun
	
			$('[name="cek_username"]').show();
			$('#btnCekNip').show();

			table2.ajax.reload(null,false);

			$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('Ubah'); // Set title to Bootstrap modal title
		},
		error: function (jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
}

function detail(id){
	//Ajax Load data from ajax
	$.ajax({ url : "<?php echo site_url('user/ajax_detail/')?>/" + id,
		type: "GET",
		dataType: "JSON",
		async: false,
		success: function(data){
			$('.id').html(data.id_user);
			$('.username').html(data.username);
			$('.nama').html(data.nama);
			$('.login').html(data.login + ' Kali');
			if(data.last_login){
				$('.last_login').html(data.last_login);
			}
			$('.skpd').html(data.skpd);
			$('#modal_detail').modal('show'); // show bootstrap modal when complete loaded

			table3.ajax.reload(null,false);
		},
		error: function (jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
}

function save(){
	$('#btnSave').text('Proses..'); //change button text
	$('#btnSave').attr('disabled',true); //set button disable
	var url;

	if(save_method == 'add') {
		url = "<?php echo site_url('user/ajax_insert')?>";
	}else if(save_method == 'edit'){
		url = "<?php echo site_url('user/ajax_update')?>";
	}

	// ajax adding data to database
	$.ajax({ url : url,
		type: "POST",
		data: $('#form1').serialize(),
		dataType: "JSON",
		//async: false,
		success: function(data){

			if(data.status){
				$('#modal_form').modal('hide');
				reload_table();
			}else{
				$('[name="username"]').parent().addClass(data.error_class['username']);
				$('[name="username"]').next().text(data.error_string['username']);

				$('[name="nama"]').parent().addClass(data.error_class['nama']);
				$('[name="nama"]').next().text(data.error_string['nama']);

				$('[name="app_id"]').parent().addClass(data.error_class['app_id']);
				$('[name="app_id"]').next().next().text(data.error_string['app_id']);

				$('[name="nama_skpd"]').parent().addClass(data.error_class['nama_skpd']);
				$('[name="nama_skpd"]').next().text(data.error_string['nama_skpd']);
			}

			$('#btnSave').text('Simpan'); //change button text
			$('#btnSave').attr('disabled',false); //set button enable


		},
		error: function (jqXHR, textStatus, errorThrown){
			alert('Error adding / update data');
			$('#btnSave').text('Simpan'); //change button text
			$('#btnSave').attr('disabled',false); //set button enable

		}
	});
}

function del(id){
	Swal.fire({
      title: 'Apa Anda Yakin?',
      text: "Apa Anda Yakin Menghapus Data User Ini?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Tidak'
    }).then((result) => {
			if (result.value) {
			$.ajax({ url : "<?php echo site_url('user/ajax_delete')?>/"+id,
				type: "POST",
				dataType: "JSON",
				async: false,
				success: function(data){
					// reload_table();
					location.reload();
				},
				error: function (jqXHR, textStatus, errorThrown){
					alert('Error deleting data');
				}
			});
		}
	});
	
}

function cek_nip(){
	$('#btnCekNip').text('sedang mencari...');
	$('#btnCekNip').attr('disabled',true);
	var username = $('[name="cek_username"]').val();
	//Ajax Load data from ajax
	$.ajax({ url : "<?php echo site_url('user/ajax_cek_nip/')?>/"+username,
		type: "GET",
		dataType: "JSON",
		async: false,
		success: function(data){
			if(username.length == 0){
				alert("Harap isi NIP terlebih dahulu");
			}else{
				if(!data.user){
					alert("Data tidak ditemukan");
					// $('[name="username"],[name="nama"]').prop('disabled', false);
				}else if(data.user === 'terdaftar'){
					alert("NIP telah terdaftar");
				}else{
					$('[name="username"]').val(data.user.nip_baru);
					if(data.user.gelar_depan === "-" ){
						$('[name="nama"]').val(data.user.nama_pegawai+", "+data.user.gelar_belakang);
					}else if(data.user.gelar_depan === null || data.user.gelar_belakang === null || data.user.gelar_belakang === "" || data.user.gelar_depan === ""){
						$('[name="nama"]').val(data.user.nama_pegawai);
					} else{
						$('[name="nama"]').val(data.user.gelar_depan+". "+data.user.nama_pegawai+", "+data.user.gelar_belakang);
					}

					 

					$('[name="id_skpd"]').val(data.user.id_skpd);
					$('[name="nama_skpd"]').val(data.user.nama_skpd);
					$('[name="kode_unor"]').val(data.user.kode_unor);
					$('[name="nama_unor"]').val(data.user.nama_unor); // adun

					$('[name="username"]').parent().removeClass('has-error');
					$('[name="username"]').next().empty();

					$('[name="nama"]').parent().removeClass('has-error');
					$('[name="nama"]').next().empty();

					$('[name="nama_skpd"]').parent().removeClass('has-error');
					$('[name="nama_skpd"]').next().empty();

					alert("Data ditemukan");
				}
			}
			$('#btnCekNip').text('Cek NIP');
			$('#btnCekNip').attr('disabled',false);
		},
		error: function (jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
}

function add_cart(){
	$.ajax({ url: "<?php echo site_url('user/ajax_add_cart')?>",
		type: "POST",
		data: $('#form2').serialize(),
		dataType: "JSON",
		success: function(data){
			if(data.status){
				$('[name="app_id"]').val('').trigger('change');
				$('[name="access"]').val('').trigger('change');
				$('#form2')[0].reset();
				table2.ajax.reload(null,false);
			}else{
				$('[name="app_id"]').parent().addClass(data.error_class['app_id']);
				$('[name="app_id"]').next().next().text(data.error_string['app_id']);

				$('[name="access"]').parent().addClass(data.error_class['access']);
				$('[name="access"]').next().next().text(data.error_string['access']);
			}
		},
		error: function (jqXHR, textStatus, errorThrown){
			alert('Error adding / update data');
		}
	});
}

function del_cart(rowid){
	$.ajax({ url : "<?php echo site_url('user/ajax_delete_cart/');?>/"+rowid,
		type: "POST",
		dataType: "JSON",
		success: function(data){
			table2.ajax.reload(null,false);

		},
		error: function (jqXHR, textStatus, errorThrown){
			alert('Error deleting data');
		}
	});
}

function recsrf(){
	$.ajax({ url : "<?php echo site_url('user/recsrf/');?>",
		type: "GET",
		dataType: "JSON",
		success: function(data){
			// table2.ajax.reload(null,false);
			$('#csrf').val(data.value);
			// console.log(data);
		}
	});
}

</script>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manajemen Pengguna</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>"">Home</a></li>
              <li class="breadcrumb-item active">Pengguna</li>
            </ol>
          </div>
          <input type="hidden" id="csrf" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        </div>
      </div>
    </div>
<section class="content">
	<div class="card">
		<div class="card-body">
			<table id="table" class="table table-striped table-bordered">
				<thead>
					<tr>
						<td onclick="add()" style="vertical-align:middle; text-align:center;cursor:pointer;"><i class="fas fa-plus"></i></td>
						<td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_username" name="filter_username" maxlength="100"></td>
						<td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_nama" name="filter_nama" maxlength="100"></td>
						<td><select id="filter_skpd" class="form-control input-sm" name="filter_skpd" style="width:100%"></select></td>
						<td onclick="reload_table()" style="vertical-align:middle; text-align:center;cursor:pointer;"><b><i class="glyphicon glyphicon-filter"></i></b></td>
					</tr>
					<tr class="info">
						<th width="5%"><b>No</b></th>
						<th width="14%"><b>NIP</b></th>
						<th width="33%"><b>Nama</b></th>
						<th width="38%"><b>SKPD / UPT</b></th>
						<th width="10%"><b>Aksi</b></th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
</section>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"></h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body form">
				<div class="form-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-6">
								<form action="#" id="form1" class="form-horizontal">
									<input type="hidden" value="" id="id" name="id">
									<input type="hidden" value="" name="oldusername">
									<input type="hidden" id="id_skpd" name="id_skpd">
									<input type="hidden" id="kode_unor" name="kode_unor" value="">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									
									<div class="form-group">
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<button type="button" id="btnCekNip" onclick="cek_nip()" class="btn btn-sm btn-info">Cek NIP/NIK</button>
											</div>
											<?php
												echo form_input(array(
													'name' => 'cek_username',
													'class' => 'form-control input-sm',
													'placeholder' => 'NIP/NIK',
													'maxlength' => '32'
												));
												?>
										</div>
				
									</div>
									<div class="form-group">
										<label>NIP/NIK :</label>
											<?php
											echo form_input(array(
												'name' => 'username',
												'id' => 'username',
												'class' => 'form-control input-sm',
												'placeholder' => 'NIP',
												'readonly' => true,
												'maxlength' => '32'
											));
											?>
											<span class="help-block"></span>
									</div>
									<div class="form-group">
										<label>Nama :</label>
											<?php
											echo form_input(array(
												'name' => 'nama',
												'id' => 'nama',
												'class' => 'form-control input-sm',
												'placeholder' => 'Nama',
												'readonly' => true,
												'maxlength' => '100'
											));
											?>
											<span class="help-block"></span>
									</div>
									<div class="form-group">
											<label>SKPD :</label>
											<?php
											echo form_input(array(
												'name' => 'nama_skpd',
												'id' => 'nama_skpd',
												'class' => 'form-control input-sm',
												'placeholder' => 'SKPD',
												'readonly' => true,
											));
											?>
											<span class="help-block"></span>
									</div>
									<!-- adun -->
									<div class="form-group">
											<label>UPT :</label>
											<?php
											echo form_input(array(
												'name' => 'nama_unor',
												'id' => 'nama_unor',
												'class' => 'form-control input-sm',
												'placeholder' => 'UPT',
												'readonly' => true,
											));
											?>
											<span class="help-block"></span>
									</div>
									<!-- adun close -->
								</div>
							</form>
							<div class="col-md-6">
								<form action="#" id="form2" class="form-horizontal">
									<input type="hidden" value="" id="id" name="id">
									<input type="hidden" value="" id="appname" name="appname">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									<div class="form-group">
										<div class="col-md-12">
											<label>Peran  :</label>
											<?php
											$data = array(null => '--PILIH--');
											echo form_dropdown(
												'app_id', $data, FALSE, 'class="form-control" style="width:100%"'
											);
											?>
											<span class="help-block"></span>
										</div>
									</div>
									<!-- <div class="form-group">
										<div class="col-md-12">
											<label>Hak Akses :</label>
											<?php
											$data = array(null => '--PILIH--');
											echo form_dropdown(
												'access', $data, FALSE, 'class="form-control" style="width:100%"'
											);
											?>
											<span class="help-block"></span>
										</div>
									</div> -->
									<div class="form-group">
										<div class="col-md-12">
											<button type="button" id="btnAddCart" onclick="add_cart();" class="btn btm-sm btn-info">Tambah</button>
										</div>
									</div>
									<table id="table2" class="table table-striped table-bordered" width="100%">
										<thead>
											<tr class="info">
												<th width="5%"><b>No</b></th>
												<th width="50%"><b>Peran </b></th>
												<!-- <th width="40%"><b>Hak Akses</b></th> -->
												<th width="5%"><b>Aksi</b></th>
											</tr>
										</thead>
									</table>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<!-- Bootstrap modal detail-->
<div class="modal fade" id="modal_detail" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Detail</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="col-md-6">
					<strong>ID</strong>
					<p class="text-muted">
						<span class="id"></span>
					</p>
					<hr>
					<strong>NIP</strong>
					<p class="text-muted">
						<span class="username"></span>
					</p>
					<hr>
					<strong>Nama</strong>
					<p class="text-muted">
						<span class="nama"></span>
					</p>
					<hr>
					<strong>SKPD</strong>
					<p class="text-muted">
						<span class="skpd"></span>
					</p>
					<hr>
					<strong>Terakhir Login</strong>
					<p class="text-muted">
						<span class="last_login"></span>
					</p>
				</div>
				<div class="col-md-6">
					<strong>Peran </strong>
					<table id="table3" class="table table-striped table-bordered" width="100%">
						<thead>
							<tr class="info">
								<th width="5%"><b>No</b></th>
								<th width="50%"><b>Peran </b></th>
								<!-- <th width="45%"><b>Hak Akses</b></th> -->
							</tr>
						</thead>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>