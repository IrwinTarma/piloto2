@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Maquinas</div>
                    <div class="panel-body">

                        <a href="{{ url('/maquina/maquinas/create') }}" class="btn btn-primary btn-xs" title="Agregar Maquina"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Nombre </th><th> Codigo </th><th> Observaciones </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($maquinas as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nombre }}</td><td>{{ $item->codigo }}</td><td>{{ $item->observaciones }}</td>
                                        <td>
                                            <a href="{{ url('/maquina/maquinas/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver Maquina"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/maquina/maquinas/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Maquina"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/maquina/maquinas', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Borrar Maquina" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Borrar Maquina',
                                                        'onclick'=>'return confirm("Confirmar?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $maquinas->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection