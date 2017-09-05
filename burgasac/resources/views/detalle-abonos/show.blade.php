@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">DetalleAbono {{ $detalleabono->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('detalleabono/detalle-abonos/' . $detalleabono->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit DetalleAbono"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['detalleabono/detalleabonos', $detalleabono->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete DetalleAbono',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $detalleabono->id }}</td>
                                    </tr>
                                    <tr><th> Compra </th><td> {{ $detalleabono->compra }} </td></tr><tr><th> Observaciones </th><td> {{ $detalleabono->observaciones }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection