<script src="<?= base_url('assets/ckeditor4/ckeditor.js') ?>"></script>

<div class="container-fluid">
    <div class="row mr-auto">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">INPUT DATA ARTIKEL</h6>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url() . 'backend/admin/inputartikel/tambahAksi'; ?>" method="post" enctype="multipart/form-data">
                        <?= $this->session->flashdata('pesan') ?>
                        <div class="form-group row">
                            <label for="id_kat_artikel" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <select name="id_kat_artikel" id="id_kat_artikel" class="form-control">
                                    <option value="">---Pilih---</option>
                                    <?php foreach ($kategori as $k) : ?>
                                        <option value="<?php echo $k->id_kat_artikel; ?>"><?php echo $k->kategori_artikel; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('id_kat_artikel', '<small class="text-danger pl-0">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="judul_artikel" class="col-sm-2 col-form-label">Judul Artikel</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="judul_artikel" name="judul_artikel" value="<?= set_value('judul_artikel') ?>" autocomplete="off">
                                <?= form_error('judul_artikel', '<small class="text-danger pl-0">', '</small>'); ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="publish" class="col-sm-2 col-form-label">Publish</label>
                            <div class="col-sm-10">
                                <select name="publish" id="publish" class="form-control">
                                    <option value="">---Pilih---</option>
                                    <option value="show">Show</option>
                                    <option value="hide">Hide</option>
                                </select>
                                <?= form_error('publish', '<small class="text-danger pl-0">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="id_admin" class="col-sm-2 col-form-label">Nama Admin</label>
                            <div class="col-sm-10">
                                <!-- <select name="id_admin" id="id_admin" class="form-control">
                                    <option value="<?= $this->session->userdata('id_admin') ?>"><?= $this->session->userdata('user_admin'); ?></option>
                                </select> -->
                                <select name="id_admin" id="id_admin" class="form-control">
                                    <!-- <option>---Pilih---</option> -->
                                    <?php foreach ($admin as $k) : ?>
                                        <option value="<?php echo $k->id_admin; ?>"><?php echo $k->nama_admin; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <label for="path_foto_artikel" class="col-sm-2 col-form-label">Photo</label>
                            <div class="col-sm-3" style="margin-bottom: 10px;">
                                <input type="file" class="form-control" id="path_foto_artikel" name="path_foto_artikel[]" value="">
                                <span style="font-style: italic; color:red;">*) Format photo (jpg,jpeg,png) ukuran file max 2 Mb</span><br>
                                <span style="font-style: italic; color:red;">*) Format urutan tidak boleh sama dengan yang lain.</span>
                            </div>
                            <label for="urutan" class="col-form-label">Urutan</label>
                            <div class="col-sm-1">
                                <input type="text" class="form-control" id="urutan" name="urutan[]" value="" autocomplete="off">
                            </div>
                            <label for="ket_foto" class="col-form-label">Ket. Foto</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" id="ket_foto" name="ket_foto[]" value="" autocomplete="off">
                            </div>
                            <div class="col-sm-1 text-right">
                                <button type="button" class="btn btn-primary ml-4 addService">Tambah</button>
                            </div>
                        </div>
                        <div id="imageMulti"></div> -->

                        <!-- <div class="form-group row" id="imageMulti">
                            <label for="path_foto_artikel" class="col-sm-2 col-form-label">Photo Artikel</label>
                            <div class="col-sm-3">
                                <input type="file" class="form-control" id="path_foto_artikel" name="path_foto_artikel[]" value="" accept="image/*">
                                <span style="color: red; font-size:12px;">* Format photo (jpg,jpeg,png) ukuran file max 2 Mb</span><br>
                                <span style="color: red; font-size:12px;">* Format urutan tidak boleh sama dengan yang lain.</span>
                            </div>
                            <label for="urutan">Urutan</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="urutan" name="urutan[]" value="" autocomplete="off">
                            </div>
                            <label for="ket_foto">Keterangan</label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="ket_foto" name="ket_foto[]" value="" autocomplete="off">
                            </div>
                            <button type="button" class="btn btn-primary addService" style="height: 50px;">Tambah</button>
                        </div>
                        <div id="imageMulti"></div> -->

                        <div class="form-group row image_field">
                            <label for="path_foto_artikel" class="col-sm-2 col-form-label">Photo Artikel</label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="<?= base_url('assets/backend/img/img_berita/noimage.png') ?>" class="img-thumbnail" id="imgPreview1" style="height: 400px; height: 350px;" />
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="custom-file">
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="image-label1" disabled required>
                                                <input type="file" class="custom-file-input upload_custom" id="customFileUpload1" data-count_image="1" name="path_foto_artikel[]" style="display: none;">
                                                <?= form_error('path_foto_artikel', '<small class="text-danger pl-0">', '</small>'); ?>
                                                <span style="font-style: italic; color:red;">*) Format photo (jpg,jpeg,png) ukuran file max 2 Mb.</span><br>
                                                <span style="font-style: italic; color:red;">*) Tidak di sarankan upload (pdf,xls,doc,txt).</span>
                                            </div>
                                            <div class="col-sm-3 mt-3">
                                                <button class="btn btn-primary" onclick="open_file(1)" data-count_image="1" type="button">Pilih Gambar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <label for="urutan" class="col-sm-1 col-form-label">Urutan</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="urutan" name="urutan[]" value="" autocomplete="off">
                                    </div>
                                    <label for="ket_foto" class="col-sm-1 col-form-label">Ket. Image</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="ket_foto" name="ket_foto[]" value="" autocomplete="off">
                                    </div>
                                    <div class="col-sm-1 text-right">
                                        <button type="button" class="btn btn-primary ml-4 addService">Tambah</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="imageMulti"></div>

                        <div class="form-group row">
                            <label for="isi_artikel" class="col-sm-2 col-form-label">Isi Artikel</label>
                            <div class="col-sm-10">
                                <textarea name="isi_artikel" id="isi_artikel" cols="30" rows="10"><?= set_value('isi_artikel') ?></textarea>
                                <?= form_error('isi_artikel', '<small class="text-danger pl-0">', '</small>'); ?>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary ml-3">Simpan</button>
                        <a href="<?= base_url(); ?>backend/admin/inputartikel" class="btn btn-primary ml-3">Kembali</a>
                        <br>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    CKEDITOR.replace('isi_artikel');
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
                            <label for="path_foto_artikel" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="<?= base_url('assets/backend/img/img_berita/noimage.png') ?>" class="img-thumbnail" id="imgPreview` + countimagefield + `" style="height: 400px; height: 350px;" />
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="custom-file">
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="image-label` + countimagefield + `" disabled required>
                                                <input type="file" class="custom-file-input upload_custom" id="customFileUpload` + countimagefield + `" data-count_image="` + countimagefield + `" name="path_foto_artikel[]" style="display: none;">
                                                <span style="font-style: italic; color:red;">*) Format photo (jpg,jpeg,png) ukuran file max 2 Mb.</span><br>
                                                <span style="font-style: italic; color:red;">*) Tidak di sarankan upload (pdf,xls,doc,txt).</span>
                                            </div>
                                            <div class="col-sm-3 mt-3">
                                                <button class="btn btn-primary" data-count_image="` + countimagefield + `"  onclick="open_file(` + countimagefield + `)" type="button">Pilih Gambar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <label for="urutan" class="col-sm-1 col-form-label">Urutan</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" id="urutan" name="urutan[]" value="" autocomplete="off">
                                    </div>
                                    <label for="ket_foto" class="col-sm-1 col-form-label">Ket. Image</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="ket_foto" name="ket_foto[]" value="" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
