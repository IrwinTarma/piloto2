@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Empleado {{ $empleado->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('empleado/empleados/' . $empleado->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Empleado"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['empleado/empleados', $empleado->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Borrar Empleado',
                                    'onclick'=>'return confirm("Confirmar?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $empleado->id }}</td>
                                    </tr>
                                    <tr><th> Nombres </th><td> {{ $empleado->nombres }} </td></tr><tr><th> Apellidos </th><td> {{ $empleado->apellidos }} </td></tr><tr><th> Fecha Nacimiento </th><td> {{ $empleado->fecha_nacimiento }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection