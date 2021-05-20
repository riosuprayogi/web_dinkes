<style>
.select2-selection--single {
	height: 100% !important;
}
.select2-selection__rendered{
	word-wrap: break-word !important;
	text-overflow: inherit !important;
	white-space: normal !important;
}
input[type=checkbox] {
		display: none;
}

.containerz img {
		transition: transform 0.25s ease;
		cursor: zoom-in;
}

input[type=checkbox]:checked~label>img {
		transform: scale(2);
		cursor: zoom-out;
}
</style>

<script>
var save_method; //for save method string
var table;
var table2;

function magnify(nama_foto=null,desk=null){
		$('#img_foto').empty();
		if (nama_foto) {
				// $('#img_foto').append('<img width="100%" src="https://testing.tangerangkota.go.id/angkutan/assets/foto_angkutan/'+nama_foto+'"/>');
				$('#img_foto').attr('src', '<?php echo base_url('assets/media/image/')?>'+nama_foto);
				// $('#hapus_foto').click(function(){ myFunction(); });
				// $('#hapus_foto').attr('onclick', "del_foto('"+nama_foto+"')");
		}

		// $('#desk').text(desk);
		$('#modal_magnify').modal('show'); // show bootstrap modal when complete loaded
}

$(document).ready(function() {

  $('#form_foto').on('change','.priviw',function(){
			var id = $(this).attr('data-val');
			readURL(this,id);
			console.log(id);
	});

	function readURL(input,id) {
			if (input.files && input.files[0]) {
					var reader = new FileReader();
					reader.onload = function (e) {
									$('#blah'+id).attr('src', e.target.result);
					}
					reader.readAsDataURL(input.files[0]);
			}
	}

	

	$('[name="luas_psu_diserahkan"]').change(function(){
		var luas_psu = parseInt($('[name="luas_psu"]').val());
		var luas_diserahkan = parseInt($('[name="luas_psu_diserahkan"]').val());
		var total = luas_psu + luas_diserahkan;
		$('[name="sisa"]').val(total);
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

	$("#filter_username").keyup(function(event){
		if(event.keyCode == 13){
			reload_table();
		}
	});

	$("#filter_nama,#filter_nama_perumahan,#filter_alamat").keyup(function(event){
		if(event.keyCode == 13){
			reload_table();
		}
	});

	$("#filter_kec,#filter_kel").change(function(){
		reload_table();
	});
});



function save(){
  var form = $('#form1')[0]; // You need to use standard javascript object here
  var formData = new FormData(form);
	$('#btnSave').text('Proses..'); //change button text
	$('#btnSave').attr('disabled',true); //set button disable
	var url;

	url = "<?php echo site_url('profil/ajax_upload')?>";

	Swal.fire({
      title: 'Apa Anda Yakin?',
      text: "Apa Anda Yakin Mengupload Data Struktur Ini?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Tidak'
    }).then((result) => {
			if (result.value) {
			// ajax adding data to database
			$.ajax({ url : url,
				type: "POST",
				data: formData,
			dataType: "JSON",
			cache: false,
			contentType: false,
			processData: false,
				//async: false,
				success: function(data){

					if(data.status){
						location.reload();
					}else{
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

function del(id){
	Swal.fire({
      title: 'Apa Anda Yakin?',
      text: "Apa Anda Yakin Menghapus Data Struktur Ini?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya',
      cancelButtonText: 'Tidak'
    }).then((result) => {
			if (result.value) {
				$.ajax({ url : "<?php echo site_url('profil/ajax_delete_foto?link=')?>"+id,
						type: "POST",
						dataType: "JSON",
						async: false,
						success: function(data){
							if (data.status) {
              Swal.fire({
                title: 'Berhasil',
                text: "Menghapus Data Struktur",
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
						},
						error: function (jqXHR, textStatus, errorThrown){
							alert('Error deleting data');
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
			<h1 class="m-0 text-dark">Manajemen Struktur PPID</h1>
			</div>
			<div class="col-sm-6">
			<ol class="breadcrumb float-sm-right">
				<li class="breadcrumb-item"><a href="<?php echo base_url();?>"">Home</a></li>
				<li class="breadcrumb-item active">Struktur PPID</li>
			</ol>
			</div>
		</div>
	</div>
</div>
<section class="content">
	<div class="card">
		<form action="#" id="form1" class="form-horizontal">
			<div class="card-body">
        <input type="hidden" value="struktur" id="option" name="option">
				<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <?php if(count($struktur) < 1) {?>
					<div class="form-group">
					<label for="exampleInputFile">File input</label>
					<div class="row">
								<div class="col-md-8">
								
								<div class="input-group">
						<div id="form_foto" class="custom-file">
						<input data-val="1" class="priviw custom-file-input" accept="image/*" type="file"
								id="imgInp1" name="foto[]">
										
						<label class="custom-file-label" for="exampleInputFile">Choose file</label>
						</div>
						
					</div>
					</div>
					<div class="col-md-4">
							<div style=" margin: auto;width: fit-content; padding: 10px;">
									<!-- <input type="text" class="form-control" name="deskripsi[]"> -->
									<img data-val="1" id="blah1" class="blah" src="" style="max-width:400px; margin: auto; padding: 10px;" />
							</div>
					</div>
					</div>
					<br>
					
        </div>
        
			</div>
			<div class="card-footer">
				<button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
			</div>
				<?php } ?>
		</form>	
	</div>
	<div class="card">
		<div class="card-body">
			<div class="row">
				<?php foreach(@$struktur as $row) {?>
				<div class="col-lg-3 col-md-4 col-6">
					<button type="button" onclick='del("<?= $row->isi?>")' class="btn btn-danger btn-sm btn-block"><i class="fas fa-fw fa-trash"></i></button>
					<a href="javascript:void(0)" onclick="magnify('<?= $row->isi ?>')" class="d-block mb-4 h-100">
						<img class="img-fluid img-responsive img-thumbnail" src="<?php echo base_url('assets/media/image/').$row->isi ?>" alt="">
					</a>
				</div>
				<?php } ?>
			
			</div>
		</div>
	</div>
</section>
<div class="modal fade" id="modal_magnify" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <!-- <span id="dtl_foto"></span> -->
                    <div class="containerz">
                        <input type="checkbox" id="zoomCheck">
                        <label for="zoomCheck">
                            <img id="img_foto" class="img-responsive img-thumbnail" src="">
                        </label>
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
		$('.textarea').summernote({
        placeholder: 'Profil PPID',
        tabsize: 2,
        height: 600
      });
  })
</script>