<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css'); ?>">
<link rel="stylesheet" href="<?php echo base_url('assets/') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<style>
	.select2-selection--single {
		height: 100% !important;
	}

	.select2-selection__rendered {
		word-wrap: break-word !important;
		text-overflow: inherit !important;
		white-space: normal !important;
	}
</style>
<script>
	var save_method; //for save method string
	var table;
	var table2;

	$(document).ready(function() {


		$('[name="luas_psu_diserahkan"]').change(function() {
			var luas_psu = parseInt($('[name="luas_psu"]').val());
			var luas_diserahkan = parseInt($('[name="luas_psu_diserahkan"]').val());
			var total = luas_psu + luas_diserahkan;
			$('[name="sisa"]').val(total);
		});

		$('[name="username"]').change(function() {
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});

		$('[name="nama"]').change(function() {
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});

		$('[name="app_id"]').change(function() {
			$(this).parent().removeClass('has-error');
			$(this).next().next().empty();
			if ($(this).val())
				$('#appname').val($(this).find('option:selected').text());
		});
		$('[name="access"]').change(function() {
			$(this).parent().removeClass('has-error');
			$(this).next().next().empty();
		});

		$('[name="nama_skpd"]').change(function() {
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});

		$("#filter_username").keyup(function(event) {
			if (event.keyCode == 13) {
				reload_table();
			}
		});

		$("#filter_nama,#filter_nama_perumahan,#filter_alamat").keyup(function(event) {
			if (event.keyCode == 13) {
				reload_table();
			}
		});

		$("#filter_kec,#filter_kel").change(function() {
			reload_table();
		});
	});



	function save() {
		$('#btnSave').text('Proses..'); //change button text
		$('#btnSave').attr('disabled', true); //set button disable
		var url;

		url = "<?php echo site_url('profil/ajax_insert') ?>";
		Swal.fire({
			title: 'Apa Anda Yakin?',
			text: "Apa Anda Yakin Menyimpan Data Profil?",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Ya',
			cancelButtonText: 'Tidak'
		}).then((result) => {
			if (result.value) {
				// ajax adding data to database
				$.ajax({
					url: url,
					type: "POST",
					data: $('#form1').serialize(),
					dataType: "JSON",
					//async: false,
					success: function(data) {

						if (data.status) {
							Swal.fire({
								title: 'Berhasil',
								text: "Menyimpan Data Profil",
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
						} else {
							$('[name="username"]').parent().addClass(data.error_class['username']);
							$('[name="username"]').next().text(data.error_string['username']);

							$('[name="nama"]').parent().addClass(data.error_class['nama']);
							$('[name="nama"]').next().text(data.error_string['nama']);

							$('[name="app_id"]').parent().addClass(data.error_class['app_id']);
							$('[name="app_id"]').next().next().text(data.error_string['app_id']);

							$('[name="nama_skpd"]').parent().addClass(data.error_class['nama_skpd']);
							$('[name="nama_skpd"]').next().text(data.error_string['nama_skpd']);
						}

						$('#btnSave').text('Simpan'); //change button text
						$('#btnSave').attr('disabled', false); //set button enable


					},
					error: function(jqXHR, textStatus, errorThrown) {
						alert('Error adding / update data');
						$('#btnSave').text('Simpan'); //change button text
						$('#btnSave').attr('disabled', false); //set button enable

					}
				});
			}
		});
	}

	function del(id) {
		swal({
				title: "",
				text: "Apakah yakin data ingin dihapus?",
				type: "warning",
				showCancelButton: true,
				confirmButtonText: "Hapus",
				cancelButtonText: "Batal",
				closeOnConfirm: true,
			},
			function() {
				$.ajax({
					url: "<?php echo site_url('location/ajax_delete') ?>/" + id,
					type: "POST",
					dataType: "JSON",
					async: false,
					success: function(data) {
						reload_table();
					},
					error: function(jqXHR, textStatus, errorThrown) {
						alert('Error deleting data');
					}
				});
			}
		);
	}
</script>
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Management Ruang Lingkup</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"">Home</a></li>
              <li class=" breadcrumb-item active">Ruang Lingkup</li>
				</ol>
			</div>
		</div>
	</div>
</div>
<section class="content">
	<div class="card">
		<form action="#" id="form1" class="form-horizontal">
			<div class="card-body">
				<input type="hidden" value="ruang_lingkup" id="option" name="option">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				<textarea class="textarea" name="isi" id="isi" placeholder="Place some text here" style="width: 100%; min-height: 700px !important;  font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $isi; ?></textarea>
			</div>
			<div class="card-footer">
				<button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
			</div>
		</form>
	</div>
</section>

<script>
	$(function() {
		// Summernote
		$('.textarea').summernote({
			placeholder: 'Profil PPID',
			tabsize: 2,
			height: 600,
			callbacks: {
				onImageUpload: function(image) {
					uploadImage(image[0]);
				},
				onMediaDelete: function(target) {
					deleteImage(target[0].src);
				}
			}
		});

		function uploadImage(image) {
			var data = new FormData();
			data.append("image", image);
			$.ajax({
				url: "<?php echo site_url('profil/upload_image_summernote') ?>",
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
				data: {
					src: src
				},
				type: "POST",
				url: "<?php echo site_url('profil/delete_image_summernote') ?>",
				cache: false,
				success: function(response) {
					console.log(response);
				}
			});
		}
	})
</script>