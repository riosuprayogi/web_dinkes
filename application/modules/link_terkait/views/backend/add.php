<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Manajemen Link Terkait</h1>
            </div>

        </div>
    </div>
</div>


<div class="container-fluid">
    <div class="row mr-auto">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Input Link Terkait</h6>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url() . 'link_terkait/action_add'; ?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="form-group row">
                            <label for="nama_mitra" class="col-sm-2 col-form-label">Nama Link Terkait</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_mitra" name="nama_mitra" value="<?= set_value('nama_mitra'); ?>" autocomplete="off">
                                <?= form_error('nama_mitra', '<small class="text-danger pl-0">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="link_mitra" class="col-sm-2 col-form-label">Link Terkait</label>
                            <div class="col-sm-10">
                                <input class="form-control" id="link_mitra" name="link_mitra" value="">
                                <?= form_error('link_mitra', '<small class="text-danger pl-0">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2" for="path_gambar_mitra">Foto Link Terkait</div>
                            <div class="col-sm-10">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="<?= base_url('assets/backend/img/img_berita/noimage.png') ?>" class="img-thumbnail" id="imgPreview" style="height: 400px; height: 350px;" />
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="custom-file">
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="image-label" disabled required>
                                                <input type="file" class="custom-file-input" id="customFileUpload" name="path_gambar_mitra" style="display: none;">
                                                <span style="font-style: italic; color:red;">*) Format photo (jpg,jpeg,png) ukuran file max 2 Mb.</span><br>
                                                <span style="font-style: italic; color:red;">*) Tidak di sarankan upload (pdf,xls,doc,txt).</span>
                                            </div>
                                            <div class="col-sm-3 mt-3">
                                                <button class="btn btn-primary" type="button" id="open-file">Pilih Gambar</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status" class="col-sm-2 col-form-label">Status</label>
                            <div class="col-sm-10">
                                <select name="status" id="status" class="form-control" value="<?= set_value('status') ?>">
                                    <option>---Pilih---</option>
                                    <option value="show">Show</option>
                                    <option value="hide">Hide</option>
                                </select>
                                <?= form_error('status', '<small class="text-danger pl-0">', '</small>'); ?>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary ml-3">Simpan</button>
                        <a href="<?= base_url(); ?>link_terkait" class="btn btn-primary ml-3">Kembali</a>
                        <br>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#open-file").on("click", function() {
        //alert('asdf');
        $("#customFileUpload").trigger("click");

    });

    $('#customFileUpload').on('change', function(e) {

        let file = $("input[type=file]").get(0).files[0];

        $("#image-label").val(file.name);

        if (file) {
            var reader = new FileReader();

            reader.onload = function() {
                $("#imgPreview").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
    });
</script>