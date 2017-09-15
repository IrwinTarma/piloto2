@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear Nuevo Local</div>
                    <div class="panel-body">

                        {!! Form::open(['url' => '/local/locales', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('locales.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection