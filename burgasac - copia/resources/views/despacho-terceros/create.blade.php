@extends('backend.layouts.appv2')

@section('after-styles')
    <style type="text/css">
        #select_accesorio{display: none;}
    </style>
@stop

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">DESPACHO A TERCEROS</div>
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

                        {!! Form::model([], [
                            'method' => 'POST',
                            'url' => '/despacho-terceros/despacho-terceros',
                            'class' => 'form-horizontal',
                            'id' => 'planeamiento-form'
                        ]) !!}

                        @include ('despacho-terceros.form', ['submitButtonText' => 'Actualizar'])

                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">

                                <a href="{{ url('despacho-terceros/despacho-terceros') }}" class="btn btn-warning">Cancelar</a>

                                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Guardar despacho de tintoreria', ['class' => 'btn btn-primary']) !!}

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
          $.ajax({
            url:  "{{url('compras/accesorios')}}" +'/'+$("[name='accesorio']").val() + '/lotes',
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

            

            var cantidad_max = 0,
                rollos_max = 0;


            function checkStockKG() {
                var kg = $(this).val();
                if(kg>cantidad_max) return $(this).val(cantidad_max);
            }

            function checkStockRollos(){
              var rollos = $(this).val();
              if(rollos>rollos_max) return $(this).val(rollos_max);
            }

            //$("[name='kg']").keydown(checkStockKG).keyup(checkStockKG);
            //$("[name='rollos']").keydown(checkStockRollos).keyup(checkStockRollos);

            $("[name='producto']").change(function () {
              var id = $(this).val();
              var proveedor_id = $("[name='proveedor']").val();
              $.ajax({
                url: "{{url('telas')}}" + '/'+id+'/proveedor/'+ proveedor_id +'/stock',
                success:function (stock) {
                  cantidad_max = stock.cantidad;
                  rollos_max = stock.rollos;

                  $("[name='kg']").val(stock.cantidad);
                  $("[name='rollos']").val(stock.rollos);
                }
              });
            })





            /*$("[name='proveedor']").change(function () {
              var id = $(this).val();

              $.ajax({
                url: "{{url('proveedor')}}" + '/' + id + '/productos',
                success:function (productos) {
                  $("[name='producto']").empty();
                  $("[name='producto']").append('<option></option>');
                  for (var i = 0; i < productos.length; i++) {
                    $("[name='producto']").append('<option value="'+ productos[i].producto.id + '" >' + productos[i].producto.nombre_generico   +'</option>');
                  }
                }
              })
            }) */

            function obtenerProveedores(){

            }



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

            /* planeamiento action */
            var i = 0;


            function add_hidden_button(j, fieldname, value) {
                return '<input type="hidden" name="detalles[' + j + '][' + fieldname + ']" value="' + value + '">';
            }
            $('#compra-form select#proveedor').attr('disabled', true);
            function add_hidden_button(j, fieldname, value) {
                return '<input type="hidden" name="detalles[' + j + '][' + fieldname + ']" value="' + value + '">';
            }
            $('#add_to_grid').click(function () {

                var fecha_registro = $("[name='fecha']").val(),
                    producto = $("[name='producto']").val(),
                    color = $("[name='color']").val(),
                    proveedor = $("[name='proveedor']").val(),
                    rollos = $("[name='rollos']").val(),
                    kg = $("[name='kg']").val();

                var cod = producto + proveedor;
                debugger;
                if (fecha_registro!='' && producto != '' && color != '' && rollos != '' && kg != '' && proveedor != '')
                {
                    if(productos_in_details().indexOf(cod)>=0) return Mensaje.alerta('Ya existe un trabajador con esa maquina y turno');

                    $('#despachos_grid tbody tr:last').after('<tr>\
                        <td>' + add_hidden_button(i, 'fecha', fecha_registro) + fecha_registro + '</td>\
                        <td class="proveedor">' +  add_hidden_button(i, 'proveedor', proveedor) + $("[name='proveedor'] option:selected").text() + '</td>\
                        <td class="producto">' +  add_hidden_button(i, 'producto', producto) + $("[name='producto'] option:selected").text() + '</td>\
                        <td>' +  add_hidden_button(i, 'color', color) + $("[name='color'] option:selected").text() + '</td>\
                        <td>' +  add_hidden_button(i, 'kg', kg) + $("[name='kg']").val() + '</td>\
                        <td>' +  add_hidden_button(i, 'rollos', rollos) + $("[name='rollos']").val() + '</td>\
                        <td><a class="eliminar" style="cursor:pointer"><i class="fa fa-remove"></i></a>'
                        + '</td></tr>'
                    );
                }
                else
                {
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
            });

        });
    </script>
@stop
@push('scripts')
{{ Html::script('js/procesos/despacho_terceros.js') }}
@endpush