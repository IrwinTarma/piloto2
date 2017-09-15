@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Empleados</div>
                    <div class="panel-body">

                        <a href="{{ url('/empleado/empleados/create') }}" class="btn btn-primary btn-xs" title="Agregar Empleado"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th> Nombres </th>
                                        <th> Apellidos </th>
                                        <th> Fecha Nacimiento </th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($empleados as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nombres }}</td><td>{{ $item->apellidos }}</td><td>{{ $item->fecha_nacimiento }}</td>
                                        <td>
                                            <a href="{{ url('/empleado/empleados/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver Empleado"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/empleado/empleados/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Empleado"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/empleado/empleados', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Borrar Empleado" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Borrar Empleado',
                                                        'onclick'=>'return confirm("Confirmar?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $empleados->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection