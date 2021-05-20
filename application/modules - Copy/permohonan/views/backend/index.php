<script type="text/javascript" src="<?php echo base_url()?>/assets/js/fileinput.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.3.1/css/fileinput.css">
<style>
.select2-selection--single {
	height: 100% !important;
}
.select2-selection__rendered{
	word-wrap: break-word !important;
	text-overflow: inherit !important;
	white-space: normal !important;
}
td {
     text-transform:uppercase
}

ul.timelines {
    list-style-type: none;
    position: relative;
}
ul.timelines:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 400;
}
ul.timelines > li {
    margin: 20px 0;
    padding-left: 20px;
}
.kv-upload-progress{
	display: none;
}
.fileinput-cancel-button{
	display: none;
}
.fileinput-upload{
	display: none;
}
ul.timelines > li:before {
    content: ' ';
    background: white;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 3px solid #22c0e8;
    left: 20px;
    width: 20px;
    height: 20px;
    z-index: 400;
}

</style>
<script>
var save_method; //for save method string
var table;
var table2;

$(document).ready(function() {

	$("#attach").fileinput({
		'showRemove': false,
		'showUpload': false,
		'showCancel':false
	});


  var pesan = "Silahkan Masukan";

  $('#form2').validate({
      rules: {
      	status_putusan: {
          required: true
        },

        pesan: {
          required: true,
          minlength: 5
        },

      },
      messages: {
        pesan: {
          required: pesan+" Alamat",
          minlength: "Your alamat must be at least 5 characters long"
        },
        status_putusan : pesan+" Email",
        
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
      send();
      }
    });

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
          required: pesan+" Tujuan",
          minlength: "Your alamat must be at least 5 characters long"
        },
  tujuan : pesan+" Email",
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
      },
      submitHandler: function (form) {
      save();
      }
    });
	
	table = $('#table').DataTable({
		paginationType:'full_numbers',
		processing: true,
		serverSide: true,
		filter: false,
		autoWidth: false,
		// ordering: false,
		ajax: {
			url: '<?php echo site_url('permohonan/ajax_list')?>',
			type: 'GET',
			crossDomain: true,
			header: {
            '<?= $this->security->get_csrf_token_name();?>': '<?php echo $this->security->get_csrf_hash(); ?>', //replace by your name/value
          	},
			data: function (data) {
				data.<?= $this->security->get_csrf_token_name();?>= '<?php echo $this->security->get_csrf_hash(); ?>';
				data.filter = {
					'no_permohonan':$('#filter_no_permohonan').val(),
					'nama':$('#filter_nama').val(),
					'kategori':$('#filter_kategori').val(),
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
			{'data':'id_permohonan',"visible": false},
			{'data':'no_permohonan','orderable':false},
			{'data':'nama_pemohon','orderable':false},
			{'data':'nama_permohonan','orderable':false},
			{'data':'email','orderable':false},
			{'data':'hari_masuk','orderable':false},
			{'data':'status_lengkap','orderable':false},
			{'data':'status_putusan','orderable':false},
			{'data':'selesai_perbaikan'},
			{'data':'aksi','orderable':false}
		]
	});


	$.ajax({ url : "<?php echo site_url('permohonan/ajax_filter')?>",
		type: "GET",
		dataType: "JSON",
		async: false,
		success: function(data){
			$('[name="filter_kategori"],[name="filter_cara_memperoleh"],[name="filter_bentuk_informasi"]').append('<option value="">--PILIH--</option>');
			for (var i = 0; i < data.kategori.length; i++) {
				$('[name="filter_kategori"]').append('<option value=' + data.kategori[i].id_kategori_permohonan + '>' + data.kategori[i].nama_permohonan + '</option>');
			}
			// for (var i = 0; i < data.cara_memperoleh.length; i++) {
			// 	$('[name="filter_cara_memperoleh"]').append('<option value=' + data.cara_memperoleh[i].id_memperoleh_informasi + '>' + data.cara_memperoleh[i].nama_informasi + '</option>');
			// }

			$('[name="filter_cara_memperoleh"]').append('<option value="lengkap">Lengkap</option>');
			$('[name="filter_cara_memperoleh"]').append('<option value="tidak lengkap">Tidak Lengkap</option>');
		},
		error: function (jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});

	$('[name="username"]').change(function(){
		$(this).parent().parent().removeClass('has-error');
		$(this).next().empty();
	});

	$('[name="nama"]').change(function(){
		$(this).parent().parent().removeClass('has-error');
		$(this).next().empty();
	});

	$('[name="app_id"]').change(function(){
		$(this).parent().removeClass('has-error');
		$(this).next().next().empty();
		if ($(this).val())
			$('#appname').val( $(this).find('option:selected').text() );
	});
	$('[name="access"]').change(function(){
		$(this).parent().removeClass('has-error');
		$(this).next().next().empty();
	});

	$('[name="nama_skpd"]').change(function(){
		$(this).parent().parent().removeClass('has-error');
		$(this).next().empty();
	});

	$("#filter_no_permohonan").keyup(function(event){
		if(event.keyCode == 13){
			reload_table();
		}
	});

	$("#filter_nama").keyup(function(event){
		if(event.keyCode == 13){
			reload_table();
		}
	});

	$("#filter_kategori").change(function(){
		reload_table();
	});


});

function reload_table(){
	table.ajax.reload(null,false);
}

function add(){
	save_method = 'add';
	$('#form1')[0].reset(); // reset form on modals
	$('#form2')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.col-md-12').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string

	//Ajax Load data from ajax
	$.ajax({ url : "<?php echo site_url('user/ajax_add/')?>",
		type: "GET",
		dataType: "JSON",
		async: false,
		success: function(data){
			$('[name="app_id"],[name="access"]').empty();
			$('[name="app_id"],[name="access"]').append('<option value="">--PILIH--</option>');
			for (var i = 0; i < data.aplikasi.length; i++) {
				$('[name="app_id"]').append('<option value=' + data.aplikasi[i].id_app + '>' + data.aplikasi[i].nama_app + '</option>');
			}

			$('[name="access"]').append('<option value="unor">Hanya SKPD</option>');
			$('[name="access"]').append('<option value="full">Semua SKPD</option>');

			$('[name="cek_username"]').show();
			$('#btnCekNip').show();

			table2.ajax.reload(null,false);

			$('#modal_form').modal('show'); // show bootstrap modal
			$('.modal-title').text('Tambah'); // Set Title to Bootstrap modal title
		},
		error: function (jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
}

function clear(){

	$('.preview-ktps').css('display','none');
	$('.preview-kuasas').css('display','none');
	$('.preview-ktp_kuasas').css('display','none');
	$('.preview-keterangans').css('display','none');
	$('.preview-aktas').css('display','none');
	$('.preview-pengesahans').css('display','none');
	$('.preview-ktpsx').css('display','none');
	$('.preview-kuasasx').css('display','none');
	$('.preview-ktp_kuasasx').css('display','none');
	$('.preview-keterangansx').css('display','none');
	$('.preview-aktasx').css('display','none');
	$('.preview-pengesahansx').css('display','none');
}

function edit(id){
	save_method = 'edit';
	$('#form1')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.col-md-12').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string

	//Ajax Load data from ajax
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
			

			// $('[name="kategori"]').change(function(){
			// 	var ids = $('[name="kategori"]').val();
			// 	$('.input-ktp').css('display','none');
			// 	$('.input-kuasa').css('display','none');
			// 	$('.input-ktp_kuasa').css('display','none');
			// 	$('.input-keterangan').css('display','none');
			// 	$('.input-akta').css('display','none');
			// 	$('.input-pengesahan').css('display','none');
			// 	if(ids == 1 ){
					
			// 		if(data.file_ktp == null){
			// 			$('.input-ktp').css('display','block');
			// 		}

			// 	}else if( ids == 2){
				
			// 		if(data.file_surat_kuasa == null){
			// 			$('.input-kuasa').css('display','block');
			// 		}
					

			// 	}else if( ids =='3'){
			// 		if(data.file_ktp == null){
			// 			$('.input-ktp').css('display','block');
			// 		}
			// 		if(data.file_surat_kuasa == null){
			// 			$('.input-kuasa').css('display','block');
			// 		}
			// 		if(data.file_ktp_kuasa == null){
			// 			$('.input-ktp_kuasa').css('display','block');
			// 		}

			// 	}else if( ids =='4'){
			// 		if(data.file_ktp == null){
			// 			$('.input-ktp').css('display','block');
			// 		}
			// 		if(data.file_surat_kuasa == null){
			// 			$('.input-kuasa').css('display','block');
			// 		}
			// 		if(data.file_ktp_kuasa == null){
			// 			$('.input-ktp_kuasa').css('display','block');
			// 		}

			// 		if(data.file_akta == null){
			// 			$('.input-akta').css('display','block');
			// 		}

			// 		if(data.file_pengesahan == null){
			// 			$('.input-pengesahan').css('display','block');
			// 		}
			// 	}else if( ids =='5'){
			// 		if(data.file_ktp == null){
			// 			$('.input-ktp').css('display','block');
			// 		}
			// 		if(data.file_surat_kuasa == null){
			// 			$('.input-kuasa').css('display','block');
			// 		}
			// 		if(data.file_ktp_kuasa == null){
			// 			$('.input-ktp_kuasa').css('display','block');
			// 		}

			// 		if(data.file_akta == null){
			// 			$('.input-akta').css('display','block');
			// 		}

			// 		if(data.file_surat_keterangan == null){
			// 			$('.input-keterangan').css('display','block');
			// 		}
			// 	}
			// });

		if(data.id_kategori_permohonan == 1){
			if(data.file_ktp == null){
				$('.input-ktp').css('display','block');
				$('#ktp').prop('required',true);
				// console.log('wowo');
			}else{
				$('.input-ktp').css('display','none');
				$('.preview-ktps').css('display','block');
				$('#preview-ktps').css('display','block');
				$('#preview-ktp').attr("href", data.file_ktp).show();
			}
        }else if(data.id_kategori_permohonan == 2){
          
		  if(data.file_ktp !== null){
            $('.input-ktp').css('display','none');
            $('.preview-ktps').css('display','block');
            $('#preview-ktps').css('display','block');
            $('#preview-ktp').attr("href", data.file_ktp).show();
          }else{
            $('.input-ktp').css('display','block');
            $('#ktp').prop('required',true);
          }

          if(data.file_surat_kuasa == null){
            $('.input-kuasa').css('display','block');
            $('#kuasa').prop('required',true);
          }else{
            $('.input-kuasa').css('display','none');
            $('.preview-kuasas').css('display','block');
            $('#preview-kuasas').css('display','block');
            $('#preview-kuasa').attr("href", data.file_surat_kuasa).show();
          }
          if(data.file_ktp_kuasa == null){
            $('.input-ktp_kuasa').css('display','block');
            $('#ktp_kuasa').prop('required',true);
          }else{
            $('.input-ktp_kuasa').css('display','none');
            $('.preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasa').attr("href", data.file_ktp_kuasa).show();
          }
        }else if(data.id_kategori_permohonan == 3){
          if(data.file_ktp == null){
            $('.input-ktp').css('display','block');
            $('#ktp').prop('required',true);
          }else{
            $('.input-ktp').css('display','none');
            $('.preview-ktps').css('display','block');
            $('#preview-ktps').css('display','block');
            $('#preview-ktp').attr("href", data.file_ktp).show();
          }
          if(data.file_surat_kuasa == null){
            $('.input-kuasa').css('display','block');
            $('#kuasa').prop('required',true);
          }else{
            $('.input-kuasa').css('display','none');
            $('.preview-kuasas').css('display','block');
            $('#preview-kuasas').css('display','block');
            $('#preview-kuasa').attr("href", data.file_surat_kuasa).show();
          }
          if(data.file_ktp_kuasa == null){
            $('.input-ktp_kuasa').css('display','block');
            $('#ktp_kuasa').prop('required',true);
          }else{
            $('.input-ktp_kuasa').css('display','none');
            $('.preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasa').attr("href", data.file_ktp_kuasa).show();
          }
        }else if(data.id_kategori_permohonan == 4){
          if(data.file_ktp == null){
            $('.input-ktp').css('display','block');
            $('#ktp').prop('required',true);
          }else{
            $('.input-ktp').css('display','none');
            $('.preview-ktps').css('display','block');
            $('#preview-ktps').css('display','block');
            $('#preview-ktp').attr("href", data.file_ktp).show();
          }
          if(data.file_surat_kuasa == null){
            $('.input-kuasa').css('display','block');
            $('#kuasa').prop('required',true);
          }else{
            $('.input-kuasa').css('display','none');
            $('.preview-kuasas').css('display','block');
            $('#preview-kuasas').css('display','block');
            $('#preview-kuasa').attr("href", data.file_surat_kuasa).show();
          }
          if(data.file_ktp_kuasa == null){
            $('.input-ktp_kuasa').css('display','block');
            $('#ktp_kuasa').prop('required',true);
          }else{
            $('.input-ktp_kuasa').css('display','none');
            $('.preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasa').attr("href", data.file_ktp_kuasa).show();
          }


          if(data.file_akta == null){
            $('.input-akta').css('display','block');
            $('#akta').prop('required',true);
          }else{
            $('.input-akta').css('display','none');
            $('.preview-aktas').css('display','block');
            $('#preview-aktas').css('display','block');
            $('#preview-akta').attr("href", data.file_akta).show();
          }

          if(data.file_pengesahan == null){
            $('.input-pengesahan').css('display','block');
            $('#pengesahan').prop('required',true);
          }else{
            $('.input-pengesahan').css('display','none');
            $('.preview-pengesahans').css('display','block');
            $('#preview-pengesahans').css('display','block');
            $('#preview-pengesahan').attr("href", data.file_pengesahan).show();
          }
        }else if(data.id_kategori_permohonan == 5){
          if(data.file_ktp == null){
            $('.input-ktp').css('display','block');
            $('#ktp').prop('required',true);
          }else{
            $('.input-ktp').css('display','none');
            $('.preview-ktps').css('display','block');
            $('#preview-ktps').css('display','block');
            $('#preview-ktp').attr("href", data.file_ktp).show();
          }
          if(data.file_surat_kuasa == null){
            $('.input-kuasa').css('display','block');
            $('#kuasa').prop('required',true);
          }else{
            $('.input-kuasa').css('display','none');
            $('.preview-kuasas').css('display','block');
            $('#preview-kuasas').css('display','block');
            $('#preview-kuasa').attr("href", data.file_surat_kuasa).show();
          }

          if(data.file_ktp_kuasa == null){
            $('.input-ktp_kuasa').css('display','block');
            $('#ktp_kuasa').prop('required',true);
          }else{
            $('.input-ktp_kuasa').css('display','none');
            $('.preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasas').css('display','block');
            $('#preview-ktp_kuasa').attr("href", data.file_ktp_kuasa).show();
          }
          

          if(data.file_akta == null){
            $('.input-akta').css('display','block');
            $('#akta').prop('required',true);
          }else{
            $('.input-akta').css('display','none');
            $('.preview-aktas').css('display','block');
            $('#preview-aktas').css('display','block');
            $('#preview-akta').attr("href", data.file_akta).show();
		  }
          if(data.file_surat_keterangan == null){
            $('.input-keterangan').css('display','block');
            $('#keterangan').prop('required',true);
          }else{
            $('.input-keterangan').css('display','none');
            $('.preview-keterangans').css('display','block');
            $('#preview-keterangans').css('display','block');
            $('#preview-keterangan').attr("href", data.file_surat_keterangan).show();
          }
		}
        

			$('[name="app_id"],[name="access"],[name="bentuk_informasi"],[name="kategori"],[name="cara_memperoleh"]').empty();
			$('[name="kategori"],[name="cara_memperoleh"],[name="bentuk_informasi"]').append('<option value="">--PILIH--</option>');
			for (var i = 0; i < data.kategori.length; i++) {
				$('[name="kategori"]').append('<option value=' + data.kategori[i].id_kategori_permohonan + '>' + data.kategori[i].nama_permohonan + '</option>');
			}
			for (var i = 0; i < data.cara_memperoleh.length; i++) {
				$('[name="cara_memperoleh"]').append('<option value=' + data.cara_memperoleh[i].id_memperoleh_informasi + '>' + data.cara_memperoleh[i].nama_informasi + '</option>');
			}
			for (var i = 0; i < data.bentuk.length; i++) {
				$('[name="bentuk_informasi"]').append('<option value=' + data.bentuk[i].id_bentuk + '>' + data.bentuk[i].bentuk_informasi + '</option>');
			}


			$('[name="id"]').val(data.id_permohonan);
			$('[name="username"],[name="oldusername"]').val(data.username);
			$('[name="nik"]').val(data.nik);
			$('[name="name"]').val(data.nama_pemohon);
			$('[name="email"]').val(data.email);
			$('[name="no_tlp"]').val(data.no_tlp);
			$('[name="alamat"]').val(data.alamat);
			$('[name="tujuan"]').val(data.tujuan);
			$('[name="rincian"]').val(data.rincian_informasi);
			$('[name="kategori"]').val(data.id_kategori_permohonan).trigger('change');
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

function detail(id){
	//Ajax Load data from ajax
	$.ajax({ url : "<?php echo site_url('permohonan/ajax_detail/')?>/" + id,
		type: "GET",
		dataType: "JSON",
		async: false,
		success: function(data){

			clear();
			if(data.id_kategori_permohonan == 1){
				if(data.file_ktp == null){
					$('.input-ktp').css('display','block');
				}else{
					$('.input-ktp').css('display','none');
					$('.preview-ktpsx').css('display','block');
					$('#preview-ktpsx').css('display','block');
					$('#preview-ktpx').attr("href", data.file_ktp).show();
				}

				
			}else if(data.id_kategori_permohonan == 2){
				if(data.file_ktp == null){
					$('.input-ktp').css('display','block');
				}else{
					$('.input-ktp').css('display','none');
					$('.preview-ktpsx').css('display','block');
					$('#preview-ktpsx').css('display','block');
					$('#preview-ktpx').attr("href", data.file_ktp).show();
				}
				if(data.file_surat_kuasa == null){
					$('.input-kuasa').css('display','block');
				}else{
					$('.input-kuasa').css('display','none');
					$('.preview-kuasasx').css('display','block');
					$('#preview-kuasasx').css('display','block');
					$('#preview-kuasax').attr("href", data.file_surat_kuasa).show();
				}
				if(data.file_ktp_kuasa == null){
					$('.input-ktp_kuasa').css('display','block');
				}else{
					$('.input-ktp_kuasa').css('display','none');
					$('.preview-ktp_kuasasx').css('display','block');
					$('#preview-ktp_kuasasx').css('display','block');
					$('#preview-ktp_kuasax').attr("href", data.file_ktp_kuasa).show();
				}
			}else if(data.id_kategori_permohonan == 3){
				if(data.file_ktp == null){
					$('.input-ktp').css('display','block');
				}else{
					$('.input-ktp').css('display','none');
					$('.preview-ktpsx').css('display','block');
					$('#preview-ktpsx').css('display','block');
					$('#preview-ktpx').attr("href", data.file_ktp).show();
				}
				if(data.file_surat_kuasa == null){
					$('.input-kuasa').css('display','block');
				}else{
					$('.input-kuasa').css('display','none');
					$('.preview-kuasasx').css('display','block');
					$('#preview-kuasasx').css('display','block');
					$('#preview-kuasax').attr("href", data.file_surat_kuasa).show();
				}
				if(data.file_ktp_kuasa == null){
					$('.input-ktp_kuasa').css('display','block');
				}else{
					$('.input-ktp_kuasa').css('display','none');
					$('.preview-ktp_kuasasx').css('display','block');
					$('#preview-ktp_kuasasx').css('display','block');
					$('#preview-ktp_kuasax').attr("href", data.file_ktp_kuasa).show();
				}
			}else if(data.id_kategori_permohonan == 4){
				if(data.file_ktp == null){
					$('.input-ktp').css('display','block');
				}else{
					$('.input-ktp').css('display','none');
					$('.preview-ktpsx').css('display','block');
					$('#preview-ktpsx').css('display','block');
					$('#preview-ktpx').attr("href", data.file_ktp).show();
				}
				if(data.file_surat_kuasa == null){
					$('.input-kuasa').css('display','block');
				}else{
					$('.input-kuasa').css('display','none');
					$('.preview-kuasasx').css('display','block');
					$('#preview-kuasasx').css('display','block');
					$('#preview-kuasax').attr("href", data.file_surat_kuasa).show();
				}
				if(data.file_ktp_kuasa == null){
					$('.input-ktp_kuasa').css('display','block');
				}else{
					$('.input-ktp_kuasa').css('display','none');
					$('.preview-ktp_kuasasx').css('display','block');
					$('#preview-ktp_kuasasx').css('display','block');
					$('#preview-ktp_kuasax').attr("href", data.file_ktp_kuasa).show();
				}


				if(data.file_akta == null){
					$('.input-akta').css('display','block');
				}else{
					$('.input-akta').css('display','none');
					$('.preview-aktasx').css('display','block');
					$('#preview-aktasx').css('display','block');
					$('#preview-aktax').attr("href", data.file_akta).show();
				}

				if(data.file_pengesahan == null){
					$('.input-pengesahan').css('display','block');
				}else{
					$('.input-pengesahan').css('display','none');
					$('.preview-pengesahansx').css('display','block');
					$('#preview-pengesahansx').css('display','block');
					$('#preview-pengesahanx').attr("href", data.file_pengesahan).show();
				}
			}else if(data.id_kategori_permohonan == 5){
				if(data.file_ktp == null){
					$('.input-ktp').css('display','block');
				}else{
					$('.input-ktp').css('display','none');
					$('.preview-ktpsx').css('display','block');
					$('#preview-ktpsx').css('display','block');
					$('#preview-ktpx').attr("href", data.file_ktp).show();
				}
				if(data.file_surat_kuasa == null){
					$('.input-kuasa').css('display','block');
				}else{
					$('.input-kuasa').css('display','none');
					$('.preview-kuasasx').css('display','block');
					$('#preview-kuasasx').css('display','block');
					$('#preview-kuasax').attr("href", data.file_surat_kuasa).show();
				}
				if(data.file_ktp_kuasa == null){
					$('.input-ktp_kuasa').css('display','block');
				}else{
					$('.input-ktp_kuasa').css('display','none');
					$('.preview-ktp_kuasasx').css('display','block');
					$('#preview-ktp_kuasasx').css('display','block');
					$('#preview-ktp_kuasax').attr("href", data.file_ktp_kuasa).show();
				}
				if(data.file_ktp_kuasa == null){
					$('.input-ktp_kuasa').css('display','block');
				}else{
					$('.input-ktp_kuasa').css('display','none');
					$('.preview-ktp_kuasasx').css('display','block');
					$('#preview-ktp_kuasasx').css('display','block');
					$('#preview-ktp_kuasax').attr("href", data.file_ktp_kuasa).show();
				}

				if(data.file_akta == null){
					$('.input-akta').css('display','block');
				}else{
					$('.input-akta').css('display','none');
					$('.preview-aktasx').css('display','block');
					$('#preview-aktasx').css('display','block');
					$('#preview-aktax').attr("href", data.file_akta).show();
				}

				if(data.file_pengesahan == null){
					$('.input-pengesahan').css('display','block');
				}else{
					$('.input-pengesahan').css('display','none');
					$('.preview-pengesahansx').css('display','block');
					$('#preview-pengesahansx').css('display','block');
					$('#preview-pengesahanx').attr("href", data.file_pengesahan).show();
				}
				if(data.file_surat_keterangan == null){
					$('.input-keterangan').css('display','block');
				}else{
					$('.input-keterangan').css('display','none');
					$('.preview-keterangansx').css('display','block');
					$('#preview-keterangansx').css('display','block');
					$('#preview-keteranganx').attr("href", data.file_surat_keterangan).show();
				}
			}



			$('.no_permohonan').html(data.no_permohonan);
			$('.kategori').html(data.nama_permohonan);
			$('.tgl_msk').html(data.cdd);
			$('.email').html(data.email);
			$('.alamat').html(data.alamat);
			$('.no_tlp').html(data.no_tlp);
			$('.tujuan').html(data.tujuan);
			$('.rincian').html(data.rincian_informasi);
			$('.nama_informasi').html(data.nama_informasi);
			$('.bentuk_informasi').html(data.informasi);
			$('.nama').html(data.nama_pemohon);
			$('.login').html(data.login + ' Kali');
			if(data.last_login){
				$('.last_login').html(data.last_login);
			}
			$('[name="file_ktp"').val(data.file_ktp);
			$('[name="file_kuasa"').val(data.file_surat_kuasa);
			$('[name="file_ktp_kuasa"').val(data.file_ktp_kuasa);
			$('[name="file_keterangan"').val(data.file_surat_keterangan);
			$('[name="file_akta"').val(data.file_akta);
			$('[name="file_pengesahan"').val(data.file_pengesahan);
			$('#modal_detail').modal('show'); // show bootstrap modal when complete loaded

			table3.ajax.reload(null,false);
		},
		error: function (jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
}

function putusan(id){
	$('#form2')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.col-md-12').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string

	//Ajax Load data from ajax
	$.ajax({ url : "<?php echo site_url('permohonan/ajax_edit/')?>/" + id,
		type: "GET",
		dataType: "JSON",
		async: false,
		success: function(data){
			$('[name="id"]').val(data.id_permohonan);
			$('[name="pesan"],[name="status_putusan"],[name="email"]').prop("disabled", false);
			$('#pesansesama').summernote('enable');
			$('#btnSavePutusan').prop('disabled', false);
			$('[name="status_putusan"],[name="email"]').empty();
			$('[name="status_putusan"],[name="email"]').append('<option value="">--PILIH--</option>');
			$('[name="status_putusan"]').append('<option value="gugur">Ditolak</option>');
			$('[name="status_putusan"]').append('<option value="perbaikan">Perbaikan</option>');
			$('[name="status_putusan"]').append('<option value="terima">Diterima</option>');

			$('[name="email"]').append('<option value="yes">Ya</option>');
			$('[name="email"]').append('<option value="no">Tidak</option>');
			
			if(data.status_putusan != 'belum'){
				$('[name="status_putusan"]').val(data.status_putusan);
			}
			$('[name="pesan"]').val(data.pesan_putusan);
			$("#pesansesama").summernote("code", data.pesan_putusan);


			if(data.status_putusan == 'terima' || data.status_putusan == 'gugur' ){
				$('[name="pesan"],[name="status_putusan"],[name="email"]').attr('disabled','disabled');
				$('#pesansesama').summernote('disable');
				$('#btnSavePutusan').prop('disabled', true);
			}

			$('#modal_putusan').modal('show'); // show bootstrap modal
			$('.modal-title').text('Putusan'); // Set Title to Bootstrap modal title
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
					text: "Berhasil Menyimpan Data!",
					icon: 'success',
					confirmButtonColor: '#3085d6',
					confirmButtonText: 'Ok'
				}).then((result) => {
					location.reload();
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

function history(id){
	$.ajax({ url : "<?php echo site_url('permohonan/ajax_histori/')?>/" + id,
		type: "GET",
		dataType: "JSON",
		async: false,
		success: function(data){
			$('[name="id"]').val(data.id_permohonan);
			$('.timelines').empty();
			for (var i = 0; i < data.histori.length; i++) {
				$('.timelines').append('<li><a target="_blank" style="pointer-events:none;" href="javascript:void(0)">' + data.histori[i].status_putusan + '</a><a href="#" class="float-right">' + data.histori[i].tanggal_proses+ '</a><p>'+data.histori[i].pesan+'</p></li>');
			}

			$('[name="status_putusan"]').val(data.status_putusan);
			$('[name="pesan"]').val(data.pesan_putusan);

			$('#modal_histori').modal('show'); // show bootstrap modal
			$('.modal-title').text('Putusan'); // Set Title to Bootstrap modal title
		},
		error: function (jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
}

function send(){
	var form = $('#form2')[0]; // You need to use standard javascript object here
	var formData = new FormData(form);
	$('#btnSave').text('Proses..'); //change button text
	$('#btnSave').attr('disabled',true); //set button disable
	var url;

	url = "<?php echo site_url('permohonan/ajax_putusan')?>";

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
					text: "Berhasil Menyimpan Data!",
					icon: 'success',
					confirmButtonColor: '#3085d6',
					confirmButtonText: 'Ok'
				}).then((result) => {
					location.reload();
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

function goBack() {
  window.history.back();
}

function del(id){
	swal({
			title:"",
			text:"Apakah yakin data ingin dihapus?",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: "Hapus",
			cancelButtonText: "Batal",
			closeOnConfirm: true,
		},
		function(){
			$.ajax({ url : "<?php echo site_url('user/ajax_delete')?>/"+id,
				type: "POST",
				dataType: "JSON",
				async: false,
				success: function(data){
					reload_table();
				},
				error: function (jqXHR, textStatus, errorThrown){
					alert('Error deleting data');
				}
			});
		}
	);
}

function del_cart(rowid){
	$.ajax({ url : "<?php echo site_url('user/ajax_delete_cart/');?>/"+rowid,
		type: "POST",
		dataType: "JSON",
		success: function(data){
			table2.ajax.reload(null,false);
		},
		error: function (jqXHR, textStatus, errorThrown){
			alert('Error deleting data');
		}
	});
}
</script>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manajemen Permohonan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>"">Home</a></li>
              <li class="breadcrumb-item active">Permohonan</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
<section class="content">
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table id="table" class="table table-bordered table-hover">
				<thead>
						<tr>
							<td></td>
							<!-- <td onclick="add()" style="vertical-align:middle; text-align:center;cursor:pointer;"><i class="glyphicon glyphicon-plus"></i></td> -->
							<td></td>
							<td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_no_permohonan" name="filter_no_permohonan" maxlength="100"></td>
							<td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_nama" name="filter_nama" maxlength="100"></td>
							<td><select id="filter_kategori" class="form-control input-sm" name="filter_kategori" style="width:100%"></select></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td onclick="reload_table()" style="vertical-align:middle; text-align:center;cursor:pointer;"><b><i class="glyphicon glyphicon-filter"></i></b></td>
						</tr>
						<tr class="info">
							<th class="align-middle" width="5%"><center><b>No</b></center></th>
							<th>id</th>
							<th class="align-middle" ><center><b>No Permohonan</b></center></th>
							<th class="align-middle"  width="100%" ><center><b>Nama</b></center></th>
							<th class="align-middle" ><center><b>Kategori</b></center></th>
							<th class="align-middle" ><center><b>Email</b></center></th>
							<th class="align-middle" ><center><b>Tanggal Masuk</b></center></th>
							<th class="align-middle" ><center><b>Status</b></center></th>
							<th class="align-middle" ><center><b>Status Putusan</b></center></th>
							<th class="align-middle" ><center><b>Status Perbaikan</b></center></th>
							<th class="align-middle" ><center><b>Aksi</b></center></th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</section>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"></h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form role="form" id="form1" >
				<div class="modal-body form">
					<div class="form-body">
						<div class="container-fluid">
									<div class="row">
										<div class="col-sm-6">
											<input type="hidden" value="" id="id" name="id">
											<input type="hidden" value="" name="oldusername">
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

											<div class="form-group">
											<label>NIK</label>	
											<input type="text"  id="nik" name="nik" value="" class="form-control" placeholder="NIK*" required>
											</div>
											
											<div class="form-group">
											<label>Nama</label>	
											<input type="text" tabindex="1" id="name" name="name" value="" class="form-control" placeholder="Name*" required>
											</div>
											
											<div class="form-group">
											<label>Email </label>	
											<input type="email" tabindex="3" id="email" name="email" value="" class="form-control" placeholder="Your Email*" required>
											</div>
											<div class="form-group">
												<label>Telepon</label>
												<input type="text" tabindex="2" id="no_tlp" name="no_tlp" value="" class="form-control" placeholder="Phone" required>
											</div>
											<div class="form-group">
											<label>Alamat</label>
												<textarea name="alamat" tabindex="5" cols="40" rows="10" class="form-control textarea" placeholder="alamat*" required ></textarea>
											</div>
											<div class="form-group">
											<label>Rinican Informasi</label>
												<textarea name="rincian" tabindex="5" cols="40" rows="10" class="form-control textarea" placeholder="Rincian*" required ></textarea>
											</div>
											<div class="form-group">
											<label>Tujuan</label>
												<textarea name="tujuan" tabindex="5" cols="40" rows="10" class="form-control textarea" placeholder="Tujuan *" required ></textarea>
											</div>
											
											
										
										<!-- adun close -->
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for=""> Bentuk Informasi</label>
												<select name="bentuk_informasi" class="form-control textarea" required >
												</select>
											</div>
											<div class="form-group">
											<label for=""> Cara Memperoleh</label>
											<select name="cara_memperoleh" class="form-control" required >
											</select>
											</div>
											<div class="form-group">
												<label for=""> Kategori Permohonan</label>
													<select name="kategori" class="form-control textarea" readonly >
													</select>
											</div>
											<div class="form-group input-ktp">
												<label for=""> KTP</label>
												<input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" tabindex="2" id="ktp" name="ktp" value="" class="form-control" placeholder="Phone"> (JPEG/PDF)
											</div>
											<div class="form-group preview-ktps" style="margin-top: 20px;">
												File KTP
												<br>
												<a href="" target="_blank"  id="preview-ktp"   style="display:none"><i class="fas fa-file-archive fa-3x"></i></a>
												<input type="hidden" value="" id="file_ktp" name="file_ktp">
											</div>
											<div class="form-group input-kuasa">
												<label for="">Surat Kuasa</label>
												<input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" tabindex="2" id="kuasa" name="kuasa" value="" class="form-control" placeholder="Phone"> (JPEG/PDF)
											</div>
											<div class="form-group preview-kuasas" style="margin-top: 20px;">
												File kuasa
												<br>
												<a href="" target="_blank"  id="preview-kuasa"   style="display:none"><i class="fas fa-file-archive fa-3x"></i></a>
												<input type="hidden" value="" id="file_kuasa" name="file_kuasa">
											</div>
											<div class="form-group input-ktp_kuasa">
												<label for="">KTP Pemberi Kuasa</label>
												<input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" tabindex="2" id="ktp_kuasa" name="ktp_kuasa" value="" class="form-control" placeholder="Phone"> (JPEG/PDF)
												
											</div>
											<div class="form-group preview-ktp_kuasas" style="margin-top: 20px;">
												File KTP Kuasa
												<br>
												<a href="" target="_blank"  id="preview-ktp_kuasa"   style="display:none"><i class="fas fa-file-archive fa-3x"></i></a>
												<input type="hidden" value="" id="file_ktp_kuasa" name="file_ktp_kuasa">
											</div>
											<div class="form-group input-keterangan">
												<label for=""> Surat Keterangan</label>
												<input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" tabindex="2" id="keterangan" name="keterangan" value="" class="form-control" placeholder="Phone"> (JPEG/PDF)
											</div>
											<div class="form-group preview-keterangans" style="margin-top: 20px;">
												File Surat Keterangan
												<br>
												<a href="" target="_blank"  id="preview-keterangan"   style="display:none"><i class="fas fa-file-archive fa-3x"></i></a>
												<input type="hidden" value="" id="file_keterangan" name="file_keterangan">
											</div>
											<div class="form-group input-akta">
												<label for=""> Dokumen Akta</label>
												<input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" tabindex="2" id="akta" name="akta" value="" class="form-control" placeholder="Phone"> (JPEG/PDF)
												
											</div>
											<div class="form-group preview-aktas" style="margin-top: 20px;">
												File Dokumen Akta
												<br>
												<a href="" target="_blank"  id="preview-akta"   style="display:none"><i class="fas fa-file-archive fa-3x"></i></a>
												<input type="hidden" value="" id="file_akta" name="file_akta">
											</div>
											<div class="form-group input-pengesahan">
												<label for=""> Surat Pengesahan</label>
												<input accept="image/jpeg,image/gif,image/png,application/pdf" type="file" tabindex="2" id="pengesahan" name="pengesahan" value="" class="form-control" placeholder="Phone"> (JPEG/PDF)
											</div>
											<div class="form-group preview-pengesahans" style="margin-top: 20px;">
												File Pengesahan
												<br>
												<a href="" target="_blank"  id="preview-pengesahan"   style="display:none"><i class="fas fa-file-archive fa-3x"></i></a>
												<input type="hidden" value="" id="file_pengesahan" name="file_pengesahan">
											</div>
										</div>
								
									</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="btnSave" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


<!-- Bootstrap modal -->
<div class="modal fade" id="modal_putusan" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"></h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form role="form" id="form2" >
				<div class="modal-body form">
					<div class="form-body">
						<div class="container-fluid">
									<input type="hidden" value="" id="id" name="id">
									<div class="form-group">
										<label for="luas_lahan">Status</label>
											<select name="status_putusan" id="status_putusan" class="form-control" >
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
										</select>
									</div>
									<!-- <div class="form-group">
										<label for="">Kirim Email</label>
											<select name="email" class="form-control"></select>
									</div> -->
									<div class="form-group">
									<label>Keterangan</label>
										<textarea name="pesan" id="pesansesama" tabindex="5" cols="40" rows="10" class="form-control textarea" placeholder="Keterangan*"></textarea>
									</div>
									<div class="form-group">
										<label for="">Attach</label>
										<input id="attach" accept="image/jpeg,image/gif,image/png,application/pdf"  name="attach" type="file" class="file" data-show-caption="true">
										<p style="color: black; font-style: italic; margin-top: 10px; margin-bottom: 10px; color: red;">
											<span style="color: red">*)</span> File yang diterima pdf <br>
											<span style="color: red">*)</span> Maksimal Ukuran File 5 MB
										</p>
									</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" id="btnSavePutusan" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<!-- Bootstrap modal -->
<div class="modal fade" id="modal_histori" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"></h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			
				<div class="modal-body form">
				<div class="row">
						<div class="col-md-12">
							<h4>Riwayat Putusan</h4>
							<ul class="timelines">
								
							</ul>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
				</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<!-- Bootstrap modal detail-->
<div class="modal fade" id="modal_detail" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3>Detail</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<strong>No Permohonan</strong>
						<p class="text-muted">
							<span class="no_permohonan"></span>
						</p>
						<hr>
						<strong>Nama Permohonan</strong>
						<p class="text-muted">
							<span class="nama"></span>
						</p>
						
						<hr>
						<strong>Email</strong>
						<p class="text-muted">
							<span class="email"></span>
						</p>
						<hr>
						<strong>Telepon</strong>
						<p class="text-muted">
							<span class="no_tlp"></span>
						</p>
						<hr>
						<strong>Tanggal Masuk</strong>
						<p class="text-muted">
							<span class="tgl_msk"></span>
						</p>
						<hr>
						<strong>Alamat</strong>
						<p class="text-muted">
							<span class="alamat"></span>
						</p>
						<hr>
						<strong>Rincian Informasi</strong>
						<p class="text-muted">
							<span class="rincian"></span>
						</p>
						<hr>
						<strong>Tujuan Informasi</strong>
						<p class="text-muted">
							<span class="tujuan"></span>
						</p>
						<hr>
						<strong>Cara Memperoleh Informasi</strong>
						<p class="text-muted">
							<span class="nama_informasi"></span>
						</p>
						<hr>
						<strong>Bentuk Informasi</strong>
						<p class="text-muted">
							<span class="bentuk_informasi"></span>
						</p>
					</div>
					<div class="col-md-6">
						<strong>Legal Standing</strong>
						<p class="text-muted">
							<span class="kategori"></span>
						</p>
						<hr>
						<div class="form-group preview-ktpsx" style="margin-top: 20px;">
							File KTP
							<br>
							<a href="" target="_blank"  id="preview-ktpx"   style="display:none"><i class="fas fa-file-archive fa-3x"></i></a>
							<!-- <input type="hidden" value="" id="file_ktp" name="file_ktp"> -->
						</div>
					
						<div class="form-group preview-kuasasx" style="margin-top: 20px;">
							File kuasa
							<br>
							<a href="" target="_blank"  id="preview-kuasax"   style="display:none"><i class="fas fa-file-archive fa-3x"></i></a>
							<!-- <input type="hidden" value="" id="file_kuasa" name="file_kuasa"> -->
						</div>
						
						<div class="form-group preview-ktp_kuasasx" style="margin-top: 20px;">
							File KTP Kuasa
							<br>
							<a href="" target="_blank"  id="preview-ktp_kuasax"   style="display:none"><i class="fas fa-file-archive fa-3x"></i></a>
							<!-- <input type="hidden" value="" id="file_ktp_kuasa" name="file_ktp_kuasa"> -->
						</div>
						
						<div class="form-group preview-keterangansx" style="margin-top: 20px;">
							File Surat Keterangan
							<br>
							<a href="" target="_blank"  id="preview-keteranganx"   style="display:none"><i class="fas fa-file-archive fa-3x"></i></a>
							<!-- <input type="hidden" value="" id="file_keterangan" name="file_keterangan"> -->
						</div>
						
						<div class="form-group preview-aktasx" style="margin-top: 20px;">
							File Dokumen Akta
							<br>
							<a href="" target="_blank"  id="preview-aktax"   style="display:none"><i class="fas fa-file-archive fa-3x"></i></a>
							<!-- <input type="hidden" value="" id="file_akta" name="file_akta"> -->
						</div>
						
						<div class="form-group preview-pengesahansx" style="margin-top: 20px;">
							File Pengesahan
							<br>
							<a href="" target="_blank"  id="preview-pengesahanx"   style="display:none"><i class="fas fa-file-archive fa-3x"></i></a>
							<!-- <input type="hidden" value="" id="file_pengesahan" name="file_pengesahan"> -->
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>
<script>
	$(function () {
    // Summernote
		$('#pesansesama').summernote({
				toolbar: [
					// [groupName, [list of button]]
					['style', ['bold', 'italic', 'underline', 'clear']],
					['font', ['strikethrough', 'superscript', 'subscript']],
					['fontsize', ['fontsize']],
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']],
					['height', ['height']]
				],
        placeholder: 'Pesan',
        tabsize: 2,
        height: 300,
        callbacks: {
                    onImageUpload: function(image) {
                        uploadImage(image[0]);
                    },
                    onMediaDelete : function(target) {
                        deleteImage(target[0].src);
                    }
                }
      });

      function uploadImage(image) {
        var data = new FormData();
        data.append("image", image);
        $.ajax({
            url: "<?php echo site_url('profil/upload_image_summernote')?>",
            cache: false,
            contentType: false,
            processData: false,
            data: data,
            type: "POST",
            success: function(url) {
                $('.textarea').summernote("insertImage", url);
            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function deleteImage(src) {
        $.ajax({
            data: {src : src},
            type: "POST",
            url: "<?php echo site_url('profil/delete_image_summernote')?>",
            cache: false,
            success: function(response) {
                console.log(response);
            }
        });
    }
  })
</script>