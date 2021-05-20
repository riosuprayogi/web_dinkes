<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Manajemen Banner</h1>
            </div>

        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row mr-auto">
        <div class="col-md">
            <div class="card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Update Banner</h6>
                </div>
                <div class="card-body">
                    <?php foreach ($banner as $bnr) : ?>
                        <form action="<?php echo base_url() . 'banner/updateDataAksi/' . $bnr->id_banner ?>" method="post" id="updateMitra" enctype="multipart/form-data">
                            <!-- untuk manggil id biar ke update -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <input type="hidden" class="form-control" id="id_banner" name="id_banner" value="<?= $bnr->id_banner ?>">

                            <div class="form-group row">
                                <label for="nama_banner" class="col-sm-2 col-form-label">Nama Banner</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="nama_banner" name="nama_banner" value="<?= $bnr->nama_banner ?>">
                                    <small class="text-danger pl-0" style="display:none" id="requiredNamaBanner"> The nama mitra is required </small>
                                    <?= form_error('nama_banner', '<small class="text-danger pl-0">', '</small>'); ?>
                                </div>
                            </div>
                            <!-- 
                            <div class="form-group row">
                                <label for="link_mitra" class="col-sm-2 col-form-label">Link Mitra</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="link_mitra" name="link_mitra" value="<?= $bnr->link_mitra ?>">
                                    <small class="text-danger pl-0" style="display:none" id="requiredNamaMitra"> The nama mitra is required </small>
                                    <?= form_error('id_banner', '<small class="text-danger pl-0">', '</small>'); ?>
                                </div>
                            </div> -->

                            <!-- <div class="form-group row">
                                <label for="link_web_mitra" class="col-sm-2 col-form-label">Link Web Mitra</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="link_web_mitra" name="link_web_mitra">
                                    <small class="text-danger pl-0" style="display:none" id="requiredLinkWebMitra"> The link web mitra is required </small>
                                    <?= form_error('nama_banner', '<small class="text-danger pl-0">', '</small>'); ?>
                                </div>
                            </div> -->

                            <div class="form-group row">
                                <div class="col-sm-2" for="path_gambar_banner">Banner</div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <img src="<?= base_url('assets/backend/img/img_banner/' . $bnr->path_gambar_banner) ?>" class="img-thumbnail" id="imgPreview" style="height: 400px; height: 350px;" />
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="custom-file">
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="image-label" disabled required>
                                                    <input type="file" class="custom-file-input" id="customFileUpload" name="path_gambar_banner" value="<?= base_url($bnr->path_gambar_banner); ?>" style="display: none;">
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
                                        <option value="show" <?php if ($bnr->status == 'show') {
                                                                    echo "selected";
                                                                } ?>>Show</option>
                                        <option value="hide" <?php if ($bnr->status == 'hide') {
                                                                    echo "selected";
                                                                } ?>>Hide</option>
                                    </select>
                                    <?= form_error('status', '<small class="text-danger pl-0">', '</small>'); ?>
                                </div>
                            </div>
                            <hr>
                            <button type="update" class="btn btn-primary ml-3">Ubah</button>
                            <a href="<?= base_url(); ?>banner" class="btn btn-primary ml-3">Kembali</a>
                        </form>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#updateBanner').on('submit', function() {
        if ($('#nama_banner').val() == "") {
            $("#requiredNamaMitra").show();
            return false;
        }
        if ($('#link_mitra').val() == "") {
            $("#requiredLinkWebMitra").show();
            return false;
        }
    });

    $('#nama_banner').on('input', function(e) {
        if ($('#nama_banner').val() == "") {
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