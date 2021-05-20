<script>
var save_method; //for save method string
var table;

$(document).ready(function() {
    table = $('#table').DataTable({
        processing: true,
        serverSide: true,
		filter: false,
        autoWidth:false,
		paginate: false,
		info: false,
        ajax: {
            url: "<?php echo site_url('menu/ajax_list')?>",
            type: "GET"
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
		order: [],
		columns: [
            {'data':'no','orderable':false},
            {'data':'nama','orderable':false},
            {'data':'path','orderable':false},
            {'data':'icon','orderable':false},
            {'data':'index','orderable':false},
            {'data':'aksi','orderable':false}
        ]
    });

    $('[name="nama"],[name="index"]').change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
});

function add(){
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.col-md-12').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambah'); // Set Title to Bootstrap modal title
}

function add_child(id_parent){
    save_method = 'add_child';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.col-md-12').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
	$('[name="id"]').val(id_parent);
	$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
	$('.modal-title').text('Tambah'); // Set title to Bootstrap modal title
}

function edit(id){
    save_method = 'edit';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.col-md-12').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('menu/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){
            $('[name="id"]').val(data.id_menu);
            $('[name="nama"]').val(data.nama);
            $('[name="path"]').val(data.path);
            $('[name="icon"]').val(data.icon);
            $('[name="index"]').val(data.index);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Ubah'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown){
            alert('Error get data from ajax');
        }
    });
}

function reload_table(){
    table.ajax.reload(null,false);
}

function del(id){
	Swal.fire({
		title: 'Hapus?',
		text: "Apakah yakin data ingin dihapus?",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		cancelButtonText: 'Batal',
		confirmButtonText: 'Hapus'
	}).then((result) => {
		if (result.value) {
			$.ajax({
				url : "<?php echo site_url('menu/ajax_delete?key=')?>"+id,
				type: "GET",
				dataType: "JSON",
				success: function(data){
					Swal.fire(
					'Berhasil!',
					'Berhasil Terhapus.',
					'success'
				)
					reload_table();
				},
				error: function (jqXHR, textStatus, errorThrown){
					alert('Error deleting data');
				}
			});
			
		}
	});
}

function save(){
    $('#btnSave').text('Proses..'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('menu/ajax_insert')?>";
    }else if(save_method == 'edit'){
        url = "<?php echo site_url('menu/ajax_update')?>";
    }else if(save_method == 'add_child'){
        url = "<?php echo site_url('menu/ajax_add_child')?>";
    }

    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data){

            if(data.status){
                $('#modal_form').modal('hide');
                reload_table();
                location.reload();
            }else{
                $('[name="nama"]').parent().parent().addClass(data.error_class['nama']);
				$('[name="nama"]').next().text(data.error_string['nama']);
                $('[name="index"]').parent().parent().addClass(data.error_class['index']);
                $('[name="index"]').next().text(data.error_string['index']);
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
<section class="content-header">
	<h1>Manajemen Menu</h1>
	<ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Menu</li>
	</ol>
</section>
<section class="content">
	<div class="card">
		<div class="card-body">
            <table id="table" class="table table-striped table-bordered">
    			<thead>
    				<tr>
    					<td onclick="add()" style="text-align:center;cursor:pointer;"><i class="fas fa-plus"></i></a></td>
    					<td colspan="5"></td>
    				</tr>
    				<tr class="info">
    					<th width="5%"><b>No</b></th>
    					<th width="55%"><b>Nama Menu</b></th>
    					<th width="10%"><b>Path</b></th>
    					<th width="10%"><b>Icon</b></th>
                        <th width="10%"><b>Index</b></th>
    					<th width="10%"><b>Aksi</b></th>
    				</tr>
    			</thead>
    		</table>
		</div>
	</div>
</section>

<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Tambah</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
					<div class="form-body">
						<input type="hidden" value="" name="id">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
						<div class="form-group">
							<div class="col-md-12">
								<label>Nama Menu :</label>
								<?php
								echo form_input(array(
									'name' => 'nama',
									'id' => 'nama',
									'class' => 'form-control input-sm',
									'placeholder' => 'Nama Menu',
									'maxlength' => '255'
								));
								?>
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<label>Path :</label>
								<?php
								echo form_input(array(
									'name' => 'path',
									'id' => 'path',
									'class' => 'form-control input-sm',
									'placeholder' => 'Path',
									'maxlength' => '100'
								));
								?>
								<span class="help-block"></span>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<label>Icon :</label>
								<?php
								echo form_input(array(
									'name' => 'icon',
									'id' => 'icon',
									'class' => 'form-control input-sm',
									'placeholder' => 'Icon',
									'maxlength' => '100'
								));
								?>
								<span class="help-block"></span>
							</div>
						</div>
                        <div class="form-group">
                            <div class="col-md-12">
                                <label>Index :</label>
                                <?php
                                echo form_input(array(
                                    'name' => 'index',
                                    'id' => 'index',
                                    'class' => 'form-control input-sm',
                                    'placeholder' => 'Index',
                                    'maxlength' => '255'
                                ));
                                ?>
                                <span class="help-block"></span>
                            </div>
                        </div>
					</div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
