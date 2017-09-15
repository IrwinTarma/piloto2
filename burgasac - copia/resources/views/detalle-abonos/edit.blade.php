@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit DetalleAbono {{ $detalleabono->id }}</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($detalleabono, [
                            'method' => 'PATCH',
                            'url' => ['/detalleabono/detalle-abonos', $detalleabono->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        @include ('detalle-abonos.form', ['submitButtonText' => 'Update'])

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection