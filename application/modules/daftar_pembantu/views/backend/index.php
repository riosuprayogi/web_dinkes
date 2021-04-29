<style>
	.select2-selection--single {
		height: 100% !important;
	}

	.select2-selection__rendered {
		word-wrap: break-word !important;
		text-overflow: inherit !important;
		white-space: normal !important;
	}

	td {
		text-transform: uppercase
	}

	ul.timelines {
		list-style-type: none;
		position: relative;
	}

	ul.timelines:before {
		content: ' ';
		background: #d4d9df;
		display: inline-block;
		position: absolute;
		left: 29px;
		width: 2px;
		height: 100%;
		z-index: 400;
	}

	ul.timelines>li {
		margin: 20px 0;
		padding-left: 20px;
	}

	ul.timelines>li:before {
		content: ' ';
		background: white;
		display: inline-block;
		position: absolute;
		border-radius: 50%;
		border: 3px solid #22c0e8;
		left: 20px;
		width: 20px;
		height: 20px;
		z-index: 400;
	}
</style>
<script>
	var save_method; //for save method string
	var table;
	var table2;

	$(document).ready(function() {

		$('#no_tlp').on('input', function(event) {
			this.value = this.value.replace(/[^0-9]/g, '');
		});


		var pesan = "Silahkan Masukan";

		$('#form1').validate({
			rules: {

				alamat: {
					required: true,
					minlength: 5
				},
				nama: {
					required: true
				},
				no_fax: {
					required: true
				},




			},
			messages: {

				skpd: pesan + " SKPD",
				kategori: pesan + " Kategori",
				no_tlp: pesan + " No Telepon",
				email: pesan + " Email",
				web: pesan + " Website",
			},
			errorElement: 'span',
			errorPlacement: function(error, element) {
				error.addClass('invalid-feedback');
				element.closest('.form-group').append(error);
			},
			highlight: function(element, errorClass, validClass) {
				$(element).addClass('is-invalid');
			},
			unhighlight: function(element, errorClass, validClass) {
				$(element).removeClass('is-invalid');
			},
			submitHandler: function(form) {
				save();
			}
		});

		table = $('#table').DataTable({
			paginationType: 'full_numbers',
			processing: true,
			serverSide: true,
			filter: false,
			autoWidth: false,
			ajax: {
				url: '<?php echo site_url('daftar_pembantu/ajax_list') ?>',
				type: 'GET',
				header: {
					'<?= $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', //replace by your name/value
				},
				data: function(data) {
					data.filter = {
						'username': $('#filter_dasar_hukum').val(),
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

				{
					'data': 'aksi',
					'orderable': false
				}
			]
		});


		$('[name="username"]').change(function() {
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});

		$('[name="nama"]').change(function() {
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});

		$('[name="app_id"]').change(function() {
			$(this).parent().removeClass('has-error');
			$(this).next().next().empty();
			if ($(this).val())
				$('#appname').val($(this).find('option:selected').text());
		});
		$('[name="access"]').change(function() {
			$(this).parent().removeClass('has-error');
			$(this).next().next().empty();
		});

		$('[name="nama_skpd"]').change(function() {
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});

		$("#filter_no_permohonan").keyup(function(event) {
			if (event.keyCode == 13) {
				reload_table();
			}
		});

		$("#filter_nama").keyup(function(event) {
			if (event.keyCode == 13) {
				reload_table();
			}
		});

		$("#filter_kategori").change(function() {
			reload_table();
		});


	});

	function reload_table() {
		table.ajax.reload(null, false);
	}

	function add() {
		save_method = 'add';
		$('#form1')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.col-md-12').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('daftar_pembantu/ajax_add/') ?>",
			type: "GET",
			dataType: "JSON",
			async: false,
			success: function(data) {
				$('#skpd,#kategori').empty();
				$('#skpd,#kategori').append('<option value="">==== Pilih ====</option>');
				for (var i = 0; i < data.skpd.length; i++) {
					$('#skpd').append('<option value="' + data.skpd[i].id_skpd + '">' + data.skpd[i].nama_lengkap + '</option>');
				}
				for (var i = 0; i < data.kategori.length; i++) {
					$('#kategori').append('<option value="' + data.kategori[i].id_kategori_pembantu + '">' + data.kategori[i].nama + '</option>');
				}
				$('#modal_form').modal('show'); // show bootstrap modal
				$('.modal-title').text('Tambah'); // Set Title to Bootstrap modal title
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function clear() {

		$('.preview-ktps').css('display', 'none');
		$('.preview-kuasas').css('display', 'none');
		$('.preview-ktp_kuasas').css('display', 'none');
		$('.preview-keterangans').css('display', 'none');
		$('.preview-aktas').css('display', 'none');
		$('.preview-pengesahans').css('display', 'none');
	}

	function edit(id) {
		save_method = 'edit';
		$('#form1')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.col-md-12').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('daftar_pembantu/ajax_edit/') ?>/" + id,
			type: "GET",
			dataType: "JSON",
			async: false,
			success: function(data) {

				$('#skpd,#kategori').empty();
				$('#skpd,#kategori').append('<option value="">==== Pilih ====</option>');
				for (var i = 0; i < data.skpd.length; i++) {
					$('#skpd').append('<option value="' + data.skpd[i].id_skpd + '">' + data.skpd[i].nama_lengkap + '</option>');
				}
				for (var i = 0; i < data.kategori.length; i++) {
					$('#kategori').append('<option value="' + data.kategori[i].id_kategori_pembantu + '">' + data.kategori[i].nama + '</option>');
				}

				$('[name="id"]').val(data.id_daftar_pembantu);
				$('#skpd').val(data.id_skpd);
				$('#email').val(data.email);
				$('#web').val(data.website);
				$('#alamat').val(data.alamat);

				$('#no_tlp').val(data.no_tlp);
				// $('#skpd').val(data.no_tlp);
				$('#kategori').val(data.id_kategori_pembantu);

				$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Ubah'); // Set title to Bootstrap modal title
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function detail(id) {
		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('daftar_pembantu/ajax_edit/') ?>/" + id,
			type: "GET",
			dataType: "JSON",
			async: false,
			success: function(data) {
				// $('.id').html(data.id_user);
				$('.skpd').html(data.nama_skpd);
				$('.kategori').html(data.nama_kategori);
				$('.email').html(data.email);
				$('.website').html(data.website);
				$('.alamat').html(data.alamat);
				$('.no_tlp').html(data.no_tlp);

				$('#modal_detail').modal('show'); // show bootstrap modal when complete loaded

				table3.ajax.reload(null, false);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function putusan(id) {
		$('#form2')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.col-md-12').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('daftar_pembantu/ajax_edit/') ?>/" + id,
			type: "GET",
			dataType: "JSON",
			async: false,
			success: function(data) {

				$('[name="judul"]').val(data.judul);
				$("#isian").summernote("code", data.isi);

				$('#modal_putusan').modal('show'); // show bootstrap modal
				$('.modal-title').text('Putusan'); // Set Title to Bootstrap modal title
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
				location.reload();
			}
		});
	}


	function save() {
		var form = $('#form1')[0]; // You need to use standard javascript object here
		var formData = new FormData(form);
		$('#btnSave').text('Proses..'); //change button text
		$('#btnSave').attr('disabled', true); //set button disable
		var url;

		url = "<?php echo site_url('daftar_pembantu/ajax_insert') ?>";
		Swal.fire({
			title: 'Apa Anda Yakin?',
			text: "Apa Anda Yakin Menyimpan Data?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak'
		}).then((result) => {
			if (result.value) {
				// ajax adding data to database
				$.ajax({
					url: url,
					type: "POST",
					data: formData,
					dataType: "JSON",
					cache: false,
					contentType: false,
					processData: false, //async: false,
					success: function(data) {

						if (data.status) {
							Swal.fire({
								title: 'Berhasil',
								text: "Berhasil Menyimpan Data!",
								icon: 'success',
								confirmButtonColor: '#3085d6',
								confirmButtonText: 'Ok'
							}).then((result) => {
								location.reload();
							});

						}

						$('#btnSave').text('Simpan'); //change button text
						$('#btnSave').attr('disabled', false); //set button enable


					},
					error: function(jqXHR, textStatus, errorThrown) {
						alert('Error adding / update data');
						$('#btnSave').text('Simpan'); //change button text
						$('#btnSave').attr('disabled', false); //set button enable

					}
				});
			}
		});
	}


	function send() {
		var form = $('#form2')[0]; // You need to use standard javascript object here
		var formData = new FormData(form);
		$('#btnSave').text('Proses..'); //change button text
		$('#btnSave').attr('disabled', true); //set button disable
		var url;

		url = "<?php echo site_url('daftar_pembantu/ajax_putusan') ?>";
		Swal.fire({
			title: 'Apa Anda Yakin?',
			text: "Apa Anda Yakin Menyimpan Data?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak'
		}).then((result) => {
			if (result.value) {
				// ajax adding data to putusan
				$.ajax({
					url: url,
					type: "POST",
					data: formData,
					dataType: "JSON",
					cache: false,
					contentType: false,
					processData: false, //async: false,
					success: function(data) {

						if (data.status) {

							Swal.fire({
								title: 'Berhasil',
								text: "Berhasil Menyimpan Data!",
								icon: 'success',
								confirmButtonColor: '#3085d6',
								confirmButtonText: 'Ok'
							}).then((result) => {
								location.reload();
							});

						}

						$('#btnSave').text('Simpan'); //change button text
						$('#btnSave').attr('disabled', false); //set button enable


					},
					error: function(jqXHR, textStatus, errorThrown) {
						alert('Error adding / update data');
						$('#btnSave').text('Simpan'); //change button text
						$('#btnSave').attr('disabled', false); //set button enable

					}
				});
			}
		});
	}

	function goBack() {
		window.history.back();
	}

	function del(id) {
		Swal.fire({
			title: 'Apa Anda Yakin?',
			text: "Apa Anda Yakin Menyimpan Data?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: "<?php echo site_url('daftar_pembantu/ajax_delete/') ?>" + id,
					type: "GET",
					dataType: "JSON",
					async: false,
					success: function(data) {
						reload_table();
					},
					error: function(jqXHR, textStatus, errorThrown) {
						alert('Error deleting data');
					}
				});
			}
		});

	}

	function del_cart(rowid) {
		$.ajax({
			url: "<?php echo site_url('user/ajax_delete_cart/'); ?>/" + rowid,
			type: "POST",
			dataType: "JSON",
			success: function(data) {
				table2.ajax.reload(null, false);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error deleting data');
			}
		});
	}
</script>
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Manajemen Daftar Pembantu</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"">Home</a></li>
              <li class=" breadcrumb-item active">Daftar Pembantu</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<section class="content">
	<div class="card">
		<div class="card-body">
			<table id="table" class="table table-striped table-sm table-bordered">
				<thead>
					<tr>
						<td onclick="add()" style="vertical-align:middle; text-align:center;cursor:pointer;"><b><i class="fas fa-plus"></i></b></td>
						<td></td>
						<!-- <td onclick="add()" style="vertical-align:middle; text-align:center;cursor:pointer;"><i class="glyphicon glyphicon-plus"></i></td> -->
						<td><input style="width:100%;" placeholder="Cari..." class="form-control input-sm" type="text" id="filter_dasar_hukum" name="filter_dasar_hukum" maxlength="100"></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td onclick="reload_table()" style="vertical-align:middle; text-align:center;cursor:pointer;"><b><i class="fas fa-filter"></i></b></td>
					</tr>
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
						<th style="vertical-align : middle !important;" width="10%">
							<center><b>Aksi</b></center>
						</th>
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
			<form role="form" id="form1" class="form-validate-summernote">
				<div class="modal-body form">
					<div class="form-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12">
									<input type="hidden" value="" id="id" name="id">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									<div class="form-group">
										<label for=""> SKPD</label>
										<select name="skpd" id="skpd" class="form-control" required></select>
									</div>
									<div class="form-group">
										<label>Kategori</label>
										<select name="kategori" id="kategori" class="form-control" required></select>
									</div>
									<div class="form-group">
										<label> Email</label>
										<input type="text" name="email" id="email" class="form-control">
									</div>
									<div class="form-group">
										<label> Website</label>
										<input type="text" name="web" id="web" class="form-control">
									</div>
									<div class="form-group">
										<label> Alamat</label>
										<input type="text" name="alamat" id="alamat" class="form-control" required>
									</div>
									<div class="form-group">
										<label> No Telepon</label>
										<input type="text" name="no_tlp" id="no_tlp" class="form-control" required>
									</div>
									<!-- adun close -->
								</div>

							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="btnSave" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_histori" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"></h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>

			<div class="modal-body form">
				<div class="row">
					<div class="col-md-12">
						<h4>Riwayat Putusan</h4>
						<ul class="timelines">

						</ul>
					</div>
				</div>
			</div>
			<div class="modal-footer">
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
				<div class="col-md-8">
					<strong>SKPD</strong>
					<p class="text-muted">
						<span class="skpd"></span>
					</p>
					<hr>
					<strong>KATEGORI</strong>
					<p class="text-muted">
						<span class="kategori"></span>
					</p>
					<hr>
					<strong>EMAIL</strong>
					<p class="text-muted">
						<span class="email"></span>
					</p>
					<hr>
					<strong>ALAMAT</strong>
					<p class="text-muted">
						<span class="alamat"></span>
					</p>
					<hr>
					<strong>NO TELEPON</strong>
					<p class="text-muted">
						<span class="no_tlp"></span>
					</p>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>