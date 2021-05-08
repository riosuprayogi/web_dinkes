<link rel="stylesheet" href="<?php echo base_url('assets/') ?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>/plugins/fontawesome-free/css/fontawesome.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>/plugins/toastr/toastr.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/summernote/summernote-bs4.css">
  <!-- datepicker -->
  <link rel="stylesheet" href="<?php echo base_url('assets\plugins\daterangepicker\daterangepicker.css') ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
  
  

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="<?php echo base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?php echo base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?php echo base_url('assets/') ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- DataTables -->
  <script src="<?php echo base_url('assets/') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?php echo base_url('assets/') ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>/plugins/moment/moment.min.js"></script>
  <!-- date-range-picker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
  <!-- Toastr -->
  <script src="<?php echo base_url('assets/') ?>/plugins/toastr/toastr.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?php echo base_url('assets/') ?>dist/js/adminlte.js"></script>

  <!-- OPTIONAL SCRIPTS -->
  <script src="<?php echo base_url('assets/') ?>dist/js/demo.js"></script>

    <!-- jQuery Mapael -->
  <script src="<?php echo base_url('assets/') ?>plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="<?php echo base_url('assets/') ?>plugins/raphael/raphael.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="<?php echo base_url('assets/') ?>plugins/chart.js/Chart.min.js"></script>
  <!-- jquery-validation -->
  <script src="<?php echo base_url('assets/') ?>plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="<?php echo base_url('assets/') ?>plugins/jquery-validation/additional-methods.min.js"></script>
  <!-- PAGE SCRIPTS -->
  <script src="<?php echo base_url('assets/') ?>dist/js/pages/dashboard2.js"></script>
  
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/') ?>default/easyui.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/') ?>icon.css">
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.easyui.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/js/datagrid-filter.js') ?>"></script>
<style>
.tree-node{
    white-space: nowrap !important;
}
.tree-title{
    white-space: normal !important;
    display: inline !important;
}
.tree td {
    text-transform:uppercase
}
.tt_datagrid-cell-c1-deskripsi{
    white-space: normal !important;
}
</style>
<script>
    $(document).ready(function() {
        var id = <?= $key ?>;
        $('#tt').treegrid({
                url:'<?php echo base_url('dokumen/ajax_trees?key=') ?>'+id,
                
                idField:'id',
                treeField:'name',
                // collapsible: true,
                // rownumbers: true,
                // remoteFilter:false,
                // pagination:true,
                columns:[[
                    {title:'INFORMASI',field:'name',width:400,
                        styler: function(value,row,index){
                        if (value < 20){
                            // return 'background-color:#ffee00;color:red;';
                            return 'white-space:nowrap';
                            // the function can return predefined css class and inline style
                            // return {class:'c1',style:'color:red'}
                        }
                    }},
                    {field:'deskripsi',title:'Deskripsi',width:450,
                        styler: function(value,row,index){
                        if (value < 20){
                            // return 'background-color:#ffee00;color:red;';
                            return 'white-space:normal !important';
                            // the function can return predefined css class and inline style
                            // return {class:'c1',style:'color:red'}
                        }
                    }},
                    {field:'tahun',title:'TAHUN',
                        styler: function(value,row,index){
                        if (value < 20){
                            // return 'background-color:#ffee00;color:red;';
                            return 'min-width:100px';
                            // the function can return predefined css class and inline style
                            // return {class:'c1',style:'color:red'}
                        }
                    }},
                    {field:'file',title:'FILE',width:150},
                    // {field:'aksi',title:'AKSI',width:150,align:'center'}
                ]]
            }).treegrid('collapseAll');
            $('#tt').treegrid('enableFilter', [{
                field:'file',
                showFilterBar:false,
            }]);
            
            
    });

    function collapseAll(){
        $('#tt').treegrid('collapseAll');
    }
    function expandAll(){
        $('#tt').treegrid('expandAll');
    }

</script>
<!-- <style>
    @media only screen and (max-width: 768px) {
		/* For mobile phones: */
		#dokumen {
			padding-bottom: 75% !important;
    		margin-bottom: 500px !important;
		}
		.col-md-6{
			margin-top: 5px !important;
			margin-bottom: 5px !important;
		}
		.cid-icon-formulir {
			padding-top: 2rem !important;
			padding-bottom: 2rem !important;
			background-color: #eeeeef;
		}
	}
</style> -->
<div class="container align-center " style="padding-top:50px; padding-bottom:100px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card rounded-lg">
                <div class="card-header text-white bg-info pt-3">
                    <h3>
                        DOKUMEN INFORMASI
                    </h3>
                </div>
                <div class="card-body bg-white border-info rounded-2">
                    <a class="btn btn-primary" onclick="collapseAll()">Tutup Semua </a>
                    <a class="btn btn-info" onclick="expandAll()">Buka Semua</a>
                    <table id="tt" class="table" style="width:100%;height:400px"></table>
                    <!-- <table title="Products" class="easyui-treegrid" style="width:700px;height:300px"
                            url="<?php echo base_url('dokumen/ajax_trees?key=').$key ?>"
                            rownumbers="true"
                            idField="id" treeField="name">
                        <thead>
                            <tr>
                                <th field="name" width="250">Name</th>
                                <th field="deskripsi" width="100" align="right">Quantity</th>
                                <th field="tahun" width="150" align="right" >Price</th>
                                <th field="file" width="150" align="right" >Total</th>
                            </tr>
                        </thead>
                    </table> -->
                </div>
            </div>
        </div>
    </div>
</div>