@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear Titulo</div>
                    <div class="panel-body">

                        {!! Form::open(['url' => '/titulo/titulos', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('titulos.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection