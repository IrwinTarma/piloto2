@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Create New TiposAbono</div>
                    <div class="panel-body">

                        {!! Form::open(['url' => '/tiposabono/tipos-abono', 'class' => 'form-horizontal', 'files' => true]) !!}

                        @include ('tipos-abono.form')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection