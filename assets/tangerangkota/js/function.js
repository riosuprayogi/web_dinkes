function datatables(sort) {
	$(document).ready(function(){
		oTable = $('#dyntable').dataTable({
			"bStateSave":false,
			"aaSorting":[[sort, "asc" ]],
			"iDisplayLength":10
		});
	});
}

function datatables1(sort) {
	$(document).ready(function(){
		oTable = $('#dyntable1').dataTable({
			"bStateSave":false,
			"aaSorting":[[sort, "asc" ]],
			"iDisplayLength":25
		});
	});
}

/*
function datatables_ps(url){
	$(document).ready(function(){
		oTable = $('.ajax-table').dataTable({
			"columnDefs": [{ "searchable": false, "targets": 5 }, { "orderable": false, "targets": 5}],
			"processing": true,
     		"serverSide": true,
			
			"ajax": {
				dataType: "json",
				type: "POST",
				url:url
				}
			});
			
		});
		$('.dataTables_filter input').attr("placeholder", "Search...");
}
*/

function datatables_ps(url, sort){
	$(document).ready(function(){
		oTable = $('.ajax-table').dataTable({
					"processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "responsive": true,
					"order": [],
					"columnDefs": [ {
						"targets": [ -1 ],
						"orderable": false,
						"searchable": true,
						"className": "dt-center", 
						"targets": "_all"
					  } ], //Initial no order.
                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": url,
                        "type": "POST"
                    }
		});
	});
}


function datatables_ps1(url, sort){
	$(document).ready(function(){
		oTable1 = $('#dyntable1').dataTable({
			"bStateSave":false,
			"aaSorting":[[sort, "desc" ]],
			"iDisplayLength":10,
			"sPaginationType":"full_numbers",
			"bProcessing":true,
			"bServerSide":true,
			"sAjaxSource":url,
			"fnServerData":function(sSource, aoData, fnCallback){
				$.ajax({
					"dataType":"json",
					"type":"post",
					"cache":false,
					"url":sSource,
					"data":aoData,
					"success":fnCallback
				})
			},
			"fnDrawCallback": function ( oSettings ) {
					if ( oSettings.bSorted || oSettings.bFiltered )
					{
						for ( var i=0, iLen=oSettings.aiDisplay.length ; i<iLen ; i++ )
						{
							$('td:eq(0)', oSettings.aoData[ oSettings.aiDisplay[i] ].nTr ).html( i+1 );
						}
					}
				}
		});
	});
}

function fancybox(){
	$("#view").live('click',function(event){
		event.preventDefault();
			$.fancybox.open({
				href 			: $(this).attr("to"),
				type 			: 'iframe',
				padding 		: 2,
				opacity			: true,
				titlePosition	: 'over',
				openEffect 		: 'elastic',
				openSpeed  		: 150,
				closeEffect 	: 'elastic',
				closeSpeed  	: 150,
				width			: 900,
				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'transparent',
							'background' : 'rgba(0, 0, 0, 0.6)'
						}
					}
				}
		});
	});
}

function fancybox_image(){
	$("a#fancybox_image").fancybox({
		'titleShow'     : false,
		'transitionIn'	: 'elastic',
		'transitionOut'	: 'elastic',
		'easingIn'      : 'easeOutBack',
		'easingOut'     : 'easeInBack',
		helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'transparent',
							'background' : 'rgba(0, 0, 0, 0.6)'
						}
					}
				}
	});
}

function editUser(url,page,func,uid)
{
  //var url = $('#edit').attr('to');
  save_method = 'update';
  $('#form-edit-user')[0].reset(); // reset form on modals

  //Ajax Load data from ajax
  $.ajax({
    url : url+"/"+page+"/"+func+"/"+uid,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
		//var skpd = [{id: data.skpd, text: data.nama_skpd}];
		$('#form-edit-user').attr('action', url+page+"/save/"+uid);
        $('[name="nama"]').val(data.nama);
        $('[name="email"]').val(data.email);
		$('[name="skpd"]').select2().val(data.skpd).trigger('change');
		$('[name="level"]').select2().val(data.group).trigger('change');



        $('#edit-user').modal('show'); // show bootstrap modal when complete loaded

    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Error get data from ajax');
    }
});
}

function getBarcode(url,kd_barang)
{
  //var url = $('#edit').attr('to');
  $('#form-getBarcode')[0].reset(); // reset form on modals

  //Ajax Load data from ajax
  $.ajax({
    url : url+"masters/products/getBarcode/"+kd_barang,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
		//var skpd = [{id: data.skpd, text: data.nama_skpd}];
		$('#form-getBarcode').attr('action', data.action);
        $('#kd_barang').val(data.kd_barang);
        $('#barcode').attr('src', data.barcode);
        $('#modal-getBarcode').modal('show'); // show bootstrap modal when complete loaded

    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Terjadi Kesalahan pada saat mengambil data');
    }
});
}

function updateStok(url,id_barang)
{
  //var url = $('#edit').attr('to');
  $('#form-updateStok')[0].reset(); // reset form on modals

  //Ajax Load data from ajax
  $.ajax({
    url : url+"/inventory/stock/stokById/"+id_barang,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
		//var skpd = [{id: data.skpd, text: data.nama_skpd}];
        $('[name="id_barang"]').val(data.id_barang);
		$('[name="nama_barang"]').val(data.nama_barang);
		$('[name="stok"]').val(data.stok);
        $('#modal-updateStok').modal('show'); // show bootstrap modal when complete loaded

    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Terjadi Kesalahan pada saat mengambil data');
    }
});
}

function updateNmrSuratJalan(url,id_barang_keluar)
{
  //var url = $('#edit').attr('to');
  $('#form-updateNmrSuratJalan')[0].reset(); // reset form on modals

  //Ajax Load data from ajax
  $.ajax({
    url : url+"barang_keluar/surat_jalan/"+id_barang_keluar,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
		//var skpd = [{id: data.skpd, text: data.nama_skpd}];
        $('[name="id_barang_keluar"]').val(data.id_barang_keluar);
		$('[name="nmr_surat_jalan"]').val(data.nmr_surat_jalan);
        $('#modal-updateNmrSuratJalan').modal('show'); // show bootstrap modal when complete loaded

    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Terjadi Kesalahan pada saat mengambil data');
    }
});
}

function getBarcodeBranch(url,kd_barang)
{
  //var url = $('#edit').attr('to');
  $('#form-getBarcode')[0].reset(); // reset form on modals

  //Ajax Load data from ajax
  $.ajax({
    url : url+"online/inventory/getBarcode/"+kd_barang,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
		//var skpd = [{id: data.skpd, text: data.nama_skpd}];
		$('#form-getBarcode').attr('action', data.action);
        $('#kd_barang').val(data.kd_barang);
        $('#barcode').attr('src', data.barcode);
        $('#modal-getBarcode').modal('show'); // show bootstrap modal when complete loaded

    },
    error: function (jqXHR, textStatus, errorThrown)
    {
        alert('Terjadi Kesalahan pada saat mengambil data');
    }
});
}