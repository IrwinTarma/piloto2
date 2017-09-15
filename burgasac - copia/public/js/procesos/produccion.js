$(document).ready(function(){
	$("[name=kg_producidos], [name=kg_falla]").keyup(Produccion.calcularMateriaUsada).keydown(Produccion.calcularMateriaUsada);
	$("#planeamiento-form").submit(function(e){
		$("input.input-insumo, .cantidad_maxima_accesorio, .cantidad_maxima_insumo").removeAttr("disabled");
	});
});

var Produccion = {
	calcularMateriaUsada : function() {
		var kgproducidos = $("[name=kg_producidos]").val();
		var kgfallas = $("[name=kg_falla]").val();
		var kgtotal = kgproducidos - kgfallas;

		$("input.input-insumo").each(function(){
			$(this).removeAttr("disabled");
			var row = $(this).closest('tr');
			var indicador = row.data("indicador_valor");

			peso = parseFloat(kgtotal)*parseFloat(indicador);
			$(this).val(peso);
			$(this).prop("disabled", true);
		});
	}
};