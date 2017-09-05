@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New CompraEstado</div>
                    <div class="panel-body">

                        {!! Form::open(['url' => '/compraestado/compra-estados', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('compra-estados.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection