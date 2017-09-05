$(document).ready(function(){
	$(".color").change(function(e){
		row = $(this).closest('tr');
		inputtext = row.find("input.codigo-color");
		if ($(this).is(':checked')) {
			inputtext.removeAttr("disabled");
		} else {
			inputtext.prop("disabled", true);
		}
	});

	$(".tipo").change(function(e){
		if ($(this).is(":checked")) {
			if ($(this).val() == 4) {
				$(".contenedor-colores").css("display", "inline-block");
				$(".color").removeAttr("disabled");
			}
		} else {
			if ($(this).val() == 4) {
				$(".contenedor-colores").css("display", "none");
				$(".color").prop("disabled", true);
			}
		}
	});
});