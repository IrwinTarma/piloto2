@extends('backend.layouts.appv2')

@section('after-styles')
    <style type="text/css">
        #select_accesorio{display: none;}
        .derecha {text-align: right;}
    </style>
@stop

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear Nueva Devolucion</div>
                    <div class="panel-body">

                        {!! Form::open(['url' => '/devolucion/devoluciones', 'class' => 'form-horizontal', 'files' => true]) !!}

                        <input type="hidden" name="compra_id" id="input_compra_id" class="form-control" value="{{ $compra->id }}">

                        @include ('devoluciones.form')

                        <table id="devoluciones_grid" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>F. Registro</th>
                                <th>Lote</th>
                                <th>Producto</th>
                                <th>P. Bruto</th>
                                <th>P.Tara</th>
                                <th>Caja/Bolsas</th>
                                <th>P.Neto</th>
                                <th></th>
                            </tr>
                        </thead>
                            <tbody>
                                <tr></tr>
                            </tbody>
                        </table>

                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">

                                <a href="{{ url('devolucion/devoluciones') }}" class="btn btn-warning">Cancelar</a>

                                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Guardar Devolucion', ['class' => 'btn btn-primary']) !!}

                            </div>
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
@endsection
@section('after-scripts')
    <script type="text/javascript">
        var compra_detalles_json = <?php echo json_encode($compra_detalles_json)?>;
        var currentStock;
        var actPesoTara;
        var actPesoBruto;
        function lotes() {
          let lotes = [];
          $("td .lote").each(function () {
            lotes.push($(this).html());
          });
          return lotes;
        }
        $(function() {
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

            var detalle_compra_id;

            /* disable inputs */
            $('input#proveedor').attr('disabled', true);
            $('input#compra').attr('disabled', true);
            $('input#producto').attr('disabled', true);
            $('input#titulo').attr('disabled', true);

            $('input#peso_tara').attr('readonly', true);

            /* setting up $compra_detalle  */
            

            /* On selected value: insumo or accesorio */
            $('#select_nro_lote').change(function () {
                for(var i in compra_detalles_json){
                    if (compra_detalles_json[i].nro_lote == $(this).val()){
                        if (compra_detalles_json[i].insumo_id == null){
                            $('input#producto').val(compra_detalles_json[i].accesorio_id);
                            $('input#accesorio_id').val(compra_detalles_json[i].accesorio_id);
                            $('input#insumo_id').val('');
                        }
                        if (compra_detalles_json[i].accesorio_id == null){
                            $('input#producto').val(compra_detalles_json[i].insumo_id);
                            $('input#insumo_id').val(compra_detalles_json[i].insumo_id);
                            $('input#accesorio_id').val('');
                        }

                        $('input#marca').val(compra_detalles_json[i].marca);
                        $('input#titulo').val(compra_detalles_json[i].titulo);

                        $('input#peso_bruto').val(compra_detalles_json[i].peso_bruto);
                        $('input#peso_tara').val(compra_detalles_json[i].peso_tara);

                        $('input#peso_bruto').attr('readonly', false);
                        if ( compra_detalles_json[i].peso_bruto == compra_detalles_json[i].peso_tara ){
                            $('input#peso_bruto').attr('readonly', true);
                        }

                        $('input#cantidad_paquetes').val(compra_detalles_json[i].cantidad_paquetes);

                        detalle_compra_id = compra_detalles_json[i].id;

                        break;
                    }
                }
            });

            /* Devolucion action */
            var i = 1;
            function add_hidden_button(j, fieldname, value) {
                return '<input type="hidden" name="detalles[' + j + '][' + fieldname + ']" value="' + value + '">';
            }
            $("[name='select_nro_lote']").change(function () {
              var proveedor = $("[name='proveedor']").val();
              var insumo = $("[name='producto']").val();
              var lote = $(this).val()

              $.ajax({
                url: '{{url('lote')}}' + '/'+lote+'/stock',
                success:function (pesos) {
                  actPesoTara = pesos.peso_tara;
                  actPesoBruto = pesos.peso_bruto;
                }
              })

              $.ajax({
                url: '{{url('insumo')}}' + '/' + insumo + '/proveedor/' + proveedor + '/lote/' + lote + '/stock',
                success:function (stock) {
                  currentStock = stock;
                }
              });

            })

            $("[name='peso_bruto']").keydown(function () {
               var lastVal = $(this).val();
               if(Number($(this).val())>Number(actPesoBruto)) return $(this).val(actPesoBruto);
            }).keyup(function () {
              var lastVal = $(this).val();
              if(Number($(this).val())>Number(actPesoBruto)) return $(this).val(actPesoBruto);

            });

            $("[name='peso_tara']").keydown(function () {
              var lastVal = $(this).val();
              if(Number($(this).val())>Number(actPesoTara)) return $(this).val(actPesoTara);
            }).keyup(function () {
              var lastVal = $(this).val();
              if(Number($(this).val())>Number(actPesoTara)) return $(this).val(actPesoTara);
            });




            $('#add_to_grid').click(function () {
                fecha = $('input#fecha').val();
                proveedor = $('input#proveedor').val();

                nro_lote = $('#select_nro_lote').val();

                insumo = $('input#insumo_id').val();
                accesorio = $('input#accesorio_id').val();
                producto = insumo != ''? insumo : accesorio;

                marca = $('input#marca').val();
                titulo = $('input#titulo').val();

                peso_bruto = parseFloat(Math.round( $('input#peso_bruto').val() * 100) / 100).toFixed(2);
                peso_tara = parseFloat(Math.round( $('input#peso_tara').val() * 100) / 100).toFixed(2);
                if (peso_bruto != '' && peso_tara != ''){
                    peso_neto = parseFloat(peso_bruto) - parseFloat(peso_tara);
                    peso_neto = parseFloat(Math.round( peso_neto * 100) / 100).toFixed(2);
                }
                else{
                    peso_tara = '0';
                    peso_bruto = '0';
                    peso_neto = '0';
                }

                cantidad_paquetes = $('input#cantidad_paquetes').val();

                if(lotes().indexOf(nro_lote)>=0) return alert('El lote ha devolver ya se añadio');

                if (fecha!='' && nro_lote!='' && producto!='' && peso_bruto!='' && peso_tara!='' && cantidad_paquetes!='')
                {
                    $('#devoluciones_grid tbody tr:last').after('<tr>\
                        <td>' + add_hidden_button(i, 'fecha_registro', fecha) + fecha + '</td>\
                        <td>' + add_hidden_button(i, 'nro_lote', nro_lote) + '<span class="lote">' + nro_lote + '</span></td>\
                        <td>' + producto + '</td>\
                        <td>' + add_hidden_button(i, 'peso_bruto', peso_bruto) + peso_bruto + '</td>\
                        <td>' + add_hidden_button(i, 'peso_tara', peso_tara) + peso_tara + '</td>\
                        <td>' + add_hidden_button(i, 'cantidad_paquetes', cantidad_paquetes) + cantidad_paquetes + '</td>\
                        <td>' + add_hidden_button(i, 'peso_neto', peso_neto) + peso_neto + '</td>\
                        <td><a class="eliminar" style="cursor:pointer"><i class="fa fa-remove"></i></a>'
                        + (insumo != ''? add_hidden_button(i, 'insumo_id', insumo) : add_hidden_button(i, 'accesorio_id', accesorio))
                        + add_hidden_button(i, 'marca', marca)
                        + add_hidden_button(i, 'titulo', titulo)
                        + add_hidden_button(i, 'detalle_compra_id', detalle_compra_id)
                        + '</td></tr>'

                    );
                    i++;

                    $('#compra-form input.fillable').val('');
                }
                else
                {
                    alert('Para agregar al detalle complete los campos requeridos:\
                        \n- Fecha\
                        \n- Nro. Lote\
                        \n- Producto\
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
    </script>
@stop
@push('scripts')
{{ Html::script('plugins/sweetalert/sweetalert.min.js') }}
{{ Html::script('js/utils.js') }}
{{ Html::script('js/procesos/devolucioncompra.js') }}
@endpush
