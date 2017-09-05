@extends('backend.layouts.app')

@section('after-styles')
    <style>
    </style>
@stop

@section('content')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Compras</div>
                    <div class="panel-body">

                        <div id="compras">    
                            <div class="row">
                                <div class="col-md-4 pull-right">
                                    <input class="search form-control" placeholder="Filtrar Resultados" />
                                </div>
                            </div>
                            
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th> U. Fecha Actualizacion </th>
                                        <th>Codigo</th>
                                        <th>Proveedor</th>
                                        <th> Comprobante </th>
                                        <th>Nro Comprobante</th>
                                        <th>Estado</th>
                                        <th>Devoluciones</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                @foreach($compras as $item)
                                    <tr>
                                        <td class="updated_at">{{ $item->updated_at }}</td>
                                        <td class="codigo">{{ leadZero($item->codigo) }}</td>
                                        <td class="proveedor">{{ $item->proveedor['nombre_comercial'] }}</td>
                                        <td class="tipo_comprobante">{{ $item->tipo_comprobante }}</td>
                                        <td class="nro_guia">{{ $item->nro_guia }}</td>
                                        <td class="estado">{{ $item->estado }}</td>
                                        <td>{{ $item->nro_devoluciones }}</td>
                                        <td><a href="{{ url('devolucion/devoluciones/create') . '/' . $item->id }}" class="btn btn-primary">Agregar Devoluciones</a></td>
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
@stop