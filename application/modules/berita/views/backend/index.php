<script>
	var save_method; //for save method string
	var table;
	var table2;

	function add() {
		save_method = 'add';
		$('#form1')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('#files').html('<li class="text-muted text-center empty">No files uploaded.</li>');
		$('.col-md-12').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url: "<?php echo site_url('berita/ajax_add/') ?>",
			type: "GET",
			dataType: "JSON",
			async: false,
			success: function(data) {
				// $('#dd_kategori_berita').empty();
				// $('#dd_kategori_berita').append('<option value="">==== Pilih ====</option>');
				// for (var i = 0; i < data.kategori.length; i++) {
				// 	$('#dd_kategori_berita').append('<option value="' + data.kategori[i].id_kategori + '">' + data.kategori[i].nama_kategori + '</option>');
				// }

				$('#files').on("click", ".hapus_data", function(e) {
					e.preventDefault();
					$(this).parents('li').last().remove();
				});

				$('#modal_form').modal('show'); // show bootstrap modal
				$('.modal-title').text('Tambah'); // Set Title to Bootstrap modal title
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

		url = "<?php echo site_url('berita/ajax_insert') ?>";
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
						console.log(data)
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
					url: "<?php echo site_url('berita/ajax_delete') ?>/" + id,
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
				<h1 class="m-0 text-dark">Manajemen Berita</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="http://localhost/web_dinkes/" "="">Home</a></li>
              <li class=" breadcrumb-item active">Berita</li>
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
							<td colspan="5"></td>
						</tr>
						<tr>
							<th>No</th>
							<!-- <th style="width:15%">Kategori Berita</th> -->
							<th>Judul Berita</th>
							<th>Isi Berita</th>
							<!-- <th width="100px">Foto Berita</th> -->
							<th>Status</th>
							<th>Tanggal/Jam</th>
							<th style="width:7%">Aksi</th>
							<!-- dataTable ga bisa pake colspan atau rowspan -->
						</tr>
					</thead>
					<tbody>
						<!-- dataTable ga bisa pake tr disini -->

						<?php $i = 1;
						foreach ($t_berita as $ia) : ?>
							<tr>
								<td><?= $i++ ?></td>
								<!-- <td><?= $ia["nama_kategori"] ?></td> -->
								<td><?= substr($ia["judul_berita"], 0, 50); ?></td>
								<td><?= substr($ia["isi_berita"], 0, 100); ?></td>
								<!-- <td>
									<?php if ($ia["t_foto_berita"] != NULL) {
										if (count($ia["t_foto_berita"]) > 0) {
											foreach ($ia["t_foto_berita"] as $f) {
									?>
												<div style="padding:2px; border:1px solid #eee; margin:2px 2px">
													<a target="blank" href="<?= base_url('assets/backend/img/img_berita/' . $f["path_foto_artikel"]) ?>">
														<img src="<?= base_url('assets/backend/img/img_berita/' . $f["path_foto_artikel"]) ?>" alt="<?= $f["ket_foto"]; ?>" width="100%">
													</a>
												</div>
										<?php
											}
										}
									} else { ?>
										<div style="padding:2px; border:1px solid #eee; margin:2px 2px">
											<a href="javascript:void(0)">
												<img src="<?= base_url('assets/backend/img/not-found.jpg'); ?>" alt="" width="100%">
											</a>
										</div>
									<?php } ?>
								</td> -->
								<!-- <td><?= $ia["nama_admin"] ?></td> -->
								<td><?= $ia["status"] ?></td>
								<td><?= date('d-M-Y H:i:s', strtotime($ia["tgl_jam"])); ?></td>
								<td>
									<center>
										<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
											<i class="fas fa-cogs"></i>
										</button>
										<div class="dropdown-menu">
											<a class="dropdown-item" href="<?= base_url(); ?>berita/detail/<?= $ia["id_berita"] ?>"><i class="fas fa-eye"></i> Lihat</a>
											<a class="dropdown-item" href="<?= base_url(); ?>berita/edit/<?= $ia["id_berita"] ?>" onclick="return confirm('Apakah anda yakin akan mengedit nya?');"><i class="fas fa-edit"></i> Ubah</a>
											<a class="dropdown-item" href="<?= base_url(); ?>berita/ajax_delete/<?= $ia["id_berita"] ?>" onclick="return confirm('Apakah anda yakin akan menghapus nya?');"><i class="fas fa-trash"></i> Hapus</a>
										</div>
									</center>
								</td>
							</tr>
						<?php endforeach; ?>
						<!-- dataTable ga bisa pake tr disini -->
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="modal_form" role="dialog">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"></h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form role="form" id="form1" class="form-validate-summernote" method="post" enctype="multipart/form-data">
				<div class="modal-body form">
					<div class="form-body">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12">
									<input type="hidden" value="" id="id" name="id">
									<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
									<!-- <div class="form-group">
										<label for=""> Nama Kategori</label>
										<select name="dd_kategori_berita" id="dd_kategori_berita" class="form-control" required></select>
									</div> -->

									<div class="form-group">
										<label for=""> Judul Berita</label>
										<input type="text" name="judul_berita" class="form-control" placeholder="Masukkan Judul Berita" required>
									</div>


									<!-- <div class="form-group">
										<label for="exampleInputFile">File input</label>
										<div class="input-group">
											<div class="custom-file">
												<input type="file" class="custom-file-input" id="exampleInputFile">
												<label class="custom-file-label" for="exampleInputFile">Choose file</label>
											</div>
											<div class="input-group-append">
												<span class="input-group-text">Upload</span>
											</div>
										</div>
									</div> -->


									<div class="form-group">
										<label for="foto_hotel">Foto Hotel</label>
										<input type="file" class="form-control" placeholder="" name="foto_hotel[]" multiple="" accept="image/png, image/jpeg, image/gif">
										<div class="pt-3 row">
											<div class="col-12" id="foto_hotel_thumbnail">
												<div id="foto_hotel_thumbnail_update" class="d-inline" data-update="no"></div>
											</div>
										</div>
										<small class="block text-danger"></small>
									</div>

									<div class="form-group row image_field">
										<label for="path_detail_foto" class="col-sm-2 col-form-label">Foto</label>
										<div class="col-sm-10">
											<div class="row">
												<div class="col-sm-4">
													<img src="<?= base_url('assets/backend/img/img_berita/noimage.png') ?>" class="img-thumbnail" id="imgPreview1" style="height: 400px; height: 350px;" />
												</div>
												<div class="form-group">
													<div class="input-group">
														<div class="custom-file">
															<input type="text" class="form-control" id="image-label1" readonly required>
															<input type="file" class="custom-file-input upload_custom" id="customFileUpload1" data-count_image="1" name="path_foto_artikel[]" style="display: none;">
															<?= form_error('path_detail_foto', '<small class="text-danger pl-0">', '</small>'); ?>
														</div>
														<div class="input-group-append">
															<button class="btn btn-primary" onclick="open_file(1)" data-count_image="1" type="button">Pilih Gambar</button>
														</div>
													</div>
													<span style="font-style: italic; color:red;">*) Format photo (jpg,jpeg,png) ukuran file max 2 Mb.</span><br>
												</div>
											</div>
										</div>
									</div>

									<!-- <div class="form-group row image_field">
										<label for="path_foto_artikel" class="col-sm-2 col-form-label">Foto Berita</label>
										<div class="col-sm-10">
											<div class="row">
												<div class="col-sm-4">
													<img src="<?= base_url('assets/backend/img/img_berita/noimage.png') ?>" class="img-thumbnail" id="imgPreview1" style="height: 400px; height: 350px;" />
												</div>
												<div class="col-sm-6">
													<div class="custom-file">
														<div class="col-sm-8">
															<input type="text" class="form-control" id="image-label1" readonly required>
															<input type="file" class="custom-file-input upload_custom" id="customFileUpload1" data-count_image="1" name="path_foto_artikel[]" style="display: none;">
															<?= form_error('path_foto_artikel', '<small class="text-danger pl-0">', '</small>'); ?>
															<span style="font-style: italic; color:red;">*) Format photo (jpg,jpeg,png) ukuran file max 2 Mb.</span><br>

														</div>
														<div class="col-sm-3 mt-3">
															<button class="btn btn-primary" onclick="open_file(1)" data-count_image="1" type="button">Pilih Gambar</button>
														</div>

													</div>
												</div>
											</div>

										</div>
									</div> -->

									<div id="imageMulti"></div>
									<div class="form-group row mt-3">
										<!-- <label for="urutan" class="col-sm-1 col-form-label">Urutan</label>
												<div class="col-sm-2">
													<input type="text" class="form-control" id="urutan" name="urutan[]" value="" autocomplete="off">
												</div>
												<label for="ket_foto" class="col-sm-1 col-form-label">Ket. Image</label>
												<div class="col-sm-4">
													<input type="text" class="form-control" id="ket_foto" name="ket_foto[]" value="" autocomplete="off">
												</div> -->
										<!-- <div class="col-sm-5 text-right">
											<button type="button" class="btn btn-primary ml-3 addService">Tambah Foto</button>
										</div> -->
									</div>
									<div class="card-footer">
										<!-- <button type="submit" class="btn btn-info">Sign in</button> -->
										<button type="button" class="btn btn-primary float-right addService">Tambah Foto</button>
									</div>


									<hr>

									<div class="form-group">
										<label for=""> Isi Berita</label>
										<textarea required="required" data-msg="Please write something :)" name="isi_berita" id="isi_berita" class="summernote"></textarea>
									</div>

									<div class="form-group">
										<label for=""> Status</label>
										<select name="status" id="status" class="form-control" required>
											<option value="">---Pilih---</option>
											<option value="show">Show</option>
											<option value="hide">Hide</option>
										</select>
									</div>

									<!-- <div class="form-group">
										<label for=""> Admin</label>
										<input type="text" name="id_admin" class="form-control" placeholder="Masukkan Kategori" required>
									</div> -->
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
			var wrapper = $('#imageMulti');
			var html = `

			<div class="form-group row image_field">
										<label for="path_detail_foto" class="col-sm-2 col-form-label"></label>
										<div class="col-sm-10">
											<div class="row">
												<div class="col-sm-4">
												<img src="<?= base_url('assets/backend/img/img_berita/noimage.png') ?>" class="img-thumbnail" id="imgPreview` + countimagefield + `" style="height: 400px; height: 350px;" />
												</div>
												<div class="form-group">
													<!-- <label for="exampleInputFile">File input</label> -->
													<div class="input-group">
														<div class="custom-file">
														<input type="text" class="form-control" id="image-label` + countimagefield + `" readonly>
                                                		<input type="file" class="custom-file-input upload_custom" id="customFileUpload` + countimagefield + `" data-count_image="` + countimagefield + `" name="path_foto_artikel[]" style="display: none;">
														<?= form_error('path_detail_foto', '<small class="text-danger pl-0">', '</small>'); ?>
														</div>
														<div class="input-group-append">
														<button class="btn btn-primary" data-count_image="` + countimagefield + `"  onclick="open_file(` + countimagefield + `)" type="button">Pilih Gambar</button>
														</div>
													</div>
													<span style="font-style: italic; color:red;">*) Format photo (jpg,jpeg,png) ukuran file max 2 Mb.</span><br>
												</div>
											</div>
										</div>
									</div>
`;
			$(wrapper).append(html);
		});
	});
</script>


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

<script>
	$(document).ready(function() {
		$("#dataTable").dataTable();
	})
</script>