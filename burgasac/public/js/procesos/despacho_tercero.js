var productos_in_details = function(){
            let lotes = [];
            $("#despachos_grid tbody tr").map(function () {
              var producto = $(this).find(".producto").find("input").val();
              var proveedor =  $(this).find(".proveedor").find("input").val();
              lotes.push(producto+proveedor);
            })
            return lotes;
          };
$(document).ready(function(){
	$(".btn-boleta").click(function(e){
        var despachoid = $(this).data("despacho");
        var url = "/boletadespachotercero?id="+despachoid;
        window.open(url, ",mywin", "left=20, top=20, width=900, height = 900, toolbar=no, directories=no, menubar=no, status=no, resizable=1");
    });
    $('input[type=radio]').change(function() {
        $('input[type=radio]:checked').not(this).prop('checked', false);
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
    $("[name='accesorio']").change(function () {
              var id = $(this).val();
              $.ajax({
                url: "{{url('compras/accesorios')}}" + '/'+id + '/lotes',
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
                url: "{{url('compras/insumos')}}" + '/'+id+'/lotes',
                success:function (lotes) {
                  $("[name='lote_insumo']").empty();
                  for (var i = 0; i < lotes.length; i++) {
                    $("[name='lote_insumo']").append('<option >' + lotes[i].nro_lote   +'</option>');
                  }
                }
              })
            });
   	$('input#cantidad_paquetes').keypress(function (e) {
               if (e.which == 13) {
                    $('#add_to_grid').click();
                    $('#select_materia_prima').focus();
                    e.preventDefault();
                }
            });

               /* FUNCIONALITY */
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
            $('#select_insumo').change(function () {
                $('#select_accesorio').val('');
            });
            /* On selected value, update var insumo */
            $('#select_accesorio').change(function () {
                $('#select_insumo').val('');
            });
});