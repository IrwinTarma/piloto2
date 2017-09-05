@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit DetalleDevolucione {{ $detalledevolucione->id }}</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($detalledevolucione, [
                            'method' => 'PATCH',
                            'url' => ['/detalledevolucion/detalle-devoluciones', $detalledevolucione->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('detalle-devoluciones.form', ['submitButtonText' => 'Update'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection