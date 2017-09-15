var bandera_guia=false;
var bandera_comprobante=false;
var Compra = {
    add_hidden_button : function(j, fieldname, value) {
        return '<input type="hidden" name="detalles[' + j + '][' + fieldname + ']" value="' + value + '">';
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
    lotes_in_details : function(){
              let lotes = [];
              $("#compras_grid_insumo tbody tr").map(function () {
                lotes.push($(this).find(".lotes").html());
              })
              return lotes;
            },
    VerificaFactura : function() {
      nro_comprobante = $("[name='nro_comprobante']").val();
      proveedor = $("[name=proveedor] option:selected").val();

      $.ajax({
        url: '/verifica-comprobante',
        data: {nro_comprobante: nro_comprobante, proveedor: proveedor},
        success:function (bandera) {
          console.log(bandera);
          if ( bandera ){
            bandera_comprobante=true;
          }
          else {
            bandera_comprobante=false;
          }
          console.log(bandera_comprobante);
        }
      });
    },
    addInsumoGrid : function(submit) {
       if (bandera_guia||bandera_comprobante){
                  if (bandera_guia) {

                    Mensaje.alerta('Ya existe el nro de guia');
                  }
                  if (bandera_comprobante) {
                    Mensaje.alerta('Ya existe el nro de factura');
                  }
        }
              else {
                        /* campos de compra */

                        fecha = $('input#fecha').val();
                        proveedor = $('select#proveedor').val();
                        procedencia = $('select#procedencia').val();

                        /* campos de insumo */
                        nro_lote = $('input#nro_lote').val();

                        insumo = $('#select_insumo').val();
                        nombre_producto= 'Insumo: ' + $('#select_insumo option:selected').text();

                        titulo = $('#select_titulo_insumo').val();
                        nombre_titulo = $('#select_titulo_insumo option:selected').text();

                        cantidad = $('#cantidad_insumo').val();
                        peso_bruto = Number(parseFloat(Math.round( $('input#peso_bruto').val() * 100) / 100).toFixed(2));
                        peso_tara = Number(parseFloat(Math.round( $('input#peso_tara').val() * 100) / 100).toFixed(2));

                        if(peso_bruto<peso_tara){
                          return alert('El peso bruto debe ser mayor que el peso tara');
                        }

                        peso_neto = parseFloat(peso_bruto) - parseFloat(peso_tara);
                        peso_neto = parseFloat(Math.round( peso_neto * 100) / 100).toFixed(2);

                if (fecha!='' && proveedor!='' && procedencia!='' && nro_lote!='' &&
                    insumo!='' && titulo!='' && peso_bruto!='' && (peso_tara!='' || peso_tara==0) && cantidad!='')
                {
                    var cont = 0;
                    $("#compras_grid_insumo tbody tr").each(function(){
                        cont ++;
                    });
                    $("#optdetallecompra li").css("display", "inline-block");
                    if (cont == 1) {
                        $("#liaccesorios").css("display", "none");
                    }
                    if (cont > 1) {
                        Mensaje.alerta("Solo puede ingresar un detalle por compra!!!");
                        
                        Web.hideloading();
                        return;
                    }
                    if($.inArray(nro_lote, Compra.lotes_in_details()) > -1){
                        Mensaje.alerta('El lote seleccionado ya ha sido agregado.');
                        $('input#nro_lote').focus();
                        return;
                    }

                    $.ajax({
                        type: "POST",
                        url: "/compra/compras/existe_lote",
                        data: {
                            lote: nro_lote, proveedor: $("#proveedor").val()
                        },
                        cache: false,
                        dataType: 'json',
                        success: function(result){
                            if (result.resultado == false){

                                $('#compras_grid_insumo tbody tr:last').after('<tr>\
                                    <td>' + Compra.add_hidden_button(i, 'nro_lote', nro_lote) + '<span class="lotes">'+ nro_lote + '</span></td>\
                                    <td>' + nombre_producto + '</td>\
                                    <td>' + Compra.add_hidden_button(i, 'titulo_id', titulo) + nombre_titulo + '</td>\
                                    <td>' + Compra.add_hidden_button(i, 'peso_bruto', peso_bruto) + peso_bruto + '</td>\
                                    <td>' + Compra.add_hidden_button(i, 'peso_tara', peso_tara) + peso_tara + '</td>\
                                    <td>' + Compra.add_hidden_button(i, 'peso_neto', peso_neto) + peso_neto + '</td>\
                                    <td>' + Compra.add_hidden_button(i, 'cantidad', cantidad) + cantidad + '</td>\
                                    <td><a class="eliminar" style="cursor:pointer"><i class="fa fa-remove"></i></a>'
                                    + Compra.add_hidden_button(i, 'insumo_id', insumo)
                                    + '</td></tr>'
                                );
                                i++;

                                $('#compra-form select#proveedor option:not(:selected)').attr('disabled', true);
                                $('#compra-form input#nro_guia').prop('readonly', true).css('cursor', 'not-allowed');
                                $('#compra-form input#nro_comprobante').prop('readonly', true).css('cursor', 'not-allowed');

                                $('#compra-form input.fillable').val('');
                                $("#compra-form select#select_insumo").val($("#compra-form select#select_insumo option:first").val());
                                $("#compra-form select#select_titulo_insumo").val($("#compra-form select#select_titulo_insumo option:first").val());


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
                if (submit == true) {
                    setTimeout(function(){
                        $("#compra-form").submit();
                    }, 2000);
                    
                }
                return false;
              }
    }


};
$(document).ready(function(){
    $("#fecha").datepicker({ format: 'yyyy-mm-dd'})
        .on("show", function(e) {
            return false;
        }).on("hide", function(e) {
            return false;
        }).on("clearDate", function(e) {
            return false;
    });
    $("[name='nro_guia']").keydown(Compra.verificaGuia).keyup(Compra.verificaGuia);
    $("[name='nro_comprobante']").keydown(Compra.VerificaFactura).keyup(Compra.VerificaFactura);
    /* TAB FOCUS */
    $('[name="procedencia_id"]').focus();
    /* make enter key act like tab key */
    $('input').keypress(function(e) {
        if (e.which == 13) {
            $(':input:eq(' + ($(':input').index(this) + 1) + ')').focus();
            e.preventDefault();
        }
    });
    $(".btn-boleta").click(function(e){
        var compraid = $(this).data("compra");
        console.log(compraid);
        var url = "/boletacompra?id="+compraid;
        window.open(url, ",mywin", "left=20, top=20, width=900, height = 900, toolbar=no, directories=no, menubar=no, status=no, resizable=1");
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

            /* Check "con factura", show factura */
    $('[name="con_factura"]').click(function() {
                $('.block_nro_comprobante').toggle();
    });

            /* Compra action */

    $("#select_insumo").change(function(){
        var titulo_id = $(this).find(":selected").data("titulo_id");
        console.log(titulo_id);
        var tituloseleccionado = $("#select_titulo_insumo").val(titulo_id);
    });

    $('#add_accesorio_to_grid').click(function () {
                Web.showloading();
              if (bandera_guia||bandera_comprobante){
                  if (bandera_guia) {

                    Mensaje.alerta('Ya existe el nro de guia');
                  }
                  if (bandera_comprobante) {
                    alert('Ya existe el nro de factura');
                  }
                  Web.hideloading();
              }
              else {
                        /* campos de compra */
                        fecha = $('input#fecha').val();
                        proveedor = $('select#proveedor').val();
                        procedencia = $('select#procedencia').val();

                        /* campos de accesorio */
                        accesorio = $('#select_accesorio').val();
                        nombre_producto= 'Accesorio: ' + $('#select_accesorio option:selected').text();

                        titulo = $('#select_titulo_accesorio').val();
                        nombre_titulo = $('#select_titulo_accesorio option:selected').text();

                        cantidad = $('[name=cantidad]').val();

                if (fecha!='' && proveedor!='' && procedencia!='' && nro_lote!='' &&
                    accesorio!='' && titulo!='' && cantidad!='')
                {
                    var cont = 0;
                    $("#compras_grid_accesorio tbody tr").each(function(){
                        cont ++;
                    });
                    $("#optdetallecompra li").css("display", "inline-block");
                    if (cont == 1) {
                        $("#limateriaprima").css("display", "none");
                    }
                    if (cont > 1) {
                        Mensaje.alerta("Solo puede ingresar un detalle por compra!!!");
                        Web.hideloading();
                        return;
                    }
                    $('#compras_grid_accesorio tbody tr:last').after('<tr>\
                        <td>' + Compra.add_hidden_button(i, 'titulo_id', titulo) + nombre_titulo + '</td>\
                        <td>' + nombre_producto + '</td>\
                        <td>' + Compra.add_hidden_button(i, 'cantidad', cantidad) + cantidad + '</td>\
                        <td><a class="eliminar" style="cursor:pointer"><i class="fa fa-remove"></i></a>'
                        + Compra.add_hidden_button(i, 'accesorio_id', accesorio)
                        + '</td></tr>'
                    );
                    i++;

                    $('#compra-form select#proveedor option:not(:selected)').attr('disabled', true);
                    $('#compra-form input#nro_guia').prop('readonly', true).css('cursor', 'not-allowed');
                    $('#compra-form input#nro_comprobante').prop('readonly', true).css('cursor', 'not-allowed');

                    $('#compra-form input.fillable').val('');
                    $("#compra-form select#select_accesorio").val($("#compra-form select#select_accesorio option:first").val());
                    $("#compra-form select#select_titulo_accesorio").val($("#compra-form select#select_titulo_accesorio option:first").val());


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
                 Web.hideloading();
                return false;
              }
            });
    $('#add_insumo_to_grid').click(function () {
        Compra.addInsumoGrid();
            });

            /* eliminar tr */
    $('body').on('click', 'a.eliminar', function () {
        var btn = $(this);
        swal.queue([{
            title: '¿Estás seguro de eliminarlo?',
            text: "Este cambio no es reversible!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si deseo, eliminarlo!',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            showLoaderOnConfirm: true
            }]).then(function () {
                btn.parent().parent().remove();
                contaccesorio = 0;
                continsumo = 0;

                $("#compras_grid_accesorio tbody tr").each(function(){
                    contaccesorio++;
                });
                $("#compras_grid_insumo tbody tr").each(function(){
                    continsumo++;
                });

                if (contaccesorio == 1 || continsumo == 1) {
                    $("#liaccesorios, #limateriaprima").css("display", "inline-block");
                    $("#nro_guia").removeAttr("disabled");
                }
        });
        return false;
    });
    $("#cantidad_insumo").keydown(function(e){
        console.log(e);
        if (e.keyCode == 13) {
            Compra.addInsumoGrid(true);
        }
    });
});