`;
            $(wrapper).append(html);
        });
    });


    // $(document).on('click', '.addService', function() {
    //     var html = '<label for="path_foto_artikel" class="col-sm-2 col-form-label">&nbsp;</label><div class="col-sm-3" style="margin-bottom: 10px;"><input type="file" class="form-control" id="path_foto_artikel" name="path_foto_artikel[]" value="" accept="image/*"><span style="color: red; font-size:12px;">* format photo (jpg,jpeg,png) ukuran file max 2 Mb</span><br><span style="color: red; font-size:12px;">* Jika Multiupload, urutan tidak boleh sama dengan urutan photo lain.</span></div><label for="urutan">Urutan</label><div class="col-sm-2"><input type="text" class="form-control" id="urutan" name="urutan[]" value="" autocomplete="off"></div><label for="ket_foto">Keterangan</label><div class="col-sm-2"><input type="text" class="form-control" id="ket_foto" name="ket_foto[]" value="" autocomplete="off"></div>';
    //     $(this).parent().append(html);
    // });
    //     $(document).on('click', '.addService', function() {

    //         var wrapper = $('#imageMulti');
    //         var html = `
    //     <div class="form-group row">
    //         <label for="path_foto_artikel" class="col-sm-2 col-form-label"></label>
    //         <div class="col-sm-3">
    //             <input type="file" class="form-control" id="path_foto_artikel" name="path_foto_artikel[]" value=""><span style="font-style: italic; color:red;">*) format photo (jpg,jpeg,png) ukuran file max 2 Mb</span><br><span style="font-style: italic; color:red;">*) Format urutan tidak boleh sama dengan yang lain.</span>
    //         </div>
    //         <label for="urutan" class="col-form-label">Urutan</label>
    //         <div class="col-sm-1">
    //             <input type="text" class="form-control" id="urutan" name="urutan[]" value="" autocomplete="off">
    //         </div>
    //         <label for="ket_foto" class="col-form-label">Ket. Foto</label>
    //         <div class="col-sm-4">
    //             <input type="text" class="form-control" id="ket_foto" name="ket_foto[]" value="" autocomplete="off">
    //         </div>
    //     </div>
    // `;
    //         $(wrapper).append(html);
    //     });
</script>