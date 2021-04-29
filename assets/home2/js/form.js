
jQuery(function($) {

	$('[data-rel=tooltip]').tooltip();

	
	$(".select2").css('width','100%').select2({allowClear:true})
	.on('change', function(){
		$(this).closest('form').validate().element($(this));
	}); 


	var $validation = false;

	$(document).one('ajaxloadstart.page', function(e) {
		$('textarea[class*=autosize]').trigger('autosize.destroy');
		$('.limiterBox,.autosizejs').remove();
		$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
	});
	
	// MAterial Date picker    
    $('.mdate').bootstrapMaterialDatePicker({ weekStart: 0, time: false });
    $('.timepicker').bootstrapMaterialDatePicker({ format: 'HH:mm', time: true, date: false });
    $('.date-format').bootstrapMaterialDatePicker({ format: 'dddd DD MMMM YYYY - HH:mm' });
	
	// Format mata uang.
	$(".uang").inputmask("decimal",{
	 radixPoint:".", 
	 groupSeparator: ",", 
	 digits: 2,
	 autoGroup: true,
	 prefix: '',
	 rightAlign: false
	});
})