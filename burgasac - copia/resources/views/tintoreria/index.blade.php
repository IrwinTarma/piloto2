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
                    <div class="panel-heading">Despacho de tintoreria</div>
                    <div class="panel-body">

                        <a href="{{ url('/despacho-tintoreria/despacho-tintoreria/create') }}" class="btn btn-primary btn-xs" title="Nueva Compra"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
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
                                        <th> Fecha </th>
                                        <th> Proveedor </th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                @foreach($despachoTintorerias as $item)
                                    <tr>
                                        <td><span class="btn btn-info detalle">[ + ]</span></td>
                                        <td class="updated_at">{{ date('Y-m-d', strtotime($item->fecha)) }}</td>
                                        <td>{{ $item->proveedor->nombre_comercial}}</td>
                                        <td>
                                            @if ($item->estado==1)
                                              <a href="{{ url('/compra/compras/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Compra"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            @endif
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/despacho-tintoreria/despacho-tintoreria', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Deshabilitar Compra" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Deshabilitar Compra',
                                                        'onclick'=>'return confirm("Confirmar?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                            <a href="#" class="btn btn-info btn-xs btn-boleta" data-despacho="{{$item->id}}"><i class="fa fa-print"></i></a>
                                        </td>
                                    </tr>

                                    <tr class="detallescompra">
                                        <td colspan="9">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <th>F. Registro</th>
                                                    <th>Producto</th>
                                                    <th>Color</th>
                                                    <th>Cantidad</th>
                                                </thead>
                                            <?php foreach ($item->detalles as $detalle) : ?>
                                                <tr>
                                                    <td>{{ $detalle->created_at }}</td>
                                                    <td><?php echo $detalle->producto ?></td>
                                                    <td>{{ $detalle->color}}</td>
                                                    <td><?php echo $detalle->cantidad ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                            </table>
                                        </td>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                            {{-- <div class="pagination-wrapper"> {!! $despachoTintorerias->render() !!} </div> --}}
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
{{ Html::script('js/procesos/despacho_tintoreria.js') }}
@endpush
