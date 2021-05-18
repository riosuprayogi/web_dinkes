<script type="text/javascript" src="<?php echo base_url() ?>/assets/js/fileinput.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.1/css/fileinput.css">

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
				url: '<?php echo site_url('dasar_hukum/ajax_list') ?>',
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
					'data': 'id_dasar_hukum',
					"visible": false
				},
				{
					'data': 'judul'
				},
				{
					'data': 'file'
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
			url: "<?php echo site_url('user/ajax_add/') ?>",
			type: "GET",
			dataType: "JSON",
			async: false,
			success: function(data) {
				$("#isian").summernote("code", '');

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
			url: "<?php echo site_url('dasar_hukum/ajax_edit/') ?>/" + id,
			type: "GET",
			dataType: "JSON",
			async: false,
			success: function(data) {

				$('[name="id"]').val(data.id_dasar_hukum);
				$('[name="judul"]').val(data.judul);
				$("#isian").summernote("code", data.isi);


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
			url: "<?php echo site_url('dasar_hukum/ajax_edit/') ?>/" + id,
			type: "GET",
			dataType: "JSON",
			async: false,
			success: function(data) {
				$('.id').html(data.id_user);
				$('.username').html(data.judul);
				$('.nama').html(data.isi);
				if (data.file == null) {
					$('.file').css('display', 'none');
					// console.log('wowo');
				} else {
					$('#preview-ktp').attr("href", data.file_ktp).show();
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

	function putusan(id) {
		$('#form2')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.col-md-12').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('dasar_hukum/ajax_edit/') ?>/" + id,
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

		url = "<?php echo site_url('dasar_hukum/ajax_insert') ?>";
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
					url: "<?php echo site_url('dasar_hukum/ajax_delete') ?>/" + id,
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
				<h1 class="m-0 text-dark">Manajemen Dasar Hukum</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"">Home</a></li>
              <li class=" breadcrumb-item active">Dasar Hukum</li>
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
						<td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_dasar_hukum" name="filter_dasar_hukum" maxlength="100"></td>
						<td></td>
						<td onclick="reload_table()" style="vertical-align:middle; text-align:center;cursor:pointer;"><b><i class="fas fa-filter"></i></b></td>
					</tr>
					<tr class="info">
						<th style="vertical-align: middle;" width="5%">
							<center><b>No</b></center>
						</th>
						<th>id</th>
						<th style="vertical-align : middle !important;" width="24%">
							<center><b>Dasar Hukum</b></center>
						</th>
						<th style="vertical-align : middle !important;" width="10%">File</th>
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
										<label for=""> Dasar Hukum</label>
										<input type="text" name="judul" class="form-control" placeholder="Judul Dasar Hukum" required>
									</div>
									<div class="form-group">
										<label>Isi</label>
										<textarea required="required" data-msg="Please write something :)" name="isian" id="isian" class="summernote"></textarea>
									</div>
									<div class="form-group">
										<label for="">Berkas</label>
										<div class="file d-none"></div>
										<input id="dasar_hukum" accept="image/jpeg,image/gif,image/png,application/pdf" name="dasar_hukum" type="file" class="file" data-show-caption="true">
										<p style="color: black; font-style: italic; margin-top: 10px; margin-bottom: 10px; color: red;">
											<span style="color: red">*)</span> File yang diterima pdf <br>
											<span style="color: red">*)</span> Maksimal Ukuran File 5 MB
										</p>
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
				<div class="col-md-12">
					<strong>Judul</strong>
					<p class="text-muted">
						<span class="username"></span>
					</p>
					<hr>
					<strong>Isi</strong>
					<p class="text-muted">
						<span class="nama"></span>
					</p>
					<hr>

				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<!-- <script>
	$(function () {
        var summernoteForm = $('#form1');
        var summernoteElement = $('#isian');

        var summernoteValidator = summernoteForm.validate({
            errorElement: "div",
            errorClass: 'is-invalid',
            validClass: 'is-valid',
            ignore: ':hidden:not(#isian),.note-editable.card-block',
            errorPlacement: function (error, element) {
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
            }
        });
    // Summernote
        summernoteElement.summernote({
				toolbar: [
					// [groupName, [list of button]]
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
                    onChange: function (contents, $editable) {
                        
                        summernoteElement.val(summernoteElement.summernote('isEmpty') ? "" : contents);

                        summernoteValidator.element(summernoteElement);
                    },
                    onImageUpload: function(image) {
                        uploadImage(image[0]);
                    },
                    onMediaDelete : function(target) {
                        deleteImage(target[0].src);
                    }
                }
      });

      function uploadImage(image) {
        var data = new FormData();
        data.append("image", image);
        $.ajax({
            url: "<?php echo site_url('profil/upload_image_summernote') ?>",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "POST",
            success: function(url) {
                $('.textarea').summernote("insertImage", url);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function deleteImage(src) {
        $.ajax({
            data: {src : src},
            type: "POST",
            url: "<?php echo site_url('profil/delete_image_summernote') ?>",
            cache: false,
            success: function(response) {
                console.log(response);
            }
        });
    }
  })

</script> -->

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