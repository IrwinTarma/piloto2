@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Detalleabonos</div>
                    <div class="panel-body">

                        <a href="{{ url('/detalleabono/detalle-abonos/create') }}" class="btn btn-primary btn-xs" title="Add New DetalleAbono"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Compra </th><th> Observaciones </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($detalleabonos as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->compra }}</td><td>{{ $item->observaciones }}</td>
                                        <td>
                                            <a href="{{ url('/detalleabono/detalle-abonos/' . $item->id) }}" class="btn btn-success btn-xs" title="View DetalleAbono"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/detalleabono/detalle-abonos/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit DetalleAbono"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/detalleabono/detalle-abonos', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete DetalleAbono" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete DetalleAbono',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $detalleabonos->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection