@extends('backend.layouts.app')

@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Producto {{ $producto->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('producto/productos/' . $producto->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Producto"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['producto/productos', $producto->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Producto',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $producto->id }}</td>
                                    </tr>
                                    <tr><th> Nombre Generico </th><td> {{ $producto->nombre_generico }} </td></tr><tr><th> Nombre Especifico </th><td> {{ $producto->nombre_especifico }} </td></tr><tr><th> Material </th><td> {{ $producto->material }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection