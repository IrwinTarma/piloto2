@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Cronograma {{ $cronograma->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('cronograma/cronogramas/' . $cronograma->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Cronograma"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['cronograma/cronogramas', $cronograma->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Borrar Cronograma',
                                    'onclick'=>'return confirm("Confirmar?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $cronograma->id }}</td>
                                    </tr>
                                    <tr><th> Cuotas </th><td> {{ $cronograma->cuotas }} </td></tr><tr><th> Monto </th><td> {{ $cronograma->monto }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection