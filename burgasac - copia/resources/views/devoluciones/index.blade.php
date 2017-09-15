@extends('backend.layouts.app')

@section('content')

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Devoluciones</div>
                    <div class="panel-body">

                        <a href="{{ url('/devolucion/compras') }}" class="btn btn-primary btn-xs" title="Agregar Devolucion"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        <!--
                        <a href="{{ url('/devolucion/devoluciones/create') }}" class="btn btn-primary btn-xs" title="Add New Devolucione"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a>
                        -->
                        <br/>
                        <br/>
                        
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th> Fecha </th>
                                        <th> Tipo Devolucion </th>
                                        <th> Codigo Compra </th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($devoluciones as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->fecha }}</td>
                                        <td>{{ $item->tipo_devolucion }}</td>
                                        <td>{{ leadZero($item->compra['codigo']) }}</td>
                                        <td>
                                            <a href="{{ url('/devolucion/devoluciones/' . $item->id) }}" class="btn btn-success btn-xs" title="Ver Devoluciones"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                            <!--
                                            <a href="{{ url('/devolucion/devoluciones/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Devolucion"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                            -->
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/devolucion/devoluciones', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Borrar Devolucion" />', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Borrar Devolucion',
                                                        'onclick'=>'return confirm("Confirmar?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $devoluciones->render() !!} </div>
                        
                    </div>
                </div>
            </div>
        </div>
        
@endsection