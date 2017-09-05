@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Insumo {{ $insumo->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('insumo/insumos/' . $insumo->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Insumo"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['insumo/insumos', $insumo->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Insumo',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $insumo->id }}</td>
                                    </tr>
                                    <tr><th> Nombre Generico </th><td> {{ $insumo->nombre_generico }} </td></tr><tr><th> Nombre Especifico </th><td> {{ $insumo->nombre_especifico }} </td></tr><tr><th> Material </th><td> {{ $insumo->material }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection