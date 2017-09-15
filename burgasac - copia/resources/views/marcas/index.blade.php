@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Marcas</div>
                    <div class="panel-body">

                        <a href="{{ url('/marca/marcas/create') }}" class="btn btn-primary btn-xs" title="Agregar Marca"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th><th> Nombre </th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($marcas as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nombre }}</td>
                                        <td>
                                            <a href="{{ url('/marca/marcas/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver Marca"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/marca/marcas/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Marca"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/marca/marcas', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Borrar Marca" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Borrar Marca',
                                                        'onclick'=>'return confirm("Confirmar?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $marcas->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection