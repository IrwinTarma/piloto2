@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Accesorio {{ $accesorio->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('accesorio/accesorios/' . $accesorio->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Accesorio"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['accesorio/accesorios', $accesorio->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Accesorio',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $accesorio->id }}</td>
                                    </tr>
                                    <tr><th> Nombre </th><td> {{ $accesorio->nombre }} </td></tr><tr><th> Tipo </th><td> {{ $accesorio->tipo }} </td></tr><tr><th> Descripcion </th><td> {{ $accesorio->descripcion }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection