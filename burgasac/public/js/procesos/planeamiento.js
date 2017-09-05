var i = 0;
var lotes_in_details = [];
var currentStock;
$(document).ready(function(){
    $("#fecha").datepicker({ format: 'yyyy-mm-dd'})
        .on("show", function(e) {
            return false;
        }).on("hide", function(e) {
            return false;
        }).on("clearDate", function(e) {
            return false;
    });
	$('#select_insumo').change(function () {
        $('#select_accesorio').val('');
    });
    /* On selected value, update var insumo */
    $('#select_accesorio').change(function () {
        $('#select_insumo').val('');
    });
	$("#planeamiento-form").submit(function(){
		contador = 0;
	$("#compras_grid_accesorio tbody tr").each(function(){
	     contador++;
	});
	$("#compras_grid_insumo tbody tr").each(function(){
		contador++;
	});

	if (contador < 4) {
		Mensaje.alerta("Debe elegir Accesorio y Materia Prima!!");
		return false;
	}
		
	});

	$("[name=proveedor]").change(function(){
		proveedor_id = $(this).val();
		Planeamiento.getLotesporProveedor(proveedor_id);
	});


            $("[name='lote_insumo']").change(function () {
               var id = $(this).val();
               $.ajax({
                url: '/compras/lote' + '/detalles-insumo',
                data: {proveedor_id : $("[name=proveedor] option:selected").val(), 
                      lote : id
                      },

                success:function (detalles) {
                  $("#select_titulo_insumo").empty();
                  $("[name='insumo']").empty();
                  for (var i = 0; i < detalles.length; i++) {
                    $("#select_titulo_insumo").append('<option value="' + detalles[i].titulo_id   +'" >' + detalles[i].nombre_titulo +'</option>');
                    $("[name='insumo']").append('<option value="' + detalles[i].insumo_id   +'" >' + detalles[i].nombre_insumo +'</option>');
                  }
                }
                });
            })

	$(".detalle").click(function() {
          $(this).closest("tr").next().toggle('fast');
          if($(this).text() == '[ + ]')
            $(this).text('[ - ]');
          else
            $(this).text('[ + ]');
        });

	$("#buscar-tabla").click(function () {
        $("#mp-planeamiento").DataTable().destroy();
        Planeamiento.listar();
        return false;
    });
	$('body').on('click', 'a.eliminar', function () {
        $(this).parent().parent().remove();
    });
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

    /* On selected value: insumo or accesorio */
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

                $("[name='cantidad']").keydown(function () {
               var lastVal = $(this).val();
               if(Number($(this).val())>Number(currentStock)) return $(this).val(currentStock);
            }).keyup(function () {
              var lastVal = $(this).val();
              if(Number($(this).val())>Number(currentStock)) return $(this).val(currentStock);
            });

            $("[name='accesorio']").change(function () {
              var id = $(this).val();
              Planeamiento.getStockAccesorios(id);
            });

            $("[name='insumo']").change(function () {
              var id = $(this).val();
              $.ajax({
                url: '/compras/insumos' + '/'+id+'/lotes',
                success:function (lotes) {
                  $("[name='lote_insumo']").empty();
                  for (var i = 0; i < lotes.length; i++) {
                    $("[name='lote_insumo']").append('<option >' + lotes[i].nro_lote   +'</option>');
                  }
                }
              })
            });
$('#add_accesorio_to_grid').click(function () {
                        // titulo_accesorio = $('#select_titulo_accesorio').val();
    nombre_titulo = $('#select_titulo_accesorio option:selected').text();
                        accesorio = $('#select_accesorio').val();
                        cantidad = $('[name="cantidad"]').val();
                        titulo = $("#select_titulo_accesorio").val();
                        nombre_accesorio = $('#select_accesorio option:selected').text();


                if (accesorio!='' &&  cantidad!='')
                {
                    $('#compras_grid_accesorio tbody tr:last').after('<tr>\
                        <td>' + Planeamiento.add_hidden_button(i, 'titulo_id', titulo) + nombre_titulo + '</td>\
                        <td>' + nombre_accesorio + '</td>\
                        <td>' + Planeamiento.add_hidden_button(i, 'cantidad', cantidad) + cantidad + '</td>\
                        <td><a class="eliminar" style="cursor:pointer"><i class="fa fa-remove"></i></a>'
                        + Planeamiento.add_hidden_button(i, 'accesorio_id', accesorio)
                        + '</td></tr>'
                    );
                    i++;

                    $('#planeamiento-form select#proveedor option:not(:selected)').attr('disabled', true);
                    $('#planeamiento-form input#nro_guia').prop('readonly', true).css('cursor', 'not-allowed');
                    $('#planeamiento-form input#nro_comprobante').prop('readonly', true).css('cursor', 'not-allowed');

                    $('#planeamiento-form input.fillable').val('');
                    $("#planeamiento-form select#select_accesorio").val($("#planeamiento-form select#select_accesorio option:first").val());
                    $("#planeamiento-form select#select_titulo_accesorio").val($("#planeamiento-form select#select_titulo_accesorio option:first").val());
                }
                else
                {
                    alert('Para agregar al detalle complete los campos requeridos:\
                        \n- Fecha\
                        \n- Procedencia\
                        \n- Proveedor\
                        \n- Accesorio\
                        \n- Titulo\
                        \n- Cantidad')
                }

                return false;

            });

            $('#add_to_grid').click(function () {
                var fecha_registro = $("[name='fecha']").val(),
                    proveedor = $("[name='proveedor']").val(),
                    empleado = $("[name='empleado']").val(),
                    turno = $("[name='turno']").val(),
                    maquina = $("[name='maquina']").val(),
                    producto = $("[name='producto']").val(),
                    lote_accesorio = $("[name='lote_accesorio']").val(),
                    accesorio = $("[name='accesorio']").val(),
                    cantidad = $("[name='cantidad']").val(),
                    lote_insumo = $("[name='lote_insumo']").val(),
                    insumo  = $("[name='insumo']").val(),
                    titulo  = $("[name='titulo']").val();
                    debugger;


                if (fecha_registro!='' && proveedor != '' && empleado != '' && turno != '' && maquina != '' && producto != '' && lote_accesorio != '' && accesorio != '' && cantidad != '' && lote_insumo != '' && insumo != '' && titulo != '')
                {
                    var cod = turno+maquina+lote_insumo+lote_accesorio;
                    console.log(cod);
                    if(plan().indexOf(cod)>=0) return alert('Ya existe un trabajador con esa maquina y turno');

                    $('#compras_grid tbody tr:last').after(
                      '<tr>\
                        <td>' + Planeamiento.add_hidden_button(i, 'fecha', fecha_registro) + fecha_registro + '</td>\
                        <td>' + Planeamiento.add_hidden_button(i, 'empleado', empleado) + $("[name='empleado']").find("[value='"+ empleado +"']").html()  + '</td>\
                        <td class="turno">' + Planeamiento.add_hidden_button(i, 'turno', turno) + turno + '</td>\
                        <td class="maquina">' + Planeamiento.add_hidden_button(i, 'maquina', maquina) + $("[name='maquina']").find("[value='"+ maquina +"']").html()   + '</td>\
                        <td>' +  Planeamiento.add_hidden_button(i, 'cantidad', cantidad) + Planeamiento.add_hidden_button(i, 'producto', producto) + $("[name='producto']").find("[value='"+ producto +"']").html()  + '</td>\
                        <td class="accesorio">' + Planeamiento.add_hidden_button(i,'accesorio',accesorio)  + add_hidden_button(i, 'lote_accesorio', lote_accesorio) + lote_insumo + '</td>\
                        <td class="insumo">' +  Planeamiento.add_hidden_button(i, 'lote_insumo', lote_insumo) + Planeamiento.add_hidden_button(i, 'insumo', insumo) + $("[name='insumo']").find("[value='"+ insumo +"']").html() + '</td>\
                        <td>' + Planeamiento.add_hidden_button(i, 'titulo', titulo) + $("[name='titulo']").find("[value='"+ titulo +"']").html() + '</td>\
                        <td><a class="eliminar" style="cursor:pointer"><i class="fa fa-remove"></i></a>'
                        + (insumo != ''? Planeamiento.add_hidden_button(i, 'insumo_id', insumo) : Planeamiento.add_hidden_button(i, 'accesorio_id', accesorio))
                        + '</td></tr>'
                    );
                    i++;
                }
                else
                {
                    alert('Para agregar al detalle complete los campos requeridos:\
                        \n- Fecha Registro\
                        \n- Proveedor\
                        \n- Tejedor\
                        \n- Turno\
                        \n- Maquina\
                        \n- Producto a prod\
                        \n- Accesorios\
                        \n- Materia Prima')
                }

                return false;
            });

            $('#add_insumo_to_grid').click(function () {
                        /* campos de compra */
                        nro_lote = $('#nro_lote').val();
                        insumo = $('#select_insumo_t').val();
                        titulo_insumo = $('#select_titulo_insumo').val();
                        nombre_insumo = $('#select_insumo_t option:selected').text();
                        nombre_titulo = $('#select_titulo_insumo option:selected').text();
                        console.log(titulo_insumo);
                if (nro_lote!='' &&
                    insumo!='' && titulo_insumo!='')
                {


    $('#compras_grid_insumo tbody tr:last').after('<tr>\
        <td>' + Planeamiento.add_hidden_button(i, 'nro_lote', nro_lote) + '<span class="lotes">'+ nro_lote + '</span></td>\
        <td>' + Planeamiento.add_hidden_button(i, 'insumo', insumo) + nombre_insumo + '</td>\
        <td>' + Planeamiento.add_hidden_button(i, 'titulo', titulo_insumo) + nombre_titulo + '</td>\
        <td><a class="eliminar" style="cursor:pointer"><i class="fa fa-remove"></i></a>'
        + Planeamiento.add_hidden_button(i, 'insumo_id', insumo)
        + '</td></tr>'
    );
                    i++;

                    $('#planeamiento-form select#proveedor option:not(:selected)').attr('disabled', true);
                    $('#planeamiento-form input#nro_guia').prop('readonly', true).css('cursor', 'not-allowed');
                    $('#planeamiento-form input#nro_comprobante').prop('readonly', true).css('cursor', 'not-allowed');

                    $('#planeamiento-form input.fillable').val('');
                    $("#planeamiento-form select#select_insumo").val($("#planeamiento-form select#select_insumo option:first").val());
                    $("#planeamiento-form select#select_titulo_insumo").val($("#planeamiento-form select#select_titulo_insumo option:first").val());

                }
                else
                {
                    alert('Para agregar al detalle complete los campos requeridos:\
                        \n- Fecha\
                        \n- Procedencia\
                        \n- Proveedor\
                        \n- Lote\
                        \n- Materia Prima\
                        \n- Titulo\
                        \n- Peso Bruto\
                        \n- Peso Tara\
                        \n- Cantidad')
                }

                return false;
            });
    $('#compras_grid tbody tr td.show_peso_tara input').on('keyup', function() {
        show_peso_tara = $(this).val();
        show_peso_bruto = $(this).parent().parent().find('td.show_peso_bruto input').val();
        show_peso_neto = show_peso_bruto - show_peso_tara;
        show_peso_neto = parseFloat(Math.round( show_peso_neto * 100) / 100).toFixed(2);
        $(this).parent().parent().find('td.show_peso_neto').html(show_peso_neto);
    });


            /* actualizar peso_neto */
            $('#compras_grid tbody tr td.show_peso_bruto input').on('keyup', function() {
                show_peso_bruto = $(this).val();
                show_peso_tara = $(this).parent().parent().find('td.show_peso_tara input').val();
                show_peso_neto = show_peso_bruto - show_peso_tara;
                $(this).parent().parent().find('td.show_peso_neto').html(show_peso_neto);
            });

});

