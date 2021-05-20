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
							<td colspan="6"></td>
						</tr>
						<tr>
							<th>No</th>
							<!-- <th style="width:15%">Kategori Berita</th> -->
							<th>Judul Berita</th>
							<th>Isi Berita</th>
							<th width="100px">Foto Berita</th>
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
								<td>
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
								</td>
								<!-- <td><?= $ia["nama_admin"] ?></td> -->
								<td><?= $ia["status"] ?></td>
								<td><?= date('d-M-Y H:i:s', strtotime($ia["tgl_jam"])); ?></td>
								<td>
									<center>
										<button type="button" class="btn btn-sm btn-default dropdown-toggle" data-toggle="dropdown">
											<i class="fas fa-cogs"></i>
										</button>
										<div class="dropdown-menu">
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
	var foto_hotel = [];

	$(document).ready(function() {

		var kamarMapping;
		var perusahaan;

		// untuk steps custom
		$("#formPerusahaan").steps({
			headerTag: "h4",
			bodyTag: "section",
			transitionEffect: "fade",
			enableAllSteps: true,
			transitionEffectSpeed: 300,
			labels: {
				next: "Selanjutnya",
				previous: "Kembali",
				finish: 'SIMPAN'
			},
			onStepChanging: function(event, currentIndex, newIndex) {
				// form.validate().settings.ignore = ":disabled,:hidden";
				// return form.valid();

				if (newIndex >= 1) {
					$('.steps ul li:first-child a img').attr('src', '<?= base_url() ?>assets/step1.png');
				} else {
					$('.steps ul li:first-child a img').attr('src', '<?= base_url() ?>assets/step1-active.png');
				}

				if (newIndex === 1) {
					$('.steps ul li:nth-child(2) a img').attr('src', '<?= base_url() ?>assets/step2-active.png');
				} else {
					$('.steps ul li:nth-child(2) a img').attr('src', '<?= base_url() ?>assets/step2.png');
				}

				if (newIndex === 2) {
					$('.steps ul li:nth-child(3) a img').attr('src', '<?= base_url() ?>assets/step3-active.png');
				} else {
					$('.steps ul li:nth-child(3) a img').attr('src', '<?= base_url() ?>assets/step3.png');
				}

				return true;
			},
			// onFinishing: function (event, currentIndex)
			// {
			//     // form.validate().settings.ignore = ":disabled";
			//     // return form.valid();
			// },      
			onFinished: function(event, currentIndex) {
				$('#modalDisclaimer').modal('show')
			}
		})

		$('.steps ul li:first-child').append('<img src="<?= base_url() ?>assets/step-arrow-2.png" alt="" class="step-arrow">').find('a').append('<img src="<?= base_url() ?>assets/step1-active.png" alt=""> ').append('<span class="step-order">Identitas Hotel</span>');
		$('.steps ul li:nth-child(2').append('<img src="<?= base_url() ?>assets/step-arrow-2.png" alt="" class="step-arrow">').find('a').append('<img src="<?= base_url() ?>assets/step2.png" alt="">').append('<span class="step-order">Fasilitas Hotel</span>');
		$('.steps ul li:last-child a').append('<img src="<?= base_url() ?>assets/step3.png" alt="">').append('<span class="step-order">Tenaga Kerja</span>');

		$('[data-toggle="tooltip"]').tooltip()
		// $('#kabupaten').select2({ theme: 'bootstrap4' });
		$('#kecamatan').select2({
			theme: 'bootstrap4'
		});
		$('#kelurahan').select2({
			theme: 'bootstrap4'
		});

		$("#kelas_hotel").starRating({
			ratedColors: ['orange', 'orange', 'orange', 'orange', 'orange'],
			useFullStars: true,
			disableAfterRate: false
		});

		$.ajax({
			url: `<?= site_url('admin/perusahaan_admin/create_edit_json') ?>/<?= $id ?>`,
			type: "GET",
			dataType: "JSON",
			success: function(data) {


				// --------------------- USERS ------------------------ //
				var userMapping = data.users.map((user) => {
					return {
						id: user.id,
						text: user.nama
					}
				});

				userMapping.splice(0, 0, {
					id: "",
					text: "Pilih User"
				});

				$('#user_id').empty();
				$('#user_id').select2({
					data: userMapping,
					theme: 'bootstrap4',
				})

				// --------------------- KECAMATAN ------------------------ //

				var kecamatanMapping = data.kecamatans.map((kecamatans) => {
					return {
						id: kecamatans.NO_KEC,
						text: kecamatans.NAMA_KEC
					}
				});

				kecamatanMapping.splice(0, 0, {
					id: "",
					text: "Pilih Kecamatan"
				});

				$('#kecamatan').empty();
				$('#kecamatan').select2({
					data: kecamatanMapping,
					theme: 'bootstrap4',
				})

				// --------------------- PERUSAHAAN KAMARS ------------------------- //

				var perushaanKamarSelecteds = [];

				if (data.perusahaan_kamars.length > 0) {
					$('#form-kamar').empty();
					data.perusahaan_kamars.forEach((value, key) => {
						$('#form-kamar').append(`<div class="row baris-tipe-kamar">
						    <div class="col-4 px-4 py-2 my-auto">
						      <select class="form-control kamar" name="kamar_id[]" id="kamar_id${key}"></select>
						      <small class="block text-danger"></small>
						    </div>
						    <div class="col-3 px-4 py-2">
						    	<input type="text" name="jumlah_tipe_kamar[]" onkeyup="jumlah_tipe_kamarf(event)" data-jumlah="jumlah_tipe_kamar" id="jumlah_tipe_kamar${key}" class="form-control number">
						      <small class="block text-danger"></small>
						    </div>
						    <div class="col-2 px-4 py-2">
						    	<input type="text" name="harga_kamar[]" id="harga_kamar${key}" class="form-control rupiah">
						      <small class="block text-danger"></small>
						    </div>
						    <div class="col-2 px-4 py-2">
						    	<input type="text" name="harga_promote[]" id="harga_promote${key}" class="form-control rupiah">
						      <small class="block text-danger"></small>
						    </div>						  			    
						    <div class="col-sm-1 mx-auto my-auto">
									<a href="javascript:void(0);" class="remove_button btn btn-sm btn-danger pull-right" style="margin-right:10px;" ><i class="fas fa-times"></i></a>
						    </div>
						  </div>`);

						perushaanKamarSelecteds.push({
							kamar_id: value.kamar_id,
							jumlah_tipe_kamar: value.jumlah_kamar,
							harga_kamar: value.harga_kamar,
							harga_promote: value.harga_promote,
						});

						$('.number').inputmask({
							alias: 'numeric',
							rightAlign: false,
							// prefix: '$ ',
							digits: 0,
							autoUnmask: true,
							allowPlus: false,
							allowMinus: false,
							autoGroup: true,
							groupSeparator: ".",
							// defaultValue: '0'
						});

						$('.rupiah').inputmask({
							alias: 'numeric',
							rightAlign: false,
							prefix: 'Rp ',
							digits: 0,
							autoUnmask: true,
							allowPlus: false,
							allowMinus: false,
							autoGroup: true,
							groupSeparator: ".",
							// defaultValue: '0'
						});
					})
				} else {
					// console.log('jalan');
					$('#form-kamar').empty();
					$('#form-kamar').append(`<div class="row baris-tipe-kamar">
					    <div class="col-4 px-4 py-2 my-auto">
					      <select class="form-control kamar" name="kamar_id[]" id="kamar_id0"></select>
					      <small class="block text-danger"></small>
					    </div>
					    <div class="col-3 px-4 py-2">
					    	<input type="text" name="jumlah_tipe_kamar[]" id="jumlah_tipe_kamar0" onkeyup="jumlah_tipe_kamarf(event)" data-jumlah="jumlah_tipe_kamar" class="form-control number">
					      <small class="block text-danger"></small>
					    </div>
					    <div class="col-2 px-4 py-2">
					    	<input type="text" name="harga_kamar[]" id="harga_kamar0" class="form-control rupiah">
					      <small class="block text-danger"></small>
					    </div>
					    <div class="col-2 px-4 py-2">
					    	<input type="text" name="harga_promote[]" id="harga_promote0" class="form-control rupiah">
					      <small class="block text-danger"></small>
					    </div>
					  </div>`);

					$('.number').inputmask({
						alias: 'numeric',
						rightAlign: false,
						// prefix: '$ ',
						digits: 0,
						autoUnmask: true,
						allowPlus: false,
						allowMinus: false,
						autoGroup: true,
						groupSeparator: ".",
						// defaultValue: '0'
					});

					$('.rupiah').inputmask({
						alias: 'numeric',
						rightAlign: false,
						prefix: 'Rp ',
						digits: 0,
						autoUnmask: true,
						allowPlus: false,
						allowMinus: false,
						autoGroup: true,
						groupSeparator: ".",
						// defaultValue: '0'
					});
				}

				kamarMapping = data.kamars.map((kamar) => {
					return {
						id: kamar.id,
						text: kamar.nama
					}
				});

				kamarMapping.splice(0, 0, {
					id: "",
					text: "Pilih kamar"
				});

				$('.kamar').empty();
				$('.kamar').select2({
					data: kamarMapping,
					theme: 'bootstrap4',
				})

				if (perushaanKamarSelecteds.length > 0) {
					perushaanKamarSelecteds.forEach((value, key) => {
						setTimeout(() => {
							$(`#kamar_id${key}`).val(value.kamar_id).trigger('change');
						}, 1000)
						$(`#jumlah_tipe_kamar${key}`).val(value.jumlah_tipe_kamar);
						$(`#harga_kamar${key}`).val(value.harga_kamar);
						$(`#harga_promote${key}`).val(value.harga_promote);
					});
				}

				// --------------------- PERUSAHAAN FASILITASS ------------------------- //

				var perusahaanFasilitasSelecteds = [];

				if (data.perusahaan_fasilitass.length > 0) {
					$('#form-fasilitas').empty();
					$('#form-fasilitas').append(`<div class="col-12 px-4 py-2 my-auto">
				      <select class="form-control fasilitas" name="fasilitas_id[]" multiple="multiple"></select>
				      <small class="block text-danger"></small>
				    </div>`);

					data.perusahaan_fasilitass.forEach((value, key) => {
						perusahaanFasilitasSelecteds.push(value.fasilitas_id); // ambil data yang ingin di selected
					})

				} else {
					$('#form-fasilitas').empty();
					$('#form-fasilitas').append(`<div class="col-12 px-4 py-2 my-auto">
				      <select class="form-control fasilitas" name="fasilitas_id[]" multiple="multiple"></select>
				      <small class="block text-danger"></small>
				    </div>`);
				}

				fasilitasMapping = data.fasilitass.map((fasilitas) => {
					return {
						id: fasilitas.id,
						text: fasilitas.nama,
						children: fasilitas.children,
					}
				});

				fasilitasMapping.splice(0, 0, {
					id: "",
					text: "Pilih fasilitas",
					children: []
				});

				// fasilitasMapping.push({
				// 	id: "NEW", text: "LAINNYA.."
				// });

				$('.fasilitas').empty();
				$('.fasilitas').select2({
						data: fasilitasMapping,
						theme: 'bootstrap4',
						multiple: true,
						// minimumResultsForSearch: Infinity,
					})
					.on('select2:open', function() {
						var a = $(this).data('select2');
						var el = $(this);
						if (!$('.select2-link').length) {
							a.$results.parents('.select2-results')
								.append('<div class="select2-link" style="padding: 0 7px;"><a href="javascript:void(0)" class="b">Lainnya (Tambah fasilitas)</a></div>')
								.on('click', function(b) {
									a.trigger('close');
									Swal.fire({
										title: 'Tambah Fasilitas Baru',
										input: 'text',
										inputLabel: 'Fasilitas',
										inputPlaceholder: 'Fasilitas',
										inputValidator: (value) => {
											if (!value) {
												return 'Tidak Boleh Kosong!'
											}
										}
									}).then((result) => {
										if (result.value) {
											if (result.value !== '') {
												if (result.value !== null) {
													Swal.fire({
														html: `<b>${result.value}</b> Sudah Tersedia di pilihan`,
														timer: 3000,
														showConfirmButton: false
													})
													el.append(`<option value="lainnya-${result.value}">${result.value}</option>`)
												}
											}
										} else {
											return false;
										}
									});
								});
						}
					});


				$('.fasilitas').val(perusahaanFasilitasSelecteds).trigger('change');

				// --------------------- FOTO HOTEL ------------------------ //
				if (data.perusahaan_fotos.length > 0) {
					// console.log('jalan ?');
					$('input[name="foto_hotel[]"]').attr('onchange', `load_file_multiple(event, 'foto_hotel_thumbnail_update')`);
					// $('#foto_hotel_thumbnail').empty();
					data.perusahaan_fotos.forEach((value, key) => {
						$('#foto_hotel_thumbnail').prepend(`		        	
			        	<div class="d-inline" data-update="yes">
				        	<img class="img-thumbnail foto_hotel_thumbnail" src="<?= base_url() ?>assets/uploads/${value.foto}"/>
				        	<a href="javascript:void(0)" class="remove" onclick="destroy_image(${value.id}, '${value.foto}')">
				        		<i class="fas fa-times"></i>
				        	</a>
			        	</div>					    
						  `);
					})
				} else {
					$('input[name="foto_hotel[]"]').attr('onchange', `load_file_multiple(event, 'foto_hotel_thumbnail')`)
				}

				// --------------------- JIKA DATA SUDAH TERSIMPAN ------------------------ //

				perusahaan = data.perusahaan;

				if (perusahaan != null) {
					$('[name="id"]').val(data.perusahaan.id);
					$('[name="user_id"]').val(data.perusahaan.user_id).trigger('change');
					$('[name="alamat_perusahaan"]').val(data.perusahaan.alamat_perusahaan);
					$('[name="lat"]').val(data.perusahaan.lat);
					$('[name="long"]').val(data.perusahaan.long);
					$('[name="jumlah_kamar"]').val(data.perusahaan.jumlah_kamar);
					$('[name="kabupaten_id"]').val(data.perusahaan.kabupaten_id).trigger('change');
					$('[name="kecamatan_id"]').val(data.perusahaan.kecamatan_id).trigger('change');
					$('[name="kelurahan_id"]').val(data.perusahaan.kelurahan_id).trigger('change');
					$('#kelas_hotel').starRating('setRating', data.perusahaan.kelas_hotel)
					if (data.perusahaan.logo_hotel != null) {
						$('#logo_hotel_thumbnail').append(`
								<img src="<?= base_url() ?>assets/uploads/${data.perusahaan.logo_hotel}" style="width:250px;" class="img-thumbnail">
							`);
					}
					$('[name="kode_pos"]').val(data.perusahaan.kode_pos);
					$('[name="nama_hotel"]').val(data.perusahaan.nama_hotel);
					$('[name="tdup"]').val(data.perusahaan.tdup);
					$('[name="nama_pemilik"]').val(data.perusahaan.nama_pemilik);
					$('[name="nama_pimpinan"]').val(data.perusahaan.nama_pimpinan);
					$('[name="no_telepon"]').val(data.perusahaan.no_telepon);
					$('[name="tempat_tidur_extra"]').val(data.perusahaan.tempat_tidur_extra);
					$('[name="pekerja_jumlah_asing"]').val(data.perusahaan.pekerja_jumlah_asing);
					$('[name="pekerja_jumlah_lokal"]').val(data.perusahaan.pekerja_jumlah_lokal);
					$('[name="pekerja_laki_asing"]').val(data.perusahaan.pekerja_laki_asing);
					$('[name="pekerja_laki_lokal"]').val(data.perusahaan.pekerja_laki_lokal);
					$('[name="pekerja_perempuan_asing"]').val(data.perusahaan.pekerja_perempuan_asing);
					$('[name="pekerja_perempuan_lokal"]').val(data.perusahaan.pekerja_perempuan_lokal);
				}
			}
		})

		// tambah kamars
		$('#tambah_kamar').on('click', function(e) {
			e.preventDefault();
			baris = $('.baris-tipe-kamar').length;
			$('#form-kamar')
				.append(`<div class="row baris-tipe-kamar">
			    <div class="col-4 px-4 py-2 my-auto">
			      <select class="form-control my-auto kamar" id="kamar_id${baris}" name="kamar_id[]"></select>
			      <small class="block text-danger"></small>
			    </div>
			    <div class="col-3 px-4 py-2">
			    	<input type="text" id="jumlah_tipe_kamar${baris}" name="jumlah_tipe_kamar[]" onkeyup="jumlah_tipe_kamarf(event)" data-jumlah="jumlah_tipe_kamar" class="form-control my-auto number">
			      <small class="block text-danger"></small>
			    </div>
			    <div class="col-2 px-4 py-2">
			    	<input type="text" id="harga_kamar${baris}" name="harga_kamar[]" class="form-control my-auto rupiah">
			      <small class="block text-danger"></small>
			    </div>
			    <div class="col-2 px-4 py-2">
			    	<input type="text" id="harga_promote${baris}" name="harga_promote[]" class="form-control my-auto rupiah">
			      <small class="block text-danger"></small>
			    </div>
			    <div class="col-1 mx-auto my-auto">
						<a href="javascript:void(0);" class="remove_button btn btn-sm btn-danger pull-right" style="margin-right:10px;"><i class="fas fa-times"></i></a>
			    </div>
			  </div>`);

			$('.kamar').select2({
				data: kamarMapping,
				theme: 'bootstrap4'
			})

			$('.number').inputmask({
				alias: 'numeric',
				rightAlign: false,
				// prefix: '$ ',
				digits: 0,
				autoUnmask: true,
				allowPlus: false,
				allowMinus: false,
				autoGroup: true,
				groupSeparator: ".",
				// defaultValue: '0'
			});

			$('.rupiah').inputmask({
				alias: 'numeric',
				rightAlign: false,
				prefix: 'Rp ',
				digits: 0,
				autoUnmask: true,
				allowPlus: false,
				allowMinus: false,
				autoGroup: true,
				groupSeparator: ".",
				// defaultValue: '0'
			});
		})

		$('#tambah_fasilitas').on('click', function(e) {
			e.preventDefault();
			$('#form-fasilitas')
				.append(`
				    <div class="col-4 px-4 py-2 my-auto">
				    	<div class="row">
					    	<div class="col-9 my-auto">
						      <select class="form-control my-auto fasilitas" name="fasilitas_id[]"></select>
						      <small class="block text-danger"></small>
					    	</div>
						    <div class="col-3 my-auto">
									<a href="javascript:void(0);" class="remove_button btn btn-sm btn-danger pull-right" ><i class="fas fa-times"></i></a>
						    </div>
				    	</div>
				    </div>
			   `);

			$('.fasilitas').select2({
				data: fasilitasMapping,
				theme: 'bootstrap4'
			})
		})

		$('#form-kamar').on('click', '.remove_button', function(e) {
			e.preventDefault();
			var hapus = $(this).parent('div').parent('div').find('[data-jumlah="jumlah_tipe_kamar"]').val();
			jumlah_kamar = $('#jumlah_kamar').val();
			total = jumlah_kamar - hapus;
			$('#jumlah_kamar').val(total);
			$(this).parent('div').parent('div').remove(); //Remove field html
		});

		$('#form-fasilitas').on('click', '.remove_button', function(e) {
			e.preventDefault();
			$(this).parent('div').parent('div').parent('div').remove(); //Remove field html
		});

		$('.number').inputmask({
			alias: 'numeric',
			rightAlign: false,
			// prefix: '$ ',
			digits: 0,
			autoUnmask: true,
			allowPlus: false,
			allowMinus: false,
			autoGroup: true,
			groupSeparator: ".",
			// defaultValue: '0'
		});
		$('.telepon').inputmask('9{1,14}', {
			// alias: 'numeric',
			inputMode: 'numeric',
			groupSeparator: '',
			rightAlign: false,
			// prefix: '$ ',
			digits: 0,
			autoUnmask: true,
			removeMaskOnSubmit: true,
			unmaskAsNumber: true,
			allowPlus: false,
			allowMinus: false,
		});
		$('.bed').inputmask('9{1,14} Unit', {
			// alias: 'numeric',
			inputMode: 'numeric',
			groupSeparator: '',
			rightAlign: false,
			// prefix: '$ ',
			digits: 0,
			autoUnmask: true,
			removeMaskOnSubmit: true,
			unmaskAsNumber: true,
			allowPlus: false,
			allowMinus: false,
		});
		$('.rupiah').inputmask({
			alias: 'numeric',
			rightAlign: false,
			prefix: 'Rp ',
			digits: 0,
			autoUnmask: true,
			allowPlus: false,
			allowMinus: false,
			autoGroup: true,
			groupSeparator: ".",
			// defaultValue: '0'
		});
		$('.kode_pos').inputmask('99999');
		// select kabupaten kecamatan kelurahan
		$('#kabupaten').change(function() {
			$.ajax({
				url: `<?= site_url('admin/perusahaan_admin/get_kecamatan') ?>/${$(this).val()}`,
				type: "GET",
				async: false,
				dataType: "JSON",
				success: function(data) {
					var kecamatanMapping = data.kecamatans.map((kecamatan) => {
						return {
							id: kecamatan.NO_KEC,
							text: kecamatan.NAMA_KEC
						}
					});

					kecamatanMapping.splice(0, 0, {
						id: "",
						text: "Pilih Kecamatan"
					});

					$('#kecamatan').empty();
					$('#kecamatan').select2({
						data: kecamatanMapping,
						theme: 'bootstrap4',
					})
				}
			})
		})

		$('#kecamatan').change(function() {
			var kabupatenId = $('#kabupaten').val();

			$.ajax({
				url: `<?= site_url('admin/perusahaan_admin/get_kelurahan') ?>/${$(this).val()}/${kabupatenId}`,
				type: "GET",
				async: false,
				dataType: "JSON",
				success: function(data) {
					var kelurahanMapping = data.kelurahans.map((kelurahan) => {
						return {
							id: kelurahan.NO_KEL,
							text: kelurahan.NAMA_KEL
						}
					});

					kelurahanMapping.splice(0, 0, {
						id: "",
						text: "Pilih Kelurahan"
					});

					$('#kelurahan').empty();
					$('#kelurahan').select2({
						data: kelurahanMapping,
						theme: 'bootstrap4',
					})
				}
			})
		})

		$('#kelurahan').change(function() {
			kecamatanId = $('#kecamatan').val();

			$.ajax({
				url: `<?= site_url('admin/perusahaan_admin/get_kode_pos') ?>/${kecamatanId}/${$(this).val()}`,
				type: "GET",
				async: false,
				dataType: "JSON",
				success: function(data) {
					$('input[name="kode_pos"]').val(data.kode_pos.kode_pos);
				}
			})
		})

		// FUNGSI UNTUK KETIKA PILIH KAMAR LALU PILIH KAMAR, KAMAR SEBELUMNYA TIDAK BISA DIPILIH
		$(document).on("change", ".kamar", function() {
			kamarMapping.splice(kamarMapping.findIndex(v => v.id == $(this).val()), 1);
		})

	});

	function load_file(event) {
		$(`#logo_hotel_thumbnail`).empty();

		var files = event.target.files,
			filesLength = files.length;
		for (var i = 0; i < filesLength; i++) {
			const fsize = files.item(i).size;
			const ftype = files.item(i).type;
			const type = ftype.split('/').pop().toLowerCase();
			const size = Math.round((fsize / 1024));
			// console.log(files);
			if (type != "jpeg" && type != "jpg" && type != "png" && type != "gif") {
				alert(`File Yang Harus Di Upload Haruslah gambar`);
			} else if (size >= 1024) {
				alert(`File Yang Harus Di Upload tidak boleh lebih dari 1MB`);
				return false;
			} else {
				var f = files[i]
				var fileReader = new FileReader();
				fileReader.onload = (function(e) {
					var file = e.target;
					$(`#logo_hotel_thumbnail`).append("<img class=\"img-thumbnail\" style=\"width:250px;heigth:auto;\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>")
				});
				fileReader.readAsDataURL(f);
			}
		}
	};

	function load_file_multiple(event, foto_thumbnail) {

		// $(`#${foto_thumbnail}`).empty(); 

		var files = event.target.files,
			filesLength = files.length;
		for (var i = 0; i < filesLength; i++) {
			const fsize = files.item(i).size;
			const ftype = files.item(i).type;
			const type = ftype.split('/').pop().toLowerCase();
			const size = Math.round((fsize / 1024));
			// console.log(files);
			if (type != "jpeg" && type != "jpg" && type != "png" && type != "gif") {
				alert(`File Yang Harus Di Upload Haruslah gambar`);
			} else if (size >= 1024) {
				alert(`File Yang Harus Di Upload tidak boleh lebih dari 1MB`);
				return false;
			} else {
				foto_hotel.push(files[i]) // taruh foto_hotel lalu nanti untuk simpan

				var f = files[i]
				// console.log(i);
				var fileReader = new FileReader();

				if ($('[data-update="no"]').length > 0) {
					var index = -2 + $('[data-update="no"]').length;
				}
				fileReader.onload = (function(e) {
					index += 1;
					// console.log(index);
					var file = e.target;
					$(`#${foto_thumbnail}`).append(`
	        	<div class="d-inline" data-update="no">
		        	<img class="img-thumbnail foto_hotel_thumbnail" src="${e.target.result}" title="${file.name}"/>
		        	<a href="javascript:void(0)" class="remove" data-index="${index}">
		        		<i class="fas fa-times"></i>
		        	</a>
	        	</div>
	        `)
					$(".remove").click(function() {
						foto_hotel.splice(index, 1);
						$(this).parent(".d-inline").remove();
					});
				});
				fileReader.readAsDataURL(f);
			}
		}
	};

	function destroy_image(id_image, nama) {
		Swal.fire({
			title: 'Konfirmasi Hapus',
			text: "Apakah anda yakin ingin menghapus gambar ini ?",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak',
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: `<?= site_url('admin/perusahaan_admin/destroy_image/') ?>${id_image}/${nama}`,
					type: 'GET',
					dataType: 'JSON',
					success: function(data) {
						$(`img[src="<?= base_url() ?>assets/uploads/${nama}"]`).parent('.d-inline').remove();
					},
					statusCode: {
						404: function() {
							$(`img[src="<?= base_url() ?>assets/uploads/${nama}"]`).parent('.d-inline').remove();
						}
					},
					complete: function(data) {
						Swal.fire({
							type: 'success',
							title: 'Sukses',
							text: 'Berhasil menghapus gambar',
							timer: 1000,
							showConfirmButton: false
						})
					},
				})
			} else {
				return false;
			}
		})
	}

	function jumlah_tipe_kamarf(event) {
		var jumlah_tipe_kamar = $('[data-jumlah="jumlah_tipe_kamar"]');
		var jumlah_kamar = 0;
		for (var i = 0; i < jumlah_tipe_kamar.length; i++) {
			if (parseInt(jumlah_tipe_kamar[i].value))
				jumlah_kamar += parseInt(jumlah_tipe_kamar[i].value);
		}
		$('#jumlah_kamar').val(jumlah_kamar);
	}

	function jumlah_pegawai_lokalf(event) {
		var pegawai_lokal = $('[data-jumlah="pegawai_lokal"]');
		var jumlah_pegawai_lokal = 0;
		for (var i = 0; i < pegawai_lokal.length; i++) {
			if (parseInt(pegawai_lokal[i].value))
				jumlah_pegawai_lokal += parseInt(pegawai_lokal[i].value);
		}
		$('#jumlah_pegawai_lokal').val(jumlah_pegawai_lokal);
	}

	function jumlah_pegawai_asingf(event) {
		var pegawai_asing = $('[data-jumlah="pegawai_asing"]');
		var jumlah_pegawai_asing = 0;
		for (var i = 0; i < pegawai_asing.length; i++) {
			if (parseInt(pegawai_asing[i].value))
				jumlah_pegawai_asing += parseInt(pegawai_asing[i].value);
		}
		$('#jumlah_pegawai_asing').val(jumlah_pegawai_asing);
	}
</script>


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