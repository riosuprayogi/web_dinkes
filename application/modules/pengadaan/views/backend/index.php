<!-- <link rel="stylesheet" href="<?php echo base_url('assets/css/vue-treeselect.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/treeview/css/bootstrap-treeview.min.css') ?>">
  <script src="<?php echo base_url('assets/plugins/treeview/js/bootstrap-treeview.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/js/vue.js') ?>"></script>
  <script src="<?php echo base_url('assets/js/vue-treeselect.umd.min.js') ?>"  ></script> -->


<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/') ?>default/easyui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/') ?>icon.css">
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.easyui.min.js') ?>"></script>
<style>
	.select2-selection--single {
		height: 100% !important;
	}

	.treeview span.icon.expand-icon {
		position: relative !important;
		top: 13px !important;
	}

	.treeview span.indent {
		margin-left: 0px !important;
		margin-right: 0px !important;
	}

	.select2-selection__rendered {
		word-wrap: break-word !important;
		text-overflow: inherit !important;
		white-space: normal !important;
	}

	.tree-node {
		white-space: nowrap !important;
	}

	.tree-title {
		white-space: normal !important;
		display: inline !important;
	}

	.tree td {
		text-transform: uppercase
	}

	.tt_datagrid-cell-c1-deskripsi {
		white-space: normal !important;
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



	function tree(data, select = null) {
		Vue.component('treeselect', VueTreeselect.Treeselect)
		new Vue({
			el: '#app',
			data: {
				value: select,
				options: data,
			},
		})
	}

	table_data();

	function table_data() {

	}


	$(".refresh").click(function() {
		table_data();
	});

	function refresh() {
		location.reload();
	}

	function get_data_jenis(id) {
		$.ajax({
			url: "<?php echo site_url('dokumen/get_data_jenis/') ?>" + id,
			type: "GET",
			dataType: "JSON",
			async: false,
			success: function(data) {
				$('.judul_jenis').html(data.jenis_informasi);

			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	$(document).ready(function() {

		get_data_jenis(<?= $this->uri->segment(3); ?>);

		$('#tt').treegrid({
			url: '<?php echo base_url('dokumen/ajax_trees?key=') ?>' + '<?= $this->uri->segment(3); ?>',
			idField: 'id',
			treeField: 'name',
			columns: [
				[{
						title: 'INFORMASI',
						field: 'name',
						width: 400,
						styler: function(value, row, index) {
							if (value < 20) {
								// return 'background-color:#ffee00;color:red;';
								return 'white-space:nowrap';
								// the function can return predefined css class and inline style
								// return {class:'c1',style:'color:red'}
							}
						}
					},
					{
						field: 'deskripsi',
						title: 'Deskripsi',
						width: 480,
						styler: function(value, row, index) {
							if (value < 20) {
								// return 'background-color:#ffee00;color:red;';
								return 'white-space:normal !important';
								// the function can return predefined css class and inline style
								// return {class:'c1',style:'color:red'}
							}
						}
					},
					{
						field: 'tahun',
						title: 'TAHUN',
						styler: function(value, row, index) {
							if (value < 20) {
								// return 'background-color:#ffee00;color:red;';
								return 'min-width:100px';
								// the function can return predefined css class and inline style
								// return {class:'c1',style:'color:red'}
							}
						}
					},
					// {field:'urutan',title:'Urutan',
					// 	styler: function(value,row,index){
					// 	if (value < 20){
					// 		// return 'background-color:#ffee00;color:red;';
					// 		return 'min-width:100px';
					// 		// the function can return predefined css class and inline style
					// 		// return {class:'c1',style:'color:red'}
					// 	}
					// }},
					{
						field: 'file',
						title: 'FILE',
						styler: function(value, row, index) {
							if (value < 20) {
								// return 'background-color:#ffee00;color:red;';
								return 'min-width:100px';
								// the function can return predefined css class and inline style
								// return {class:'c1',style:'color:red'}
							}
						}
					},
					{
						field: 'aksi',
						title: 'AKSI',
						width: 150,
						align: 'center'
					}
				]
			]
		});

		var pesan = "Silahkan Masukan";

		$('#form_jenis').validate({
			messages: {

				jenis: pesan + " Informasi",
				kategori: pesan + " Kategori",

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
				save_parent();
			}
		});

		$('#form_parent').validate({
			messages: {

				judul: pesan + " Informasi",
				isian: pesan + " Deskripsi"
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
				save_parent();
			}
		});

		$('#form_file').validate({
			messages: {

				tahun: pesan + " Informasi",
				file: pesan + " Deskripsi"
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
				save_file();
			}
		});

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
				email: {
					required: true,
					email: true,
				},



			},
			messages: {

				skpd: pesan + " SKPD",
				kategori: pesan + " Kategori",

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

		// table = $('#table').DataTable({
		// 	paginationType:'full_numbers',
		// 	processing: true,
		// 	serverSide: true,
		// 	filter: false, 
		// 	autoWidth: false,
		// 	ajax: {
		// 		url: '<?php echo site_url('dokumen/ajax_list') ?>',
		// 		type: 'GET',
		// 		header: {
		//         '<?= $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', //replace by your name/value
		//       	},
		// 		data: function (data) {
		// 			data.filter = {
		// 				'username':$('#filter_dasar_hukum').val(),
		// 			};
		// 		}
		// 	},
		// 	language: {
		// 		sProcessing: '<img src="<?php echo base_url('assets/img/process.gif') ?>" width="20px"> Sedang memproses...',
		// 		sLengthMenu: 'Tampilkan _MENU_ entri',
		// 		sZeroRecords: 'Tidak ditemukan data yang sesuai',
		// 		sInfo: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
		// 		sInfoEmpty: 'Menampilkan 0 sampai 0 dari 0 entri',
		// 		sInfoFiltered: '(disaring dari _MAX_ entri keseluruhan)',
		// 		sInfoPostFix: '',
		// 		sSearch: 'Cari:',
		// 		sUrl: '',
		// 		oPaginate: {
		// 			sFirst: '<<',
		// 			sPrevious: '<',
		// 			sNext: '>',
		// 			sLast: '>>'
		// 		}
		// 	},
		// 	order: [1, 'asc'],
		// 	columns: [
		// 		{'data':'no','orderable':false},
		// 		{'data':'id_jenis_informasi',"visible": false},
		// 		{'data':'informasi'},
		// 		{'data':'deskripsi'},
		// 		{'data':'aksi','orderable':false}
		// 	]
		// });


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

		$('#urutan').on('input', function(event) {
			this.value = this.value.replace(/[^0-9]/g, '');
		});

		$('[name="option"]').on('change', function() {
			option(this.value);

		});




	});

	$(function() {
		$('a.copy').relCopy();
	});

	function reload_table() {
		table.ajax.reload(null, false);
	}

	function option(id) {
		$('.form-link').hide();
		$('.form-file').hide();
		if (id == 'file') {
			$('.form-file').show();
		} else if (id == 'link') {
			$('.form-link').show();
		}
	}

	function add() {
		save_method = 'add';
		$('#form1')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.col-md-12').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('dokumen/ajax_add/') ?>",
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

	function add_jenis() {
		$('#form_jenis')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.col-md-12').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('dokumen/ajax_add/') ?>",
			type: "GET",
			dataType: "JSON",
			async: false,
			success: function(data) {
				$('.jenis').show();
				$('[name="jenis"]').empty();
				$('[name="jenis"]').append('<option>====PILIH=====</option>');
				for (var i = 0; i < data.jenis.length; i++) {
					$('[name="jenis"]').append('<option value="' + data.jenis[i].id_jenis_informasi + '">' + data.jenis[i].jenis_informasi + '</option>');
				}

				$('#modal_form_parent').modal('show'); // show bootstrap modal
				$('.modal-title').text('Tambah'); // Set Title to Bootstrap modal title
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function edit_jenis(id) {
		$('#form_jenis')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.col-md-12').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('dokumen/ajax_edit_jenis/') ?>/" + id,
			type: "GET",
			dataType: "JSON",
			async: false,
			success: function(data) {

				$('.jenis').show();
				$('[name="jenis"]').empty();
				$('[name="jenis"]').append('<option>====PILIH=====</option>');
				for (var i = 0; i < data.jenis.length; i++) {
					$('[name="jenis"]').append('<option value="' + data.jenis[i].id_jenis_informasi + '">' + data.jenis[i].jenis_informasi + '</option>');
				}
				$('#id_informasi').val(id);
				$('#jenis').val(data.id_jenis_informasi);

				$('#modal_form_parent').modal('show'); // show bootstrap modal
				$('.modal-title').text('Ubah'); // Set Title to Bootstrap modal title
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function add_parent(id) {
		$('#form_parent')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.col-md-12').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		if (id != 0) {
			var url = "<?php echo site_url('dokumen/ajax_edit_parent/') ?>" + id;

		} else {
			var url = "<?php echo site_url('dokumen/ajax_add/') ?>"
		}
		//Ajax Load data from ajax
		$.ajax({
			url: url,
			type: "GET",
			dataType: "JSON",
			async: false,
			success: function(data) {

				$('[name="jenis"]').empty();
				$('[name="jenis"]').append('<option>====PILIH=====</option>');
				for (var i = 0; i < data.jenis.length; i++) {
					$('[name="jenis"]').append('<option value="' + data.jenis[i].id_jenis_informasi + '">' + data.jenis[i].jenis_informasi + '</option>');
				}

				$('[name="option"]').empty();
				$('[name="option"]').append('<option>====PILIH=====</option>');
				$('[name="option"]').append('<option value="file">FILE</option>');
				$('[name="option"]').append('<option value="link">LINK</option>');
				$('.form-file').hide();
				$('.form-link').hide();


				if (id != 0) {
					$('#id_parent').val(id);
					$('.jenis').hide();
					$('[name="jenis"]').val(data.id_jenis_informasi);
				} else {
					$('.jenis').hide();
					$('[name="jenis"]').val(<?= $this->uri->segment(3); ?>);
				}

				$(".files").empty();




				$('#modal_form_parent').modal('show'); // show bootstrap modal
				$('.modal-title').text('Tambah'); // Set Title to Bootstrap modal title
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function edit_parent(id) {
		$('#form_parent')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.col-md-12').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('dokumen/ajax_edit_parent/') ?>/" + id,
			type: "GET",
			dataType: "JSON",
			async: false,
			success: function(data) {
				$(".files").empty();
				$('[name="jenis"]').empty();
				$('[name="jenis"]').append('<option>====PILIH=====</option>');
				for (var i = 0; i < data.jenis.length; i++) {
					$('[name="jenis"]').append('<option value="' + data.jenis[i].id_jenis_informasi + '">' + data.jenis[i].jenis_informasi + '</option>');
				}
				$('[name="option"]').empty();
				$('[name="option"]').append('<option>====PILIH=====</option>');
				$('[name="option"]').append('<option value="file">FILE</option>');
				$('[name="option"]').append('<option value="link">LINK</option>');


				$('#id_parent').val(data.parent_id);
				$('#id_informasi').val(data.id_informasi);
				$('#oldfile').val(data.file);
				$('#judul').val(data.nama);
				$('#isian').val(data.deskripsi);
				$('#tahun').val(data.tahun);
				$('#urutan').val(data.urutan);
				$('#link').val(data.link);
				$('#option').val(data.option).trigger("change");
				if (data.jenis != null) {
					$('.jenis').hide();
				}

				$('#jenis').val(<?= $this->uri->segment(3); ?>);
				// $(".files").empty();
				if (data.file != null) {
					$(".files").html('<li class="list-group-item"> <a href="' + data.file + '">File</a><a href="javascript:void(0)" class="btn btn-sm btn-outline-danger mx-2"  onclick="del_file(' + data.file + ')"><i class="fas fa-trash" ></i></a> </li>');

				}

				$('#modal_form_parent').modal('show'); // show bootstrap modal
				$('.modal-title').text('Ubah'); // Set Title to Bootstrap modal title
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}

	function file_parent(id) {
		$('#form_file')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.col-md-12').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('dokumen/ajax_edit_parent/') ?>/" + id,
			type: "GET",
			dataType: "JSON",
			async: false,
			success: function(data) {
				$(".files").empty();
				for (var i = 0; i < data.file.length; i++) {
					$(".files").append('<li class="list-group-item"> <a href="' + data.file[i].file + '">' + data.file[i].tahun + '</a><a href="javascript:void(0)" class="btn btn-sm btn-outline-danger mx-2"  onclick="del_file(' + data.file[i].id_file + ')"><i class="fas fa-trash" ></i></a> </li>');
				}

				$('#id_informasi_file').val(id);
				$('#modal_form_file').modal('show'); // show bootstrap modal
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
			url: "<?php echo site_url('dokumen/ajax_edit/') ?>/" + id,
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
			url: "<?php echo site_url('user/ajax_detail/') ?>/" + id,
			type: "GET",
			dataType: "JSON",
			async: false,
			success: function(data) {
				$('.id').html(data.id_user);
				$('.username').html(data.username);
				$('.nama').html(data.nama);
				$('.login').html(data.login + ' Kali');
				if (data.last_login) {
					$('.last_login').html(data.last_login);
				}
				$('.skpd').html(data.skpd);
				$('#modal_detail').modal('show'); // show bootstrap modal when complete loaded

				table3.ajax.reload(null, false);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
			}
		});
	}


	function save_jenis() {
		var form = $('#form_jenis')[0]; // You need to use standard javascript object here
		var formData = new FormData(form);
		$('#btnSave').text('Proses..'); //change button text
		$('#btnSave').attr('disabled', true); //set button disable
		var url;

		url = "<?php echo site_url('dokumen/ajax_insert_jenis') ?>";

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

	function save_parent() {
		var form = $('#form_parent')[0]; // You need to use standard javascript object here
		var formData = new FormData(form);
		$('#btnSave').text('Proses..'); //change button text
		$('#btnSave').attr('disabled', true); //set button disable
		var url;

		url = "<?php echo site_url('dokumen/ajax_insert_parent') ?>";
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

	function save_file() {
		var form = $('#form_file')[0]; // You need to use standard javascript object here
		var formData = new FormData(form);
		$('#btnSave').text('Proses..'); //change button text
		$('#btnSave').attr('disabled', true); //set button disable
		var url;

		url = "<?php echo site_url('dokumen/ajax_inserts') ?>";

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



	function save() {
		var form = $('#form1')[0]; // You need to use standard javascript object here
		var formData = new FormData(form);
		$('#btnSave').text('Proses..'); //change button text
		$('#btnSave').attr('disabled', true); //set button disable
		var url;

		url = "<?php echo site_url('dokumen/ajax_insert') ?>";
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

		url = "<?php echo site_url('dokumen/ajax_putusan') ?>";

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

	function goBack() {
		window.history.back();
	}

	function del(id) {

		$.ajax({
			url: "<?php echo site_url('user/ajax_delete') ?>/" + id,
			type: "POST",
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

	function hapus_daftar(id) {
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
					url: "<?php echo site_url('dokumen/ajax_delete?key=') ?>" + id,
					type: "POST",
					dataType: "JSON",
					async: false,

					success: function(data) {
						if (data.status == true) {
							location.reload();
						} else {
							Swal.fire({
								title: 'Gagal',
								text: "Gagal Menghapus Data",
								icon: 'error',
								showCancelButton: false,
								confirmButtonColor: '#3085d6',
								confirmButtonText: 'OK',
							}).then((result) => {
								if (result.value) {
									location.reload();
								}
							});
						}
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

	function del_file(id) {
		$.ajax({
			url: "<?php echo site_url('dokumen/ajax_delete_file/'); ?>/" + id,
			type: "POST",
			dataType: "JSON",
			success: function(data) {
				location.reload();
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
				<h1 class="m-0 text-dark">Pengadaan Barang dan Jasa </h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<!-- <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"">Home</a></li> -->
					<li class="breadcrumb-item active">Dokumen Informasi</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<section class="content">
	<div class="card">
		<div class="card-body">
			<!-- <table id="table" class="table table-striped table-sm table-bordered ">
				<thead>
					<tr>
						<td onclick="add_jenis()" style="vertical-align:middle; text-align:center;cursor:pointer;"><b><i class="fas fa-plus"></i></b></td>
						<td></td>
						<td onclick="add()" style="vertical-align:middle; text-align:center;cursor:pointer;"><i class="glyphicon glyphicon-plus"></i></td>
						<td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_dasar_hukum" name="filter_dasar_hukum" maxlength="100"></td>
						<td></td>
						<td onclick="reload_table()" style="vertical-align:middle; text-align:center;cursor:pointer;"><b><i class="glyphicon glyphicon-filter"></i></b></td>
					</tr>
					<tr class="info">
						<th style="vertical-align: middle;" width="5%"><center><b>No</b></center></th>
						<th>id</th>
						<th style="vertical-align : middle !important;" width="24%"><center><b>Informasi</b></center></th>
						<th style="vertical-align : middle !important;" width="24%"><center><b>Deskripsi</b></center></th>
						<th style="vertical-align : middle !important;" width="10%"><center><b>Aksi</b></center></th>
					</tr>
				</thead>
				<tbody class="treeview">

				</tbody>
			</table> -->
			<h3 class="judul_jenis"></h3>
			<a href="javascript:void(0)" onclick="add_parent(0)" class="btn btn-info"><i class="fas fa-fw fa-plus"></i></a>
			<!-- <table class="table table-striped table-sm table-bordered ">
			<thead>
			<tr class="info">
						<th style="vertical-align : middle !important;" width="25%"><center><b>Informasi</b></center></th>
						<th style="vertical-align : middle !important;" width="27%"><center><b>Deskripsi</b></center></th>
						<th style="vertical-align : middle !important;" width="10%"><center><b>Aksi</b></center></th>
					</tr>
			</thead>
			</table>
			<div class="treeview">

			</div> -->

			<table id="tt" class="table" style="width:100%;height:400px"></table>
		</div>
	</div>
</section>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_parent" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"></h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form role="form" id="form_parent" class="form-validate-summernote">
				<div class="modal-body form">
					<div class="form-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12">
									<input type="hidden" id="id_informasi" name="id_informasi">
									<input type="hidden" id="id_parent" name="id_parent">
									<input type="hidden" id="oldfile" name="oldfile">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									<div class="form-group">
										<label for=""> Informasi</label>
										<input name="judul" id="judul" class="form-control" required></input>
									</div>
									<div class="form-group">
										<label for=""> Urutan</label>
										<input name="urutan" id="urutan" class="form-control" required></input>
									</div>
									<div class="form-group jenis">
										<label for=""> Jenis Informasi</label>
										<select name="jenis" id="jenis" class="form-control"></select>
									</div>
									<div class="form-group">
										<label for=""> Deskripsi</label>
										<textarea name="isian" id="isian" cols="30" rows="10" class="form-control" required></textarea>
									</div>
									<div class="form-group">
										<label for=""> Tahun</label>
										<input name="tahun" id="tahun" class="form-control"></input>
									</div>
									<div class="form-group">
										<label for=""> File/Link</label>
										<select name="option" id="option" class="form-control">

										</select>
									</div>
									<li class="list-group list-group-horizontal-md files">
									</li>
									<div class="form-file form-group">
										<label for=""> Berkas</label>
										<input type="file" name="files" accept="application/pdf" class="form-control">
									</div>
									<div class="form-link form-group">
										<label for=""> Link</label>
										<input name="link" id="link" class="form-control" link></input>
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
<!-- <div class="modal fade" id="modal_form_file" role="dialog">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"></h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form role="form" id="form_file" class="form-validate-summernote" >
				<div class="modal-body form">
					<div class="form-body">
						<div class="container-fluid">
									<div class="row">
										<div class="col-md-12">
											<input type="hidden" id="id_informasi_file" name="id_informasi">
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
											<div class="form-group">
											<li class="list-group list-group-horizontal-md files">
											</li>
											</div>
											<div class="form-group">
												<a href="#" class="copy btn btn-primary pull-right" rel=".copys">Tambah</a>
											</div>
                                            <div class="copys">
												<div class="row">
													<div class="col-md-6">
														<div class=" form-group">
															<label for=""> Tahun</label>
															<input name="tahun[]" id="tahun" class="form-control" required></input>
														</div>
													</div>
													<div class="col-md-6">
														<div class=" form-group">
															<label for="">Berkas</label>
															<input type="file" name="file[]" accept="application/pdf" class="form-control" required>
														</div>
													</div>
												</div>
											</div>
										adun close -->
<!-- </div>
									</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="btnSave" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div>/.modal-content
	</div>/.modal-dialog
</div>/.modal -->
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
<script>
	$("#tahun").on("keypress keyup blur", function(event) {
		$(this).val($(this).val().replace(/[^\d].+/, ""));
		if ((event.which < 48 || event.which > 57)) {
			event.preventDefault();
		}
	});
</script>