@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Maquina {{ $maquina->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('maquina/maquinas/' . $maquina->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Maquina"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['maquina/maquinas', $maquina->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Borrar Maquina',
                                    'onclick'=>'return confirm("Confirmar?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $maquina->id }}</td>
                                    </tr>
                                    <tr><th> Nombre </th><td> {{ $maquina->nombre }} </td></tr><tr><th> Codigo </th><td> {{ $maquina->codigo }} </td></tr><tr><th> Observaciones </th><td> {{ $maquina->observaciones }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection