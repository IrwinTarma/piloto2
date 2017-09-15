var RMP = {
    listar : function() {
        $("#bandeja-produccion").DataTable({
          processing: true,
          serverSide: true,
          "ajax":{
            url:'/compras',
            data:function(d){
              return $.extend( {}, d, {
                "proveedor": $('#proveedor_table').val(),
                "empleado":$("#empleado_table").val(),
                "fecha" : $("#fecha_table").val(),
                "turno" : $("#turno_table").val(),
                "estado" : $("#estado_table").val()
              });
            },
            dataSrc: function (json) {

              var compras = json.data,
              return_data = [];
              for (var i = 0,compra; compra = compras[i]; i++) {
                var data = {};
                data.fecha      = compra.fecha;
                data.proveedor  = compra.proveedor.nombre_comercial;
                for (var j = 0,detalle; detalle = compra.detalles[j]; j++) {
                  data.insumo     = detalle.insumo? detalle.insumo.nombre_generico:'';
                  data.titulo     = detalle.titulo.nombre;
                  data.lote       = detalle.nro_lote;
                  data.peso_bruto = detalle.peso_bruto;
                  data.peso_tara  = detalle.peso_tara;
                  data.peso_neto  = Number(detalle.peso_bruto) - Number(detalle.peso_tara) ;
                  data.actions = "";
                  data.actions += '<a href="#" class="btn btn-danger btn-xs delete-detalle-recepcion" data-id="' + data.id +'" data-detalle-id="'+ detalle.id + '"   title="Editar Compra"><span class="glyphicon glyphicon-trash" aria-hidden="true"/></a>'
                  return_data.push(jQuery.extend(true, {}, data));
                }
              }
              return return_data;
            }
          },
          "columns": [
            { "data": "fecha", name:"fecha" },
            { "data": "proveedor", name:"proveedor.nombre_comercial" },
            { "data": "lote", name:"detalles_compras.nro_lote" },
            { "data": "insumo", name:"insumo.nombre_generico" },
            { "data": "titulo", name:"titulo.nombre" },
            { "data": "peso_bruto", name:"detalles_compras.peso_bruto" },
            { "data": "peso_tara", name:"detalles_compras.peso_tara" },
            { "data": "peso_neto"},
            { "data" : "actions",orderable: false, searchable: false}
          ],
          "fnDrawCallback":function (oSettings) {
              $(".delete-detalle-recepcion").click(function(){
                var detalle_id = $(this).attr('data-id');
                $.ajax({
                  url:'/recepcion-mp/recepcion-mp/'+detalle_id,
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
        verificaGuia: function() {
        nro_guia = $("[name='nro_guia']").val();
        proveedor = $("[name=proveedor] option:selected").val();

        setTimeout(function(){
            $.ajax({
                url: '/verifica-guia',
                data: {guia: nro_guia, proveedor: proveedor},
                success:function (bandera) {
                  console.log(bandera);
                  if ( bandera ){
                    bandera_guia=true;
                    Mensaje.alerta("Nro de Guia ya existe para el Proveedor");
                  }
                  else {
                    bandera_guia=false;
                  }
                  console.log(bandera_guia);
                }
              });
        }, 200);
    },
};
var options = {
    valueNames: [ 'updated_at', 'codigo', 'proveedor', 'tipo_comprobante', 'nro_guia', 'peso', 'estado' ]
};
var userList = new List('compras', options);

/* show / hide order details */
$(".detalle").click(function() {
    $(this).closest("tr").next().toggle('fast');
        if($(this).text() == '[ + ]')
            $(this).text('[ - ]');
        else
        $(this).text('[ + ]');
});

        $(function() {
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

            /* VALIDATIONS */
            $(".onlynumbers").keydown(function (e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                     // Allow: Ctrl/cmd+A
                    (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                     // Allow: Ctrl/cmd+C
                    (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                     // Allow: Ctrl/cmd+X
                    (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
                     // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                         // let it happen, don't do anything
                         return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
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

            /* On selected value, update var accesorio */
            $("#select_insumo").change(function(){
                var titulo_id = $(this).find(":selected").data("titulo_id");
                console.log(titulo_id);
                var tituloseleccionado = $("#select_titulo").val(titulo_id);
            });
            /* On selected value, update var insumo */
            $('#select_accesorio').change(function () {
                $('#select_insumo').val('');
            });

            /* Compra action */
            var i = 1;
            var lotes_in_details = function(){
              let lotes = [];
              $("#recepcion_grid tbody tr").map(function () {
                lotes.push($(this).find(".lotes").html());
              })
              return lotes;
            };

            function add_hidden_button(j, fieldname, value) {
                return '<input type="hidden" name="detalles[' + j + '][' + fieldname + ']" value="' + value + '">';
            }

            $('#add_to_grid').click(function (e) {
                e.preventDefault();
                e.stopPropagation();
                fecha_registro = $('input#fecha').val();
                nro_lote = $('input#nro_lote').val();

                insumo = $('#select_insumo').val();
                producto = insumo != ''? insumo : accesorio;

                titulo = $('#select_titulo').val();
                proveedor = $("[name='proveedor']").val();
                cantidad_paquetes = $('#cantidad_paquetes').val();

                peso_bruto = Number(parseFloat(Math.round( $('input#peso_bruto').val() * 100) / 100).toFixed(2));
                peso_tara = Number(parseFloat(Math.round( $('input#peso_tara').val() * 100) / 100).toFixed(2));
                if(peso_bruto<peso_tara)  return alert('El peso bruto debe ser mayor que el peso tara');

                if (peso_bruto != '' && peso_tara != ''){
                    peso_neto = parseFloat(peso_bruto) - parseFloat(peso_tara);
                    peso_neto = parseFloat(Math.round( peso_neto * 100) / 100).toFixed(2);
                }
                else{
                    peso_tara = '0';
                    peso_bruto = '0';
                    peso_neto = '0';
                }

                if (fecha_registro!='' && nro_lote!='' && producto!='' && titulo!='' && peso_bruto!='' && peso_tara!='' && cantidad_paquetes!='' && proveedor != '')
                {
                    if($.inArray(nro_lote, lotes_in_details()) > -1){
                        alert('El lote seleccionado ya ha sido agregado.');
                        $('input#nro_lote').focus();
                        return;
                    }

                    $.ajax({
                        type: "POST",
                        url: "/compra/compras/existe_lote",
                        data: {
                            lote: nro_lote,
                            proveedor : proveedor
                        },
                        cache: false,
                        dataType: 'json',
                        success: function(result){
                            console.log(result.resultado);
                            if (result.resultado == false){

                                $('#recepcion_grid tbody tr:last').after('<tr>\
                                    <td>' + add_hidden_button(i, 'fecha_registro', fecha_registro) + fecha_registro + '</td>\
                                    <td>' + add_hidden_button(i, 'proveedor', proveedor) + proveedor + '</td>\
                                    <td>' + add_hidden_button(i, 'nro_lote', nro_lote) + '<span class="lotes">'+ nro_lote + '</span></td>\
                                    <td>' + producto + '</td>\
                                    <td>' + add_hidden_button(i, 'titulo', titulo) + titulo + '</td>\
                                    <td>' + add_hidden_button(i, 'peso_bruto', peso_bruto) + peso_bruto + '</td>\
                                    <td>' + add_hidden_button(i, 'peso_tara', peso_tara) + peso_tara + '</td>\
                                    <td>' + add_hidden_button(i, 'peso_neto', peso_neto) + peso_neto + '</td>\
                                    <td><a class="eliminar" style="cursor:pointer"><i class="fa fa-remove"></i></a>'
                                    + (insumo != ''? add_hidden_button(i, 'insumo_id', insumo) : add_hidden_button(i, 'accesorio_id', accesorio))
                                    + add_hidden_button(i, 'titulo', titulo)
                                    + add_hidden_button(i, 'cantidad_paquetes', cantidad_paquetes)
                                    + '</td></tr>'
                                );
                                i++;

                                $('#compra-form select#proveedor option:not(:selected)').attr('disabled', true);
                                $('#compra-form input#nro_guia').prop('readonly', true).css('cursor', 'not-allowed');
                                $('#compra-form input#nro_comprobante').prop('readonly', true).css('cursor', 'not-allowed');

                                $('#compra-form input.fillable').val('');


                            } else if (result.resultado == true) {
                                alert('No puede utilizar un lote existente!');
                                return;
                            }
                        }
                    });
                }
                else
                {
                    alert('Para agregar al detalle complete los campos requeridos:\
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

            /* eliminar tr */
            $('body').on('click', 'a.eliminar', function () {
                $(this).parent().parent().remove();
            });

        });
$(document).ready(function(){
    $("#fecha").datepicker({ format: 'yyyy-mm-dd'})
        .on("show", function(e) {
            console.log("show");
            return false;
        }).on("hide", function(e) {
            console.log("hide");
            return false;
        }).on("clearDate", function(e) {
            console.log("clear");
            return false;
    });
    $("[name='nro_guia']").keydown(RMP.verificaGuia).keyup(RMP.verificaGuia);
    $("[name='nro_comprobante']").keydown(RMP.VerificaFactura).keyup(RMP.VerificaFactura);
});