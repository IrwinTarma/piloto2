@extends('backend.layouts.appv2')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Proveedor Color Producto</div>
                    <div class="panel-body">

                        <a href="{{ url('/proveedor_color_producto/create') }}" class="btn btn-primary btn-xs" title="Add New TiposPago"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered dt-responsive nowrap" id="table-color">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Producto</th>
                                        <th>Proveedor</th>
                                        <th>Color</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if (count($data) > 0)
                                @foreach($data as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nombre_generico }}</td>
                                        <td>{{$item->nombre_comercial}}</td>
                                        <td>{{$item->color}}</td>
                                        <td>
                                            <a href="{{ url('/proveedor_color_producto/' . $item->id) }}" class="btn btn-success btn-xs" title="View TiposPago"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/proveedor_color_producto/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit TiposPago"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                        </td>
                                    </tr>
                                @endforeach
                                @endif
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
{{ Html::script('js/master/proveedor_color_producto.js') }}
@endpush