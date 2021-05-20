<script src="<?= base_url('assets/ckeditor4/ckeditor.js') ?>"></script>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Berita</h1>
            </div>

        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row mr-auto">
        <div class="col-md">
            <div class="card">

                <div class="card-body">

                    <?php foreach ($t_berita as $a) : ?>
                        <form action="<?php echo base_url() . 'berita/updateDataAksi' ?>" method="post" enctype="multipart/form-data" id="updateBerita">
                            <?= $this->session->flashdata('pesan') ?>
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="form-group row">
                                <input type="hidden" class="form-control" id="id_berita" name="id_berita" value="<?= $a->id_berita ?>">
                                <!-- <label for="id_kategori" class="col-sm-2 col-form-label">Kategori </label>
                                <div class="col-sm-10">
                                    <select name="id_kategori" id="id_kategori" class="form-control">
                                        <option value="">--Pilih--</option>
                                        <?php foreach ($t_kategori as $k) : ?>
                                            <option value="<?php echo $k->id_kategori; ?>" <?php if ($k->id_kategori == $a->id_kategori) {
                                                                                                echo "selected";
                                                                                            } ?>>
                                                <?php echo $k->nama_kategori; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('id_kategori', '<small class="text-danger pl-0">', '</small>'); ?>
                                </div> -->
                            </div>
                            <div class=" form-group row">
                                <label for="judul_berita" class="col-sm-2 col-form-label">Judul Berita </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="judul_berita" name="judul_berita" value="<?= $a->judul_berita, set_value('judul_berita') ?>" autocomplete="off">
                                    <small class="text-danger pl-0" style="display:none" id="requiredJudulBerita"> The judul artikel is required </small>
                                    <?= form_error('judul_berita', '<small class="text-danger pl-0">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status" class="col-sm-2 col-form-label">Status </label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control" id="status">
                                        <option value="">--Pilih--</option>
                                        <option value="show" <?php if ($a->status == 'show') {
                                                                    echo "selected";
                                                                } ?>>Show</option>
                                        <option value="hide" <?php if ($a->status == 'hide') {
                                                                    echo "selected";
                                                                } ?>>Hide</option>
                                    </select>
                                    <?= form_error('status', '<small class="text-danger pl-0">', '</small>'); ?>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <input type="hidden" class="form-control" id="id_admin" name="id_admin" value="<?= $a->id_admin ?>">
                                <label for="id_admin" class="col-sm-2 col-form-label">Nama Admin </label>
                                <div class="col-sm-10">
                                    <select name="id_admin" id="id_admin" class="form-control">
                                        <?php foreach ($web_admin as $wa) : ?>
                                            <option value="">--Pilih--</option>
                                            <option value="<?php echo $wa->id_admin; ?>" <?php if ($wa->id_admin == $a->id_admin) {
                                                                                                echo "selected";
                                                                                            } ?>>
                                                <?php echo $wa->nama_admin; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('id_admin', '<small class="text-danger pl-0">', '</small>'); ?>
                                </div>
                            </div> -->

                            <!-- <div class="form-group row" id="imageMultiEdit">
                                <label for="path_foto_artikel" class="col-sm-2 col-form-label">Photo </label>
                                <div class="col-sm-3">
                                    <div class="custome-file">
                                        <input type="file" class="form-control" id="path_foto_artikel" name="path_foto_artikel[]" accept="image/*">
                                        <span style="color: red; font-size:12px;">* format photo (jpg,jpeg,png) ukuran file max 2 Mb</span><br>
                                        <span style="color: red; font-size:12px;">* jika multiupload/update, urutan tidak boleh sama dengan urutan photo lain.</span>
                                    </div>
                                </div>
                                <label for="urutan">Urutan</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="urutan" name="urutan[]">
                                </div>
                                <label for="ket_foto">Keterangan</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" id="ket_foto" name="ket_foto[]">
                                </div>
                                <button type="button" class="btn btn-primary addServiceEdit" style="height: 40px;">Tambah</button>
                            </div>
                            <div id="imageMultiEdit"></div> -->


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

                            <div id="imageMultiEdit"></div>

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
                                <label for="path_foto_artikel" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <!-- <div class="form-group row mt-3"> -->
                                    <!-- <label for="urutan" class="col-sm-1 col-form-label">Urutan</label>
                                        <div class="col-sm-2">
                                            <input type="text" class="form-control" id="urutan" name="urutan[]" value="" autocomplete="off">
                                        </div> -->
                                    <!-- <label for="ket_foto" class="col-sm-1 col-form-label">Ket. Foto</label>
                                        <div class="col-sm-4">
                                            <input type="text" class="form-control" id="ket_foto" name="ket_foto[]" value="" autocomplete="off">
                                        </div>
                                        <div class="col-sm-1 text-right">
                                            <button type="button" class="btn btn-primary ml-4 addServiceEdit">Tambah</button>
                                        </div>
                                    </div> -->
                                    <div class="card-footer">
                                        <!-- <button type="submit" class="btn btn-info">Sign in</button> -->
                                        <button type="button" class="btn btn-primary float-right addServiceEdit">Tambah Foto</button>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-sm offset-sm-2">
                                    <div class="col-sm">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <!-- <th scope="col" style="width: 3%;">Urutan</th> -->
                                                    <th scope="col" style="width: 3%;">Image Profil</th>
                                                    <!-- <th scope="col">Ket. Image</th> -->
                                                    <th scope="col" style="width: 3%;">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                if (count($t_foto_berita) > 0) {
                                                    foreach ($t_foto_berita as $k) {
                                                ?>
                                                        <tr>
                                                            <input type="hidden" class="form-control" name="id_detail_path_foto_artikel_update[]" value="<?= $k["id_foto_berita"]; ?>">
                                                            <!-- <td><?= $k["urutan"] ?></td> -->
                                                            <td>
                                                                <?php if ($k["path_foto_artikel"] != NULL) {
                                                                ?>
                                                                    <a target="blank" href="<?= base_url('assets/backend/img/img_berita/' . $k["path_foto_artikel"]) ?>">
                                                                        <img src="<?= base_url('assets/backend/img/img_berita/' . $k["path_foto_artikel"]) ?>" alt="<?= $k["ket_foto"]; ?>" width="100%">
                                                                    </a>
                                                                <?php
                                                                } else { ?>
                                                                    <a href="javascript:void(0)">
                                                                        <img src="<?= base_url('assets/backend/img/not-found.jpg'); ?>" alt="" width="100%">
                                                                    </a>
                                                                <?php } ?>
                                                            </td>
                                                            <!-- <td></?= $k["ket_foto"] ?></td> -->
                                                            <!-- <td><input type="text" class="form-control" name="ket_foto_update[]" value="<?= $k["ket_foto"]; ?>"></td> -->
                                                            <td>
                                                                <a class="btn btn-danger deleteImage" href="javascript:void(0)" data-id_foto_berita="<?= $k["id_foto_berita"]; ?>" onclick="return confirm('Apakah Anda yakin akan menghapus photo ini ?');"><i class="fas fa-trash-alt bg-danger" data-toggle="tooltip" title="Delete"></i></a>
                                                            </td>
                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="isi_berita" class="col-sm-2 col-form-label">Isi Berita </label>
                                <div class="col-sm-10">
                                    <textarea name="isi_berita" id="isi_berita"><?= $a->isi_berita, set_value('isi_berita') ?></textarea>
                                    <small class="text-danger pl-0" style="display:none" id="requiredIsiArtikel"> The isi artikel is required </small>
                                    <?= form_error('isi_berita', '<small class="text-danger pl-0">', '</small>'); ?>
                                </div>
                            </div>
                            <hr>
                            <button type="update" class="btn btn-primary ml-3">Ubah</button>
                            <a href="<?= base_url(); ?>berita" class="btn btn-primary ml-3">Kembali</a>
                        </form>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    CKEDITOR.replace('isi_berita');
</script>
<script>
    $('#updateBerita').on('submit', function() {
        if ($('#judul_berita').val() == "") {
            $("#requiredJudulBerita").show();
            return false;
        }
        if ($('#isi_berita').val() == "") {
            $("#requiredIsiBerita").show();
            return false;
        }
    });

    $('#judul_berita').on('input', function(e) {
        if ($('#judul_berita').val() == "") {
            $("#requiredJudulBerita").show();
        } else {
            $("#requiredJudulBerita").hide();
        }
    });

    $('#isi_berita').on('input', function(e) {
        if ($('#isi_berita').val() == "") {
            $("#requiredIsiBerita").show();
        } else {
            $("#requiredIsiBerita").hide();
        }
    });
</script>


<script>
    // $(document).on('click', '.addServiceEdit', function() {
    //     console.log($(this).parent())
    //     var wrapper = $('#imageMultiEdit');
    //     var html = `
    //         <div class="form-group row" id="imageMultiEdit">
    //             <label for="path_foto_artikel" class="col-sm-2 col-form-label"></label>
    //             <div class="col-sm-3">
    //                 <div class="custome-file">
    //                     <input type="file" class="form-control" id="path_foto_artikel" name="path_foto_artikel[]" accept="image/*">
    //                     <span style="color: red; font-size:12px;">* format photo (jpg,jpeg,png) ukuran file max 2 Mb</span><br>
    //                     <span style="color: red; font-size:12px;">* jika multiupload/update, urutan tidak boleh sama dengan urutan photo lain.</span>
    //                 </div>
    //             </div>
    //                 <label for="urutan">Urutan</label>
    //             <div class="col-sm-2">
    //                 <input type="text" class="form-control" id="urutan" name="urutan[]" placeholder="Urutan">
    //             </div>
    //                 <label for="ket_foto">Keterangan</label>
    //             <div class="col-sm-2">
    //                 <input type="text" class="form-control" id="ket_foto" name="ket_foto[]" placeholder="Keterangan">
    //             </div>
    //         </div>
    //     `;
    //     $(wrapper).append(html);
    // });
    // $('.custom-file').on('change', function() {
    //     let fileName = $(this).val().split('\\').pop();
    //     $(this).next('.addService').addClass("selected").html(fileName);
    // });

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
        $(document).on('click', '.addServiceEdit', function() {
            var countimagefield = $(".image_field").length + 1;
            console.log("jumlah image =" + countimagefield);
            var wrapper = $('#imageMultiEdit');
            var html = `

            <div class="form-group row image_field">
										<label for="path_detail_foto" class="col-sm-2 col-form-label"></label>
										<div class="col-sm-10">
											<div class="row">
												<div class="col-sm-4">
												<img src="<?= base_url('assets/backend/img/img_berita/noimage.png') ?>" class="img-thumbnail" id="imgPreview` + countimagefield + `" style="height: 250px; height: 300px;" />
												</div>
												<div class="form-group">
													<!-- <label for="exampleInputFile">File input</label> -->
													<div class="input-group">
														<div class="custom-file">
														<input type="text" class="form-control" id="image-label` + countimagefield + `" readonly required>
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

    // remove data di form ubah
    $(document).on('click', '.deleteImage', function() {
        var id_foto_berita = $(this).attr("data-id_foto_berita");
        $.ajax({
            url: '<?= base_url(); ?>berita/deleteImageAjax/' + id_foto_berita,
            type: 'DELETE',
            success: function(result) {
                location.reload();
            }
        });
    });
</script>

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