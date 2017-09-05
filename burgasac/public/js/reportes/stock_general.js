setTimeout(function () {
  $(".dataTables_filter").hide()
},1500)

$("#buscar-tabla").click(function () {
  bandeja.ajax.reload();
  return false;
});

        $("#buscar-tabla-stocks").click(function () {
          stocks.ajax.reload();
          return false;
        });

  stocks = $("#stocks").DataTable({
          processing: true,
          serverSide: true,
          "ajax":{
            url:'/reportes/resumen',
            data:function(d){
              return $.extend( {}, d, {
                "accesorio":$("#accesorio_stock").val(),
                "insumo" : $("#insumo_stock").val(),
              });
            },
            dataSrc: function (json) {
              var stocks = json.data,
              return_data = [];
              for (var i = 0,stock; stock = stocks[i]; i++) {
                var data = {};
                data.lote = stock.lote;
                data.mp   = stock.insumo? stock.insumo.nombre_generico : stock.accesorio.nombre;
                data.cantidad = stock.cantidad;
                data.peso_neto = stock.insumo? stock.peso_neto+" kg" : stock.cantidad+" unid.";
                data.proveedor = stock.proveedor;
                data.titulo = stock.titulo;

                return_data.push(data);
              }
              return return_data;
            }
          },
          "columns": [
            {"data": function ( row, type, val, meta ) {
               proveedor = "";
               if (typeof row.proveedor!=undefined && typeof row.proveedor!="undefined" && row.proveedor!=null) {
                  proveedor = row.proveedor.nombre_comercial;
               }
               //titulo = row.titulo.nombre;
               return proveedor;
            }, name: 'proveedor_id'},
            { "data": "lote", name:"lote" },
            { "data": "mp",name:"insumo_id"},
            {"data": function ( row, type, val, meta ) {
              titulo = "";
               if (typeof row.titulo!=undefined && typeof row.titulo!="undefined" && row.titulo!=null) {
                  titulo = row.titulo.nombre;
               }
               //titulo = row.titulo.nombre;
               return titulo;
            }, name: 'titulo_id'},
            { "data": "peso_neto",name:"peso_neto"},

          ],
  });
