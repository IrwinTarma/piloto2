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
                    <div class="panel-heading">Editar Compra {{ $compra->id }}</div>
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

                        {!! Form::model($compra, [
                            'method' => 'PATCH',
                            'url' => ['/compra/compras', $compra->id],
                            'class' => 'form-horizontal',
                            'id' => 'compra-form',
                            'files' => true
                        ]) !!}

                        @include ('compras.form', ['submitButtonText' => 'Actualizar'])

                        <table id="compras_grid" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>F. Registro</th>
                                <th>Lote</th>
                                <th>Producto</th>
                                <th>Titulo</th>
                                <th>P. Bruto</th>
                                <th>P.Tara</th>
                                <th>P.Neto</th>
                                <th></th>
                            </tr>
                        </thead>
                            <tbody>
                                <?php if ( count($compra->detalles) > 0) : $i = 1; ?>
                                    <?php foreach ($compra->detalles as $detalle) : ?>
                                    <tr>
                                        <td><?php echo date('Y-m-d', strtotime($detalle->fecha)) ?></td>
                                        <td><input type="text" name="detalles[<?php echo $i ?>][nro_lote]" value="<?php echo $detalle->nro_lote?>"></td>
                                        <td><?php
                                            $insumo = $detalle->insumo_id;
                                            $accesorio = $detalle->accesorio_id;
                                            $producto = $insumo != ''? 'Insumo: ' . $detalle->insumo['nombre_generico'] : 'Accesorio: ' . $detalle->accesorio['nombre'];
                                            echo $producto
                                        ?></td>
                                        <td><?php echo $detalle->titulo ?></td>
                                        <td class="show_peso_bruto"><input type="text" name="detalles[<?php echo $i ?>][peso_bruto]" value="<?php echo $detalle->peso_bruto?>"></td>
                                        <td class="show_peso_tara"><input type="text" name="detalles[<?php echo $i ?>][peso_tara]" value="<?php echo $detalle->peso_tara?>"></td>
                                        <td class="show_peso_neto"><?php
                                            if ($detalle->peso_bruto != '' && $detalle->peso_tara != ''){
                                                $detalle->peso_neto = $detalle->peso_bruto - $detalle->peso_tara;
                                             }
                                            else{
                                                $detalle->peso_tara = '0.00';
                                                $detalle->peso_bruto = '0.00';
                                                $detalle->peso_neto = '0.00';
                                            }
                                            echo number_format($detalle->peso_neto, 2);
                                        ?></td>
                                        <td><a class="eliminar" style="cursor:pointer"><i class="fa fa-remove"></i></a>

                                        <input type="hidden" name="detalles[<?php echo $i ?>][fecha_registro]" value="<?php echo $detalle->fecha?>">
                                        
                                        <?php
                                            if ($insumo != ''){
                                                echo '<input type="hidden" name="detalles[' . $i . '][insumo_id]" value="' . $detalle->insumo_id . '">';
                                            }
                                            else {
                                                echo '<input type="hidden" name="detalles[' . $i . '][accesorio_id]" value="' . $detalle->accesorio_id . '">';
                                            }
                                        ?>
                                        <input type="hidden" name="detalles[<?php echo $i ?>][titulo]" value="<?php echo $detalle->titulo?>">
                                        
                                        
                                        <input type="hidden" name="detalles[<?php echo $i ?>][peso_neto]" value="<?php echo $detalle->peso_neto?>">
                                        <input type="hidden" name="detalles[<?php echo $i ?>][marca]" value="<?php echo $detalle->marca?>">
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

                                <a href="{{ url('compra/compras') }}" class="btn btn-warning">Cancelar</a>
                                
                                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Guardar Compra', ['class' => 'btn btn-primary']) !!}
                                
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

            /* Compra action */
            var i = <?php echo count($compra->detalles) + 1 ?>;

            <?php
            /* guardando lotes de grilla detalles para evitar duplicados */
            if ( count($compra->detalles) > 0){
                $array_nro_lotes = [];
                foreach ($compra->detalles as $detalle) :
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
            $('#add_to_grid').click(function () {
                <?php
                    echo "
                        fecha_registro = $('input#fecha').val();
                        nro_lote = $('input#nro_lote').val();
                        
                        insumo = $('#select_insumo').val();
                        accesorio = $('#select_accesorio').val();
                        producto = insumo != ''? insumo : accesorio;
                        
                        marca = $('#select_marca').val();
                        titulo = $('#select_titulo').val();
                        cantidad_paquetes = $('#cantidad_paquetes').val();
                        
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
                    ";
                ?>

                if (fecha_registro!='' && nro_lote!='' && producto!='' && marca!='' && titulo!='' && peso_bruto!='' && peso_tara!='' && cantidad_paquetes!='')
                {
                    if($.inArray(nro_lote, lotes_in_details) > -1){
                        Mensaje.alerta('El lote seleccionado ya ha sido agregado.');
                        $('input#nro_lote').focus();
                        return;
                    }

                    $.ajax({
                        type: "POST",
                        url: "<?php echo url('compra/compras/existe_lote') ?>",
                        data: {
                            lote: nro_lote,
                        },
                        cache: false,
                        dataType: 'json',
                        success: function(result){
                            console.log(result.resultado);
                            if (result.resultado == false){
                                
                                $('#compras_grid tbody tr:last').after('<tr>\
                                    <td>' + add_hidden_button(i, 'fecha_registro', fecha_registro) + fecha_registro + '</td>\
                                    <td>' + add_hidden_button(i, 'nro_lote', nro_lote) + nro_lote + '</td>\
                                    <td>' + producto + '</td>\
                                    <td>' + add_hidden_button(i, 'titulo', titulo) + titulo + '</td>\
                                    <td>' + add_hidden_button(i, 'peso_bruto', peso_bruto) + peso_bruto + '</td>\
                                    <td>' + add_hidden_button(i, 'peso_tara', peso_tara) + peso_tara + '</td>\
                                    <td>' + add_hidden_button(i, 'peso_neto', peso_neto) + peso_neto + '</td>\
                                    <td><a class="eliminar" style="cursor:pointer"><i class="fa fa-remove"></i></a>'
                                    + (insumo != ''? add_hidden_button(i, 'insumo_id', insumo) : add_hidden_button(i, 'accesorio_id', accesorio))
                                    + add_hidden_button(i, 'marca', marca)
                                    + add_hidden_button(i, 'titulo', titulo)
                                    + add_hidden_button(i, 'cantidad_paquetes', cantidad_paquetes)
                                    + '</td></tr>'
                                );
                                i++;

                                $('#compra-form input#nro_guia').prop('readonly', true).css('cursor', 'not-allowed');
                                $('#compra-form input#nro_comprobante').prop('readonly', true).css('cursor', 'not-allowed');

                                $('#compra-form input.fillable').val('');

                                lotes_in_details.push(nro_lote);                                

                            } else if (result.resultado == true) {
                                Mensaje.alerta('No puede utilizar un lote existente!');
                                return;
                            }
                        }
                    });
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