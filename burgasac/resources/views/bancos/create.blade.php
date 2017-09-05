@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear Nuevo Banco</div>
                    <div class="panel-body">

                        {!! Form::open(['url' => '/banco/bancos', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('bancos.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection