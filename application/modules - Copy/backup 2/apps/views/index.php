<script>
var save_method; //for save method string
var table;

$(document).ready(function() {
    table = $('#table').DataTable({
		paginationType:'full_numbers',
        processing: true,
        serverSide: true,
		filter: false,
        autoWidth: false,
        ajax: {
            url: '<?php echo site_url('apps/ajax_list')?>',
            type: 'GET', 
			data: function (data) {
				data.<?= $this->security->get_csrf_token_name();?>= '<?php echo $this->security->get_csrf_hash(); ?>';
                data.filter = {
					'nama_app':$('#filter_nama_app').val(),
					'short_name':$('#filter_short_name').val(),
					'long_name':$('#filter_long_name').val(),
					'icon':$('#filter_icon').val(),
					'scheme':$('#filter_scheme').val(),
					'status':$('#filter_status').val()
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
		order: [1, 'asc'],
		columns: [
            {'data':'no','orderable':false},
            {'data':'nama_app'},
            {'data':'short_name'},
            {'data':'long_name'},
            // {'data':'icon'},
            {'data':'scheme'},
            {'data':'status'},
            {
				data:'id_app',
				orderable:false,
				render:function(data){
					return '<center><div class="btn-group"><button  href="javascript:void(0)" onclick="detail('+data+')" class="btn btn-info"><i class="fas fa-eye"></i></button><button  href="javascript:void(0)" onclick="edit('+data+')" class="btn btn-success"><i class="fas fa-edit"></i></button><button  href="javascript:void(0)" onclick="del('+data+')" class="btn btn-danger"><i class="fas fa-trash"></i></button></div></center>';
				}
			}
        ]
    });

	$('[name="filter_scheme"]').append('<option value="ALL">SEMUA</option>');
	$('[name="filter_scheme"]').append('<option value="red">Merah</option>');
	$('[name="filter_scheme"]').append('<option value="green">Hijau</option>');
	$('[name="filter_scheme"]').append('<option value="blue">Biru</option>');
	$('[name="filter_scheme"]').append('<option value="yellow">Kuning</option>');
	$('[name="filter_scheme"]').append('<option value="purple">Ungu</option>');

	$('[name="filter_status"]').append('<option value="ALL">SEMUA</option>');
	$('[name="filter_status"]').append('<option value="1">Aktif</option>');
	$('[name="filter_status"]').append('<option value="0">Non Aktif</option>');

	$('[name="nama_app"],[name="short_name"],[name="long_name"],[name="icon"]').change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

	$('[name="status"],[name="scheme"]').change(function(){
		$(this).parent().removeClass('has-error');
		$(this).next().next().empty();
	});

	$("#filter_nama_app,#filter_short_name,#filter_long_name,#filter_icon").keyup(function(event){
		if(event.keyCode == 13){
			reload_table();
		}
	});

	$("#filter_status,#filter_scheme").change(function(){
		reload_table();
	});
});

function reload_table(){
	table.ajax.reload(null,false);
}

function add(){
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.col-md-12').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

	//Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('apps/ajax_add/')?>/",
        type: "GET",
        dataType: "JSON",
        success: function(data){
			var list_menu = "";
			for (var i = 0; i < data.id_menu.length; i++) {
				if(data.id_menu[i].id_parent === null){
					list_menu += "<div class='checkbox'><p class='mb-n1'><input type='checkbox' name='id_menu[]' value='"+data.id_menu[i].id_menu+"'> "+data.id_menu[i].nama+"</p></div>";
					for (var j = 0; j < data.id_menu.length; j++) {
						if(data.id_menu[j].id_parent == data.id_menu[i].id_menu){
							list_menu += "<div class='checkbox' style='text-indent:1.0em'><p class='mb-n1'><input type='checkbox' name='id_menu[]' value='"+data.id_menu[j].id_menu+"'> "+data.id_menu[j].nama+"</p></div>";
						}
					}
				}
			}
			$('.id_menu').html(list_menu);

			$('[name="scheme"],[name="status"]').empty();

			$('[name="scheme"]').append('<option value="">--Pilih--</option>');
			$('[name="scheme"]').append('<option value="red">Merah</option>');
			$('[name="scheme"]').append('<option value="green">Hijau</option>');
			$('[name="scheme"]').append('<option value="blue">Biru</option>');
			$('[name="scheme"]').append('<option value="yellow">Kuning</option>');
			$('[name="scheme"]').append('<option value="purple">Ungu</option>');

			$('[name="status"]').append('<option value="">--Pilih--</option>');
			$('[name="status"]').append('<option value="1">Aktif</option>');
			$('[name="status"]').append('<option value="0">Non Aktif</option>');

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
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('apps/ajax_edit')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){
            $('[name="id"]').val(data.id_app);
            $('[name="nama_app"]').val(data.nama_app);
            $('[name="short_name"]').val(data.short_name);
            $('[name="long_name"]').val(data.long_name);
            $('[name="icon"]').val(data.icon);

			$('[name="scheme"],[name="status"]').empty();

			$('[name="scheme"]').append('<option value="">--Pilih--</option>');
			$('[name="scheme"]').append('<option value="red">Merah</option>');
			$('[name="scheme"]').append('<option value="green">Hijau</option>');
			$('[name="scheme"]').append('<option value="blue">Biru</option>');
			$('[name="scheme"]').append('<option value="yellow">Kuning</option>');
			$('[name="scheme"]').append('<option value="purple">Ungu</option>');

			$('[name="status"]').append('<option value="">--Pilih--</option>');
			$('[name="status"]').append('<option value="1">Aktif</option>');
			$('[name="status"]').append('<option value="0">Non Aktif</option>');

			var list_menu = "";
			var check = "";
			for (var i = 0; i < data.id_menu.length; i++) {
				if(data.id_menu[i].id_parent == null){
					if(typeof data.val_menu[data.id_menu[i].id_menu] != 'undefined'){
						check = "checked";
					}else{
						check = "";
					}
					list_menu += "<div class='checkbox'><p class='mb-n1'><input "+check+" type='checkbox' name='id_menu[]' value='"+data.id_menu[i].id_menu+"'> "+data.id_menu[i].nama+"</p></div>";
					for (var j = 0; j < data.id_menu.length; j++) {
						if(data.id_menu[j].id_parent == data.id_menu[i].id_menu){
							if(typeof data.val_menu[data.id_menu[j].id_menu] != 'undefined'){
								check = "checked";
							}else{
								check = "";
							}
							list_menu += "<div class='checkbox' style='text-indent:1.0em'><p class='mb-n1'><input "+check+" type='checkbox' name='id_menu[]' value='"+data.id_menu[j].id_menu+"'> "+data.id_menu[j].nama+"</p></div>";
						}
					}
				}
			}
			$('.id_menu').html(list_menu);
            $('[name="scheme"]').val(data.scheme);
			$('[name="status"]').val(data.status);
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
	$.ajax({
		url : "<?php echo site_url('apps/ajax_detail/')?>/" + id,
		type: "GET",
		dataType: "JSON",
		success: function(data){
			$('.id').html(data.id_app);
			$('.nama_app').html(data.nama_app);
			$('.short_name').html(data.short_name);
			$('.long_name').html(data.long_name);
			$('.icon').html(data.icon);
			$('.scheme').html(data.scheme);
			$('.status').html(data.status);

			var list_menu = "";
			for (var i = 0; i < data.id_menu.length; i++) {
				if(data.id_menu[i].id_parent == null){
					if(typeof data.val_menu[data.id_menu[i].id_menu] != 'undefined'){
						list_menu += "<div class='checkbox'><p class='mb-n1'><input checked disabled type='checkbox' name='id_menu[]' value='"+data.id_menu[i].id_menu+"'> "+data.id_menu[i].nama+"</p></div>";
					}
					for (var j = 0; j < data.id_menu.length; j++) {
						if(data.id_menu[j].id_parent == data.id_menu[i].id_menu){
							if(typeof data.val_menu[data.id_menu[j].id_menu] != 'undefined'){
								list_menu += "<div class='checkbox' style='text-indent:1.0em'><p class='mb-n1'><input checked disabled type='checkbox' name='id_menu[]' value='"+data.id_menu[j].id_menu+"'> "+data.id_menu[j].nama+"</p></div>";
							}
						}
					}
				}
			}
			$('.id_menu').html(list_menu);

			$('#modal_detail').modal('show'); // show bootstrap modal when complete loaded
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
        url = "<?php echo site_url('apps/ajax_insert')?>";
    }else if(save_method == 'edit'){
        url = "<?php echo site_url('apps/ajax_update')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data){

            if(data.status){
                $('#modal_form').modal('hide');
                reload_table();
            }else{
				$('[name="nama_app"]').parent().parent().addClass('has-error');
				$('[name="nama_app"]').next().text(data.error_string['nama_app']);

				$('[name="short_name"]').parent().parent().addClass('has-error');
				$('[name="short_name"]').next().text(data.error_string['short_name']);

				$('[name="long_name"]').parent().parent().addClass('has-error');
				$('[name="long_name"]').next().text(data.error_string['long_name']);

				$('[name="icon"]').parent().parent().addClass('has-error');
				$('[name="icon"]').next().text(data.error_string['icon']);

				$('[name="scheme"]').parent().addClass('has-error');
				$('[name="scheme"]').next().next().text(data.error_string['scheme']);

				$('[name="status"]').parent().addClass(data.error_class['status']);
				$('[name="status"]').next().next().text(data.error_string['status']);
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
	// Swal.fire({
	// 		title:"",
	// 		text:"Apakah yakin data ingin dihapus?",
	// 		type: "warning",
	// 		showCancelButton: true,
	// 		confirmButtonText: "Hapus",
	// 		cancelButtonText: "Batal",
	// 		closeOnConfirm: true,
	// 	},
	// 	function(){
	// 		$.ajax({
	// 			url : "<?php echo site_url('apps/ajax_delete')?>/"+id,
	// 			type: "POST",
	// 			dataType: "JSON",
	// 			success: function(data){
	// 				reload_table();
	// 			},
	// 			error: function (jqXHR, textStatus, errorThrown){
	// 				alert('Error deleting data');
	// 			}
	// 		});
	// 	}
	// );
	Swal.fire({
		title: 'Hapus?',
		text: "Apakah yakin data ingin dihapus?",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Batal',
		confirmButtonText: 'Hapus'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url : "<?php echo site_url('apps/ajax_delete')?>/"+id,
				type: "GET",
				dataType: "JSON",
				success: function(data){
					Swal.fire(
					'Berhasil!',
					'Berhasil Terhapus.',
					'success'
				)
					reload_table();
				},
				error: function (jqXHR, textStatus, errorThrown){
					alert('Error deleting data');
				}
			});
			
		}
	});
}

</script>


    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manajemen Aplikasi</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>"">Home</a></li>
              <li class="breadcrumb-item active">Aplikasi</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
			<div class="card">
					<div class="card-body">
									<table id="table" class="table table-striped table-bordered">
								<thead>
									<tr>
										<td></td>
										<td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_nama_app" name="filter_nama_app" maxlength="100"></td>
										<td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_short_name" name="filter_short_name" maxlength="100"></td>
										<td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_long_name" name="filter_long_name" maxlength="100"></td>
										<!-- <td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_icon" name="filter_icon" maxlength="100"></td> -->
										<td><select id="filter_scheme" class="form-control" name="filter_scheme" style="width:100%"></select></td>
										<td><select id="filter_status" class="form-control" name="filter_status" style="width:100%"></select></td>
									<td class="text-center">
										<!-- <button type="button" onclick="reload_table()" data-toggle="tooltip" title="Saring" class="btn btn-block btn-success btn-sm"><i class="fas fa-filter"></i></button>
										<button type="button" onclick="add()" data-toggle="tooltip" title="Tambah" class="btn btn-block btn-primary btn-sm"><i class="fas fa-plus"></i></button> -->
										<div class="btn-group">
											<button type="button" onclick="reload_table()" class="btn btn-success"><i class="fas fa-filter"></i></button>
											<button type="button" onclick="add()" class="btn btn-primary"><i class="fas fa-plus"></i></button>
										</div>
									</td>
									</tr>
									<tr class="info">
										<th width="5%"><b>No</b></th>
										<th ><b>Nama Aplikasi</b></th>
										<th width="12%"><b>Nama Pendek</b></th>
										<th ><b>Nama Panjang</b></th>
										<!-- <th ><b>Ikon</b></th> -->
										<th ><b>Skema</b></th>
										<th width="7%"><b>Status</b></th>
										<th width="10%"><b>Aksi</b></th>
									</tr>
								</thead>
							</table>
					</div>
				</div>
      </div>
    </section> 
<!-- <section class="content-header">
	<h1>Manajemen Aplikasi</h1>
	<ol class="breadcrumb">
        <li><a href="><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Aplikasi</li>
	</ol>
</section>
<section class="content">
	<div class="box">
		<div class="box-body">
            <table id="table" class="table table-striped table-bordered">
    			<thead>
    				<tr>
    					<td></td>
    					<td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_nama_app" name="filter_nama_app" maxlength="100"></td>
    					<td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_short_name" name="filter_short_name" maxlength="100"></td>
    					<td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_long_name" name="filter_long_name" maxlength="100"></td>
    					<td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_icon" name="filter_icon" maxlength="100"></td>
    					<td><select id="filter_scheme" name="filter_scheme" style="width:100%"></select></td>
    					<td><select id="filter_status" name="filter_status" style="width:100%"></select></td>
						<td class="text-center">
							<button type="button" onclick="reload_table()" data-toggle="tooltip" title="Saring" class="btn btn-secondary btn-sm"><i class="glyphicon glyphicon-filter"></i></button>
							<button type="button" onclick="add()" data-toggle="tooltip" title="Tambah" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-plus"></i></button>
						</td>
    				</tr>
    				<tr class="info">
    					<th width="5%"><b>No</b></th>
    					<th ><b>Nama Aplikasi</b></th>
    					<th width="12%"><b>Nama Pendek</b></th>
    					<th ><b>Nama Panjang</b></th>
    					<th ><b>Ikon</b></th>
    					<th ><b>Skema</b></th>
    					<th width="7%"><b>Status</b></th>
    					<th width="10%"><b>Aksi</b></th>
    				</tr>
    			</thead>
    		</table>
		</div>
	</div>
</section> -->

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
							<h3 class="modal-title">Tambah</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body form">
							<div class="form-body">
									<form action="#" id="form" class="form-horizontal">
										<div class="row">
											<div class="col-md-6">
												<input type="hidden" value="" name="id">
												<div class="form-group">
													<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
													<div class="col-md-12">
														<label>Nama Aplikasi :</label>
														<?php
														echo form_input(array(
															'name' => 'nama_app',
															'id' => 'nama_app',
															'class' => 'form-control input-sm',
															'placeholder' => 'Nama Aplikasi',
															'maxlength' => '100'
														));
														?>
														<span class="help-block"></span>
													</div>
												</div>
												<div class="form-group">
													<div class="col-md-12">
														<label>Nama Pendek :</label>
														<?php
														echo form_input(array(
															'name' => 'short_name',
															'id' => 'short_name',
															'class' => 'form-control input-sm',
															'placeholder' => 'Nama Pendek',
															'maxlength' => '100'
														));
														?>
														<span class="help-block"></span>
													</div>
												</div>
												<div class="form-group">
													<div class="col-md-12">
														<label>Nama Panjang :</label>
														<?php
														echo form_input(array(
															'name' => 'long_name',
															'id' => 'long_name',
															'class' => 'form-control input-sm',
															'placeholder' => 'Nama Panjang',
															'maxlength' => '100'
														));
														?>
														<span class="help-block"></span>
													</div>
												</div>
												<div class="form-group">
													<div class="col-md-12">
														<label>Ikon :</label>
														<?php
														echo form_input(array(
															'name' => 'icon',
															'id' => 'icon',
															'class' => 'form-control input-sm',
															'placeholder' => 'Ikon',
															'maxlength' => '100'
														));
														?>
														<span class="help-block"></span>
													</div>
												</div>
												<div class="form-group">
													<div class="col-md-12">
														<label>Skema Warna :</label>
														<?php
														$data = array(null => '--PILIH--');
														echo form_dropdown(
															'scheme', $data, FALSE, 'class="form-control" style="width:100%"'
														);
														?>
														<span class="help-block"></span>
													</div>
												</div>
												<div class="form-group">
													<div class="col-md-12">
														<label>Status :</label>
														<?php
														$data = array(null => '--PILIH--');
														echo form_dropdown(
															'status', $data, FALSE, 'class="form-control" style="width:100%"'
														);
														?>
														<span class="help-block"></span>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<div class="col-md-12">
														<label>Hak Akses :</label>
														<div class="id_menu"></div>
													</div>
												</div>
											</div>

										</div>
									</form>
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
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h3>Detail</h3>
			</div>
			<div class="modal-body">
				<div class="col-md-6">
					<strong>ID</strong>
					<p class="text-muted">
						<span class="id"></span>
					</p>
					<hr>
					<strong>Nama Aplikasi</strong>
					<p class="text-muted">
						<span class="nama_app"></span>
					</p>
					<hr>
					<strong>Nama Pendek</strong>
					<p class="text-muted">
						<span class="short_name"></span>
					</p>
					<hr>
					<strong>Nama Panjang</strong>
					<p class="text-muted">
						<span class="long_name"></span>
					</p>
					<hr>
					<strong>Ikon</strong>
					<p class="text-muted">
						<span class="icon"></span>
					</p>
					<hr>
					<strong>Skema Warna</strong>
					<p class="text-muted">
						<span class="scheme"></span>
					</p>
					<hr>
					<strong>Status</strong>
					<p class="text-muted">
						<span class="status"></span>
					</p>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<div class="col-md-12">
							<label>Hak Akses :</label>
							<div class="id_menu"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>