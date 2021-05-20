<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Manajemen Mitra</h1>
            </div>

        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row mr-auto">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Update Data Mitra</h6>
                </div>
                <div class="card-body">
                    <?php foreach ($mitra as $mtr) : ?>
                        <form action="<?php echo base_url() . 'link_terkait/updateDataAksi/' . $mtr->id_mitra ?>" method="post" id="updateMitra" enctype="multipart/form-data">
                            <!-- untuk manggil id biar ke update -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" class="form-control" id="id_mitra" name="id_mitra" value="<?= $mtr->id_mitra ?>">

                            <div class="form-group row">
                                <label for="nama_mitra" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_mitra" name="nama_mitra" value="<?= $mtr->nama_mitra ?>">
                                    <small class="text-danger pl-0" style="display:none" id="requiredNamaMitra"> The nama mitra is required </small>
                                    <?= form_error('id_mitra', '<small class="text-danger pl-0">', '</small>'); ?>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="link_mitra" class="col-sm-2 col-form-label">Link Mitra</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="link_mitra" name="link_mitra" value="<?= $mtr->link_mitra ?>">
                                    <small class="text-danger pl-0" style="display:none" id="requiredNamaMitra"> The nama mitra is required </small>
                                    <?= form_error('id_mitra', '<small class="text-danger pl-0">', '</small>'); ?>
                                </div>
                            </div>

                            <!-- <div class="form-group row">
                                <label for="link_web_mitra" class="col-sm-2 col-form-label">Link Web Mitra</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="link_web_mitra" name="link_web_mitra">
                                    <small class="text-danger pl-0" style="display:none" id="requiredLinkWebMitra"> The link web mitra is required </small>
                                    <?= form_error('nama_mitra', '<small class="text-danger pl-0">', '</small>'); ?>
                                </div>
                            </div> -->

                            <div class="form-group row">
                                <div class="col-sm-2" for="path_gambar_mitra">Path Icon Mitra</div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <img src="<?= base_url('assets/backend/img/img_mitra/' . $mtr->path_gambar_mitra) ?>" class="img-thumbnail" id="imgPreview" style="height: 400px; height: 350px;" />
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="custom-file">
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="image-label" disabled required>
                                                    <input type="file" class="custom-file-input" id="customFileUpload" name="path_gambar_mitra" value="<?= base_url($mtr->path_gambar_mitra); ?>" style="display: none;">
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
                                    <select name="status" class="form-control" id="status">
                                        <option value="show" <?php if ($mtr->status == 'show') {
                                                                    echo "selected";
                                                                } ?>>Show</option>
                                        <option value="hide" <?php if ($mtr->status == 'hide') {
                                                                    echo "selected";
                                                                } ?>>Hide</option>
                                    </select>
                                    <?= form_error('status', '<small class="text-danger pl-0">', '</small>'); ?>
                                </div>
                            </div>
                            <hr>
                            <button type="update" class="btn btn-primary ml-3">Ubah</button>
                            <a href="<?= base_url(); ?>link_terkait" class="btn btn-primary ml-3">Kembali</a>
                        </form>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#updateBanner').on('submit', function() {
        if ($('#nama_mitra').val() == "") {
            $("#requiredNamaMitra").show();
            return false;
        }
        if ($('#link_mitra').val() == "") {
            $("#requiredLinkWebMitra").show();
            return false;
        }
    });

    $('#nama_mitra').on('input', function(e) {
        if ($('#nama_mitra').val() == "") {
            $("#requiredNamaMitra").show();
        } else {
            $("#requiredNamaMitra").hide();
        }
    });
    $('#link_mitra').on('input', function(e) {
        if ($('#link_mitra').val() == "") {
            $("#requiredLinkWebMitra").show();
        } else {
            $("#requiredLinkWebMitra").hide();
        }
    });
</script>
<!-- ambil file photo jquery -->
<script>
    // $('.custom-file-input').on('change', function() {
    //     let fileName = $(this).val().split('\\').pop();
    //     $(this).next('.custom-file-label').addClass("selected").html(fileName);
    // });

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