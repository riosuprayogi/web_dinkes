<style >
  div.error.invalid-feedback{
    color: red;
  }
  .is-invalid{
    border-radius: 15px;
    border: 1px solid #c21d20 !important;
  }

  .form-control {
    background-color: #0000 !important;
  }
</style>
<script>
  
  $(document).ready(function() {

    $.ajax({ 
        url : '<?php echo site_url('keberatan/ajax_cek/')?>'+'<?= $permohonan->id_permohonan?>',
        type: "GET",
        dataType: "JSON",
        cache: true,
        contentType: false,
        processData: false,//async: false,
        success: function(data){

          if(data.status == 'ada'){
            Swal.fire({
              title: 'Gagal',
              text: "Anda Sudah Memberikan Keberatan",
              icon: 'warning',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ok',
            }).then((result) => {
              if (result.value) {
                // window.history.back();
                window.location.href = '<?= base_url() ?>';

              }
            });
            
          }

          $('#btnSave').text('Simpan'); //change button text
          $('#btnSave').attr('disabled',false); //set button enable


        },
        error: function (jqXHR, textStatus, errorThrown){
          alert('Error adding / update data');
          $('#btnSave').text('Simpan'); //change button text
          $('#btnSave').attr('disabled',false); //set button enable

        }
    });


  var pesan = "Silahkan Masukan";

  $('#form1').validate({
      rules: {
      
        alamat: {
          required: true,
          minlength: 5
        },
        nama: {
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
        tujuan: {
          required: pesan+" Tujuan Informasi",
          minlength: "Your alamat must be at least 5 characters long"
        },
        rincian: {
          required: pesan+" Rincian",
          minlength: "Your alamat must be at least 5 characters long"
        },
        alamat_pemohon: {
          required: pesan+" Alamat",
          minlength: "Your alamat must be at least 5 characters long"
        },
        alamat_kuasa: {
          required: pesan+" Alamat",
          minlength: "Your alamat must be at least 5 characters long"
        },
        email : pesan+" Email",
        nama_pemohon : pesan+"Nama Pemohon",
        pekerjaan_pemohon : pesan+"Pekerjaan Pemohon",
        telepon_pemohon : pesan+"No Telepon Pemohon",
        nama_kuasa_pemohon : pesan+" Nama Kuasa Pemohon",
        telepon_kuasa_pemohon : pesan+" Telepon Kuasa Pemohon",
        alasan : pesan+" Alasan Keberatan",
        kasus : pesan+" Kasus Posisi",

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
      },
      submitHandler: function (form) {
        save();
      }
    });
  });

  function save(){

    Swal.fire({
      title: '',
      text: "Apa Anda Yakin Mengirim Keberatan Ini?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Tidak'
    }).then((result) => {
      if (result.value) {
          var form = $('#form1')[0]; // You need to use standard javascript object here
          var formData = new FormData(form);
            $('#btnSave').text('Proses..'); //change button text
            $('#btnSave').attr('disabled',true); //set button disable
            var url;

            url = "<?php echo site_url('keberatan/ajax_insert')?>";

            // ajax adding data to database
            $.ajax({ 
              url : url,
              type: "POST",
              data: formData,
              dataType: "JSON",
              cache: false,
              contentType: false,
              processData: false,//async: false,
              success: function(data){

                if(data.status){
                  Swal.fire({
                    title: 'Berhasil',
                    text: "Permohonan Keberatan Anda akan diproses 30 Hari Kerja",
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ok',
                  }).then((result) => {
                    if (result.value) {
                      // window.history.back();
                      window.location.href = '<?= base_url() ?>';
                    }
                  });
                  
                }

                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable


              },
              error: function (jqXHR, textStatus, errorThrown){
                alert('Error adding / update data');
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable

              }
            });
        }
    });

    
    }

</script>


<section id="struktur" class="cid-struktur mbr-fullscreen" data-rv-view="1620">
	<div class="container align-center">
		<div class="media-container-row align-center">
			<div class="row justify-content-md-center" style="padding-top:50px;padding-bottom:10px;">
				
			</div>
		</div>
		
		<div class="container-row align-left">
        	<div class="card">
            <div class="card-header" style="background-color:#a0d9f6;">
              <h3 class="align-center">
                FORMULIR KEBERATAN
              </h3>
            </div>
            	<div class="card-body" style="background-color:#fafeff;">
                <form role="form" id="form1">
                  <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                    value="<?php echo $this->security->get_csrf_hash(); ?>">
                  <input type="hidden" name="id_permohonan" value="<?= $permohonan->id_permohonan?>">
                  <div class=" your-message form-group" style="margin-right: 2% !important;">
                    <label> No Permohonan :</label>
                    <input type="text" readonly="readonly" id="no_permohonan" name="no_permohonan"
                      value="<?= $permohonan->no_permohonan?>" class="form-control" placeholder="No Permohonan*">
                  </div>
                  <div class=" your-message form-group">
                    <label> Rincian Informasi Yang Dibutuhkan :</label>
                    <textarea name="rincian" tabindex="5" readonly="readonly" cols="40" rows="10"
                      class="form-control textarea"
                      placeholder="Rincian*"><?= $permohonan->rincian_informasi?></textarea>
                  </div>
                  <div class=" your-message form-group">
                    <label> Tujuan Penggunaan Informasi :</label>
                    <textarea name="tujuan" tabindex="5" readonly="readonly" cols="40" rows="10"
                      class="form-control textarea" placeholder="Tujuan *"><?= $permohonan->tujuan?></textarea>
                  </div>
                  <div class=" your-message form-group align-center" style="text-decoration: underline !important;">
                    IDENTITAS PEMOHON
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class=" your-email form-group">
                        <label> Nama :</label>
                        <input type="text" tabindex="3" id="nama_pemohon" name="nama_pemohon"
                          value="<?= $permohonan->nama_pemohon?>" class="form-control" placeholder="Nama*" required>
                      </div>
                      <div class=" your-phone form-group">
                        <label> Alamat :</label>
                        <input type="text" tabindex="2" id="alamat_pemohon" name="alamat_pemohon"
                          value="<?= $permohonan->alamat?>" class="form-control" placeholder="Alamat" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class=" your-email form-group">
                        <label> Pekerjaan :</label>
                        <input type="text" tabindex="3" id="pekerjaan_pemohon" name="pekerjaan_pemohon" value=""
                          class="form-control" placeholder="Pekerjaan*" required>
                      </div>
                      <div class=" your-phone form-group">
                        <label> No Telepon :</label>
                        <input type="text" tabindex="2" id="telepon_pemohon" name="telepon_pemohon"
                          value="<?= $permohonan->no_tlp?>" class="form-control" placeholder="Telepon Pemohon" required>
                      </div>

                    </div>
                  </div>

                  <div class=" your-message form-group align-center" style="text-decoration: underline !important;">
                    IDENTITAS KUASA PEMOHON
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class=" your-email form-group">
                        <label> Nama :</label>
                        <input type="text" tabindex="3" id="nama_kuasa_pemohon" name="nama_kuasa_pemohon" value=""
                          class="form-control" placeholder="Nama" required>
                      </div>
                      <div class=" your-phone form-group">
                        <label> No Telepon :</label>
                        <input type="text" tabindex="2" id="telepon_kuasa_pemohon" name="telepon_kuasa_pemohon" value=""
                          class="form-control" placeholder="Telepon Pemohon" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class=" your-phone form-group">
                        <label> Alamat :</label>
                        <textarea name="alamat_kuasa" tabindex="5" cols="40" rows="5" class="form-control textarea"
                          placeholder="alamat*" required></textarea>
                      </div>

                    </div>
                  </div>
                  <div class=" your-message form-group">
                    Alasan Pengajuan Keberatan :
                    <select class="form-control" name="alasan" id="alasan" required>
                      <option selected="true" disabled="disabled" value=""> ==== Pilih Pengajuan Keberatan ====
                      </option>
                      <?php foreach ($alasan as $row) { ?>
                      <option value="<?php echo $row->id_alasan ?>">
                        <?php echo $row->alasan ?>
                      </option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class=" your-message form-group">
                    Kasus Posisi :
                    <textarea name="kasus" tabindex="5" cols="40" rows="10" class="form-control textarea"
                      placeholder="Kasus Posisi*" required></textarea>
                  </div>

                  <div class="wrap-submit align-center">
                    <input type="submit" value="KIRIM" class="btn btn-success submit" id="submit" name="submit">
                  </div>
                </form>
             
                </div>
        </div>
    </div>
  </div>
</section>

