var i = 0;
var productos_in_details = function(){
            let lotes = [];
            $("#despachos_grid tbody tr").map(function () {
              var producto = $(this).find(".producto").find("input").val();
              var proveedor =  $(this).find(".proveedor").find("input").val();
              lotes.push(producto+proveedor);
            })
            return lotes;
          };

          $('input[type=radio]').change(function() {
              $('input[type=radio]:checked').not(this).prop('checked', false);
          });

          var cantidad_max = 0,
              rollos_max = 0;


          function checkStockKG() {
              var kg = $(this).val();
              //if(kg>cantidad_max) return $(this).val(cantidad_max);
          }

          function checkStockRollos(){
            var rollos = $(this).val();
            //if(rollos>rollos_max) return $(this).val(rollos_max);
          }
$(document).ready(function(){
	$("#proveedor").on('change', function(e){
    DespachoTintoreria.colorPorProveedor($("[name=proveedor] option:selected").val());
		
	});
  $("[name=producto]").change(function(){
    //DespachoTintoreria.stockProveedor();
  });
  $("[name=lote]").change(function(){
    DespachoTintoreria.stockPorLote();
  });
	$("#fecha").datepicker({ format: 'yyyy-mm-dd'})
	    .on("show", function(e) {
	        return false;
	    }).on("hide", function(e) {
	        return false;
	    }).on("clearDate", function(e) {
	        return false;
	});

	$(".btn-boleta").click(function(e){
        var despachoid = $(this).data("despacho");
        var url = "/boletadespachotintoreria?id="+despachoid;
        window.open(url, ",mywin", "left=20, top=20, width=900, height = 900, toolbar=no, directories=no, menubar=no, status=no, resizable=1");
    });

	$("#agregar-materia").click(function () {
            var id = $(".select-details:checked").val();
            var tr = $(".select-details:checked").parent().parent();
            if(tr.length){
              var cajas = Number($("[name='cajas']").val());
              var materia_prima = Number($("[name='materia_prima']").val());
              if(cajas&&materia_prima){
                var data ={
                  caja: cajas,
                  materia: materia_prima
                }
                tr.find(".cajas").find("input").val(cajas);
                tr.find(".materia").find("input").val(materia_prima);
                tr.find(".cajas").find("span").html(cajas)
                tr.find(".materia").find("span").html(materia_prima)


              }else {
                Mensaje.alerta('Complete los campos por favor')
              }
            }else {
              Mensaje.alerta('Seleccione un campo')
            }
          });

	/* TAB FOCUS */
    $('#select_materia_prima').focus();

            /* make enter key act like tab key */
            $('input').keypress(function(e) {
                if (e.which == 13) {
                    $(':input:eq(' + ($(':input').index(this) + 1) + ')').focus();
                    e.preventDefault();
                }
            });

            $('input#cantidad_paquetes').keypress(function (e) {
               if (e.which == 13) {
                    $('#add_to_grid').click();
                    $('#select_materia_prima').focus();
                    e.preventDefault();
                }
            });
	$("[name='kg']").keydown(checkStockKG).keyup(checkStockKG);
          $("[name='rollos']").keydown(checkStockRollos).keyup(checkStockRollos);

    $('#select_materia_prima').change(function () {
                if ( $(this).val() == 'materia_prima' ){
                    $('#select_accesorio').hide();
                    $('#select_insumo').show();
                }
                else{
                    $('#select_accesorio').show();
                    $('#select_insumo').hide();
                }
            });

            /* On selected value, update var accesorio */
            $('#select_insumo').change(function () {
                $('#select_accesorio').val('');
            });
            /* On selected value, update var insumo */
            $('#select_accesorio').change(function () {
                $('#select_insumo').val('');
            });
   $("[name='producto']").change(function () {
        var id = $(this).val();
       // DespachoTintoreria.proveedoresPorProducto(id);
       DespachoTintoreria.loteProducto();
    });

    $('#add_to_grid').click(function () {
		var fecha_registro = $("[name='fecha']").val(),
        producto = $("[name='producto']").val(),
        color = $("[name='color']").val(),
        proveedor = $("[name='proveedor']").val(),
        rollos = $("[name='rollos']").val(),
        kg = $("[name='kg']").val();
        var nro_lote = $("[name=lote]").val();
		var cod = producto + proveedor;
        if (fecha_registro!='' && producto != '' && color != '' && rollos != '' && kg != '' && proveedor != '' && nro_lote!='')
        {
            //if(productos_in_details().indexOf(cod)>=0) return Mensaje.alerta('Ya existe un trabajador con esa maquina y turno');

            $('#despachos_grid tbody tr:last').after('<tr>\
                <td>' + DespachoTintoreria.add_hidden_button(i, 'fecha', fecha_registro) + fecha_registro + '</td>\
                <td class="proveedor">' +  DespachoTintoreria.add_hidden_button(i, 'proveedor', proveedor) + $("[name='proveedor'] option:selected").text() + '</td>\
                <td class="producto">' +  DespachoTintoreria.add_hidden_button(i, 'producto', producto) + $("[name='producto'] option:selected").text() + '</td>\
                <td class="nro_lote">' +  DespachoTintoreria.add_hidden_button(i, 'nro_lote', nro_lote) + $("[name='lote'] option:selected").text() + '</td>\
                <td>' +  DespachoTintoreria.add_hidden_button(i, 'color', color) + $("[name='color'] option:selected").text() + '</td>\
                <td>' +  DespachoTintoreria.add_hidden_button(i, 'kg', kg) + $("[name='kg']").val() + '</td>\
                <td>' +  DespachoTintoreria.add_hidden_button(i, 'rollos', rollos) + $("[name='rollos']").val() + '</td>\
                <td><a class="eliminar" style="cursor:pointer"><i class="fa fa-remove"></i></a>'
                + '</td></tr>'
            );
            i++;
        } else {
            Mensaje.alerta('Para agregar al detalle complete los campos requeridos:\
                        \n- Fecha Registro\
                        \n- Número de Lote\
                        \n- Producto\
                        \n- Marca\
                        \n- Titulo\
                        \n- Peso Bruto\
                        \n- Peso Tara\
                        \n- Cantidad de Caja/Bolsas')
        }

        return false;
    });

            /* actualizar peso_neto */
            $('#compras_grid tbody tr td.show_peso_bruto input').on('keyup', function() {
                show_peso_bruto = $(this).val();
                show_peso_tara = $(this).parent().parent().find('td.show_peso_tara input').val();
                show_peso_neto = show_peso_bruto - show_peso_tara;
                $(this).parent().parent().find('td.show_peso_neto').html(show_peso_neto);
            });

            $('#compras_grid tbody tr td.show_peso_tara input').on('keyup', function() {
                show_peso_tara = $(this).val();
                show_peso_bruto = $(this).parent().parent().find('td.show_peso_bruto input').val();
                show_peso_neto = show_peso_bruto - show_peso_tara;
                show_peso_neto = parseFloat(Math.round( show_peso_neto * 100) / 100).toFixed(2);
                $(this).parent().parent().find('td.show_peso_neto').html(show_peso_neto);
            });

            /* eliminar tr */
            $('body').on('click', 'a.eliminar', function () {
                $(this).parent().parent().remove();
                i--;
            });
        $("[name='accesorio']").change(function () {
              var id = $(this).val();
              $.ajax({
                url:'/compras/accesorios/'+id + '/lotes',
                success:function (lotes) {
                  $("[name='lote_accesorio']").empty();
                  for (var i = 0; i < lotes.length; i++) {
                    $("[name='lote_accesorio']").append('<option >' + lotes[i].nro_lote   +'</option>');
                  }
                }
              })
            });
        $("[name='insumo']").change(function () {
              var id = $(this).val();
              $.ajax({
                url:'compras/insumos/'+id+'/lotes',
                success:function (lotes) {
                  $("[name='lote_insumo']").empty();
                  for (var i = 0; i < lotes.length; i++) {
                    $("[name='lote_insumo']").append('<option >' + lotes[i].nro_lote   +'</option>');
                  }
                }
              })
            });
});

