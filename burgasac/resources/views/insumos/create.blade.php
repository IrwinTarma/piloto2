@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New Insumo</div>
                    <div class="panel-body">

                        {!! Form::open(['url' => '/insumo/insumos', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('insumos.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection