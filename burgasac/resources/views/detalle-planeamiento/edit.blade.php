@extends('backend.layouts.app')

@section('after-styles')
    <style type="text/css">
        #select_accesorio{display: none;}
    </style>
@stop

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Detalle Planeamiento {{ "PLA". leadZero($planeamiento->id) }}</div>
                    <div class="panel-body">

                        <!--
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                        -->

                        {!! Form::model($planeamiento, [
                            'method' => 'PATCH',
                            'url' => ['/detalleplaneamientos/detalleplaneamientos', $detallePlaneamiento->id],
                            'class' => 'form-horizontal',
                            'id' => 'planeamiento-form',
                            'files' => true
                        ]) !!}

                        @include ('detalle-planeamiento.form', ['submitButtonText' => 'Actualizar'])


                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">

                                <a href="{{ url('planeamiento/planeamientos') }}" class="btn btn-warning">Cancelar</a>

                                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Editar planeamiento', ['class' => 'btn btn-primary']) !!}

                            </div>
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
@endsection

@section('after-scripts')
    <script>
        $(function() {
            var id = $("[name='insumo']").val();
            $.ajax({
              url:'/compras/insumos/'+id+'/lotes',
              success:function (lotes) {
                $("[name='lote_insumo']").empty();
                for (var i = 0; i < lotes.length; i++) {
                  $("[name='lote_insumo']").append('<option >' + lotes[i].nro_lote   +'</option>');
                }
              }
            })

            var id = $("[name='accesorio']").val();
            $.ajax({
              url:'/compras/accesorios/'+id + '/lotes',
              success:function (lotes) {
                $("[name='lote_accesorio']").empty();
                for (var i = 0; i < lotes.length; i++) {
                  $("[name='lote_accesorio']").append('<option >' + lotes[i].nro_lote   +'</option>');
                }
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
                url:'/compras/insumos/'+id+'/lotes',
                success:function (lotes) {
                  $("[name='lote_insumo']").empty();
                  for (var i = 0; i < lotes.length; i++) {
                    $("[name='lote_insumo']").append('<option >' + lotes[i].nro_lote   +'</option>');
                  }
                }
              })
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

            /* planeamiento action */
            var i = <?php echo count($planeamiento->detalles)  ?>;

            <?php
            /* guardando lotes de grilla detalles para evitar duplicados */
            if ( count($planeamiento->detalles) > 0){
                $array_nro_lotes = [];
                foreach ($planeamiento->detalles as $detalle) :
                    array_push($array_nro_lotes, "'" . $detalle->nro_lote . "'");
                endforeach;
                $array_nro_lotes = implode(",", $array_nro_lotes);
                echo 'var lotes_in_details = [' . $array_nro_lotes . '];';
            }
            ?>

            function add_hidden_button(j, fieldname, value) {
                return '<input type="hidden" name="detalles[' + j + '][' + fieldname + ']" value="' + value + '">';
            }
            $('#compra-form select#proveedor').attr('disabled', true);
            function add_hidden_button(j, fieldname, value) {
                return '<input type="hidden" name="detalles[' + j + '][' + fieldname + ']" value="' + value + '">';
            }
            $('#add_to_grid').click(function () {

                plan = function () {
                var a = [];
                $("#planeamientos_grid tbody tr").not(":first").each(function () {
                  debugger;
                  var turno = $(this).find(".turno").find("input").val();
                  var maquina = $(this).find(".maquina").find("select").length? $(this).find(".maquina").find("select").val(): $(this).find(".maquina").find("input").val();
                  a.push(turno+maquina);
                  });
                  return a;
                };



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


                if (fecha_registro!='' && proveedor != '' && empleado != '' && turno != '' && maquina != '' && producto != '' && lote_accesorio != '' && accesorio != '' && cantidad != '' && lote_insumo != '' && insumo != '' && titulo != '')
                {
                  var cod = turno+maquina;
                  console.log(plan());
                  if(plan().indexOf(cod)>=0) return alert('Ya existe un trabajador con esa maquina y turno');

                    $('#planeamientos_grid tbody tr:last').after('<tr>\
                        <td>' + add_hidden_button(i, 'fecha', fecha_registro) + fecha_registro + '</td>\
                        <td>' + add_hidden_button(i, 'empleado', empleado) + $("[name='empleado']").find("[value='"+ empleado +"']").html()  + '</td>\
                        <td class="maquina">' + add_hidden_button(i, 'maquina', maquina) + $("[name='maquina']").find("[value='"+ maquina +"']").html()   + '</td>\
                        <td class="turno">' + add_hidden_button(i, 'turno', turno) + turno + '</td>\
                        <td>' + add_hidden_button(i, 'lote_accesorio', lote_accesorio) + lote_accesorio + '</td>\
                        <td>' + add_hidden_button(i,'accesorio',accesorio)  + $("[name='accesorio']").find("[value='"+ accesorio +"']").html()  + '</td>\
                        <td>' +  add_hidden_button(i, 'cantidad', cantidad) + cantidad + '</td>\
                        <td>' +  add_hidden_button(i, 'lote_insumo', lote_insumo) + $("[name='lote_insumo']").val() + '</td>\
                        <td>' +  add_hidden_button(i, 'insumo', insumo) + $("[name='insumo']").find("[value='"+ insumo +"']").html() + '</td>\
                        <td>' + add_hidden_button(i, 'titulo', titulo) + $("[name='titulo']").find("[value='"+ titulo +"']").html() + '</td>\
                        <td><a class="eliminar" style="cursor:pointer"><i class="fa fa-remove"></i></a>'
                        + (insumo != ''? add_hidden_button(i, 'insumo_id', insumo) : add_hidden_button(i, 'accesorio_id', accesorio))
                        + '</td></tr>'
                    );
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
            });

        });
    </script>
@stop
