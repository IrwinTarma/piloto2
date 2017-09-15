@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Locale {{ $locale->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('local/locales/' . $locale->id . '/edit') }}" class="btn btn-primary btn-xs" title="Editar Local"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['local/locales', $locale->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Borrar Local',
                                    'onclick'=>'return confirm("Confirmar?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $locale->id }}</td>
                                    </tr>
                                    <tr><th> Nombre </th><td> {{ $locale->nombre }} </td></tr><tr><th> Direccion </th><td> {{ $locale->direccion }} </td></tr><tr><th> Telefono </th><td> {{ $locale->telefono }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection