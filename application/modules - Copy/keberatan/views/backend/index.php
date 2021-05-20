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

.kv-upload-progress{
	display: none;
}
.fileinput-cancel-button{
	display: none;
}
.fileinput-upload{
	display: none;
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

  $('#form3').validate({
      rules: {
		no_keberatan:{
			required: true
		},
		tgl_tanggapan:{
			required: true
		},
      },
      messages: {
        no_keberatan : pesan+" No Keberatan",
        tgl_tanggapan : pesan+" Tanggal Tanggapan Keberatan ",
        
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
      send_no();
      }
    });

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
		ajax: {
			url: '<?php echo site_url('keberatan/ajax_list')?>',
			type: 'GET',
			header: {
            '<?= $this->security->get_csrf_token_name();?>': '<?php echo $this->security->get_csrf_hash(); ?>', //replace by your name/value
          	},
			data: function (data) {
				data.<?php echo $this->security->get_csrf_token_name();?> = '<?php echo $this->security->get_csrf_hash(); ?>';
				data.filter = {
					'username':$('#filter_no_permohonan').val(),
					'nama':$('#filter_nama').val(),
					'skpd':$('#filter_kategori').val(),
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
			{'data':'id_keberatan',"visible": false},
			{'data':'no_keberatan'},
			{'data':'no_permohonan'},
			{'data':'nama_pemohon'},
			{'data':'hari_masuk','orderable':false},
			{'data':'batas_tanggapan','orderable':false},
			{'data':'status_putusan','orderable':false},
			{'data':'aksi','orderable':false}
		]
	});


	// $.ajax({ url : "<?php echo site_url('keberatan/ajax_filter')?>",
	// 	type: "GET",
	// 	dataType: "JSON",
	// 	async: false,
	// 	success: function(data){
	// 		$('[name="filter_kategori"],[name="filter_cara_memperoleh"],[name="filter_bentuk_informasi"]').append('<option value="">--PILIH--</option>');
	// 		for (var i = 0; i < data.kategori.length; i++) {
	// 			$('[name="filter_kategori"]').append('<option value=' + data.kategori[i].id_kategori_permohonan + '>' + data.kategori[i].nama_permohonan + '</option>');
	// 		}
	// 		// for (var i = 0; i < data.cara_memperoleh.length; i++) {
	// 		// 	$('[name="filter_cara_memperoleh"]').append('<option value=' + data.cara_memperoleh[i].id_memperoleh_informasi + '>' + data.cara_memperoleh[i].nama_informasi + '</option>');
	// 		// }

	// 		$('[name="filter_cara_memperoleh"]').append('<option value="lengkap">Lengkap</option>');
	// 		$('[name="filter_cara_memperoleh"]').append('<option value="tidak lengkap">Tidak Lengkap</option>');
	// 	},
	// 	error: function (jqXHR, textStatus, errorThrown){
	// 		alert('Error get data from ajax');
	// 	}
	// });

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




function clear(){

	$('.preview-ktps').css('display','none');
	$('.preview-kuasas').css('display','none');
	$('.preview-ktp_kuasas').css('display','none');
	$('.preview-keterangans').css('display','none');
	$('.preview-aktas').css('display','none');
	$('.preview-pengesahans').css('display','none');
}

function edit(id){
	save_method = 'edit';
	$('#form1')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.col-md-12').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string

	//Ajax Load data from ajax
	$.ajax({ url : "<?php echo site_url('keberatan/ajax_edit/')?>/" + id,
		type: "GET",
		dataType: "JSON",
		async: false,
		success: function(data){

			
			$('[name="app_id"],[name="access"],[name="bentuk_informasi"],[name="alasan"],[name="cara_memperoleh"]').empty();
			$('[name="alasan"],[name="cara_memperoleh"],[name="bentuk_informasi"]').append('<option value="">--PILIH--</option>');
			for (var i = 0; i < data.alasan.length; i++) {
				$('[name="alasan"]').append('<option value=' + data.alasan[i].id_alasan + '>' + data.alasan[i].alasan + '</option>');
			}
			

			$('[name="bentuk_informasi"]').append('<option value="email">Email</option>');
			$('[name="bentuk_informasi"]').append('<option value="langsung">Langsung</option>');

			$('[name="id"]').val(data.id_keberatan);
			$('[name="username"],[name="oldusername"]').val(data.username);
			$('[name="no_permohonan"]').val(data.no_permohonan);
			$('[name="rincian"]').val(data.rincian_informasi);
			$('[name="tujuan"]').val(data.tujuan);
			$('[name="nama_pemohon"]').val(data.nama_pemohon);
			$('[name="alamat_pemohon"]').val(data.alamat_pemohon);
			$('[name="pekerjaan_pemohon"]').val(data.pekerjaan_pemohon);
			$('[name="telepon_pemohon"]').val(data.no_tlp_pemohon);
			$('[name="nama_kuasa_pemohon"]').val(data.nama_kuasa);
			$('[name="alamat_kuasa"]').val(data.alamat_kuasa);
			$('[name="telepon_kuasa_pemohon"]').val(data.no_tlp_kuasa);
			$('[name="kasus"]').val(data.kasus);
			$('[name="alasan"]').val(data.id_alasan);

			$('#tanggal').html(data.tanggal_tanggapan);
	
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

function edits(id){
	save_method = 'edit';
	$('#form3')[0].reset(); // reset form on modals
	$('.form-group').removeClass('has-error'); // clear error class
	$('.col-md-12').removeClass('has-error'); // clear error class
	$('.help-block').empty(); // clear error string

	//Ajax Load data from ajax
	$.ajax({ url : "<?php echo site_url('keberatan/ajax_edit/')?>/" + id,
		type: "GET",
		dataType: "JSON",
		async: false,
		success: function(data){

			$('[name="ids"]').val(data.id_keberatan);
			$('[name="no_keberatans"]').val(data.no_keberatan);
			$('[name="tgl_tanggapan"]').val(data.tanggal_tanggapan);



			$('#modal_notgl').modal('show'); // show bootstrap modal when complete loaded
			$('.modal-title').text('No Keberatan dan Tanggal Tanggapan'); // Set title to Bootstrap modal title
		},
		error: function (jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
		}
	});
}

function detail(id){
	//Ajax Load data from ajax
	$.ajax({ url : "<?php echo site_url('keberatan/ajax_detail/')?>/" + id,
		type: "GET",
		dataType: "JSON",
		async: false,
		success: function(data){

			$('.no_keberatan').html(data.no_keberatan);
			$('.no_permohonan').html(data.no_permohonan);
			$('.rincian').html(data.rincian_informasi);
			$('.tujuan').html(data.tujuan);
			$('.nama').html(data.nama_pemohon);
			$('.alamat').html(data.alamat_pemohon);
			$('.no_tlp_pemohon').html(data.no_tlp_pemohon);
			$('.pekerjaan').html(data.pekerjaan_pemohon);
			$('.tgl_masuk').html(data.cdd);
			$('.alamat').html(data.alamat);
			$('.nama_kuasa').html(data.nama_kuasa);
			$('.alamat_kuasa').html(data.alamat_kuasa);
			$('.no_tlp_kuasa').html(data.no_tlp_kuasa);
			$('.alasan').html(data.alasan);
			$('.kasus').html(data.kasus);
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
	$.ajax({ url : "<?php echo site_url('keberatan/ajax_edit/')?>/" + id,
		type: "GET",
		dataType: "JSON",
		async: false,
		success: function(data){
			$('[name="id"]').val(data.id_keberatan);
			$('[name="pesan"],[name="status_putusan"],[name="email"]').prop("disabled", false);
				$('#btnSavePutusan').prop('disabled', false);
			$('[name="status_putusan"],[name="email"]').empty();
			$('[name="status_putusan"],[name="email"]').append('<option value="">--PILIH--</option>');
			$('[name="status_putusan"]').append('<option value="tolak">Ditolak</option>');
			$('[name="status_putusan"]').append('<option value="terima">Diterima</option>');

			$('[name="email"]').append('<option value="yes">Ya</option>');
			$('[name="email"]').append('<option value="no">Tidak</option>');
			$('[name="status_putusan"]').val(data.status_putusan);
			$('[name="pesan"]').val(data.pesan_putusan);


			if(data.status_putusan == 'terima' || data.status_putusan == 'tolak' ){
				$('[name="pesan"],[name="status_putusan"],[name="email"]').attr('disabled','disabled');
				$('#btnSavePutusan').prop('disabled', true);
			}

			$('#modal_putusan').modal('show'); // show bootstrap modal
			$('.modal-title').text('Putusan'); // Set Title to Bootstrap modal title
		},
		error: function (jqXHR, textStatus, errorThrown){
			alert('Error get data from ajax');
			location.reload();
		}
	});
}


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
	$.ajax({ url : "<?php echo site_url('keberatan/ajax_histori/')?>/" + id,
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

	url = "<?php echo site_url('keberatan/ajax_putusan')?>";
    Swal.fire({
      title: '',
      text: "Apa Anda Yakin Menyimpan Data Ini?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Tidak'
    }).then((result) => {
		if (result.value) {
			// ajax adding data to putusan
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
	});
}

function send_no(){
	var form = $('#form3')[0]; // You need to use standard javascript object here
	var formData = new FormData(form);
	$('#btnSave').text('Proses..'); //change button text
	$('#btnSave').attr('disabled',true); //set button disable
	var url;

	url = "<?php echo site_url('keberatan/ajax_no_tgl')?>";

	// ajax adding data to putusan
	Swal.fire({
		title: 'Apa Anda Yakin?',
		text: "Apa Anda Yakin Menyimpan Data?",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Ya',
		cancelButtonText: 'Tidak'
	}).then((result) => {
		if (result.value) {
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
            <h1 class="m-0 text-dark">Manajemen Keberatan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>"">Home</a></li>
              <li class="breadcrumb-item active">Keberatan</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
<section class="content">
	<div class="card">
		<div class="card-body">
			<table id="table" class="table table-striped table-sm table-bordered">
				<thead>
					<tr>
						<td></td>
						<td></td>
						<!-- <td onclick="add()" style="vertical-align:middle; text-align:center;cursor:pointer;"><i class="glyphicon glyphicon-plus"></i></td> -->
						<td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_no_keberatan" name="filter_no_keberatan" maxlength="100"></td>
						<td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_no_permohonan" name="filter_no_permohonan" maxlength="100"></td>
						<!-- <td><input style="width:100%;" class="form-control input-sm" type="text" id="filter_nama" name="filter_nama" maxlength="100"></td> -->
						<!-- <td><select id="filter_kategori" class="form-control input-sm" name="filter_kategori" style="width:100%"></select></td> -->
						<td></td>
						<td></td>
						<!-- <td><select id="filter_cara_memperoleh" class="form-control input-sm" name="filter_cara_memperoleh" style="width:100%"></select></td> -->
						<td></td>
						<td></td>
						<td onclick="reload_table()" style="vertical-align:middle; text-align:center;cursor:pointer;"><b><i class="fas fa-filter"></i></b></td>
					</tr>
					<tr class="info">
						<th style="vertical-align: middle;" width="5%"><center><b>No</b></center></th>
						<th>id</th>
						<th style="vertical-align : middle !important;" width="24%"><center><b>No Keberatan</b></center></th>
						<th style="vertical-align : middle !important;" width="24%"><center><b>No Permohonan</b></center></th>
						<th style="vertical-align : middle !important;" width="23%"><center><b>Nama</b></center></th>
						<!-- <th style="vertical-align : middle !important;" width="28%"><center><b>Kategori</b></center></th> -->
						<th style="vertical-align : middle !important;" width="28%"><center><b>Hari Masuk</b></center></th>
						<th style="vertical-align : middle !important;" width="28%"><center><b>Batas Tanggapan</b></center></th>
						<!-- <th style="vertical-align : middle !important;" width="28%"><center><b>Status</b></center></th> -->
						<th style="vertical-align : middle !important;" width="40%"><center><b>Status Putusuan</b></center></th>
						<th style="vertical-align : middle !important;" width="10%"><center><b>Aksi</b></center></th>
					</tr>
				</thead>
			</table>
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
										<div class="col-md-12">
											<!-- <input type="hidden" value="" id="id" name="id"> -->
											<input type="hidden" value="" name="oldusername">
											<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
											<div class="form-group">
												<label for="">Keputusan Tanggapan Keberatan : <span id="tanggal"></span></label>
											</div>
											<div class="form-group">
												<label for="">No Permohonan :</label>
											<input type="text" readonly="readonly" id="no_permohonan" name="no_permohonan"
												value="" class="form-control" placeholder="No Permohonan*">
											</div>
											<div class="form-group">
												<label for="">Rincian Informasi Yang Dibutuhkan :</label>
											<textarea name="rincian" tabindex="5" readonly="readonly" cols="40" rows="10"
												class="form-control textarea" placeholder="Rincian*"></textarea>
											</div>
											<div class="form-group">
												<label for="">Tujuan Penggunaan Informasi :</label>
											<textarea name="tujuan" tabindex="5" readonly="readonly" cols="40" rows="10"
												class="form-control textarea" placeholder="Tujuan *"></textarea>
											</div>
											<div class="form-group">
												<label for="" >IDENTITAS PEMOHON</label>
												<hr>
											</div>
											<div class="form-group">
												<label for="">Nama :</label>
											<input type="text" tabindex="3" id="nama_pemohon" name="nama_pemohon" value=""
												class="form-control" placeholder="Nama*" required>
											</div>
											<div class="form-group">
												<label for="">Alamat :</label>
											<input type="text" tabindex="2" id="alamat_pemohon" name="alamat_pemohon" value=""
												class="form-control" placeholder="Alamat" required>
											</div>
											<div class="form-group">
												<label for="">Pekerjaan :</label>
											<input type="text" tabindex="3" id="pekerjaan_pemohon" name="pekerjaan_pemohon" value=""
												class="form-control" placeholder="Pekerjaan*" required>
											</div>
											<div class="form-group">
												<label for="">No Telepon :</label>
											<input type="text" tabindex="2" id="telepon_pemohon" name="telepon_pemohon" value=""
												class="form-control" placeholder="Telepon Pemohon" required>
											</div>
											<div class="form-group">
												<label for="">IDENTITAS KUASA PEMOHON</label>
												<hr>
											</div>
											<div class="form-group">
												<label for="">Nama :</label>
											<input type="text" tabindex="3" id="nama_kuasa_pemohon" name="nama_kuasa_pemohon" value=""
												class="form-control" placeholder="Nama" required>
											</div>
											<div class="form-group">
												<label for="">Alamat :</label>
											<textarea name="alamat_kuasa" tabindex="5" cols="40" rows="10" class="form-control textarea"
												placeholder="alamat*" required></textarea>
											</div>
											<div class="form-group">
												<label for="">No Telepon :</label>
											<input type="text" tabindex="2" id="telepon_kuasa_pemohon" name="telepon_kuasa_pemohon" value=""
												class="form-control" placeholder="Telepon Pemohon" required>
											</div>
											<div class="form-group">
												<label for="">Kasus Posisi :</label>
											<textarea name="kasus" tabindex="5" cols="40" rows="10" class="form-control textarea"
												placeholder="Kasus Posisi*" required></textarea>
											</div>
											<div class="form-group">
												<label for="">Alasan Keberatan</label>
											<select name="alasan" id="alasan" class="form-control" required>
											</select>
											</div>
										
										<!-- adun close -->
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
										<textarea name="pesan" tabindex="5" cols="40" rows="10" class="form-control textarea" placeholder="Keterangan*"></textarea>
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

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_notgl" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title"></h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<form role="form" id="form3" >
				<div class="modal-body">
					<div class="form-group">
						<label for="">No Keberatan</label>
						<input type="hidden" name="ids">
						<input type="text" name="no_keberatans" class="form-control"></input>
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
					</div>
					<div class="form-group">
						<label for="">Tanggal Tanggapan Keberatan</label>
						<input id="tgl_tanggapan" name="tgl_tanggapan" class="form-control"></input>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="submit" id="btnSaveNoTgl" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
				</div>
			</form>
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
						
						<strong>No Keberatan</strong>
						<p class="text-muted">
							<span class="no_keberatan"></span>
						</p>
						<hr>
						<strong>No Permohonan</strong>
						<p class="text-muted">
							<span class="no_permohonan"></span>
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
						<strong>Nama Pemohon</strong>
						<p class="text-muted">
							<span class="nama"></span>
						</p>
						<hr>
						<strong>Alamat Pemohon</strong>
						<p class="text-muted">
							<span class="alamat"></span>
						</p>
						<hr>
						<strong>No Telepon Pemohon</strong>
						<p class="text-muted">
							<span class="no_tlp_pemohon"></span>
						</p>
						<hr>
						<strong>Pekerjaan Pemohon</strong>
						<p class="text-muted">
							<span class="pekerjaan"></span>
						</p>
						<hr>
						<strong>Alamat</strong>
						<p class="text-muted">
							<span class="alamat"></span>
						</p>
						
				</div>
				<div class="col-md-6">
						<strong>Nama Pemberi Kuasa</strong>
						<p class="text-muted">
							<span class="nama_kuasa"></span>
						</p>
						<hr>
						<strong>Alamat Pemberi Kuasa</strong>
						<p class="text-muted">
							<span class="alamat_kuasa"></span>
						</p>
						<hr>
						<strong>No Telepon Pemberi Kuasa</strong>
						<p class="text-muted">
							<span class="no_tlp_kuasa"></span>
						</p>
						<hr>
						<strong>Alasan</strong>
						<p class="text-muted">
							<span class="alasan"></span>
						</p>
						<hr>
						<strong>Kasus Posisi</strong>
						<p class="text-muted">
							<span class="kasus"></span>
						</p>
						<hr>
						<strong>Tanggal Masuk</strong>
						<p class="text-muted">
							<span class="tgl_masuk"></span>
						</p>
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
		$('#tgl_tanggapan').datetimepicker({
			format: 'LT',
			format: 'YYYY-MM-DD'
		});
	});
</script>