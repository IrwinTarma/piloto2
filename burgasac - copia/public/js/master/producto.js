var total = 1;
var i = 1;
var Producto = {
    add_hidden_button : function(j, fieldname, value) {
        return '<input type="hidden" name="detalles[' + j + '][' + fieldname + ']" value="' + value + '">';
    }

};
$(document).ready(function(){
    $('#add_insumo_to_grid').click(function () {
            /* campos de compra */
            cantidad = $('input#cantidad').val();
            total=total-cantidad;
            insumo_id = $('#select_insumo').val();
            titulo_id = $("#select_insumo option:selected").data("titulo_id");
            insumo= $('#select_insumo option:selected').text();
            titulo= $('#select_insumo option:selected').data("titulo");

            if (cantidad!='' && insumo_id!='' && cantidad>0)
            {
                $('#materia_prima_grid tbody tr:last').after('<tr>\
                    <td>' + Producto.add_hidden_button(i, 'insumo_id', insumo_id) + insumo + '</td>\
                    <td>' + Producto.add_hidden_button(i, 'titulo_id', titulo_id) + titulo + '</td>\
                    <td class="cantidad">' + Producto.add_hidden_button(i, 'cantidad', cantidad) + cantidad + '</td>\
                    <td><a class="eliminar" data-cantidad ='+cantidad+' style="cursor:pointer"><i class="fa fa-remove"></i></a>'
                    + '</td></tr>'
                );
                i++;

                $('#compra-form input#nombre_generico').prop('readonly', true).css('cursor', 'not-allowed');
                $('#compra-form input#nombre_especifico').prop('readonly', true).css('cursor', 'not-allowed');
                $('#compra-form input#material').prop('readonly', true).css('cursor', 'not-allowed');
            }  else {
                alert('Para agregar al detalle complete los campos requeridos:\
                        \n- Insumo\
                        \n- Cantidad > (0)')
            }

                return false;
    });

                /* eliminar tr */
    $('body').on('click', 'a.eliminar', function () {
        var cant = $(this).data('cantidad');
        total = total + cant;
        //console.log($(this).parent().parent().);
        $(this).parent().parent().remove();
        //console.log($(this).parent().parent().);
    });

    /*$("[name='cantidad']").keydown(function () {
              var lastVal = $(this).val();
              if(Number($(this).val())>Number(total))
              {

                return $(this).val(total);

              }
            }).keyup(function () {
              var lastVal = $(this).val();
              if(Number($(this).val())>Number(total)) return $(this).val(total);
    }); */
});