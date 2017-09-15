@extends('backend.layouts.app')

@section('content')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Producto</div>
                    <div class="panel-body">

                        <a href="{{ url('/producto/productos/create') }}" class="btn btn-primary btn-xs" title="Add New Producto"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <br/>
                        <br/>
                        
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th> Nombre Generico </th>
                                        <th> Nombre Especifico </th>
                                        <th> Material </th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($producto as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->nombre_generico }}</td><td>{{ $item->nombre_especifico }}</td><td>{{ $item->material }}</td>
                                        <td>
                                            <a href="{{ url('/producto/productos/' . $item->id) }}" class="btn btn-success btn-xs" title="View Producto"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <a href="{{ url('/producto/productos/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Producto"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/producto/productos', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Producto" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete Producto',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $producto->render() !!} </div>
                        

                    </div>
                </div>
            </div>
        </div>

@endsection