@extends('backend.layouts.app')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Devolucion (Id: {{ $devolucion->id }})</div>
                    <div class="panel-body">

                        <!--
                        <a href="{{ url('devolucion/devoluciones/' . $devolucion->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Devolucione"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        -->
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['devolucion/devoluciones', $devolucion->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Borrar Devolucion',
                                    'onclick'=>'return confirm("Confirmar?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td>{{ $devolucion->id }}</td>
                                    </tr>
                                    <tr><th> Fecha </th><td> {{ $devolucion->fecha }} </td></tr>
                                    <tr><th> Tipo Devolucion </th><td> {{ $devolucion->tipo_devolucion }} </td></tr>
                                    <!--
                                    <tr><th> Observaciones </th><td> {{ $devolucion->observaciones }} </td></tr>
                                    -->
                                </tbody>
                            </table>

                            <center>
                                <h3>Devoluciones</h3>
                            </center>
                            <table class="table table-bordered">
                                <thead>
                                    <th>F. Registro</th>
                                    <th>Lote</th>
                                    <th>Producto</th>
                                    <th>P. Bruto</th>
                                    <th>P. Tara</th>
                                    <th>Caja / Bolsas</th>
                                    <th>P. Neto</th>
                                </thead>
                                <tbody>
                                <?php if ( count($devolucion->detalles) > 0) : $i = 1; ?>
                                    <?php foreach ($devolucion->detalles as $detalle) : ?>
                                    <tr>
                                        <td><?php echo $detalle->fecha ?></td>
                                        <td><?php echo $detalle->nro_lote ?></td>
                                        <td><?php
                                            $insumo = $detalle->insumo_id;
                                            $accesorio = $detalle->accesorio_id;
                                            $producto = $insumo != ''? 'Insumo: ' . $detalle->insumo_id : 'Accesorio: ' . $detalle->accesorio_id;
                                            echo $producto
                                        ?></td>
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
                                        <td><a class="eliminar" style="cursor:pointer"><i class="fa fa-remove"></i></a>

                                        <input type="hidden" name="detalles[<?php echo $i ?>][fecha_registro]" value="<?php echo $detalle->fecha?>">
                                        <input type="hidden" name="detalles[<?php echo $i ?>][nro_lote]" value="<?php echo $detalle->nro_lote?>">
                                        <?php
                                            if ($insumo != ''){
                                                echo '<input type="hidden" name="detalles[' . $i . '][insumo_id]" value="' . $detalle->insumo_id . '">';
                                            }
                                            else {
                                                echo '<input type="hidden" name="detalles[' . $i . '][accesorio_id]" value="' . $detalle->accesorio_id . '">';
                                            }
                                        ?>
                                        <input type="hidden" name="detalles[<?php echo $i ?>][titulo]" value="<?php echo $detalle->titulo?>">
                                        <input type="hidden" name="detalles[<?php echo $i ?>][peso_bruto]" value="<?php echo $detalle->peso_bruto?>">
                                        <input type="hidden" name="detalles[<?php echo $i ?>][peso_tara]" value="<?php echo $detalle->peso_tara?>">
                                        <input type="hidden" name="detalles[<?php echo $i ?>][peso_neto]" value="<?php echo $detalle->peso_neto?>">
                                        <input type="hidden" name="detalles[<?php echo $i ?>][marca]" value="<?php echo $detalle->marca?>">
                                        <input type="hidden" name="detalles[<?php echo $i ?>][cantidad_paquetes]" value="<?php echo $detalle->cantidad_paquetes?>">

                                        </td>
                                    </tr>
                                    <?php $i++; endforeach ?>
                                <?php endif ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection