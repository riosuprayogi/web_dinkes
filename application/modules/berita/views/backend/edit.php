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
                                <label for="id_kategori" class="col-sm-2 col-form-label">Kategori </label>
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
                                </div>
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