var Planeamiento = {
	listar : function() {
		$("#mp-planeamiento").DataTable({
          processing: true,
          serverSide: true,
          "ajax":{
            url:'planeamientos',
            data:function(d){
              return $.extend( {}, d, {
                "proveedor": $('#proveedor_table').val(),
                "empleado":$("#empleado_table").val(),
                "fecha" : $("#fecha_table").val(),
                "turno" : $("#turno_table").val(),
                "estado" : $("#estado_table").val(),
                "producto": $("#producto_table").val(),
                "maquina":$("#maquina_table").val()
              });
            },
            dataSrc: function (json) {
              var planeamientos = json.data,
              return_data = [];
              for (var i = 0,planeamiento; planeamiento = planeamientos[i]; i++) {
                var data = {};
                data.fecha      = planeamiento.fecha;
                data.proveedor  = planeamiento.proveedor.nombre_comercial;
                data.empleado   = planeamiento.empleado.nombres + " " + planeamiento.empleado.apellidos;
                data.turno      = planeamiento.turno;
                data.maquina    = planeamiento.maquina.nombre;
                data.producto   = planeamiento.producto.nombre_generico;

                data.rollos     = planeamiento.rollos;
                data.kg_producidos = planeamiento.kg_producidos;
                data.kg_falla     = planeamiento.kg_falla;

                for (var j = 0,detalle; detalle = planeamiento.detalles[j]; j++) {
                  data.lote       = detalle.lote_insumo;
                  data.mp         = detalle.insumo? detalle.insumo.nombre_generico:detalle.accesorio.nombre;
                  data.titulo     = detalle.titulo.nombre;
                  data.cajas      = detalle.cajas;
                  data.Kg         = detalle.kg;

                  return_data.push(jQuery.extend(true, {}, data));
                }
              }
              console.log(return_data);
              return return_data;
            }
          },
          "columns": [
            { "data": "fecha", name:"fecha" },
            { "data": "proveedor", name:"proveedor.nombre_comercial" },
            { "data": "empleado",name:"detalle_planeamientos.empleado.nombre_comercial" },
            { "data": "turno", name:"detalle_planeamientos.turno" },
            { "data": "maquina", name:"detalle_planeamientos.maquina.nombre" },
            { "data": "producto",name:"producto.nombre_generico"},

            { "data": "lote",name:"detalle_planeamientos.lote_insumo"},
            { "data": "mp",name:"insumo.nombre_generico"},
            { "data": "titulo",name:"titulos.nombre"},
            { "data": "cajas",name:"detalle_planeamientos.cajas"},
            { "data": "Kg",name:"detalle_planeamientos.Kg"},
            { "data": "rollos",name:"rollos"},
            { "data": "kg_producidos",name:"kg_producidos"},
            { "data": "kg_falla",name:"kg_falla"}

          ],
          "fnDrawCallback":function (oSettings) {
              $(".delete-detalle-planeamientos").click(function(){
                var detalle_id = $(this).attr('data-detalle-id');
                $.ajax({
                  url:'planeamientos'+detalle_id,
                  type:'DELETE',
                  success:function () {
                    bandeja.ajax.reload();
                  }
                });
                return false;
              });

          },
        });
	},
	getCurrentStock : function() {
      var accesorio = $("[name='accesorio']").val();
      var proveedor = $("[name='proveedor']").val();
      Planeamiento.getStockInsumos(accesorio, proveedor);

    },

    getStockAccesorios :function(id) {
    	$("[name='lote_accesorio']").trigger("change");
              $.ajax({
                  url: '/compras/accesorios' + '/' + id + '/lotes',
                  success:function (lotes) {
                    $("[name='lote_accesorio']").empty();
                    for (var i = 0; i < lotes.length; i++) {
                      $("[name='lote_accesorio']").append('<option >' + lotes[i].nro_lote   +'</option>');
                    }
                    console.log('holaaa');
                    Planeamiento.getCurrentStock();
                  }
              });
    },

    getStockInsumos : function(accesorio, proveedor) {
    	$.ajax({
        url: '/insumo' + '/' + accesorio + '/proveedor/' + proveedor + '/stock',
        success:function (stock) {
          currentStock = stock;
          $("[name='cantidad']").val(currentStock);
          if(Number($("[name='cantidad']").val())>Number(currentStock)) return $("[name='cantidad']").val(currentStock);
        }
      });
    },

    add_hidden_button: function(j, fieldname, value) {
        return '<input type="hidden" name="detalles[' + j + '][' + fieldname + ']" value="' + value + '">';
    },

    getLotesporProveedor : function (proveedor_id) {
    	var lotes = $.ajax({
			type: "POST",
			url : "/lotesporproveedor",
			data : {proveedor_id: proveedor_id},
			headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
			success: function(obj){
			html = "<option value=''>Seleccione</option>";
			for(var i in obj) {
				html+="<option value='"+obj[i].nro_lote+"'>"+obj[i].nro_lote+"</option>";
			}
			$("#nro_lote").html(html);
			}
		});
    }
}
