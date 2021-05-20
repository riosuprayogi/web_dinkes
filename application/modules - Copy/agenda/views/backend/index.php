<script type="text/javascript" src="<?php echo base_url() ?>/assets/js/fileinput.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.1/css/fileinput.css">
<!-- <script>
jQuery(function($){
			$.ajaxSetup({
				data: {'<?= $this->security->get_csrf_token_name() ?>' : '<?= $this->security->get_csrf_hash() ?>'}
			});
		});
</script> -->
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

	.kv-upload-progress {
		display: none;
	}

	.fileinput-cancel-button {
		display: none;
	}

	.fileinput-upload {
		display: none;
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


		var pesan = "Silahkan Masukan";

		$('#form2').validate({
			rules: {
				status_putusan: {
					required: true
				},

				pesan: {
					required: true,
					minlength: 5
				},

			},
			messages: {
				pesan: {
					required: pesan + " Alamat",
					minlength: "Your alamat must be at least 5 characters long"
				},
				status_putusan: pesan + " Email",

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
				send();
			}
		});

		//   $('#form1').validate({
		//       rules: {

		//         alamat: {
		//           required: true,
		//           minlength: 5
		//         },
		//         nama: {
		//           required: true
		//         },
		//         no_fax: {
		//           required: true
		//         },
		//         email: {
		//           required: true,
		//           email: true,
		//         },



		//       },
		//       messages: {
		//         alamat: {
		//           required: pesan+" Alamat",
		//           minlength: "Your alamat must be at least 5 characters long"
		//         },
		//         tujuan: {
		//           required: pesan+" Tujuan Informasi",
		//           minlength: "Your alamat must be at least 5 characters long"
		//         },
		//         rincian: {
		//           required: pesan+" Rincian",
		//           minlength: "Your alamat must be at least 5 characters long"
		//         },
		//         email : pesan+" Email",
		//         nik : pesan+" NIK",
		//         name : pesan+" Nama",
		//         no_tlp : pesan+" No Telepon",
		//         kategori : pesan+" Kategori",
		//         ktp : pesan+" KTP",
		//         kuasa : pesan+" Surat Kuasa",
		//         ktp_kuasa : pesan+" KTP Pemberi Kuasa",
		//         keterangan : pesan+" Surat Keterangan",
		//         akta : pesan+" Akta",
		//         pengesahan : pesan+" Surat Pengesahan",
		//         cara_memperoleh : pesan+" Cara Memperoleh Informasi",
		//         bentuk_informasi : pesan+" Bentuk Informasi",

		//       },
		//       errorElement: 'span',
		//       errorPlacement: function (error, element) {
		//       error.addClass('invalid-feedback');
		//       element.closest('.form-group').append(error);
		//       },
		//       highlight: function (element, errorClass, validClass) {
		//       $(element).addClass('is-invalid');
		//       },
		//       unhighlight: function (element, errorClass, validClass) {
		//       $(element).removeClass('is-invalid');
		//       },
		//       submitHandler: function (form) {
		//       save();
		//       }
		//     });

		table = $('#table').DataTable({
			paginationType: 'full_numbers',
			processing: true,
			serverSide: true,
			filter: false,
			autoWidth: false,
			ajax: {
				url: '<?php echo site_url('kategori/ajax_list') ?>',
				type: 'GET',
				data: function(data) {
					data.filter = {
						'nama_kategori': $('#filter_kategori').val(),
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
			order: [1, 'asc'],
			columns: [{
					'data': 'no',
					'orderable': false
				},
				// {
				// 	'data': 'id_kategori',
				// 	'visible': true
				// },
				{
					'data': 'nama_kategori'
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
			url: "<?php echo site_url('kategori/ajax_add/') ?>",
			type: "GET",
			dataType: "JSON",
			async: false,
			success: function(data) {


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
			url: "<?php echo site_url('kategori/ajax_edit/') ?>/" + id,
			type: "GET",
			dataType: "JSON",
			async: false,
			success: function(data) {
				$('[name="id"]').val(data.id_kategori);
				$('[name="nama_kategori"]').val(data.nama_kategori);

				$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Ubah'); // Set title to Bootstrap modal title
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function save() {
		var form = $('#form1')[0]; // You need to use standard javascript object here
		var formData = new FormData(form);
		$('#btnSave').text('Proses..'); //change button text
		$('#btnSave').attr('disabled', true); //set button disable
		var url;

		url = "<?php echo site_url('kategori/ajax_insert') ?>";
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

	function goBack() {
		window.history.back();
	}

	function del(id) {
		Swal.fire({
			title: 'Apa Anda Yakin?',
			text: "Apa Anda Yakin Menghapus Data?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: "<?php echo site_url('kategori/ajax_delete') ?>/" + id,
					type: "GET",
					dataType: "JSON",
					async: false,
					success: function(data) {
						Swal.fire({
							title: 'Berhasil',
							text: "Berhasil Menghapus Data!",
							icon: 'success',
							confirmButtonColor: '#3085d6',
							confirmButtonText: 'Ok'
						}).then((result) => {
							location.reload();
						});
					},
					error: function(jqXHR, textStatus, errorThrown) {
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
				<h1 class="m-0 text-dark">Manajemen Agenda</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"">Home</a></li>
              <li class=" breadcrumb-item active">Agenda</li>
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

						<!-- <td onclick="add()" style="vertical-align:middle; text-align:center;cursor:pointer;"><i class="glyphicon glyphicon-plus"></i></td> -->
						<td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_kategori" name="filter_kategori" maxlength="100"></td>

						<td onclick="reload_table()" style="vertical-align:middle; text-align:center;cursor:pointer;"><b><i class="fas fa-filter"></i></b></td>
					</tr>
					<tr class="info">
						<th style="vertical-align: middle;" width="5%">
							<center><b>No</b></center>
						</th>
						<th style="vertical-align : middle !important;" width="24%">
							<center><b>Nama kategori</b></center>
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

<section class="content">
	<div class="card">
		<div class="card-body p-0">
			<!-- THE CALENDAR -->
			<div id="calendar" class="fc fc-ltr fc-unthemed" style="">
				<div class="fc-toolbar fc-header-toolbar">
					<div class="fc-left">
						<div class="fc-button-group"><button type="button" class="fc-prev-button fc-button fc-button-primary" aria-label="prev"><span class="fc-icon fc-icon-chevron-left"></span></button><button type="button" class="fc-next-button fc-button fc-button-primary" aria-label="next"><span class="fc-icon fc-icon-chevron-right"></span></button></div><button type="button" class="fc-today-button fc-button fc-button-primary" disabled="">today</button>
					</div>
					<div class="fc-center">
						<h2>April 2021</h2>
					</div>
					<div class="fc-right">
						<div class="fc-button-group"><button type="button" class="fc-dayGridMonth-button fc-button fc-button-primary fc-button-active">month</button><button type="button" class="fc-timeGridWeek-button fc-button fc-button-primary">week</button><button type="button" class="fc-timeGridDay-button fc-button fc-button-primary">day</button></div>
					</div>
				</div>
				<div class="fc-view-container">
					<div class="fc-view fc-dayGridMonth-view fc-dayGrid-view" style="">
						<table class="">
							<thead class="fc-head">
								<tr>
									<td class="fc-head-container fc-widget-header">
										<div class="fc-row fc-widget-header">
											<table class="">
												<thead>
													<tr>
														<th class="fc-day-header fc-widget-header fc-sun"><span>Sun</span></th>
														<th class="fc-day-header fc-widget-header fc-mon"><span>Mon</span></th>
														<th class="fc-day-header fc-widget-header fc-tue"><span>Tue</span></th>
														<th class="fc-day-header fc-widget-header fc-wed"><span>Wed</span></th>
														<th class="fc-day-header fc-widget-header fc-thu"><span>Thu</span></th>
														<th class="fc-day-header fc-widget-header fc-fri"><span>Fri</span></th>
														<th class="fc-day-header fc-widget-header fc-sat"><span>Sat</span></th>
													</tr>
												</thead>
											</table>
										</div>
									</td>
								</tr>
							</thead>
							<tbody class="fc-body">
								<tr>
									<td class="fc-widget-content">
										<div class="fc-scroller fc-day-grid-container" style="overflow: hidden; height: 658.2px;">
											<div class="fc-day-grid">
												<div class="fc-row fc-week fc-widget-content" style="height: 109px;">
													<div class="fc-bg">
														<table class="">
															<tbody>
																<tr>
																	<td class="fc-day fc-widget-content fc-sun fc-other-month fc-past" data-date="2021-03-28"></td>
																	<td class="fc-day fc-widget-content fc-mon fc-other-month fc-past" data-date="2021-03-29"></td>
																	<td class="fc-day fc-widget-content fc-tue fc-other-month fc-past" data-date="2021-03-30"></td>
																	<td class="fc-day fc-widget-content fc-wed fc-other-month fc-past" data-date="2021-03-31"></td>
																	<td class="fc-day fc-widget-content fc-thu fc-past" data-date="2021-04-01"></td>
																	<td class="fc-day fc-widget-content fc-fri fc-past" data-date="2021-04-02"></td>
																	<td class="fc-day fc-widget-content fc-sat fc-past" data-date="2021-04-03"></td>
																</tr>
															</tbody>
														</table>
													</div>
													<div class="fc-content-skeleton">
														<table>
															<thead>
																<tr>
																	<td class="fc-day-top fc-sun fc-other-month fc-past" data-date="2021-03-28"><span class="fc-day-number">28</span></td>
																	<td class="fc-day-top fc-mon fc-other-month fc-past" data-date="2021-03-29"><span class="fc-day-number">29</span></td>
																	<td class="fc-day-top fc-tue fc-other-month fc-past" data-date="2021-03-30"><span class="fc-day-number">30</span></td>
																	<td class="fc-day-top fc-wed fc-other-month fc-past" data-date="2021-03-31"><span class="fc-day-number">31</span></td>
																	<td class="fc-day-top fc-thu fc-past" data-date="2021-04-01"><span class="fc-day-number">1</span></td>
																	<td class="fc-day-top fc-fri fc-past" data-date="2021-04-02"><span class="fc-day-number">2</span></td>
																	<td class="fc-day-top fc-sat fc-past" data-date="2021-04-03"><span class="fc-day-number">3</span></td>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" style="background-color:#f56954;border-color:#f56954">
																			<div class="fc-content"><span class="fc-time">12a</span> <span class="fc-title">All Day Event</span></div>
																		</a></td>
																	<td></td>
																	<td></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
												<div class="fc-row fc-week fc-widget-content" style="height: 109px;">
													<div class="fc-bg">
														<table class="">
															<tbody>
																<tr>
																	<td class="fc-day fc-widget-content fc-sun fc-past" data-date="2021-04-04"></td>
																	<td class="fc-day fc-widget-content fc-mon fc-past" data-date="2021-04-05"></td>
																	<td class="fc-day fc-widget-content fc-tue fc-past" data-date="2021-04-06"></td>
																	<td class="fc-day fc-widget-content fc-wed fc-past" data-date="2021-04-07"></td>
																	<td class="fc-day fc-widget-content fc-thu fc-past" data-date="2021-04-08"></td>
																	<td class="fc-day fc-widget-content fc-fri fc-past" data-date="2021-04-09"></td>
																	<td class="fc-day fc-widget-content fc-sat fc-past" data-date="2021-04-10"></td>
																</tr>
															</tbody>
														</table>
													</div>
													<div class="fc-content-skeleton">
														<table>
															<thead>
																<tr>
																	<td class="fc-day-top fc-sun fc-past" data-date="2021-04-04"><span class="fc-day-number">4</span></td>
																	<td class="fc-day-top fc-mon fc-past" data-date="2021-04-05"><span class="fc-day-number">5</span></td>
																	<td class="fc-day-top fc-tue fc-past" data-date="2021-04-06"><span class="fc-day-number">6</span></td>
																	<td class="fc-day-top fc-wed fc-past" data-date="2021-04-07"><span class="fc-day-number">7</span></td>
																	<td class="fc-day-top fc-thu fc-past" data-date="2021-04-08"><span class="fc-day-number">8</span></td>
																	<td class="fc-day-top fc-fri fc-past" data-date="2021-04-09"><span class="fc-day-number">9</span></td>
																	<td class="fc-day-top fc-sat fc-past" data-date="2021-04-10"><span class="fc-day-number">10</span></td>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
												<div class="fc-row fc-week fc-widget-content" style="height: 109px;">
													<div class="fc-bg">
														<table class="">
															<tbody>
																<tr>
																	<td class="fc-day fc-widget-content fc-sun fc-past" data-date="2021-04-11"></td>
																	<td class="fc-day fc-widget-content fc-mon fc-past" data-date="2021-04-12"></td>
																	<td class="fc-day fc-widget-content fc-tue fc-past" data-date="2021-04-13"></td>
																	<td class="fc-day fc-widget-content fc-wed fc-past" data-date="2021-04-14"></td>
																	<td class="fc-day fc-widget-content fc-thu fc-past" data-date="2021-04-15"></td>
																	<td class="fc-day fc-widget-content fc-fri fc-past" data-date="2021-04-16"></td>
																	<td class="fc-day fc-widget-content fc-sat fc-past" data-date="2021-04-17"></td>
																</tr>
															</tbody>
														</table>
													</div>
													<div class="fc-content-skeleton">
														<table>
															<thead>
																<tr>
																	<td class="fc-day-top fc-sun fc-past" data-date="2021-04-11"><span class="fc-day-number">11</span></td>
																	<td class="fc-day-top fc-mon fc-past" data-date="2021-04-12"><span class="fc-day-number">12</span></td>
																	<td class="fc-day-top fc-tue fc-past" data-date="2021-04-13"><span class="fc-day-number">13</span></td>
																	<td class="fc-day-top fc-wed fc-past" data-date="2021-04-14"><span class="fc-day-number">14</span></td>
																	<td class="fc-day-top fc-thu fc-past" data-date="2021-04-15"><span class="fc-day-number">15</span></td>
																	<td class="fc-day-top fc-fri fc-past" data-date="2021-04-16"><span class="fc-day-number">16</span></td>
																	<td class="fc-day-top fc-sat fc-past" data-date="2021-04-17"><span class="fc-day-number">17</span></td>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-not-end fc-draggable" style="background-color:#f39c12;border-color:#f39c12">
																			<div class="fc-content"><span class="fc-time">12a</span> <span class="fc-title">Long Event</span></div>
																		</a></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
												<div class="fc-row fc-week fc-widget-content" style="height: 109px;">
													<div class="fc-bg">
														<table class="">
															<tbody>
																<tr>
																	<td class="fc-day fc-widget-content fc-sun fc-past" data-date="2021-04-18"></td>
																	<td class="fc-day fc-widget-content fc-mon fc-past" data-date="2021-04-19"></td>
																	<td class="fc-day fc-widget-content fc-tue fc-past" data-date="2021-04-20"></td>
																	<td class="fc-day fc-widget-content fc-wed fc-past" data-date="2021-04-21"></td>
																	<td class="fc-day fc-widget-content fc-thu fc-today " data-date="2021-04-22"></td>
																	<td class="fc-day fc-widget-content fc-fri fc-future" data-date="2021-04-23"></td>
																	<td class="fc-day fc-widget-content fc-sat fc-future" data-date="2021-04-24"></td>
																</tr>
															</tbody>
														</table>
													</div>
													<div class="fc-content-skeleton">
														<table>
															<thead>
																<tr>
																	<td class="fc-day-top fc-sun fc-past" data-date="2021-04-18"><span class="fc-day-number">18</span></td>
																	<td class="fc-day-top fc-mon fc-past" data-date="2021-04-19"><span class="fc-day-number">19</span></td>
																	<td class="fc-day-top fc-tue fc-past" data-date="2021-04-20"><span class="fc-day-number">20</span></td>
																	<td class="fc-day-top fc-wed fc-past" data-date="2021-04-21"><span class="fc-day-number">21</span></td>
																	<td class="fc-day-top fc-thu fc-today " data-date="2021-04-22"><span class="fc-day-number">22</span></td>
																	<td class="fc-day-top fc-fri fc-future" data-date="2021-04-23"><span class="fc-day-number">23</span></td>
																	<td class="fc-day-top fc-sat fc-future" data-date="2021-04-24"><span class="fc-day-number">24</span></td>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td class="fc-event-container" colspan="2"><a class="fc-day-grid-event fc-h-event fc-event fc-not-start fc-end fc-draggable" style="background-color:#f39c12;border-color:#f39c12">
																			<div class="fc-content"> <span class="fc-title">Long Event</span></div>
																		</a></td>
																	<td rowspan="2"></td>
																	<td rowspan="2"></td>
																	<td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" style="background-color:#0073b7;border-color:#0073b7">
																			<div class="fc-content"><span class="fc-time">10:30a</span> <span class="fc-title">Meeting</span></div>
																		</a></td>
																	<td class="fc-event-container" rowspan="2"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" style="background-color:#00a65a;border-color:#00a65a">
																			<div class="fc-content"><span class="fc-time">7p</span> <span class="fc-title">Birthday Party</span></div>
																		</a></td>
																	<td rowspan="2"></td>
																</tr>
																<tr>
																	<td></td>
																	<td></td>
																	<td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" style="background-color:#00c0ef;border-color:#00c0ef">
																			<div class="fc-content"><span class="fc-time">12p</span> <span class="fc-title">Lunch</span></div>
																		</a></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
												<div class="fc-row fc-week fc-widget-content" style="height: 109px;">
													<div class="fc-bg">
														<table class="">
															<tbody>
																<tr>
																	<td class="fc-day fc-widget-content fc-sun fc-future" data-date="2021-04-25"></td>
																	<td class="fc-day fc-widget-content fc-mon fc-future" data-date="2021-04-26"></td>
																	<td class="fc-day fc-widget-content fc-tue fc-future" data-date="2021-04-27"></td>
																	<td class="fc-day fc-widget-content fc-wed fc-future" data-date="2021-04-28"></td>
																	<td class="fc-day fc-widget-content fc-thu fc-future" data-date="2021-04-29"></td>
																	<td class="fc-day fc-widget-content fc-fri fc-future" data-date="2021-04-30"></td>
																	<td class="fc-day fc-widget-content fc-sat fc-other-month fc-future" data-date="2021-05-01"></td>
																</tr>
															</tbody>
														</table>
													</div>
													<div class="fc-content-skeleton">
														<table>
															<thead>
																<tr>
																	<td class="fc-day-top fc-sun fc-future" data-date="2021-04-25"><span class="fc-day-number">25</span></td>
																	<td class="fc-day-top fc-mon fc-future" data-date="2021-04-26"><span class="fc-day-number">26</span></td>
																	<td class="fc-day-top fc-tue fc-future" data-date="2021-04-27"><span class="fc-day-number">27</span></td>
																	<td class="fc-day-top fc-wed fc-future" data-date="2021-04-28"><span class="fc-day-number">28</span></td>
																	<td class="fc-day-top fc-thu fc-future" data-date="2021-04-29"><span class="fc-day-number">29</span></td>
																	<td class="fc-day-top fc-fri fc-future" data-date="2021-04-30"><span class="fc-day-number">30</span></td>
																	<td class="fc-day-top fc-sat fc-other-month fc-future" data-date="2021-05-01"><span class="fc-day-number">1</span></td>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td class="fc-event-container"><a class="fc-day-grid-event fc-h-event fc-event fc-start fc-end fc-draggable" href="http://google.com/" style="background-color:#3c8dbc;border-color:#3c8dbc">
																			<div class="fc-content"><span class="fc-time">12a</span> <span class="fc-title">Click for Google</span></div>
																		</a></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
												<div class="fc-row fc-week fc-widget-content" style="height: 113px;">
													<div class="fc-bg">
														<table class="">
															<tbody>
																<tr>
																	<td class="fc-day fc-widget-content fc-sun fc-other-month fc-future" data-date="2021-05-02"></td>
																	<td class="fc-day fc-widget-content fc-mon fc-other-month fc-future" data-date="2021-05-03"></td>
																	<td class="fc-day fc-widget-content fc-tue fc-other-month fc-future" data-date="2021-05-04"></td>
																	<td class="fc-day fc-widget-content fc-wed fc-other-month fc-future" data-date="2021-05-05"></td>
																	<td class="fc-day fc-widget-content fc-thu fc-other-month fc-future" data-date="2021-05-06"></td>
																	<td class="fc-day fc-widget-content fc-fri fc-other-month fc-future" data-date="2021-05-07"></td>
																	<td class="fc-day fc-widget-content fc-sat fc-other-month fc-future" data-date="2021-05-08"></td>
																</tr>
															</tbody>
														</table>
													</div>
													<div class="fc-content-skeleton">
														<table>
															<thead>
																<tr>
																	<td class="fc-day-top fc-sun fc-other-month fc-future" data-date="2021-05-02"><span class="fc-day-number">2</span></td>
																	<td class="fc-day-top fc-mon fc-other-month fc-future" data-date="2021-05-03"><span class="fc-day-number">3</span></td>
																	<td class="fc-day-top fc-tue fc-other-month fc-future" data-date="2021-05-04"><span class="fc-day-number">4</span></td>
																	<td class="fc-day-top fc-wed fc-other-month fc-future" data-date="2021-05-05"><span class="fc-day-number">5</span></td>
																	<td class="fc-day-top fc-thu fc-other-month fc-future" data-date="2021-05-06"><span class="fc-day-number">6</span></td>
																	<td class="fc-day-top fc-fri fc-other-month fc-future" data-date="2021-05-07"><span class="fc-day-number">7</span></td>
																	<td class="fc-day-top fc-sat fc-other-month fc-future" data-date="2021-05-08"><span class="fc-day-number">8</span></td>
																</tr>
															</thead>
															<tbody>
																<tr>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
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
										<label for=""> Nama Kategori</label>
										<input type="text" name="nama_kategori" class="form-control" placeholder="Masukkan Kategori" required>
									</div>
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





<script>
	$(function() {

		/* Summernote Validation */

		var summernoteForm = $('#form1');
		var summernoteElement = $('.summernote');

		var summernoteValidator = summernoteForm.validate({
			errorElement: "div",
			errorClass: 'is-invalid',
			validClass: 'is-valid',
			ignore: ':hidden:not(.summernote),.note-editable.card-block',
			errorPlacement: function(error, element) {
				// Add the `help-block` class to the error element
				error.addClass("invalid-feedback");
				console.log(element);
				if (element.prop("type") === "checkbox") {
					error.insertAfter(element.siblings("label"));
				} else if (element.hasClass("summernote")) {
					error.insertAfter(element.siblings(".note-editor"));
				} else {
					error.insertAfter(element);
				}
			},
			submitHandler: function(form) {
				save();
				// console.log(form)
			}
		});

		summernoteElement.summernote({
			toolbar: [
				['style', ['bold', 'italic', 'underline', 'clear']],
				['font', ['strikethrough', 'superscript', 'subscript']],
				['fontsize', ['fontsize']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				['height', ['height']]
			],
			placeholder: 'Pesan',
			tabsize: 2,
			height: 300,
			callbacks: {
				onChange: function(contents, $editable) {
					// Note that at this point, the value of the `textarea` is not the same as the one
					// you entered into the summernote editor, so you have to set it yourself to make
					// the validation consistent and in sync with the value.
					summernoteElement.val(summernoteElement.summernote('isEmpty') ? "" : contents);

					// You should re-validate your element after change, because the plugin will have
					// no way to know that the value of your `textarea` has been changed if the change
					// was done programmatically.
					summernoteValidator.element(summernoteElement);
				}
			}
		});


	});
</script>