
<style >
  div.error.invalid-feedback{
    color: red;
  }
  .is-invalid{
    border-radius: 15px;
    border: 1px solid #c21d20 !important;
  }
  /* .swal2-popup {
    font-size: 1.8rem !important;
  }
  .swal2-styled.swal2-confirm {
      padding: .375rem .75rem;
      font-size: 1.8rem;
      height: 50px !important;
      width: 70px !important;
  } */
  label{
    float:left !important;
  }
  
.form-control {
    background-color: #0000 !important;
}
</style>
<script>
  
  $(document).ready(function() {

    $('.input-ktp').css('display','none');
    $('.input-kuasa').css('display','none');
    $('.input-ktp_kuasa').css('display','none');
    $('.input-keterangan').css('display','none');
    $('.input-akta').css('display','none');
    $('.input-pengesahan').css('display','none');

    $('[name="kategori"]').change(function(){
      var id = $('[name="kategori"]').val();
      $('.input-ktp').css('display','none');
      $('.input-kuasa').css('display','none');
      $('.input-ktp_kuasa').css('display','none');
      $('.input-keterangan').css('display','none');
      $('.input-akta').css('display','none');
      $('.input-pengesahan').css('display','none');

      if(id == 1){
        $('.input-ktp').css('display','block');

      }else if( id== 2){
        $('.input-ktp').css('display','block');
        $('.input-kuasa').css('display','block');
        $('.input-ktp_kuasa').css('display','block');
      }else if( id=='3'){
        $('.input-ktp').css('display','block');
        $('.input-kuasa').css('display','block');
        $('.input-ktp_kuasa').css('display','block');

      }else if( id=='4'){
        $('.input-ktp').css('display','block');
        $('.input-kuasa').css('display','block');
        $('.input-ktp_kuasa').css('display','block');
        $('.input-akta').css('display','block');
        $('.input-pengesahan').css('display','block');
      }else if( id=='5'){
        $('.input-ktp').css('display','block');
        $('.input-kuasa').css('display','block');
        $('.input-ktp_kuasa').css('display','block');
        $('.input-akta').css('display','block');
        $('.input-keterangan').css('display','block');
      }
    });

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
        alamat: {
          required: pesan+" Alamat",
          minlength: "Your alamat must be at least 5 characters long"
        },
        tujuan: {
          required: pesan+" Tujuan Informasi",
          minlength: "Your alamat must be at least 5 characters long"
        },
        rincian: {
          required: pesan+" Rincian",
          minlength: "Your alamat must be at least 5 characters long"
        },
        email : pesan+" Email",
        nik : pesan+" NIK",
        name : pesan+" Nama",
        no_tlp : pesan+" No Telepon",
        kategori : pesan+" Kategori",
        ktp : pesan+" KTP",
        kuasa : pesan+" Surat Kuasa",
        ktp_kuasa : pesan+" KTP Pemberi Kuasa",
        keterangan : pesan+" Surat Keterangan",
        akta : pesan+" Akta",
        pengesahan : pesan+" Surat Pengesahan",
        cara_memperoleh : pesan+" Cara Memperoleh Informasi",
        bentuk_informasi : pesan+" Bentuk Informasi",

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

  function cek_nik(){
	$('#btn_cek_nik').text('sedang mencari...');
	$('#btn_cek_nik').attr('disabled',true);
	var nik = $('[name="nik"]').val();
	//Ajax Load data from ajax
	$.ajax({ url : "<?php echo site_url('permohonan/ajax_cek_nik/')?>/"+nik,
		type: "GET",
		dataType: "JSON",
		async: false,
		success: function(data){
			if(nik.length == 0){
				Swal.fire({
              title: 'Info',
              text: "Silahkan Isi NIK",
              icon: 'info',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ok',
            }).then((result) => {
              if (result.value) {
              }
            });
			}else{
				if(data.warga == null){
					Swal.fire({
              title: '',
              text: "Silahkan Daftar Secara Manual",
              icon: 'Error',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ok',
            }).then((result) => {
              if (result.value) {
              }
            });
					
				}else{

          $('[name="name"]').val(data.warga.nama);
          $('[name="name"]').prop('readonly', true);
          $('[name="alamat"]').val(data.warga.alamat);
          // $('[name="alamat"]').prop('readonly', true);
					Swal.fire({
              title: 'Berhasil',
              text: "NIK Terdaftar Pada DUKCAPIL",
              icon: 'success',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ok',
            }).then((result) => {
              if (result.value) {
              }
            });
				}
			}
			$('#btn_cek_nik').text('Cek NIK');
			$('#btn_cek_nik').attr('disabled',false);
		},
		error: function (jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
}

  function save(){

    Swal.fire({
      title: 'Apa Anda Yakin?',
      text: "Apa Anda Yakin Mengirim Permohonan Ini",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Tidak'
    }).then((result) => {
      if (result.value) {
        $('button#submit').attr('disabled',true).html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Loading...');

        var form = $('#form1')[0]; // You need to use standard javascript object here
        var formData = new FormData(form);
          $('#btnSave').text('Proses..'); //change button text
          $('#btnSave').attr('disabled',true); //set button disable
          var url;

          url = "<?php echo site_url('permohonan/ajax_upload')?>";

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
              $('button#submit').attr('disabled',false).html('Kirim');


              if(data.status){
                Swal.fire({
                  title: 'Berhasil',
                  text: "Permohonan Anda akan diproses 10 Hari Kerja",
                  icon: 'success',
                  showCancelButton: false,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok',
                }).then((result) => {
                  if (result.value) {
                    window.history.back();
                  }
                });
                
              }else if(data.gagal){
                Swal.fire({
                  title: 'Kesalahan File '+data.file,
                  html: data.gagal,
                  icon: 'error',
                  showCancelButton: false,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Ok',
                }).then((result) => {
                  if (result.value) {
                    // window.history.back();
                    // window.location.href = '<?= base_url() ?>';
                  }
                });
              }

              $('#btnSave').text('Simpan'); //change button thariext
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


<section id="struktur" class=" cid-struktur mbr-fullscreen" data-rv-view="1620">
	<div class="container-fluid align-center">
		<div class="media-container-row align-center">
			<div class="row justify-content-md-center" style="padding-top:50px;padding-bottom: 50px;">
				
			</div>
		</div>
		
		<div class="container align-center">
        	<div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
              <div class="card  rounded-lg">
                <div class="card-header rounded-lg text-dark " style="background-color:#a0d9f6;">
                  <h3>
                    FORMULIR PERMOHONAN
                  </h3>
                </div>
                <div class="card-body border-info rounded-2" style="background-color:#fafeff;">
                  <form role="form" id="form1">
                      <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                      <input type="hidden" name="id" >
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="font-weight-bold">Nama :</label>
                            <input type="text" id="name" name="name"  class="form-control" placeholder="Nama*" required>
                          </div>                
                        </div>
                        <div class="col-md-6">                    
                          <div class="form-group your-email form-group">
                            <label class="font-weight-bold">Email :</label>
                            <input type="email" id="email" name="email"  class="form-control" placeholder="Email*" required>
                          </div>
                        </div>                
                      </div>
                      
                      <div class="form-group"> 
                        <label class="font-weight-bold">NIK :</label>
                        <div class="input-group mb-3">
                          <input type="text" maxlength="16" id="nik" name="nik" class="form-control" placeholder="NIK*"aria-label="" aria-describedby="basic-addon1">
                            <div class="input-group-append">
                              <button class="btn btn-outline-secondary " style="background-color:#a3f1ff;" onclick="cek_nik()" type="button">CEK NIK</button>
                            </div>
                        </div>
                      </div>

                      
                      <div class="form-group your-phone form-group">
                        <label class="font-weight-bold">Telepon :</label>
                        <input type="text"  maxlength="13" id="no_tlp" name="no_tlp"  class="form-control" placeholder="No Telepon" >
                      </div>
                      <div class="form-group">
                        <label class="font-weight-bold">Legal Standing :</label>
                        <select name="kategori" class="form-control textarea" required >
                          <option  selected="true" disabled="disabled" value=""> Pilih Legal Standing </option>
                            <?php foreach ($kategori as $row) { ?>
                              <option value="<?php echo $row->id_kategori_permohonan ?>">
                                <?php echo ucwords($row->nama_permohonan) ?>
                              </option>
                            <?php } ?>
                          </select>
                          
                      </div>
                      <div class="row">
                        <div class="col-sm-6 input-ktp">
                          <div class=" form-group your-email form-group">
                            <label class="font-weight-bold"> KTP : </label>
                              <input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" id="ktp" name="ktp"  class="form-control"> (JPEG/PDF)
                              <p style="color: black; font-style: italic; margin-top: 10px; margin-bottom: 10px; color: red;">
                                <span style="color: red">*)</span> File yang diterima jpg/pdf <br>
                                <span style="color: red">*)</span> Maksimal Ukuran File 5 MB
                              </p>
                          </div> 
                        </div>
                        <div class="col-sm-6 input-ktp_kuasa">
                          <div class=" form-group your-email form-group">
                            <label class="font-weight-bold"> KTP Pemberi Kuasa : </label>
                              <input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" id="ktp_kuasa" name="ktp_kuasa"  class="form-control"> (JPEG/PDF)
                              <p style="color: black; font-style: italic; margin-top: 10px; margin-bottom: 10px; color: red;">
                                  <span style="color: red">*)</span> File yang diterima jpg/pdf <br>
                                  <span style="color: red">*)</span> Maksimal Ukuran File 5 MB
                                </p>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-sm-6 input-kuasa">
                          <div class="form-group your-phone form-group">
                            <label class="font-weight-bold"> Surat Kuasa : </label>
                              <input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" id="kuasa" name="kuasa"  class="form-control"> (JPEG/PDF)
                              <p style="color: black; font-style: italic; margin-top: 10px; margin-bottom: 10px; color: red;">
                                  <span style="color: red">*)</span> File yang diterima jpg/pdf <br>
                                  <span style="color: red">*)</span> Maksimal Ukuran File 5 MB
                                </p>
                          </div> 
                        </div>
                        <div class="col-sm-6 input-akta">
                          <div class=" form-group your-email form-group">
                            <label class="font-weight-bold"> Surat Akta : </label>
                              <input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" id="akta" name="akta"  class="form-control"> (JPEG/PDF)
                              <p style="color: black; font-style: italic; margin-top: 10px; margin-bottom: 10px; color: red;">
                                  <span style="color: red">*)</span> File yang diterima jpg/pdf <br>
                                  <span style="color: red">*)</span> Maksimal Ukuran File 5 MB
                                </p>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                        <div class="col-sm-6 input-keterangan">
                          <div class=" form-group your-phone form-group">
                            <label class="font-weight-bold"> Surat keterangan : </label>
                              <input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" id="keterangan" name="keterangan"  class="form-control"> (JPEG/PDF)
                              <p style="color: black; font-style: italic; margin-top: 10px; margin-bottom: 10px; color: red;">
                                  <span style="color: red">*)</span> File yang diterima jpg/pdf <br>
                                  <span style="color: red">*)</span> Maksimal Ukuran File 5 MB
                                </p>
                          </div>
                        </div>
                        <div class="col-sm-6 input-pengesahan">
                          <div class=" form-group your-phone form-group">
                            <label class="font-weight-bold"> Surat pengesahan : </label>
                              <input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" id="pengesahan" name="pengesahan"  class="form-control"> (JPEG/PDF)
                              <p style="color: black; font-style: italic; margin-top: 10px; margin-bottom: 10px; color: red;">
                                  <span style="color: red">*)</span> File yang diterima jpg/pdf <br>
                                  <span style="color: red">*)</span> Maksimal Ukuran File 5 MB
                                </p>
                          </div>
                        </div>
                      </div> 
                      
                      
                      
                      <div class="form-group">
                        <label class="font-weight-bold">Alamat :</label>
                        <textarea name="alamat" cols="40" rows="5" class="form-control" placeholder="Alamat" ></textarea>
                      </div>
                      <div class="form-group">
                      <label class="font-weight-bold">Rincian Informasi Yang Dibutuhkan :</label>
                          <textarea name="rincian" cols="40" rows="7" class="form-control " placeholder="Rincian" ></textarea>
                      </div>  
                      <div class="form-group">
                      <label class="font-weight-bold">Tujuan Penggunaan Informasi :</label>
                          <textarea name="tujuan" cols="40" rows="7" class="form-control " placeholder="Tujuan " ></textarea>
                      </div>  
                      <div class="form-group">
                      <label class="font-weight-bold">Cara Memperoleh Informasi :</label>
                          <select name="cara_memperoleh" class="form-control textarea">
                          <option  selected="true" disabled="disabled" > ==== Pilih ====</option>
                            <?php foreach ($cara_memperoleh as $row) { ?>
                              <option value="<?php echo $row->id_memperoleh_informasi ?>">
                                <?php echo $row->nama_informasi ?>
                              </option>
                            <?php } ?> 
                          </select>
                          
                      </div>  
                      <div class="form-group">
                      <label class="font-weight-bold">Cara Mendapatkan Salinan Informasi :</label>
                          <select name="bentuk_informasi" class="form-control textarea">
                          <option  selected="true" disabled="disabled" > ==== Pilih ==== </option>
                          <?php foreach ($bentuk as $row) { ?>
                              <option value="<?php echo $row->id_bentuk ?>">
                                <?php echo $row->bentuk_informasi ?>
                              </option>
                            <?php } ?> 
                          </select>
                      </div>                                                             
                      <div class="form-group">
                          <button type="submit" class="btn btn-success " id="submit" name="submit">kirim</button>
                      </div>
                  </form> 
                </div>
            </div>
            </div>
            <div class="col-md-2">
              
            </div>
          </div>
    </div>
  </div>
</section>
<script>
	$("#nik,#no_tlp").on("keypress keyup blur",function (event) {    
           $(this).val($(this).val().replace(/[^\d].+/, ""));
            if ((event.which < 48 || event.which > 57)) {
                event.preventDefault();
            }
        });
</script>