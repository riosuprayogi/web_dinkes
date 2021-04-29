<script>
  
  $(document).ready(function () {

    $.validator.setDefaults({
      submitHandler: function () {
        save();
      }
    });

    var pesan = "Silahkan Masukan";

    $('#form1').validate({
      rules: {

        alamat: {
          required: true,
          minlength: 5
        },
        no_tlp: {
          required: true
        },
        no_fax: {
          required: true
        },
        email: {
          required: true,
          email: true,
        },

      },
      messages: {
        alamat: {
          required: pesan + " Alamat",
          minlength: "Your alamat must be at least 5 characters long"
        },
        no_tlp: pesan + " No Telepon",

      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });

  function save() {

    Swal.fire({
      title: 'Apa Anda Yakin?',
      text: "Apa Anda Yakin Menyimpan Data Kontak Ini?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Tidak'
    }).then((result) => {
      if (result.value) {

        $('#btnSave').text('Proses..'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable
        var url;

        url = "<?php echo site_url('profil/ajax_insert_kontak')?>";

        // ajax adding data to database
        $.ajax({
          url: url,
          type: "POST",
          data: $('#form1').serialize(),
          dataType: "JSON",
          //async: false,
          success: function (data) {


            if (data.status) {
              Swal.fire({
                title: 'Berhasil',
                text: "Menyimpan Data Kontak",
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok',
              }).then((result) => {
                if (result.value) {
                  location.reload();

                }
              });

            }

            $('#btnSave').text('Simpan'); //change button text
            $('#btnSave').attr('disabled', false); //set button enable


          },
          error: function (jqXHR, textStatus, errorThrown) {
            alert('Error adding / update data');
            $('#btnSave').text('Simpan'); //change button text
            $('#btnSave').attr('disabled', false); //set button enable

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
            <h1 class="m-0 text-dark">Manajemen Kontak PPID</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>"">Home</a></li>
              <li class="breadcrumb-item active">Kontak PPID</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
<section class="content">
	<div class="card">
		<form role="form" id="form1">
      <div class="card-body ">
          <input type="text" name="id" value="<?php echo $id_kontak;?>" class="d-none" id="id" placeholder="Nama Pengembang">
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

          <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" value="<?php echo $alamat;?>" class="form-control" id="alamat" placeholder="Alamat">
          </div>
          <div class="form-group">
            <label for="no_tlp">No Telepon</label>
            <input type="text" name="no_tlp" value="<?php echo $no_tlp;?>" class="form-control" id="no_tlp" placeholder="No Telepon">
          </div>

          <div class="form-group">
            <label for="no_fax">No Fax</label>
            <input type="text" name="no_fax" value="<?php echo $no_fax;?>" class="form-control" id="no_fax" placeholder="No Fax">
          </div>
          <div class="form-group">
            <label for="no_fax">Email</label>
            <input type="text" name="email" value="<?php echo $email;?>" class="form-control" id="email" placeholder="Email">
          </div>
          
        <!-- /.card-body -->
      </div>
      <div class="card-footer">
        <button type="submit" id="btnSave" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
      </div>
    </form>
	</div>
</section>