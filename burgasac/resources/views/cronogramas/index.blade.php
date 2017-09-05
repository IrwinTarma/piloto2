@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Cronogramas</div>
                    <div class="panel-body">

                        <a href="{{ url('/cronograma/cronogramas/create') }}" class="btn btn-primary btn-xs" title="Nuevo Cronograma"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Banco</th>
                                        <th>Tipo de Pago</th>
                                        <th> Cuotas </th>
                                        <th> Monto </th>
                                        <th> Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($cronogramas as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->banco['nombre'] }}</td>
                                        <td>{{ $item->tipo_pago['nombre'] }}</td>
                                        <td>{{ $item->cuotas }}</td>
                                        <td>{{ $item->monto }}</td>
                                        <td>
                                            <a href="{{ url('/cronograma/cronogramas/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver Cronograma"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/cronograma/cronogramas/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Cronograma"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/cronograma/cronogramas', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Cronograma" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Borrar Cronograma',
                                                        'onclick'=>'return confirm("Confirmar?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $cronogramas->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection