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
              text: "Permohonan Keberatan Anda akan diproses",
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
                        <span class="trail-end">Keberatan</span>
                    </div>
                </div>
            </div>
            <div class="featured-title-heading-wrap">
                <h1 class="feautured-title-heading">
                    Keberatan
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
                        <h2 class="heading">Keberatan</h2>
                        <div class="sep has-width w80 accent-bg margin-top-11 clearfix"></div>                                          
                    </div>
                    <div class="themesflat-spacer clearfix" data-desktop="38" data-mobile="35" data-smobile="35"></div>
                    <div class="themesflat-tabs style-1 clearfix">
                        <ul class="tab-title clearfix">
                            <li class="item-title active">
                                <span class="inner">Alur</span>
                            </li>
                            <li class="item-title">
                                <span class="inner">Formulir</span>
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
                                        <input type="hidden" name="id_permohonan" value="<?= $permohonan->id_permohonan?>">
                                        <span class="wpcf7-form-control-wrap your-message form-group" style="margin-right: 2% !important;">
                                            No Permohonan :
                                            <input type="text" readonly="readonly" id="no_permohonan" name="no_permohonan" value="<?= $permohonan->no_permohonan?>" class="wpcf7-form-control" placeholder="No Permohonan*">
                                        </span>
                                        <!-- <span class="wpcf7-form-control-wrap your-name form-group">
                                            Nama :
                                            <input type="text" tabindex="1" id="name" name="name" value="" class="wpcf7-form-control" placeholder="Name*" required>
                                        </span> -->
                                        <span class="wpcf7-form-control-wrap your-message form-group">
                                           Rincian Informasi Yang Dibutuhkan :
                                           <textarea name="rincian" tabindex="5" readonly="readonly" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" placeholder="Rincian*" ><?= $permohonan->rincian_informasi?></textarea>
                                        </span>  
                                        <span class="wpcf7-form-control-wrap your-message form-group">
                                           Tujuan Penggunaan Informasi :
                                           <textarea name="tujuan" tabindex="5" readonly="readonly" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" placeholder="Tujuan *" ><?= $permohonan->tujuan?></textarea>
                                        </span> 
                                        <span class="wpcf7-form-control-wrap your-message form-group" style="text-decoration: underline !important;">
                                            IDENTITAS PEMOHON
                                        </span>                                              
                                        <span class="wpcf7-form-control-wrap your-email form-group">
                                            Nama :
                                            <input type="text" tabindex="3" id="nama_pemohon" name="nama_pemohon" value="<?= $permohonan->nama_pemohon?>" class="wpcf7-form-control" placeholder="Nama*" required>
                                        </span>
                                        <span class="wpcf7-form-control-wrap your-phone form-group">
                                            Alamat :
                                            <input type="text" tabindex="2" id="alamat_pemohon" name="alamat_pemohon" value="<?= $permohonan->alamat?>" class="wpcf7-form-control" placeholder="Alamat" required>
                                        </span>
                                        <span class="wpcf7-form-control-wrap your-email form-group">
                                            Pekerjaan :
                                            <input type="text" tabindex="3" id="pekerjaan_pemohon" name="pekerjaan_pemohon" value="" class="wpcf7-form-control" placeholder="Pekerjaan*" required>
                                        </span>
                                        <span class="wpcf7-form-control-wrap your-phone form-group">
                                            No Telepon :
                                            <input type="text" tabindex="2" id="telepon_pemohon" name="telepon_pemohon" value="<?= $permohonan->no_tlp?>" class="wpcf7-form-control" placeholder="Telepon Pemohon" required>
                                        </span>
                                        <span class="wpcf7-form-control-wrap your-message form-group" style="text-decoration: underline !important;">
                                            IDENTITAS KUASA PEMOHON
                                        </span>                                              
                                        <span class="wpcf7-form-control-wrap your-email form-group">
                                            Nama :
                                            <input type="text" tabindex="3" id="nama_kuasa_pemohon" name="nama_kuasa_pemohon" value="" class="wpcf7-form-control" placeholder="Nama" required>
                                        </span>
                                        <span class="wpcf7-form-control-wrap your-phone form-group">
                                            Alamat :
                                           <textarea name="alamat_kuasa" tabindex="5" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" placeholder="alamat*" required ></textarea>
                                            
                                        </span>
                                        <span class="wpcf7-form-control-wrap your-phone form-group">
                                            No Telepon :
                                            <input type="text" tabindex="2" id="telepon_kuasa_pemohon" name="telepon_kuasa_pemohon" value="" class="wpcf7-form-control" placeholder="Telepon Pemohon" required>
                                        </span>
                                        <span class="wpcf7-form-control-wrap your-message form-group">
                                           Alasan Pengajuan Keberatan :
                                           <select name="alasan" id="alasan" required>
                                           <option  selected="true" disabled="disabled" value=""> Pilih Pengajuan Keberatan </option>
                                             <?php foreach ($alasan as $row) { ?>
                                               <option value="<?php echo $row->id_alasan ?>">
                                                 <?php echo $row->alasan ?>
                                               </option>
                                             <?php } ?>
                                            </select>
                                        </span> 
                                        <span class="wpcf7-form-control-wrap your-message form-group">
                                        Kasus Posisi :
                                            <textarea name="kasus" tabindex="5" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea" placeholder="Kasus Posisi*" required ></textarea>
                                        </span>
                                        <span class="wpcf7-form-control-wrap your-message form-group">
                                        HARI / TANGGAL TANGGAPAN ATAS KEBERATAN AKAN DIBERIKAN : <?php  $tanggal = date('Y-m-d', strtotime(' + '.$tanggapan->hari.' day'));  echo indonesian_date_2($tanggal);?>  
                                        <input type="hidden" name="tanggal_tanggapan" value="<?= $tanggal?>">        
                                        </span>                                                            
                                        <span class="wrap-submit">
                                            <input type="submit" value="KIRIM" class="submit wpcf7-form-control wpcf7-submit" id="submit" name="submit">
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

