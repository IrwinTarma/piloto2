@extends('backend.layouts.appv2')

@section('after-styles')
    <style>
    .dropdown{padding: 0;}
    .dropdown .dropdown-menu{border: 1px solid #999}
    .detallescompra{
        display: none;
        background-color: #ececec;
    }
    </style>
@stop

@section('content')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Compras</div>
                    <div class="panel-body">

                        <a href="{{ url('/compra/compras/create') }}" class="btn btn-primary btn-xs" title="Nueva Compra"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>

                        <div id="compras">
                            <div class="row">
                                <div class="col-md-4 pull-right">
                                    <input class="search form-control" placeholder="Filtrar Resultados" />
                                </div>
                            </div>

                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Fecha Actualización</th>
                                        <th>Codigo</th>
                                        <th>Proveedor</th>
                                        <th>Factura</th>
                                        <th>Guía</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                @foreach($compras as $item)
                                    <tr>
                                        <td><span class="btn btn-info detalle">[ + ]</span></td>
                                        <td class="updated_at">{{ date('Y-m-d', strtotime($item->updated_at)) }}</td>
                                        <td class="codigo">{{ leadZero($item->codigo) }}</td>
                                        <td class="proveedor">{{ $item->proveedor['nombre_comercial'] }}</td>
                                        <td class="nro_guia"><?php echo $item->nro_comprobante!=''? $item->nro_comprobante : 'Actualizar' ?></td>
                                        <td class="nro_guia">{{ $item->nro_guia }}</td>
                                        <td>
                                            <a href="{{ url('/compra/compras/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver Compra"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            
                                            <a href="{{ url('/compra/compras/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Compra"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            @if ($item->cantidadplaneamiento == 0)
                                                {!! Form::open([
                                                    'method'=>'DELETE',
                                                    'url' => ['/compra/compras', $item->id],
                                                    'style' => 'display:inline'
                                                ]) !!}
                                                <a href="{{ url('/cronograma/cronogramas/create/' . $item->id) }}" class="btn btn-warning btn-xs" title="Ver Cronograma"><span class="glyphicon glyphicon-calendar" aria-hidden="true"/></a>
                                                @if ($item->estado == 2)
                                                    {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Deshabilitar Compra" />', array(
                                                                'type' => 'submit',
                                                                'class' => 'btn btn-danger btn-xs',
                                                                'title' => 'Deshabilitar Compra',
                                                                'onclick'=>'return confirm("Confirmar?")'
                                                        )) !!}
                                                    {!! Form::close() !!}
                                                @endif
                                            @endif
                                            <a href="#" class="btn btn-info btn-xs btn-boleta" data-compra="{{$item->id}}"><i class="fa fa-print"></i></a>
                                        </td>
                                    </tr>

                                    <tr class="detallescompra">
                                        <td colspan="9">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <th>Producto</th>
                                                    <th>Cantidad</th>
                                                    <th>Titulo</th>
                                                    <th>Lote</th>
                                                    <th>P. Bruto</th>
                                                    <th>P.Tara</th>
                                                    <th>P.Neto</th>                                                    
                                                </thead>
                                            <?php foreach ($item->detalles as $detalle) : ?>
                                                <tr colspan="9">
                                                    <td><?php echo $detalle->insumo_id? 'Insumo: ' . $detalle->insumo['nombre_generico'] : 'Accesorio: ' . $detalle->accesorio['nombre'] ?></td>
                                                    <td><?php echo $detalle->cantidad ?></td>
                                                    <td><?php echo $detalle->titulo['nombre'] ?></td>
                                                    <td>{{ isset($detalle->nro_lote)? $detalle->nro_lote : '---' }}</td>
                                                    <td>{{ isset($detalle->peso_bruto)? $detalle->peso_bruto : '---' }}</td>
                                                    <td>{{ isset($detalle->peso_tara)? $detalle->peso_tara : '---' }}</td>
                                                    <td>{{ isset($detalle->peso_bruto) && isset($detalle->peso_bruto)? number_format($detalle->peso_bruto - $detalle->peso_tara, 2) : '---' }}</td>
                                                </tr>
                                            <?php endforeach ?>
                                            </table>
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $compras->render() !!} </div>
                        </div><!-- /#compras -->
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('after-scripts')
    {{ Html::script('plugins/listjs/list.min.js') }}
    <script>
        var options = {
            valueNames: [ 'updated_at', 'codigo', 'proveedor', 'tipo_comprobante', 'nro_guia', 'peso', 'estado' ]
        };
        var userList = new List('compras', options);
    </script>

    <script>
        /* show / hide order details */
        $(".detalle").click(function() {
          $(this).closest("tr").next().toggle('fast');
          if($(this).text() == '[ + ]')
            $(this).text('[ - ]');
          else
            $(this).text('[ + ]');
        });
    </script>
@stop
@push('scripts')
{{ Html::script('js/procesos/compra.js') }}
@endpush