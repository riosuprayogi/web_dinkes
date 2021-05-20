<style >
  span.error.invalid-feedback{
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
  .form-control {
    background-color: #0000 !important;
}
</style>
<script>

  $(document).ready(function() {

    //Ajax Load data from ajax
    


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

    edit(<?= $permohonan->id_permohonan ?>);
  });

  function clear(){
    $('.preview-ktps').css('display','none');
    $('.preview-kuasas').css('display','none');
    $('.preview-ktp_kuasas').css('display','none');
    $('.preview-keterangans').css('display','none');
    $('.preview-aktas').css('display','none');
    $('.preview-pengesahans').css('display','none');
  }

  function edit(id){
    $.ajax({ url : "<?php echo site_url('permohonan/ajax_edit')?>/" + id,
		type: "GET",
		dataType: "JSON",
		async: false,
		success: function(data){

        $('.input-ktp').css('display','none');
        $('.input-kuasa').css('display','none');
        $('.input-ktp_kuasa').css('display','none');
        $('.input-keterangan').css('display','none');
        $('.input-akta').css('display','none');
        $('.input-pengesahan').css('display','none');

        clear();

        if(data.selesai_perbaikan == 'sudah'){
          Swal.fire({
              title: 'Maaf',
              text: "Permohonan Anda Sudah Diperbaiki",
              icon: 'warning',
              showCancelButton: false,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ok',
            }).then((result) => {
              if (result.value) {
                // window.history.back();
                // window.top.close();
                window.location.href = '<?= base_url() ?>';
                // window.open('<?= base_url() ?>');
              }
            });
        }
        

        
        if(data.id_kategori_permohonan == 1){
          if(data.file_ktp == null){
            $('.input-ktp').css('display','block');
            $('#ktp').prop('required',true);
            // console.log('wowo');
          }else{
            $('.input-ktp').css('display','block');
            $('.preview-ktps').css('display','block');
            $('#preview-ktps').css('display','block');
            $('#preview-ktp').attr("href", data.file_ktp).show();
          }

          
        }else if(data.id_kategori_permohonan == 2){
          if(data.file_ktp == null){
            $('.input-ktp').css('display','block');
            $('#ktp').prop('required',true);
          }else{
            $('.input-ktp').css('display','block');
            $('.preview-ktps').css('display','block');
            $('#preview-ktps').css('display','block');
            $('#preview-ktp').attr("href", data.file_ktp).show();
          }
          if(data.file_surat_kuasa == null){
            $('.input-kuasa').css('display','block');
            $('#kuasa').prop('required',true);
          }else{
            $('.input-kuasa').css('display','block');
            $('.preview-kuasas').css('display','block');
            $('#preview-kuasas').css('display','block');
            $('#preview-kuasa').attr("href", data.file_surat_kuasa).show();
          }
          if(data.file_ktp_kuasa == null){
            $('.input-ktp_kuasa').css('display','block');
            $('#ktp_kuasa').prop('required',true);
          }else{
            $('.input-ktp_kuasa').css('display','block');
            $('.preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasa').attr("href", data.file_ktp_kuasa).show();
          }
        }else if(data.id_kategori_permohonan == 3){
          if(data.file_ktp == null){
            $('.input-ktp').css('display','block');
            $('#ktp').prop('required',true);
          }else{
            $('.input-ktp').css('display','block');
            $('.preview-ktps').css('display','block');
            $('#preview-ktps').css('display','block');
            $('#preview-ktp').attr("href", data.file_ktp).show();
          }
          if(data.file_surat_kuasa == null){
            $('.input-kuasa').css('display','block');
            $('#kuasa').prop('required',true);
          }else{
            $('.input-kuasa').css('display','block');
            $('.preview-kuasas').css('display','block');
            $('#preview-kuasas').css('display','block');
            $('#preview-kuasa').attr("href", data.file_surat_kuasa).show();
          }
          if(data.file_ktp_kuasa == null){
            $('.input-ktp_kuasa').css('display','block');
            $('#ktp_kuasa').prop('required',true);
          }else{
            $('.input-ktp_kuasa').css('display','block');
            $('.preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasa').attr("href", data.file_ktp_kuasa).show();
          }
        }else if(data.id_kategori_permohonan == 4){
          if(data.file_ktp == null){
            $('.input-ktp').css('display','block');
            $('#ktp').prop('required',true);
          }else{
            $('.input-ktp').css('display','block');
            $('.preview-ktps').css('display','block');
            $('#preview-ktps').css('display','block');
            $('#preview-ktp').attr("href", data.file_ktp).show();
          }
          if(data.file_surat_kuasa == null){
            $('.input-kuasa').css('display','block');
            $('#kuasa').prop('required',true);
          }else{
            $('.input-kuasa').css('display','block');
            $('.preview-kuasas').css('display','block');
            $('#preview-kuasas').css('display','block');
            $('#preview-kuasa').attr("href", data.file_surat_kuasa).show();
          }
          if(data.file_ktp_kuasa == null){
            $('.input-ktp_kuasa').css('display','block');
            $('#ktp_kuasa').prop('required',true);
          }else{
            $('.input-ktp_kuasa').css('display','block');
            $('.preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasa').attr("href", data.file_ktp_kuasa).show();
          }


          if(data.file_akta == null){
            $('.input-akta').css('display','block');
            $('#akta').prop('required',true);
          }else{
            $('.input-akta').css('display','block');
            $('.preview-aktas').css('display','block');
            $('#preview-aktas').css('display','block');
            $('#preview-akta').attr("href", data.file_akta).show();
          }

          if(data.file_pengesahan == null){
            $('.input-pengesahan').css('display','block');
            $('#pengesahan').prop('required',true);
          }else{
            $('.input-pengesahan').css('display','block');
            $('.preview-pengesahans').css('display','block');
            $('#preview-pengesahans').css('display','block');
            $('#preview-pengesahan').attr("href", data.file_pengesahan).show();
          }
        }else if(data.id_kategori_permohonan == 5){
          if(data.file_ktp == null){
            $('.input-ktp').css('display','block');
            $('#ktp').prop('required',true);
          }else{
            $('.input-ktp').css('display','block');
            $('.preview-ktps').css('display','block');
            $('#preview-ktps').css('display','block');
            $('#preview-ktp').attr("href", data.file_ktp).show();
          }
          if(data.file_surat_kuasa == null){
            $('.input-kuasa').css('display','block');
            $('#kuasa').prop('required',true);
          }else{
            $('.input-kuasa').css('display','block');
            $('.preview-kuasas').css('display','block');
            $('#preview-kuasas').css('display','block');
            $('#preview-kuasa').attr("href", data.file_surat_kuasa).show();
          }
          if(data.file_ktp_kuasa == null){
            $('.input-ktp_kuasa').css('display','block');
            $('#ktp_kuasa').prop('required',true);
          }else{
            $('.input-ktp_kuasa').css('display','block');
            $('.preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasa').attr("href", data.file_ktp_kuasa).show();
          }
          

          if(data.file_akta == null){
            $('.input-akta').css('display','block');
            $('#akta').prop('required',true);
          }else{
            $('.input-akta').css('display','block');
            $('.preview-aktas').css('display','block');
            $('#preview-aktas').css('display','block');
            $('#preview-akta').attr("href", data.file_akta).show();
          }

          if(data.file_surat_keterangan == null){
            $('.input-keterangan').css('display','block');
            $('#keterangan').prop('required',true);
          }else{
            $('.input-keterangan').css('display','block');
            $('.preview-keterangans').css('display','block');
            $('#preview-keterangans').css('display','block');
            $('#preview-keterangan').attr("href", data.file_surat_keterangan).show();
          }
        }


        $('[name="app_id"],[name="access"],[name="bentuk_informasi"],[name="kategori"],[name="cara_memperoleh"]').empty();
        $('[name="kategori"],[name="cara_memperoleh"],[name="bentuk_informasi"]').append('<option >--PILIH--</option>');
        for (var i = 0; i < data.kategori.length; i++) {
          $('[name="kategori"]').append('<option value=' + data.kategori[i].id_kategori_permohonan + '>' + data.kategori[i].nama_permohonan + '</option>');
        }
        for (var i = 0; i < data.cara_memperoleh.length; i++) {
          $('[name="cara_memperoleh"]').append('<option value=' + data.cara_memperoleh[i].id_memperoleh_informasi + '>' + data.cara_memperoleh[i].nama_informasi + '</option>');
        }
        for (var i = 0; i < data.bentuk.length; i++) {
          $('[name="bentuk_informasi"]').append('<option value=' + data.bentuk[i].id_bentuk + '>' + data.bentuk[i].bentuk_informasi + '</option>');
        }

        // $('[name="bentuk_informasi"]').append('<option value="email">Email</option>');
        // $('[name="bentuk_informasi"]').append('<option value="langsung">Langsung</option>');

        $('[name="id"]').val(data.id_permohonan);
        $('[name="nik"]').val(data.nik);
        $('[name="name"]').val(data.nama_pemohon);
        $('.nama').html(data.nama_pemohon);
        $('[name="email"]').val(data.email);
        $('.email').html(data.email);
        $('[name="no_tlp"]').val(data.no_tlp);
        $('.no_tlp').html(data.no_tlp);
        $('[name="alamat"]').val(data.alamat);
        $('.alamat').html(data.alamat);

        $('[name="tujuan"]').val(data.tujuan);
        $('.tujuan').html(data.tujuan);
        
        $('[name="rincian"]').val(data.rincian_informasi);
        $('.rincian').html(data.rincian_informasi);

        $('[name="kategori"]').val(data.id_kategori_permohonan).trigger('changes');
        $('[name="cara_memperoleh"]').val(data.id_memperoleh_informasi);
        $('[name="bentuk_informasi"]').val(data.bentuk_informasi);
        $('[name="nama_skpd"]').val(data.skpd);
        $('[name="kode_unor"]').val(data.kode_unor);
        $('[name="nama_unor"]').val(data.nama_unor); // adun

        $('[name="file_ktp"').val(data.file_ktp);
        $('[name="file_kuasa"').val(data.file_surat_kuasa);
        $('[name="file_ktp_kuasa"').val(data.file_ktp_kuasa);
        $('[name="file_keterangan"').val(data.file_surat_keterangan);
        $('[name="file_akta"').val(data.file_akta);
        $('[name="file_pengesahan"').val(data.file_pengesahan);
    
        $('[name="cek_username"]').show();
        $('#btnCekNip').show();


        $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
        $('.modal-title').text('Ubah'); // Set title to Bootstrap modal title
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Error get data from ajax');
      }
    });
  }

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
      title: '',
      text: "Apa Anda Yakin Mengirim Perbaikan Permohonan Ini",
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
                text: "Permohonan Anda Berhasil Diperbaiki",
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
				<h3 class="mbr-section-title mbr-bold mbr-fonts-style">
					
				</h3>
			</div>
		</div>
		
		<div class="container-row align-center">
        	<div class="card rounded-lg">
              <div class="card-header"  style="background-color:#a0d9f6;">
                <h3>
                FORMULIR PERBAIKAN
                </h3>
              </div>
            	<div class="card-body" style="background-color:#fafeff;">
              <form role="form" id="form1">
              <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
              <input type="hidden" name="id" >
                <span class="d-none your-message form-group" style="margin-right: 2% !important;">
                    NIK :
                    <div class="input-group">
                        <input type="text"  id="nik" name="nik"  class="wpcf7-form-control" placeholder="NIK*" >
                        <div class=" input-group-prepend">
                        <button type="button" style="margin-bottom:15px !important;" onclick="cek_nik()" class="wpcf7-btn btn-success ">CEK NIK</button>
                        </div>
                    </div>
                </span>
                <span class="d-none your-message form-group">
                    Nama :
                    <input type="text" tabindex="1" id="name" name="name"  class="wpcf7-form-control" placeholder="Name*" >
                </span>

                                                                            
                <span class="d-none your-email form-group">
                    Email :
                    <input type="email" tabindex="3" id="email" name="email"  class="wpcf7-form-control" placeholder="Your Email*" >
                </span>
                <span class="d-none your-phone form-group">
                    Telepon :
                    <input type="text" tabindex="2" id="no_tlp" name="no_tlp"  class="wpcf7-form-control" placeholder="Phone" >
                </span>
                <div class="d-none your-message form-group" style="display:none;">
                        Kelompok :
                        <select name="kategori" class="wpcf7-form-control wpcf7-textarea"  >
                        <option  selected="true" disabled="disabled" value=""> Pilih Kategori </option>
                          <?php foreach ($kategori as $row) { ?>
                            <option value="<?php echo $row->id_kategori_permohonan ?>">
                              <?php echo $row->nama_permohonan ?>
                            </option>
                          <?php } ?>
                        </select>
                        
                </div>
                <div class="row">
                  <div class="col-md-6 align-left">
                    <div class="form-group">
                        <label for="">Nama : </label>
                        <span class="nama"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Email : </label>
                        <span class="email"></span>
                    </div>
                    <div class="form-group">
                        <label for="">No Telepon : </label>
                        <span class="no_tlp"></span>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat : </label>
                        <span class="alamat"></span>
                    </div>
                  </div>
                  <div class="col-md-6 align-left">
                    <div class="form-group">
                      <label for="">Tujuan Penggunaan Informasi: </label>
                      <span class="tujuan"></span>
                    </div>
                    <div class="form-group">
                      <label for="">Rincian Informasi yang Dibutuhkan: </label>
                      <span class="rincian"></span>
                    </div>
                  </div>
                </div>
                <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>File Yg Sudah diLengkapi</h5>
                            <hr>
                            <div class="form-group preview-ktps" style="margin-top: 20px;">
                            File KTP
                            <br>
                            <a href="" class="btn btn-sm btn-primary" target="_blank"  id="preview-ktp"   style="display:none"><img src="https://img.icons8.com/fluent/48/000000/file.png"/></a>
                            <input type="hidden" value="" id="file_ktp" name="file_ktp">
                            </div>
                            <div class="form-group preview-kuasas" style="margin-top: 20px;">
                            File kuasa
                            <br>
                            <a href="" target="_blank" class="btn btn-sm btn-primary" id="preview-kuasa"   style="display:none"><img src="https://img.icons8.com/fluent/48/000000/file.png"/></a>
                            <input type="hidden" value="" id="file_kuasa" name="file_kuasa">
                            </div>
                            <div class="form-group preview-ktp_kuasas" style="margin-top: 20px;">
                            File KTP Kuasa
                            <br>
                            <a href="" target="_blank" class="btn btn-sm btn-primary" id="preview-ktp_kuasa"   style="display:none"><img src="https://img.icons8.com/fluent/48/000000/file.png"/></a>
                            <input type="hidden" value="" id="file_ktp_kuasa" name="file_ktp_kuasa">
                            </div>
                            <div class="form-group preview-keterangans" style="margin-top: 20px;">
                            File Surat Keterangan
                            <br>
                            <a href="" target="_blank"  id="preview-keterangan" class="btn btn-sm btn-primary"  style="display:none"><img src="https://img.icons8.com/fluent/48/000000/file.png"/></a>
                            <input type="hidden" value="" id="file_keterangan" name="file_keterangan">
                            </div>
                            <div class="form-group preview-aktas" style="margin-top: 20px;">
                            File Dokumen Akta
                            <br>
                            <a href="" target="_blank"  id="preview-akta" class="btn btn-sm btn-primary"  style="display:none"><img src="https://img.icons8.com/fluent/48/000000/file.png"/></a>
                            <input type="hidden" value="" id="file_akta" name="file_akta">
                            </div>
                            <div class="form-group preview-pengesahans" style="margin-top: 20px;">
                            File Pengesahan
                            <br>
                            <a href="" target="_blank"  id="preview-pengesahan" class="btn btn-sm btn-primary"  style="display:none"><img src="https://img.icons8.com/fluent/48/000000/file.png"/></a>
                            <input type="hidden" value="" id="file_pengesahan" name="file_pengesahan">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Silahkan Lengkapi File Berikut</h5>
                            <hr>
                            <div class="input-ktp your-email form-group">
                                KTP : <br>
                                <input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" tabindex="2" id="ktp" name="ktp"  class="form-control" placeholder="Phone"> (JPEG/PDF)
                                <p style="color: black; font-style: italic; margin-top: 10px; margin-bottom: 10px; color: red;">
                                  <span style="color: red">*)</span> File yang diterima jpg/pdf <br>
                                  <span style="color: red">*)</span> Maksimal Ukuran File 5 MB
                                </p>
                            </div> 
                            <div class="input-kuasa your-phone form-group">
                                Surat Kuasa : <br>
                                <input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" tabindex="2" id="kuasa" name="kuasa"  class="form-control" placeholder="Phone"> (JPEG/PDF)
                                <p style="color: black; font-style: italic; margin-top: 10px; margin-bottom: 10px; color: red;">
                                  <span style="color: red">*)</span> File yang diterima jpg/pdf <br>
                                  <span style="color: red">*)</span> Maksimal Ukuran File 5 MB
                                </p>
                            </div> 
                            <div class="input-ktp_kuasa your-email form-group">
                                KTP Pemberi Kuasa : <br>
                                <input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" tabindex="2" id="ktp_kuasa" name="ktp_kuasa"  class="form-control" placeholder="Phone"> (JPEG/PDF)
                                <p style="color: black; font-style: italic; margin-top: 10px; margin-bottom: 10px; color: red;">
                                  <span style="color: red">*)</span> File yang diterima jpg/pdf <br>
                                  <span style="color: red">*)</span> Maksimal Ukuran File 5 MB
                                </p>
                            </div> 
                            <div class="input-keterangan your-phone form-group">
                                Surat keterangan : <br>
                                <input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" tabindex="2" id="keterangan" name="keterangan"  class="form-control" placeholder="Phone"> (JPEG/PDF)
                                <p style="color: black; font-style: italic; margin-top: 10px; margin-bottom: 10px; color: red;">
                                  <span style="color: red">*)</span> File yang diterima jpg/pdf <br>
                                  <span style="color: red">*)</span> Maksimal Ukuran File 5 MB
                                </p>
                            </div>
                            <div class="input-akta your-email form-group">
                                Surat Akta : <br>
                                <input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" tabindex="2" id="akta" name="akta"  class="form-control" placeholder="Phone"> (JPEG/PDF)
                                <p style="color: black; font-style: italic; margin-top: 10px; margin-bottom: 10px; color: red;">
                                  <span style="color: red">*)</span> File yang diterima jpg/pdf <br>
                                  <span style="color: red">*)</span> Maksimal Ukuran File 5 MB
                                </p>
                            </div> 
                            <div class="input-pengesahan your-phone form-group">
                                Surat pengesahan : <br>
                                <input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" tabindex="2" id="pengesahan" name="pengesahan"  class="form-control" placeholder="Phone"> (JPEG/PDF)
                                <p style="color: black; font-style: italic; margin-top: 10px; margin-bottom: 10px; color: red;">
                                  <span style="color: red">*)</span> File yang diterima jpg/pdf <br>
                                  <span style="color: red">*)</span> Maksimal Ukuran File 5 MB
                                </p>
                            </div>
                        </div>
                        
                    </div>
                    <span class="d-none your-message form-group">
                        Alamat :
                        <textarea name="alamat" tabindex="5" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" placeholder="alamat*" required ></textarea>
                    </span>
                    <span class="d-none your-message form-group">
                        Rincian Informasi Yang Dibutuhkan :
                        <textarea name="rincian" tabindex="5" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" placeholder="Rincian*" required ></textarea>
                    </span>  
                    <span class="d-none your-message form-group">
                        Tujuan Penggunaan Informasi :
                        <textarea name="tujuan" tabindex="5" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" placeholder="Tujuan *" required ></textarea>
                    </span>  
                    <span class="d-none your-message form-group">
                        Cara Memperoleh Informasi :
                        <select name="cara_memperoleh" class="wpcf7-form-control wpcf7-textarea" required >
                        <option  selected="true" disabled="disabled" > Pilih cara memperoleh </option>
                            <?php foreach ($cara_memperoleh as $row) { ?>
                            <option value="<?php echo $row->id_memperoleh_informasi ?>">
                                <?php echo $row->nama_informasi ?>
                            </option>
                            <?php } ?> 
                        </select>
                        
                    </span>  
                    <span class="d-none your-message form-group">
                        Cara Mendapatkan Salinan Informasi :
                        <select name="bentuk_informasi" class="wpcf7-form-control wpcf7-textarea" required >
                        <option  selected="true" disabled="disabled" > Pilih Bentuk Informasi </option> 
                        </select>
                    </span>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success " id="submit" name="submit"> Kirim</button>
                         
                        <!-- <button id="finish-btn" class="btn btn-primary" type="button"><i class="fa fa-fw fa-check"></i> Ajukan Permohonan</button> -->
                    </div>
                </form>
				      </div>
			    </div>
    </div>
  </div>
</section>
                                 