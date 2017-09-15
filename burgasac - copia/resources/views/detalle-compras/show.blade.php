@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">DetalleCompra {{ $detallecompra->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('detallecompra/detalle-compras/' . $detallecompra->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit DetalleCompra"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['detallecompra/detallecompras', $detallecompra->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete DetalleCompra',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $detallecompra->id }}</td>
                                    </tr>
                                    <tr><th> Lote </th><td> {{ $detallecompra->lote }} </td></tr><tr><th> Tipo Insumo </th><td> {{ $detallecompra->tipo_insumo }} </td></tr><tr><th> Tipo </th><td> {{ $detallecompra->tipo }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection