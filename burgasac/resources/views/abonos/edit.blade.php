@extends('backend.layouts.app')

@section('content')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Abono {{ $abono->id }}</div>
                    <div class="panel-body">

                        {!! Form::model($abono, [
                            'method' => 'PATCH',
                            'url' => ['/abono/abonos', $abono->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        <input type="hidden" name="compra_id" id="input_compra_id" class="form-control" value="{{ $compra->id }}">

                        @include ('abonos.form', ['submitButtonText' => 'Actualizar'])

                        <table id="abonos_grid" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>F. Registro</th>
                                <th>Producto</th>
                                <th>P. Bruto</th>
                                <th>P.Tara</th>
                                <th>Caja/Bolsas</th>
                                <th>P.Neto</th>
                                <th>Monto Kg.</th>
                                <th></th>
                            </tr>
                        </thead>
                            <tbody>
                                <?php if ( count($abono->detalles) > 0) : $i = 1; ?>
                                    <?php foreach ($abono->detalles as $detalle) : ?>
                                    <tr>
                                        <td><?php echo date('Y-m-d', strtotime($detalle->fecha)) ?></td>
                                        <td><?php echo $detalle->producto_id ?></td>
                                        <td><?php echo $detalle->peso_bruto ?></td>
                                        <td><?php echo $detalle->peso_tara ?></td>
                                        <td><?php echo $detalle->cantidad_paquetes ?></td>
                                        <td><?php
                                            if ($detalle->peso_bruto != '' && $detalle->peso_tara != ''){
                                                $detalle->peso_neto = $detalle->peso_bruto - $detalle->peso_tara;
                                             }
                                            else{
                                                $detalle->peso_tara = '0';
                                                $detalle->peso_bruto = '0';
                                                $detalle->peso_neto = '0';
                                            }
                                            echo $detalle->peso_neto;
                                        ?></td>
                                        <td><?php echo $detalle->monto ?></td>
                                        <td><a class="eliminar" style="cursor:pointer"><i class="fa fa-remove"></i></a>

                                        <input type="hidden" name="detalles[<?php echo $i ?>][fecha_registro]" value="<?php echo $detalle->fecha?>">
                                        <input type="hidden" name="detalles[<?php echo $i ?>][producto]" value="<?php echo $detalle->producto_id?>">
                                        <input type="hidden" name="detalles[<?php echo $i ?>][peso_bruto]" value="<?php echo $detalle->peso_bruto?>">
                                        <input type="hidden" name="detalles[<?php echo $i ?>][peso_tara]" value="<?php echo $detalle->peso_tara?>">
                                        <input type="hidden" name="detalles[<?php echo $i ?>][peso_neto]" value="<?php echo $detalle->peso_neto?>">
                                        <input type="hidden" name="detalles[<?php echo $i ?>][monto]" value="<?php echo $detalle->monto?>">
                                        <input type="hidden" name="detalles[<?php echo $i ?>][cantidad_paquetes]" value="<?php echo $detalle->cantidad_paquetes?>">

                                        </td>
                                    </tr>
                                    <?php $i++; endforeach ?>
                                <?php else : ?>
                                    <tr></tr>
                                <?php endif ?>
                            </tbody>
                        </table>

                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">

                                <a href="{{ url('abono/abonos') }}" class="btn btn-warning">Cancelar</a>
                                
                                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Guardar Nota de Abono', ['class' => 'btn btn-primary']) !!}
                                
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

            /* Abono action */
            var i = <?php echo count($abono->detalles) + 1 ?>;;
            function add_hidden_button(j, fieldname, value) {
                return '<input type="hidden" name="detalles[' + j + '][' + fieldname + ']" value="' + value + '">';
            }
            $('#add_to_grid').click(function () {
                <?php
                    echo "
                        fecha = $('input#fecha').val();
                        proveedor = $('input#proveedor').val();
                        
                        nro_lote = $('#select_nro_lote').val();
                        
                        producto = $('select#select_producto').val();
                        
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

                        monto = $('input#monto').val();
                        cantidad_paquetes = $('input#cantidad_paquetes').val();
                    ";
                ?>

                if (fecha!='' && producto!='' && peso_bruto!='' && peso_tara!='' && cantidad_paquetes!='' && monto!='')
                {
                    $('#abonos_grid tbody tr:last').after('<tr>\
                        <td>' + add_hidden_button(i, 'fecha_registro', fecha) + fecha + '</td>\
                        <td>' + add_hidden_button(i, 'producto', producto) + producto + '</td>\
                        <td>' + add_hidden_button(i, 'peso_bruto', peso_bruto) + peso_bruto + '</td>\
                        <td>' + add_hidden_button(i, 'peso_tara', peso_tara) + peso_tara + '</td>\
                        <td>' + add_hidden_button(i, 'cantidad_paquetes', cantidad_paquetes) + cantidad_paquetes + '</td>\
                        <td>' + add_hidden_button(i, 'peso_neto', peso_neto) + peso_neto + '</td>\
                        <td>' + add_hidden_button(i, 'monto', monto) + monto + '</td>\
                        <td><a class="eliminar" style="cursor:pointer"><i class="fa fa-remove"></i></a>'
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
                        \n- Producto\
                        \n- Peso Bruto\
                        \n- Peso Tara\
                        \n- Cantidad de Caja/Bolsas\
                        \n- Monto')
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