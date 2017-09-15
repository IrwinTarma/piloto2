@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Detalledevoluciones</div>
                    <div class="panel-body">

                        <a href="{{ url('/detalledevolucion/detalle-devoluciones/create') }}" class="btn btn-primary btn-xs" title="Add New DetalleDevolucione"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Observaciones </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($detalledevoluciones as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->observaciones }}</td>
                                        <td>
                                            <a href="{{ url('/detalledevolucion/detalle-devoluciones/' . $item->id) }}" class="btn btn-success btn-xs" title="View DetalleDevolucione"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/detalledevolucion/detalle-devoluciones/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit DetalleDevolucione"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/detalledevolucion/detalle-devoluciones', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete DetalleDevolucione" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete DetalleDevolucione',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $detalledevoluciones->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection