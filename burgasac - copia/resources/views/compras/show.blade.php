@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Compra {{ $compra->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('compra/compras/' . $compra->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Compra"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['compra/compras', $compra->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Borrar Compra',
                                    'onclick'=>'return confirm("Confirmar?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $compra->id }}</td>
                                    </tr>
                                    <tr><th> Fecha </th><td> {{ $compra->fecha }} </td></tr>
                                    <tr><th> Tipo Comprobante </th><td> {{ $compra->tipo_comprobante }} </td></tr>
                                    <tr><th> Nro Comprobante </th><td> {{ $compra->nro_comprobante }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection