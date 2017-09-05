@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Nuevo Accesorio</div>
                    <div class="panel-body">

                        {!! Form::open(['url' => '/accesorio/accesorios', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('accesorios.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection