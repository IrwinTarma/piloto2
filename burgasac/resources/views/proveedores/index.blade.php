@extends('backend.layouts.appv2')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Proveedores</div>
                    <div class="panel-body">

                        <a href="{{ url('/proveedor/proveedores/create') }}" class="btn btn-primary btn-xs" title="Agregar Proveedore"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th> Nombre Comercial </th>
                                        <th> Razon Social </th>
                                        <th> Ruc </th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($proveedores as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nombre_comercial }}</td><td>{{ $item->razon_social }}</td><td>{{ $item->ruc }}</td>
                                        <td>
                                            <a href="{{ url('/proveedor/proveedores/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver Proveedore"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/proveedor/proveedores/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Proveedore"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/proveedor/proveedores', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Borrar Proveedore" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Borrar Proveedor',
                                                        'onclick'=>'return confirm("Confirmar?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
{{ Html::script('js/master/ṕroveedor.js') }}
@endpush