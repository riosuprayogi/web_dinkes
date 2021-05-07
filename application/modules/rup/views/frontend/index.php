<style>
	#ppid{
		background-image: url('<?= base_url('assets/img/banner/4.png') ?>') !important;
		background-size: cover!important ;
		background-position: center !important;
		background-repeat: no-repeat !important;
	}
</style>

<!-- <section class="cid-ppid mt-5" id="ppid" data-rv-view="1620" style="padding-top: 110px !important; padding-bottom: 110px !important; background: rgba(207, 207, 207, 0.33);" >
    <div class="container-fluid ">		
            <div class="media-container-row ">
                <div class="col-12 col-md-12">
                    <div class="media-container-row" >
                        <div class="mbr-figure rounded" style="padding:50px; background: rgba(255, 255, 255, 0); width: 40%;">
                            <div class="mbr-figure " style=" height:auto; opacity:1.0;">
                                <img src="<?php echo base_url();?>assets/img/banner/PPID LOGO.png" style="width:50%; margin:auto;" alt="" media-simple="true">
                                <p style="text-align: center; ">
                                <?php echo $profil['isi']; ?>
                                    Informasi merupakan kebutuhan pokok setiap orang. Bahkan lebih mendasar, hak memperoleh informasi adalah salah satu dari hak asasi manusia, hal ini tercantum dalam Undang-Undang Dasar Negara Republik Indonesia Tahun 1945 Pasal 28 F. Dalam pasal tersebut disebutkan bahwa setiap orang berhak untuk berkomunikasi dan memperoleh informasi untuk mengembangkan pribadi dan lingkungan sosialnya, serta berhak untuk mencari, memperoleh, memiliki, dan menyimpan informasi dengan menggunakan segala jenis saluran yang tersedia. 
                                </p>
                                <h1 class="align-center " style="font-size: 90px; padding:50px;">
                                    DASAR HUKUM
                                </h1>

                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </section> -->
    <img class="img-responsive" src="<?= base_url('assets/media/image/4-rup.png') ?>" alt="" style=" display: block;
    width:100%;
    height:100%;
    object-fit: cover;">
    <script>
        
        $(document).ready(function() {
            table = $('#table').DataTable({
              paginationType:'full_numbers',
              processing: true,
              serverSide: true,
              filter: false,
              autoWidth: false,
              bLengthChange: false,
              ajax: {
               url: '<?php echo site_url('dasar_hukum/ajax_list')?>',
               type: 'GET',
               header: {
            '<?= $this->security->get_csrf_token_name();?>': '<?php echo $this->security->get_csrf_hash(); ?>', //replace by your name/value
        },
        data: function (data) {
            data.filter = {
             'username':'',
         };
     }
 },
 language: {
   sProcessing: '<img src="<?php echo base_url('assets/img/process.gif')?>" width="20px"> Sedang memproses...',
   sLengthMenu: 'Tampilkan _MENU_ entri',
   sZeroRecords: 'Tidak ditemukan data yang sesuai',
   sInfo: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
   sInfoEmpty: 'Menampilkan 0 sampai 0 dari 0 entri',
   sInfoFiltered: '(disaring dari _MAX_ entri keseluruhan)',
   sInfoPostFix: '',
   sSearch: 'Cari:',
   sUrl: '',
   oPaginate: {
    sFirst: '<<',
    sPrevious: '<',
    sNext: '>',
    sLast: '>>'
}
},
order: [1, 'desc'],
columns: [
{'data':'no','orderable':false},
{'data':'id_dasar_hukum',"visible": false},
{'data':'judul'},
{'data':'file'},

]
});
        });
    </script>

    <section id="dasar_hukum" class="cid-struktur bg-white" style="padding-top: 50px; padding-bottom: 50px;" data-rv-view="1620">
     <div class="container align-center">
      <div class="media-container-row align-center">
       <div class="row justify-content-md-center" style="padding-top: 50px; padding-bottom: 50px;">
        <h3 class="mbr-section-title mbr-bold mbr-fonts-style">
         DASAR HUKUM
     </h3>
 </div>
</div>
<div class="card">
    <div class="card-body">
        <table id="table" class="table table-striped table-sm table-bordered">
            <thead>
                <tr class="info">
                    <th style="vertical-align: middle;" width="5%"><center><b>No</b></center></th>
                    <th>id</th>
                    <th style="vertical-align : middle !important;" width="24%"><center><b>Dasar Hukum</b></center></th>
                    <th style="vertical-align : middle !important;" width="15%">Lihat</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
</div>
</section>
