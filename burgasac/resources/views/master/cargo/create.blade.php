@extends('backend.layouts.appv2')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Crear Cargo</div>
                    <div class="panel-body">

                        {!! Form::open(['url' => '/cargo', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('master.cargo.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection