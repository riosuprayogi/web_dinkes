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
			url: "<?php echo site_url('video/ajax_add/') ?>",
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
			url: "<?php echo site_url('video/ajax_edit/') ?>/" + id,
			type: "GET",
			dataType: "JSON",
			async: false,
			success: function(data) {
				$('[name="id"]').val(data.id_video);
				$('[name="nama_video"]').val(data.nama_video);
				$('[name="link_video"]').val(data.link_video);
				$('[name="status"]').val(data.status);

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

		url = "<?php echo site_url('video/ajax_insert') ?>";
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

	function edit(id) {
		save_method = 'edit';
		$('#form1')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.col-md-12').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('video/ajax_edit/') ?>/" + id,
			type: "GET",
			dataType: "JSON",
			async: false,
			success: function(data) {
				$('[name="id"]').val(data.id_video);
				$('[name="nama_video"]').val(data.nama_video);
				$('[name="link_video"]').val(data.link_video);
				$('[name="status"]').val(data.status);

				$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
				$('.modal-title').text('Ubah'); // Set title to Bootstrap modal title
			},
			error: function(jqXHR, textStatus, errorThrown) {
				alert('Error get data from ajax');
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
					url: "<?php echo site_url('video/ajax_delete') ?>/" + id,
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
				<h1 class="m-0 text-dark">Manajemen Video</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="http://localhost/web_dinkes/" "="">Home</a></li>
              <li class=" breadcrumb-item active">Url Video</li>
				</ol>
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<!-- DataTales Example -->
	<div class="card shadow mb-4">

		<div class="card-body">
			<div class="table-responsive">
				<?= $this->session->flashdata('pesan') ?>
				<table class="table table-bordered table-responsive-lg" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<td onclick="add()" style="vertical-align:middle; text-align:center;cursor:pointer;"><b><i class="fas fa-plus"></i></b></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
						<tr style="text-align:center">
							<th>No</th>
							<th style="width:40%">Judul Video</th>
							<th style="width:40%">Video Url</th>
							<th style="width:7%">Status</th>
							<th style="width:15%">Tanggal/Jam</th>
							<th style="width:7%">Aksi</th>
							<!-- dataTable ga bisa pake colspan atau rowspan -->
						</tr>
					</thead>
					<tbody>
						<!-- dataTable ga bisa pake tr disini -->

						<?php $i = 1; ?>
						<?php foreach ($video as $v) :
							$linkyutube = str_replace("watch?v=", "embed/", $v->link_video); ?>
							<tr>
								<td><?= $i; ?></td>
								<td><?= $v->nama_video ?></td>
								<td>
									<center><iframe width="280" height="180" src="<?= $linkyutube; ?>">
										</iframe>
									</center>
								</td>
								<td><?= $v->status ?></td>
								<td><?= $v->tgl_jam ?></td>
								<td>
									<center>
										<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
											<i class="fas fa-cogs"></i>
										</button>
										<div class="dropdown-menu">
											<a class="dropdown-item" href="javascript:void(0)" onclick="edit('<?= $v->id_video ?>')"><i class="fas fa-edit"></i> Edit</a>
											<a class="dropdown-item" href="javascript:void(0)" onclick="del('<?= $v->id_video ?>')"><i class="fas fa-trash"></i> Hapus</a>
										</div>
									</center>



								</td>
							</tr>
							<?php $i++; ?>
						<?php endforeach; ?>
						<!-- dataTable ga bisa pake tr disini -->
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


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
										<label for=""> Judul Video</label>
										<input type="text" name="nama_video" class="form-control" placeholder="Masukkan Judul Video" required>
									</div>

									<div class="form-group">
										<label for=""> Link Video</label>
										<input type="text" name="link_video" class="form-control" placeholder="Masukkan Link / URl Video" required>
									</div>

									<div class="form-group">
										<label for=""> Status</label>
										<select name="status" id="status" class="form-control" required>
											<option value="">---Pilih---</option>
											<option value="show">Show</option>
											<option value="hide">Hide</option>
										</select>
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
	// image preview jquery
	function open_file(count_image) {
		//alert('asdf');
		console.log(count_image);
		$("#customFileUpload" + count_image).trigger("click");
	};
	$(function() {
		// $('body').on('click', '.black-modal-80', function () {
		//     console.log('Click detected; modal will be displayed');
		// });
		$('body').on('change', '.upload_custom', function(e) {
			// alert("asas");
			var count_image = $(this).data("count_image");
			console.log("data count_image = " + count_image);
			let file = $("#customFileUpload" + count_image).get(0).files[0];
			$("#image-label" + count_image).val(file.name);
			if (file) {
				var reader = new FileReader();

				reader.onload = function() {
					$("#imgPreview" + count_image).attr("src", reader.result);
				}
				reader.readAsDataURL(file);
			}
		});


		// multi upload jquery
		$(document).on('click', '.addService', function() {
			var countimagefield = $(".image_field").length + 1;
			console.log("jumlah image =" + countimagefield);
			var wrapper = $('#linkMulti');
			var html = `
			<div class="col-md-12">
										<!-- <label for="urutan" class="col-sm-1 col-form-label">Urutan</label>
												<div class="col-sm-2">
													<input type="text" class="form-control" id="urutan" name="urutan[]" value="" autocomplete="off">
												</div> -->
										<!-- <label for="ket_foto" class="col-sm-1 col-form-label">Ket. Image</label> -->
										<!-- <div class="col-sm-4">
											<input type="text" class="form-control" id="ket_foto" name="ket_foto[]" value="" autocomplete="off">
										</div> -->
										<div class="form-group">
											<label for=""> Link Video</label>
											<input type="text" id="link_video" name="link_video[]" class="form-control" value="" placeholder="Masukkan URL Video" required>
										</div>
										<hr>
									</div>
`;
			$(wrapper).append(html);
		});
	});
</script>


<script>
	var save_method; //for save method string
	var table;
	var table2;

	function reload_table() {
		table.ajax.reload(null, false);
	}

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

<script>
	$(document).ready(function() {
		$("#dataTable").dataTable();
	})
</script>