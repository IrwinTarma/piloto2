$(document).ready(function(){
	$("#proveedor").change(function(){
		ProveedorColorProducto.colorPorProveedor($(this).val());
	});
});

var ProveedorColorProducto = {
	colorPorProveedor : function(proveedor_id) {
		var colores = $.ajax({
			type: "POST",
			url: "/coloresporproveedor", 
			data: {proveedor_id: proveedor_id}, 
			headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success : function(data){
            	ProveedorColorProducto.pintarComboColor(data);
            } 
        });
	},
	pintarComboColor : function(data) {
		console.log(data);
		if (data.rst == 1) {
			html="<option value=''>Seleccione</option>";
			var colores = data.data;
			for(var i in colores) {
				html+="<option value='"+colores[i].color_id+"'>"+colores[i].codigo_color+"</option>";
			}
			$("#color").removeAttr("disabled");
			$("#color").html(html);
		}

		if (data.rst == 2 || data.rst == "2") {
			Mensaje.alerta(data.msj);
			$("#color").prop("disabled", true);
		}
	}
}