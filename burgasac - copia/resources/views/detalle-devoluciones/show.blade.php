@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">DetalleDevolucione {{ $detalledevolucione->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('detalledevolucion/detalle-devoluciones/' . $detalledevolucione->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit DetalleDevolucione"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['detalledevolucion/detalledevoluciones', $detalledevolucione->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete DetalleDevolucione',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $detalledevolucione->id }}</td>
                                    </tr>
                                    <tr><th> Observaciones </th><td> {{ $detalledevolucione->observaciones }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection