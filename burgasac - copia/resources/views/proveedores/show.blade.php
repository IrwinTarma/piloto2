@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Proveedor {{ $proveedor->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('proveedor/proveedores/' . $proveedor->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Proveedor"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['proveedor/proveedores', $proveedor->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Borrar Proveedor',
                                    'onclick'=>'return confirm("Confirmar?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $proveedor->id }}</td>
                                    </tr>
                                    <tr><th> Nombre Comercial </th><td> {{ $proveedor->nombre_comercial }} </td></tr><tr><th> Razon Social </th><td> {{ $proveedor->razon_social }} </td></tr><tr><th> Ruc </th><td> {{ $proveedor->ruc }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection