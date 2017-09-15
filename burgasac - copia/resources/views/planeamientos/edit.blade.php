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
                    <div class="panel-heading">Editar Planeamiento {{ "PLA". leadZero($planeamiento->id) }}</div>
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
                            'url' => ['/planeamientos/planeamientos', $planeamiento->id],
                            'class' => 'form-horizontal',
                            'id' => 'planeamiento-form',
                            'files' => true
                        ]) !!}

                        @include ('planeamientos.form', ['submitButtonText' => 'Actualizar'])

                        <!-- <table id="planeamientos_grid" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                              <th>F. Registro</th>
                              <th width="2">Lote Materia Prima</th>
                              <th>Materia Prima</th>
                              <th>Titulo</th>
                              <th>Eliminar</th>
                            </tr>
                        </thead>
                            <tbody>
                              <tr>

                              </tr>
                              @foreach ($planeamiento->detalles as $i => $detalle)
                                <tr>
                                  <input type="hidden" name="currentAccesorio" value={{$detalle->accesorio_id}}>
                                  <td>
                                      <input type="hidden" name="detalles[{{$i}}][fecha]" value="{{date('Y-m-d', strtotime($detalle->fecha))}}">
                                      {{date('Y-m-d', strtotime($detalle->fecha))}}
                                  </td>
                                  <td>
                                    <input class="form-control" type="number" name="detalles[{{$i}}][lote_insumo]" value="{{$detalle->lote_insumo}}">
                                  </td>

                                  <td>
                                    <select class="form-control" name="detalles[{{$i}}][insumo]">
                                      @foreach ($insumos as $key => $insumo)

                                        <option value="{{$insumo->id}}" {{$insumo->id == $detalle->insumo_id? 'selected':''}} >{{$insumo->nombre_generico}}</option>
                                      @endforeach
                                    </select>
                                  </td>
                                  <td>
                                    <select class="form-control" name="detalles[{{$i}}][titulo]">
                                      @foreach ($titulos as $key => $titulo)
                                        <option value="{{$titulo->id}}" {{$titulo->id == $detalle->titulo_id? 'selected':''}} >{{$titulo->nombre}}</option>
                                      @endforeach
                                    </select>
                                  </td>
                                  <td>
                                    <a class="eliminar" style="cursor:pointer"><i class="fa fa-remove"></i>
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table> -->

                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">

                                <a href="{{ url('planeamientos/planeamientos') }}" class="btn btn-warning">Cancelar</a>

                                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Guardar planeamiento', ['class' => 'btn btn-primary']) !!}

                            </div>
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
@endsection

@section('after-scripts')
@stop
@push("scripts")
{{ Html::script('js/procesos/planeamiento.js') }}
<script>
var accesorioseleccionado = $("[name=accesorio] option:selected").val();
Planeamiento.getStockAccesorios(accesorioseleccionado);
var proveedorseleccionado = $('#planeamiento-form [name=proveedor] option:selected').val();
Planeamiento.getLotesporProveedor(proveedorseleccionado);
$('#select_materia_prima').focus();


            /* FUNCIONALITY */
            /* On selected value: insumo or accesorio */

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
            $('[name=proveedor]').attr('disabled', true);
    </script>
@endpush
