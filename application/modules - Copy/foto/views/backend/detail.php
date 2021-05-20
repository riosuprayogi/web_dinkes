<script src="<?= base_url('assets/ckeditor4/ckeditor.js') ?>"></script>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit Album</h1>
            </div>

        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row mr-auto">
        <div class="col-md">
            <div class="card">

                <div class="card-body">

                    <?php foreach ($t_foto_galery as $a) : ?>
                        <form action="<?php echo base_url() . 'foto/updateDataAksi' ?>" method="post" enctype="multipart/form-data" id="updateAlbum">
                            <?= $this->session->flashdata('pesan') ?>
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" class="form-control" id="id_galery" name="id_galery" value="<?= $a->id_galery ?>">

                            <div class=" form-group row">
                                <label for="nama_album" class="col-sm-2 col-form-label">Nama Album </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_album" name="nama_album" value="<?= $a->nama_album, set_value('nama_album') ?>" autocomplete="off" disabled>
                                    <small class="text-danger pl-0" style="display:none" id="requiredJudulArtikel"> The judul artikel is required </small>
                                    <?= form_error('nama_album', '<small class="text-danger pl-0">', '</small>'); ?>
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
                                <label for="path_detail_foto" class="col-sm-2 col-form-label">Photo </label>
                                <div class="col-sm-3">
                                    <div class="custome-file">
                                        <input type="file" class="form-control" id="path_detail_foto" name="path_detail_foto[]" accept="image/*">
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





                            <div class="form-group row">
                                <div class="col-sm offset-sm-2">
                                    <div class="col-sm">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <!-- <th scope="col" style="width: 3%;">Urutan</th> -->
                                                    <th scope="col" style="width: 300px;">Image Profil</th>
                                                    <th scope="col">Ket. Foto</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                if (count($t_detail_foto_galery) > 0) {
                                                    foreach ($t_detail_foto_galery as $k) {
                                                ?>
                                                        <tr>
                                                            <input type="hidden" class="form-control" name="id_detail_path_detail_foto_update[]" value="<?= $k["id_detail_foto"]; ?>">
                                                            <!-- <td><?= $k["urutan"] ?></td> -->
                                                            <td>
                                                                <?php if ($k["path_detail_foto"] != NULL) {
                                                                ?>
                                                                    <a target="blank" href="<?= base_url('assets/backend/img/img_galery/' . $k["path_detail_foto"]) ?>">
                                                                        <img src="<?= base_url('assets/backend/img/img_galery/' . $k["path_detail_foto"]) ?>" alt="<?= $k["ket_foto"]; ?>" width="100%">
                                                                    </a>
                                                                <?php
                                                                } else { ?>
                                                                    <a href="javascript:void(0)">
                                                                        <img src="<?= base_url('assets/backend/img/not-found.jpg'); ?>" alt="" width="100%">
                                                                    </a>
                                                                <?php } ?>
                                                            </td>
                                                            <!-- <td></?= $k["ket_foto"] ?></td> -->
                                                            <td><input type="text" class="form-control" name="ket_foto_update[]" value="<?= $k["ket_foto"]; ?>" disabled></td>

                                                        </tr>
                                                <?php }
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="status" class="col-sm-2 col-form-label">Status </label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-control" id="status" disabled>
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

                            <hr>

                            <a href="<?= base_url(); ?>foto" class="btn btn-primary ml-3">Kembali</a>
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
    $('#updateAlbum').on('submit', function() {
        if ($('#nama_album').val() == "") {
            $("#requiredNamaAlbum").show();
            return false;
        }
    });

    $('#nama_album').on('input', function(e) {
        if ($('#judul_berita').val() == "") {
            $("#requiredNamaAlbum").show();
        } else {
            $("#requiredJudulBerita").hide();
        }
    });
</script>


<script>
    // $(document).on('click', '.addServiceEdit', function() {
    //     console.log($(this).parent())
    //     var wrapper = $('#imageMultiEdit');
    //     var html = `
    //         <div class="form-group row" id="imageMultiEdit">
    //             <label for="path_detail_foto" class="col-sm-2 col-form-label"></label>
    //             <div class="col-sm-3">
    //                 <div class="custome-file">
    //                     <input type="file" class="form-control" id="path_detail_foto" name="path_detail_foto[]" accept="image/*">
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
												<img src="<?= base_url('assets/backend/img/img_galery/noimage.png') ?>" class="img-thumbnail" id="imgPreview` + countimagefield + `" style="height: 400px; height: 350px;" />
												</div>
												<div class="form-group">
													<!-- <label for="exampleInputFile">File input</label> -->
													<div class="input-group">
														<div class="custom-file">
														<input type="text" class="form-control" id="image-label` + countimagefield + `" readonly>
                                                        <input type="file" class="custom-file-input upload_custom" id="customFileUpload` + countimagefield + `" data-count_image="` + countimagefield + `" name="path_detail_foto[]" style="display: none;">
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
                        <div class="form-group">
                                    <label for=""> Keterangan Foto</label>
                                    <input type="text" id="ket_foto" name="ket_foto[]" class="form-control" value="" placeholder="Masukkan Keterangan" required>
                                </div>
`;
            $(wrapper).append(html);
        });
    });

    // remove data di form ubah
    $(document).on('click', '.deleteImage', function() {
        var id = $(this).attr("data-id");
        $.ajax({
            url: '<?= base_url(); ?>foto/deleteImageAjax/' + id,
            type: 'DELETE',
            success: function(result) {
                location.reload();
            }
        });
    });
</script>