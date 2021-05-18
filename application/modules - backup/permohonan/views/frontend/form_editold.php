<style >
  span.error.invalid-feedback{
    color: red;
  }
  .is-invalid{
    border-radius: 15px;
    border: 1px solid #c21d20 !important;
  }
  .swal2-popup {
    font-size: 1.8rem !important;
  }
  .swal2-styled.swal2-confirm {
      padding: .375rem .75rem;
      font-size: 1.8rem;
      height: 50px !important;
      width: 70px !important;
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
    $.ajax({ url : "<?php echo site_url('permohonan/ajax_edit/')?>/" + id,
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
        

        
        if(data.id_kategori_permohonan == 1){
          if(data.file_ktp == null){
            $('.input-ktp').css('display','block');
            console.log('wowo');
          }else{
            $('.input-ktp').css('display','none');
            $('.preview-ktps').css('display','block');
            $('#preview-ktps').css('display','block');
            $('#preview-ktp').attr("href", data.file_ktp).show();
          }

          
        }else if(data.id_kategori_permohonan == 2){
          if(data.file_ktp == null){
            $('.input-ktp').css('display','block');
          }else{
            $('.input-ktp').css('display','none');
            $('.preview-ktps').css('display','block');
            $('#preview-ktps').css('display','block');
            $('#preview-ktp').attr("href", data.file_ktp).show();
          }
          if(data.file_surat_kuasa == null){
            $('.input-kuasa').css('display','block');
          }else{
            $('.input-kuasa').css('display','none');
            $('.preview-kuasas').css('display','block');
            $('#preview-kuasas').css('display','block');
            $('#preview-kuasa').attr("href", data.file_surat_kuasa).show();
          }
        }else if(data.id_kategori_permohonan == 3){
          if(data.file_ktp == null){
            $('.input-ktp').css('display','block');
          }else{
            $('.input-ktp').css('display','none');
            $('.preview-ktps').css('display','block');
            $('#preview-ktps').css('display','block');
            $('#preview-ktp').attr("href", data.file_ktp).show();
          }
          if(data.file_surat_kuasa == null){
            $('.input-kuasa').css('display','block');
          }else{
            $('.input-kuasa').css('display','none');
            $('.preview-kuasas').css('display','block');
            $('#preview-kuasas').css('display','block');
            $('#preview-kuasa').attr("href", data.file_surat_kuasa).show();
          }
          if(data.file_ktp_kuasa == null){
            $('.input-ktp_kuasa').css('display','block');
          }else{
            $('.input-ktp_kuasa').css('display','none');
            $('.preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasa').attr("href", data.file_ktp_kuasa).show();
          }
        }else if(data.id_kategori_permohonan == 4){
          if(data.file_ktp == null){
            $('.input-ktp').css('display','block');
          }else{
            $('.input-ktp').css('display','none');
            $('.preview-ktps').css('display','block');
            $('#preview-ktps').css('display','block');
            $('#preview-ktp').attr("href", data.file_ktp).show();
          }
          if(data.file_surat_kuasa == null){
            $('.input-kuasa').css('display','block');
          }else{
            $('.input-kuasa').css('display','none');
            $('.preview-kuasas').css('display','block');
            $('#preview-kuasas').css('display','block');
            $('#preview-kuasa').attr("href", data.file_surat_kuasa).show();
          }
          if(data.file_ktp_kuasa == null){
            $('.input-ktp_kuasa').css('display','block');
          }else{
            $('.input-ktp_kuasa').css('display','none');
            $('.preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasa').attr("href", data.file_ktp_kuasa).show();
          }


          if(data.file_akta == null){
            $('.input-akta').css('display','block');
          }else{
            $('.input-akta').css('display','none');
            $('.preview-aktas').css('display','block');
            $('#preview-aktas').css('display','block');
            $('#preview-akta').attr("href", data.file_akta).show();
          }

          if(data.file_pengesahan == null){
            $('.input-pengesahan').css('display','block');
          }else{
            $('.input-pengesahan').css('display','none');
            $('.preview-pengesahans').css('display','block');
            $('#preview-pengesahans').css('display','block');
            $('#preview-pengesahan').attr("href", data.file_pengesahan).show();
          }
        }else if(data.id_kategori_permohonan == 5){
          if(data.file_ktp == null){
            $('.input-ktp').css('display','block');
          }else{
            $('.input-ktp').css('display','none');
            $('.preview-ktps').css('display','block');
            $('#preview-ktps').css('display','block');
            $('#preview-ktp').attr("href", data.file_ktp).show();
          }
          if(data.file_surat_kuasa == null){
            $('.input-kuasa').css('display','block');
          }else{
            $('.input-kuasa').css('display','none');
            $('.preview-kuasas').css('display','block');
            $('#preview-kuasas').css('display','block');
            $('#preview-kuasa').attr("href", data.file_surat_kuasa).show();
          }
          if(data.file_ktp_kuasa == null){
            $('.input-ktp_kuasa').css('display','block');
          }else{
            $('.input-ktp_kuasa').css('display','none');
            $('.preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasa').attr("href", data.file_ktp_kuasa).show();
          }
          if(data.file_ktp_kuasa == null){
            $('.input-ktp_kuasa').css('display','block');
          }else{
            $('.input-ktp_kuasa').css('display','none');
            $('.preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasa').attr("href", data.file_ktp_kuasa).show();
          }

          if(data.file_akta == null){
            $('.input-akta').css('display','block');
          }else{
            $('.input-akta').css('display','none');
            $('.preview-aktas').css('display','block');
            $('#preview-aktas').css('display','block');
            $('#preview-akta').attr("href", data.file_akta).show();
          }

          if(data.file_pengesahan == null){
            $('.input-pengesahan').css('display','block');
          }else{
            $('.input-pengesahan').css('display','none');
            $('.preview-pengesahans').css('display','block');
            $('#preview-pengesahans').css('display','block');
            $('#preview-pengesahan').attr("href", data.file_pengesahan).show();
          }
          if(data.file_surat_keterangan == null){
            $('.input-keterangan').css('display','block');
          }else{
            $('.input-keterangan').css('display','none');
            $('.preview-keterangans').css('display','block');
            $('#preview-keterangans').css('display','block');
            $('#preview-keterangan').attr("href", data.file_surat_keterangan).show();
          }
        }

        $('[name="kategori"]').change(function(){
            var ix = $('[name="kategori"]').val();
            $('.input-ktp').css('display','none');
            $('.input-kuasa').css('display','none');
            $('.input-ktp_kuasa').css('display','none');
            $('.input-keterangan').css('display','none');
            $('.input-akta').css('display','none');
            $('.input-pengesahan').css('display','none');

            if(ix == 1){
              $('.input-ktp').css('display','block');

            }else if( ix== 2){
              $('.input-ktp').css('display','block');
              $('.input-kuasa').css('display','block');

            }else if( ix=='3'){
              $('.input-ktp').css('display','block');
              $('.input-kuasa').css('display','block');
              $('.input-ktp_kuasa').css('display','block');

            }else if( ix=='4'){
              $('.input-ktp').css('display','block');
              $('.input-kuasa').css('display','block');
              $('.input-ktp_kuasa').css('display','block');
              $('.input-akta').css('display','block');
              $('.input-pengesahan').css('display','block');
            }else if( ix=='5'){
              $('.input-ktp').css('display','block');
              $('.input-kuasa').css('display','block');
              $('.input-ktp_kuasa').css('display','block');
              $('.input-akta').css('display','block');
              $('.input-keterangan').css('display','block');
            }
          });

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

        $('[name="bentuk_informasi"]').append('<option value="email">Email</option>');
        $('[name="bentuk_informasi"]').append('<option value="langsung">Langsung</option>');

        $('[name="id"]').val(data.id_permohonan);
        $('[name="nik"]').val(data.nik);
        $('[name="name"]').val(data.nama_pemohon);
        $('[name="email"]').val(data.email);
        $('[name="no_tlp"]').val(data.no_tlp);
        $('[name="alamat"]').val(data.alamat);
        $('[name="tujuan"]').val(data.tujuan);
        $('[name="rincian"]').val(data.rincian_informasi);
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
                window.history.back();
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

</script>
<div id="featured-title" class="featured-title clearfix">
    <div id="featured-title-inner" class="container clearfix">
        <div class="featured-title-inner-wrap">                    
            <div id="breadcrumbs">
                <div class="breadcrumbs-inner">
                    <div class="breadcrumb-trail">
                        <a href="<?php echo base_url(); ?>" class="trail-begin">Beranda</a>
                        <span class="sep">|</span>
                        <span class="trail-end">Permohonan</span>
                    </div>
                </div>
            </div>
            <div class="featured-title-heading-wrap">
                <h1 class="feautured-title-heading">
                    Permohonan
                </h1>
            </div>
        </div><!-- /.featured-title-inner-wrap -->
    </div><!-- /#featured-title-inner -->            
</div>

<div class="row-tabs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="themesflat-spacer clearfix" data-desktop="30" data-mobile="60" data-smobile="60"></div>
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="themesflat-content-box clearfix" data-margin="0 18px 0 0" data-mobilemargin="0 0 0 0">
                    <div class="themesflat-headings style-1 clearfix">
                        <h2 class="heading">Permohonan</h2>
                        <div class="sep has-width w80 accent-bg margin-top-11 clearfix"></div>                                          
                    </div>
                    <div class="themesflat-spacer clearfix" data-desktop="38" data-mobile="35" data-smobile="35"></div>
                    <div class="themesflat-tabs style-1 clearfix">
                        <ul class="tab-title clearfix">
                            <li class="item-title active" style="background-color: #3ba151; color:white; border: 1px solid #f30e0e;">
                                <span class="inner">Alur</span>
                            </li>
                            <li class="item-title" style="background-color: #3b59a1; color:white; border: 1px solid #f30e0e;">
                                <span class="inner" >Formulir</span>
                            </li>
                        </ul>

                        <div class="tab-content-wrap clearfix">
                            <div class="tab-content">
                                <div class="item-content">    
                                    <img src="">                                                        
                                </div>
                            </div><!-- /.tab-content -->
                            <div class="tab-content">
                                <div class="item-content themesflat-contact-form style-2 clearfix">         
                                    <form role="form" id="form1">
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                        <input type="hidden" name="id" >
                                        <span class="wpcf7-form-control-wrap your-message form-group" style="margin-right: 2% !important;">
                                            NIK :
                                            <div class="input-group">
                                              <input type="text"  id="nik" name="nik"  class="wpcf7-form-control" placeholder="NIK*" required>
                                              <div class=" input-group-prepend">
                                                <button type="button" style="margin-bottom:15px !important;" onclick="cek_nik()" class="wpcf7-btn btn-success ">CEK NIK</button>
                                              </div>
                                            </div>
                                        </span>
                                        <span class="wpcf7-form-control-wrap your-message form-group">
                                            Nama :
                                            <input type="text" tabindex="1" id="name" name="name"  class="wpcf7-form-control" placeholder="Name*" required>
                                        </span>

                                                                                                 
                                        <span class="wpcf7-form-control-wrap your-email form-group">
                                            Email :
                                            <input type="email" tabindex="3" id="email" name="email"  class="wpcf7-form-control" placeholder="Your Email*" required>
                                        </span>
                                        <span class="wpcf7-form-control-wrap your-phone form-group">
                                            Telepon :
                                            <input type="text" tabindex="2" id="no_tlp" name="no_tlp"  class="wpcf7-form-control" placeholder="Phone" required>
                                        </span>
                                        <span class="wpcf7-form-control-wrap your-message form-group">
                                           Kelompok :
                                           <select name="kategori" class="wpcf7-form-control wpcf7-textarea" required >
                                            <option  selected="true" disabled="disabled" value=""> Pilih Kategori </option>
                                             <?php foreach ($kategori as $row) { ?>
                                               <option value="<?php echo $row->id_kategori_permohonan ?>">
                                                 <?php echo $row->nama_permohonan ?>
                                               </option>
                                             <?php } ?>
                                           </select>
                                           
                                        </span>
                                        <span class="input-ktp wpcf7-form-control-wrap your-email form-group">
                                            KTP : <br>
                                            <input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" tabindex="2" id="ktp" name="ktp"  class="wpcf7-form-control" placeholder="Phone"> (JPEG/PDF)
                                        </span> 
                                        <span class="input-kuasa wpcf7-form-control-wrap your-phone form-group">
                                            Surat Kuasa : <br>
                                            <input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" tabindex="2" id="kuasa" name="kuasa"  class="wpcf7-form-control" placeholder="Phone"> (JPEG/PDF)
                                        </span> 
                                        <span class="input-ktp_kuasa wpcf7-form-control-wrap your-email form-group">
                                            KTP Pemberi Kuasa : <br>
                                            <input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" tabindex="2" id="ktp_kuasa" name="ktp_kuasa"  class="wpcf7-form-control" placeholder="Phone"> (JPEG/PDF)
                                        </span> 
                                        <span class="input-keterangan wpcf7-form-control-wrap your-phone form-group">
                                            Surat keterangan : <br>
                                            <input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" tabindex="2" id="keterangan" name="keterangan"  class="wpcf7-form-control" placeholder="Phone"> (JPEG/PDF)
                                        </span>
                                        <span class="input-akta wpcf7-form-control-wrap your-email form-group">
                                            Surat Akta : <br>
                                            <input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" tabindex="2" id="akta" name="akta"  class="wpcf7-form-control" placeholder="Phone"> (JPEG/PDF)
                                        </span> 
                                        <span class="input-pengesahan wpcf7-form-control-wrap your-phone form-group">
                                            Surat pengesahan : <br>
                                            <input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" tabindex="2" id="pengesahan" name="pengesahan"  class="wpcf7-form-control" placeholder="Phone"> (JPEG/PDF)
                                        </span>
                                        <span>
                                        <div class="form-group preview-ktps" style="margin-top: 20px;">
                                          File KTP
                                          <br>
                                          <a href="" target="_blank"  id="preview-ktp"   style="display:none"><i class="fas fa-file-archive fa-3x"></i></a>
                                          <input type="hidden" value="" id="file_ktp" name="file_ktp">
                                        </div>
                                        <div class="form-group preview-kuasas" style="margin-top: 20px;">
                                          File kuasa
                                          <br>
                                          <a href="" target="_blank"  id="preview-kuasa"   style="display:none"><i class="fas fa-file-archive fa-3x"></i></a>
                                          <input type="hidden" value="" id="file_kuasa" name="file_kuasa">
                                        </div>
                                        <div class="form-group preview-ktp_kuasas" style="margin-top: 20px;">
                                          File KTP Kuasa
                                          <br>
                                          <a href="" target="_blank"  id="preview-ktp_kuasa"   style="display:none"><i class="fas fa-file-archive fa-3x"></i></a>
                                          <input type="hidden" value="" id="file_ktp_kuasa" name="file_ktp_kuasa">
                                        </div>
                                        <div class="form-group preview-keterangans" style="margin-top: 20px;">
                                          File Surat Keterangan
                                          <br>
                                          <a href="" target="_blank"  id="preview-keterangan"   style="display:none"><i class="fas fa-file-archive fa-3x"></i></a>
                                          <input type="hidden" value="" id="file_keterangan" name="file_keterangan">
                                        </div>
                                        <div class="form-group preview-aktas" style="margin-top: 20px;">
                                          File Dokumen Akta
                                          <br>
                                          <a href="" target="_blank"  id="preview-akta"   style="display:none"><i class="fas fa-file-archive fa-3x"></i></a>
                                          <input type="hidden" value="" id="file_akta" name="file_akta">
                                        </div>
                                        <div class="form-group preview-pengesahans" style="margin-top: 20px;">
                                          File Pengesahan
                                          <br>
                                          <a href="" target="_blank"  id="preview-pengesahan"   style="display:none"><i class="fas fa-file-archive fa-3x"></i></a>
                                          <input type="hidden" value="" id="file_pengesahan" name="file_pengesahan">
                                        </div>
                                        </span>
                                        <span class="wpcf7-form-control-wrap your-message form-group">
                                           Alamat :
                                           <textarea name="alamat" tabindex="5" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" placeholder="alamat*" required ></textarea>
                                        </span>
                                        <span class="wpcf7-form-control-wrap your-message form-group">
                                           Rincian Informasi Yang Dibutuhkan :
                                           <textarea name="rincian" tabindex="5" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" placeholder="Rincian*" required ></textarea>
                                        </span>  
                                        <span class="wpcf7-form-control-wrap your-message form-group">
                                           Tujuan Penggunaan Informasi :
                                           <textarea name="tujuan" tabindex="5" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" placeholder="Tujuan *" required ></textarea>
                                        </span>  
                                        <span class="wpcf7-form-control-wrap your-message form-group">
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
                                        <span class="wpcf7-form-control-wrap your-message form-group">
                                           Bentuk Informasi :
                                           <select name="bentuk_informasi" class="wpcf7-form-control wpcf7-textarea" required >
                                            <option  selected="true" disabled="disabled" > Pilih Bentuk Informasi </option>
                                            <?php foreach ($bentuk as $row) { ?>
                                               <option value="<?php echo $row->id_bentuk ?>">
                                                 <?php echo $row->bentuk_informasi ?>
                                               </option>
                                             <?php } ?> 
                                           </select>
                                        </span>                                                             
                                        <span class="wrap-submit">
                                            <input type="submit" value="SEND US" class="submit wpcf7-form-control wpcf7-submit" id="submit" name="submit">
                                        </span>
                                    </form>                                                   
                            </div>
                        </div><!-- /.tab-content -->

                    </div><!-- /.tab-content-wrap -->
                </div><!-- /.themesflat-tabs -->
            </div><!-- /.themesflat-content-box -->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="themesflat-spacer clearfix" data-desktop="61" data-mobile="60" data-smobile="60"></div>
        </div><!-- /.col-md-12 -->
    </div><!-- /.row -->
</div>
</div>