var DespachoTintoreria = {
	colorPorProveedor : function(proveedor_id, color_id) {
		var colores = $.ajax({
			type: "POST",
			url: "/coloresporproveedor", 
			data: {proveedor_id: proveedor_id, color_id: color_id}, 
			headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            success : function(data){
            	DespachoTintoreria.pintarComboColor(data);
            } 
        });
	},
	pintarComboColor : function(data) {
		if (data.rst == 1) {
			html="<option value=''>Seleccione</option>";
			var colores = data.data;
			for(var i in colores) {
				html+="<option value='"+colores[i].color_id+"'>"+colores[i].codigo_color+"</option>";
			}
			$("[name=color]").removeAttr("disabled");
			$("[name=color]").html(html);
			$("[name=color]").selectpicker();
		    $("[name=color]").selectpicker("refresh");
		}

		if (data.rst == 2 || data.rst == "2") {
			html="<option value=''>Seleccione</option>";
			Mensaje.alerta(data.msj);
			$("[name=color]").html(html);
			$("[name=color]").prop("disabled", true);
		}
	},
	proveedoresPorProducto: function(producto_id) {
		$.ajax({
            url:'/producto/'+ producto_id + '/proveedores',
                success:function (obj) {
                var html = "<option value=''>Seleccione</option>";
                console.log(obj.length);
	                if (obj.length > 0) {
	                	for (var i = 0; i < obj.length; i++) {
		                    html+='<option value="'+ obj[i].proveedor_id + '" >' + obj[i].nombre_comercial   +'</option>';
		                }
		                
		                $("[name='proveedor']").removeAttr("disabled");
		                $("[name='proveedor']").html(html);
		            	$("[name='proveedor']").selectpicker();
		            	$("[name='proveedor']").selectpicker("refresh");
	                  	//
	                } else {
	                	$("[name='proveedor']").html(html);
	                	$("[name='proveedor']").prop("disabled", true);
	                }
                }
        });
	},
	stockProveedor : function() {
		var id = $("[name='producto']").val()
        var proveedor_id = $("[name='proveedor']").val();
        $.ajax({
              url: "/telas/"+id+'/proveedor/3/stock',
              success:function (stock) {
                /*cantidad_max = stock.cantidad;
                rollos_max = stock.rollos;
                $("[name='kg']").val(stock.cantidad);
                $("[name='rollos']").val(stock.rollos);*/
              }
        });
	},
  loteProducto : function() {
    var producto_id = $("[name='producto']").val();
    $.get({
      url : "/lotesconstock",
      data: {producto_id : producto_id, proveedor_id : 3},
      success: function(obj) {
        var html = "";
        if (obj.rst == 1) {
          html+="<option>Seleccione</option>";
          for(var i in obj.lotes) {
            html+="<option value='"+obj.lotes[i].nro_lote+"'>"+obj.lotes[i].nro_lote+"</option>";
          }
          $("#lote").removeAttr("disabled");
          $("#lote").html(html);
          $("#lote").selectpicker();
          $("#lote").selectpicker("refresh");
        }
        if (obj.rst == 2) {
          Mensaje.alerta("No existen lotes disponibles!!!!");
          $("#lote").html(html);
          $("#lote").prop("disabled", true);
        }
      }
    });
  },
  stockPorLote : function() {
    var nro_lote = $("[name='lote']").val();
    var producto_id = $("[name='producto']").val();
    $.get({
      url : "/stockporlote",
      data: {producto_id : producto_id, proveedor_id : 3, nro_lote: nro_lote},
      success: function(obj) {
        var html = "";
        if (obj.rst == 1) {
          cantidad_max = obj.stock.cantidad;
          rollos_max = obj.stock.rollos;

          $("[name='kg'], [name='rollos']").removeAttr("disabled");
          $("[name='kg']").val(obj.stock.cantidad);
          $("[name='rollos']").val(obj.stock.rollos);
          
        }
        if (obj.rst == 2) {
          Mensaje.alerta("No existen lotes disponibles!!!!");
          $("[name='kg'], [name='rollos']").prop("disabled", true)
        }
      }
    });

  },
	add_hidden_button : function(j, fieldname, value) {
        return '<input type="hidden" name="detalles[' + j + '][' + fieldname + ']" value="' + value + '">';
    }
}