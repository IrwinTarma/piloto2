@extends('backend.layouts.app')

@section('content')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Abonos</div>
                    <div class="panel-body">

                        <a href="{{ url('/abono/compras') }}" class="btn btn-primary btn-xs" title="Add New Abono"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th> Fecha </th>
                                        <th> Observaciones </th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($abonos as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->fecha }}</td><td>{{ $item->observaciones }}</td>
                                        <td>
                                            <a href="{{ url('/abono/abonos/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver Abono"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/abono/abonos/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Abono"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/abono/abonos', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Borrar Abono" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Borrar Abono',
                                                        'onclick'=>'return confirm("Confirmar?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $abonos->render() !!} </div>

                    </div>
                </div>
            </div>
        </div>

@endsection