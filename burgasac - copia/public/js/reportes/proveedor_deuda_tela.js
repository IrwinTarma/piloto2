var Reporte = {
	buscar : function() {
		$('#table-reporte').DataTable().destroy();
		return $('#table-reporte').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: 'proveedor_tela_deuda?fechafiltro='+$("#fechafiltro").val()+'&proveedorfiltro='+$("#proveedorfiltro").val()+'&productofiltro='+$("#productofiltro").val()+'&colorfiltro='+$("#colorfiltro").val(),
            columns: [
            	{data: 'created_at', name: 'created_at'},
				{data: 'producto', name: 'producto'},
				{data: 'proveedor', name: 'proveedor'},
                {data: 'color', name: 'color'},
                {"data": function ( row, type, val, meta ) {
                    if (parseInt(row.preciounitario) > 0) {
                        return parseFloat(row.total / row.preciounitario).toFixed(2);
                    } else {
                        return parseFloat(0).toFixed(2);
                    }
                }, name: 'peso'},
                {"data": function ( row, type, val, meta ) {
                    var moneda = "";
                    if (row.moneda_id == 1) {
                    	moneda = "s/. ";
                    }
                    if (row.moneda_id == 2) {
                    	moneda = "USD ";
                    }
                    return moneda+=" "+row.total;
                }, name: 'total'},
            ]
        });
	}
}