@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Detallecompras</div>
                    <div class="panel-body">

                        <a href="{{ url('/detallecompra/detalle-compras/create') }}" class="btn btn-primary btn-xs" title="Add New DetalleCompra"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Lote </th><th> Tipo Insumo </th><th> Tipo </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($detallecompras as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->lote }}</td><td>{{ $item->tipo_insumo }}</td><td>{{ $item->tipo }}</td>
                                        <td>
                                            <a href="{{ url('/detallecompra/detalle-compras/' . $item->id) }}" class="btn btn-success btn-xs" title="View DetalleCompra"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/detallecompra/detalle-compras/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit DetalleCompra"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/detallecompra/detalle-compras', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete DetalleCompra" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete DetalleCompra',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $detallecompras->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection